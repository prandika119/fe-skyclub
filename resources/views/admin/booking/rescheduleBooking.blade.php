@extends('layouts.adminFullPage')

@section('content')
    <div x-data="rescheduleHandler()" x-init="fetchReschedule()" class="relative overflow-x-auto px-5 pt-2">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="shadow-lg rounded-xl ring-1 ring-gray-200">
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-s-xl">
                        Jadwal Sebelum
                    </th>
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Jadwal Sesudah
                    </th>
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nama Pemesan
                    </th>
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Tanggal Pengajuan
                    </th>
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-e-xl">
                        Persetujuan
                    </th>
                </tr>
            </thead>
            <tbody>
                <template x-if="reschedules.length > 0">
                    <template x-for="reschedule in reschedules" :key="reschedule.id">
                        <tr class="rounded-xl hover:bg-gray-50 divide-y divide-gray-200">
                            <td x-text="`${$store.format.date(reschedule.old_schedule.date)} | ${reschedule.old_schedule.session}`"
                                class="py-4 px-5 text-left text-sm align-middle">
                            </td>
                            <td x-text="`${$store.format.date(reschedule.new_schedule.date)} | ${reschedule.new_schedule.session}`"
                                class="py-4 px-5 text-left text-sm align-middle">
                            </td>
                            <td x-text="reschedule.user.name" class="py-4 px-5 text-left text-sm align-middle"></td>
                            <td x-text="formatTanggal(reschedule.created_at)"
                                class="py-4 px-5 text-left text-sm align-middle"></td>
                            <td class="py-4 px-5 text-left text-sm align-middle border-b border-gray-200">
                                <div class="inline-flex rounded-md" role="group">
                                    <button @click="acceptReschedule(reschedule.id)"
                                        class="w-20 py-2 text-sm font-medium text-white bg-green-500 rounded-s-lg hover:bg-green-600 focus:text-white cursor-pointer">
                                        <div x-show="isLoading">
                                            <img src="{{ asset('assets/icons/loading.gif') }}" width="20"
                                                alt="">
                                        </div>
                                        <span x-show="!isLoading">Terima</span>
                                    </button>
                                    <button @click="rejectReschedule(reschedule.id)"
                                        class="w-20 py-2 text-sm font-medium text-white bg-red-500 rounded-e-lg hover:bg-red-600 focus:text-white cursor-pointer">
                                        <div x-show="isLoading">
                                            <img src="{{ asset('assets/icons/loading.gif') }}" width="20"
                                                alt="">
                                        </div>
                                        <span x-show="!isLoading">Tolak</span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- <!-- Cancel Modal -->
                        <div x-show="cancelBookingModal" x-cloak
                            class="fixed inset-0 flex items-center justify-center bg-black/50 z-20">
                            <div class="bg-white p-6 rounded-lg justify-center flex flex-col text-center">
                                <h2 class="text-xl font-bold mb-4 font-2xl">Yakin ingin batalkan pesanan?</h2>
                                <div class="mt-4 w-full">
                                    <input type="text" name="reason" id="reason"
                                        class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-4"
                                        placeholder="Masukan alasan pembatalan" x-model="cancelReason" required />
                                    <button @click="cancelBookingModal = false"
                                        class="px-4 py-2 w-1/2 bg-gray-300 rounded-lg mr-2">Kembali</button>
                                    <button @click="cancelBooking(schedule.id ); cancelBookingModal = false"
                                        class="px-4 py-2 bg-red-700 text-white rounded-lg">Ya,
                                        Batalkan</button>
                                </div>
                            </div>
                        </div> --}}

                    </template>
                </template>
                <template x-if="reschedules.length === 0 && !isLoading">
                    <tr>
                        <td colspan="5" class="py-7 text-center text-sm text-gray-500">No reschedules found</td>
                    </tr>
                </template>
            </tbody>
        </table>
        {{-- modal --}}
        <x-modal-success message="Berhasil memproses" />
        <x-modal-error />
    </div>

    <script>
        function rescheduleHandler() {
            return {
                reschedules: [],
                error: null,
                alertSuccess: false,
                isLoading: false,
                async fetchReschedule() {
                    this.isLoading = true;
                    console.log('Fetching reschedules...');
                    try {
                        const response = await axios.get('/booking/request-reschedule');
                        this.reschedules = response.data.data || [];
                        console.log(this.reschedules);
                    } catch (error) {
                        console.error('Error fetching reschedules:', error);
                        this.reschedules = [];
                    } finally {
                        this.isLoading = false;
                    }
                },
                async acceptReschedule(requestId) {
                    try {
                        this.isLoading = true;
                        const response = await axios.post(`/booking/${requestId}/accept-reschedule`);
                        await this.fetchReschedule(); // Refresh the list after accepting
                        this.alertSuccess = true; // Show success alert
                    } catch (error) {
                        this.error = error.response?.data?.errors || 'Failed to accept reschedule';
                        console.error('Error accepting reschedule:', error);
                        alert('An error occurred while accepting the reschedule.');
                    } finally {
                        this.isLoading = false;
                    }
                },
                async rejectReschedule(requestId) {
                    try {
                        this.isLoading = true;
                        const response = await axios.post(`/booking/${requestId}/reject-reschedule`);
                        await this.fetchReschedule(); // Refresh the list after rejecting
                        this.alertSuccess = true; // Show success alert
                    } catch (error) {
                        this.error = error.response?.data?.errors || 'Failed to reject reschedule';
                        console.error('Error rejecting reschedule:', error);
                        alert('An error occurred while rejecting the reschedule.');
                    } finally {
                        this.isLoading = false;
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
