<div class="p-4 md:p-6 lg:p-8 shadow-red-500">
    <x-form wire:submit.prevent="delete">
        <x-form.header
            title="Delete Account"
            description="Are you sure you account"
        />

        <x-form.section>
            <x-form.label for="password">Password</x-form.label>
            <x-form.input type="password" id="password" wire:model="password" name="password"/>
            <x-form.error for="password"/>
        </x-form.section>


        <x-form.section>
            <div class="flex space-x-4">
                <x-button class="flex-1" color="danger">DELETE</x-button>
                <x-button wire:click="$dispatch('closeModal')" type="button" class="flex-1" variant="outline">Cancel</x-button>
            </div>

        </x-form.section>
    </x-form>
</div>
