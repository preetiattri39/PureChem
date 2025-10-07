<?php

namespace App\Livewire;

use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Joaopaulolndev\FilamentEditProfile\Concerns\HasSort;
use Filament\Forms\Components\TextInput;
use Joaopaulolndev\FilamentEditProfile\Concerns\HasUser;
use Filament\Notifications\Notification;

class AddressUserProfile extends Component implements HasForms
{
    use InteractsWithForms;
    use HasSort;
    use HasUser;

    public ?array $data = [];

    protected static int $sort = 15;

    public function mount(): void
    {
        $this->user = $this->getUser();
        $this->form->fill($this->user->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Address Details')
                    ->aside()
                    ->description('Update your address details.')
                    ->schema([
                        TextInput::make('company')
                            ->label('Company / Individual Name')
                            ->maxLength(255),

                        TextInput::make('city')
                            ->label('City')
                            ->maxLength(255),

                        TextInput::make('country')
                            ->label('Country')
                            ->maxLength(255),

                        TextInput::make('province')
                            ->label('Province')
                            ->maxLength(255),

                        TextInput::make('postal_code')
                            ->label('Postal Code')
                            ->maxLength(20),
                        ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $this->user->update($data);
        Notification::make()
            ->success()
            ->title('Address saved successfully!')
            ->send();
    }

    public function render(): View
    {
        return view('livewire.address-user-profile');
    }
}
