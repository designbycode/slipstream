<x-app-layout>
    <div class="wrapper py-24">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 lg:gap-8">
            <!--Update Profile-->
            <div>
                <h3 class="text-2xl font-semibold leading-none tracking-tight">Profile Information</h3>
                <p class="text-sm opacity-75">Update your account's profile information and email address.</p>
            </div>
            <div class="md:col-span-2">
                <livewire:profile.update-user-profile/>
            </div>
            <!--Update Password-->
            <div>
                <h3 class="text-2xl font-semibold leading-none tracking-tight">Update Password</h3>
                <p class="text-sm opacity-75">Ensure your account is using a long, random password to stay secure.</p>
            </div>
            <div class="md:col-span-2">
                <livewire:profile.update-user-password/>
            </div>
            <!--Two Factor Authentication-->
            <div>
                <h3 class="text-2xl font-semibold leading-none tracking-tight">Two Factor Authentication</h3>
                <p class="text-sm opacity-75">Add additional security to your account using two factor authentication.</p>
            </div>
            <div class="md:col-span-2">
                <livewire:profile.two-factor/>
            </div>
            <!--browser sessiions-->
            <div>
                <h3 class="text-2xl font-semibold leading-none tracking-tight">Browser Sessions</h3>
                <p class="text-sm opacity-75 my-2">Manage and log out your active sessions on other browsers and devices.</p>
                <p class="text-sm opacity-75">If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you
                    feel your account has been compromised, you should also update your password.</p>
            </div>
            <div class="md:col-span-2">
                <livewire:profile.logout-other-browser-sessions-form/>
            </div>

            <!--delete account-->
            <div>

            </div>
            <div class="md:col-span-2">
                <livewire:profile.account-deletion/>
            </div>
        </div>
    </div>
</x-app-layout>
