@extends('layouts.master')
@section('content')
    <div x-data="fieldHandler()" x-init="fetchField(98)">
        <div class="grid grid-cols-3 grid-rows-2 gap-1 sm:gap-2 md:gap-4 h-[270px] sm:h-[370px] md:h-[470px] lg:h-[670px]">

            <!-- Loading -->
            <template x-if="isLoading">
                <div class="col-span-3 row-span-2 flex items-center justify-center">
                    <svg class="animate-spin h-8 w-8 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4" />
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                    </svg>
                </div>
            </template>

            <!-- Gambar (3 teratas) -->
            <template x-if="!isLoading && photos && photos.length > 0">
                <template x-for="(photo, index) in photos.slice(0, 3)" :key="index">
                    <div :class="{
                        'col-span-2 row-span-2 bg-cover bg-center rounded-s-3xl h-full w-full': index === 0,
                        'bg-cover bg-center rounded-tr-3xl h-full w-full': index === 1,
                        'relative bg-cover bg-center rounded-br-3xl h-full w-full': index === 2
                    }"
                        :style="`background-image: url('http://localhost:8000/storage/${photo.photo}')`">
                        <template x-if="index === 2">
                            <button @click="gallery = true"
                                class="absolute bottom-2 right-2 sm:bottom-5 sm:right-5 bg-red-600 rounded p-1 sm:px-4 sm:py-2 font-semibold text-white sm:text-base text-sm">
                                Lihat Semua Foto
                            </button>
                        </template>
                    </div>
                </template>
            </template>

            <!-- Tidak ada foto -->
            <template x-if="!isLoading && photos.length === 0">
                <div class="col-span-3 row-span-2 flex items-center justify-center text-gray-500">
                    Tidak ada foto tersedia
                </div>
            </template>
        </div>

        <!-- Modal Gallery -->
        <div x-show="gallery" x-cloak x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 ">

            <div @click.away="gallery = false"
                class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-sm xs:max-w-md sm:max-w-lg w-full">

                <div class="px-4 py-5 sm:p-6">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Gallery</h3>
                        <button @click="gallery = false" class="text-gray-400 hover:text-gray-500">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="mt-4">
                        <!-- Carousel -->
                        <div x-data="{
                            activeSlide: 0,
                            get slides() {
                                return photos.map(photo => photo.photo);
                            }
                        }">
                            <div class="relative">
                                <!-- Carousel Images -->
                                <template x-for="(slide, index) in slides" :key="index">
                                    {{-- <p x-text="slide"></p> --}}
                                    <div x-show="activeSlide === index"
                                        class="w-full h-64 bg-cover bg-center rounded-lg transition-all duration-500"
                                        :style="`background-image: url('http://localhost:8000/storage/${slide}')`">
                                    </div>
                                </template>

                                <!-- Previous Button -->
                                <button @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1"
                                    class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-70 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <!-- Next Button -->
                                <button @click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-70 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <!-- Carousel Indicators -->
                                <div
                                    class="absolute bottom-2 left-1/2 transform -translate-x-1/2 flex justify-center mt-4 space-x-2">
                                    <template x-for="(slide, index) in slides" :key="index">
                                        <button @click="activeSlide = index"
                                            :class="{
                                                'bg-red-600 w-6': activeSlide === index,
                                                'bg-gray-400 w-3': activeSlide !== index
                                            }"
                                            class="h-3 rounded-full transition-all duration-300"></button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{-- cart & desc --}}
        <div x-data="calendar()" x-init="init()"
            class="flex flex-col xl:grid xl:grid-flow-col gap-2 xl:flex-row justify-between my-12">
            <div class=" xl:max-w-[700px] xxl:max-w-full">
                <div class=" space-y-1">
                    <h1 class="text-4xl font-bold" x-text="field.name">SKY CLUB MINI SOCCER</h1>
                    <div class="flex space-x-1">
                        <svg class="w-6 h-6 text-gray-800 aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                        </svg>
                        <p class="text-lg">Puncak Kab. Bogor</p>
                    </div>
                    <div class="flex">
                        <div class="flex items-center border rounded-lg px-2.5">
                            <p class="text-sm font-bold text-gray-900" x-text="field.review.average">average rating</p>
                            <svg class="ms-1
                                w-4 h-4 text-yellow-300" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                        </div>
                        <p class="p-2.5 text-sm font-medium"
                            x-text="field.review.average >= 5 ? 'Sangat Baik' : field.review.average >= 4 ? 'Baik' : field.review.average >= 3 ? 'Cukup Baik' : field.review.average >= 2 ? 'Buruk' : 'Sangat Buruk'">
                        </p>
                        <p class="font-medium mt-1" x-text="` | ${field.review.count} reviews`"></p>
                        {{-- <p class="p-2.5 text-sm font-medium"><span class=" font-bold">Very
                                Good - </span>countRating reviews</p> --}}
                        {{-- Good - </span>{{ $countRating }} reviews</p> --}}
                    </div>
                </div>
                <hr class="h-px my-8 bg-gray-400 border-0 dark:bg-gray-700">
                <div>
                    <h3 class="mb-4 text-3xl font-bold">Deskripsi</h3>
                    <p class="leading-loose"
                        x-text="field.description && field.description.length > 500 ? field.description.slice(0, 500) + '...' : field.description">
                        field desc</p>
                </div>
                <hr class="h-px my-8 bg-gray-400 border-0 dark:bg-gray-700">
                <div class="space-y-8">
                    <h3 class=" text-3xl font-bold">Fasilitas</h3>
                    {{-- <div x-data="facilitySliceSelection({{ json_encode($selectedSliceFacilities) }})" --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-2 gap-8 xxl:grid-cols-4">
                        <template x-if="facilities.includes('mushola')">
                            <x-facility icon="icon_mosque.svg" name="Mushola" />
                        </template>
                        <template x-if="facilities.includes('parking')">
                            <x-facility icon="icon_parking.svg" name="Parkir Area" />
                        </template>
                        <template x-if="facilities.includes('toilet')">
                            <x-facility icon="icon_toilet.svg" name="Toilet" />
                        </template>
                        <template x-if="facilities.includes('medical')">
                            <x-facility icon="icon_med.svg" name="Medis" />
                        </template>
                        <template x-if="facilities.includes('security')">
                            <x-facility icon="icon_security.svg" name="Security" />
                        </template>
                        <template x-if="facilities.includes('tribune')">
                            <x-facility icon="icon_tribune.svg" name="Tribun Penonton" />
                        </template>
                        <template x-if="facilities.includes('wifi')">
                            <x-facility icon="icon_wifi.svg" name="Wifi" />
                        </template>
                        <template x-if="facilities.includes('shower')">
                            <x-facility icon="icon_shower.svg" name="Shower" />
                        </template>
                        <template x-if="facilities.includes('gym')">
                            <x-facility icon="icon_gym.svg" name="Gym" />
                        </template>
                        <template x-if="facilities.includes('locker')">
                            <x-facility icon="icon_locker.svg" name="Locker" />
                        </template>
                        <template x-if="facilities.includes('canteen')">
                            <x-facility icon="icon_eat.svg" name="Kantin" />
                        </template>
                        <template x-if="facilities.includes('sauna')">
                            <x-facility icon="icon_sauna.svg" name="Sauna" />
                        </template>
                        <template x-if="facilities.includes('run')">
                            <x-facility icon="icon_run.svg" name="Lintasan Lari" />
                        </template>
                    </div>
                    <div x-data="{ fasilitas: false }">
                        <button @click="fasilitas = true"
                            class="border border-red-400 rounded p-2 font-semibold text-red-500">Lihat Semua
                            Fasilitas</button>
                        <div x-show="fasilitas" x-cloak x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90"
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 ">
                            <div @click.away="fasilitas = false"
                                class="bg-white rounded-lg shadow-xl transform transition-all sm:max-w-4xl :w-full max-w-sm xs:max-w-md w-full h-4/5 overflow-scroll custom-scrollbar">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex justify-end">
                                        <button @click="fasilitas = false" class="text-gray-400 hover:text-gray-500">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <h3 class="mb-8 text-3xl font-bold">Deskripsi</h3>
                                    <div class="py-8 border-y-2">
                                        <p x-data="{ expanded: false }" class="leading-loose">
                                            <span x-show="!expanded"
                                                x-text="field.description && field.description.length > 500 ? field.description.slice(0, 500) + '...' : field.description">fieldDescription</span>
                                            <span {{-- <span x-show="!expanded">{{ Str::limit($fieldDescription, 500) }}</span> <span --}} x-show="expanded"
                                                x-text="field.description">fieldDescription</span> <button
                                                {{-- x-show="expanded">{{ $fieldDescription }}</span> <button --}} @click="expanded = !expanded"
                                                class="text-red-500 font-semibold">
                                                <span x-show="!expanded">lihat selengkapnya</span>
                                                <span x-show="expanded">lihat lebih sedikit</span>
                                            </button>
                                        </p>
                                    </div>
                                    <h3 class="text-3xl font-bold my-8">Fasilitas</h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-2 gap-8">
                                        <template x-if="facilities.includes('mushola')">
                                            <x-facility icon="icon_mosque.svg" name="Mushola" />
                                        </template>
                                        <template x-if="facilities.includes('parking')">
                                            <x-facility icon="icon_parking.svg" name="Parkir Area" />
                                        </template>
                                        <template x-if="facilities.includes('toilet')">
                                            <x-facility icon="icon_toilet.svg" name="Toilet" />
                                        </template>
                                        <template x-if="facilities.includes('medical')">
                                            <x-facility icon="icon_med.svg" name="Medis" />
                                        </template>
                                        <template x-if="facilities.includes('security')">
                                            <x-facility icon="icon_security.svg" name="Security" />
                                        </template>
                                        <template x-if="facilities.includes('tribune')">
                                            <x-facility icon="icon_tribune.svg" name="Tribun Penonton" />
                                        </template>
                                        <template x-if="facilities.includes('wifi')">
                                            <x-facility icon="icon_wifi.svg" name="Wifi" />
                                        </template>
                                        <template x-if="facilities.includes('shower')">
                                            <x-facility icon="icon_shower.svg" name="Shower" />
                                        </template>
                                        <template x-if="facilities.includes('gym')">
                                            <x-facility icon="icon_gym.svg" name="Gym" />
                                        </template>
                                        <template x-if="facilities.includes('locker')">
                                            <x-facility icon="icon_locker.svg" name="Locker" />
                                        </template>
                                        <template x-if="facilities.includes('canteen')">
                                            <x-facility icon="icon_eat.svg" name="Kantin" />
                                        </template>
                                        <template x-if="facilities.includes('sauna')">
                                            <x-facility icon="icon_sauna.svg" name="Sauna" />
                                        </template>
                                        <template x-if="facilities.includes('run')">
                                            <x-facility icon="icon_run.svg" name="Lintasan Lari" />
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="h-px my-8 bg-gray-400 border-0 dark:bg-gray-700">

                {{-- Date Picker & Time slot  --}}
                <div class="w-full max-w-4xl">
                    <div class="flex items-center justify-between p-4 bg-white shadow rounded-md mb-4">

                        {{-- button previous --}}
                        <button @click="previousWeek" class="text-gray-500 hover:text-gray-900 w-12 cursor-pointer">
                            &#8249;
                        </button>

                        <!-- week days -->
                        <div class="grid grid-cols-3 xs:grid-cols-4 sm:grid-cols-7 gap-2">
                            <template x-for="(day, index) in weekDays" :key="index">
                                <div @click="isWithinRange(day.date) && selectDate(day.date)"
                                    :class="{
                                        'bg-red-500 text-white hover:bg-red-500': isSelected(day.date),
                                        'text-gray-400 cursor-not-allowed': !isWithinRange(day.date),
                                        'cursor-pointer hover:bg-gray-100 ': isWithinRange(day.date)
                                    }"
                                    class="text-center w-16 p-2 rounded-md">
                                    <div class="text-xs font-medium" x-text="day.name"></div>
                                    <div class="text-sm font-semibold"
                                        x-text="day.date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' })">
                                    </div>
                                </div>
                            </template>
                        </div>

                        {{-- next button --}}
                        <button @click="nextWeek" class="text-gray-500 hover:text-gray-900 w-12 cursor-pointer">
                            &#8250;
                        </button>

                        <div class="border-l border-gray-400 h-8 my-auto"></div>
                        <!-- Date Picker -->
                        <div class="relative w-14">
                            <label class="flex items-center justify-center " for="datePicker">
                                <input id="datePicker" type="date" x-model="selectedDate" @change="goToSelectedDate"
                                    :min="minDate.toISOString().split('T')[0]" :max="maxDate.toISOString().split('T')[0]"
                                    class="absolute opacity-1 z-100 w-full h-full cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" class="w-6 h-6 text-gray-500 hover:text-gray-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-6 0h6m2 2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h12z" />
                                </svg>
                            </label>
                        </div>
                    </div>


                    <!-- Time Slot -->
                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-4 mb-4">
                        <template x-for="(slot, index) in timeSlots" :key="index">
                            <div :class="{
                                'bg-gray-200 text-gray-400': !slot.available || slotInCart(
                                    slot),
                                'border border-red-500': slot.selected
                            }"
                                @click="toggleSlotSelection(slot)"
                                class="p-2 bg-white shadow rounded-md cursor-pointer text-center"
                                :style="{ pointerEvents: slot.available && !slotInCart(slot) ? 'auto' : 'none' }">
                                {{-- <div class="text-sm font-medium" x-text="slot.duration + ' Menit'"></div> --}}
                                <div class="text-sm font-medium">60 Menit</div>
                                <div class="text-sm font-bold" x-text="slot.time"></div>
                                <div class="text-sm font-medium"
                                    x-text="slot.available ? formatRupiah(slot.price) : 'Booked'">
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="flex justify-between gap-2 xl:hidden">
                        <button type="submit"
                            class="bg-red-600 w-full text-center py-3 rounded-lg font-bold text-white hover:bg-red-800 cursor-pointer">Reschedule</button>
                    </div>
                </div>
            </div>

            {{-- cart --}}
            <div
                class="border px-5 py-8 bg-white rounded-2xl max-h-fit space-y-7 sticky top-2 w-[490px] min-w-[360px] hidden xl:block">
                <div>
                    <h4 class="font-bold text-2xl">Mulai dari</h4>
                    <p class=" font-bold text-4xl" x-text="formatRupiah(field.weekday_price)">Rp. 100.000,00 <span
                            class=" text-xl">/Sesi</span></p>
                </div>
                <template x-if="cart.length > 0">
                    <ul class=" space-y-4">
                        <template x-for="(item, index) in cart" :key="index">
                            <li
                                class="w-full flex justify-between items-center border border-gray-500 text-lg rounded-xl py-2 px-4">
                                <div>
                                    <p
                                        x-text="new Date(item.date).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })">
                                    </p>
                                    <p x-text="item.time"></p>
                                </div>
                                <div class="flex space-x-7">
                                    <p x-text="formatRupiah(item.price)"></p>
                                    <button @click="removeFromCart(item)"
                                        class="text-red-500 hover:text-red-700 cursor-pointer">X</button>
                                </div>
                            </li>
                        </template>
                    </ul>
                </template>
                <template x-if="cart.length === 0">
                    <p class="text-gray-500">Keranjang kosong</p>
                </template>

                <hr class="h-px my-8 bg-gray-400 border-0 dark:bg-gray-700">
                <div class="flex justify-between text-2xl font-semibold">
                    <p>Total Harga</p>
                    <p x-text="totalPrice.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })"></p>
                </div>
                <div>
                    <form action="" method="POST" @submit.prevent="rescheduleProcess()">
                        @csrf
                        <template class="hidden" x-for="(item, index) in cart" :key="index">
                            <div>
                                <input type="hidden" :name="`schedule[${index}]`"
                                    :value="item.date.toDateString('yyyy-mm-dd')">
                                <input type="hidden" :name="`session[${index}]`" :value="item.time">
                                <input type="hidden" :name="`price[${index}]`" :value="item.price">
                            </div>
                        </template>
                        <div class="flex space-x-4">
                            <button type="submit"
                                class="bg-red-600 w-full text-center py-3 rounded-lg font-bold text-white hover:bg-red-800 cursor-pointer">Reschedule</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- customer testimoni --}}
        <div x-data="{ testimoni: false }" class="">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h2 class="text-4xl font-bold">Customer Testimonials</h2>
                    <h6 class="text-lg">Kesan dari kawan kawan SKY CLUB</h6>
                </div>
                <div>
                    <button @click="testimoni = true" class="cursor-pointer hover:text-red-400">Lihat
                        Selengkapnya</button>
                </div>
            </div>

            {{-- testimoni modal --}}
            <div x-show="testimoni" x-cloak x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 cursor-pointer">
                <div @click.away="testimoni = false"
                    class="bg-white rounded-lg shadow-xl transform transition-all sm:max-w-4xl sm:w-full h-4/5 overflow-scroll custom-scrollbar max-w-sm xs:max-w-md w-full">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex justify-between items-center mb-5">
                            <h3 class="text-3xl leading-6 font-bold text-gray-900">Ulasan</h3>
                            <button @click="testimoni = false" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        {{-- Fetch data --}}
                        <div class="flex items-center space-x-6 mb-8">
                            <p class=" text-gray-500 font-bold">
                                <span class="text-black text-3xl" x-text="averageRating.toFixed(1)">0</span>/5
                            </p>
                            <div class="flex space-x-1">
                                <template x-for="star in 5" :key="star">
                                    <svg class="w-6 h-6"
                                        :class="star <= Math.round(averageRating) ? 'text-yellow-300' : 'text-gray-300'"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                </template>
                            </div>
                            <p class="p-2.5 text-sm font-medium"
                                x-text="field.review.average >= 5 ? 'Sangat Baik' : field.review.average >= 4 ? 'Baik' : field.review.average >= 3 ? 'Cukup Baik' : field.review.average >= 2 ? 'Buruk' : 'Sangat Buruk'">
                            </p>
                            <p class="font-medium mt-1" x-text="` | ${field.review.count} reviews`"></p>
                            {{-- <span class="text-gray-500" x-text="countRating + ' reviews'"></span> --}}
                        </div>
                        <div class="mt-4 space-y-4">
                            <template x-if="reviews.length === 0">
                                <div class="col-span-3 text-center text-gray-500 py-8">
                                    Belum ada review.
                                </div>
                            </template>
                            <template x-for="(review, idx) in reviews" :key="idx">
                                <div class="p-4 rounded-lg border">
                                    <div class="flex justify-between mb-6">
                                        <div class="flex items-center space-x-4">
                                            <img class="rounded-full w-12 h-12"
                                                :src="`/storage/${review.user.profile_photo}`" alt="">
                                            <div>
                                                <p class="text-base font-bold" x-text="review.user.name"></p>
                                                <p class="text-base" x-text="review.user.team"></p>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center p-2 rounded-lg border">
                                            <svg class="w-6 h-6 text-yellow-300 me-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 22 20">
                                                <path
                                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                            </svg>
                                            <p class="font-semibold text-2xl" x-text="review.rating"></p>
                                        </div>
                                    </div>
                                    <p x-text="review.comment"></p>
                                </div>
                            </template>
                        </div>
                        {{-- <div class="flex items-center space-x-6 mb-8">
                            <p class=" text-gray-500 font-bold"><span
                                    class="text-black text-3xl">{{ $averageRating }}</span>/5</p>
                            <div class="flex space-x-1">
                                @for ($x = 0; $x < 5; $x++)
                                    <svg class="w-6 h-6 text-yellow-300" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>
                        <div class="mt-4 space-y-4">
                            @foreach ($reviews as $review)
                                <div class="p-4 rounded-lg border">
                                    <div class="flex justify-between mb-6">
                                        <div class="flex items-center space-x-4">
                                            <img class=" rounded-full w-12 h-12"
                                                src="{{ asset('storage/' . $review->user->profile_photo) }}"
                                                alt="">
                                            <div>
                                                <p class="text-base font-bold">{{ $review->user->name }}</p>
                                                <p class="text-base">{{ $review->user->team }}</p>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center p-2 rounded-lg border">
                                            <svg class="w-6 h-6 text-yellow-300 me-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 22 20">
                                                <path
                                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                            </svg>
                                            <p class="font-semibold text-2xl">{{ $review->rating }}</p>
                                        </div>
                                    </div>
                                    <p>"{{ $review->comment }}"</p>
                                </div>
                            @endforeach
                        </div> --}}
                    </div>
                </div>
            </div>

            <!-- Testimoni -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                <template x-if="reviews.length === 0">
                    <div class="col-span-3 text-center text-gray-500 py-8">
                        Belum ada review.
                    </div>
                </template>

                <template x-for="(review, idx) in reviews" :key="idx">
                    <div class="space-y-6 sm:space-y-8 border-b-2 pb-6 sm:border-b-0 sm:pb-0">
                        <div class="flex items-center">
                            <template x-for="star in Array.from({length: review.rating})" :key="star">
                                <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                            </template>
                        </div>
                        <p x-text="review.comment"></p>
                        <div class="flex items-center sm:block">
                            <img class="rounded-full w-14 sm:mb-4 mr-4" :src="`/storage/${review.user.profile_photo}`"
                                alt="">
                            <div>
                                <p class="text-base font-bold" x-text="review.user.name"></p>
                                <p class="text-base" x-text="review.user.team"></p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            {{-- <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                @foreach ($reviews as $review)
                    <div class="space-y-6 sm:space-y-8 border-b-2 pb-6 sm:border-b-0 sm:pb-0">
                        <div class="flex items-center">
                            @for ($x = 0; $x < $review->rating; $x++)
                                <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                            @endfor
                        </div>
                        <p>{{ $review->comment }}</p>
                        <div class="flex items-center sm:block">
                            <img class=" rounded-full w-14 sm:mb-4 mr-4"
                                src="{{ 'storage/' . $review->user->profile_photo }}" alt="">
                            <div>
                                <p class="text-base font-bold">{{ $review->user->name }}</p>
                                <p class="text-base">{{ $review->user->team }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> --}}
            <hr class="h-px my-8 bg-gray-400 border-0">
            <div class="rounded-lg border border-gray-300">
                <div class=" grid p-6 sm:p-12 space-y-8">
                    <div>
                        <p class="text-3xl font-bold">Lokasi Venue</p>
                        <p class="text-xl font-bold">Jalan Raya Palsu No. 123, Kota Bogor, Jawa Barat, 16111</p>
                    </div>
                    <iframe class="w-full sm:h-[27rem] "
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7906.299606239549!2d110.36796849553049!3d-7.77393531109345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a584a6eaf7cbb%3A0x294cd98559dc9c8c!2sSekolah%20Vokasi%20UGM!5e0!3m2!1sid!2sid!4v1729779883264!5m2!1sid!2sid"
                        style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

        <!-- Modal Error Besar -->
        <div x-show="error" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/70">
            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-8 text-center relative">
                <button @click="error = null"
                    class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-2xl">&times;</button>
                <svg class="mx-auto mb-4 w-16 h-16 text-red-500" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
                <h2 class="text-2xl font-bold mb-2 text-red-600">Terjadi Kesalahan</h2>
                <p class="mb-6 text-gray-700" x-text="error"></p>
                <button @click="error = null"
                    class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition">Tutup</button>
            </div>
        </div>
    </div>
    <script>
        function fieldHandler() {
            return {
                field: null,
                facilities: [],
                photos: [],
                reviews: [],
                isLoading: false,
                gallery: false,
                error: null,
                async fetchField(fieldId) {
                    this.isLoading = true;
                    this.error = null;
                    try {
                        const response = await axios.get(`fields/${fieldId}`);
                        console.log(response.data);
                        this.field = response.data.data; // Menyimpan data field dari response
                        // this.facilities = response.data.data.facilities; // Menyimpan data facility dari response
                        this.facilities = response.data.data.facilities.map(facility => facility.name);
                        this.photos = response.data.data.photos; // Menyimpan data photos dari response
                        console.log(this.facility);
                        console.log(this.photos);
                    } catch (error) {
                        console.error('Terjadi Kesalahan Di Server:', error);
                        this.error = 'Gagal memuat data facility';
                    } finally {
                        this.isLoading = false;
                    }
                },
                async fetchSchedule(fieldId) {
                    this.isLoading = true,
                        this.error = null,
                        this.dataServer = [];
                }
            }
        }

        function calendar() {
            return {
                currentDate: new Date(),
                weekDays: [],
                selectedDate: '',
                timeSlots: [],
                cart: [],
                dataServer: [], // Akan diisi dari API
                minDate: new Date(),
                maxDate: new Date(new Date().setMonth(new Date().getMonth() + 2)),
                pricePerSlot: 0,

                // Inisialisasi kalender
                async init() {
                    await this.fetchScheduleByRange(this.getWeekRange(this.currentDate));
                },

                async rescheduleProcess() {
                    // Simpan cart
                    const schedules = this.cart.map(item => ({
                        field_id: this.field?.id || 98,
                        schedule_date: this.formatDateYMD(item.date), // pastikan string "dd-mm-yyyy"
                        schedule_time: item.time,
                        price: this.parsePrice(item.price)
                    }));
                    console.log('Schedules:', schedules[0]);

                    // Redirect ke halaman pembayaran
                    try {
                        const param = window.location.pathname.split('/')[2];
                        const booking_id = param || null;
                        response = await axios.post(`my-booking/${booking_id}/request-reschedule`, {
                            new_schedule_date: this.formatDateYMD(this.currentDate),
                            new_schedule_time: this.cart[0]?.time || '',
                            new_schedule_price: this.parsePrice(this.cart[0]?.price || 0),
                        });
                        console.log('Booking response:', response.data.message);;
                        window.location.href = 'users/profile-user';
                    } catch (error) {
                        this.error = error.response.data.error || 'Gagal membuat booking';
                        console.error('Gagal membuat booking:', error);
                    }
                },

                // Mendapatkan rentang tanggal awal dan akhir minggu (Senin - Minggu)
                getWeekRange(date) {
                    const curr = new Date(date);
                    const day = curr.getDay();
                    const diffToMonday = (day === 0 ? -6 : 1) - day;
                    const monday = new Date(curr);
                    monday.setDate(curr.getDate() + diffToMonday);
                    const sunday = new Date(monday);
                    sunday.setDate(monday.getDate() + 6);
                    return {
                        start: this.formatDate(monday),
                        end: this.formatDate(sunday)
                    };
                },

                // Fetch API berdasarkan rentang minggu
                async fetchScheduleByRange({
                    start,
                    end
                }) {
                    try {
                        const response = await axios.get(
                            `fields/98/schedules?start_date=${start}&end_date=${end}`
                        );
                        this.dataServer = response.data.data;
                        // Pilih tanggal default
                        const todayStr = this.formatDate(new Date());
                        const found = this.dataServer.find(item => item.date === todayStr);
                        this.selectedDate = found ? todayStr : this.dataServer[0]?.date;
                        this.currentDate = this.parseDate(this.selectedDate);
                        this.pricePerSlot = this.dataServer[0]?.price || 0;
                        this.updateWeekDays();
                        this.loadTimeSlots();
                    } catch (error) {
                        console.error('Gagal memuat jadwal:', error);
                    }
                },

                // Format date ke "dd-mm-yyyy"
                formatDate(date) {
                    const d = date.getDate().toString().padStart(2, '0');
                    const m = (date.getMonth() + 1).toString().padStart(2, '0');
                    const y = date.getFullYear();
                    return `${d}-${m}-${y}`;
                },

                formatDateYMD(date) {
                    // date: Date object
                    const y = date.getFullYear();
                    const m = (date.getMonth() + 1).toString().padStart(2, '0');
                    const d = date.getDate().toString().padStart(2, '0');
                    return `${y}-${m}-${d}`;
                },

                // Parse "dd-mm-yyyy" ke Date object
                parseDate(str) {
                    const [d, m, y] = str.split('-');
                    return new Date(`${y}-${m}-${d}`);
                },

                updateWeekDays() {
                    const startOfWeek = new Date(this.currentDate);
                    const day = this.currentDate.getDay();
                    const diff = (day === 0 ? -6 : 1) - day;
                    startOfWeek.setDate(this.currentDate.getDate() + diff);

                    this.weekDays = [];
                    const dayNames = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                    for (let i = 0; i < 7; i++) {
                        const day = new Date(startOfWeek);
                        day.setDate(startOfWeek.getDate() + i);
                        this.weekDays.push({
                            name: dayNames[i],
                            date: day,
                            dateStr: this.formatDate(day)
                        });
                    }
                },

                selectDate(date) {
                    this.currentDate = new Date(date);
                    this.selectedDate = this.formatDate(this.currentDate);
                    this.loadTimeSlots();
                },

                loadTimeSlots() {
                    // Cari data tanggal yang sesuai
                    const data = this.dataServer.find(item => item.date === this.selectedDate);
                    if (data) {
                        this.timeSlots = data.time_slots.map(slot => ({
                            time: slot.time,
                            available: slot.is_available,
                            price: data.price,
                            selected: false
                        }));
                        this.pricePerSlot = data.price;
                    } else {
                        this.timeSlots = [];
                    }
                },

                toggleSlotSelection(slot) {
                    if (slot.available) {
                        // Unselect semua slot
                        this.timeSlots.forEach(s => s.selected = false);
                        // Kosongkan cart
                        this.cart = [];
                        // Select slot yang baru
                        slot.selected = true;
                        this.cart.push({
                            ...slot,
                            date: this.parseDate(this.selectedDate)
                        });
                    }
                },

                removeFromCart(item) {
                    this.cart = this.cart.filter(slot => slot.time !== item.time || slot.date.toDateString() !== item.date
                        .toDateString());
                    this.timeSlots.forEach(slot => {
                        if (slot.time === item.time) {
                            slot.selected = false;
                        }
                    });
                },

                parsePrice(price) {
                    return typeof price === 'string' ? parseInt(price.replace(/[^\d]/g, ''), 10) || 0 : price;
                },

                formatRupiah(price) {
                    return price.toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    });
                },

                get totalPrice() {
                    return this.cart.reduce((total, item) => total + this.parsePrice(item.price), 0);
                },

                slotInCart(slot) {
                    return this.cart.some(item => item.time === slot.time && item.date.toDateString() === this.parseDate(
                        this.selectedDate).toDateString());
                },

                isSelected(date) {
                    return this.selectedDate && date.toDateString() === this.currentDate.toDateString();
                },

                async previousWeek() {
                    this.currentDate.setDate(this.currentDate.getDate() - 7);
                    await this.fetchScheduleByRange(this.getWeekRange(this.currentDate));
                },

                async nextWeek() {
                    this.currentDate.setDate(this.currentDate.getDate() + 7);
                    await this.fetchScheduleByRange(this.getWeekRange(this.currentDate));
                },

                async goToSelectedDate() {
                    if (this.selectedDate) {
                        this.currentDate = new Date(this.selectedDate);
                        console.log(this.currentDate);
                        await this.fetchScheduleByRange(this.getWeekRange(this.currentDate));
                    }
                },

                isWithinRange(date) {
                    // Set jam, menit, detik ke 0 agar hanya tanggal yang dibandingkan
                    const d = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                    const min = new Date(this.minDate.getFullYear(), this.minDate.getMonth(), this.minDate.getDate());
                    const max = new Date(this.maxDate.getFullYear(), this.maxDate.getMonth(), this.maxDate.getDate());
                    return d >= min && d <= max;
                    // return date >= this.minDate && date <= this.maxDate;
                },
            };
        }
    </script>
@endsection
