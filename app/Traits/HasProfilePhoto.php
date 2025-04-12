<?php

    namespace App\Traits;

    use Illuminate\Support\Facades\Storage;

    trait HasProfilePhoto
    {

        public function profilePhotoUrl(): string
        {
            if ($this->profile_photo_path) {
                return Storage::disk('local')->url($this->profile_photo_path);
            }
            return $this->defaultProfilePhotoUrl();
        }

        /**
         * @return string
         */
        protected function defaultProfilePhotoUrl(): string
        {
            return 'https://ui-avatars.com/api/?name=' . $this->name;
        }
    }
