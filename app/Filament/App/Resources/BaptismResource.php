<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\BaptismResource\Pages;
use App\Filament\App\Resources\BaptismResource\RelationManagers;
use App\Models\Baptism;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class BaptismResource extends Resource
{
    protected static ?string $model = Baptism::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Baptism';

    protected static ?string $navigationGroup = 'Formulir';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\Hidden::make('user_id')
                            ->default(fn() => Auth::user()->id)
                            ->required(),
                        Forms\Components\TextInput::make('parents_name')
                            ->label('Nama Wali')
                            ->maxLength(255)
                            ->default(null)
                            ->required(),
                        Forms\Components\Select::make('baptism_type')
                            ->label('Jenis Baptism')
                            ->options([
                                'selam' => 'Selam',
                                'percik' => 'Percik',
                                'anak' => 'Anak',
                            ])
                            ->preload()
                            ->searchable()
                            ->required(),
                        Forms\Components\DatePicker::make('baptism_date')->required()->label('Tanggal Baptism'),
                        Forms\Components\FileUpload::make('birth_certificate')
                            ->label('Surat Keterangan Lahir (PDF)')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(2048) // dalam KB = 2MB
                            ->directory('documents/baptism') // path penyimpanan relatif ke disk
                            ->preserveFilenames()
                            ->required(),
                        Forms\Components\FileUpload::make('photo')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->directory('baptism')
                            ->required(),
                        Forms\Components\TextInput::make('baptism_place')
                            ->maxLength(255)
                            ->default(null)
                            ->required(),
                        Forms\Components\Hidden::make('status')
                            ->default('pending')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('parents_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('baptism_type'),
                Tables\Columns\TextColumn::make('baptism_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('baptism_place')
                    ->searchable(),
                Tables\Columns\IconColumn::make('birth_certificate')
                    ->label('Surat Lahir') // bisa diganti jadi kosong kalau mau
                    ->icon(fn($state) => $state ? 'heroicon-o-document-arrow-down' : null)
                    ->color('primary')
                    ->url(fn($state) => $state ? Storage::url($state) : null)
                    ->openUrlInNewTab(),
                Tables\Columns\ImageColumn::make('photo')
                    ->circular()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(function ($state) {
                        return match ($state) {
                            'pending'  => 'warning',
                            'approved' => 'success',
                            'rejected' => 'danger',
                            default => 'secondary',
                        };
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'pending' => 'Pending',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected'
                ])->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBaptisms::route('/'),
            // 'create' => Pages\CreateBaptism::route('/create'),
            // 'edit' => Pages\EditBaptism::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            ->where('user_id', Auth::user()->id);
    }
}
