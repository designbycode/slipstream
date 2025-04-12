<?php

    namespace App\Livewire\Auth;

    use Illuminate\Support\Facades\Auth;
    use Illuminate\View\View;
    use Livewire\Attributes\Layout;
    use Livewire\Component;

    #[Layout('layouts.app')]
    class VerifyEmail extends Component
    {
        public bool $verificationSent = false;

        public function mount()
        {
            if (!Auth::check()) {
                return redirect()->to(route('login'));
            }

            if (Auth::user()->hasVerifiedEmail()) {
                return redirect()->to(config('fortify.home'));
            }
        }

        /**
         * @return \Illuminate\Http\RedirectResponse|void
         */
        public function resendVerificationEmail()
        {
            if (Auth::user()->hasVerifiedEmail()) {
                return redirect()->to(config('fortify.home'));
            }

            Auth::user()->sendEmailVerificationNotification();

            $this->verificationSent = true;
        }

        /**
         * @return \Illuminate\Http\RedirectResponse|void
         */
        public function checkVerification()
        {
            Auth::user()->refresh();

            if (Auth::user()->hasVerifiedEmail()) {
                return redirect()->to(config('fortify.home'));
            }
        }


        public function render(): View
        {
            return view('livewire.auth.verify-email');
        }
    }
