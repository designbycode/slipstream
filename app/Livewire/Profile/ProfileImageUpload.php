<?php

    namespace App\Livewire\Profile;

    use Exception;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\View\View;
    use Livewire\Component;
    use Livewire\WithFileUploads;

    class ProfileImageUpload extends Component
    {
        use WithFileUploads;

        public $photo;
        public $croppedImage;
        public $imagePreview;
        public bool $showCropper = false;
        public $cropperAspectRatio = 1; // 1:1 aspect ratio for profile images

        protected $listeners = ['imageCropped'];

        public function updatedPhoto(): void
        {
            $this->validate([
                'photo' => 'image|max:10240', // 10MB max
            ]);

            $this->imagePreview = $this->photo->temporaryUrl();
            $this->showCropper = true;
        }

        public function imageCropped($imageData): void
        {
            $this->croppedImage = $imageData;
            $this->showCropper = false;

            // Save the image
            $this->saveImage();
        }

        public function saveImage(): void
        {
            $this->validate([
                'croppedImage' => 'required',
            ]);

            try {
                $user = Auth::user();

                // Remove old profile image if exists
                $user->clearMediaCollection('profile');

                // Add new image
                $user->addMediaFromBase64($this->croppedImage)
                    ->usingFileName('profile-' . time() . '.png')
                    ->toMediaCollection('profile');

                $this->reset(['photo', 'croppedImage', 'imagePreview']);
                $this->dispatchBrowserEvent('notify', ['message' => 'Profile image updated successfully!']);

            } catch (Exception $e) {
                $this->dispatchBrowserEvent('notify', ['message' => 'Error: ' . $e->getMessage(), 'type' => 'error']);
            }
        }

        public function cancelCrop(): void
        {
            $this->reset(['photo', 'croppedImage', 'imagePreview', 'showCropper']);
        }

        public function render(): View
        {
            return view('livewire.profile.profile-image-upload', [
                'currentImage' => Auth::user()->getFirstMediaUrl('profile'),
            ]);
        }
    }
