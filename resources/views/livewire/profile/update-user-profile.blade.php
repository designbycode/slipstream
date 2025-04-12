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
                @if($saved)
                    <div x-data="{ show: true }"
                         x-show="show"
                         x-init="
                        $watch('show', value => {
                            if (!value) @this.set('saved', false)
                        });
                        setTimeout(() => show = false, 1000);
                     "
                         class="italic text-gray-600 transition-opacity duration-300"
                         x-transition:leave="opacity-0">
                        Saved
                    </div>
                @endif
            </div>

        </x-form.section>
    </x-form>
</x-form.card>
