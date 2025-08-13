<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
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


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'Master User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),

                        Forms\Components\DateTimePicker::make('email_verified_at')
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->maxLength(255)
                            ->required(fn(string $context): bool => $context === 'create') // hanya wajib di create
                            ->hiddenOn('edit')
                            ->columnSpan(1), // sembunyikan di edit

                        Forms\Components\Select::make('officers')
                            ->label('Petugas')
                            ->relationship('officers', 'title')
                            ->preload()
                            ->multiple()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Select::make('groups')
                            ->label('Group')
                            ->relationship('groups', 'name')
                            ->preload()
                            ->multiple()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label(false)
                                    ->placeholder('Nama Group')
                                    ->prefixIcon('heroicon-o-tag')
                                    ->required()
                                    ->extraAttributes(['class' => 'no-star'])
                                    ->maxLength(255),
                                Forms\Components\Select::make('user_id')
                                    ->relationship('users', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->label(false)
                                    ->placeholder('Nama Pemimpin')
                                    ->prefixIcon('heroicon-o-user-circle')
                                    ->default(null),
                            ]),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TagsColumn::make('officers.title')
                    ->label('Officers')
                    ->separator(', ') // default sudah pakai koma
                    ->color('primary'), // batas jumlah badge yang ditampilkan (opsional)
                Tables\Columns\TagsColumn::make('groups.name')
                    ->label('Groups')
                    ->separator(', ') // default sudah pakai koma
                    ->color('primary'), // batas jumlah badge yang ditampilkan (opsional)
                Tables\Columns\IconColumn::make('is_admin')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
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
