<div class="flex space-x-3 items-center mb-2">


    <label for="profile_photo_url">

        <img class="size-16 rounded-full object-cover" src="{{ $croppedBlob ??  ($image?->temporaryUrl() ?? $model->profilePhotoUrl()) }}" alt="image">
    </label>
    <input type="file" name="profile_photo_url" id="profile_photo_url" wire:model="image">
</div>
