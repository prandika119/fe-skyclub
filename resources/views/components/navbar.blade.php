<nav class="bg-white shadow-lg py-2 fixed top-0 left-0 w-full z-50" x-data="{ isOpen: false, user: $store.user }" x-init="user.authCheck()">
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
                            <!-- Balance information -->
                            <svg width="20" height="16" viewBox="0 0 20 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 0C12.787 0 15.263 1.257 17.026 2.813C17.911 3.594 18.64 4.471 19.154 5.344C19.659 6.201 20 7.13 20 8C20 8.87 19.66 9.799 19.154 10.656C18.64 11.529 17.911 12.406 17.026 13.187C15.263 14.743 12.786 16 10 16C7.213 16 4.737 14.743 2.974 13.187C2.089 12.406 1.36 11.529 0.846 10.656C0.34 9.799 0 8.87 0 8C0 7.13 0.34 6.201 0.846 5.344C1.36 4.471 2.089 3.594 2.974 2.813C4.737 1.257 7.214 0 10 0ZM10 2C7.816 2 5.792 2.993 4.298 4.312C3.554 4.968 2.966 5.685 2.569 6.359C2.163 7.049 2 7.62 2 8C2 8.38 2.163 8.951 2.569 9.641C2.966 10.315 3.554 11.031 4.298 11.688C5.792 13.007 7.816 14 10 14C12.184 14 14.208 13.007 15.702 11.688C16.446 11.031 17.034 10.315 17.431 9.641C17.837 8.951 18 8.38 18 8C18 7.62 17.837 7.049 17.431 6.359C17.034 5.685 16.446 4.969 15.702 4.312C14.208 2.993 12.184 2 10 2ZM10 5C10.088 5 10.175 5.00367 10.261 5.011C10.0439 5.39185 9.95792 5.8335 10.0163 6.26798C10.0747 6.70246 10.2743 7.10572 10.5843 7.41571C10.8943 7.7257 11.2975 7.92525 11.732 7.98366C12.1665 8.04208 12.6081 7.95611 12.989 7.739C13.0416 8.34117 12.911 8.94518 12.6145 9.47189C12.3179 9.9986 11.8692 10.4234 11.327 10.6907C10.7849 10.958 10.1746 11.0553 9.57622 10.9699C8.97784 10.8844 8.41922 10.6202 7.97357 10.2118C7.52792 9.80343 7.21603 9.26995 7.07876 8.68129C6.94149 8.09262 6.98524 7.47621 7.20429 6.91284C7.42334 6.34946 7.80746 5.8654 8.30633 5.52407C8.8052 5.18274 9.39554 5.00008 10 5Z"
                                    fill="black" />
                            </svg>
                            <span class="font-semibold" x-text="$store.format.rupiah(user.data.wallet)">Rp
                                1.000.000</span>
                            <a href="/wallet"
                                class="relative flex items-center rounded-full p-1 text-black focus:outline-none">
                                <svg class="h-5 w-5 stroke-2 hover:text-red-600" viewBox="0 0 23 24" fill="none"
                                    stroke-width="1.5" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M18.0625 6.75V2.8125C18.0625 2.4644 17.9242 2.13056 17.6781 1.88442C17.4319 1.63828 17.0981 1.5 16.75 1.5H3.625C2.92881 1.5 2.26113 1.77656 1.76884 2.26884C1.27656 2.76113 1 3.42881 1 4.125M1 4.125C1 4.82119 1.27656 5.48887 1.76884 5.98116C2.26113 6.47344 2.92881 6.75 3.625 6.75H19.375C19.7231 6.75 20.0569 6.88828 20.3031 7.13442C20.5492 7.38056 20.6875 7.7144 20.6875 8.0625V12M1 4.125V19.875C1 20.5712 1.27656 21.2389 1.76884 21.7312C2.26113 22.2234 2.92881 22.5 3.625 22.5H19.375C19.7231 22.5 20.0569 22.3617 20.3031 22.1156C20.5492 21.8694 20.6875 21.5356 20.6875 21.1875V17.25"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M22 12V17.25H16.75C16.0538 17.25 15.3861 16.9734 14.8938 16.4812C14.4016 15.9889 14.125 15.3212 14.125 14.625C14.125 13.9288 14.4016 13.2611 14.8938 12.7688C15.3861 12.2766 16.0538 12 16.75 12H22Z"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>

                            <!-- Notifocation -->
                            <a href="/notification" class="relative rounded-full p-1 text-black focus:outline-none">
                                <span class="sr-only">View notifications</span>
                                <svg class="h-6 w-6 hover:text-red-600" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                </svg>
                                <span x-text="user.data.notif"
                                    class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                                    0?
                                </span>

                            </a>
                            <!-- Profile dropdown -->
                            <div class="relative ml-3 border-s-2 pl-3 border-red-600" x-data="{ isOpen: false }">
                                <div class="flex items-center space-x-2">
                                    <button type="button" @click="isOpen = !isOpen"
                                        class="relative flex max-w-xs items-center rounded-full text-sm "
                                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full"
                                            :src="user.data.profile_photo ? $store.storage.url + user.data.profile_photo :
                                                '/assets/images/profile.svg'"
                                            alt="">
                                        <span class="ml-2 font-semibold hover:text-red-600"
                                            x-text="user.data.name"></span>
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

                                    <a :href="user.data.role == 'admin' ? '/admin' : '/users/profile-user'"
                                        class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                        id="user-menu-item-0" x-show="user.authenticated">Your Profile</a>



                                    <form method="POST" id="logout" x-data="logoutHandler()"
                                        @submit.prevent="$store.user.clearUser(); window.location.href = '/'">
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
