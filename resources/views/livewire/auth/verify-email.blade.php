<div class="max-w-md mx-auto my-20">
    <x-form.card>
        <div class="space-y-4">
            <h3 class="text-2xl font-semibold leading-none tracking-tight">Please verify your email address. </h3>
            <p class="text-sm opacity-75">
                We have sent an email to:
                <strong>{{ Auth::user()->email }}</strong>
            </p>


            @if ($verificationSent)
                <x-alert.success>
                    A new verification link has been sent to the email address you provided during registration.
                </x-alert.success>
            @endif

            <div class="flex items-center gap-4">
                <x-button class="flex-1" wire:loading.attr="disabled" wire:click="resendVerificationEmail">Resend Email</x-button>
                <x-button class="flex-1" wire:loading.attr="disabled" variant="ghost" wire:click="checkVerification">I've Verified My Email</x-button>
            </div>
        </div>
    </x-form.card>
</div>
