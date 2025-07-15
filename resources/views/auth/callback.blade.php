@extends('layouts.auth')
@section('content')
    {{-- Alpine.js Component --}}
    <div x-data="authCallback()" x-init="processToken()" class="font-sans">
        {{-- Modal --}}
        <div x-show="modal.isOpen" x-cloak @keydown.escape.window="closeAndRedirect()"
            class="fixed inset-0 z-50 flex items-center justify-center p-4">
            {{-- 1. Backdrop / Overlay --}}
            <div x-show="modal.isOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="absolute inset-0 bg-black/60" @click="closeAndRedirect()"></div>

            {{-- 2. Modal Panel --}}
            <div x-show="modal.isOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95" @click.stop
                class="relative w-full max-w-md p-6 overflow-hidden text-center bg-white rounded-lg shadow-xl">
                {{-- Icon (Success/Error) --}}
                <div class="mx-auto mb-4">
                    {{-- Success Icon --}}
                    <template x-if="modal.isSuccess">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto bg-green-100 rounded-full">
                            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                    </template>
                    {{-- Error Icon --}}
                    <template x-if="!modal.isSuccess">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto bg-red-100 rounded-full">
                            <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </template>
                </div>

                {{-- Title --}}
                <h3 class="mb-2 text-2xl font-bold text-gray-800" x-text="modal.title"></h3>

                {{-- Message --}}
                <p class="mb-6 text-gray-600" x-text="modal.message"></p>

                {{-- Button --}}
                <button @click="closeAndRedirect()"
                    :class="modal.isSuccess ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700'"
                    class="w-full px-6 py-2 font-semibold text-white rounded-lg shadow-md transition-colors duration-200">
                    Tutup
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function authCallback() {
            return {
                modal: {
                    isOpen: false,
                    isSuccess: false,
                    title: '',
                    message: ''
                },
                redirectUrl: '/', // Halaman tujuan setelah berhasil

                async processToken() {
                    // Ambil token dari URL
                    try {
                        const urlParams = new URLSearchParams(window.location.search);
                        const token = urlParams.get('token');

                        if (token) {
                            // Jika token ada, simpan dan tampilkan modal sukses
                            Alpine.store('user').setUser({
                                name: 'User'
                            }); // Simulasi user
                            Alpine.store('user').setToken(token);
                            const response = await axios.get("users/current");
                            console.log("API response received:", response.data);
                            const user = response.data.data;
                            console.log("User data fetched:", user);

                            // Simpan ke localStorage
                            localStorage.setItem("user_data", JSON.stringify(user));

                            // set token expiry to 1 day
                            const expiryTime = new Date().getTime() + 48 * 60 * 60 * 1000; // 1 hari
                            localStorage.setItem("token_expiry", expiryTime);
                            this.modal = {
                                isOpen: true,
                                isSuccess: true,
                                title: 'Autentikasi Berhasil!',
                                message: 'Anda akan diarahkan ke halaman utama dalam beberapa detik.'
                            };
                            // Redirect setelah 3 detik
                            setTimeout(() => this.closeAndRedirect(), 3000);
                        } else {
                            // Jika token tidak ada, tampilkan modal error
                            this.modal = {
                                isOpen: true,
                                isSuccess: false,
                                title: 'Autentikasi Gagal',
                                message: 'Token tidak ditemukan. Silakan coba login kembali.'
                            };
                        }
                    } catch (error) {
                        console.error('Error refreshing local storage:', error);
                    }

                },

                closeAndRedirect() {
                    this.modal.isOpen = false;
                    // Tunggu animasi selesai sebelum redirect
                    setTimeout(() => {
                        if (this.modal.isSuccess) {
                            window.location.href = this.redirectUrl;
                        }
                    }, 300); // Sesuaikan dengan durasi animasi leave
                }
            }
        }
    </script>
@endpush
