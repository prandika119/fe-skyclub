<aside
    class="fixed top-1w left-0 z-50 md:z-30 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0"
    aria-label="Sidenav" id="drawer-navigation">
    <div class="overflow-y-auto py-5 px-3 h-full bg-white custom-scrollbar mt-4">
        <a href="/" class="md:hidden flex items-center justify-between mb-6 ml-3">
            <img src="{{ asset('assets/icons/logo.svg') }}" alt="Sky Club" class="mr-3" />
        </a>
        <ul class="space-y-2 pb-5 border-b border-gray-200">
            <li>
                <a href="{{ route('admin.index') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-rose-100 hover:ring-red-600 hover:ring-1 {{ request()->routeIs('admin.index') ? 'bg-rose-100 ring-red-600 ring-1' : '' }} group">
                    <svg aria-hidden="true"
                        class="w-6 h-6 text-gray-500 transition duration-75  group-hover:text-red-600 {{ request()->routeIs('admin.index') ? 'text-red-600' : '' }}"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span
                        class="ml-3 text-gray-500 group-hover:text-red-600 {{ request()->routeIs('admin.index') ? 'text-red-600' : '' }}">Dashboard</span>
                </a>
            </li>
            <li x-data="{ isOpen: {{ request()->routeIs('admin.field.photo', 'admin.field.description') ? 'true' : 'false' }} }">
                <button @click="isOpen = !isOpen" type="button"
                    class="flex items-center p-2 w-full text-base font-medium rounded-lg transition duration-75 group hover:bg-rose-100 hover:ring-red-600 hover:ring-1 {{ request()->routeIs('field.photo', 'field.description') ? 'bg-rose-100 ring-red-600 ring-1' : '' }}">
                    <svg class="flex-shrink-0 w-6 h-6 fill-gray-500 transition duration-75 group-hover:fill-red-600 {{ request()->routeIs('admin.field.photo', 'admin.field.description') ? 'fill-red-600' : '' }}"
                        version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                        <g>
                            <path d="M16,13c-1.3,0-2.4,0.8-2.8,2h5.6C18.4,13.8,17.3,13,16,13z" />
                            <path d="M11.1,15c0.5-2.3,2.5-4,4.9-4s4.4,1.7,4.9,4H25V7c0-2.8-2.2-5-5-5v5c0,0.6-0.4,1-1,1h-6c-0.6,0-1-0.4-1-1V2
                                C9.2,2,7,4.2,7,7v8H11.1z" />
                            <rect x="14" y="2" width="4" height="4" />
                            <path d="M20.9,17c-0.5,2.3-2.5,4-4.9,4s-4.4-1.7-4.9-4H7v8c0,2.8,2.2,5,5,5v-5c0-0.6,0.4-1,1-1h6c0.6,0,1,0.4,1,1v5
                                c2.8,0,5-2.2,5-5v-8H20.9z" />
                            <path d="M16,19c1.3,0,2.4-0.8,2.8-2h-5.6C13.6,18.2,14.7,19,16,19z" />
                            <rect x="14" y="26" width="4" height="4" />
                        </g>
                    </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap text-gray-500 group-hover:text-red-600 {{ request()->routeIs('admin.field.photo', 'admin.field.description') ? 'text-red-600' : '' }}">
                        Lapangan
                    </span>
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-500 transition-transform duration-200"
                        :class="{ 'rotate-180 text-red-600': isOpen, 'group-hover:text-red-600': !isOpen }"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                
                <ul x-show="isOpen" x-collapse class="py-2 space-y-2">
                    <li>
                        <a href="{{ route('admin.field.photo') }}"
                            class="flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg transition duration-75 hover:bg-gray-100 {{ request()->routeIs('field.photo') ? 'text-red-600 font-semibold' : 'text-gray-500 hover:text-red-600' }}">
                            Foto Lapangan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.field.description') }}"
                            class="flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg transition duration-75 hover:bg-gray-100 {{ request()->routeIs('field.description') ? 'text-red-600 font-semibold' : 'text-gray-500 hover:text-red-600' }}">
                            Deskripsi
                        </a>
                    </li>
                </ul>
            </li>
            <li x-data="{ isOpen: {{ request()->routeIs('admin.booking*') ? 'true' : 'false' }} }">
                <button @click="isOpen = !isOpen" type="button" class="flex items-center p-2 w-full text-base font-medium rounded-lg transition duration-75 group hover:bg-rose-100 hover:ring-red-600 hover:ring-1 {{ request()->routeIs('admin.booking*') ? 'bg-rose-100 ring-red-600 ring-1' : '' }}">
                    <!-- Icon booking -->
                    <svg class="flex-shrink-0 w-6 h-6 fill-gray-500 transition duration-75 group-hover:fill-red-600 {{ request()->routeIs('admin.booking*') ? 'fill-red-600' : '' }}" 
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap text-gray-500 group-hover:text-red-600 {{ request()->routeIs('admin.booking*') ? 'text-red-600' : '' }}">Booking</span>
                    <!-- Panah dropdown -->
                    <svg class="w-6 h-6 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180 text-red-600': isOpen }" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
                
                <ul x-show="isOpen" x-collapse class="py-2 space-y-2">
                    <li>
                        <a href="{{ route('admin.booking.allBooking') }}" class="flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg transition duration-75 hover:bg-gray-100 {{ request()->routeIs('admin.booking.allBooking') ? 'text-red-600 font-semibold' : 'text-gray-500 hover:text-red-600' }}">
                            Daftar Semua Pesanan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.booking.reschedule') }}" class="flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg transition duration-75 hover:bg-gray-100 {{ request()->routeIs('admin.booking.reschedule') ? 'text-red-600 font-semibold' : 'text-gray-500 hover:text-red-600' }}">
                            Ubah Jadwal
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.booking.cancel') }}" class="flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg transition duration-75 hover:bg-gray-100 {{ request()->routeIs('admin.booking.cancel') ? 'text-red-600 font-semibold' : 'text-gray-500 hover:text-red-600' }}">
                            Pembatalan Jadwal
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('admin.articles') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-rose-100 hover:ring-red-600 hover:ring-1 {{ request()->routeIs('admin.articles') ? 'bg-rose-100 ring-red-600 ring-1' : '' }} group">
                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75  group-hover:text-red-600 {{ request()->routeIs('admin.articles') ? 'text-red-600' : '' }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7ZM8 16a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1-5a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span
                        class="ml-3 text-gray-500 group-hover:text-red-600 {{ request()->routeIs('admin.articles') ? 'text-red-600' : '' }}">Artikel</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.voucher') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-rose-100 hover:ring-red-600 hover:ring-1 {{ request()->routeIs('admin.voucher') ? 'bg-rose-100 ring-red-600 ring-1' : '' }} group ">
                    <svg class="flex-shrink-0 w-6 h-6 fill-gray-500 transition duration-75  group-hover:fill-red-600 {{ request()->routeIs('admin.voucher') ? 'fill-red-600' : '' }}"
                        id="Layer_2" style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32"
                        xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g>
                            <path
                                d="M30,6.62H2c-0.83002,0-1.5,0.66998-1.5,1.5v3.77002c0,0.82996,0.66998,1.5,1.5,1.5c1.44,0,2.60999,1.16998,2.60999,2.60999   S3.44,18.60999,2,18.60999c-0.83002,0-1.5,0.66998-1.5,1.5V23.88c0,0.82996,0.66998,1.5,1.5,1.5h28c0.83002,0,1.5-0.67004,1.5-1.5   v-3.77002c0-0.83002-0.66998-1.5-1.5-1.5c-1.44,0-2.60999-1.16998-2.60999-2.60999S28.56,13.39001,30,13.39001   c0.83002,0,1.5-0.67004,1.5-1.5V8.12C31.5,7.28998,30.83002,6.62,30,6.62z M22.5,19.5c0,0.82001-0.66998,1.5-1.5,1.5   s-1.5-0.67999-1.5-1.5v-7c0-0.82001,0.66998-1.5,1.5-1.5s1.5,0.67999,1.5,1.5V19.5z" />
                        </g>
                    </svg>
                    <span
                        class="ml-3 text-gray-500 group-hover:text-red-600 {{ request()->routeIs('admin.voucher') ? 'text-red-600' : '' }}">Voucher</span>
                </a>
            </li>
        </ul>
        <ul class="mt-5 space-y-2">
            <li>
                <a href="{{ route('admin.profile') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-rose-100 hover:ring-red-600 hover:ring-1 {{ request()->routeIs('admin.profile') ? 'bg-rose-100 ring-red-600 ring-1' : '' }} group ">
                    <svg class="flex-shrink-0 w-6 h-6 fill-gray-500 transition duration-75  group-hover:fill-red-600 {{ request()->routeIs('admin.profile') ? 'fill-red-600' : '' }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ml-3 text-gray-500 group-hover:text-red-600 {{ request()->routeIs('admin.profile') ? 'text-red-600' : '' }}">Account</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
