<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KaderisasiFormResource\Pages;
use App\Filament\Resources\KaderisasiFormResource\RelationManagers;
use App\Models\Kaderisasi;
use App\Models\KaderisasiForm;
use App\Models\Officer;
use App\Models\Program;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ActionGroup;


class KaderisasiFormResource extends Resource
{
    protected static ?string $model = Kaderisasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Kaderisasi';

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
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('program_id')
                            ->label('Pilih Program')
                            ->options(function () {
                                return Program::where('type', 'KADERISASI')
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

                        Forms\Components\Select::make('desired_ministry')
                            ->label('Bidang yang diminati')
                            ->options(function () {
                                return \App\Models\Officer::all()
                                    ->mapWithKeys(fn($officer) => [
                                        $officer->title => $officer->title,
                                    ]);
                            })
                            ->searchable()
                            ->preload()
                            ->multiple()
                            ->columnSpanFull(),
                        Forms\Components\TextArea::make('experience')
                            ->maxLength(255)
                            ->default(null)
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextArea::make('motivation')
                            ->maxLength(255)
                            ->default(null)
                            ->required()
                            ->columnSpanFull(),

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

                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                            ])
                            ->default('pending')
                            ->required(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('program.title')
                    ->label('Program')
                    ->searchable(),
                Tables\Columns\TextColumn::make('program.held_at')
                    ->label('Tanggal Acara')
                    ->searchable(),
                Tables\Columns\TagsColumn::make('desired_ministry')
                    ->label('Bidang yang diminati')
                    ->separator(', ') // default sudah pakai koma
                    ->color('primary'), // batas jumlah badge yang ditampilkan (opsional)
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
            'index' => Pages\ListKaderisasiForms::route('/'),
            // 'create' => Pages\CreateKaderisasiForm::route('/create'),
            // 'edit' => Pages\EditKaderisasiForm::route('/{record}/edit'),
        ];
    }
}
