<?php

namespace App\Filament\Pages;

use App\Models\Home as ModelsHome;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Components\Wizard;
use Filament\Notifications\Notification;

class Home extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationLabel = 'Home';

    protected static ?string $navigationGroup = 'Web';

    protected static string $view = 'filament.pages.home';

    public ?array $data = [];

    public ModelsHome $record;

    public function mount(): void
    {
        $this->record = ModelsHome::first() ?? ModelsHome::create();

        $this->form->fill([
            'hero' => $this->record->hero,
            'kalams' => $this->record->kalams,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Background Home')
                        ->schema([
                            Forms\Components\FileUpload::make('hero')
                                ->label('Background Home')
                                ->image()
                                ->directory('Heros')
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    '31:9',
                                    '21:9',
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->default(null),
                        ]),
                    Wizard\Step::make('Kalam')
                        ->schema([
                            Forms\Components\Repeater::make('kalams')
                                ->label('Kalam')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->required()
                                        ->maxLength(255)
                                        ->columnSpanFull(),
                                    Forms\Components\RichEditor::make('description')
                                        ->disableToolbarButtons([
                                            'attachFiles',
                                        ])
                                        ->columnSpanFull(),
                                    Forms\Components\Toggle::make('is_published')
                                        ->required(),
                                ])
                                ->collapsible(),
                        ]),
                ])
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update([
            'hero' => $data['hero'],
            'kalams' => $data['kalams'],
        ]);

        Notification::make()
            ->title('Berhasil disimpan!')
            ->success()
            ->send();
    }
}
