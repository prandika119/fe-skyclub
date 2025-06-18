@extends('layouts.master')
@section('content')
    {{-- banner --}}
    <div class="mx-auto text-justify">
        <div class="text-center bg-cover bg-no-repeat bg-center md:rounded-3xl text-white lg:h-screen md:h-[500px] pt-16 pb-32 shadow-[inset_0_500px_130px_rgba(0,0,0,0.45)] flex flex-col items-center justify-center"
            style="background-image: url('{{ asset('assets/images/banner/banner.svg') }}');">
            <div>
                <h2 class="lg:text-5xl md:text-4xl text-3xl font-bold mb-1">Experience</h2>
                <h1 class="lg:text-6xl md:text-5xl text-4xl font-bold mb-4">THE BEST IN MINI SOCCER</h1>
                <h6 class="text-xl font-semibold">Premium fields, easy booking, and top-notch facilities.</h6>
            </div>
        </div>
    </div>


    {{-- selector --}}
    <div x-data="{ selected: 'sewa' }"
        class="relative mx-auto z-10 lg:-mt-34 -mt-20 bg-white w-9/12 py-4 pl-8 pr-4 rounded-xl shadow flex flex-col space-y-6">
        <div class=" flex items-start text-base font-semibold px-3.5">
            <button @click="selected = 'sewa'" :class="{ 'border-b-4 border-red-600': selected === 'sewa' }"
                class="mr-8 cursor-pointer">
                Sewa Lapangan
            </button>
            <div class="h-8 border-l-2 border-gray-200"></div>
            <button @click="selected = 'sparing'" :class="{ 'border-b-4 border-red-600': selected === 'sparing' }"
                class="ml-8 cursor-pointer">
                Sparing
            </button>
        </div>
        <form action="{{ route('schedule.index') }}" method="get" x-show="selected === 'sewa'">
            <div class="space-x-6 grid grid-flow-col justify-stretch mb-4">
                <div class="relative">
                    <input type="date" id="rent_date"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " />
                    <label for="username"
                        class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                        Pilih Tanggal</label>
                </div>
                <div class="relative">
                    <input type="time" id="rent_time"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " />
                    <label for="username"
                        class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                        Jam Sewa</label>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-red-600 hover:bg-red-700 rounded px-4 py-2 font-semibold text-white">
                    Lihat Ketersediaan</button>
            </div>
        </form>
        <form x-show="selected === 'sparing'" action="{{ route('sparings.index') }}" method="get">
            <div class="space-x-6 grid grid-flow-col justify-stretch mb-4">
                <div class="relative">
                    <input type="date" id="rent_date"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " />
                    <label for="username"
                        class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                        Pilih Tanggal</label>
                </div>
                {{-- <div class="relative">
                    <input type="time" id="rent_time"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " />
                    <label for="username"
                        class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                        Jam Sewa</label>
                </div> --}}
            </div>
            <div class="flex justify-end ">
                <button type="submit" class=" bg-red-600 hover:bg-red-700 rounded px-4 py-2 font-semibold text-white">
                    Lihat Sparing</button>
            </div>
        </form>
    </div>

    {{-- content 1 --}}
    <x-fasility-carousel />

    {{-- Content 2 --}}
    <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 mt-20">
        <div class="mr-auto place-self-center lg:col-span-7">
            <h1 class="text-5xl font-bold mb-6 max-w-2xl tracking-tight leading-none md:text-5xl xl:text-6xl">
                Sewa lapangan dengan cepat dan mudah.</h1>
            <h6 class="text-base mb-8 max-w-2xl font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl">
                Punya rencana berolahraga minggu ini tapi belum tahu mau main di mana? Atau tidak ada waktu untuk datang
                langsung ke venue hanya untuk booking lapangan?</h6>
            <a href="/field-schedule"
                class="bg-red-600 rounded-lg px-6 py-3 font-semibold text-white hover:bg-red-800">Pesan Sekarang</a>
        </div>
        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex place-self-end">
            <img class="rounded-3xl" src="{{ asset('assets/icons/content-2.svg') }}" alt="image-content">
        </div>
    </div>

    <div class=" text-center mt-24 mb-16">
        <h1 class="font-bold text-5xl mb-6">Jadwal Sparing Mini Soccer</h1>
        <p class=" text-lg mb-10">Jadwal yang tersedia saat ini untuk melakukan sparing bersama, ayo tantang mereka</p>
        {{-- table sparing --}}
        <div class="mx-auto">
            <table x-data="sparingHandler()" x-init="fetchSparings()" class="min-w-full leading-normal">
                <thead>
                    <tr class="shadow-lg rounded-xl ring-1 ring-gray-200">
                        <th
                            class="px-5 py-3 bg-white text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-s-xl">
                            Tim
                        </th>
                        <th
                            class="px-5 py-3 bg-white text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden lg:block">
                            Lokasi
                        </th>
                        <th
                            class="px-5 py-3 bg-white text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Waktu
                        </th>
                        <th
                            class="px-5 py-3 bg-white text-left text-xs font-semibold text-gray-600 uppercase tracking-wider sm:block hidden">
                            Tanggal
                            <i class="fas fa-sort-down"></i>
                        </th>
                        <th
                            class="px-5 py-3 bg-white text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-e-xl">
                            Lihat</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-if="sparings.length > 0">
                        <template x-for="sparing in sparings" :key="sparing.id">
                            <tr>
                                <td class="p-4 bg-white text-sm rounded-s-xl ">
                                    <div class="flex items-center text-left">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full rounded-full"
                                                :src="sparing.list_booking.user.profile_photo ? $store.storage.url + sparing
                                                    .list_booking.user.profile_photo : 'assets/images/profile.svg'"
                                                alt="Profile photo">
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap font-semibold"
                                                x-text="sparing.list_booking.user.team">
                                                $sparing->createdBy->team</p>
                                            <p class="text-gray-600 whitespace-no-wrap lg:hidden">Jl. Jenderal Sudirman No.
                                                45
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-7 px-4 text-left bg-white text-sm hidden lg:block">
                                    <p class="text-gray-900 whitespace-no-wrap">Jl. Jenderal Sudirman No. 45</p>
                                </td>
                                <td class="py-7 px-4 text-left bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap sm:hidden"
                                        x-text="sparing.list_booking.date">
                                        $sparing->listBooking->formatted_date</p>
                                    <p class="text-gray-900 whitespace-no-wrap" x-text="sparing.list_booking.session">
                                        $sparing->listBooking->formatted_session
                                    </p>
                                </td>
                                <td class="py-7 px-4 text-left bg-white text-sm hidden sm:block">
                                    <p class="text-gray-900 whitespace-no-wrap" x-text="sparing.list_booking.date">
                                        $sparing->listBooking->formatted_date</p>
                                </td>
                                <td class="py-7 px-4 text-center bg-white text-sm rounded-e-xl">
                                    <a href="{{ route('sparings.index') }}" class="text-black font-semibold">Lihat</a>
                                </td>
                            </tr>
                            <tr class="shadow-lg rounded-xl ring-1 ring-gray-200">
                            </tr>
                            <tr>
                                <td colspan="4" class="px-5 py-2 bg-transparent"></td>
                            </tr>
                        </template>
                    </template>
                </tbody>
                <template x-if="sparings.length === 0">
                    <tr>
                        <td colspan="5" class="px-5 py-6 bg-transparent">Tidak ada Sparing</td>
                    </tr>
                </template>
            </table>
        </div>

        {{-- content 3 --}}
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 lg:py-16 lg:grid-cols-12 mt-20">
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img class="rounded-3xl" src="{{ asset('assets/icons/content-2.svg') }}" alt="image-content">
            </div>
            <div class="ml-auto place-self-center lg:col-span-7 md:text-left text-right">
                <h1 class="text-5xl font-bold mb-6 max-w-2xl tracking-tight leading-none md:text-5xl xl:text-6xl">
                    Sudah punya team tapi gak tau mau lawan siapa?</h1>
                <h6 class="text-base mb-8 max-w-2xl font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl">
                    SKY CLUB punya solusinya! Ikuti komunitas sparing kami dan temukan lawan tanding yang seimbang.
                    Tingkatkan skill dan nikmati pertandingan seru dengan berbagai tim di sini!</h6>
                <a href="/sparing" class=" bg-red-600 rounded-lg px-6 py-3 font-semibold text-white">Lihat
                    Selengkapnya</a>
            </div>
        </div>

        {{-- testimonial --}}
        <div class=" text-center space-y-6 mt-24 mb-16">
            <h1 class="font-bold text-5xl">Testimonial</h1>
            <p class=" text-lg">Testimonials dari teman-teman Sky Club</p>
        </div>

        {{-- TESTIMONIAL CAROUSEL --}}
        <div x-data="carousel()">
            <div class="relative max-w-full overflow-hidden hidden lg:block">

                <template x-if="totalSlides > 0">
                    <div>
                        <!-- Previous Button -->
                        <button @click="prevSlide"
                            class="absolute left-1 top-1/2 transform -translate-y-1/2 bg-white border border-gray-300 rounded-full size-14 flex items-center justify-center shadow hover:bg-gray-100 z-10">
                            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                            </svg>
                        </button>

                        <!-- Slider Container -->
                        <div class="flex transition-transform duration-500"
                            :style="`transform: translateX(-${currentSlide * (100 / visibleCards)}%)`">
                            <template x-for="slide in slides" :key="slide.id">
                                <div class="flex-shrink-0 w-full sm:w-1/3 p-8">
                                    <div @click="ratingModal = true;  selectedSlide = slide"
                                        class="border border-gray-200 rounded-lg bg-white p-6 space-y-6 hover:shadow-xl transform hover:-translate-y-1 transition duration-300 cursor-pointer">
                                        <div class="text-yellow-500 text-left"
                                            x-text="'⭐'.repeat(parseInt(slide.rating))">⭐
                                        </div>
                                        <p class="text-gray-600 text-left" x-text="slide.comment"></p>
                                        <div class="flex space-x-4">
                                            <img class="rounded-full"
                                                :src="slide.user.profile_photo ? $store.storage.url + slide.user
                                                    .profile_photo : '{{ asset('assets/images/profile.svg') }}'"
                                                alt="" width="50px">
                                            <div>
                                                <p class=" font-semibold text-left" x-text="slide.user.name"></p>
                                                <p class="text-gray-500 text-sm text-left" x-text="slide.user.team"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Next Button -->
                        <button @click="nextSlide"
                            class="absolute right-1 top-1/2 transform -translate-y-1/2 bg-white border border-gray-300 rounded-full size-14 flex items-center justify-center shadow hover:bg-gray-100 z-10">
                            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                            </svg>
                        </button>

                        <!-- Rating Modal -->
                        <div x-show="ratingModal" x-cloak
                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-20 ">
                            <div @click.away="ratingModal = false" class="bg-white p-6 rounded-lg shadow-lg w-8/12">
                                <div class="flex justify-end">
                                    <button @click="ratingModal = false"
                                        class="hover:text-gray-900 text-gray-400 rounded-lg p-2">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="text-yellow-500 text-left mb-4"
                                    x-text="'⭐'.repeat(parseInt(selectedSlide?.rating))">
                                    ⭐⭐⭐⭐⭐</div>
                                <p class="text-gray-600 text-left mb-4" x-text="selectedSlide?.comment"></p>
                                <div class="flex space-x-4 mb-4">
                                    <img class="rounded-full w-12 h-12"
                                        :src="selectedSlide?.user.profile_photo ? $store.storage.url + selectedSlide?.user
                                            .profile_photo : '{{ asset('assets/images/profile.svg') }}'"
                                        {{-- :src="`{{ asset('storage/') }}/${selectedSlide?.user.profile_photo}`" --}} alt="">
                                    <div>
                                        <p class="font-semibold text-left" x-text="selectedSlide?.user.name"></p>
                                        <p class="text-gray-500 text-sm text-left" x-text="selectedSlide?.user.team"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <template x-if="totalSlides == 0">
                    <div class="text-center py-8">
                        <p class="text-gray-500">Tidak ada testimonial yang tersedia saat ini.</p>
                    </div>
                </template>
            </div>

            <div class="mx-10 lg:hidden block">
                <template x-for="(slide, index) in slides" :key="index">
                    <div class=" border-b-2 border-gray-200 bg-white py-6 space-y-6 text-left ">
                        <div class="flex space-x-4">
                            <img class="rounded-full" src="{{ asset('assets/images/profile.svg') }}" alt="">
                            <div>
                                <p class=" font-semibold" x-text="slide.user.name">Allan Raditya Hutomo</p>
                                <div class="text-yellow-500" @click="console.log(slide)">⭐⭐⭐⭐⭐</div>
                            </div>
                        </div>
                        <p class="text-gray-600" x-text="slide.comment"></p>
                    </div>
                </template>

                {{-- pagination --}}
            </div>
        </div>

        {{-- Blog Artikel --}}
        <div class="mt-20 mx-10">
            <div class="grid grid-row-1 space-y-4 content-center text-left">
                <h6 class="text-base font-bold">Artikel</h6>
                <h1 class="text-5xl font-bold">Apa Yang Baru</h1>
                <h5 class="text-base">Berikut adalah artikel-artikel terkait SKY CLUB</h5>
            </div>
            <div x-data="articlesHandler()" x-init="fetchArticles()"
                class="grid lg:grid-cols-3 grid-cols-1 justify-between mt-10 lg:space-y-0 space-y-6 gap-8">
                <template x-if="articles.length > 0">
                    <template x-for="article in articles" :key="article.id">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 lg:grid-rows-2 lg:max-w-sm bg-white border border-gray-200 rounded-lg shadow transform hover:-translate-y-1 transition duration-300 hover:shadow-xl">
                            <a class="hidden sm:block bg-cover h-72" :href="'/articles/' + article.id">
                                <img class="rounded-s-lg lg:rounded-none lg:rounded-t-lg h-full object-cover w-full"
                                    :src="article.image || '{{ asset('assets/images/blog-image.svg') }}'"
                                    :alt="article.title" />
                            </a>
                            <div class="p-4 text-left">
                                <div class="">
                                    <a :href="'/articles/' + article.id">
                                        <h5 x-text="article.title"
                                            class="mb-2 text-2xl font-bold tracking-tight text-gray-900"></h5>
                                    </a>
                                    <p class="mb-3 font-normal text-gray-700 break-words"
                                        x-text="article.content.text.substring(0, 150) + '...'"></p>
                                </div>
                                <div class="flex space-x-4 items-center mt-10">
                                    <img class="rounded-full w-10 h-10"
                                        :src="article.author.avatar || '{{ asset('assets/images/profile.svg') }}'"
                                        :alt="article.author.name">
                                    <div>
                                        <p x-text="article.author.name" class="text-xs md:text-sm font-semibold"></p>
                                        <p x-text="formatDate(article.created_at)" class="text-xs md:text-sm"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </template>

                <div x-show="isLoading" class="text-center py-8">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500">
                    </div>
                </div>

                <div x-show="error" class="text-red-500 p-4" x-text="error"></div>
            </div>

            <div class="flex justify-end my-10">
                <a href="{{ route('article.index') }}"
                    class=" bg-red-600 rounded px-4 py-2 font-semibold text-white hover:bg-red-800">Lihat
                    Semuanya</a>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function sparingHandler() {
            return {
                sparings: [],
                sparingModal: false,
                isLoading: false,
                async fetchSparings() {
                    this.isLoading = true;
                    try {
                        const response = await axios.get('/sparings');
                        console.log(response.data);
                        this.sparings = response.data.data; // Asumsikan API mengembalikan array objek sparing
                        console.log(this.sparings);
                    } catch (error) {
                        console.error('Terjadi Kesalahan Di Server:', error);
                    } finally {
                        this.isLoading = false;
                    }
                }
            }
        }

        function carousel() {
            return {
                currentSlide: 0,
                visibleCards: 3,
                slides: [],
                async init() {
                    try {
                        const response = await axios.get('reviews');
                        this.slides = response.data.data; // Asumsikan API mengembalikan array objek testimonial
                        console.log(this.slides);
                    } catch (error) {
                        console.error('Terjadi Kesalahan Di Server:', error);
                    }
                },
                get totalSlides() {
                    return this.slides.length;
                },
                prevSlide() {
                    if (this.currentSlide > 0) {
                        this.currentSlide--;
                    }
                },
                nextSlide() {
                    if (this.currentSlide < this.totalSlides - this.visibleCards) {
                        this.currentSlide++;
                    }
                },
                selectedSlide: null,
                ratingModal: false,
            };
        }

        function articlesHandler() {
            return {
                articles: [],
                articleModal: false,
                isLoading: false,
                error: null,
                async fetchArticles() {
                    this.isLoading = true;
                    this.error = null;
                    try {
                        const response = await axios.get('/articles');
                        console.log(response.data);
                        this.articles = response.data.data; // Asumsikan API mengembalikan array objek sparing
                        console.log(this.articles);
                    } catch (error) {
                        console.error('Terjadi Kesalahan Di Server:', error);
                    } finally {
                        this.isLoading = false;
                    }
                },
                formatDate(dateString) {
                    if (!dateString) return '';
                    const options = {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    };
                    return new Date(dateString).toLocaleDateString('id-ID', options);
                }
            }
        }
    </script>
