@props([
    'id',
    'name',
    'label'
])

<div {{ $attributes->merge(['class' => 'flex space-x-2 items-center']) }}>
    <input class="rounded-sm size-4 checked:bg-primary-600 focus:text-white focus:border-primary-600 focus:ring-primary-100 focus:ring-2 ring-offset-2 disabled:bg-primary-100" type="checkbox" wire:model="{{$id}}" name="{{$id}}"
           id="{{$id}}">
    <label for="{{$id}}"><span class="select-none">{{ $slot }}</span></label>
</div>
