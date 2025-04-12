<div class="max-w-md mx-auto my-20">
    <x-form.card>
        <x-form wire:submit.prevent="register">
            <x-form.header
                title="Register"
                description="Join our community by creating a account."
            />
            <x-form.section>
                <x-form.label for="name">Name</x-form.label>
                <x-form.input type="text" id="name" wire:model="name" name="name" autofocus/>
                <x-form.error for="name"/>
            </x-form.section>

            <x-form.section>
                <x-form.label for="email">Email</x-form.label>
                <x-form.input type="email" id="email" wire:model="email" name="email"/>
                <x-form.error for="email"/>
            </x-form.section>

            <x-form.section>
                <x-form.label for="password">Password</x-form.label>
                <x-form.input type="password" id="password" wire:model="password" name="password"/>
                <x-form.error for="password"/>
            </x-form.section>

            <x-form.section>
                <x-form.label for="password_confirmation">Password Confirmation</x-form.label>
                <x-form.input type="password" id="password_confirmation" wire:model="password_confirmation" name="password_confirmation"/>


            </x-form.section>

            <x-form.section>
                <x-form.checkbox id="terms" wire:model="terms" name="terms">
                    I accept the <a href="{{ route('home') }}" class="underline text-gray-900" target="_blank">Terms and Conditions</a>
                </x-form.checkbox>
                <x-form.error for="terms"/>
            </x-form.section>


            <x-form.section>
                <x-button>Register</x-button>
            </x-form.section>
        </x-form>

    </x-form.card>
</div>
