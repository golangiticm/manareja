<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QrisResource\Pages;
use App\Filament\Resources\QrisResource\RelationManagers;
use App\Models\Qris;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ActionGroup;


class QrisResource extends Resource
{
    protected static ?string $model = Qris::class;

    protected static ?string $navigationGroup = 'Perbankan';

    protected static ?string $navigationIcon = 'heroicon-o-qr-code';

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
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('atas_nama')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('qr_code')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->directory('bank'),
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
                            'yys' => 'Yayasan',
                            default => $state,
                        };
                    })
                    ->color(function ($state) {
                        return match ($state) {
                            'brc' => 'primary',
                            'yys' => 'success',
                            default => 'gray',
                        };
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('atas_nama')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('qr_code')
                    ->square()
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
                 ActionGroup::make([
                     Tables\Actions\ViewAction::make(),
                     Tables\Actions\EditAction::make(),
                     Tables\Actions\DeleteAction::make(),
                 ]),
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
            'index' => Pages\ListQris::route('/'),
            // 'create' => Pages\CreateQris::route('/create'),
            // 'edit' => Pages\EditQris::route('/{record}/edit'),
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
