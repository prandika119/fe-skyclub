@extends('layouts.auth')
@section('content')
    <div x-data="forgotPasswordFormHandler()" x-init="init();
    $store.user.guestOnly()" class="w-[512px]">
        <img class="mb-9" src="{{ asset('assets/icons/icon_auth.svg') }}" alt="">
        <div class="space-y-4 mb-12">
            <a href="/users/login" class="flex space-x-1">
                <img src="{{ asset('assets/images/arrow_left.svg') }}" alt=""><span>Back to login</span>
            </a>
            <h4 class="text-4xl font-bold">Forgot your password?</h4>
            <p class="text-base">Don't worry, happens to all of us. Enter your email below to recover your password</p>

            {{-- alert --}}
            <div id="alert" class="hidden items-center p-4 mb-4 rounded-lg"
                :class="{ 'text-blue-800 bg-blue-50': !isError, 'text-red-800 bg-red-50': isError }" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div id="alert-message" class="ms-3 text-sm font-medium"></div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 p-1.5 inline-flex items-center justify-center h-8 w-8"
                    :class="{
                        'bg-blue-50 text-blue-500 hover:bg-blue-200 focus:ring-blue-400': !
                            isError,
                        'bg-red-50 text-red-500 hover:bg-red-200 focus:ring-red-400': isError
                    }"
                    onclick="hideAlert()" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            {{-- end alert --}}
        </div>

        <form id="forgotPasswordForm" @submit.prevent="submitForm" method="POST">
            {{-- Input Email --}}
            <div class="space-y-6 mb-8">
                <div class="relative w-full">
                    <input type="email" name="email" placeholder="Email" id="email"
                        class="w-full block px-2.5 pb-2.5 pt-4 text-sm text-gray-900 bg-transparent rounded-lg border-1 appearance-none focus:outline-none focus:ring-0"
                        :class="errors.email ? 'border-red-500 bg-red-50 focus:border-red-500 focus:ring-red-500' :
                            'border-gray-300 focus:border-blue-600 focus:ring-blue-500'"
                        @keyup.enter="submitForm" required />
                    <p x-text="errors.email?.[0]" x-show="errors.email" class="mt-2 text-sm text-red-600"></p>
                    <label for="email"
                        class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-2 z-10 bg-white px-2 start-1">Email</label>
                </div>

                {{-- Input Telepon --}}
                <div class="relative w-full">
                    <input type="text" id="no_telp" name="no_telp" placeholder="Telephone Number"
                        class="w-full block px-2.5 pb-2.5 pt-4 text-sm text-gray-900 bg-transparent rounded-lg border-1 appearance-none focus:outline-none focus:ring-0"
                        :class="errors.no_telp ? 'border-red-500 bg-red-50 focus:border-red-500 focus:ring-red-500' :
                            'border-gray-300 focus:border-blue-600 focus:ring-blue-500'"
                        required />
                    <p x-text="errors.no_telp?.[0]" x-show="errors.no_telp" class="mt-2 text-sm text-red-600"></p>
                    <label for="no_telp"
                        class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-2 z-10 bg-white px-2 start-1">Number</label>
                </div>
            </div>
            <button type="submit"
                class="flex justify-center items-center bg-red-600 hover:bg-red-700 space-x-3 rounded py-2 font-semibold text-white w-full">
                <div x-show="isLoading">
                    <img src="{{ asset('assets/icons/loading.gif') }}" width="20" alt="">
                </div>
                <span>Submit</span>
            </button>
        </form>
    </div>

    <x-auth-carousel />
@endsection

@push('scripts')
    <script>
        function forgotPasswordFormHandler() {
            return {
                isLoading: false,
                isError: false,
                errors: {},
                init() {
                    this.isError = false;
                },
                async submitForm() {
                    this.isLoading = true;
                    this.errors = {};

                    try {
                        const formData = new FormData(document.getElementById('forgotPasswordForm'));
                        const data = Object.fromEntries(formData.entries());

                        const response = await axios.post('/users/forgot-password', data, {
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            withCredentials: true
                        });

                        if (response.status === 200) {
                            const alert = document.getElementById('alert');
                            const alertMessage = document.getElementById('alert-message');
                            const email = formData.get('email');
                            this.isError = false;
                            alert.classList.remove('hidden');
                            alert.classList.add('flex');
                            console.log(response.data.data.token);
                            alertMessage.innerText = response.data.message || 'Silahkan atur password baru.';

                            setTimeout(() => {
                                window.location.href =
                                    `/users/reset-password?email=${encodeURIComponent(email)}&token=${encodeURIComponent(response.data.data.token)}`;
                            }, 2000);
                        }
                    } catch (error) {
                        const alert = document.getElementById('alert');
                        const alertMessage = document.getElementById('alert-message');

                        if (error.response) {
                            // Handle semua jenis error response
                            let errorMessage = '';

                            // Untuk error 400 - ambil dari errors.message
                            if (error.response.status === 400) {
                                errorMessage = error.response.data.errors?.message ||
                                    error.response.data.message ||
                                    'Permintaan tidak valid';
                            }
                            // Untuk error 403/422 - ambil langsung dari message
                            else if (error.response.status === 403 || error.response.status === 422) {
                                errorMessage = error.response.data.message ||
                                    'Terjadi kesalahan pada proses verifikasi';
                            }
                            // Untuk error lainnya
                            else {
                                errorMessage = error.response.data.message ||
                                    'Terjadi kesalahan. Silakan coba lagi.';
                            }

                            // Tampilkan alert error
                            alert.classList.remove('hidden');
                            alert.classList.add('flex');
                            alertMessage.innerText = errorMessage;
                            this.isError = true;

                            // Jika ada error validasi field (422), tampilkan di field yang sesuai
                            if (error.response.status === 422 && error.response.data.errors) {
                                this.errors = error.response.data.errors;
                            }
                        } else {
                            // Handle network error
                            alert.classList.remove('hidden');
                            alert.classList.add('flex');
                            alertMessage.innerText = 'Koneksi bermasalah. Silakan cek koneksi internet Anda.';
                            this.isError = true;
                        }
                    } finally {
                        this.isLoading = false;
                    }
                }
            }
        }

        function hideAlert() {
            const alert = document.getElementById('alert');
            alert.classList.add('hidden');
        }
    </script>
@endpush
