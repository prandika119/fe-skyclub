@extends('layouts.admin')

@push('header')
    @vite(['resources/js/chart.js'])
@endpush

@section('content')
<div class="bg-white shadow rounded-lg border-gray-300 mb-4 p-6">
    <div class="flex justify-between">
        <div>
            <h5 id="total-bookings" class="leading-none text-3xl font-bold text-gray-900 pb-2">32.4k</h5>
            <p class="text-base font-normal text-gray-500">Bookings In
                <span id="total-bookings-label">month</span>
            </p>
        </div>
    </div>
    <div id="area-chart"></div>
    <div class="grid grid-cols-1 items-center border-gray-200 border-t justify-between">
        <div class="flex justify-between items-center pt-5">
            <!-- Button -->
            <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown"
                data-dropdown-placement="bottom"
                class="text-sm font-medium text-gray-500 hover:text-gray-900 text-center inline-flex items-center"
                type="button">
                Last 7 days
                <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="lastDaysdropdown"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a class="block px-4 py-2 hover:bg-gray-100" data-days="2"
                            data-label="Yesterday">Yesterday</a>
                    </li>
                    <li>
                        <a class="block px-4 py-2 hover:bg-gray-10" data-days="1" data-label="Today">Today</a>
                    </li>
                    <li>
                        <a class="block px-4 py-2 hover:bg-gray-100" data-days="7"
                            data-label="Last 7 days">Last 7
                            days</a>
                    </li>
                    <li>
                        <a class="block px-4 py-2 hover:bg-gray-100" data-days="30"
                            data-label="Last 30 days">Last 30
                            days</a>
                    </li>
                    <li>
                        <a class="block px-4 py-2 hover:bg-gray-100" data-days="90"
                            data-label="Last 90 days">Last 90
                            days</a>
                    </li>
                </ul>
            </div>
            <a href="{{ route('admin.booking.allBooking') }}"
                class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 hover:bg-gray-100">
                Lihat semua
                <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
    <div x-data="bookingHandler()" x-init="fetchBookings()"
        class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8">
        <div class="flex items-center justify-between mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900">Booking Terbaru</h5>
            <a href="{{ route('admin.booking.allBooking') }}"
                class="text-sm font-medium text-blue-600 hover:underline">
                Lihat semua
            </a>
        </div>
        <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200">
                <template x-if="isLoading">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center justify-center">
                            <p class="text-sm font-medium text-gray-900">
                                Memuat data booking...
                            </p>
                        </div>
                    </li>
                </template>
                <template x-if="bookings.length === 0 && !isLoading">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center justify-center">
                            <p class="text-sm font-medium text-gray-900">
                                No bookings available
                            </p>
                        </div>
                    </li>
                </template>
                <template x-if="bookings.length > 0">
                    <template x-for="booking in bookings" :key="booking.id">
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full"
                                        :src="booking.user.profile_photo" :alt="booking.user.name">
                                </div>
                                <div class="flex-1 min-w-0 ms-4">
                                    <p x-text="booking.user.name" class="text-sm font-medium text-gray-900 truncate"></p>
                                    <p x-text="booking.session" class="text-xs text-gray-500 truncate"></p>
                                </div>
                            </div>
                        </li>
                    </template>
                </template>
            </ul>
        </div>
    </div>
    <div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8" 
        x-data="rescheduleHandler()"
        x-init="fetchReschedule()">
        <div class="flex items-center justify-between mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900">Ubah Booking</h5>
            <a href="{{ route('admin.booking.reschedule') }}" class="text-sm font-medium text-blue-600 hover:underline">
                Lihat semua
            </a>
        </div>
        <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200">
                <!-- Loading State -->
                <template x-if="isLoading">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center justify-center">
                            <p class="text-sm font-medium text-gray-900">
                                Memuat data reschedule...
                            </p>
                        </div>
                    </li>
                </template>

                <!-- Error State -->
                <template x-if="error">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center justify-center">
                            <p class="text-sm font-medium text-red-600" x-text="error"></p>
                        </div>
                    </li>
                </template>

                <!-- Reschedule Items -->
                <template x-for="reschedule in reschedules.slice(0, 5)" :key="reschedule.id">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <img class="w-8 h-8 rounded-full"
                                    :src="reschedule.user.profile_photo || 'https://via.placeholder.com/32'"
                                    :alt="reschedule.user.name">
                            </div>
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate"
                                    x-text="reschedule.user.name">
                                </p>
                                <div class="text-xs text-gray-500">
                                    <p class="font-semibold">Jadwal Lama:</p>
                                    <p
                                        x-text="reschedule.old_schedule.date">
                                    </p>
                                    <p class="font-semibold mt-1">Jadwal Baru:</p>
                                    <p
                                    x-text="reschedule.new_schedule.date">
                                </p>
                            </div>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                <button @click="setCurrentReschedule(reschedule.id)"
                                    data-modal-target="confirmModal" data-modal-toggle="confirmModal"
                                    class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                    type="button">
                                    Action
                                </button>
                            </div>
                        </div>
                    </li>
                </template>

                <!-- Empty State -->
                <template x-if="reschedules.length === 0 && !isLoading">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center justify-center">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                Tidak ada permintaan reschedule
                            </p>
                        </div>
                    </li>
                </template>
            </ul>
        </div>

        <!-- Action Modal -->
        <div id="confirmModal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <div class="relative p-4 text-center bg-white rounded-lg shadow sm:p-5">
                    <button type="button"
                        class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                        data-modal-toggle="confirmModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <p class="mb-4 text-gray-500">Apakah anda yakin menerima perubahan jadwal?</p>
                    <div class="flex justify-center items-center space-x-4">
                        <button @click="acceptReschedule()"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Terima
                        </button>
                        <button @click="rejectReschedule()"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Tolak
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8" x-data="cancelHandler()"
        x-init="fetchCancel()">
        <div class="flex items-center justify-between mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900">Pembatalan Booking</h5>
            <a href="{{ route('admin.booking.cancel') }}" class="text-sm font-medium text-blue-600 hover:underline">
                Lihat semua
            </a>
        </div>
        <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200">
                <!-- Loading State -->
                <template x-if="isLoading">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center justify-center">
                            <p class="text-sm font-medium text-gray-900">
                                Memuat data pembatalan...
                            </p>
                        </div>
                    </li>
                </template>

                <!-- Error State -->
                <template x-if="error">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center justify-center">
                            <p class="text-sm font-medium text-red-600 dark:text-red-400" x-text="error"></p>
                        </div>
                    </li>
                </template>

                <!-- Empty State -->
                <template x-if="!loading && !error && cancels.length === 0">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center justify-center">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                Tidak ada permintaan pembatalan
                            </p>
                        </div>
                    </li>
                </template>

                <!-- Cancel Request Items -->
                <template x-for="request in cancels.slice(0, 5)" :key="request.id">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <img class="w-8 h-8 rounded-full"
                                    :src="request.user.profile_photo || 'https://via.placeholder.com/32'"
                                    :alt="request.user.name">
                            </div>
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white"
                                    x-text="request.user.name">
                                </p>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    <p x-text="request.booking.date"></p>
                                    <p class="mt-1" x-text="'Alasan: ' + request.reason"></p>
                                </div>
                            </div>
                            <div
                                class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                <button @click="setCurrentRequest(request.id)"
                                    data-modal-target="confirmModal" data-modal-toggle="confirmModal"
                                    class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                    type="button">
                                    Action
                                </button>
                            </div>
                        </div>
                    </li>
                </template>
            </ul>
        </div>

        <!-- Action Modal -->
        <div id="confirmModal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <button type="button"
                        class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="confirmModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <p class="mb-4 text-gray-500 dark:text-gray-300">Apakah anda yakin memproses pembatalan
                        ini?</p>
                    <div class="flex justify-center items-center space-x-4">
                        <button @click="acceptCancelRequest()"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Terima
                        </button>
                        <button @click="rejectCancelRequest()"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Tolak
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
function bookingHandler() {
    return {
        bookings: [],
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
        }
    }
}
function rescheduleHandler() {
    return {
        reschedules: [],
        selectedReschedule: {},
        voucherModal: false,
        showEditModal: false,
        showDeleteModal: false,
        errors: null,
        isLoading: false,
        async fetchReschedule() {
            this.isLoading = true;
            try {
                const response = await axios.get('/booking/request-reschedule');
                this.reschedules = response.data.data || [];
                console.log = reschedules;
            } catch (error) {
                console.error('Error fetching reschedules:', error);
                this.errors = error.response.data.errors;
                this.reschedules = [];
            } finally {
                this.isLoading = false;
            }
        }
    }
}

