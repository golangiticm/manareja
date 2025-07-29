<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WnResource\Pages;
use App\Filament\Resources\WnResource\RelationManagers;
use App\Models\Service;
use App\Models\Wn;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Repeater;
use Filament\Support\Enums\Alignment;


class WnResource extends Resource
{
    protected static ?string $model = Service::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'WN';

    protected static ?string $navigationGroup = 'Jadwal Ibadah';

    protected static ?string $modelLabel = 'WN';

    protected static ?string $pluralModelLabel = 'Daftar WN';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Jadwal')
                        ->icon('heroicon-m-calendar-days')
                        ->schema([
                            Card::make()
                                ->schema([
                                    Forms\Components\Hidden::make('type')
                                        ->default('WN'),
                                    Forms\Components\TextInput::make('title')
                                        ->maxLength(255)
                                        ->default('Ibadah WN'),
                                    Forms\Components\DatePicker::make('held_at')
                                        ->required(),
                                    Forms\Components\TimePicker::make('start_time'),
                                    Forms\Components\TimePicker::make('end_time'),
                                    Forms\Components\TextInput::make('location')
                                        ->maxLength(255)
                                        ->default(null),
                                ]),
                        ]),
                    Wizard\Step::make('Petugas')
                        ->icon('heroicon-m-user-group')
                        ->schema([
                            Card::make()
                                ->schema([
                                    Repeater::make('officer_service_assigments')
                                        ->relationship()
                                        ->schema([
                                            Forms\Components\Select::make('officer_id')
                                                ->label('Tugas/Jabatan')
                                                ->relationship('officer', 'title')
                                                ->required()
                                                ->reactive(),

                                            Forms\Components\Select::make('user_id')
                                                ->label('Nama Petugas')
                                                ->options(function (callable $get) {
                                                    $officerId = $get('officer_id');

                                                    if (!$officerId) {
                                                        return \App\Models\User::all()->pluck('name', 'id');
                                                    }

                                                    return \App\Models\User::whereHas('officers', function ($query) use ($officerId) {
                                                        $query->where('officers.id', $officerId);
                                                    })->pluck('name', 'id');
                                                })
                                                ->required()
                                                ->searchable(),

                                        ])
                                        ->addActionAlignment(Alignment::End)
                                        ->collapsible(),
                                ]),
                        ]),
                ])
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('held_at')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_time'),
                Tables\Columns\TextColumn::make('end_time'),
                Tables\Columns\TextColumn::make('location')
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListWns::route('/'),
            'create' => Pages\CreateWn::route('/create'),
            'edit' => Pages\EditWn::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            ->where('type', 'WN');
    }
}
