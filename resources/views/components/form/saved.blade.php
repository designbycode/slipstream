@props([
    'saved' => false
])

@if($saved)
    <div x-data="{ show: true }"
         x-show="show"
         x-init="
                        $watch('show', value => {
                            if (!value) @this.set('saved', false)
                        });
                        setTimeout(() => show = false, 1000);
                     "
         class=" text-gray-400 text-sm transition translate-x-0 duration-300"
         x-transition:leave="opacity-0 translate-x-10">
        Saved
    </div>
@endif
