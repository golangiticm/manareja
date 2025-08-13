<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CsrResource\Pages;
use App\Filament\Resources\CsrResource\RelationManagers;
use App\Models\Csr;
use App\Models\Program;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Wizard;
use Filament\Tables\Actions\ActionGroup;


class CsrResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationLabel = 'CSR';

    protected static ?string $navigationGroup = 'Jadwal Program';

    protected static ?string $modelLabel = 'CSR';

    protected static ?string $pluralModelLabel = 'Daftar CSR';

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
                                        ->default('CSR'),
                                    Forms\Components\TextInput::make('title')
                                        ->label('Judul Program')
                                        // ->maxLength(255)
                                        // ->default(fn($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord ? 'Program CSR' : null)
                                        // ->live(onBlur: true)
                                        // ->afterStateUpdated(function ($state, callable $set) {
                                        //     if ($state) {
                                        //         $set('announcement.title', $state);
                                        //     }
                                        // }),
                                        ->default('Program CSR'),
                                    Forms\Components\DatePicker::make('held_at')
                                        ->required(),
                                    Forms\Components\TimePicker::make('start_time'),
                                    Forms\Components\TimePicker::make('end_time'),
                                    Forms\Components\TextInput::make('location')
                                        ->maxLength(255)
                                        ->default(null),
                                ]),
                        ]),
                    Wizard\Step::make('Pengumuman')
                        ->icon('heroicon-m-megaphone')
                        ->schema([
                            Card::make()
                                ->relationship('announcement')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->required(),
                                    // ->dehydrated(true),
                                    Forms\Components\FileUpload::make('thumbnail')
                                        ->image()
                                        ->imageEditor()
                                        ->imageEditorAspectRatios([
                                            '16:9',
                                            '4:3',
                                            '1:1',
                                        ])
                                        ->directory('announcements')
                                        ->required(),
                                    Forms\Components\RichEditor::make('content')
                                        ->disableToolbarButtons([
                                            'attachFiles',
                                        ])
                                        ->required()
                                        ->columnSpanFull(),
                                    Forms\Components\DatePicker::make('published_at'),
                                    Forms\Components\Toggle::make('is_publish')
                                        ->required(),
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
            'index' => Pages\ListCsrs::route('/'),
            'create' => Pages\CreateCsr::route('/create'),
            'edit' => Pages\EditCsr::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            ->where('type', 'CSR');
    }
}
