<div class="max-w-md mx-auto my-20">

    <x-form.card>
        <x-form wire:submit.prevent="resetPassword">
            <x-form.header
                title="Request Password Reset"
                description="Forgot you password? Now problem. Request a new password."
            />
            @session('success')
            <x-alert.success>
                {{ session('success') }}
            </x-alert.success>
            @endsession

            <x-form.section>
                <x-form.label for="email">Email</x-form.label>
                <x-form.input type="email" id="email" wire:model="email" name="email" autofocus/>
                <x-form.error for="email"/>
            </x-form.section>


            <x-form.section>
                <x-button>Request Password Reset</x-button>
            </x-form.section>
        </x-form>
    </x-form.card>

</div>
