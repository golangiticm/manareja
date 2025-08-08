<?php

namespace App\Filament\Pages;

use App\Models\About as ModelsAbout;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Components\Wizard;
use Filament\Notifications\Notification;
use Filament\Support\Enums\Alignment;

class About extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationLabel = 'About';

    protected static ?string $navigationGroup = 'Web';

    protected static string $view = 'filament.pages.about';

    public ?array $data = [];

    public ModelsAbout $record;

    public function mount(): void
    {
        $this->record = ModelsAbout::first() ?? ModelsAbout::create();

        $this->form->fill([
            'thumbnail' => $this->record->thumbnail,
            'description' => $this->record->description,
            'visi' => $this->record->visi,
            'misi' => $this->record->misi,
            'images' => $this->record->images,
            'sejarah' => $this->record->sejarah,
            'avatar_kepala_gembala' => $this->record->avatar_kepala_gembala,
            'name_kepala_gembala' => $this->record->name_kepala_gembala,
            'kepala_divisi' => $this->record->kepala_divisi,
            'file' => $this->record->file,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('About')
                        ->schema([
                            Forms\Components\FileUpload::make('thumbnail')
                                ->label('thumbnail')
                                ->image()
                                ->directory('Athumbnail')
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    '31:9',
                                    '21:9',
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->default(null),
                            Forms\Components\RichEditor::make('description')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                ])
                                ->columnSpanFull(),
                        ]),
                    Wizard\Step::make('Visi & Misi')
                        ->schema([
                            Forms\Components\RichEditor::make('visi')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                ])
                                ->columnSpanFull(),
                            Forms\Components\RichEditor::make('misi')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                ])
                                ->columnSpanFull(),
                        ]),
                    Wizard\Step::make('Sejarah Singkat')
                        ->schema([
                            Forms\Components\FileUpload::make('images')
                                ->label('Foto Kenangan Gereja')
                                ->image()
                                ->directory('images')
                                ->imageEditor()
                                ->multiple()
                                ->imageEditorAspectRatios([
                                    '31:9',
                                    '21:9',
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->default(null),
                            Forms\Components\RichEditor::make('sejarah')
                                ->disableToolbarButtons([
                                    'attachFiles',
                                ])
                                ->columnSpanFull(),
                        ]),
                    Wizard\Step::make('Struktur Organisasi')
                        ->schema([
                            Forms\Components\FileUpload::make('file')
                                ->label('File PDF Struktur Organisasi')
                                ->acceptedFileTypes(['application/pdf'])
                                ->maxSize(4096) // dalam KB = 2MB
                                ->directory('documents/so') // path penyimpanan relatif ke disk
                                ->preserveFilenames(),
                            Forms\Components\FileUpload::make('avatar_kepala_gembala')
                                ->label('Foto Kepala Gembala')
                                ->image()
                                ->directory('SO')
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    '31:9',
                                    '21:9',
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->default(null),
                            Forms\Components\TextInput::make('name_kepala_gembala')
                                ->label('Nama Kepala Gembala'),

                            Forms\Components\Repeater::make('kepala_divisi')
                                ->label('Struktur Organisasi')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->label('Nama Divisi'),
                                    Forms\Components\TextInput::make('name')
                                        ->label('Nama Kepala Divisi'),
                                    Forms\Components\FileUpload::make('avatar')
                                        ->label('Foto Kepala Divisi')
                                        ->image()
                                        ->directory('SO')
                                        ->imageEditor()
                                        ->imageEditorAspectRatios(['1:1', '4:3', '16:9'])
                                        ->columnSpanFull(),
                                    Forms\Components\Repeater::make('dept')
                                        ->label('Departemen')
                                        ->schema([
                                            Forms\Components\TextInput::make('title')->label('Nama Dept')->required(),
                                            Forms\Components\TextInput::make('name')->label('Ketua Dept')->required(),
                                        ])
                                        ->columnSpanFull()
                                        ->defaultItems(0)
                                        ->addActionAlignment(Alignment::End)
                                        ->minItems(0)
                                        ->collapsible()
                                ])
                                ->columns(2)
                                ->collapsible()
                        ]),
                ])
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update([
            'thumbnail' => $data['thumbnail'],
            'description' => $data['description'],
            'visi' => $data['visi'],
            'misi' => $data['misi'],
            'images' => $data['images'],
            'sejarah' => $data['sejarah'],
            'avatar_kepala_gembala' => $data['avatar_kepala_gembala'],
            'name_kepala_gembala' => $data['name_kepala_gembala'],
            'kepala_divisi' => $data['kepala_divisi'],
            'file' => $data['file'],
        ]);

        Notification::make()
            ->title('Berhasil disimpan!')
            ->success()
            ->send();
    }
}
