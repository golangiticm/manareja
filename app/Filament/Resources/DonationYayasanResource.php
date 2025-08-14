<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonationYayasanResource\Pages;
use App\Filament\Resources\DonationYayasanResource\RelationManagers;
use App\Models\Donation;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ActionGroup;

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
                                'sd' => 'SD',
                                'smp' => 'SMP',
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
                            ->disabledOn('edit'),
                        Forms\Components\Textarea::make('message')
                            ->columnSpanFull()
                            ->readOnlyOn('edit'),
                        Forms\Components\Toggle::make('is_approved')
                            ->required(),
                        Forms\Components\Hidden::make('type')
                            ->default('yys')
                    ])
                    ->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('donor_name')
                    ->label('Nama Donatur')
                    ->getStateUsing(function ($record) {
                        return empty(trim($record->donor_name))
                            ? ($record->user?->name ?? 'Dancok')
                            : $record->donor_name;
                    })
                    ->searchable(),


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
                    'sd' => 'SD',
                    'smp' => 'SMP',
                ])->searchable(),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('Download')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('danger')
                        ->url(fn($record) => route('donations.pdf', $record))
                        ->openUrlInNewTab(),
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
            'index' => Pages\ListDonationYayasans::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            ->where('type', 'yys')->with('user');
    }
}
