<?php

    namespace App\Livewire\Profile;

    use App\Actions\Fortify\PasswordValidationRules;
    use App\Actions\Fortify\UpdateUserProfileInformation;
    use App\Models\User;
    use Illuminate\Support\Facades\App;
    use Illuminate\Validation\Rule;
    use Illuminate\View\View;
    use Livewire\Attributes\On;
    use Livewire\Component;
    use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

    class UpdateUserProfile extends Component
    {

        use PasswordValidationRules;

        public ?User $user;
        public ?string $name;
        public ?string $email;
        public ?TemporaryUploadedFile $profile_photo;

        public bool $saved = false;

        public function mount(): void
        {
            $this->user = auth()->user();
            $this->name = auth()->user()->name;
            $this->email = auth()->user()->email;
        }

        /**
         * @return array{email: string, password: string}
         */
        public function rules(): array
        {
            return [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id)],

            ];
        }


        /**
         * @return void
         * @throws \Illuminate\Validation\ValidationException
         */
        public function update(): void
        {
            $this->reset('saved');
            $validated = $this->validate();

            App::make(UpdateUserProfileInformation::class)->update($this->user, $validated);

            $this->saved = true;
            $this->dispatch('saved'); // Dispatch browser event
        }

        #[On('profilePhoto')]
        public function setProfilePhoto($profilePhotoUrl): void
        {
            $this->profile_photo = new TemporaryUploadedFile($profilePhotoUrl, config('filesystems.default'));

            dd($this->profile_photo);
        }


        public function render(): View
        {
            return view('livewire.profile.update-user-profile');
        }
    }
