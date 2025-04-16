<?php

    namespace App\Livewire\Profile;

    use Illuminate\View\View;
    use Livewire\Component;

    class AccountDeletion extends Component
    {
        public function triggerModal(): void
        {
            $this->dispatch('openModal', 'profile.modals.account-delete-modal');
        }

        public function render(): View
        {
            return view('livewire.profile.account-deletion');
        }
    }
