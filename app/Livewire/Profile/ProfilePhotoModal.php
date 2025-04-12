<?php

    namespace App\Livewire\Profile;

    use Illuminate\View\View;
    use LivewireUI\Modal\ModalComponent;

    class ProfilePhotoModal extends ModalComponent
    {

        public string $temporaryUrl;

        public static function closeModalOnClickAway(): bool
        {
            return false;
        }

        /**
         * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
         */
        public static function modalMaxWidth(): string
        {
            return 'sm';
        }


        public function render(): View
        {
            return view('livewire.profile.profile-photo-modal');
        }
    }
