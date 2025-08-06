<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\ServiceResource\Pages;
use App\Filament\App\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Repeater;
use Filament\Support\Enums\Alignment;
use Illuminate\Support\Carbon;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Jadwal Ibadah';

    protected static ?string $modelLabel = 'Jadwal Ibadah';

    protected static ?string $title = 'Jadwal Ibadah';

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
                                    Forms\Components\TextInput::make('type')->reactive(),
                                    Forms\Components\TextInput::make('title')
                                        ->maxLength(255)
                                        ->default('Ibadah FA'),
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
                                    Repeater::make('officer_service_fas')
                                        ->label('Group')
                                        ->relationship()
                                        ->schema([
                                            Forms\Components\Select::make('group_id')
                                                ->relationship(
                                                    'group',
                                                    'name',
                                                ),

                                        ])
                                        ->defaultItems(0)
                                        ->addActionAlignment(Alignment::End)
                                        ->collapsible(),
                                ])->visible(fn(callable $get) => strtolower($get('type')) === 'fa'),
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
                                        ->defaultItems(0)
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
                Tables\Columns\TextColumn::make('type'),
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
                Tables\Filters\SelectFilter::make('type')->options([
                    'IBADAH RAYA' => 'Ibadah Raya',
                    'MOG' => 'Message Of God',
                    'DOA' => 'Doa',
                    'BOOM' => 'Blessing Out Of Mercy',
                    'WBI' => 'Wanita Bethel Indonesia',
                    'RBI' => 'Remaja Bethel Indonesia',
                    'WN' => 'Wanita',
                    'FA' => 'Family Althar',
                ])->searchable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListServices::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            ->whereDate('held_at', '>=', Carbon::today());
    }
}
