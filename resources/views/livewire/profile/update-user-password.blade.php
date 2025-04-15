<x-form.card>
    <x-form wire:submit.prevent="update">

        <x-form.section>
            <x-form.label for="current_password">Current Password</x-form.label>
            <x-form.input type="password" id="current_password" wire:model="current_password" name="current_password"/>
            <x-form.error for="current_password"/>
        </x-form.section>

        <x-form.section>
            <x-form.label for="password">New password</x-form.label>
            <x-form.input type="password" id="password" wire:model="password" name="password"/>
            <x-form.error for="password"/>
        </x-form.section>
        <x-form.section>
            <x-form.label for="password_confirmation">Password Confirmation</x-form.label>
            <x-form.input type="password" id="password_confirmation" wire:model="password_confirmation" name="password_confirmation"/>

        </x-form.section>


        <x-form.section>
            <div class="flex space-x-4 items-center">
                <x-button>Save</x-button>
                <x-form.action-message on="saved"/>
            </div>

        </x-form.section>
    </x-form>
</x-form.card>
