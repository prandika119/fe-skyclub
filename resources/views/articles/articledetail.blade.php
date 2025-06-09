@extends('layouts.master')

@section('content')
    <div x-data="articleDetail()" x-init="fetchArticle()" class="mt-20">
        <!-- Loading State -->
        <div x-show="loading" class="text-center py-20">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-red-600"></div>
            <p class="mt-4">Memuat artikel...</p>
        </div>

        <!-- Error State -->
        <div x-show="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" x-text="error"></div>

        <!-- Article Content -->
        <template x-if="article && !loading">
            <div>
                <!-- Article Header -->
                <div class="grid grid-cols-1 md:grid-cols-2 mt-20 gap-8">
                    <div class="grid grid-cols-1 content-center">
                        <h3 class="text-3xl md:text-5xl font-bold leading-tight mb-12" x-text="article.title"></h3>
                        <div>
                            <p>Oleh <span class="font-semibold" x-text="article.author.name"></span></p>
                            <div class="flex items-center">
                                <p x-text="formatDate(article.created_at)"></p>
                                <span class="w-1.5 h-1.5 mx-1.5 bg-black rounded-full"></span>
                                <p x-text="formatTime(article.created_at)"></p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-cover rounded-lg shadow">
                        <img class="object-cover w-full h-full rounded-lg transition-transform duration-300 hover:scale-105"
                            :src="article.image || '{{ asset('images/default-article.jpg') }}'" :alt="article.title">
                    </div>
                </div>

                <!-- Article Body -->
                <article class="mt-28 mx-auto w-full max-w-2xl break-words">
                    <div class="prose max-w-none" x-html="article.content.text"></div>

                    <hr class="h-px my-10 bg-gray-400 border-0">

                    <div class="flex space-x-4">
                        <img class="rounded-full w-12 h-12"
                            :src="article.author.avatar || '{{ asset('images/profile.svg') }}'" :alt="article.author.name">
                        <div>
                            <p class="font-semibold" x-text="article.author.name"></p>
                            <p x-text="timeAgo(article.created_at)"></p>
                        </div>
                    </div>
                </article>

                <!-- Recent Articles (using same component but with different title) -->
                <div class="mt-28 mb-20">
                    <div class="flex justify-between">
                        <div class="space-y-4">
                            <h6 class="text-base font-bold">Artikel</h6>
                            <h1 class="text-3xl md:text-5xl font-bold">Artikel Terbaru</h1>
                            <h5 class="text-base">Menampilkan artikel terbaru dari Sky Club.</h5>
                        </div>
                        <div class="self-end">
                            <a href="{{ route('article.index') }}"
                                class="bg-red-600 rounded px-4 py-2 font-semibold text-white hover:bg-red-700 transition">
                                Lihat Semuanya
                            </a>
                        </div>
                    </div>

                    <!-- This would be loaded separately or via main page -->
                    <div class="grid lg:grid-cols-3 grid-cols-1 justify-between mt-10 gap-6">
                        <!-- Recent articles would be loaded here -->
                        <div class="text-center py-10 text-gray-500">
                            Kunjungi halaman artikel untuk melihat daftar lengkap
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
@endsection

