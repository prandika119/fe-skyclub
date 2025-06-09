@extends('layouts.master')

@section('content')
    <div x-data="articlesHandler()" x-init="fetchArticles()">
        <div class="my-10 mt-20 w-fit">
            <p class="mb-2 font-semibold rounded-full bg-rose-200 text-red-500 w-fit px-3">Article</p>
            <h1 class="font-bold text-4xl xs:text-56 my-6">Kumpulan Artikel</h1>
            <p>Artikel mengenai kegiatan dan event yang berlangsung pada Sky Club</p>
        </div>
        {{-- <div class="h-[300px] ">
            <div class="grid grid-cols-3 gap-4 min-h-[600px]">
                <!-- Carousel Section -->
                <div x-data="initCarousel()" class=" col-span-3 lg:col-span-2">
                    <div class="relative w-full h-[600px]  lg:h-full overflow-hidden rounded-2xl">
                        <template x-for="(slide, index) in slides" :key="slide.id">
                            <div class="absolute" x-text="slide.title"></div>
                            <div x-show="currentSlide === index"
                                class="absolute inset-0 transition-all duration-1000 overflow-hidden"
                                x-transition:enter="transition ease-out duration-1000"
                                x-transition:enter-start="opacity-0 transform translate-x-full"
                                x-transition:enter-end="opacity-100 transform translate-x-0"
                                x-transition:leave="transition ease-in duration-1000"
                                x-transition:leave-start="opacity-100 transform translate-x-0"
                                x-transition:leave-end="opacity-0 transform -translate-x-full">
                                <div class="">
                                    <img class="w-full h-full object-cover rounded-2xl"
                                        src="{{ asset('assets/images/banner/banner.svg') }}" :alt="slide.title" />
                                    <!-- :src="$store.storage.getPhoto(slide.content.images[0] ? slide.photo :
                                            '/storage/assets/images/slider/album_1.svg')" -->
                                </div>
                                <div
                                    class="absolute bottom-0 left-0 right-0 rounded-b-2xl backdrop-blur h-[30%] xxs:h-3/6 md:h-2/6 p-4 place-content-between flex flex-col break-words">
                                    <div class="flex justify-between gap-8 md:gap-16 break-words">
                                        <div class="space-y-4">
                                            <a :href="`/articles/${slide.id}`"
                                                class="text-3xl font-bold text-white break-words" x-text="slide.title"></a>
                                            <p class="xxs:block hidden break-words text-gray-200"
                                                x-text="slide.content.text.substring(0, 100) + '...'"></p>
                                        </div>
                                        <a :href="`/articles/${slide.id}`" class="size-fit cursor-pointer">
                                            <svg class="w-6 h-6 text-white hover:text-gray-300 stroke-2"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="space-x-2 mt-3 mr-12 xs:mr-24 items-center flex">
                                            <img class="rounded-full w-10 h-10"
                                                :src="slide.author.avatar || '{{ asset('assets/images/profile.svg') }}'"
                                                :alt="slide.author.name">
                                            <div>
                                                <p class="font-semibold text-white" x-text="slide.author.name"></p>
                                                <p class="xs:hidden text-white" x-text="formatDate(slide.created_at)"></p>
                                            </div>
                                        </div>
                                        <div class="hidden xs:flex space-x-2 mt-3 items-center">
                                            <div
                                                class="size-10 rounded-full flex justify-center items-center ring-1 ring-gray-200">
                                                <svg class="w-6 h-6 text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M4 10h16M8 14h8m-4-7V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                                                </svg>
                                            </div>
                                            <p class="font-semibold text-white" x-text="formatDate(slide.created_at)"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Recent Articles Sidebar -->
                <div class="lg:flex flex-col place-content-between bg-amber-400">
                    <p class="text-3xl font-semibold">Recent Article</p>
                    <div class="flex flex-col items-start">
                        <template x-for="article in recentArticles" :key="article.id">
                            <a :href="`/articles/${article.id}`" class="grid grid-flow-col py-4 border-b-2 gap-2">
                                <div class="size-20 bg-cover">
                                    <img class="w-full h-full object-cover rounded-xl"
                                        :src="article.image || '{{ asset('assets/images/album_1.svg') }}'"
                                        :alt="article.title">
                                </div>
                                <div class="flex items-center">
                                    <p class="font-semibold"
                                        x-text="article.title.substring(0, 50) + (article.title.length > 50 ? '...' : '')">
                                    </p>
                                </div>
                            </a>
                        </template>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- All Articles Section -->
        <div class="grid grid-cols-1 lg:grid-flow-col mt-16 mb-8">
            <div class="flex items-center border-b-2">
                <p class="font-semibold text-4xl">All Article</p>
            </div>
            <div class="justify-items-end mt-4">
                <div class="w-full lg:w-[500px]">
                    <label for="article-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                    <div class="relative">
                        <input x-model="searchQuery" @input.debounce.500ms="searchArticles" type="search"
                            id="article-search"
                            class="block w-full p-4 ps-7 text-sm text-gray-900 border border-gray-300 rounded-full bg-gray-50 focus:ring-red-500 focus:border-red-500"
                            placeholder="Search articles..." />
                        <button @click="searchArticles"
                            class="text-white absolute end-2.5 bottom-2.5 font-medium rounded-lg text-sm px-4 py-2 bg-gray-50">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 xs:grid-cols-2 lg:grid-cols-3 xxl:grid-cols-4 gap-4 mb-8 sm:gap-6 md:gap-10">
            <template x-for="article in filteredArticles" :key="article.id">
                <div
                    class="max-w-full bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl transform hover:-translate-y-1 transition duration-300">
                    <div class="h-70 bg-cover">
                        <a :href="`/articles/${article.id}`">
                            <img class="rounded-t-lg object-cover w-full h-full"
                                :src="$store.storage.getPhoto(article.content.image, 'assets/images/album_1.svg')"
                                :alt="article.title" />
                        </a>
                    </div>
                    <div class="p-2 md:p-5">
                        <a :href="`/articles/${article.id}`">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"
                                x-text="article.title.substring(0, 40) + (article.title.length > 40 ? '...' : '')"></h5>
                        </a>
                        <p class="break-words font-normal text-gray-700"
                            x-text="article.content.text.substring(0, 100) + '...'">
                        </p>
                        <div class="space-x-4 items-center flex mt-5">
                            <img class="rounded-full"
                                :src="article.author.avatar || '{{ asset('assets/images/profile.svg') }}'"
                                :alt="article.author.name">
                            <div>
                                <p class="text-xs md:text-sm font-semibold" x-text="article.author.name"></p>
                                <p class="text-xs md:text-sm" x-text="formatDate(article.created_at)"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <div x-show="filteredArticles.length === 0 && !loading" class="col-span-4 text-center text-gray-500 py-10">
                Tidak ada artikel tersedia
            </div>

            <div x-show="loading" class="col-span-4 text-center text-gray-500 py-10">
                Memuat artikel...
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <!-- <div x-show="!loading && filteredArticles.length > 0" class="mb-4 flex justify-center">
                                                                                                                                                                                                                                                                                                                                                <div class="flex space-x-2">
                                                                                                                                                                                                                                                                                                                                                    <button @click="prevPage" :disabled="currentPage
                                                                                                                                                                                                                                                                                                                                                        ===
                                                                                                                                                                                                                                                                                                                                                        1" class="px-4 py-2 rounded-lg border" :class="{
                                                                                                                                                                                                                                                                                                                                                        'opacity-50 cursor-not-allowed': currentPage ===
                                                                                                                                                                                                                                                                                                                                                            1
                                                                                                                                                                                                                                                                                                                                                    }">
                                                                                                                                                                                                                                                                                                                                                        Previous
                                                                                                                                                                                                                                                                                                                                                    </button>
                                                                                                                                                                                                                                                                                                                                                    <span class="px-4 py-2" x-text="`Page ${currentPage} of ${totalPages}`"></span>
                                                                                                                                                                                                                                                                                                                                                    <button @click="nextPage" :disabled="currentPage
                                                                                                                                                                                                                                                                                                                                                        >=
                                                                                                                                                                                                                                                                                                                                                        totalPages" class="px-4 py-2 rounded-lg border" :class="{
                                                                                                                                                                                                                                                                                                                                                        'opacity-50 cursor-not-allowed': currentPage >=
                                                                                                                                                                                                                                                                                                                                                            totalPages
                                                                                                                                                                                                                                                                                                                                                    }">
                                                                                                                                                                                                                                                                                                                                                        Next
                                                                                                                                                                                                                                                                                                                                                    </button>
                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                            </div> -->
@endsection

@push('script')
    <script>
        // document.addEventListener('alpine:init', () => {
        //     Alpine.data('carousel', () => ({
        //         currentSlide: 0,
        //         slides: [],
        //         interval: null,

        //         initCarousel() {
        //             this.$watch('slides', (value) => {
        //                 this.slides = value;
        //                 if (value.length > 0) {
        //                     this.startAutoSlide();
        //                 }
        //             });
        //         },

        //         nextSlide() {
        //             if (this.currentSlide < this.slides.length - 1) {
        //                 this.currentSlide++;
        //             } else {
        //                 this.currentSlide = 0;
        //             }
        //         },

        //         startAutoSlide() {
        //             this.clearAutoSlide();
        //             this.interval = setInterval(() => {
        //                 this.nextSlide();
        //             }, 12000);
        //         },

        //         clearAutoSlide() {
        //             if (this.interval) {
        //                 clearInterval(this.interval);
        //             }
        //         }
        //     }))
        // })
        // function carousel() {
        //     return {
        //         currentSlide: 0,
        //         slides: [],
        //         interval: null,

        //         initCarousel() {
        //             this.$watch('slides', (value) => {
        //                 this.slides = value;
        //                 if (value.length > 0) {
        //                     this.startAutoSlide();
        //                 }
        //             });
        //         },

        //         nextSlide() {
        //             if (this.currentSlide < this.slides.length - 1) {
        //                 this.currentSlide++;
        //             } else {
        //                 this.currentSlide = 0;
        //             }
        //         },

        //         startAutoSlide() {
        //             this.clearAutoSlide();
        //             this.interval = setInterval(() => {
        //                 this.nextSlide();
        //             }, 12000);
        //         },

        //         clearAutoSlide() {
        //             if (this.interval) {
        //                 clearInterval(this.interval);
        //             }
        //         }
        //     }
        // }

        function articlesHandler() {
            return {
                articles: [],
                loading: false,
                error: null,
                allArticles: [],
                filteredArticles: [],
                recentArticles: [],
                searchQuery: '',
                currentPage: 1,
                itemsPerPage: 12,
                totalPages: 1,
                meta: {},

                currentSlide: 0,
                slides: [],
                interval: null,

                initCarousel() {
                    this.$watch('slides', (value) => {
                        this.slides = value;
                        if (value.length > 0) {
                            this.startAutoSlide();
                        }
                    });
                },

                nextSlide() {
                    if (this.currentSlide < this.slides.length - 1) {
                        this.currentSlide++;
                    } else {
                        this.currentSlide = 0;
                    }
                },

                startAutoSlide() {
                    this.clearAutoSlide();
                    this.interval = setInterval(() => {
                        this.nextSlide();
                    }, 12000);
                },

                clearAutoSlide() {
                    if (this.interval) {
                        clearInterval(this.interval);
                    }
                },

                async fetchArticles() {
                    this.loading = true;
                    this.error = null;
                    try {
                        const response = await axios.get('/articles');
                        this.allArticles = response.data.data;
                        this.meta = response.data.meta;

                        // Prepare carousel slides (first 3 articles)
                        this.slides = this.allArticles.slice(0, 3).map(article => ({
                            ...article,
                            image: article.image || 'assets/images/album_1.svg'
                        }));

                        // Prepare recent articles (next 5 articles)
                        this.recentArticles = this.allArticles.slice(3, 8);

                        // Initialize filtered articles with pagination
                        this.totalPages = Math.ceil(this.allArticles.length / this.itemsPerPage);
                        this.filteredArticles = this.paginate(this.allArticles);
                        console.log("filterArtikel ", this.filteredArticles);
                        console.log("all ", this.allArticles);
                        console.log("recent ", this.recentArticles)
                        console.log("slides ", this.slides);

                    } catch (error) {
                        console.error('Error fetching articles:', error);
                        this.error = 'Gagal memuat artikel. Silakan coba lagi nanti.';
                    } finally {
                        this.loading = false;
                    }
                },

                searchArticles() {
                    if (!this.searchQuery) {
                        this.filteredArticles = this.paginate(this.allArticles);
                        this.totalPages = Math.ceil(this.allArticles.length / this.itemsPerPage);
                        this.currentPage = 1;
                        return;
                    }

                    const query = this.searchQuery.toLowerCase();
                    const results = this.allArticles.filter(article =>
                        article.title.toLowerCase().includes(query) ||
                        article.content.toLowerCase().includes(query)
                    );

                    this.currentPage = 1;
                    this.filteredArticles = this.paginate(results);
                    this.totalPages = Math.ceil(results.length / this.itemsPerPage);
                },

                paginate(items) {
                    const start = (this.currentPage - 1) * this.itemsPerPage;
                    return items.slice(start, start + this.itemsPerPage);
                },

                nextPage() {
                    if (this.currentPage < this.totalPages) {
                        this.currentPage++;
                        this.updateFilteredArticles();
                    }
                },

                prevPage() {
                    if (this.currentPage > 1) {
                        this.currentPage--;
                        this.updateFilteredArticles();
                    }
                },

                updateFilteredArticles() {
                    const items = this.searchQuery ?
                        this.allArticles.filter(article =>
                            article.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                            article.content.toLowerCase().includes(this.searchQuery.toLowerCase())
                        ) : this.allArticles;

                    this.filteredArticles = this.paginate(items);
                },

                formatDate(dateString) {
                    if (!dateString) return '';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('id-ID', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                }
            }
        }
    </script>
@endpush
