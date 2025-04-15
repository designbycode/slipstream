<?php

    namespace App\Livewire\Profile\Modals;

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Validation\ValidationException;
    use Illuminate\View\View;
    use LivewireUI\Modal\ModalComponent;

    class ConfirmPassword extends ModalComponent
    {

        public string $password = '';
        public string $title = 'Confirm Password';
        public string $description = 'Are you sure you want to delete all login sessions?';
        public string $button = 'DELETE';
        public string $action = 'deleteAction';

        public static function closeModalOnEscape(): bool
        {
            return false;
        }

        public static function closeModalOnClickAway(): bool
        {
            return false;
        }

        public static function modalMaxWidth(): string
        {
            return 'sm';
        }

        public function mount(array $data = []): void
        {
            if (isset($data['title'])) {
                $this->title = $data['title'];
            }
            if (isset($data['description'])) {
                $this->description = $data['description'];
            }
            if (isset($data['button'])) {
                $this->button = $data['button'];
            }
            if (isset($data['action'])) {
                $this->action = $data['action'];
            }
        }

        /**
         * @throws \Illuminate\Validation\ValidationException
         */
        public function confirmPassword(): void
        {
            $this->validate([
                'password' => 'required|string',
            ]);

            if (!Hash::check($this->password, Auth::user()->password)) {
                throw ValidationException::withMessages([
                    'password' => [__('This password does not match our records.')],
                ]);
            }

            $this->dispatch('password-confirmed', $this->password);
            $this->closeModal();
        }

        public function render(): View
        {
            return view('livewire.profile.modals.confirm-password');
        }
    }
