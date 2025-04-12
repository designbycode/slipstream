<?php

    namespace App\Livewire\Auth;

    use Illuminate\Http\RedirectResponse;
    use Illuminate\Support\Facades\Password;
    use Illuminate\View\View;
    use Livewire\Attributes\Layout;
    use Livewire\Component;


    #[Layout('layouts.app')]
    class RequestPassword extends Component
    {
        public string $email = '';


        /**
         * @return array{email: string}
         */
        public function rules(): array
        {
            return [
                'email' => 'required|email',
            ];
        }

        public function resetPassword(): RedirectResponse
        {

            $this->resetValidation();
            $this->resetErrorBag();
            $this->validate();

            $status = Password::sendResetLink(
                ['email' => $this->email]
            );

            return redirect()->back()->with('success', 'Password request successfully sent');
        }

        public function render(): View
        {
            return view('livewire.auth.request-password');
        }
    }
