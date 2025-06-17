@extends('layouts.adminFullPage')

@section('content')
    <div x-data="cancelHandler()" x-init="fetchCancel()" class="relative overflow-x-auto px-5 pt-2">
        <table class="min-w-full leading-normal">
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
                            <td x-text="`${$store.format.date(cancel.booking.date)} ${cancel.booking.session}`"
                                class="py-4 px-5 text-left text-sm align-middle"></td>
                            <td x-text="cancel.user.name" class="py-4 px-5 text-left text-sm align-middle"></td>
                            <td x-text="formatTanggal(cancel.created_at)" class="py-4 px-5 text-left text-sm align-middle">
                            </td>
                            <td x-text="cancel.reason"
                                class="py-4 px-5 text-left text-sm border-b border-gray-200 align-middle"> iyaa
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
                            <td class="py-4 px-5 text-left text-sm align-middle border-b border-gray-200">
                                <div class="inline-flex rounded-md" role="group">
                                    <button @click="acceptCancel(cancel.id)"
                                        class="w-20 py-2 text-sm font-medium text-white bg-green-500 rounded-s-lg hover:bg-green-600 focus:text-white cursor-pointer">
                                        <div x-show="isLoading">
                                            <img src="{{ asset('assets/icons/loading.gif') }}" width="20"
                                                alt="">
                                        </div>
                                        <span x-show="!isLoading">Terima</span>
                                    </button>
                                    <button @click="rejectModal = true ;cancelId = cancel.id"
                                        class="w-20 py-2 text-sm font-medium text-white bg-red-500 rounded-e-lg hover:bg-red-600 focus:text-white cursor-pointer">
                                        <span x-show="!isLoading">Tolak</span>
                                    </button>
                                </div>
                            </td>


                            {{-- <div class="inline-flex rounded-md shadow-sm" role="group">
                                <button :data-modal-target="`approve-modal-${cancel.booking.id}`"
                                    :data-modal-toggle="`approve-modal-${cancel.booking.id}`" type="button"
                                    class="w-20 py-2 text-sm font-medium text-white bg-blue-500 rounded-s-lg hover:bg-blue-600 focus:text-white dark:bg-blue-700 dark:text-white dark:hover:bg-blue-800 dark:focus:text-white">
                                    Terima
                                </button> --}}
                            {{-- modal approve --}}
                            {{-- <div :id="`approve-modal-${cancel.booking.id}`" tabindex="-1"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button"
                                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                :data-modal-hide="`approve-modal-${cancel.booking.id}`">
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
                                                <form action="route('admin.acceptCancelBooking', $listBooking->id)"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                        Terima
                                                    </button>
                                                </form>
                                                <button :data-modal-hide="`approve-modal-${cancel.booking.id}`"
                                                    type="button"
                                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batalkan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button :data-modal-target="`decline-modal-${cancel.booking.id}`"
                                    :data-modal-toggle="`decline-modal-${cancel.booking.id}`" type="button"
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

        <!-- Reply Modal -->
        <div x-show="rejectModal" x-cloak class="fixed inset-0 flex items-center justify-center bg-black/50">
            <form action="" method="POST" class="bg-white p-4 rounded-lg w-80"
                @submit.prevent="rejectCancel(cancelId)">
                <h2 class="text-xl text-center font-bold mb-4 font-2xl">Alasan Menolak Pengajuan
                    Pembatalan Jadwal</h2>
                <div class="mb-6">
                    <label for="reply" class="block mb-2 text-sm font-medium text-gray-900">Alasan</label>
                    <input type="text" id="reply" name="reply"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Wajib Memasukan Alasan" x-model="reply" />
                </div>

                <div class="flex justify-end">
                    <button @click="rejectModal = false" type="button"
                        class="px-4 py-2 bg-gray-300 rounded-lg mr-2">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-red-700 text-white rounded-lg">
                        <div x-show="isLoading">
                            <img src="{{ asset('assets/icons/loading.gif') }}" width="20" alt="">
                        </div>Tolak
                    </button>
                </div>
            </form>
        </div>

        {{-- modal --}}
        <x-modal-success message="Berhasil memproses" />
        <x-modal-error />
    </div>

    <script>
        function cancelHandler() {
            return {
                cancels: [],
                cancelId: null,
                reply: '',
                error: null,
                rejectModal: false,
                alertSuccess: false,
                isLoading: false,
                async fetchCancel() {
                    this.isLoading = true;
                    try {
                        const response = await axios.get('/booking/request-cancel');
                        this.cancels = response.data.data || [];
                    } catch (error) {
                        console.error('Error fetching cancels:', error);
                        this.cancels = [];
                    } finally {
                        this.isLoading = false;
                    }
                },
                async acceptCancel(id) {
                    this.isLoading = true;
                    try {
                        const response = await axios.post(`/booking/${id}/accept-cancel`, {
                            reply: 'Terima pembatalan'
                        });
                        this.cancelId = null; // Reset cancelId
                        this.alertSuccess = true;
                        this.fetchCancel();
                    } catch (error) {
                        console.log(error.response.data.errors);
                        this.error = error.response?.data?.errors.reply[0] || 'Failed to accept cancel';
                        console.error('Error accepting cancel:', error);
                    } finally {
                        this.isLoading = false;
                    }
                },
                async rejectCancel(id) {
                    this.isLoading = true;
                    try {
                        const response = await axios.post(`/booking/${id}/reject-cancel`, {
                            reply: this.reply
                        });
                        this.reply = ''; // Clear the reply input
                        this.cancelId = null; // Reset cancelId
                        this.alertSuccess = true;
                        this.fetchCancel();
                    } catch (error) {
                        this.error = error.response?.data?.errors.reply[0];
                        console.error('Error rejecting cancel:', error);
                    } finally {
                        this.isLoading = false;
                        this.rejectModal = false; // Close the modal after processing
                    }
                },
                formatTanggal(isoString) {
                    // 1. Buat objek Date dari string ISO
                    const tanggal = new Date(isoString);

                    // 2. Tentukan opsi format HANYA untuk tanggal
                    const options = {
                        weekday: 'long', // "Jumat"
                        day: 'numeric', // "6"
                        month: 'long', // "Juni"
                        year: 'numeric', // "2025"
                        timeZone: 'Asia/Jakarta' // Penting untuk memastikan tanggal sesuai zona waktu Indonesia
                    };

                    // 3. Gunakan toLocaleString dengan locale 'id-ID' dan opsi baru
                    return tanggal.toLocaleString('id-ID', options);
                }
            }
        }
    </script>
@endsection
