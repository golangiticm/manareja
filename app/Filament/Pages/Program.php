<?php

namespace App\Filament\Pages;

use App\Models\BaptismPage;
use App\Models\BcmPage;
use App\Models\CsrPage;
use App\Models\KaderisasiPage;
use App\Models\WeddingPage;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Components\Wizard;
use Filament\Notifications\Notification;

class Program extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationLabel = 'Program';

    protected static ?string $navigationGroup = 'Web';

    protected static string $view = 'filament.pages.program';

    public ?array $data = [];

    public BaptismPage $recordBaptism;

    public WeddingPage $recordWedding;

    public CsrPage $recordCsr;

    public KaderisasiPage $recordKaderisasi;

    public BcmPage $recordBcm;

    public function mount(): void
    {
        $this->recordBaptism = BaptismPage::first();
        $this->recordWedding = WeddingPage::first();
        $this->recordCsr = CsrPage::first();
        $this->recordKaderisasi = KaderisasiPage::first();
        $this->recordBcm = BcmPage::first();

        $this->form->fill([
            'baptism_thumbnail'     => $this->recordBaptism->thumbnail,
            'baptism_description'   => $this->recordBaptism->description,
            'wedding_thumbnail'      => $this->recordWedding->thumbnail,
            'wedding_description'    => $this->recordWedding->description,
            'csr_thumbnail'       => $this->recordCsr->thumbnail,
            'csr_description'     => $this->recordCsr->description,
            'kaderisasi_thumbnail'      => $this->recordKaderisasi->thumbnail,
            'kaderisasi_description'    => $this->recordKaderisasi->description,
            'bcm_thumbnail'      => $this->recordBcm->thumbnail,
            'bcm_description'    => $this->recordBcm->description,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Baptism')
                        ->schema([
                            Forms\Components\FileUpload::make('baptism_thumbnail')
                                ->label('Thumbnail')
                                ->image()
                                ->directory('images')
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    '31:9',
                                    '21:9',
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->default(null),
                            Forms\Components\RichEditor::make('baptism_description')
                                ->label('Description')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                ])
                                ->columnSpanFull(),
                        ]),
                    Wizard\Step::make('Wedding')
                        ->schema([
                            Forms\Components\FileUpload::make('wedding_thumbnail')
                                ->label('Thumbnail')
                                ->image()
                                ->directory('images')
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    '31:9',
                                    '21:9',
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->default(null),
                            Forms\Components\RichEditor::make('wedding_description')
                                ->label('Description')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                ])
                                ->columnSpanFull(),
                        ]),
                    Wizard\Step::make('CSR')
                        ->schema([
                            Forms\Components\FileUpload::make('csr_thumbnail')
                                ->label('Thumbnail')
                                ->image()
                                ->directory('images')
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    '31:9',
                                    '21:9',
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->default(null),
                            Forms\Components\RichEditor::make('csr_description')
                                ->label('Description')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                ])
                                ->columnSpanFull(),
                        ]),
                    Wizard\Step::make('Kaderisasi')
                        ->schema([
                            Forms\Components\FileUpload::make('kaderisasi_thumbnail')
                                ->label('Thumbnail')
                                ->image()
                                ->directory('images')
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    '31:9',
                                    '21:9',
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->default(null),
                            Forms\Components\RichEditor::make('kaderisasi_description')
                                ->label('Description')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                ])
                                ->columnSpanFull(),
                        ]),
                    Wizard\Step::make('BCM')
                        ->schema([
                            Forms\Components\FileUpload::make('bcm_thumbnail')
                                ->label('Thumbnail')
                                ->image()
                                ->directory('images')
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    '31:9',
                                    '21:9',
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->default(null),
                            Forms\Components\RichEditor::make('bcm_description')
                                ->label('Description')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                ])
                                ->columnSpanFull(),
                        ]),

                    // Lanjutkan untuk Mog, Rbi, Ir, Wbi, Wn...
                ])

            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->recordBaptism->update([
            'thumbnail'   => $data['baptism_thumbnail'] ?? null,
            'description' => $data['baptism_description'] ?? null,
        ]);

        $this->recordWedding->update([
            'thumbnail'   => $data['wedding_thumbnail'] ?? null,
            'description' => $data['wedding_description'] ?? null,
        ]);

        $this->recordCsr->update([
            'thumbnail'   => $data['csr_thumbnail'] ?? null,
            'description' => $data['csr_description'] ?? null,
        ]);

        $this->recordKaderisasi->update([
            'thumbnail'   => $data['kaderisasi_thumbnail'] ?? null,
            'description' => $data['kaderisasi_description'] ?? null,
        ]);

        $this->recordBcm->update([
            'thumbnail'   => $data['bcm_thumbnail'] ?? null,
            'description' => $data['bcm_description'] ?? null,
        ]);
        // lanjut untuk Mog, Rbi, Ir, Wbi, Wn...

        Notification::make()
            ->title('Data berhasil disimpan')
            ->success()
            ->send();
    }
}
