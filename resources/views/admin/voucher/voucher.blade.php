@extends('layouts.adminFullPage')

@section('alert')
    @if (session('success'))
        <div id="toast-success"
            class="fixed top-10 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 z-100"
            role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal"> {{ session('success') }}</div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div id="toast-danger"
            class="fixed top-10 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 z-100"
            role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                </svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span>
                @endforeach
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-danger" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
@endsection

@section('content')
    <div x-data="voucherHandler()" x-init="fetchVouchers()">
        <div class="px-5 mb-4 flex items-center justify-between">
            <div class="relative w-full">
                <label for="table-search" class="sr-only">Search</label>
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="searchInput" onkeyup="searchTable()"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:outline-none focus:ring focus:ring-red-600 focus:border-red-600"
                    placeholder="Search...">
            </div>
            <div class='w-full grid grid-cols-2 lg:flex lg:justify-end gap-x-4 md:gap-x-2'>
                <button @click="createVoucherModal = true"
                    class="flex items-center justify-center px-6 py-2 bg-red-600 text-white font-medium text-md  rounded-lg hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-0 active:bg-red-800 ">
                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg>
                    Tambah Voucher
                </button>
                {{-- <label>
                <select class='${options.classes.selector} w-full focus:ring-red-600 focus:border-red-600'></select>
            </label> --}}
            </div>
        </div>

        <div class="relative overflow-x-auto px-5 pt-2">
            <table id="dataTable" class="w-full leading-normal">
                <thead>
                    <tr class="shadow-lg rounded-xl ring-1 ring-gray-200">
                        <th scope="col"
                            class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-s-xl">
                            Code
                        </th>
                        <th scope="col"
                            class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">
                            Expire Date
                        </th>
                        <th scope="col"
                            class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">
                            Quota
                        </th>
                        <th scope="col"
                            class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">
                            Discount Price
                        </th>
                        <th scope="col"
                            class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">
                            Discount percentage
                        </th>
                        <th scope="col"
                            class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">
                            Maximal Discount
                        </th>
                        <th scope="col"
                            class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">
                            Minimal Price
                        </th>
                        <th scope="col"
                            class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap rounded-e-xl">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <template x-if="vouchers.length > 0">
                        <template x-for="voucher in vouchers" :key="voucher.id">
                            <tr class="rounded-xl hover:bg-gray-50 divide-y divide-gray-200">
                                <td x-text="voucher.code"
                                    class="py-4 px-5 text-left text-sm whitespace-nowrap align-middle"></td>
                                <td x-text="formatDate(voucher.expired_date)"
                                    class="py-4 px-5 text-left text-sm whitespace-nowrap align-middle"></td>
                                <td x-text="voucher.quota"
                                    class="py-4 px-5 text-left text-sm whitespace-nowrap align-middle"></td>
                                <td x-text="voucher.discount_price !== null ? formatRupiah(voucher.discount_price) : '-'"
                                    class="py-4 px-5 text-left text-sm whitespace-nowrap align-middle"></td>
                                <td x-text="voucher.discount_percentage !== null ? voucher.discount_percentage + '%' : '-'"
                                    class="py-4 px-5 text-left text-sm whitespace-nowrap align-middle"></td>
                                <td x-text="voucher.max_discount !== null ? formatRupiah(voucher.max_discount) : '-'"
                                    class="py-4 px-5 text-left text-sm whitespace-nowrap align-middle"></td>
                                <td x-text="voucher.min_price !== null ? formatRupiah(voucher.min_price) : '-'"
                                    class="py-4 px-5 text-left text-sm whitespace-nowrap align-middle"></td>
                                <td class="py-4 px-5 text-left text-sm align-middle border-b border-gray-200">
                                    <div class="inline-flex rounded-md" role="group">
                                        <button @click="openEditModal(voucher)"
                                            class="w-20 py-2 text-sm font-medium text-white bg-green-500 rounded-s-lg hover:bg-green-600 focus:text-white">
                                            Edit
                                        </button>
                                        <button @click="openDeleteModal(voucher)"
                                            class="w-20 py-2 text-sm font-medium text-white bg-red-500 rounded-e-lg hover:bg-red-600 focus:text-white">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </template>
                    <template x-if="vouchers.length === 0 && !isLoading">
                        <tr>
                            <td colspan="8" class="py-4 text-center text-sm text-gray-500">No vouchers found</td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <!-- Edit Voucher Modal -->
        <div x-show="showEditModal"
            class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-2xl md:h-auto mx-auto mt-10 shadow-lg ">
                <div x-cloak @click="showEditModal = false" x-show="showEditModal"
                    class="fixed inset-0 transition-opacity bg-gray-500 opacity-40" aria-hidden="true"></div>
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Edit Voucher
                        </h3>
                        <button @click="closeModal"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <form x-data="{ discountType: 'price' }" id="editForm" method="POST">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4 col-span-2">
                                    <label for="code" class="block text-sm font-medium text-gray-700">Code</label>
                                    <input type="text" name="code" x-model="selectedVoucher.code"
                                        class="block w-full mt-1 py-2 px-3 border-gray-300 rounded-md shadow-sm" required>
                                </div>
                                <div class="mb-4">
                                    <label for="expire_date" class="block text-sm font-medium text-gray-700">Expire
                                        Date</label>
                                    <input type="date" name="expire_date" x-model="selectedVoucher.expired_date"
                                        class="block w-full mt-1 py-2 px-3 border-gray-300 rounded-md shadow-sm" required>
                                </div>
                                <div class="mb-4">
                                    <label for="quota" class="block text-sm font-medium text-gray-700">Quota</label>
                                    <input type="number" name="quota" x-model="selectedVoucher.quota"
                                        class="block w-full mt-1 py-2 px-3 border-gray-300 rounded-md shadow-sm" required>
                                </div>
                                {{-- Dropdown untuk Memilih Tipe Diskon --}}
                                <div class="mb-4 col-span-2">
                                    <label for="discount_type" class="block text-sm font-medium text-gray-700">Tipe Diskon
                                        <span class="text-red-500">*</span></label>
                                    <select
                                        @change="selectedVoucher.discount_percentage = 0; selectedVoucher.discount_price = 0; selectedVoucher.max_discount = 0"
                                        x-model="selectedVoucher.discount_type" name="discount_type"
                                        class="block w-full mt-1 py-2 px-3 border-gray-300 rounded-md shadow-sm">
                                        <option value="price">Discount Price (Rp)</option>
                                        <option value="percentage">Discount percentage (%)</option>

                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="discount_price" class="block text-sm font-medium text-gray-700">Discount
                                        Price</label>
                                    <input type="number" name="discount_price"
                                        :disabled="selectedVoucher.discount_type !== 'price'"
                                        x-model="selectedVoucher.discount_price"
                                        class="block w-full mt-1 py-2 px-3 border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div class="mb-4">
                                    <label for="discount_percentage"
                                        class="block text-sm font-medium text-gray-700">Discount percentage</label>
                                    <input type="number" name="discount_percentage"
                                        x-model="selectedVoucher.discount_percentage"
                                        :disabled="selectedVoucher.discount_type !== 'percentage'"
                                        class="block w-full mt-1 py-2 px-3 border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div class="mb-4">
                                    <label for="max_discount" class="block text-sm font-medium text-gray-700">Maximal
                                        Discount</label>
                                    <input type="number" name="max_discount"
                                        :disabled="selectedVoucher.discount_type == 'price'"
                                        x-model="selectedVoucher.max_discount"
                                        class="block w-full mt-1 py-2 px-3 border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div class="mb-4">
                                    <label for="min_price" class="block text-sm font-medium text-gray-700">Minimal
                                        Price</label>
                                    <input type="text" name="min_price" x-model="selectedVoucher.min_price"
                                        class="block w-full mt-1 py-2 px-3 border-gray-300 rounded-md shadow-sm">
                                </div>
                            </div>


                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" @click="submitEdit"
                            class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Update Voucher
                        </button>
                        <button @click="closeEditModal()"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Voucher Modal -->
        <div x-show="showDeleteModal"
            class=" overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full h-full max-w-md md:h-auto mx-auto mt-10 shadow-lg ">
                <div x-cloak @click="showDeleteModal = false" x-show="showDeleteModal"
                    class="fixed inset-0 transition-opacity bg-gray-500 opacity-40" aria-hidden="true"></div>
                <div class="relative bg-white rounded-lg shadow">
                    <button @click="showDeleteModal = false"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah anda yakin akan menghapus voucher ini?
                        </h3>
                        <button @click="submitDelete" type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Delete
                        </button>
                        <button @click="showDeleteModal = false"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">No,
                            cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div x-show="createVoucherModal" x-transition @keydown.escape.window="createVoucherModal = false"
            class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-2xl md:h-auto mx-auto mt-10 shadow-lg ">
                <div x-cloak @click="createVoucherModal = false" x-show="createVoucherModal"
                    class="fixed inset-0 transition-opacity bg-gray-500 opacity-40" aria-hidden="true"></div>
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Tambah Voucher
                        </h3>
                        <button @click="createVoucherModal = false"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <form x-data="{ discountType: 'price' }" @submit.prevent="tambahVoucher" id="voucherForm" method="POST">
                            @csrf
                            <div class="grid grid-cols-2 gap-4">
                                {{-- Kode dan Kuota --}}
                                <div class="mb-4 col-span-2">
                                    <label for="code" class="block text-sm font-medium text-gray-700">Code <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="code"
                                        class="block w-full mt-1 py-2 px-3 border-gray-300 rounded-md shadow-sm"
                                        maxlength="6" required>
                                </div>
                                <div class="mb-4">
                                    <label for="expire_date" class="block text-sm font-medium text-gray-700">Expire Date
                                        <span class="text-red-500">*</span></label>
                                    <input type="date" name="expire_date"
                                        class="block w-full mt-1 py-2 px-3 border-gray-300 rounded-md shadow-sm" required>
                                </div>
                                <div class="mb-4">
                                    <label for="quota" class="block text-sm font-medium text-gray-700">Quota <span
                                            class="text-red-500">*</span></label>
                                    <input type="number" name="quota"
                                        class="block w-full mt-1 py-2 px-3 border-gray-300 rounded-md shadow-sm" required>
                                </div>

                                {{-- Dropdown untuk Memilih Tipe Diskon --}}
                                <div class="mb-4 col-span-2">
                                    <label for="discount_type" class="block text-sm font-medium text-gray-700">Tipe Diskon
                                        <span class="text-red-500">*</span></label>
                                    <select x-model="discountType" name="discount_type"
                                        class="block w-full mt-1 py-2 px-3 border-gray-300 rounded-md shadow-sm">
                                        <option value="price">Discount Price (Rp)</option>
                                        <option value="percentage">Discount percentage (%)</option>
                                    </select>
                                </div>

                                {{-- Input Diskon --}}
                                <div class="mb-4">
                                    <label for="discount_price" class="block text-sm font-medium text-gray-700">Discount
                                        Price</label>
                                    <input type="number" name="discount_price" :disabled="discountType !== 'price'"
                                        class="block w-full mt-1 py-2 px-3 border-gray-300 rounded-md shadow-sm disabled:bg-gray-200 disabled:cursor-not-allowed">
                                </div>
                                <div class="mb-4">
                                    <label for="discount_percentage"
                                        class="block text-sm font-medium text-gray-700">Discount percentage</label>
                                    <input type="number" name="discount_percentage"
                                        :disabled="discountType !== 'percentage'"
                                        class="block w-full mt-1 py-2 px-3 border-gray-300 rounded-md shadow-sm disabled:bg-gray-200 disabled:cursor-not-allowed">
                                </div>

                                {{-- Input Tambahan --}}
                                <div class="mb-4">
                                    <label for="max_discount" class="block text-sm font-medium text-gray-700">Maximal
                                        Discount</label>
                                    <input type="number" name="max_discount" :disabled="discountType == 'price'"
                                        class="block w-full mt-1 py-2 px-3 border-gray-300 rounded-md shadow-sm disabled:bg-gray-200 disabled:cursor-not-allowed">
                                </div>
                                <div class="mb-4">
                                    <label for="min_price" class="block text-sm font-medium text-gray-700">Minimal Price
                                        <span class="text-red-500">*</span></label>
                                    <input type="number" name="min_price"
                                        class="block w-full mt-1 py-2 px-3 border-gray-300 rounded-md shadow-sm"
                                        value="0" required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit" @click="tambahVoucher"
                            class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Tambah Voucher
                        </button>
                        <button @click="createVoucherModal = false"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-2 focus:outline-none focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function voucherHandler() {
            return {
                vouchers: [],
                selectedVoucher: null,
                createVoucherModal: false,
                showEditModal: false,
                showDeleteModal: false,
                isLoading: false,
                async fetchVouchers() {
                    this.isLoading = true;
                    try {
                        const response = await axios.get('/vouchers');
                        this.vouchers = response.data.data || [];
                        console.log('Vouchers fetched:', this.vouchers);
                    } catch (error) {
                        console.error('Error fetching vouchers:', error);
                        this.vouchers = [];
                    } finally {
                        this.isLoading = false;
                    }
                },

                async tambahVoucher() {
                    const formData = new FormData(document.getElementById('voucherForm'));
                    const data = Object.fromEntries(formData.entries());
                    console.log(data);
                    try {
                        console.log('try');
                        const response = await axios.post('/vouchers', data);
                        await this.fetchVouchers(); // refresh data
                        this.createVoucherModal = false; // tutup modal
                    } catch (error) {
                        console.error('Error adding voucher:', error);
                        alert('Gagal menambahkan voucher: ' + (error.response?.data?.message || error.message));
                    }
                },

                openEditModal(voucher) {
                    console.log(voucher, "haloo");
                    this.selectedVoucher = voucher;
                    if (voucher.discount_price == 0) {
                        this.selectedVoucher.discount_type = 'percentage';
                    } else {
                        this.selectedVoucher.discount_type = 'price';
                    }
                    console.log(this.selectedVoucher);
                    this.showEditModal = true;
                },
                closeEditModal() {
                    this.showEditModal = false;
                    this.selectedVoucher = null;
                },
                openDeleteModal(voucher) {
                    this.selectedVoucher = voucher;
                    this.showDeleteModal = true;
                },
                closeModal() {
                    this.showEditModal = false;
                    this.showDeleteModal = false;
                    this.selectedVoucher = null;
                },

                async submitEdit() {
                    const formData = new FormData(document.getElementById('editForm'));
                    const data = Object.fromEntries(formData.entries());
                    const updateData = {
                        code: this.selectedVoucher.code,
                        expire_date: this.selectedVoucher.expired_date,
                        quota: this.selectedVoucher.quota,
                        discount_price: this.selectedVoucher.discount_price,
                        discount_percentage: this.selectedVoucher.discount_percentage,
                        max_discount: this.selectedVoucher.max_discount,
                        min_price: this.selectedVoucher.min_price
                    };
                    try {
                        const response = await axios.put(`/vouchers/${this.selectedVoucher.id}`, updateData);
                        console.log(response);
                        this.showEditModal = false;
                        this.fetchVouchers(); // refresh data
                    } catch (error) {
                        console.error('Error update voucher:', error);
                        alert('Gagal mengupdate voucher: ' + (error.response?.data?.message || error.message));
                    }
                },

                async submitDelete() {
                    try {
                        const response = await axios.delete(`/vouchers/${this.selectedVoucher.id}`);
                        this.showDeleteModal = false;
                        await this.fetchVouchers();
                        console.log('udah delete nih');
                    } catch (error) {
                        this.showDeleteModal = false;
                        await this.fetchVouchers();
                        console.log('udah delete nih');
                        if (error.status == 200) {}
                        console.error('Error update voucher:', error);
                        // alert('Gagal delete voucher: ' + (error.response?.data?.message || error.message));
                    }
                },

                formatDate(dateString) {
                    if (!dateString) return '-';
                    try {
                        const date = new Date(dateString);
                        // Check if date is valid
                        if (isNaN(date.getTime())) return '-';

                        return date.toLocaleDateString('id-ID', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    } catch (e) {
                        console.error('Error formatting date:', e);
                        return '-';
                    }
                },
                formatRupiah(amount) {
                    if (amount === null || amount === undefined || isNaN(amount)) return '-';
                    try {
                        return new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0
                        }).format(amount).replace(/\s/g, '');
                    } catch (e) {
                        console.error('Error formatting currency:', e);
                        return '-';
                    }
                }
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
