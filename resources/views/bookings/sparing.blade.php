@extends('layouts.master')
@section('content')
    <div class="mt-17.5">
        <p class="font-semibold text-base mb-4">Sparing</p>
        <h1 class="font-bold text-5xl mb-6">Daftar Sparing</h1>
        <p class="text-lg">Berikut adalah list data sparing yang tersedia saat ini.</p>
    </div>
    <div x-data="sparingHandler()" x-init="fetchSparings()" class="grid gap-x-2.5 gap-y-8 grid-cols-2">
        <template x-if="sparings.length > 0">
            <template x-for="sparing in sparings" :key="sparing.id">

                <div class="p-8 rounded-lg border border-gray-500">
                    <div class="mb-8">
                        <div class="flex space-x-4 items-center mb-4">
                            <img class=" rounded-full"
                                :src="sparing.created_by.profile_photo ?? '/assets/icons/profile.svg'" alt=""
                                width="50px">
                            <p class="font-semibold text-2xl" x-text="sparing.created_by.team"> $sparing->createdBy->team
                            </p>
                        </div>
                        <p class="mb-6 text-lg" x-text="sparing.description ?? 'Tidak ada deskripsi'">$sparing->description
                        </p>
                        <div class="flex justify-between text-lg">
                            <div class="flex space-x-3">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                                </svg>
                                <p>Jl. Jenderal Sudirman No. 45</p>
                            </div>
                            <div class="flex space-x-3">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <p x-text="sparing.list_booking.session">$sparing->listBooking->formatted_session</p>
                            </div>

                            <div class="flex space-x-3">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                                </svg>
                                <p x-text="sparing.list_booking.date">$sparing->listBooking->formatted_date</p>
                            </div>
                        </div>
                    </div>
                    <form action="" method="POST" @submit.prevent="createSparing(sparing.id)">
                        <button type="submit"
                            class=" bg-red-600 rounded-lg px-6 py-3 font-semibold text-white text-base">Ayo
                            Sparing</button>
                    </form>
                </div>

            </template>
        </template>

        {{-- Data Not Found --}}
        <template x-if="sparings.length === 0">
            <p x-show="!isLoading" class="text-lg">Tidak ada sparing yang tersedia</p>

        </template>

        <!-- Loading -->
        <template x-if="isLoading">
            <div class="col-span-3 my-8 row-span-2 flex items-start justify-start">
                <svg class="animate-spin h-8 w-8 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4" />
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                </svg>
            </div>
        </template>

        <!-- Modal Error Besar -->
        <div x-show="error" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/70">
            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-8 text-center relative">
                <button @click="error = null"
                    class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-2xl">&times;</button>
                <svg class="mx-auto mb-4 w-16 h-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
                <h2 class="text-2xl font-bold mb-2 text-red-600">Terjadi Kesalahan</h2>
                <p class="mb-6 text-gray-700 text-xl" x-text="error"></p>
                <button @click="error = null"
                    class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition">Tutup</button>
            </div>
        </div>

        <!-- Modal Message Berhasil -->
        <div x-show="message" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/70">
            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-8 text-center relative">
                <button @click="message = null"
                    class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-2xl">&times;</button>
                <svg class="mx-auto mb-4 w-16 h-16 text-green-500" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <h2 class="text-2xl font-bold mb-2 text-green-600">Berhasil</h2>
                <p class="mb-6 text-gray-700 text-xl" x-text="message"></p>
                <button @click="message = null"
                    class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 transition">Tutup</button>
            </div>
        </div>



        {{-- @forelse ($sparings as $sparing)
            <div class="p-8 rounded-lg border border-gray-500">
                <div class="mb-8">
                    <div class="flex space-x-4 items-center mb-4">
                        <img class=" rounded-full" src="{{ $sparing->createdBy->formattedProfilePhoto }}" alt=""
                            width="50px">
                        <p class="font-semibold text-2xl">{{ $sparing->createdBy->team }}</p>
                    </div>
                    <p class="mb-6 text-lg">{{ $sparing->description }}</p>
                    <div class="flex justify-between text-lg">
                        <div class="flex space-x-3">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                            </svg>
                            <p>Jl. Jenderal Sudirman No. 45</p>
                        </div>
                        <div class="flex space-x-3">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <p>{{ $sparing->listBooking->formatted_session }}</p>
                        </div>

                        <div class="flex space-x-3">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                            </svg>
                            <p>{{ $sparing->listBooking->formatted_date }}</p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('sparing.request', $sparing->id) }}" method="POST">
                    @csrf
                    <button @click="sparingModal = true" type="submit"
                        class=" bg-red-600 rounded-lg px-6 py-3 font-semibold text-white text-base">Ayo
                        Sparing</button>
                    </form>
                </div>

                @empty
            <p>Tidak ada sparing</p>
            @endforelse --}}
    </div>



    @if (session()->has('sparingFailed'))
        <div id="popup-modal" tabindex="-1"
            class="fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                            {{ session('sparingFailed') }}
                        </h3>
                        <button data-modal-hide="popup-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">OK</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('script')
    <script>
        function sparingHandler() {
            return {
                sparings: [],
                sparingModal: false,
                isLoading: false,
                error: null,
                message: null,
                async fetchSparings() {
                    this.isLoading = true;
                    try {
                        const response = await axios.get('/sparings');
                        console.log(response.data);
                        this.sparings = response.data.data; // Asumsikan API mengembalikan array objek sparing
                        console.log(this.sparings);
                    } catch (error) {
                        console.error('Terjadi Kesalahan Di Server:', error);
                    } finally {
                        this.isLoading = false;
                    }
                },
                async createSparing(sparingId) {
                    try {
                        const response = await axios.post(`/sparings/${sparingId}/request`);
                        console.log(response.data);
                        this.fetchSparings(); // Refresh data sparing
                        this.message = response.data.message || 'Permintaan sparing berhasil dikirim.';
                    } catch (error) {
                        console.error('Terjadi Kesalahan:', error);
                        this.error = error.response.data.errors || 'Terjadi kesalahan saat mengirim permintaan sparing.'
                    }
                }
            }
        }
    </script>
@endpush
