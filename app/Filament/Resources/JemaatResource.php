<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JemaatResource\Pages;
use App\Filament\Resources\JemaatResource\RelationManagers;
use App\Models\Jemaat;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JemaatResource extends Resource
{
    protected static ?string $model = Jemaat::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Jemaat';

    protected static ?string $navigationGroup = 'Master User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('user_id')
                            ->required()
                            ->maxLength(36)
                            ->hiddenOn('edit'),
                        Forms\Components\TextInput::make('place_of_birth')
                            ->label(false)
                            ->placeholder('Tempat Lahir')
                            ->prefixIcon('heroicon-o-map-pin')
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\DatePicker::make('date_of_birth')
                            ->label(false)
                            ->placeholder('Tanggal Lahir')
                            ->prefixIcon('heroicon-o-calendar')
                            ->native(false),
                        Forms\Components\Select::make('gender')
                            ->options([
                                'male' => 'male',
                                'female' => 'female',
                            ])
                            ->placeholder('Jenis Kelamin')
                            ->label(false)
                            ->prefixIcon('heroicon-o-user-circle'),
                        Forms\Components\TextInput::make('phone')
                            ->prefixIcon('heroicon-o-phone')
                            ->label(false)
                            ->tel()
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\Textarea::make('address')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('photo')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->directory('jemaats')
                            ->default(null),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('place_of_birth')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('photo')
                    ->circular()
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
            'index' => Pages\ListJemaats::route('/'),
            'create' => Pages\CreateJemaat::route('/create'),
            'edit' => Pages\EditJemaat::route('/{record}/edit'),
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
