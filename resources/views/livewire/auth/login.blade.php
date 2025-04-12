<div class="max-w-md mx-auto my-20">
    <x-form.card>
        <x-form wire:submit.prevent="login">
            <x-form.header
                title="Login"
                description="Login into your account"
            />

            <x-form.section>
                <x-form.label for="email">Email</x-form.label>
                <x-form.input type="email" id="email" wire:model="email" name="email" autofocus/>
                <x-form.error for="email"/>
            </x-form.section>

            <x-form.section>
                <div class="flex justify-between">
                    <x-form.label for="password">Password</x-form.label>
                    <a wire:navigate.hover class="text-sm hover:underline " href="{{ route('password.request') }}">Forgot password</a>
                </div>
                <x-form.input type="password" id="password" wire:model="password" name="password"/>
                <x-form.error for="password"/>
            </x-form.section>
            <x-form.section>
                <x-form.checkbox id="remember" wire:model="remember" name="remember">
                    Remember me
                </x-form.checkbox>
            </x-form.section>


            <x-form.section>
                <x-button>Login</x-button>
            </x-form.section>
        </x-form>
    </x-form.card>
</div>
