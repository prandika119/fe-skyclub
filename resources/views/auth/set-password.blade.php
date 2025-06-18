@extends('layouts.auth')
@section('content')
    {{-- [IMPROVEMENT] Container utama untuk komponen Alpine.js --}}
    <div x-data="resetPasswordFormHandler()" class="w-[512px]">
        <img class="mb-9" src="{{ asset('assets/images/icon_auth.svg') }}" alt="Authentication Icon">
        <div class="space-y-4 mb-12">
            {{-- [IMPROVEMENT] Gunakan route helper untuk URL --}}
            <a href="{{ route('login') }}" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900">
                <img src="{{ asset('assets/icons/arrow_left.svg') }}" alt="Back arrow">
                <span>Back to login</span>
            </a>
            <h4 class="text-4xl font-bold">Set a password</h4>
            <p class="text-base text-gray-600">Your previous password has been reset. Please set a new password for your
                account.</p>

            {{-- [IMPROVEMENT] Alert yang dikontrol sepenuhnya oleh Alpine.js --}}
            <div x-show="alert.show" x-cloak x-transition class="flex items-center p-4 mb-4 rounded-lg"
                :class="{ 'text-red-800 bg-red-50': alert.isError, 'text-green-800 bg-green-50': !alert.isError }"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div x-text="alert.message" class="ms-3 text-sm font-medium"></div>
                <button type="button" @click="alert.show = false"
                    class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 p-1.5 inline-flex items-center justify-center h-8 w-8"
                    :class="{
                        'bg-red-50 text-red-500 hover:bg-red-200 focus:ring-red-400': alert.isError,
                        'bg-green-50 text-green-500 hover:bg-green-200 focus:ring-green-400': !alert.isError
                    }"
                    aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>

            {{-- [IMPROVEMENT] Form menggunakan x-model, lebih bersih dan tidak perlu hidden input --}}
            <form @submit.prevent="submitForm" method="POST">
                @csrf
                <div class="space-y-6 mb-8">
                    <div x-data="{ showPassword: false }" class="relative">
                        {{-- [FIX] Tambahkan id agar terhubung dengan label (Aksesibilitas) --}}
                        <input id="password" :type="showPassword ? 'text' : 'password'" x-model="formData.password"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            required />
                        <label for="password"
                            class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1">
                            Create Password
                        </label>
                        <span class="absolute inset-y-0 right-0 flex items-center px-3 cursor-pointer"
                            @click="showPassword = !showPassword">
                            <img x-show="!showPassword" src="{{ asset('assets/icons/password-eye-off.svg') }}"
                                alt="Show password">
                            <img x-show="showPassword" x-cloak src="{{ asset('assets/icons/password-eye.svg') }}"
                                alt="Hide password">
                        </span>
                    </div>
                    <div x-data="{ showPassword: false }" class="relative">
                        {{-- [FIX] Tambahkan id agar terhubung dengan label (Aksesibilitas) --}}
                        <input id="password_confirmation" :type="showPassword ? 'text' : 'password'"
                            x-model="formData.password_confirmation"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            required />
                        <label for="password_confirmation"
                            class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1">
                            Re-enter Password
                        </label>
                        <span class="absolute inset-y-0 right-0 flex items-center px-3 cursor-pointer"
                            @click="showPassword = !showPassword">
                            <img x-show="!showPassword" src="{{ asset('assets/icons/password-eye-off.svg') }}"
                                alt="Show password">
                            <img x-show="showPassword" x-cloak src="{{ asset('assets/icons/password-eye.svg') }}"
                                alt="Hide password">
                        </span>
                    </div>
                </div>
                <button type="submit" :disabled="isLoading"
                    class="flex justify-center items-center bg-red-600 hover:bg-red-700 disabled:bg-red-400 disabled:cursor-not-allowed space-x-3 rounded py-3 font-semibold text-white w-full transition-colors">
                    <div x-show="isLoading" x-cloak>
                        <img src="{{ asset('assets/icons/loading.gif') }}" width="20" alt="Loading">
                    </div>
                    <span x-text="isLoading ? 'Submitting...' : 'Submit'"></span>
                </button>
            </form>
        </div>

        <div class="flex items-center mt-10">
            <div class="flex-grow border-t border-gray-200"></div>
            <span class="px-4 text-sm text-gray-400">or sign in with</span>
            <div class="flex-grow border-t border-gray-200"></div>
        </div>
        <div class="flex mt-10 space-x-4">
            {{-- [IMPROVEMENT] Gunakan tag <a> agar bisa diklik --}}
            <a href="#" class="border w-full py-4 border-gray-300 rounded-lg hover:bg-gray-50 flex justify-center">
                <img src="{{ asset('assets/icons/facebook.svg') }}" alt="Facebook Login">
            </a>
            <a href="#" class="border w-full py-4 border-gray-300 rounded-lg hover:bg-gray-50 flex justify-center">
                <img src="{{ asset('assets/icons/google.svg') }}" alt="Google Login">
            </a>
            <a href="#" class="border w-full py-4 border-gray-300 rounded-lg hover:bg-gray-50 flex justify-center">
                <img src="{{ asset('assets/icons/apple.svg') }}" alt="Apple Login">
            </a>
        </div>
    </div>
    {{-- carousel --}}
    <x-auth-carousel />
@endsection

@push('scripts')
    <script>
        function resetPasswordFormHandler() {
            return {
                // State
                isLoading: false,
                formData: {
                    email: '',
                    token: '',
                    password: '',
                    password_confirmation: '',
                },
                alert: {
                    show: false,
                    isError: false,
                    message: '',
                },

                // Init dipanggil saat komponen dimuat
                init() {
                    // [FIX] Ambil data dari URL saat inisialisasi, menjadi satu-satunya sumber data.
                    const params = new URLSearchParams(window.location.search);
                    this.formData.email = params.get('email');
                    this.formData.token = params.get('token');

                    // Validasi awal
                    if (!this.formData.email || !this.formData.token) {
                        this.showAlert('Invalid or missing email/token in URL.', true);
                    }
                },

                showAlert(message, isError = false) {
                    this.alert.message = message;
                    this.alert.isError = isError;
                    this.alert.show = true;
                },

                async submitForm() {
                    this.isLoading = true;
                    this.alert.show = false; // Sembunyikan alert lama sebelum submit

                    try {
                        // [IMPROVEMENT] Kirim data dari state, bukan dari form DOM
                        const response = await axios.post("/users/reset-password", this.formData);

                        this.showAlert(response.data.message || 'Password has been changed successfully.', false);

                        setTimeout(() => {
                            window.location.href = "{{ route('login') }}";
                        }, 2000);

                    } catch (error) {
                        // [IMPROVEMENT] Logika error yang lebih sederhana dan tangguh
                        let errorMessage = 'An unexpected error occurred. Please try again.';
                        if (error.response) {
                            // Ambil pesan error dari response API jika ada
                            errorMessage = error.response.data.message || 'Invalid data or token has expired.';
                            // Jika ada error validasi spesifik (422)
                            if (error.response.status === 422 && error.response.data.errors) {
                                // Ambil pesan error pertama dari daftar error
                                const firstErrorKey = Object.keys(error.response.data.errors)[0];
                                errorMessage = error.response.data.errors[firstErrorKey][0];
                            }
                        } else if (error.request) {
                            errorMessage = 'Connection problem. Please check your internet connection.';
                        }

                        this.showAlert(errorMessage, true);

                    } finally {
                        this.isLoading = false;
                    }
                }
            }
        }
    </script>
@endpush