@endpush

{{-- @push('script')
    <script>
        function carousel() {
            return {
                currentSlide: 0,
                visibleCards: 3,

                get totalSlides() {
                    return this.slides.length;
                },
                prevSlide() {
                    if (this.currentSlide > 0) {
                        this.currentSlide--;
                    }
                },
                nextSlide() {
                    if (this.currentSlide < this.totalSlides - this.visibleCards) {
                        this.currentSlide++;
                    }
                },
                selectedSlide: null,
                ratingModal: false,
            };
        }

        function sparingHandler() {
            return {
                sparings: [],
                sparingModal: false,
                isLoading: false,
                async fetchSparings() {
                    this.isLoading = true;
                    try {
                        const response = await axios.get('/sparings');
                        console.log(response.data);
                        this.sparings = response.data.data; // Asumsikan API mengembalikan array objek sparing
                        console.log(this.sparings);
                    } catch (error) {
                        console.error('Terjadi Kesalahan Di Server:', error);
                    } finally {
                        this.isLoading = false;
                    }
                }
            }
        }

        function articlesHandler() {
            return {
                articles: [],
                articleModal: false,
                isLoading: false,
                error: null,
                async fetchArticles() {
                    this.isLoading = true;
                    this.error = null;
                    try {
                        const response = await axios.get('/articles');
                        console.log(response.data);
                        this.articles = response.data.data; // Asumsikan API mengembalikan array objek sparing
                        console.log(this.articles);
                    } catch (error) {
                        console.error('Terjadi Kesalahan Di Server:', error);
                    } finally {
                        this.isLoading = false;
                    }
                }
                formatDate(dateString) {
                    if (!dateString) return '';
                    const options = {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    };
                    return new Date(dateString).toLocaleDateString('id-ID', options);
                }
            }
        }
    </script>
@endpush --}}
