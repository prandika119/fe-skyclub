@extends('layouts.adminFullPage')

@section('alert')
@if(session('success'))
<div id="toast-success" class="fixed top-10 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 z-100" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
        </svg>
        <span class="sr-only">Check icon</span>
    </div>
    <div class="ms-3 text-sm font-normal"> {{ session('success') }}</div>
    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>
@endif

@if($errors->any())
<div id="toast-danger" class="fixed top-10 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 z-100" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
        </svg>
        <span class="sr-only">Error icon</span>
    </div>
    <div class="ms-3 text-sm font-normal">
        @foreach($errors->all() as $error)
            <span>{{ $error }}</span>
        @endforeach
    </div>
    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>
@endif
@endsection

@section('content')
<div class="px-5 mb-4 flex items-center justify-between">
    <div class="relative w-full">
        <label for="table-search" class="sr-only">Search</label>
        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input type="text" id="searchInput" onkeyup="searchTable()" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:outline-none focus:ring focus:ring-red-600 focus:border-red-600" placeholder="Search...">
    </div>
    <div class='w-full grid grid-cols-2 lg:flex lg:justify-end gap-x-4 md:gap-x-2'>
        <button data-modal-target="createVoucherModal" data-modal-toggle="createVoucherModal" class="flex items-center justify-center px-6 py-2 bg-red-600 text-white font-medium text-md  rounded-lg hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 ">
            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
            </svg>
            Tambah Article
        </button>
        {{-- <label>
            <select class='${options.classes.selector} w-full focus:ring-red-600 focus:border-red-600'></select>
        </label> --}} 
    </div>
</div>

<div class="relative overflow-x-auto px-5 pt-2">
    <table x-data="articleHandler()" x-init="fetchArticles()" class="min-w-full leading-normal">
        <thead>
            <tr class="shadow-lg rounded-xl ring-1 ring-gray-200">
                <th scope="col" class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-s-xl">
                    Title
                </th>
                <th scope="col" class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Author
                </th>
                <th scope="col" class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Created At
                </th>
                <th scope="col" class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-e-xl">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <template x-if="articles.length > 0">
                <template x-for="article in articles" :key="article.id">
                    <tr class="rounded-xl hover:bg-gray-50 divide-y divide-gray-200">
                        <td x-text="article.title" class="py-4 px-5 text-left text-sm align-middle"></td>
                        <td x-text="article.author.name" class="py-4 px-5 text-left text-sm align-middle"></td>
                        <td x-text="article.created_at" class="py-4 px-5 text-left text-sm align-middle"></td>
                        <td class="py-4 px-5 text-left text-sm border-b border-gray-200 align-middle">
                            <div class="inline-flex rounded-md shadow-sm" role="group">
                                <button @click="openEditModal(voucher)" class="w-20 py-2 text-sm font-medium text-white bg-blue-500 rounded-s-lg hover:bg-blue-600 focus:text-white">
                                Show
                                </button>
                                <button @click="openEditModal(voucher)" class="w-20 py-2 text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:text-white">
                                Edit
                                </button>
                                <button @click="openDeleteModal(voucher)" class="w-20 py-2 text-sm font-medium text-white bg-red-500 rounded-e-lg hover:bg-red-600 focus:text-white">
                                Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
            </template>
            <template x-if="articles.length === 0 && !isLoading">
                <tr>
                    <td colspan="8" class="py-4 text-center text-sm text-gray-500">No articles found</td>
                </tr>
            </template>
        </tbody>
    </table>
</div>

<script>
function articleHandler() {
    return {
        articles: [],
        selectedVoucher: {},
        voucherModal: false,
        showEditModal: false,
        showDeleteModal: false,
        isLoading: false,
        async fetchArticles() {
            this.isLoading = true;
            try {
                const response = await axios.get('/articles');
                this.articles = response.data.data || [];
            } catch (error) {
                console.error('Error fetching articles:', error);
                this.articles = [];
            } finally {
                this.isLoading = false;
            }
        },

        async openEditModal(voucher) {
            this.isLoading = true;
            try {
                const res = await axios.get('/vouchers/${voucher}');
                this.selectedVoucher = res.data.data;
                console.log(selectedVoucher);
                this.showEditModal = true;
            } catch (error) {
                console.error('Error fetching voucher by id:', error);
            } finally {
                this.isLoading = false;
            }
        },

        openDeleteModal(voucher) {
            this.selectedVoucher = { ...voucher }; // salin data
            this.showDeleteModal = true;
        },

        async submitEdit() {
            await axios.put(`/api/vouchers/${this.selectedVoucher.id}`, this.selectedVoucher);
            this.showEditModal = false;
            this.fetchVouchers(); // refresh data
        },

        async submitDelete() {
            await axios.delete(`/api/vouchers/${this.selectedVoucher.id}`);
            this.showDeleteModal = false;
            this.fetchVouchers(); // refresh data
        },
    }
}
function searchTable() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const table = document.getElementById("dataTable");
    const tr = table.getElementsByTagName("tr");

    for (let i = 1; i < tr.length; i++) {
        const tdArray = tr[i].getElementsByTagName("td");
        let found = false;

        for (let j = 0; j < tdArray.length; j++) {
            if (tdArray[j] && tdArray[j].textContent.toLowerCase().includes(input)) {
                found = true;
                break;
            }
        }
        tr[i].style.display = found ? "" : "none";
    }
}
</script>
@endsection
