<?php

    namespace App\Actions\Fortify;

    use App\Models\User;
    use Illuminate\Support\Facades\Hash;
    use Laravel\Fortify\Contracts\UpdatesUserPasswords;

    class UpdateUserPassword implements UpdatesUserPasswords
    {


        /**
         * Validate and update the user's password.
         *
         * @param array<string, string> $input
         */
        public function update(User $user, array $input): void
        {


            $user->forceFill([
                'password' => Hash::make($input['password']),
            ])->save();
        }
    }
