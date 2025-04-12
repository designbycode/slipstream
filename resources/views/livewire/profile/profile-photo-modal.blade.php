<div
    class="p-4 md:p-6 lg:p-8"
    x-data="{
        cropper: null,
        cropRegion: null,
        dispatchCroppedImage() {
            this.cropper.getCroppedCanvas().toBlob((blob) => {
                 $dispatch('croppedImageReady', [URL.createObjectURL(blob), this.cropRegion])
                 @this.closeModal()
            })
        }
    }"
    x-init="
        $nextTick(() => {
            cropper = new Cropper($refs.image, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1,
                crop(event) {
                    cropRegion = {
                    x: event.detail.x,
                    y: event.detail.y,
                    width: event.detail.width,
                    height: event.detail.height
                    }
                }
            })
        })
"
>
    <div>
        <img class="w-full"
             src="{{ $temporaryUrl }}"
             alt="Temp image" x-ref="image">

    </div>
    <x-button class="mt-4 w-full" type="button" x-on:click="dispatchCroppedImage">Done</x-button>
</div>
