<?php

    namespace App\Livewire\Auth;

    use App\Actions\Fortify\CreateNewUser;
    use App\Actions\Fortify\PasswordValidationRules;
    use Illuminate\Auth\Events\Registered;
    use Illuminate\Support\Facades\App;
    use Illuminate\Validation\Rule;
    use Illuminate\View\View;
    use Livewire\Attributes\Layout;
    use Livewire\Component;


    #[Layout('layouts.app')]
    class Register extends Component
    {

        use PasswordValidationRules;

        public string $name = '';
        public string $email = '';
        public string $password = '';
        public string $password_confirmation = '';
        public bool $terms = false;


        protected array $messages = [
            'terms.accepted' => 'You must accept the terms and conditions',
            'terms.required' => 'You must accept the terms and conditions',
        ];

        public function register()
        {
            $this->resetErrorBag();
            $this->resetValidation();

            $data = $this->validate();
            // Resolve and call the Fortify action
            $user = App::make(CreateNewUser::class)->create($data);

            event(new Registered($user));

            // Do something with the created user (e.g. log them in)
            auth()->login($user);

            return redirect()->intended(route('dashboard.index'));
        }

        public function render(): View
        {
            return view('livewire.auth.register');
        }

        protected function rules(): array
        {
            return [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')],
                'password' => $this->passwordRules(),
                'terms' => ['accepted'],
            ];
        }
    }
