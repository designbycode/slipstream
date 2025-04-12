<?php

    namespace App\Livewire\Auth;

    use App\Models\User;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Redirector;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\RateLimiter;
    use Illuminate\Support\Str;
    use Illuminate\View\View;
    use Livewire\Attributes\Layout;
    use Livewire\Component;


    #[Layout('layouts.app')]
    class Login extends Component
    {
        public string $email = '';
        public string $password = '';
        public bool $remember = false;

        /**
         * @return array{email: string, password: string}
         */
        public function rules(): array
        {
            return [
                'email' => 'required|email',
                'password' => 'required',
            ];
        }

        public function login(Request $request): RedirectResponse|Redirector|null
        {

            $this->resetValidation();
            $this->resetErrorBag();
            $this->validate();

            // First check if the user exists
            $user = User::where('email', $this->email)->first();

            if (!$user) {
                $this->addError('email', __('passwords.user'));
                return null;
            }

            // Check if the user is rate limited
            if (RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
                $this->addError('email', message: __('auth.throttle', [
                    'seconds' => RateLimiter::availableIn($this->throttleKey()),
                ]));
                return null;
            }

            // Attempt login
            if (!Auth::attempt([
                'email' => $this->email,
                'password' => $this->password,
            ], $this->remember)) {
                RateLimiter::hit($this->throttleKey());
                $this->addError('email', __('auth.failed'));
                return null;
            }

            // Clear login attempts
            RateLimiter::clear($this->throttleKey());
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard.index'));
        }

        protected function throttleKey(): string
        {
            return Str::lower($this->email) . '|' . request()->ip();
        }


        /**
         * @return \Illuminate\View\View
         */
        public function render(): View
        {
            return view('livewire.auth.login');
        }
    }
