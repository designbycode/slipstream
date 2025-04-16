<?php

    namespace App\Livewire\Profile;

    use App\Actions\Fortify\PasswordValidationRules;
    use App\Actions\Fortify\UpdateUserProfileInformation;
    use App\Models\User;
    use Illuminate\Support\Facades\App;
    use Illuminate\Validation\Rule;
    use Illuminate\View\View;
    use Livewire\Component;

    class UpdateUserProfile extends Component
    {

        use PasswordValidationRules;

        public ?User $user;
        public ?string $name;
        public ?string $email;

        public bool $loading = false;

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
        public function update(): void
        {
            $validated = $this->validate();
            App::make(UpdateUserProfileInformation::class)->update($this->user, $validated);
            $this->dispatch('saved'); // Dispatch browser event
        }

        public function render(): View
        {
            return view('livewire.profile.update-user-profile');
        }
    }
