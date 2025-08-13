<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeddingFormResource\Pages;
use App\Filament\Resources\WeddingFormResource\RelationManagers;
use App\Models\Wedding;
use App\Models\WeddingForm;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ActionGroup;


class WeddingFormResource extends Resource
{
    protected static ?string $model = Wedding::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Wedding';

    protected static ?string $navigationGroup = 'Formulir';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Nama Jemaat')
                            ->relationship('user', 'name')
                            ->preload()
                            ->searchable()
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('groom_name')
                            ->label('Nama Mempelai Pria')
                            ->maxLength(255)
                            ->default(null)
                            ->required(),
                        Forms\Components\TextInput::make('bride_name')
                            ->label('Nama Mempelai Wanita')
                            ->maxLength(255)
                            ->default(null)
                            ->required(),
                        Forms\Components\DatePicker::make('wedding_date')->required(),
                        Forms\Components\TextInput::make('wedding_location')
                            ->maxLength(255)
                            ->default(null)
                            ->required(),
                        Forms\Components\FileUpload::make('prewedding_photo')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->directory('wedding')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected'
                            ])
                            ->default('pending')
                            ->preload()
                            ->searchable()
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('groom_name')
                    ->label('Nama Mempelai Pria')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bride_name')
                    ->label('Nama Mempelai Wanita')
                    ->searchable(),
                Tables\Columns\TextColumn::make('wedding_date')
                    ->label('Nama Mempelai Wanita')
                    ->searchable(),
                Tables\Columns\TextColumn::make('wedding_location')
                    ->label('Lokasi Pernikahan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(function ($state) {
                        return match ($state) {
                            'pending'  => 'warning',
                            'approved' => 'success',
                            'rejected' => 'danger',
                            default => 'secondary',
                        };
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'pending' => 'Pending',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected'
                ])->searchable(),
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
            'index' => Pages\ListWeddingForms::route('/'),
            // 'create' => Pages\CreateWeddingForm::route('/create'),
            // 'edit' => Pages\EditWeddingForm::route('/{record}/edit'),
        ];
    }
}
