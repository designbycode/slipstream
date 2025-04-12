<?php

    namespace App\Providers;

    use App\Actions\Fortify\CreateNewUser;
    use App\Actions\Fortify\ResetUserPassword;
    use App\Actions\Fortify\UpdateUserPassword;
    use App\Actions\Fortify\UpdateUserProfileInformation;
    use App\Livewire\Auth\Login;
    use App\Livewire\Auth\Register;
    use App\Livewire\Auth\RequestPassword;
    use App\Livewire\Auth\ResetPassword;
    use App\Livewire\Auth\VerifyEmail;
    use Illuminate\Cache\RateLimiting\Limit;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\RateLimiter;
    use Illuminate\Support\ServiceProvider;
    use Illuminate\Support\Str;
    use Laravel\Fortify\Fortify;

    class FortifyServiceProvider extends ServiceProvider
    {
        /**
         * Register any application services.
         */
        public function register(): void
        {
            //
        }

        /**
         * Bootstrap any application services.
         */
        public function boot(): void
        {
            Fortify::registerView(fn () => app()->call(Register::class));
            Fortify::loginView(fn () => app()->call(Login::class));
            Fortify::verifyEmailView(fn () => app()->call(VerifyEmail::class));
            Fortify::requestPasswordResetLinkView(fn () => app()->call(RequestPassword::class));
            Fortify::resetPasswordView(fn (Request $request) => app()->call(ResetPassword::class, ['request' => $request]));


            Fortify::createUsersUsing(CreateNewUser::class);
            Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
            Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
            Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

            RateLimiter::for('login', function (Request $request) {
                $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

                return Limit::perMinute(5)->by($throttleKey);
            });

            RateLimiter::for('two-factor', function (Request $request) {
                return Limit::perMinute(5)->by($request->session()->get('login.id'));
            });
        }
    }
