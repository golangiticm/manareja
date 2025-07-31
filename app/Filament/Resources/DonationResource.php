<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonationResource\Pages;
use App\Filament\Resources\DonationResource\RelationManagers;
use App\Models\Donation;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DonationResource extends Resource
{
    protected static ?string $model = Donation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('donor_name')
                            ->prefixIcon('heroicon-o-user-circle')
                            ->required()
                            ->maxLength(255)
                            ->hiddenOn('edit'),
                        Forms\Components\TextInput::make('amount')
                            ->prefix('Rp')
                            ->required()
                            ->numeric()
                            ->hiddenOn('edit'),
                        Forms\Components\Select::make('purpose')
                            ->options([
                                '000' => 'Persembahan',
                                '010' => 'Persepuluhan',
                                '020' => 'Pembangunan',
                                '005' => 'Diakonia/Peduli Kasih',
                                '015' => 'Ucapan Syukur',
                                '025' => 'HUT/Natal/Paskah',
                                '030' => 'Misi',
                                '035' => 'Komitmen Videotron',
                            ])
                            ->searchable()
                            ->preload()
                            ->required()
                            ->hiddenOn('edit'),
                        Forms\Components\FileUpload::make('proof_path')
                            ->image()
                            ->columnSpanFull()
                            ->default(null)
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->directory('donations')
                            ->hiddenOn('edit'),
                        Forms\Components\Textarea::make('message')
                            ->columnSpanFull()
                            ->hiddenOn('edit'),
                        Forms\Components\Toggle::make('is_approved')
                            ->required(),
                    ])
                    ->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('donor_name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('purpose')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            '000' => 'Persembahan',
                            '010' => 'Persepuluhan',
                            '020' => 'Pembangunan',
                            '005' => 'Diakonia/Peduli Kasih',
                            '015' => 'Ucapan Syukur',
                            '025' => 'HUT/Natal/Paskah',
                            '030' => 'Misi',
                            '035' => 'Komitmen Videotron',
                            default => $state,
                        };
                    })
                    ->color(function ($state) {
                        return match ($state) {
                            '000' => 'primary',
                            '010' => 'success',
                            '020' => 'warning',
                            '005' => 'danger',
                            '015' => 'info',
                            '025' => 'gray',
                            '030' => 'purple',
                            '035' => 'cyan',
                            default => 'secondary',
                        };
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('proof_path')
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
                Tables\Columns\TextColumn::make('amount')
                    ->label('Jumlah')
                    ->money('IDR', locale: 'id_ID')
                    ->sortable()
                    ->summarize([
                        \Filament\Tables\Columns\Summarizers\Sum::make()
                            ->label('Total Donasi')
                            ->money('IDR', locale: 'id_ID'),
                        // ->query(fn($query) => $query->where('is_approved', true)),
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('purpose')->options([
                    '000' => 'Persembahan',
                    '010' => 'Persepuluhan',
                    '020' => 'Pembangunan',
                    '005' => 'Diakonia/Peduli Kasih',
                    '015' => 'Ucapan Syukur',
                    '025' => 'HUT/Natal/Paskah',
                    '030' => 'Misi',
                    '035' => 'Komitmen Videotron',
                ])->searchable(),
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
            'index' => Pages\ListDonations::route('/'),
            // 'create' => Pages\CreateDonation::route('/create'),
            // 'edit' => Pages\EditDonation::route('/{record}/edit'),
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
