<div class="max-w-md mx-auto my-20">
    <x-form.card>
        <x-form wire:submit.prevent="resetPassword">
            <x-form.header
                title="Change Password"
                description="Create a new password for your account"
            />
            <x-form.input type="hidden" id="token" wire:model="token" name="token"/>
            <x-form.input type="hidden" id="email" wire:model="email" name="email"/>


            <x-form.section>
                <x-form.label for="password">Password</x-form.label>
                <x-form.input type="password" id="password" wire:model="password" name="password" autofocus/>
                <x-form.error for="password"/>
            </x-form.section>

            <x-form.section>
                <x-form.label for="password_confirmation">Password Confirmation</x-form.label>
                <x-form.input type="password" id="password_confirmation" wire:model="password_confirmation" name="password_confirmation"/>
            </x-form.section>

            <x-form.section>
                <x-button>Change Password</x-button>
            </x-form.section>
        </x-form>
    </x-form.card>
</div>