function cancelHandler() {
    return {
        cancels: [],
        isLoading: false,
        async fetchCancel() {
            this.isLoading = true;
            try {
                const response = await axios.get('/booking/request-reschedule');
                this.cancels = response.object.data || [];
                console.log('cancels')
            } catch (error) {
                console.error('Error fetching cancels:', error);
                this.cancels = [];
            } finally {
                this.isLoading = false;
            }
        }
    }
}
</script>
@endsection

@push('script')
    <script>
        function bookingComponent() {
            return {
                bookings: [],
                loading: true,
                error: null,
                currentBookingId: null,
                csrfToken: document.querySelector('meta[name="csrf-token"]')?.content || '',

                fetchBookings() {
                    this.loading = true;
                    this.error = null;

                    axios.get('http://127.0.0.1:8000/api/my-booking', {
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                // Uncomment if you need authorization
                                // 'Authorization': 'Bearer ' + yourAuthToken
                            }
                        })
                        .then(response => {
                            this.bookings = response.data.data.bookings;
                        })
                        .catch(error => {
                            switch (error.response?.status) {
                                case 401:
                                    this.error = 'Unauthorized access. Please log in.';
                                    break;
                                case 403:
                                    window.location.href = 'users/profile-user';
                                    this.error = 'Forbidden access. You do not have permission to view this resource.';
                                    break;
                                case 404:
                                    this.error = 'No bookings found.';
                                    break;
                                default:
                                    this.error = 'An error occurred while fetching bookings.';
                            }
                            console.error('Error fetching bookings:', error);
                            this.error = 'Gagal memuat data booking. Silakan coba lagi.';
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                },

                setCurrentBooking(id) {
                    this.currentBookingId = id;
                }
            }
        }

        function rescheduleComponent() {
            return {
                reschedules: [],
                loading: true,
                error: null,
                currentRescheduleId: null,
                csrfToken: document.querySelector('meta[name="csrf-token"]')?.content || '',

                fetchReschedules() {
                    this.loading = true;
                    this.error = null;

                    axios.get('http://127.0.0.1:8000/api/booking/request-reschedule', {
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                // Add authorization if needed:
                                // 'Authorization': 'Bearer ' + token
                            }
                        })
                        .then(response => {
                            this.reschedules = response.data.data;
                            isAdmin = true;
                        })
                        .catch(error => {
                            switch (error.response?.status) {
                                case 401:
                                    this.error = 'Unauthorized access. Please log in.';
                                    break;
                                case 403:
                                    window.location.href = 'http://127.0.1:8001/users/profile-user';
                                    this.error = 'Forbidden access. You do not have permission to view this resource.';
                                    break;
                                case 404:
                                    this.error = 'No bookings found.';
                                    break;
                                default:
                                    this.error = 'Gagal memuat data reschedule. Silakan coba lagi.';
                            }
                            console.error('Error fetching reschedules:', error);

                        })
                        .finally(() => {
                            this.loading = false;
                        });
                },

                setCurrentReschedule(id) {
                    this.currentRescheduleId = id;
                },

                acceptReschedule() {
                    if (!this.currentRescheduleId) return;

                    axios.post(`http://127.0.0.1:8000/api/booking/${this.currentRescheduleId}/accept-reschedule`, {}, {
                            headers: {
                                'X-CSRF-TOKEN': this.csrfToken,
                                'Content-Type': 'application/json',
                            }
                        })
                        .then(response => {
                            this.fetchReschedules(); // Refresh the list
                            this.showNotification('Permintaan reschedule diterima', 'success');
                            document.getElementById('confirmModal').click(); // Close modal
                        })
                        .catch(error => {
                            console.error('Error accepting reschedule:', error);
                            this.showNotification('Gagal menerima reschedule', 'error');
                        });
                },

                rejectReschedule() {
                    if (!this.currentRescheduleId) return;

                    axios.post(`http://127.0.0.1:8000/api/booking/${this.currentRescheduleId}/reject-reschedule`, {}, {
                            headers: {
                                'X-CSRF-TOKEN': this.csrfToken,
                                'Content-Type': 'application/json',
                            }
                        })
                        .then(response => {
                            this.fetchReschedules(); // Refresh the list
                            this.showNotification('Permintaan reschedule ditolak', 'success');
                            document.getElementById('confirmModal').click(); // Close modal
                        })
                        .catch(error => {
                            console.error('Error rejecting reschedule:', error);
                            this.showNotification('Gagal menolak reschedule', 'error');
                        });
                },

                showNotification(message, type = 'success') {
                    // You can implement a toast notification here
                    alert(`${type === 'success' ? '✅' : '❌'} ${message}`);
                }
            }
        }

        function cancelBookingComponent() {
            return {
                cancelRequests: [],
                loading: true,
                error: null,
                currentRequestId: null,
                csrfToken: document.querySelector('meta[name="csrf-token"]')?.content || '',

                fetchCancelRequests() {
                    this.loading = true;
                    this.error = null;

                    axios.get('http://127.0.0.1:8000/api/booking/request-cancel', {
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                // Add authorization if needed:
                                // 'Authorization': 'Bearer ' + token
                            }
                        })
                        .then(response => {
                            this.cancelRequests = response.data.data;
                        })
                        .catch(error => {
                            console.error('Error fetching cancel requests:', error);
                            this.error = 'Gagal memuat data pembatalan. Silakan coba lagi.';
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                },

                setCurrentRequest(id) {
                    this.currentRequestId = id;
                },

                acceptCancelRequest() {
                    if (!this.currentRequestId) return;

                    axios.post(`http://127.0.0.1:8000/api/booking/${this.currentRequestId}/accept-cancel`, {}, {
                            headers: {
                                'X-CSRF-TOKEN': this.csrfToken,
                                'Content-Type': 'application/json',
                            }
                        })
                        .then(response => {
                            this.fetchCancelRequests(); // Refresh the list
                            this.showNotification('Permintaan pembatalan diterima', 'success');
                            document.getElementById('confirmModal').click(); // Close modal
                        })
                        .catch(error => {
                            console.error('Error accepting cancel request:', error);
                            this.showNotification('Gagal menerima pembatalan', 'error');
                        });
                },

                rejectCancelRequest() {
                    if (!this.currentRequestId) return;

                    axios.post(`http://127.0.0.1:8000/api/booking/${this.currentRequestId}/reject-cancel`, {}, {
                            headers: {
                                'X-CSRF-TOKEN': this.csrfToken,
                                'Content-Type': 'application/json',
                            }
                        })
                        .then(response => {
                            this.fetchCancelRequests(); // Refresh the list
                            this.showNotification('Permintaan pembatalan ditolak', 'success');
                            document.getElementById('confirmModal').click(); // Close modal
                        })
                        .catch(error => {
                            console.error('Error rejecting cancel request:', error);
                            this.showNotification('Gagal menolak pembatalan', 'error');
                        });
                },

                showNotification(message, type = 'success') {
                    // You can implement a toast notification here
                    alert(`${type === 'success' ? '✅' : '❌'} ${message}`);
                }
            }
        }
    </script>
@endpush
