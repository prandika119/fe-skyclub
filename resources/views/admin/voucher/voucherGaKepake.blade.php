@extends('layouts.adminFullPage')

@push('header')
    @vite(['resources/js/tableVoucher.js'])
@endpush

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
<table id="search-table">
    <thead>
        <tr class="">
            <th class="flex items-center">
                <span class="flex items-center">
                    Code
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Expire Date
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Quota
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Discount Price
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Discount Percentage
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Maximal Discount
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Minimal Price
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                    </svg>
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Action
                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                    </svg>
                </span>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vouchers as $voucher)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $voucher->code }}</td>
            <td>{{ \Carbon\Carbon::parse($voucher->expire_date)->format('d-m-Y') }}</td>
            <td>{{ $voucher->quota }}</td>
            <td>
                {{ $voucher->discount_price !== null ? 'Rp ' . number_format($voucher->discount_price, 0, ',', '.') : '' }}
            </td>
            <td>
                {{ $voucher->discount_percentage !== null ? $voucher->discount_percentage . ' %' : '' }}
            </td>
            <td>
                {{ $voucher->max_discount !== null ? 'Rp ' . number_format($voucher->max_discount, 0, ',', '.') : '' }}
            </td>
            <td>
                {{ $voucher->min_price !== null ? 'Rp ' . number_format($voucher->min_price, 0, ',', '.') : '' }}
            </td>
            <td>
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <button data-modal-target="editVoucherModal-{{ $voucher->id }}" data-modal-toggle="editVoucherModal-{{ $voucher->id }}" type="button" class="w-20 py-2 text-sm font-medium text-white bg-green-500 rounded-s-lg hover:bg-green-600 focus:text-white dark:bg-green-700 dark:text-white dark:hover:bg-green-800 dark:focus:text-white">
                      Edit
                    </button>
                    <!-- Edit Voucher Modal -->
                    <div id="editVoucherModal-{{ $voucher->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                        <div class="relative w-full h-full max-w-2xl md:h-auto">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Edit Voucher
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editVoucherModal-{{ $voucher->id }}">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                    </svg>
                                            </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-6 space-y-6">
                                            <form id="editVoucherForm-{{ $voucher->id }}" action="{{ route('admin.voucher.update', $voucher->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="grid grid-cols-2 gap-4">
                                                            <div class="mb-4 col-span-2">
                                                                    <label for="code-{{ $voucher->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Code</label>
                                                                    <input type="text" name="code" id="code-{{ $voucher->id }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" maxlength="6" value="{{ $voucher->code }}" required>
                                                            </div>
                                                            <div class="mb-4">
                                                                    <label for="expire_date-{{ $voucher->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Expire Date</label>
                                                                    <input type="date" name="expire_date" id="expire_date-{{ $voucher->id }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $voucher->expire_date }}" required>
                                                            </div>
                                                            <div class="mb-4">
                                                                    <label for="quota-{{ $voucher->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quota</label>
                                                                    <input type="number" name="quota" id="quota-{{ $voucher->id }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $voucher->quota }}" required>
                                                            </div>
                                                            <div class="mb-4">
                                                                    <label for="discount_price-{{ $voucher->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Discount Price</label>
                                                                    <input type="text" name="discount_price" id="discount_price-{{ $voucher->id }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $voucher->discount_price }}" oninput="formatRupiah(this)">
                                                                    <input type="hidden" name="discount_price_hidden" id="discount_price_hidden-{{ $voucher->id }}" value="{{ $voucher->discount_price }}">
                                                            </div>
                                                            <div class="mb-4">
                                                                    <label for="discount_percentage-{{ $voucher->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Discount Percentage</label>
                                                                    <input type="text" name="discount_percentage" id="discount_percentage-{{ $voucher->id }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $voucher->discount_percentage }}" oninput="formatPercentage(this)">
                                                                    <input type="hidden" name="discount_percentage_hidden" id="discount_percentage_hidden-{{ $voucher->id }}" value="{{ $voucher->discount_percentage }}">
                                                            </div>
                                                            <div class="mb-4">
                                                                    <label for="max_discount-{{ $voucher->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Maximal Discount</label>
                                                                    <input type="text" name="max_discount" id="max_discount-{{ $voucher->id }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $voucher->max_discount }}" oninput="formatRupiah(this)">
                                                                    <input type="hidden" name="max_discount_hidden" id="max_discount_hidden-{{ $voucher->id }}" value="{{ $voucher->max_discount }}">
                                                            </div>
                                                            <div class="mb-4">
                                                                    <label for="min_price-{{ $voucher->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Minimal Price</label>
                                                                    <input type="text" name="min_price" id="min_price-{{ $voucher->id }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $voucher->min_price }}" oninput="formatRupiah(this)">
                                                                    <input type="hidden" name="min_price_hidden" id="min_price_hidden-{{ $voucher->id }}" value="{{ $voucher->min_price }}">
                                                            </div>
                                                    </div>
                                            </form>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            <button type="submit" form="editVoucherForm-{{ $voucher->id }}" class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                                    Update Voucher
                                            </button>
                                            <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600" data-modal-hide="editVoucherModal-{{ $voucher->id }}">Cancel</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <button data-modal-target="delete-modal-{{ $voucher->id }}" data-modal-toggle="delete-modal-{{ $voucher->id }}" type="button" class="w-20 py-2 text-sm font-medium text-white bg-red-500 rounded-e-lg hover:bg-red-600 focus:text-white dark:bg-red-700 dark:text-white dark:hover:bg-red-800 dark:focus:text-white">
                      Delete
                    </button>
                    <div id="delete-modal-{{ $voucher->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal-{{ $voucher->id }}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin akan menghapus voucher ini?</h3>
                                    <form action="{{ route('admin.voucher.destroy', $voucher->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                          Delete
                                        </button>
                                    </form>
                                    <button data-modal-hide="delete-modal-{{ $voucher->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- Main modal -->
