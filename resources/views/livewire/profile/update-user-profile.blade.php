<x-form.card>
    <x-form wire:submit.prevent="update">

        <x-form.section>
            <x-form.label for="name">Name</x-form.label>
            <x-form.input type="text" id="name" wire:model="name" name="name"/>
            <x-form.error for="name"/>
        </x-form.section>

        <x-form.section>
            <x-form.label for="email">Email</x-form.label>
            <x-form.input type="email" id="email" wire:model="email" name="email"/>
            <x-form.error for="email"/>
        </x-form.section>


        <x-form.section>
            <div class="flex space-x-4 items-center">
                <x-button>Save</x-button>
                <x-form.saved :$saved/>
            </div>

        </x-form.section>
    </x-form>
</x-form.card>
