<?php

    namespace App\Livewire\Auth;

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Validation\ValidationException;
    use Livewire\Attributes\Layout;
    use Livewire\Component;

    #[Layout('layouts.app')]
    class ConfirmPassword extends Component
    {
        public string $password = '';
        public bool $confirmed = false;

        protected $listeners = ['passwordConfirmed' => 'markAsConfirmed'];

        public function markAsConfirmed(): void
        {
            $this->confirmed = true;
        }

        /**
         * @throws \Illuminate\Validation\ValidationException
         */
        public function confirmPassword()
        {
            $this->validate([
                'password' => 'required|string',
            ]);

            if (!Hash::check($this->password, Auth::user()->password)) {
                throw ValidationException::withMessages([
                    'password' => [__('This password does not match our records.')],
                ]);
            }

            session()->put('auth.password_confirmed_at', time());
            $this->confirmed = true;
            return redirect()->intended();
        }

        public function render()
        {
            return view('livewire.auth.confirm-password');
        }
    }
