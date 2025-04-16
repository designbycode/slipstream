<?php

    namespace App\Livewire\Profile;

    use App\Actions\Fortify\PasswordValidationRules;
    use App\Actions\Fortify\UpdateUserPassword as UpdatePassword;
    use Illuminate\Support\Facades\App;
    use Illuminate\View\View;
    use Livewire\Component;

    class UpdateUserPassword extends Component
    {
        use PasswordValidationRules;


        public string $current_password = "";
        public string $password = "";
        public string $password_confirmation = "";


        public function update(): void
        {
            $validated = $this->validate();
            App::make(UpdatePassword::class)->update(auth()->user(), $validated);
            $this->dispatch('saved');
            $this->reset(['current_password', 'password', 'password_confirmation']);
        }

        public function rules(): array
        {
            return [
                'current_password' => ['required', 'string', 'current_password:web'],
                'password' => $this->passwordRules(),
            ];
        }

        public function messages(): array
        {
            return [
                'current_password.current_password' => __('The provided password does not match your current password.'),
            ];
        }

        public function render(): View
        {
            return view('livewire.profile.update-user-password');
        }
    }
