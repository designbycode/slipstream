<?php

    namespace App\Livewire\Profile;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\View\View;
    use Livewire\Attributes\On;
    use Livewire\Attributes\Validate;
    use Livewire\Component;
    use Livewire\WithFileUploads;
    use Spatie\Image\Image;

    class PhotoUpload extends Component
    {

        use WithFileUploads;

        public Model $model;
        #[Validate('image|mimes:jpg,jpeg,png,gif,svg|max:2048')]
        public $image;
        public string $croppedBlob;


        #[On('croppedImageReady')]
        public function handleCroppedImage($croppedBlob, $cropRegion): void
        {
            Image::load($this->image->getRealPath())
                ->manualCrop($cropRegion['width'], $cropRegion['height'], $cropRegion['x'], $cropRegion['y'])
                ->save();

            $this->croppedBlob = $croppedBlob;

            $this->dispatch('profilePhoto', $this->image->getRealPath());

        }

        public function updatedImage(): void
        {
            $this->dispatch('openModal', 'profile.profile-photo-modal', [
                'temporaryUrl' => $this->image->temporaryUrl(),
            ]);
        }

        public function render(): View
        {
            return view('livewire.profile.photo-upload');
        }
    }
