<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankResource\Pages;
use App\Filament\Resources\BankResource\RelationManagers;
use App\Models\Bank;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BankResource extends Resource
{
    protected static ?string $model = Bank::class;

    protected static ?string $navigationGroup = 'Donasi';

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\Select::make('type')
                            ->label('Peruntukan')
                            ->options([
                                'brc' => 'Gereja BRC Sangatta',
                                'yyp' => 'Yayasan->Paud',
                                'yys' => 'Yayasan->SD',
                            ]),
                        Forms\Components\TextInput::make('nama_bank')
                            ->required()
                            ->maxLength(255)
                            ->label('Nama Bank')
                            ->prefixIcon('heroicon-o-building-library'),
                        Forms\Components\TextInput::make('no_rekening')
                            ->required()
                            ->tel()
                            ->mask('9999-9999-9999-9999')
                            ->maxLength(20)
                            ->label('No Rekening')
                            ->prefixIcon('heroicon-o-credit-card'),
                        Forms\Components\TextInput::make('atas_nama')
                            ->required()
                            ->maxLength(255)
                            ->label('Atas Nama')
                            ->prefixIcon('heroicon-o-tag'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Peruntukan')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'brc' => 'Gereja BRC Sangatta',
                            'yyp' => 'Yayasan → Paud',
                            'yys' => 'Yayasan → SD',
                            default => $state,
                        };
                    })
                    ->color(function ($state) {
                        return match ($state) {
                            'brc' => 'primary',
                            'yyp' => 'success',
                            'yys' => 'warning',
                            default => 'gray',
                        };
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_bank')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_rekening')
                    ->searchable(),
                Tables\Columns\TextColumn::make('atas_nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListBanks::route('/'),
            // 'create' => Pages\CreateBank::route('/create'),
            // 'edit' => Pages\EditBank::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
