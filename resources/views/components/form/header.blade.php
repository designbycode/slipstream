@props([
    'title' => '',
    'description' => '',
])

<div {{ $attributes->merge(['class' => 'space-y-0 my-2']) }}>
    <p class="text-2xl font-semibold">{{ $title }}</p>
    @if($description)
        <p class="text-sm leading-loose ">{{ $description }}</p>
    @endif
</div>
