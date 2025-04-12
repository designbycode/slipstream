@props([
    'id',
    'name',
    'label'
])

<div {{ $attributes->merge(['class' => 'flex space-x-2 items-center']) }}>
    <input class="rounded-sm size-4 focus:ring-indigo-600 text-indigo-600 border-indigo-300" type="checkbox" wire:model="{{$id}}" name="{{$id}}" id="{{$id}}">
    <label for="{{$id}}"><span class="select-none">{{ $slot }}</span></label>
</div>