<div id="createVoucherModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Tambah Voucher
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="createVoucherModal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form id="createVoucherForm" action="/admin/voucher/store" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4 col-span-2">
                            <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Code</label>
                            <input type="text" name="code" id="code" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" maxlength="6" required>
                        </div>
                        <div class="mb-4">
                            <label for="expire_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Expire Date</label>
                            <input type="date" name="expire_date" id="expire_date" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div class="mb-4">
                            <label for="quota" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quota</label>
                            <input type="number" name="quota" id="quota" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div class="mb-4">
                            <label for="discount_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Discount Price</label>
                            <input type="text" name="discount_price" id="discount_price" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" oninput="formatRupiah(this)">
                            <input type="hidden" name="discount_price_hidden" id="discount_price_hidden">
                        </div>
                        <div class="mb-4">
                            <label for="discount_percentage" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Discount Percentage</label>
                            <input type="text" name="discount_percentage" id="discount_percentage" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" oninput="formatPercentage(this)">
                            <input type="hidden" name="discount_percentage_hidden" id="discount_percentage_hidden">
                        </div>
                        <div class="mb-4">
                            <label for="max_discount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Maximal Discount</label>
                            <input type="text" name="max_discount" id="max_discount" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" oninput="formatRupiah(this)">
                            <input type="hidden" name="max_discount_hidden" id="max_discount_hidden">
                        </div>
                        <div class="mb-4">
                            <label for="min_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Minimal Price</label>
                            <input type="text" name="min_price" id="min_price" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" oninput="formatRupiah(this)">
                            <input type="hidden" name="min_price_hidden" id="min_price_hidden">
                        </div>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit" form="createVoucherForm" class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Tambah Voucher
                </button>
                <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600" data-modal-hide="createVoucherModal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    function hideToast(id) {
        setTimeout(function() {
            document.getElementById(id).style.display = 'none';
        }, 8000);
    }
    function formatRupiah(element) {
        let value = element.value.replace(/[^,\d]/g, '').toString();
        let split = value.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        element.value = 'Rp ' + rupiah;

        let hiddenInput = document.getElementById(element.id + '_hidden');
        hiddenInput.value = value.replace(/\./g, '');
    }

    function formatPercentage(element) {
        let value = element.value.replace(/[^,\d]/g, '').toString();
        if (value) {
            let percentage = parseFloat(value);
            if (percentage > 100) {
                percentage = 100;
            }
            element.value = percentage + ' %';
        } else {
            element.value = '';
        }

        let hiddenInput = document.getElementById(element.id + '_hidden');
        hiddenInput.value = value.replace(/[^0-9]/g, '');
        if (hiddenInput.value > 100) {
            hiddenInput.value = 100;
        }
    }
    hideToast('toast-success');
    hideToast('toast-danger');
</script>
@endpush