@push('script')
    <script>
        function articleDetail() {
            return {
                article: null,
                loading: true,
                error: null,
                articleId: null,

                async fetchArticle() {
                    this.articleId = window.location.pathname.split('/').pop(); // Get article ID from URL

                    try {
                        // Fetch main article
                        const response = await axios.get(`/articles/${this.articleId}`);

                        this.article = response.data.data;

                    } catch (error) {
                        console.error('Error loading article:', error);
                        this.error = error.response?.data?.message || 'Gagal memuat artikel';
                        if (error.response?.status === 404) {
                            this.error = 'Artikel tidak ditemukan';
                        }
                    } finally {
                        this.loading = false;
                    }
                },

                formatDate(dateString) {
                    if (!dateString) return '';
                    const options = {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        timeZone: 'Asia/Jakarta'
                    };
                    return new Date(dateString).toLocaleDateString('id-ID', options);
                },

                formatTime(dateString) {
                    if (!dateString) return '';
                    return new Date(dateString).toLocaleTimeString('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit',
                        timeZone: 'Asia/Jakarta'
                    });
                },

                timeAgo(dateString) {
                    if (!dateString) return '';
                    const date = new Date(dateString);
                    const now = new Date();
                    const seconds = Math.floor((now - date) / 1000);

                    const intervals = {
                        tahun: 31536000,
                        bulan: 2592000,
                        minggu: 604800,
                        hari: 86400,
                        jam: 3600,
                        menit: 60,
                        detik: 1
                    };

                    for (const [unit, secondsInUnit] of Object.entries(intervals)) {
                        const interval = Math.floor(seconds / secondsInUnit);
                        if (interval >= 1) {
                            return `${interval} ${unit} yang lalu`;
                        }
                    }

                    return 'Baru saja';
                },

                async fetchLatestArticles() {
                    try {
                        const response = await axios.get('articles?limit=3');
                        this.latestArticles = response.data.data;
                    } catch (error) {
                        console.error('Error loading latest articles:', error);
                    }
                }
            }
        }
        // document.addEventListener('alpine:init', () => {
        //     Alpine.data('articleDetail', () => ({
        //         article: null,
        //         loading: true,
        //         error: null,

        //         async fetchArticle(articleId) {
        //             try {
        //                 // Fetch main article
        //                 const response = await axios.get(`/articles/${this.articleId}`);

        //                 if (response.data.status === 'success') {
        //                     this.article = response.data.data;
        //                 } else {
        //                     this.error = 'Artikel tidak ditemukan';
        //                 }
        //             } catch (error) {
        //                 console.error('Error loading article:', error);
        //                 this.error = error.response?.data?.message || 'Gagal memuat artikel';
        //                 if (error.response?.status === 404) {
        //                     this.error = 'Artikel tidak ditemukan';
        //                 }
        //             } finally {
        //                 this.loading = false;
        //             }
        //         },

        //         formatDate(dateString) {
        //             if (!dateString) return '';
        //             const options = {
        //                 weekday: 'long',
        //                 year: 'numeric',
        //                 month: 'long',
        //                 day: 'numeric',
        //                 timeZone: 'Asia/Jakarta'
        //             };
        //             return new Date(dateString).toLocaleDateString('id-ID', options);
        //         },

        //         formatTime(dateString) {
        //             if (!dateString) return '';
        //             return new Date(dateString).toLocaleTimeString('id-ID', {
        //                 hour: '2-digit',
        //                 minute: '2-digit',
        //                 timeZone: 'Asia/Jakarta'
        //             });
        //         }

        //         timeAgo(dateString) {
        //             if (!dateString) return '';
        //             const date = new Date(dateString);
        //             const now = new Date();
        //             const seconds = Math.floor((now - date) / 1000);

        //             const intervals = {
        //                 tahun: 31536000,
        //                 bulan: 2592000,
        //                 minggu: 604800,
        //                 hari: 86400,
        //                 jam: 3600,
        //                 menit: 60,
        //                 detik: 1
        //             };

        //             for (const [unit, secondsInUnit] of Object.entries(intervals)) {
        //                 const interval = Math.floor(seconds / secondsInUnit);
        //                 if (interval >= 1) {
        //                     return `${interval} ${unit} yang lalu`;
        //                 }
        //             }

        //             return 'Baru saja';
        //         }

        //         async fetchLatestArticles() {
        //             try {
        //                 const response = await axios.get('articles?limit=3');
        //                 this.latestArticles = response.data.data;
        //             } catch (error) {
        //                 console.error('Error loading latest articles:', error);
        //             }
        //         }
        //     }));
        // });
    </script>
@endpush
