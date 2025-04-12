<?php

    namespace App\Livewire\Auth;

    use App\Actions\Fortify\PasswordValidationRules;
    use Illuminate\Auth\Events\PasswordReset;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Password;
    use Illuminate\View\View;
    use Livewire\Attributes\Layout;
    use Livewire\Component;

    #[Layout('layouts.app')]
    class ResetPassword extends Component
    {
        use PasswordValidationRules;

        public ?string $token;
        public ?string $email;
        public ?string $password;
        public ?string $password_confirmation;

        public function mount(): void
        {
            $this->token = request()->route('token');
            $this->email = request()->email;
        }

        public function resetPassword()
        {

            $this->resetErrorBag();
            $this->resetValidation();
            $this->validate();

            $status = Password::reset(
                [
                    'email' => $this->email,
                    'password' => $this->password,
                    'password_confirmation' => $this->password_confirmation,
                    'token' => $this->token,
                ],
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->save();

                    event(new PasswordReset($user));
                }
            );

            if ($status === Password::PASSWORD_RESET) {
                $this->resetPassword(['password', 'password_confirmation']);
                return redirect()->route('login')->with('status', __($status));
            }


        }

        public function render(): View
        {
            return view('livewire.auth.reset-password');
        }

        protected function rules(): array
        {
            return [
                'token' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'password' => $this->passwordRules(),

            ];
        }
    }
