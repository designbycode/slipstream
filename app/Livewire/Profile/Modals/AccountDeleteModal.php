<?php

    namespace App\Livewire\Profile\Modals;

    use Illuminate\Http\RedirectResponse;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Validation\ValidationException;
    use Illuminate\View\View;
    use Livewire\Features\SupportRedirects\Redirector;
    use LivewireUI\Modal\ModalComponent;

    class AccountDeleteModal extends ModalComponent
    {

        public string $password = '';

        public static function modalMaxWidth(): string
        {
            return 'sm';
        }

        public function render(): View
        {
            return view('livewire.profile.modals.account-delete-modal');
        }

        /**
         * @throws \Illuminate\Validation\ValidationException
         */
        public function delete(): RedirectResponse|Redirector
        {
            $this->validate([
                'password' => 'required|string',
            ]);

            if (!Hash::check($this->password, Auth::user()->password)) {
                throw ValidationException::withMessages([
                    'password' => [__('This password does not match our records.')],
                ]);
            }

            auth()->user()->delete();

            session()->put('auth.password_confirmed_at', time());

            return redirect()->intended(route('home'));
        }
    }
