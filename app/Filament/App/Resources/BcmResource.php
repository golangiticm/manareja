<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\BcmResource\Pages;
use App\Filament\App\Resources\BcmResource\RelationManagers;
use App\Models\Bcm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Program;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Auth;

class BcmResource extends Resource
{
    protected static ?string $model = Bcm::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'BCM';

    protected static ?string $navigationGroup = 'Formulir';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\Hidden::make('user_id')
                            ->default(fn() => Auth::user()->id)
                            ->required(),

                        Forms\Components\Select::make('program_id')
                            ->label('Pilih Program')
                            ->options(function () {
                                return Program::where('type', 'BCM')
                                    ->orderBy('held_at', 'asc')
                                    ->get()
                                    ->mapWithKeys(function ($program) {
                                        return [
                                            $program->id => "{$program->title} - " . \Carbon\Carbon::parse($program->held_at)->translatedFormat('d F Y'),
                                        ];
                                    });
                            })
                            ->preload()
                            ->searchable()
                            ->required(),
                        // Forms\Components\Select::make('class_level')
                        //     ->label('Tingkatan Kelas')
                        //     ->options([
                        //         'pemula' => 'Pemula',
                        //         'lanjutan' => 'Lanjutan',
                        //     ])
                        //     ->required(),

                        // Forms\Components\Toggle::make('has_previous_bcm')
                        //     ->label('Sudah ikut BCM sebelumnya?'),

                        // Forms\Components\FileUpload::make('previous_bcm_certificate')
                        //     ->label('Upload Sertifikat BCM Sebelumnya')
                        //     ->visible(fn(callable $get) => $get('has_previous_bcm'))
                        //     ->directory('bcm-certificates'),

                        Forms\Components\Hidden::make('status')
                            ->default('pending')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('program.title')
                    ->label('Program')
                    ->searchable(),
                Tables\Columns\TextColumn::make('program.held_at')
                    ->label('Tanggal Acara')
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
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListBcms::route('/'),
            // 'create' => Pages\CreateBcm::route('/create'),
            // 'edit' => Pages\EditBcm::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            ->where('user_id', Auth::user()->id);
    }
}
