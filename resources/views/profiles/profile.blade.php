@extends('layouts.master')
@section('content')
    {{-- Banner --}}
    <div x-data="userProfileHandler()" x-init="fetchUser()">
        <div class="flex flex-col items-center">
            <div class=" relative bg-cover rounded-xl overflow-hidden group w-full h-banner-profile">
                <img class="h-70 w-full object-cover" src="{{ asset('assets/images/banner/banner.svg') }}" alt="">
            </div>
            {{-- <div class="relative" x-data="{ profileImage: '/storage/{{ $data_user->profile_photo ?? asset('assets/icons/profile.svg') }}' }"> --}}
            <div class="relative" x-data="{ profileImage: '$data_user->formattedProfilePhoto' }">
                <div class="-mt-20 relative bg-cover rounded-full overflow-hidden group size-40 ring-4 ring-red-600">
                    <img id="profileImage" class="profile-image w-full h-full object-cover"
                        :src="$store.storage.getPhoto(user.profile_photo)" alt="">
                    {{-- src="{{ asset('storage/profile-photo/' . $data_user->profile_photo) }}" alt=""> --}}
                    <input name="profile_photo" type="file" id="imageUploud"
                        x-on:change="updateProfileImage($event.target.files[0])" accept="image/*" class="hidden">
                </div>
                <label for="imageUploud"
                    class="absolute bottom-0 right-0 p-2.5 bg-red-600 rounded-full group hover:bg-red-800">
                    <svg class="w-6 h-6 text-gray-800 group-hover:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                            clip-rule="evenodd" />
                    </svg>
                </label>
                {{-- <img class="absolute top-0 left-0 -mt-20" src="{{ asset('assets/icons/verified.svg') }}" alt=""> --}}
            </div>
        </div>

        {{-- profile --}}
        <div class="mt-8 flex flex-col items-center space-y-2">
            <h5 class=" text-2xl font-semibold" x-text="user.name">$data_user->name</h5>
            <p class="text-base text-gray-700" x-text="user.email">$data_user->email</p>
        </div>

        @php
            // Logika untuk menentukan tab awal
            // Misalnya, jika ada parameter ?tab=settings di URL
            $initialTab = request()->get('tab', 'account'); // Default 'account'
            $initialBookingTab = request()->get('booking_tab', 'field'); // Default 'field'
        @endphp

        {{-- tab --}}
        <div x-data="{ activeTab: '{{ $initialTab }}', activeBookingTab: '{{ $initialBookingTab }}' }">
            {{-- <div x-data="{ activeTab: '{{ session()->has('activeTab') ? session('activeTab') : 'account' }}', activeBookingTab: '{{ session()->has('activeBookingTab') ? session('activeBookingTab') : 'field' }}' }"> --}}
            <!-- Tab Menu for Account and History -->
            <div class="mt-8 pt-4 px-6 shadow bg-white rounded-lg">
                <div class="flex justify-evenly flex-wrap -mb-px text-sm font-semibold" role="tablist">
                    <div class="text-center px-60 py-4"
                        :class="{ 'text-red-600 border-b-4 border-red-600': activeTab === 'account' }">
                        <button @click="activeTab = 'account'" class="inline-block">Account</button>
                    </div>
                    <div class="border-l border-gray-400 h-7 my-auto"></div>
                    <div class="text-center px-60 py-4"
                        :class="{ 'text-red-600 border-b-4 border-red-600': activeTab === 'history' }">
                        <button @click="activeTab = 'history'" class="inline-block">History</button>
                    </div>
                </div>
            </div>

            <!-- Account Tab Content -->
            <div x-show="activeTab === 'account'" class="mt-10">
                <h2 class="font-bold text-3xl mb-4">Account</h2>

                {{-- modal --}}
                <x-modal-success message="Update Data Berhasil" />
                <x-modal-error />
                <div class="px-6 py-8 rounded-lg bg-white shadow space-y-8">
                    <template
                        x-for="field in [
                            { key: 'name', label: 'Nama', type: 'text' },
                            { key: 'email', label: 'Email', type: 'text' },
                            { key: 'no_telp', label: 'No Handphone', type: 'number' },
                            { key: 'address', label: 'Address', type: 'text' },
                            { key: 'date_of_birth', label: 'Tanggal Lahir', type: 'date' },
                            { key: 'team', label: 'Team', type: 'text' }
                        ]"
                        :key="field.key">
                        <div class="flex justify-between items-center">
                            <div>
                                <p x-text="field.label"></p>
                                <div class="relative z-0">
                                    <input :type="field.type" :id="field.key"
                                        class="font-semibold text-xl block py-2.5 px-0 w-full text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-red-600 peer"
                                        :placeholder="`Silahkan diisi...`" :value="user ? user[field.key] : ''" />
                                </div>
                            </div>
                            <button @click="updateUser(field.key)"
                                class="py-3 px-6 border-2 border-red-500 items-center flex rounded-lg space-x-1 text group hover:text-white hover:bg-red-500"
                                type="button">
                                <svg class="w-6 h-6 text-gray-800 group-hover:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                </svg>
                                <div x-show="isLoading">
                                    <img src="{{ asset('assets/icons/loading.gif') }}" width="20" alt="">
                                </div>
                                <p x-show="!isLoading" class="group-hover:text-white">Change</p>
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- History Tab Content -->
            <div x-show="activeTab === 'history'" class="mt-10">
                <h2 class="font-bold text-3xl mb-4">Bookings</h2>
                <!-- Tab Menu for Bookings -->
                <div class="mt-8 pt-4 px-6 shadow bg-white rounded-lg">
                    <div class="flex justify-evenly flex-wrap -mb-px text-sm font-semibold" role="tablist">
                        <div class="text-center p-40 py-4"
                            :class="{ 'text-red-600 border-b-4 border-red-600': activeBookingTab === 'field' }">
                            <button @click="activeBookingTab = 'field'" class="inline-block">Lapangan</button>
                        </div>
                        <div class="border-l border-gray-400 h-7 my-auto"></div>
                        <div class="text-center p-40 py-4"
                            :class="{ 'text-red-600 border-b-4 border-red-600': activeBookingTab === 'sparing' }">
                            <button @click="activeBookingTab = 'sparing'" class="inline-block">Sparing</button>
                        </div>
                        <div class="border-l border-gray-400 h-7 my-auto"></div>
                        <div class="text-center p-40 py-4"
                            :class="{ 'text-red-600 border-b-4 border-red-600': activeBookingTab === 'finish' }">
                            <button @click="activeBookingTab = 'finish'" class="inline-block">Selesai</button>
                        </div>
                    </div>
                </div>

                <!-- Booking Tab Contents -->
                <div x-data="bookingData()" x-init="fetchBookings" x-show="activeBookingTab === 'field'"
                    class="mt-8 space-y-10">
                    <template x-for="schedule in schedules" :key="schedule.id">
                        <div>
                            <x-drop-booking />
                        </div>
                    </template>
                    <div>
                        <p x-show="schedules.length == 0" class="text-center text-gray-500">Tidak ada jadwal yang telah
                            dipesan
                        </p>
                    </div>
                </div>

                <div x-data="sparingData()" x-init="fetchSparings()" x-show="activeBookingTab === 'sparing'"
                    class="mt-8 space-y-10">
                    <template x-for="sparing in sparings" :key="sparing.id">
                        <div>
                            <x-drop-sparing />
                        </div>
                    </template>
                    <p x-show="sparings.length == 0" class="text-center text-gray-500">Tidak ada sparing yang
                        telah dibuat</p>
                </div>

                <div x-data="historyData()" x-init="fetchHistoryBookings()" x-show="activeBookingTab === 'finish'"
                    class="mt-8 space-y-10">
                    <template x-for="booking in historyBookings" :key="booking.id">
                        <div>
                            <x-drop-history-booking />
                        </div>
                    </template>
                    <p x-show="historyBookings.length == 0" class="text-center text-gray-500">Tidak ada history booking
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function userProfileHandler() {
            return {
                isLoading: false,
                error: null,
                user: '',
                alertSuccess: false,
                async fetchUser() {
                    try {
                        const response = await axios.get('/users/current');
                        this.user = response.data.data;
                        console.log('User data loaded:', this.user);
                    } catch (error) {
                        console.error('Error fetching user data:', error);
                        this.error = error.response?.data?.errors || 'Failed to load user data';
                    } finally {
                        this.isLoading = false;
                    }
                },
                async updateUser(field) {

                    try {
                        this.isLoading = true;
                        const fieldValue = document.querySelector('#' + field).value;
                        console.info('Updating user field:', field, 'with value:', fieldValue);
                        // const payload = {
                        //     [field]: fieldValue
                        // };
                        const response = await axios.post('/users/current', {
                            [field]: fieldValue
                        })
                        this.alertSuccess = true;
                        // refresh local storage
                        Alpine.store('user').refreshLocalStorage();
                        console.log('User updated:', response.data);
                    } catch (error) {
                        console.error('Error updating user:', error);
                        // Ambil semua key error
                        const errors = error.response?.data?.errors;
                        let message = 'Failed to load user data';

                        if (errors && typeof errors === 'object') {
                            // Ambil key pertama dari errors
                            const firstField = Object.keys(errors)[0];
                            if (firstField && errors[firstField][0]) {
                                message = errors[firstField][0];
                            }
                        }
                        await this.fetchUser();
                        this.error = message;
                    } finally {
                        this.isLoading = false;
                    }
                },
                async updateProfileImage(file) {
                    const formData = new FormData();
                    formData.append('profile_photo', file);
                    console.log(formData);
                    try {
                        const response = await axios.post('/users/current', formData);
                        await Alpine.store('user').refreshLocalStorage();
                        window.location.reload();
                        console.log(response);
                    } catch (error) {
                        console.error("error uplouding")
                        this.error = error.response?.data?.errors || 'Failed to load user data';
                    }
                }
            }
        }

        function bookingData() {
            return {
                schedules: [],
                error: null,
                sparingDescription: '',
                cancelReason: '',
                isLoading: false,
                async fetchBookings() {
                    try {
                        isLoading = true;
                        const response = await axios.get('/my-booking');
                        this.schedules = response.data.data.bookings;
                        console.log('Bookings data loaded:', this.schedules);
                    } catch (error) {
                        console.error('Error fetching bookings data:', error);
                    } finally {
                        this.isLoading = false;
                    }
                },
                async fetchSparings() {
                    try {
                        const response = await axios.get('/my-booking', {
                            params: {
                                sparing: 1
                            }
                        });
                        console.log('Sparings data loaded:', this.sparings);
                    } catch (error) {
                        console.error('Error fetching sparings data:', error);
                    }
                },
                async createSparing(bookingId) {
                    try {
                        this.isLoading = true;
                        const response = await axios.post('/sparings', {
                            list_booking_id: bookingId,
                            description: this.sparingDescription
                        });
                        console.log('Sparing created:', response.data);
                        // Optionally, refresh the bookings data
                        await this.fetchBookings();
                        console.log('schedules', this.schedules);
                        // fetch sparings data
                        window.location.href = '/users/profile-user?tab=history&booking_tab=sparing';
                    } catch (error) {
                        console.error('Error creating sparing:', error);
                    } finally {
                        this.isLoading = false;
                    }
                },
                async cancelBooking(bookingId) {
                    try {
                        this.isLoading = true;
                        const response = await axios.post(`/my-booking/${bookingId}/request-cancel`, {
                            reason: this.cancelReason
                        });
                        console.log('Booking canceled:', response.data);
                        // Optionally, refresh the bookings data
                        await this.fetchBookings();
                        console.log('Nyoba cancel', this.schedules);
                    } catch (error) {
                        console.error('Error canceling booking:', error);
                        this.error = error.response.data.error || 'Failed to cancel booking';
                    } finally {
                        this.isLoading = false;
                    }
                },

                styleBookingStatus(status) {
                    if (status == 'Reschedule Request' || status == 'Cancel Request' || status == 'pending') {
                        return 'bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded ';
                    } else if (status == 'accepted' || status == 'Reschedule') {
                        return 'bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded '
                    } else if (status == 'canceled' || status == 'Canceled' || status == 'Reschedule Rejected' || status ==
                        'Cancel Rejected') {
                        return 'bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded'
                    }
                },
                canCancelBooking(status) {
                    return status === 'accepted' || status === 'Reschedule Rejected';
                },
                canRescheduleBooking(status) {
                    return status === 'accepted' || status === 'Cancel Rejected';
                },
                canSparing(status, has_sparing) {
                    return status === 'accepted' && !has_sparing;
                }
            }
        }

        function sparingData() {
            return {
                sparings: [],
                async fetchSparings() {
                    try {
                        const response = await axios.get('/my-booking', {
                            params: {
                                sparing: 1
                            }
                        });
                        this.sparings = response.data.data.bookings;

                        console.log('Sparings data loaded:', this.sparings);


                    } catch (error) {
                        console.error('Error fetching sparings data:', error);
                    }
                },
                sparingStatusClass(status) {
                    switch (status) {
                        case 'accepted':
                            return 'bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded ';
                        case 'done':
                            return 'bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded ';
                        case 'waiting':
                            return 'bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded ';
                        case 'rejected':
                            return 'bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded ';
                        default:
                            return 'bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded ';
                    }
                },
                async acceptSparing(sparingReqId) {
                    try {
                        const response = await axios.post(`/sparings/${sparingReqId}/accept`);
                        console.log('Sparing accepted:', response.data);
                        // Optionally, refresh the sparings data
                        await this.fetchSparings();
                    } catch (error) {
                        console.error('Error accepting sparing:', error);
                        alert('Gagal menerima sparing, silahkan coba lagi');
                    }
                },
                async rejectSparing(sparingReqId) {
                    // Logic to reject the sparing
                    try {
                        const response = await axios.post(`/sparings/${sparingReqId}/reject`);
                        console.log('Sparing rejected:', response.data);
                        // Optionally, refresh the sparings data
                        await this.fetchSparings();
                    } catch (error) {
                        console.error('Error rejecting sparing:', error);
                        alert('Gagal menolak sparing, silahkan coba lagi');
                    }
                },
            }
        }

        function historyData() {
            return {
                historyBookings: [],
                isLoading: false,
                ratingBookingModal: false,
                rating: 5,
                review: '',
                async fetchHistoryBookings() {
                    try {
                        const response = await axios.get('/my-booking', {
                            params: {
                                sparing: 1,
                                past: 1
                            }
                        });
                        this.historyBookings = response.data.data.bookings;

                        console.log('History data loaded:', this.historyBookings);
                    } catch (error) {
                        console.error('Error fetching sparings data:', error);
                    }
                },
                async addReview(bookingId, rating, comment, fieldId) {
                    // Logic to add a review for the booking
                    console.log('Add review for booking ID:', bookingId);
                    try {
                        this.isLoading = true;
                        const response = await axios.post('/reviews', {
                            booking_id: bookingId,
                            rating: rating,
                            comment: comment,
                            field_id: fieldId
                        });
                        console.log('Review added:', response.data);
                        // Optionally, refresh the history bookings data
                        await this.fetchHistoryBookings();
                        this.review = '';
                        this.rating = 5; // Reset rating to default
                    } catch (error) {
                        console.error('Error adding review:', error);
                    } finally {
                        this.isLoading = false;
                        this.ratingBookingModal = false;
                    }
                },
                historyStatusClass(status) {
                    if (status == 'Reschedule Request' || status == 'Cancel Request' || status == 'pending') {
                        return 'bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded ';
                    } else if (status == 'accepted' || status == 'Reschedule') {
                        return 'bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded '
                    } else if (status == 'canceled' || status == 'Canceled' || status == 'Reschedule Rejected' || status ==
                        'Cancel Rejected') {
                        return 'bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded'
                    }
                }
            }
        }
    </script>
@endpush
