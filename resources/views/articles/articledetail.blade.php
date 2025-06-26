@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4" x-data="articlePage()" x-init="fetchData()">

        <div x-show="isLoading" class="text-center py-40">
            <p class="text-2xl font-semibold">Loading article...</p>
        </div>

        <div x-show="!isLoading" x-cloak>

            <div class="grid grid-cols-1 lg:grid-cols-2 mt-20 gap-10">
                <div class="grid grid-cols-1 content-center">
                    <h3 class="text-5xl font-bold leading-tight mb-12"
                        x-text="article.title ? article.title.substring(0, 120) : ''"></h3>
                    <div>
                        <p>By <span class="font-semibold"
                                x-text="article.author ? article.author.name : 'Unknown Author'"></span></p>
                        <div class="flex items-center">
                            <p x-text="formatDate(article.created_at, {day: 'numeric', month: 'long', year: 'numeric'})">
                            </p>
                            <span class="w-1.5 h-1.5 mx-1.5 bg-black rounded-full"></span>
                            <p x-text="formatDate(article.created_at, {hour: '2-digit', minute: '2-digit'})"></p>
                        </div>
                    </div>
                </div>
                <div class="bg-cover rounded-lg shadow h-96">
                    <img class="object-cover w-full h-full rounded-lg transition-transform duration-300 hover:scale-105"
                        :src="getBannerImage()" alt="Article Banner">
                </div>
            </div>

            <article class="mt-28 mx-auto w-full max-w-2xl break-words">
                <div class="prose">
                    <template x-if="article.content && article.content.blocks">
                        <template x-for="(block, index) in article.content.blocks" :key="index">
                            <div>
                                <template x-if="block.type === 'paragraph'">
                                    <p class="text-gray-700 leading-relaxed" x-html="block.data.text || ''"></p>
                                </template>

                                <template x-if="block.type === 'header'">
                                    <h2 x-show="block.data.level === 2" :id="slugify(block.data.text)"
                                        x-text="block.data.text"></h2>
                                    <h3 x-show="block.data.level === 3" :id="slugify(block.data.text)"
                                        x-text="block.data.text"></h3>
                                    <h4 x-show="block.data.level === 4" :id="slugify(block.data.text)"
                                        x-text="block.data.text"></h4>
                                </template>

                                <template x-if="block.type === 'image'">
                                    <div class="my-6">
                                        <img :src="$store.storage.getPhoto(block.data.file.url)"
                                            :alt="block.data.caption || 'Image'"
                                            class="rounded-lg shadow-md w-full object-cover transition-transform duration-300 hover:scale-105">
                                        <template x-if="block.data.caption">
                                            <p class="text-center text-sm text-gray-500 italic" x-text="block.data.caption">
                                            </p>
                                        </template>
                                    </div>
                                </template>

                                <template x-if="block.type === 'list'">
                                    <div>
                                        <ol x-if="block.data.style === 'ordered'"
                                            class="list-decimal pl-6 mb-6 text-gray-700 space-y-2">
                                            <template x-for="item in block.data.items">
                                                <li class="text-base" x-html="item.content || ''"></li>
                                            </template>
                                        </ol>
                                        <ul x-if="block.data.style !== 'ordered'"
                                            class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
                                            <template x-for="item in block.data.items">
                                                <li class="text-base" x-html="item.content || ''"></li>
                                            </template>
                                        </ul>
                                    </div>
                                </template>

                                <template x-if="block.type === 'checklist'">
                                    <ul class="mb-6 space-y-2">
                                        <template x-for="item in block.data.items">
                                            <li class="flex items-center space-x-3">
                                                <input type="checkbox"
                                                    class="form-checkbox h-5 w-5 text-red-500 rounded border-gray-300 transition"
                                                    :checked="item.checked" disabled>
                                                <span class="text-gray-700 text-base" x-text="item.text || ''"></span>
                                            </li>
                                        </template>
                                    </ul>
                                </template>

                                <template x-if="block.type === 'quote'">
                                    <blockquote
                                        class="border-l-4 border-red-600 py-3 pl-6 italic text-lg text-gray-600 mb-6">
                                        <p x-html="block.data.text || ''"></p>
                                        <template x-if="block.data.caption">
                                            <footer class="text-sm text-gray-500">- <span
                                                    x-text="block.data.caption"></span></footer>
                                        </template>
                                    </blockquote>
                                </template>

                                <template x-if="block.type === 'table'">
                                    <div class="overflow-x-auto my-6">
                                        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                                            <thead>
                                                <tr class="bg-gray-100">
                                                    <template x-for="header in block.data.content[0]">
                                                        <th class="py-3 px-5 border-b border-gray-300 text-left text-sm font-semibold text-gray-700 uppercase"
                                                            x-text="header"></th>
                                                    </template>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template x-for="row in block.data.content.slice(1)">
                                                    <tr class="even:bg-gray-50 odd:bg-white">
                                                        <template x-for="cell in row">
                                                            <td class="py-3 px-5 border-b border-gray-300 text-sm text-gray-800"
                                                                x-text="cell"></td>
                                                        </template>
                                                    </tr>
                                                </template>
                                            </tbody>
                                        </table>
                                    </div>
                                </template>

                                <template x-if="block.type === 'warning'">
                                    <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4 rounded-md shadow-sm my-6">
                                        <h4 class="font-semibold text-yellow-700 mt-2"
                                            x-text="block.data.title || 'Warning'"></h4>
                                        <p class="text-sm text-yellow-800 mb-2"
                                            x-text="block.data.message || 'No details provided.'"></p>
                                    </div>
                                </template>

                                <template x-if="block.type === 'delimiter'">
                                    <div class="text-center my-4">
                                        <span class="text-5xl text-gray-800">* * *</span>
                                    </div>
                                </template>

                            </div>
                        </template>
                    </template>
                    <template x-if="!article.content || !article.content.blocks || article.content.blocks.length === 0">
                        <p class="text-gray-500 italic">No content available</p>
                    </template>

                    <hr class="h-px my-10 bg-gray-400 border-0 dark:bg-gray-700">
                </div>
                <div class="flex space-x-4 items-center">
                    <img class="w-16 h-16 rounded-full" :src="$store.storage.getPhoto(article.author.profile_photo)"
                        alt="Author profile picture">
                    <div>
                        <p class="font-semibold" x-text="article.author ? article.author.name : ''"></p>
                        <p x-text="timeAgo(article.created_at)"></p>
                    </div>
                </div>
            </article>

            <div class="mt-28 mb-20">
                <div class="flex flex-col sm:flex-row justify-between ">
                    <div class="space-y-4 mb-4 sm:mb-0">
                        <h6 class="text-base font-bold">Artikel</h6>
                        <h1 class="text-5xl font-bold">Artikel Serupa</h1>
                        <h5 class="text-base">Menampilkan artikel yang serupa dengan artikel ini untuk membantu Anda
                            menemukan lebih banyak konten yang relevan.</h5>
                    </div>
                    <div class="self-start sm:self-end">
                        <a href="/articles" class="bg-red-600 rounded px-4 py-2 font-semibold text-white">Lihat
                            Semuanya</a>
                    </div>
                </div>
                <div class="grid lg:grid-cols-3 grid-cols-1 justify-between mt-10 lg:space-y-0 space-y-6 gap-10">
                    <template x-for="moreArticle in moreArticles" :key="moreArticle.id">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 bg-white border border-gray-200 rounded-lg shadow transform hover:-translate-y-1 transition duration-300 hover:shadow-xl">
                            <a class="hidden sm:block lg:row-span-1 bg-cover h-72" :href="`/article/${moreArticle.id}`">
                                <img class="rounded-s-lg lg:rounded-none lg:rounded-t-lg h-full object-cover w-full"
                                    :src="$store.storage.getPhoto(moreArticle.image, '/assets/images/banner/banner.svg')"
                                    :alt="`Image for ${moreArticle.title}`" />
                            </a>
                            <div class="p-4 text-left lg:row-span-1 flex flex-col justify-between">
                                <div>
                                    <a :href="`/article/${moreArticle.id}`">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"
                                            x-text="moreArticle.title"></h5>
                                    </a>
                                    <p class="mb-3 font-normal text-gray-700 break-words" x-text="moreArticle.paragraph">
                                    </p>
                                </div>
                                <div class="flex space-x-4 items-center mt-10">
                                    <img class="h-10 w-10 rounded-full"
                                        :src="$store.storage.getPhoto(moreArticle.author.profile_photo)" alt="">
                                    <div>
                                        <p class="text-xs md:text-sm font-semibold" x-text="moreArticle.author.name"></p>
                                        <p class="text-xs md:text-sm"
                                            x-text="formatDate(moreArticle.created_at, {day: 'numeric', month: 'long', year: 'numeric'})">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mock data representing the JSON you would get from your API.
        // In a real application, the `fetchData` function would get this from a URL.
        const MOCK_ARTICLE_API_RESPONSE = {
            id: 123,
            title: "The Future of Web Development with Alpine.js and Tailwind CSS",
            created_at: "2025-06-26T10:30:00.000000Z",
            author: {
                name: "Jane Doe"
            },
            content: {
                time: 1672531200000,
                blocks: [{
                        type: 'header',
                        data: {
                            text: 'Introduction to Modern Tooling',
                            level: 2
                        }
                    },
                    {
                        type: 'paragraph',
                        data: {
                            text: 'The web development landscape is constantly evolving. In this article, we explore how tools like <b>Tailwind CSS</b> for utility-first styling and <b>Alpine.js</b> for lightweight interactivity are changing the game. They allow for rapid development without the overhead of heavy frameworks.'
                        }
                    },
                    {
                        type: 'image',
                        data: {
                            file: {
                                url: 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=2070'
                            },
                            caption: 'Code on a screen, representing modern development.'
                        }
                    },
                    {
                        type: 'list',
                        data: {
                            style: 'unordered',
                            items: [{
                                content: 'Faster development cycles'
                            }, {
                                content: 'Lower JavaScript bundle size'
                            }, {
                                content: 'Declarative and reactive templating'
                            }]
                        }
                    },
                    {
                        type: 'quote',
                        data: {
                            text: 'The ability to create complex, reactive UIs with simple HTML attributes is a paradigm shift.',
                            caption: 'A Web Developer'
                        }
                    },
                    {
                        type: 'delimiter',
                        data: {}
                    },
                    {
                        type: 'table',
                        data: {
                            content: [
                                ['Tool', 'Primary Use'],
                                ['Tailwind CSS', 'Styling'],
                                ['Alpine.js', 'Interactivity'],
                                ['Laravel', 'Backend API']
                            ]
                        }
                    },
                    {
                        type: 'warning',
                        data: {
                            title: 'Browser Support',
                            message: 'Ensure you have the necessary polyfills if you need to support older browsers like Internet Explorer 11.'
                        }
                    },
                    {
                        type: 'checklist',
                        data: {
                            items: [{
                                text: 'Setup Tailwind',
                                checked: true
                            }, {
                                text: 'Install Alpine.js',
                                checked: true
                            }, {
                                text: 'Fetch API data',
                                checked: false
                            }]
                        }
                    }
                ],
                version: '2.22.2'
            }
        };

        // const MOCK_MORE_ARTICLES_API_RESPONSE = [{
        //         id: 101,
        //         title: 'Getting Started with Utility-First CSS',
        //         paragraph: 'A deep dive into why utility-first CSS is gaining so much popularity among developers.',
        //         image: 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=2070',
        //         created_by: 'John Smith',
        //         created_at: '2025-06-20T11:00:00Z'
        //     },
        //     {
        //         id: 102,
        //         title: 'Is jQuery Still Relevant in 2025?',
        //         paragraph: 'Exploring the role of jQuery in a world dominated by modern frameworks and libraries.',
        //         image: 'https://images.unsplash.com/photo-1618477388954-7852f32655ec?q=80&w=1964',
        //         created_by: 'Emily White',
        //         created_at: '2025-06-18T15:45:00Z'
        //     },
        //     {
        //         id: 103,
        //         title: 'Building a Headless CMS with Laravel',
        //         paragraph: 'Learn how to power modern frontends with a robust Laravel backend API.',
        //         image: 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?q=80&w=1974',
        //         created_by: 'Chris Green',
        //         created_at: '2025-06-15T09:20:00Z'
        //     }
        // ];


        function articlePage() {
            return {
                isLoading: true,
                article: {},
                moreArticles: [],

                // Fetches all necessary data from the API
                async fetchData() {
                    this.isLoading = true;
                    try {
                        // In a real application, you would use fetch() here:
                        // const articleId = 123; // Get from URL
                        // const [articleRes, moreArticlesRes] = await Promise.all([
                        //     fetch(`/api/article/${articleId}`),
                        //     fetch(`/api/article/${articleId}/similar`)
                        // ]);
                        // this.article = await articleRes.json();
                        // this.moreArticles = await moreArticlesRes.json();
                        const articleId = window.location.pathname.split('/').pop(); // Get the article ID from the URL
                        const response = await axios.get(`articles/${articleId}`);
                        this.article = response.data.data;
                        const moreArticleResponse = await axios.get('articles')
                        this.moreArticles = moreArticleResponse.data.data || [];
                    } catch (error) {
                        console.error('Error fetching data:', error);
                        // Optionally, show an error message to the author
                    } finally {
                        this.isLoading = false;
                    }
                },

                // Helper to format date strings
                formatDate(dateString, options) {
                    if (!dateString) return '';
                    return new Date(dateString).toLocaleDateString(undefined, options);
                },

                // Helper to generate a URL-friendly slug from a string
                slugify(text) {
                    if (!text) return '';
                    return text.toString().toLowerCase()
                        .replace(/\s+/g, '-') // Replace spaces with -
                        .replace(/[^\w\-]+/g, '') // Remove all non-word chars
                        .replace(/\-\-+/g, '-') // Replace multiple - with single -
                        .replace(/^-+/, '') // Trim - from start of text
                        .replace(/-+$/, ''); // Trim - from end of text
                },

                // Finds the first image in the content blocks to use as a banner
                getBannerImage() {
                    if (this.article.content && this.article.content.blocks) {
                        const imageBlock = this.article.content.blocks.find(block => block.type === 'image');
                        console.log(imageBlock);
                        if (imageBlock && imageBlock.data && imageBlock.data.file && imageBlock.data.file.url) {
                            return Alpine.store('storage').getPhoto(imageBlock.data.file.url);
                        }
                    }
                    // Fallback image if no image is found in the article content
                    return '/assets/images/banner/banner.svg'; // Update this path to your default banner
                },

                // Creates a "time ago" string like "5 minutes ago"
                timeAgo(dateString) {
                    if (!dateString) return '';
                    const date = new Date(dateString);
                    const seconds = Math.floor((new Date() - date) / 1000);
                    let interval = seconds / 31536000;
                    if (interval > 1) return Math.floor(interval) + " years ago";
                    interval = seconds / 2592000;
                    if (interval > 1) return Math.floor(interval) + " months ago";
                    interval = seconds / 86400;
                    if (interval > 1) return Math.floor(interval) + " days ago";
                    interval = seconds / 3600;
                    if (interval > 1) return Math.floor(interval) + " hours ago";
                    interval = seconds / 60;
                    if (interval > 1) return Math.floor(interval) + " minutes ago";
                    return Math.floor(seconds) + " seconds ago";
                }
            }
        }
    </script>
@endsection
