<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\DonationYayasanResource\Pages;
use App\Filament\App\Resources\DonationYayasanResource\RelationManagers;
use App\Models\Donation;
use App\Models\DonationYayasan;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DonationYayasanResource extends Resource
{
    protected static ?string $model = Donation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Donasi Yayasan';

    protected static ?string $navigationGroup = 'Donasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\Hidden::make('user_id')
                            ->default(
                                fn() => Auth::user()->id
                            )
                            ->required(),
                        Forms\Components\TextInput::make('amount')
                            ->label('Jumlah Donasi')
                            ->required()
                            ->numeric(),
                        Forms\Components\Select::make('purpose')
                            ->label('Tujuan Donasi')
                            ->options([
                                'sd' => 'SD',
                                'smp' => 'SMP',
                            ])
                            ->preload()
                            ->searchable()
                            ->required(),
                        Forms\Components\FileUpload::make('proof_path')
                            ->label('Bukti Transfer')
                            ->columnSpanFull()
                            ->default(null),
                        Forms\Components\Textarea::make('message')
                            ->columnSpanFull(),
                        Forms\Components\Hidden::make('type')
                            ->default('yys')
                    ])->columns(2)
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('purpose')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'sd' => 'SD',
                            'smp' => 'SMP',
                            default => $state,
                        };
                    })
                    ->color(function ($state) {
                        return match ($state) {
                            'sd' => 'primary',
                            'smp' => 'success',
                            default => 'secondary',
                        };
                    })
                    ->searchable(),
                Tables\Columns\ImageColumn::make('proof_path')
                    ->label('Bukti Transfer')
                    ->square()
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_approved')
                    ->boolean(),
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
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListDonationYayasans::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            ->where('user_id', Auth::user()->id)
            ->where('type', 'yys');
    }
}
