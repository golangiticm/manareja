<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoaResource\Pages;
use App\Filament\Resources\DoaResource\RelationManagers;
use App\Models\Doa;
use App\Models\Service;
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

class DoaResource extends Resource
{
    protected static ?string $model = Service::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'DOA';

    protected static ?string $navigationGroup = 'Jadwal Ibadah';

    protected static ?string $modelLabel = 'DOA';

    protected static ?string $pluralModelLabel = 'Daftar DOA';

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
                                        ->default('DOA'),
                                    Forms\Components\TextInput::make('title')
                                        ->maxLength(255)
                                        ->default('Ibadah DOA'),
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
                                    Repeater::make('officer_service_pendetas')
                                        ->label('Pendeta')
                                        ->relationship()
                                        ->schema([
                                            Forms\Components\Select::make('user_id')
                                                ->relationship(
                                                    'user',
                                                    'name',
                                                    fn($query) => $query->whereHas('officers', fn($q) => $q->where('title', 'pendeta'))
                                                ),

                                        ])
                                       ->addActionAlignment(Alignment::End)
                                        ->collapsible(),
                                ]),
                            Card::make()
                                ->schema([
                                    Repeater::make('officer_service_worship_leaders')
                                        ->label('Worship Leader')
                                        ->relationship()
                                        ->schema([
                                            Forms\Components\Select::make('user_id')
                                                ->relationship(
                                                    'user',
                                                    'name',
                                                    fn($query) => $query->whereHas('officers', fn($q) => $q->where('title', 'wl'))
                                                ),

                                        ])
                                       ->addActionAlignment(Alignment::End)
                                        ->collapsible(),
                                ]),
                            Card::make()
                                ->schema([
                                    Repeater::make('officer_service_singers')
                                        ->label('Singer')
                                        ->relationship()
                                        ->schema([
                                            Forms\Components\Select::make('user_id')
                                                ->relationship(
                                                    'user',
                                                    'name',
                                                    fn($query) => $query->whereHas('officers', fn($q) => $q->where('title', 'singer'))
                                                ),

                                        ])
                                       ->addActionAlignment(Alignment::End)
                                        ->collapsible(),
                                ]),
                            Card::make()
                                ->schema([
                                    Repeater::make('officer_service_ushers')
                                        ->label('Usher')
                                        ->relationship()
                                        ->schema([
                                            Forms\Components\Select::make('user_id')
                                                ->relationship(
                                                    'user',
                                                    'name',
                                                    fn($query) => $query->whereHas('officers', fn($q) => $q->where('title', 'usher'))
                                                ),


                                        ])
                                       ->addActionAlignment(Alignment::End)
                                        ->collapsible(),
                                ]),
                            Card::make()
                                ->schema([
                                    Repeater::make('officer_service_kolektans')
                                        ->label('Kolektan')
                                        ->relationship()
                                        ->schema([
                                            Forms\Components\Select::make('user_id')
                                                ->relationship(
                                                    'user',
                                                    'name',
                                                    fn($query) => $query->whereHas('officers', fn($q) => $q->where('title', 'kolektan'))
                                                ),

                                        ])
                                       ->addActionAlignment(Alignment::End)
                                        ->collapsible(),
                                ]),
                            Card::make()
                                ->schema([
                                    Repeater::make('officer_service_multimedias')
                                        ->label('Multimedia')
                                        ->relationship()
                                        ->schema([
                                            Forms\Components\Select::make('user_id')
                                                ->relationship(
                                                    'user',
                                                    'name',
                                                    fn($query) => $query->whereHas('officers', fn($q) => $q->where('title', 'multimedia'))
                                                ),

                                        ])
                                       ->addActionAlignment(Alignment::End)
                                        ->collapsible(),
                                ]),
                            Card::make()
                                ->schema([
                                    Repeater::make('officer_service_musiks')
                                        ->label('Musik')
                                        ->relationship()
                                        ->schema([
                                            Forms\Components\Select::make('user_id')
                                                ->relationship(
                                                    'user',
                                                    'name',
                                                    fn($query) => $query->whereHas('officers', fn($q) => $q->where('title', 'musik'))
                                                ),

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
            'index' => Pages\ListDoas::route('/'),
            'create' => Pages\CreateDoa::route('/create'),
            'edit' => Pages\EditDoa::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            ->where('type', 'DOA');
    }
}
