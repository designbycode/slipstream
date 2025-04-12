@props([
    'method' => 'post'
])

<form {{ $attributes->merge(['class' => 'space-y-2.5', 'method' => $method]) }} >
    {{ $slot }}
</form>
