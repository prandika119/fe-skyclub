@extends('layouts.adminFullPage')

@section('content')
    <div class="relative overflow-x-auto px-5 pt-2">
        <table x-data="bookingHandler()" x-init="fetchBookings()" class="min-w-full leading-normal">
            <thead>
                <tr class="shadow-lg rounded-xl ring-1 ring-gray-200">
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-s-xl">
                        Daftar Pesanan
                    </th>
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nama Pemesan
                    </th>
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Tanggal Pesanan
                    </th>
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Harga
                    </th>
                    {{-- <th scope="col" class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-e-xl">
                    Bukti Pembayaran
                </th> --}}
                </tr>
            </thead>
            <tbody>
                <template x-if="bookings.length > 0">
                    <template x-for="booking in bookings" :key="booking.id">
                        <tr class="rounded-xl hover:bg-gray-50 divide-y divide-gray-200">
                            <td x-text="booking.session" class="py-4 px-5 text-left text-sm align-middle"></td>
                            <td x-text="booking.user.name" class="py-4 px-5 text-left text-sm align-middle"></td>
                            <td x-text="booking.date" class="py-4 px-5 text-left text-sm align-middle"></td>
                            <td x-text="booking.price" class="py-4 px-5 text-left text-sm align-middle"></td>
                            <td class="py-4 px-5 text-left text-sm border-b border-gray-200 align-middle"> iyaa
                                {{-- <button class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2 dark:focus:ring-yellow-900" data-modal-target="payment-modal-{{ $listBooking->id }}" data-modal-toggle="payment-modal-{{ $listBooking->id }}" type="button">
                                Lihat Bukti
                            </button> --}}
                                {{-- modal proof of payment --}}
                                {{-- <div id="payment-modal-{{ $listBooking->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="payment-modal-{{ $listBooking->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                        </tr>
                    </template>
                </template>
                <template x-if="bookings.length === 0 && !isLoading">
                    <tr>
                        <td colspan="5" class="py-7 text-center text-sm text-gray-500">No bookings found</td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <script>
        function bookingHandler() {
            return {
                bookings: [],
                selectedVoucher: {},
                voucherModal: false,
                showEditModal: false,
                showDeleteModal: false,
                isLoading: false,
                async fetchBookings() {
                    this.isLoading = true;
                    try {
                        const response = await axios.get('/my-booking');
                        this.bookings = response.object.data || [];
                    } catch (error) {
                        console.error('Error fetching bookings:', error);
                        this.bookings = [];
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
