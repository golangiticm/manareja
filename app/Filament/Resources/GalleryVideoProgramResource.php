<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryVideoProgramResource\Pages;
use App\Filament\Resources\GalleryVideoProgramResource\RelationManagers;
use App\Models\GalleryVideo;
use App\Models\GalleryVideoProgram;
use App\Models\Program;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GalleryVideoProgramResource extends Resource
{
    protected static ?string $model = GalleryVideo::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    protected static ?string $navigationLabel = 'Video';

    protected static ?string $navigationGroup = 'Galeri Program';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\Select::make('eventable_id')
                            ->label('Program Terkait')
                            ->options(function () {
                                // Ambil data dari services dan programs, digabung manual
                                // $services = Service::all()->pluck('title', 'id')->mapWithKeys(fn($title, $id) => [$id => $title]);
                                $programs = Program::all()->pluck('title', 'id')->mapWithKeys(fn($title, $id) => [$id => $title]);

                                // return $services->merge($programs)->toArray();
                                return $programs;
                            })
                            ->reactive()
                            ->afterStateUpdated(function (callable $set, $state) {
                                $program = \App\Models\Program::find($state);
                                if ($program) {
                                    $set('title', $program->title);
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
                        Forms\Components\TextInput::make('link')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Hidden::make('eventable_type')
                            ->default('program')
                            ->required(),
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
                Tables\Columns\TextColumn::make('eventable_video.title')
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
                Tables\Columns\TextColumn::make('views')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListGalleryVideoPrograms::route('/'),
            'create' => Pages\CreateGalleryVideoProgram::route('/create'),
            'edit' => Pages\EditGalleryVideoProgram::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            ->where('eventable_type', 'program');
    }
}
