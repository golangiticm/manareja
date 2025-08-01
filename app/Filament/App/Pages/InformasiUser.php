<?php

namespace App\Filament\App\Pages;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Card;
use Filament\Notifications\Notification;

class InformasiUser extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static string $view = 'filament.app.pages.informasi-user';
    protected static ?string $title = 'Informasi User';

    public ?array $data = [];
    public User $record;

    public function mount(): void
    {
        $this->record = User::with('jemaat')->findOrFail(Auth::user()->id);

        if (!$this->record->jemaat) {
            $this->record->jemaat()->create(['user_id' => $this->record->id]);
        }

        $this->form->fill([
            'name' => $this->record->name,
            'email' => $this->record->email,
            'place_of_birth' => $this->record->jemaat?->place_of_birth,
            'date_of_birth' => $this->record->jemaat?->date_of_birth,
            'gender' => $this->record->jemaat?->gender,
            'address' => $this->record->jemaat?->address,
            'phone' => $this->record->jemaat?->phone,
            'photo' => $this->record->jemaat?->photo,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama')
                        ->required()
                        ->prefixIcon('heroicon-o-user-circle'),
                    Forms\Components\TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->prefixIcon('heroicon-o-envelope')
                        ->required(),

                    Forms\Components\TextInput::make('phone')
                        ->prefixIcon('heroicon-o-phone')
                        ->label(false)
                        ->tel()
                        ->mask('9999-9999-9999')
                        ->maxLength(20),
                    Forms\Components\TextInput::make('place_of_birth')
                        ->label(false)
                        ->placeholder('Tempat Lahir')
                        ->prefixIcon('heroicon-o-map-pin')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\DatePicker::make('date_of_birth')
                        ->label(false)
                        ->placeholder('Tanggal Lahir')
                        ->prefixIcon('heroicon-o-calendar')
                        ->native(false),
                    Forms\Components\Select::make('gender')
                        ->options([
                            'male' => 'male',
                            'female' => 'female',
                        ])
                        ->placeholder('Jenis Kelamin')
                        ->label(false)
                        ->prefixIcon('heroicon-o-adjustments-horizontal'),
                    Forms\Components\Textarea::make('address')
                        ->columnSpanFull(),
                    Forms\Components\FileUpload::make('photo')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '16:9',
                            '4:3',
                            '1:1',
                        ])
                        ->directory('jemaats')
                        ->columnSpanFull()
                        ->default(null),
                ])->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        $this->record->jemaat->update([
            'place_of_birth' => $data['place_of_birth'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'photo' => $data['photo'],
        ]);

        Notification::make()
            ->title('Berhasil disimpan!')
            ->success()
            ->send();
    }
}
