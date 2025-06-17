@extends('layouts.adminFullPage')

@section('content')
    <div class="relative overflow-x-auto px-5 pt-2">
        <table x-data="cancelHandler()" x-init="fetchCancel()" class="min-w-full leading-normal">
            <thead>
                <tr class="shadow-lg rounded-xl ring-1 ring-gray-200">
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-s-xl">
                        Pesanan
                    </th>
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nama Pemesan
                    </th>
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Tanggal Permintaan
                    </th>
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Alasan
                    </th>
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-e-xl">
                        Persetujuan
                    </th>
                </tr>
            </thead>
            <tbody>
                <template x-if="cancels.length > 0">
                    <template x-for="cancel in cancels" :key="cancel.id">
                        <tr class="rounded-xl hover:bg-gray-50 divide-y divide-gray-200">
                            <td x-text="cancel.booking.session" class="py-4 px-5 text-left text-sm align-middle"></td>
                            <td x-text="cancel.user.name" class="py-4 px-5 text-left text-sm align-middle"></td>
                            <td x-text="cancel.created_at" class="py-4 px-5 text-left text-sm align-middle"></td>
                            <td class="py-4 px-5 text-left text-sm border-b border-gray-200 align-middle"> iyaa
                                {{-- <button
                                class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2 dark:focus:ring-yellow-900"
                                data-modal-target="payment-modal-{{ $listBooking->id }}"
                                data-modal-toggle="payment-modal-{{ $listBooking->id }}" type="button">
                                Lihat Bukti
                            </button> --}}
                                {{-- modal proof of payment --}}
                                {{-- <div id="payment-modal-{{ $listBooking->id }}" tabindex="-1"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="payment-modal-{{ $listBooking->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <img src="{{ route('booking.paymentImage', basename($listBooking->booking->uploud_payment)) }}"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            </td>
                            <td class="py-4 px-5 text-left text-sm align-middle"> iyaa
                                {{-- <div class="inline-flex rounded-md shadow-sm" role="group">
                                <button data-modal-target="approve-modal-{{ $listBooking->id }}"
                                    data-modal-toggle="approve-modal-{{ $listBooking->id }}" type="button"
                                    class="w-20 py-2 text-sm font-medium text-white bg-blue-500 rounded-s-lg hover:bg-blue-600 focus:text-white dark:bg-blue-700 dark:text-white dark:hover:bg-blue-800 dark:focus:text-white">
                                    Terima
                                </button> --}}
                                {{-- modal approve --}}
                                {{-- <div id="approve-modal-{{ $listBooking->id }}" tabindex="-1"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button"
                                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="approve-modal-{{ $listBooking->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah
                                                    anda yakin akan menerima pembatalan booking ini?</h3>
                                                <form action="{{ route('admin.acceptCancelBooking', $listBooking->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                        Terima
                                                    </button>
                                                </form>
                                                <button data-modal-hide="approve-modal-{{ $listBooking->id }}" type="button"
                                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batalkan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button data-modal-target="decline-modal-{{ $listBooking->id }}"
                                    data-modal-toggle="decline-modal-{{ $listBooking->id }}" type="button"
                                    class="w-20 py-2 text-sm font-medium text-white bg-red-500 rounded-e-lg hover:bg-red-600 focus:text-white dark:bg-red-700 dark:text-white dark:hover:bg-red-800 dark:focus:text-white">
                                    Tolak
                                </button> --}}
                                {{-- modal decline --}}
                                {{-- <div id="decline-modal-{{ $listBooking->id }}" tabindex="-1"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button"
                                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="decline-modal-{{ $listBooking->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah
                                                    anda yakin akan menolak pembatalan booking ini?</h3>
                                                <form action="{{ route('admin.rejectCancelBooking', $listBooking->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                        Tolak
                                                    </button>
                                                </form>
                                                <button data-modal-hide="decline-modal-{{ $listBooking->id }}" type="button"
                                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batalkan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            </td>
                        </tr>
                    </template>
                </template>
                <template x-if="cancels.length === 0 && !isLoading">
                    <tr>
                        <td colspan="5" class="py-7 text-center text-sm text-gray-500">No cancels found</td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <script>
        function cancelHandler() {
            return {
                cancels: [],
                selectedVoucher: {},
                voucherModal: false,
                showEditModal: false,
                showDeleteModal: false,
                isLoading: false,
                async fetchCancel() {
                    this.isLoading = true;
                    try {
                        const response = await axios.get('/booking/request-reschedule');
                        this.cancels = response.object.data || [];
                    } catch (error) {
                        console.error('Error fetching cancels:', error);
                        this.cancels = [];
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
                    this.selectedVoucher = {
                        ...voucher
                    }; // salin data
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
    </script>
@endsection
