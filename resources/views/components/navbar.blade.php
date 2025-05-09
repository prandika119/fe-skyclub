<nav class="bg-white shadow-lg py-2" x-data="{ isOpen: false, user: $store.user }" x-init="user.authCheck()">
    <div class="mx-auto px-6 sm:px-6 lg:px-8 ">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <a class="flex-shrink-0" href="/">
                    <img src="{{ asset('assets/icons/logo.svg') }}" alt="Sky Club">
                </a>
            </div>
            <div class="hidden md:block">
                <div class="flex items-baseline space-x-4">
                    <x-navlink href="/field-schedule" :active="request()->is('field-schedule')">Jadwal Lapangan</x-navlink>
                    <x-navlink href="/sparing" :active="request()->is('sparing')">Sparing</x-navlink>
                    <x-navlink href="/article" :active="request()->is('article')">Artikel</x-navlink>
                </div>
            </div>

            <div class="hidden md:block">
                <div class="flex">
                    <template x-if="user.authenticated">
                        <div class="flex items-center space-x-3 self-center">
                            <a href="/notification" class="relative rounded-full p-1 text-black focus:outline-none">
                                <span class="sr-only">View notifications</span>
                                <svg class="h-6 w-6 hover:text-red-600" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                </svg>
                                <span
                                    class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                                    0?
                                </span>
                                {{-- @php
                                    $unreadNotificationsCount = Auth::user()->unreadNotifications->count();
                                @endphp
                                @if ($unreadNotificationsCount > 0)
                                    <span
                                        class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                                        {{ $unreadNotificationsCount }}
                                    </span>
                                @endif --}}
                            </a>
                            <!-- Profile dropdown -->
                            <div class="relative ml-3 border-s-2 pl-3 border-red-600" x-data="{ isOpen: false }">
                                <div class="flex items-center space-x-2">
                                    <button type="button" @click="isOpen = !isOpen"
                                        class="relative flex max-w-xs items-center rounded-full text-sm "
                                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full"
                                            :src="user.data.profile_photo ?? '/assets/icons/profile.png'"
                                            alt="">
                                        <span class="ml-2 font-semibold hover:text-red-600"
                                            x-text="user.data.name">auth()->user()->name</span>
                                    </button>
                                </div>
                                <div x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75 transform"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"q
                                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                    tabindex="-1">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                        tabindex="-1" id="user-menu-item-0">Your Profile</a>
                                    <form method="POST" id="logout" x-data="logoutHandler()"
                                        @submit.prevent="submitLogout">
                                        <button type="submit" class="block px-4 py-2 text-sm text-gray-700"
                                            role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </template>

                    {{-- UI if not authenticated --}}
                    <template x-if="!user.authenticated">
                        <div class="flex items-baseline space-x-2">
                            <a href="{{ route('login') }}"
                                class="rounded-md px-5 py-2 text-sm font-medium bg-gray-200 hover:bg-gray-300">Masuk</a>
                            <a href="{{ route('register') }}"
                                class="rounded-md px-5 py-2 text-sm font-medium bg-red-600 text-white hover:bg-red-800">Daftar</a>
                        </div>
                    </template>
                    {{-- @auth
                        <div class="flex items-center space-x-3 self-center">
                            <a href="/notification" class="relative rounded-full p-1 text-black focus:outline-none">
                                <span class="sr-only">View notifications</span>
                                <svg class="h-6 w-6 hover:text-red-600" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                </svg>
                                @php
                                    $unreadNotificationsCount = Auth::user()->unreadNotifications->count();
                                @endphp
                                @if ($unreadNotificationsCount > 0)
                                    <span
                                        class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                                        {{ $unreadNotificationsCount }}
                                    </span>
                                @endif
                            </a>
                            <!-- Profile dropdown -->
                            <div class="relative ml-3 border-s-2 pl-3 border-red-600" x-data="{ isOpen: false }">
                                <div class="flex items-center space-x-2">
                                    <button type="button" @click="isOpen = !isOpen"
                                        class="relative flex max-w-xs items-center rounded-full text-sm "
                                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->formattedProfilePhoto }}"
                                            alt="">
                                        <span
                                            class="ml-2 font-semibold hover:text-red-600">{{ auth()->user()->name }}</span>
                                    </button>
                                </div>
                                <div x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75 transform"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"q
                                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                    tabindex="-1">
                                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700"
                                        role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                            tabindex="-1" id="user-menu-item-2">Sign out</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex items-baseline space-x-2">
                            <a href="{{ route('auth.login') }}"
                                class="rounded-md px-5 py-2 text-sm font-medium bg-gray-200 hover:bg-gray-300">Masuk</a>
                            <a href="{{ route('auth.register') }}"
                                class="rounded-md px-5 py-2 text-sm font-medium bg-red-600 text-white hover:bg-red-800">Daftar</a>
                        </div>
                    @endauth --}}
                </div>
            </div>

            <div class="-mr-2 flex md:hidden">
                <!-- Mobile menu button -->
                <button type="button" @click="isOpen = !isOpen"
                    class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg :class="{ 'hidden': isOpen, 'block': !isOpen }" class="block h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg :class="{ 'block': isOpen, 'hidden': !isOpen }" class="hidden h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-show="isOpen" class="md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            <x-navlink href="/home" :active="request()->is('home')">Home</x-navlink>
            <x-navlink href="/posts" :active="request()->is('posts')">Posts</x-navlink>
            <x-navlink href="/contact" :active="request()->is('contact')">Contact</x-navlink>
            <x-navlink href="/about" :active="request()->is('about')">About</x-navlink>
        </div>
        <div class="border-t border-gray-700 pb-3 pt-4">
            <div class="flex items-center px-5">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full"
                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                        alt="">
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-white">Tom Cook</div>
                    <div class="text-sm font-medium text-gray-400">tom@example.com</div>
                </div>
            </div>
            <div class="mt-3 space-y-1 px-2">
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your
                    Profile</a>
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign
                    out</a>
            </div>
        </div>
    </div>
</nav>
