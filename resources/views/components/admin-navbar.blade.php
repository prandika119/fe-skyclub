<nav class="bg-white border-b border-gray-200 px-4 py-2.5 fixed left-0 right-0 top-0 z-40"
    x-data="{ user: $store.user }" x-init="user.authCheck()">
    <div class="flex flex-wrap justify-between items-center">
      <div class="flex justify-start items-center">
        <button
          data-drawer-target="drawer-navigation"
          data-drawer-toggle="drawer-navigation"
          aria-controls="drawer-navigation"
          class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100"
        >
          <svg
            aria-hidden="true"
            class="w-6 h-6"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
              clip-rule="evenodd"
            ></path>
          </svg>
          <svg
            aria-hidden="true"
            class="hidden w-6 h-6"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"
            ></path>
          </svg>
          <span class="sr-only">Toggle sidebar</span>
        </button>
        <a href="/" class="hidden md:flex items-center justify-between mr-4">
          <img
            src="{{ asset('assets/icons/logo.svg') }}" alt="Sky Club"
            class="mr-3"
            alt="Flowbite Logo"
          />
        </a>
      </div>
      <div class="flex items-center lg:order-2">
        <div class="flex items-center space-x-3 self-center">
            <!-- Profile dropdown -->
            <div class="relative ml-3" x-data="{ isOpen: false }" x-cloak>
                <div class="flex items-center space-x-2">
                    <button type="button" @click="isOpen = !isOpen"
                        class="relative flex max-w-xs items-center rounded-full text-sm "
                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open user menu</span>
                        <img class="h-8 w-8 rounded-full"
                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="">
                        <span class="ml-2 font-semibold" x-text="user.data.name"></span>
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
                    {{-- <a href="{{ route('profileUser.show', auth()->user()->id) }}"> --}}
                    <a :href="#" class="block px-4 py-2 text-sm text-gray-700"
                        role="menuitem" tabindex="-1" id="user-menu-item-0" x-show="user.authenticated">Your Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                        tabindex="-1" id="user-menu-item-1">Settings</a>
                    {{-- <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                            tabindex="-1" id="user-menu-item-2">Sign out</button>
                    </form> --}} 
                    <form method="POST" id="logout" x-data="logoutHandler()"
                        @submit.prevent="submitLogout">
                        <button type="submit" class="block px-4 py-2 text-sm text-gray-700"
                            role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
