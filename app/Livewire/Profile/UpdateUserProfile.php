<?php

    namespace App\Livewire\Profile;

    use App\Actions\Fortify\PasswordValidationRules;
    use App\Actions\Fortify\UpdateUserProfileInformation;
    use App\Models\User;
    use Illuminate\Support\Facades\App;
    use Illuminate\Validation\Rule;
    use Livewire\Component;

    class UpdateUserProfile extends Component
    {

        use PasswordValidationRules;

        public ?User $user;
        public ?string $name;
        public ?string $email;

        public bool $saved = false;

        public function mount(): void
        {
            $this->user = auth()->user();
            $this->name = auth()->user()->name;
            $this->email = auth()->user()->email;
        }

        /**
         * @return array{email: string, password: string}
         */
        public function rules(): array
        {
            return [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id)],
            ];
        }


        /**
         * @return void
         * @throws \Illuminate\Validation\ValidationException
         */
        public function update()
        {
            $this->reset('saved');
            $validated = $this->validate();
            App::make(UpdateUserProfileInformation::class)->update($this->user, $validated);
            $this->saved = true;
            $this->dispatch('saved'); // Dispatch browser event
        }

        public function render()
        {
            return view('livewire.profile.update-user-profile');
        }
    }
