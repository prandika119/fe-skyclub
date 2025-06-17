<!-- filepath: resources/views/auth/login.blade.php -->
@extends('layouts.auth')
@section('content')
    <div class="w-[512px]">
        <img class="mb-9" src="{{ asset('assets/icons/icon_auth.svg') }}" alt="">
        <div class="space-y-4 mb-12">
            <h4 class="text-4xl font-bold">Login</h4>
            <p class="text-base">Login untuk akses akun SKY CLUB anda</p>
            {{-- alert --}}
            <div id="alert" class="hidden p-4 rounded-lg" role="alert"></div>
            {{-- alert end --}}
        </div>
        <form id="loginForm" x-data="loginFormHandler()" @submit.prevent="submitForm" method="POST">
            <div class="space-y-6 mb-10">
                <div class="relative">
                    <input type="text" name="username" placeholder="username"
                        :class="errors.username ? 'border-red-500 bg-red-50 focus:border-red-500 focus:ring-red-500' :
                            'border-gray-300 focus:border-blue-600 focus:ring-blue-500'"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:focus:border-blue-500 focus:outline-none focus:ring-0 peer"
                        required />
                    <label for="username"
                        class="absolute text-sm text-gray-500 dark:text-gray-400 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Username</label>
                    <p x-text="errors.username?.[0]" x-show="errors.username" class="mt-2 text-sm text-red-600">
                    </p>
                </div>
                <div x-data="{ showPassword: false }" class="relative">
                    <input :type="showPassword ? 'text' : 'password'" name="password" placeholder="password"
                        :class="errors.password ? 'border-red-500 bg-red-50 focus:border-red-500 focus:ring-red-500' :
                            'border-gray-300 focus:border-blue-600 focus:ring-blue-500'"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:focus:border-blue-500 focus:outline-none focus:ring-0 peer"
                        required />
                    <label for="password"
                        class="absolute text-sm text-gray-500 dark:text-gray-400 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Password</label>
                    <span class="absolute inset-y-0 right-0 flex items-center px-3 cursor-pointer"
                        @click="showPassword = !showPassword">
                        <img x-show="!showPassword" class="mx-auto" src="{{ asset('assets/icons/password-eye-off.svg') }}"
                            alt="">
                        <img x-show="showPassword" class="mx-auto" src="{{ asset('assets/icons/password-eye.svg') }}"
                            alt="">
                    </span>
                    <p x-text="errors.password?.[0]" x-show="errors.password"
                        class="mt-2 text-sm text-red-600 dark:text-red-500">
                    </p>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="remember" aria-describedby="remember" type="checkbox"
                                class="w-4 h-4 rounded bg-gray-50">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                        </div>
                    </div>
                    <a href="{{ route('forgot-password') }}"
                        class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot
                        password?</a>
                </div>
            </div>
            <button type="submit"
                class="flex justify-center items-center bg-red-600 rounded py-2 space-x-3 font-semibold text-white w-full hover:bg-red-800">
                <div x-show="isLoading">
                    <img src="{{ asset('assets/icons/loading.gif') }}" width="20" alt="">
                </div>
                <span>Sign in</span>
            </button>
        </form>
        <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center mt-4">
            Don’t have an account <a href="/users/register"
                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign Up</a>
        </p>
    </div>
    <x-auth-carousel />
@endsection

@push('scripts')
    <script>
        function loginFormHandler() {
            return {
                isLoading: false,
                errors: {},
                async submitForm() {
                    this.isLoading = true;
                    this.errors = {};
                    document.getElementById('alert').classList.add('hidden');
                    const formData = new FormData(document.getElementById('loginForm'));
                    const data = JSON.stringify(Object.fromEntries(formData.entries()));
                    try {
                        const response = await axios.post('/users/login', data, {
                            headers: {
                                'Content-Type': 'application/json'
                            },
                        });

                        if (response.status === 200) {
                            Alpine.store('user').setUser(response.data.data.user);
                            Alpine.store('user').setToken(response.data.data.token);

                            // set token expiry to 1 day
                            const expiryTime = new Date().getTime() + 48 * 60 * 60 * 1000; // 1 hari
                            localStorage.setItem("token_expiry", expiryTime);
                            const alert = document.getElementById('alert');
                            alert.classList.remove('hidden');
                            alert.classList.add('bg-green-50', 'text-green-800');
                            alert.innerText = 'Login successful!';
                            console.log(response.data.data.user);
                            window.location.href = '/';
                        }
                    } catch (error) {
                        if (error.response) {
                            switch (error.response.status) {
                                case 401:
                                    document.getElementById('alert').classList.remove('hidden');
                                    document.getElementById('alert').classList.add('bg-red-50', 'text-red-800');
                                    document.getElementById('alert').innerText = error.response.data.errors;
                                    break;
                                case 422:
                                    // Handle validation errors
                                    this.errors = error.response.data.errors;
                                    break;
                                default:
                                    document.getElementById('alert').classList.remove('hidden');
                                    document.getElementById('alert').classList.add('bg-red-50', 'text-red-800');
                                    document.getElementById('alert').innerText = 'An error occurred. Please try again.';
                                    break;
                            }
                        }
                    } finally {
                        this.isLoading = false;

                    }
                }
            }
        }
    </script>
@endpush
