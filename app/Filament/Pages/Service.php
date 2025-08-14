<?php

namespace App\Filament\Pages;

use App\Models\Boom;
use App\Models\Doa;
use App\Models\Fa;
use App\Models\Ir;
use App\Models\Mog;
use App\Models\Rbi;
use App\Models\Wbi;
use App\Models\Wn;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Components\Wizard;
use Filament\Notifications\Notification;
use Filament\Support\Enums\Alignment;

class Service extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    protected static ?string $navigationLabel = 'Service';

    protected static ?string $navigationGroup = 'Web';

    protected static string $view = 'filament.pages.service';

    public ?array $data = [];

    public Boom $recordBoom;
    public Fa $recordFa;
    public Doa $recordDoa;
    public Mog $recordMog;
    public Rbi $recordRbi;
    public Ir $recordIr;
    public Wbi $recordWbi;
    public Wn $recordWn;

    public function mount(): void
    {
        $this->recordBoom = Boom::first();
        $this->recordFa = Fa::first();
        $this->recordDoa = Doa::first();
        $this->recordMog = Mog::first();
        $this->recordRbi = Rbi::first();
        $this->recordIr = Ir::first();
        $this->recordWbi = Wbi::first();
        $this->recordWn = Wn::first();

        $this->form->fill([
            'booms_thumbnail'     => $this->recordBoom->thumbnail,
            'booms_description'   => $this->recordBoom->description,
            'doas_thumbnail'      => $this->recordDoa->thumbnail,
            'doas_description'    => $this->recordDoa->description,
            'fas_thumbnail'       => $this->recordFa->thumbnail,
            'fas_description'     => $this->recordFa->description,
            'mogs_thumbnail'      => $this->recordMog->thumbnail,
            'mogs_description'    => $this->recordMog->description,
            'rbis_thumbnail'      => $this->recordRbi->thumbnail,
            'rbis_description'    => $this->recordRbi->description,
            'irs_thumbnail'       => $this->recordIr->thumbnail,
            'irs_description'     => $this->recordIr->description,
            'wbis_thumbnail'      => $this->recordWbi->thumbnail,
            'wbis_description'    => $this->recordWbi->description,
            'wns_thumbnail'       => $this->recordWn->thumbnail,
            'wns_description'     => $this->recordWn->description,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('BOOM')
                        ->schema([
                            Forms\Components\FileUpload::make('booms_thumbnail')
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
                            Forms\Components\RichEditor::make('booms_description')
                                ->label('Description')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                ])
                                ->columnSpanFull(),
                        ]),
                    Wizard\Step::make('DOA')
                        ->schema([
                            Forms\Components\FileUpload::make('doas_thumbnail')
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
                            Forms\Components\RichEditor::make('doas_description')
                                ->label('Description')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                ])
                                ->columnSpanFull(),
                        ]),
                    Wizard\Step::make('FA')
                        ->schema([
                            Forms\Components\FileUpload::make('fas_thumbnail')
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
                            Forms\Components\RichEditor::make('fas_description')
                                ->label('Description')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                ])
                                ->columnSpanFull(),
                        ]),
                    Wizard\Step::make('MOG')
                        ->schema([
                            Forms\Components\FileUpload::make('mogs_thumbnail')
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
                            Forms\Components\RichEditor::make('mogs_description')
                                ->label('Description')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                ])
                                ->columnSpanFull(),
                        ]),
                    Wizard\Step::make('RBI')
                        ->schema([
                            Forms\Components\FileUpload::make('rbis_thumbnail')
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
                            Forms\Components\RichEditor::make('rbis_description')
                                ->label('Description')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                ])
                                ->columnSpanFull(),
                        ]),
                    Wizard\Step::make('IR')
                        ->schema([
                            Forms\Components\FileUpload::make('irs_thumbnail')
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
                            Forms\Components\RichEditor::make('irs_description')
                                ->label('Description')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                ])
                                ->columnSpanFull(),
                        ]),
                    Wizard\Step::make('WBI')
                        ->schema([
                            Forms\Components\FileUpload::make('wbis_thumbnail')
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
                            Forms\Components\RichEditor::make('wbis_description')
                                ->label('Description')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                ])
                                ->columnSpanFull(),
                        ]),
                    Wizard\Step::make('WN')
                        ->schema([
                            Forms\Components\FileUpload::make('wns_thumbnail')
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
                            Forms\Components\RichEditor::make('wns_description')
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

        $this->recordBoom->update([
            'thumbnail'   => $data['booms_thumbnail'] ?? null,
            'description' => $data['booms_description'] ?? null,
        ]);

        $this->recordDoa->update([
            'thumbnail'   => $data['doas_thumbnail'] ?? null,
            'description' => $data['doas_description'] ?? null,
        ]);

        $this->recordFa->update([
            'thumbnail'   => $data['fas_thumbnail'] ?? null,
            'description' => $data['fas_description'] ?? null,
        ]);

        $this->recordMog->update([
            'thumbnail'   => $data['mogs_thumbnail'] ?? null,
            'description' => $data['mogs_description'] ?? null,
        ]);

        $this->recordRbi->update([
            'thumbnail'   => $data['rbis_thumbnail'] ?? null,
            'description' => $data['rbis_description'] ?? null,
        ]);

        $this->recordIr->update([
            'thumbnail'   => $data['irs_thumbnail'] ?? null,
            'description' => $data['irs_description'] ?? null,
        ]);

        $this->recordWbi->update([
            'thumbnail'   => $data['wbis_thumbnail'] ?? null,
            'description' => $data['wbis_description'] ?? null,
        ]);

        $this->recordWn->update([
            'thumbnail'   => $data['wns_thumbnail'] ?? null,
            'description' => $data['wns_description'] ?? null,
        ]);

        // lanjut untuk Mog, Rbi, Ir, Wbi, Wn...

        Notification::make()
            ->title('Data berhasil disimpan')
            ->success()
            ->send();
    }
}
