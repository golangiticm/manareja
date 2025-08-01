<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\WeddingResource\Pages;
use App\Filament\App\Resources\WeddingResource\RelationManagers;
use App\Models\Wedding;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class WeddingResource extends Resource
{
    protected static ?string $model = Wedding::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Wedding';

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
                        Forms\Components\TextInput::make('groom_name')
                            ->label('Nama Mempelai Pria')
                            ->maxLength(255)
                            ->default(null)
                            ->required(),
                        Forms\Components\TextInput::make('bride_name')
                            ->label('Nama Mempelai Wanita')
                            ->maxLength(255)
                            ->default(null)
                            ->required(),
                        Forms\Components\DatePicker::make('wedding_date')->required(),
                        Forms\Components\TextInput::make('wedding_location')
                            ->maxLength(255)
                            ->default(null)
                            ->required(),
                        Forms\Components\FileUpload::make('prewedding_photo')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->directory('wedding')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Hidden::make('status')
                            ->default('pending')
                            ->required(),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('groom_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bride_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('wedding_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('wedding_location')
                    ->label('Lokasi Pernikahan')
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
            'index' => Pages\ListWeddings::route('/'),
            // 'create' => Pages\CreateWedding::route('/create'),
            // 'edit' => Pages\EditWedding::route('/{record}/edit'),
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
