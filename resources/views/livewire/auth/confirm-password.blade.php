<div class="max-w-md mx-auto my-20">
    @if (!$confirmed)
        <x-form.card>
            <x-form wire:submit.prevent="confirmPassword">
                <x-form.header
                    title="Confirm password"
                    description="For your security, please confirm your password to continue."
                />

                <x-form.section>
                    <div class="flex justify-between">
                        <x-form.label for="password">Password</x-form.label>
                        <a wire:navigate.hover class="text-sm hover:underline " href="{{ route('password.request') }}">Forgot password</a>
                    </div>
                    <x-form.input type="password" id="password" wire:model="password" name="password"/>
                    <x-form.error for="password"/>
                </x-form.section>


                <x-form.section>
                    <x-button>Login</x-button>
                </x-form.section>
            </x-form>
        </x-form.card>
    @else
        <div class="bg-green-50 border border-green-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">
                        {{ __('Password confirmed. You may continue.') }}
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>
