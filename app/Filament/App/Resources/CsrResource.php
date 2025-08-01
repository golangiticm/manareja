<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\CsrResource\Pages;
use App\Filament\App\Resources\CsrResource\RelationManagers;
use App\Models\Csr;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class CsrResource extends Resource
{
    protected static ?string $model = Csr::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'CSR';

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
                        Forms\Components\TextArea::make('requested_need')
                            ->default(null)
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('supporting_document')
                            ->label('Dokumen Pendamping (PDF)')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(2048) // dalam KB = 2MB
                            ->directory('documents/CSR') // path penyimpanan relatif ke disk
                            ->preserveFilenames()
                            ->required(),
                        Forms\Components\FileUpload::make('condition_photo')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->directory('CSR')
                            ->required(),
                        Forms\Components\Select::make('assistance_type')
                            ->options([
                                'pendidikan' => 'Pendidikan',
                                'kesehatan' => 'Kesehatan',
                                'lainnya' => 'Lainya'
                            ])
                            ->preload()
                            ->searchable()
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
                Tables\Columns\TextColumn::make('requested_need')
                    ->searchable(),
                Tables\Columns\IconColumn::make('supporting_document')
                    ->label('Surat Pendamping') // bisa diganti jadi kosong kalau mau
                    ->icon(fn($state) => $state ? 'heroicon-o-document-arrow-down' : null)
                    ->color('primary')
                    ->url(fn($state) => $state ? Storage::url($state) : null)
                    ->openUrlInNewTab(),
                Tables\Columns\ImageColumn::make('condition_photo')
                    ->circular()
                    ->searchable(),
                Tables\Columns\TextColumn::make('assistance_type'),
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
            'index' => Pages\ListCsrs::route('/'),
            // 'create' => Pages\CreateCsr::route('/create'),
            // 'edit' => Pages\EditCsr::route('/{record}/edit'),
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
