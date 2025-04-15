<x-form.card class="shadow-red-500/25 !bg-red-50 border-red-500/50">
    <div class="space-y-2.5">
        <x-form.section>
            <h3 class="text-2xl font-semibold leading-none tracking-tight">Delete Account</h3>
            <p class="text-sm opacity-75 my-2">Permanently delete your account and all of its data.</p>
            <p class="text-sm opacity-75">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
        </x-form.section>
        <x-form.section>
            <div class="flex space-x-4 items-center">
                <x-button x-on:click="$wire.triggerModal" type="button" color="danger">DELETE ACCOUNT</x-button>
            </div>
        </x-form.section>
    </div>
</x-form.card>
