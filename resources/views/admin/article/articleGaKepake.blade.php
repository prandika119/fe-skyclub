
@extends('layouts.adminFullPage')

@push('header')
    @vite(['resources/js/tableArticle.js'])
@endpush

@section('content')
<div x-data="articleTable()" x-init="fetchArticles()">
    <!-- Search and Create Button -->
    <div class="flex justify-between mb-4">
        <div class="relative w-64">
            <input 
                type="text" 
                x-model="searchQuery" 
                @input.debounce.500ms="searchArticles"
                placeholder="Search articles..."
                class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>
        <a 
            href="{{ route('admin.article.create') }}" 
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Create Article
        </a>
    </div>

    <!-- Loading State -->
    <div x-show="loading" class="text-center py-8">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500"></div>
        <p class="mt-2">Loading articles...</p>
    </div>

    <!-- Error State -->
    <div x-show="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert" x-text="error"></div>

    <!-- Articles Table -->
    <div x-show="!loading && !error" class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left">
                        <button @click="sortBy('title')" class="flex items-center font-medium text-gray-700 uppercase tracking-wider">
                            Title
                            <svg class="w-4 h-4 ml-1" :class="{ 'transform rotate-180': sortField === 'title' && sortDirection === 'desc' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </th>
                    <th class="px-6 py-3 text-left">
                        <button @click="sortBy('author')" class="flex items-center font-medium text-gray-700 uppercase tracking-wider">
                            Author
                            <svg class="w-4 h-4 ml-1" :class="{ 'transform rotate-180': sortField === 'author' && sortDirection === 'desc' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </th>
                    <th class="px-6 py-3 text-left">
                        <button @click="sortBy('created_at')" class="flex items-center font-medium text-gray-700 uppercase tracking-wider">
                            Created At
                            <svg class="w-4 h-4 ml-1" :class="{ 'transform rotate-180': sortField === 'created_at' && sortDirection === 'desc' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <template x-for="article in articles" :key="article.id">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900" x-text="article.title"></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900" x-text="article.author.name"></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900" x-text="formatDate(article.created_at)"></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="inline-flex rounded-md shadow-sm" role="group">
                                <a :href="`/admin/articles/${article.id}`" class="px-3 py-1 text-sm font-medium text-white bg-blue-500 rounded-l-lg hover:bg-blue-600">
                                    Show
                                </a>
                                <a :href="`/admin/articles/${article.id}/edit`" class="px-3 py-1 text-sm font-medium text-white bg-green-500 hover:bg-green-600">
                                    Edit
                                </a>
                                <button @click="confirmDelete(article.id)" class="px-3 py-1 text-sm font-medium text-white bg-red-500 rounded-r-lg hover:bg-red-600">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
                <tr x-show="articles.length === 0">
                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                        No articles found
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div x-show="!loading && articles.length > 0" class="mt-4 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Showing <span x-text="meta.from"></span> to <span x-text="meta.to"></span> of <span x-text="meta.total"></span> articles
        </div>
        <div class="flex space-x-2">
            <button 
                @click="prevPage" 
                :disabled="meta.current_page === 1"
                class="px-3 py-1 border rounded"
                :class="{ 'opacity-50 cursor-not-allowed': meta.current_page === 1 }"
            >
                Previous
            </button>
            <button 
                @click="nextPage"
                :disabled="meta.current_page >= meta.last_page"
                class="px-3 py-1 border rounded"
                :class="{ 'opacity-50 cursor-not-allowed': meta.current_page >= meta.last_page }"
            >
                Next
            </button>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6 text-center">
                <svg class="mx-auto mb-4 w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this article?</h3>
                <div class="flex justify-center space-x-4">
                    <button 
                        @click="deleteArticle" 
                        class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5"
                    >
                        Delete
                    </button>
                    <button 
                        @click="showDeleteModal = false" 
                        class="text-gray-500 bg-white hover:bg-gray-100 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('articleTable', () => ({
        articles: [],
        meta: {},
        loading: false,
        error: null,
        searchQuery: '',
        sortField: 'created_at',
        sortDirection: 'desc',
        showDeleteModal: false,
        articleToDelete: null,

        async fetchArticles() {
            this.loading = true;
            this.error = null;
            
            try {
                const params = new URLSearchParams({
                    page: this.meta.current_page || 1,
                    search: this.searchQuery,
                    sort_by: this.sortField,
                    sort_dir: this.sortDirection
                });
                
                const response = await axios.get(`/articles?${params}`);
                
                if (response.data.status === 'success') {
                    this.articles = response.data.data;
                    this.meta = response.data.meta || {};
                } else {
                    this.error = 'Failed to load articles';
                }
            } catch (err) {
                console.error('Error fetching articles:', err);
                this.error = err.response?.data?.message || 'Error loading articles';
            } finally {
                this.loading = false;
            }
        },

        searchArticles() {
            this.meta.current_page = 1;
            this.fetchArticles();
        },

        sortBy(field) {
            if (this.sortField === field) {
                this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortField = field;
                this.sortDirection = 'asc';
            }
            this.fetchArticles();
        },

        prevPage() {
            if (this.meta.current_page > 1) {
                this.meta.current_page--;
                this.fetchArticles();
            }
        },

        nextPage() {
            if (this.meta.current_page < this.meta.last_page) {
                this.meta.current_page++;
                this.fetchArticles();
            }
        },

        confirmDelete(id) {
            this.articleToDelete = id;
            this.showDeleteModal = true;
        },

        async deleteArticle() {
            try {
                await axios.delete(`/articles/${this.articleToDelete}`);
                this.showDeleteModal = false;
                this.fetchArticles();
            } catch (err) {
                console.error('Error deleting article:', err);
                this.error = err.response?.data?.message || 'Error deleting article';
            }
        },

        formatDate(dateString) {
            if (!dateString) return '';
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('en-US', options);
        }
    }));
});
</script>
@endsection

