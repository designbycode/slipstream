@props(['on'])

<div x-data="{ shown: false, timeout: null }"
     x-init="@this.on('{{ $on }}', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 1500); })"
     x-show.transition.out.opacity.duration.500ms="shown"
     x-transition:leave="opacity-0 translate-x-10"
     style="display: none;"
    {{ $attributes->merge(['class' => 'text-gray-400 text-sm transition translate-x-0 duration-300']) }}>
    {{ $slot->isEmpty() ? 'Saved.' : $slot }}
</div>
