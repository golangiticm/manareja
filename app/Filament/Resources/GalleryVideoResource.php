<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryVideoResource\Pages;
use App\Filament\Resources\GalleryVideoResource\RelationManagers;
use App\Models\GalleryVideo;
use App\Models\Program;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ActionGroup;


class GalleryVideoResource extends Resource
{
    protected static ?string $model = GalleryVideo::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    protected static ?string $navigationLabel = 'Video';

    protected static ?string $navigationGroup = 'Galeri Ibadah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\Select::make('eventable_id')
                            ->label('Jadwal Ibadah Terkait')
                            ->options(function () {
                                // Ambil data dari services dan programs, digabung manual
                                $services = Service::all()->pluck('title', 'id')->mapWithKeys(fn($title, $id) => [$id => $title]);
                                // $programs = Program::all()->pluck('title', 'id')->mapWithKeys(fn($title, $id) => ["program:$id" => "Program - $title"]);

                                // return $services->merge($programs)->toArray();
                                return $services;
                            })
                            ->reactive()
                            ->afterStateUpdated(function (callable $set, $state) {
                                $service = \App\Models\Service::find($state);
                                if ($service) {
                                    $set('title', $service->title);
                                } else {
                                    $set('title', null);
                                }
                            })
                            ->preload()
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('title')
                            ->readOnly()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Hidden::make('eventable_type')
                            ->default('service')
                            ->required(),
                        Forms\Components\TextInput::make('link')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('thumbnail')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->directory('galleries')
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_publish')
                            ->required(),
                    ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('eventable.title')
                    ->label('Jadwal Ibadah Terkait')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('link')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_publish')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->date()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('views')
                //     ->numeric()
                //     ->sortable(),
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
            'index' => Pages\ListGalleryVideos::route('/'),
            'create' => Pages\CreateGalleryVideo::route('/create'),
            'edit' => Pages\EditGalleryVideo::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])

            ->where('eventable_type', 'service');
    }
}
