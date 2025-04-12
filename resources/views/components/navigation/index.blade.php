<nav class="bg-white w-full shadow-sm  flex items-center">
    <headless-navigation class="wrapper block my-4">
        <div class="flex justify-between items-center">
            <a wire:navigate.hover id="logo" class="text-xl md:text-2xl grad font-black nav-button nav-button-active inline-flex " href="{{ route('home') }}">{{ config('app.name') }}</a>
            <div class="flex items-center">
                <div class="lg:flex space-x-2 items-center hidden mr-4">
                    <a wire:navigate.hover class="px-2 py-1 text-sm hover:bg-gray-200 rounded-md" href="{{ route("home") }}">Home</a>
                    @guest
                        <a wire:navigate.hover class="px-2 py-1 text-sm hover:bg-gray-200 rounded-md" href="{{ route("login") }}">Login</a>
                        <a wire:navigate.hover class="px-2 py-1 text-sm hover:bg-gray-200 rounded-md" href="{{ route("register") }}">Register</a>
                    @else
                        <a wire:navigate.hover class="px-2 py-1 text-sm hover:bg-gray-200 rounded-md" href="{{ route("dashboard.index") }}">Dashboard</a>
                        <headless-dropdown class="relative" popper placement="bottom-end bottom-end" offset="30 15">
                            <button
                                type="button"
                                aria-expanded="false"
                                aria-haspopup="true"
                                id="menu-profile"
                                class="flex items-center space-x-1.5">
                                <img class="size-8 rounded-full" src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}">
                                <span class="text-sm">{{ auth()->user()->name }}</span>
                            </button>
                            <div hidden class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black/10 ring-opacity-5 divide-y divide-gray-100 focus:outline-none"
                                 aria-labelledby="menu-profile"
                                 aria-orientation="vertical"
                                 role="none"
                            >
                                <div class="px-4 py-3" role="none">
                                    <p class="text-sm" role="none">Signed in as</p>
                                    <p class="text-sm font-medium text-gray-900 truncate" role="none">{{ auth()->user()->email }}</p>
                                </div>
                                <div class="py-1" role="none">
                                    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                    <a wire:navigate.hover
                                       href="{{ route("profile.index") }}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1">Profile</a>

                                </div>
                                <div class="py-1" role="none">
                                    <livewire:auth.logout.button/>
                                </div>
                            </div>
                </div>
                </headless-dropdown>
                @endguest
            </div>
            {{--                <x-theme-switcher/>--}}
            <button
                aria-controls="mobile_close"
                aria-expanded="false"
                @class([
                'lg:hidden focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-gray-900 rounded-md size-8 grid place-content-center
                '])
                type="button">
                <span class="sr-only">Open menu</span>
                <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path data-state class="inline-flex data-state-open:hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path data-state class="hidden data-state-open:inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        </div>
        <div hidden id="mobile_close" class="w-full flex flex-col mt-4 lg:hidden space-y-4 ">
            <a wire:navigate.hover class="px-2 py-1 w-full flex hover:bg-gray-200 rounded-md" href="{{ route("home") }}">Home</a>
            @guest
                <a wire:navigate.hover class="px-2 py-1 w-full flex hover:bg-gray-200 rounded-md" href="{{ route("login") }}">Login</a>
                <a wire:navigate.hover class="px-2 py-1 w-full flex hover:bg-gray-200 rounded-md" href="{{ route("register") }}">Register</a>
            @endguest
        </div>
    </headless-navigation>
</nav>
