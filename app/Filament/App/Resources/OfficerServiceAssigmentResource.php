<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\OfficerServiceAssigmentResource\Pages;
use App\Filament\App\Resources\OfficerServiceAssigmentResource\RelationManagers;
use App\Models\OfficerServiceAssigment;
use Carbon\Callback;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OfficerServiceAssigmentResource extends Resource
{
    protected static ?string $model = OfficerServiceAssigment::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Jadwal Tugas Saya';

    protected static ?string $modelLabel = 'Jadwal Tugas Saya';

    protected static ?string $title = 'Jadwal Tugas Saya';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\Select::make('service_id')
                            ->label('Kegiatan')
                            ->relationship('service', 'title')
                            ->required(),
                        Forms\Components\Select::make('user_id')
                            ->label('Nama')
                            ->relationship('user', 'name')
                            ->required(),
                        Forms\Components\Select::make('officer_id')
                            ->label('Petugas')
                            ->relationship('officer', 'title')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service.title')
                    ->label('Kegiatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('service.held_at')
                    ->label('Tanggal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('officer.title')
                    ->label('Petugas')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            'index' => Pages\ListOfficerServiceAssigments::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            ->whereHas('service', function (Builder $query) {
                $query->whereDate('held_at', '>=', Carbon::now());
            })
            ->where('user_id', Auth::user()->id);
    }
}
