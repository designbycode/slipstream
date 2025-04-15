<div>
    <!-- Current Profile Image -->
    @if($currentImage)
        <div class="mb-4">
            <img src="{{ $currentImage }}" alt="Current Profile Image" class="rounded-full h-32 w-32 object-cover">
        </div>
    @endif

    <!-- File Input -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Profile Photo</label>
        <input type="file" wire:model="photo" class="mt-1 block w-full" accept="image/*">
        @error('photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <!-- Cropper Modal -->
    @if($showCropper)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-2xl">
                <h3 class="text-lg font-medium mb-4">Crop Your Profile Image</h3>

                <div class="mb-4">
                    <img id="cropper-image" src="{{ $imagePreview }}" class="max-h-96 w-full">
                </div>

                <div class="flex justify-end space-x-2">
                    <button wire:click="cancelCrop" type="button" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button id="crop-button" type="button" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                        Crop & Save
                    </button>
                </div>
            </div>
        </div>

        @push('scripts')

            <script>
                document.addEventListener('livewire:load', function () {
                    const image = document.getElementById('cropper-image');
                    const cropper = new Cropper(image, {
                        aspectRatio: {{ $cropperAspectRatio }},
                        viewMode: 1,
                        autoCropArea: 0.8,
                        responsive: true,
                        guides: false
                    });

                    document.getElementById('crop-button').addEventListener('click', function () {
                        const canvas = cropper.getCroppedCanvas({
                            width: 800,
                            height: 800,
                            minWidth: 256,
                            minHeight: 256,
                            maxWidth: 4096,
                            maxHeight: 4096,
                            fillColor: '#fff',
                            imageSmoothingEnabled: true,
                            imageSmoothingQuality: 'high',
                        });

                        const croppedImage = canvas.toDataURL('image/png');
                        Livewire.emit('imageCropped', croppedImage);
                    });
                });
            </script>
        @endpush
    @endif
</div>
