<?php

namespace App\Filament\Pages;

use App\Models\SettingApp as ModelsSettingApp;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Components\Wizard;
use Filament\Notifications\Notification;


use Filament\Pages\Page;

class SettingApp extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Setting App';

    protected static string $view = 'filament.pages.setting-app';

    public ?array $data = [];

    public ModelsSettingApp $record;

    public function mount(): void
    {
        $this->record = ModelsSettingApp::first() ?? ModelsSettingApp::create();

        $this->form->fill([
            'site_name' => $this->record->site_name,
            'logo' => $this->record->logo,
            'address' => $this->record->address,
            'phones' => $this->record->phones,
            'emails' => $this->record->emails,
        ]);
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Inisialisasi Web')
                        ->schema([
                            Forms\Components\TextInput::make('site_name')
                                ->label('Nama Website'),

                            Forms\Components\FileUpload::make('logo')
                                ->label('Logo Website')
                                ->image()
                                ->directory('logos')
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->default(null),

                            Forms\Components\Textarea::make('address')
                                ->label('Alamat Website'),
                        ]),
                    Wizard\Step::make('Telephone')
                        ->schema([
                            Forms\Components\Repeater::make('phones')
                                ->label('Nomor Telepon')
                                ->schema([
                                    Forms\Components\TextInput::make('atas_nama')
                                        ->prefixIcon('heroicon-o-user-circle')
                                        ->required(),
                                    Forms\Components\TextInput::make('number')
                                        ->prefixIcon('heroicon-o-phone')
                                        ->label('Nomor')
                                        ->mask('9999-9999-9999')
                                        ->tel()
                                        ->required(),
                                ])->columns(2),
                        ]),
                    Wizard\Step::make('Email')
                        ->schema([
                            Forms\Components\Repeater::make('emails')
                                ->label('Email Kontak')
                                ->schema([
                                    Forms\Components\TextInput::make('atas_nama')
                                        ->prefixIcon('heroicon-o-user-circle')
                                        ->required(),
                                    Forms\Components\TextInput::make('email')
                                        ->prefixIcon('heroicon-o-envelope')
                                        ->label('Email')
                                        ->email(),
                                ])->columns(2),

                        ]),
                ])
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update([
            'site_name' => $data['site_name'],
            'logo' => $data['logo'],
            'address' => $data['address'],
            'phones' => $data['phones'],
            'emails' => $data['emails'],
        ]);

        Notification::make()
            ->title('Berhasil disimpan!')
            ->success()
            ->send();
    }
}
