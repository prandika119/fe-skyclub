@extends('layouts.auth')
@section('content')
    {{-- carousel --}}
    <x-auth-carousel />
    {{-- form Register --}}
    <div class=" w-[600px]" x-data="registerFormHandler()">
        <img class="mb-9" src="{{ asset('assets/icons/icon_auth.svg') }}" alt="">
        <div class=" space-y-4 mb-12">
            <h4 class="text-4xl font-bold">Sign up</h4>
            <p class="text-base">Let’s get you all st up so you can access your personal account.</p>
            {{-- alert --}}
            <div id="alert" class="hidden p-4 rounded-lg" role="alert"></div>
            {{-- alert end --}}
        </div>
        <form id="form" action="" method="POST" @submit.prevent="submitForm">
            @csrf
            <div class="space-y-6 mb-10">
                <div class="sm:flex sm:space-x-6">
                    <div class="relative w-full">
                        <input type="text" name="name" placeholder="Name"
                            :class="errors.name ? 'border-red-500 bg-red-50 focus:border-red-500 focus:ring-red-500' :
                                'border-gray-300 focus:border-blue-600 focus:ring-blue-500'"
                            class="w-full block px-2.5 pb-2.5 pt-4 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 mb-6 sm:mb-0
                            value="{{ old('name') }}"
                            required />
                        <p x-text="errors.name?.[0] " x-show="errors.name"
                            class="mt-2 text-sm text-red-600 dark:text-red-500">
                            <span class="font-medium">message
                        </p>
                        <label for="name"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Name
                            <span class="text-red-600">*</span></label>
                    </div>
                    <div class="relative w-full">
                        <input type="text" name="username" placeholder="Username"
                            class="w-full block px-2.5 pb-2.5 pt-4 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600"
                            :class="errors.username ? 'border-red-500 bg-red-50 focus:border-red-500 focus:ring-red-500' :
                                'border-gray-300 focus:border-blue-600 focus:ring-blue-500'"
                            required />
                        <p x-text="errors.username?.[0] " x-show="errors.username"
                            class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">message
                        </p>
                        <label for="username"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Username
                            <span class="text-red-600">*</span></label>
                    </div>
                </div>

                <div class="sm:flex sm:space-x-6">
                    <div class="relative w-full">
                        <input type="email" name="email" placeholder="Email"
                            class="w-full block px-2.5 pb-2.5 pt-4 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 mb-6 sm:mb-0"
                            :class="errors.email ? 'border-red-500 bg-red-50 focus:border-red-500 focus:ring-red-500' :
                                'border-gray-300 focus:border-blue-600 focus:ring-blue-500'"
                            required />
                        <p x-text="errors.email?.[0] " x-show="errors.email"
                            class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">message
                        </p>
                        <label for="email"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Email
                            <span class="text-red-600">*</span></label>
                    </div>
                    <div class="relative w-full">
                        <input type="text" name="no_telp" placeholder="Telephone Number"
                            class="w-full block px-2.5 pb-2.5 pt-4 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 "
                            :class="errors.no_telp ? 'border-red-500 bg-red-50 focus:border-red-500 focus:ring-red-500' :
                                'border-gray-300 focus:border-blue-600 focus:ring-blue-500'"
                            required />
                        <p x-text="errors.no_telp?.[0] " x-show="errors.no_telp"
                            class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">message
                        </p>
                        <label for="no_telp"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Number
                            <span class="text-red-600">*</span></label>
                    </div>
                </div>
                <div x-data="{ showPassword: false }" class="relative">
                    <input :type="showPassword ? 'text' : 'password'" name="password" placeholder="Password" required
                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 "
                        :class="errors.password ? 'border-red-500 bg-red-50 focus:border-red-500 focus:ring-red-500' :
                            'border-gray-300 focus:border-blue-600 focus:ring-blue-500'"
                        required />
                    <span class="absolute inset-y-0 right-0 flex items-center px-3 cursor-pointer"
                        @click="showPassword = !showPassword">
                        <img x-show="!showPassword" class="mx-auto" src="{{ asset('assets/icons/password-eye-off.svg') }}"
                            alt="">
                        <img x-show="showPassword" class="mx-auto" src="{{ asset('assets/icons/password-eye.svg') }}"
                            alt="">
                    </span>
                    <p x-text="errors.password?.[0] " x-show="errors.password"
                        class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">message
                    </p>
                    <label for="password"
                        class="absolute text-sm text-gray-500 dark:text-gray-400 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Password
                        <span class="text-red-600">*</span></label>
                </div>

                <div x-data="{ showPassword: false }" class="relative">
                    <input :type="showPassword ? 'text' : 'password'" name="password_confirmation"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 "
                        placeholder="Password Confirmation" />
                    <span class="absolute inset-y-0 right-0 flex items-center px-3 cursor-pointer"
                        @click="showPassword = !showPassword">
                        <img x-show="!showPassword" class="mx-auto" src="{{ asset('assets/icons/password-eye-off.svg') }}"
                            alt="">
                        <img x-show="showPassword" class="mx-auto" src="{{ asset('assets/icons/password-eye.svg') }}"
                            alt="">
                    </span>
                    <label for="password_confirmation"
                        class="absolute text-sm text-gray-500 dark:text-gray-400 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Confirm
                        Password <span class="text-red-600">*</span></label>
                </div>
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" aria-describedby="remember" type="checkbox"
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                            required="">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="text-gray-500 dark:text-gray-300">I agree to all the <a
                                href="/">Terms</a> and <a href="/">Privacy Policies</a></label>
                    </div>
                </div>
            </div>
            <button type="submit"
                class="flex justify-center items-center bg-red-600 rounded py-2 space-x-3 font-semibold text-white w-full hover:bg-red-800">
                <div x-show="isLoading">
                    <img src="{{ asset('assets/icons/loading.gif') }}" width="20" alt="">
                </div>
                <span>Create Account</span>
            </button>
        </form>
        <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center mt-4">
            Already have an account? <a href="{{ route('login') }}"
                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login</a>
        </p>
        <div class="flex items-center mt-10">
            <div class="flex-grow border-t border-gray-200"></div>
            <span class="px-4 text-gray-400">Or sign up with</span>
            <div class="flex-grow border-t border-gray-200"></div>
        </div>
        <div class="flex mt-10 space-x-4 ">
            <div class=" border w-full py-4 border-black rounded">
                <img class="mx-auto" src="{{ asset('assets/icons/facebook.svg') }}" alt="">
            </div>
            <div @click="loginWithGoogle"
                class="border w-full py-4 border-black rounded hover:bg-gray-200 cursor-pointer">
                <img class="mx-auto" src="{{ asset('assets/icons/google.svg') }}" alt="">
            </div>
            <div class=" border w-full py-4 border-black rounded">
                <img class="mx-auto" src="{{ asset('assets/icons/apple.svg') }}" alt="">
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function registerFormHandler() {
            return {
                isLoading: false,
                errors: {},
                async submitForm() {
                    this.isLoading = true;
                    const formData = new FormData(document.getElementById('form'));
                    const data = JSON.stringify(Object.fromEntries(formData.entries()));
                    console.log(data);
                    try {
                        console.log('try');
                        const response = await axios.post('/users', data, {
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            withCredentials: true
                        });

                        console.log("response" + response.status);
                        switch (response.status) {
                            case 201:
                                console.log('200');
                                document.getElementById('alert').classList.remove('hidden');
                                document.getElementById('alert').classList.add('bg-green-50', 'text-green-800');
                                document.getElementById('alert').innerText = 'Register successful!';
                                window.location.href = '/users/login';
                                break;
                        }

                    } catch (error) {
                        if (error.response) {
                            switch (error.response.status) {
                                case 422:
                                    // Update error messages
                                    this.errors = error.response.data.errors;
                                    break;
                                default:
                                    console.error(error);
                                    document.getElementById('alert').classList.remove('hidden');
                                    document.getElementById('alert').classList.add('bg-red-50', 'text-red-800');
                                    document.getElementById('alert').innerText = 'An error occurred. Please try again.';
                                    break;
                            }
                        }
                    } finally {
                        this.isLoading = false;
                    }
                },
                async loginWithGoogle() {
                    try {
                        const response = await axios.get('/auth/google');
                        window.location.href = response.data.url;
                    } catch (error) {
                        console.error('Google login error:', error);
                        document.getElementById('alert').classList.remove('hidden');
                        document.getElementById('alert').classList.add('bg-red-50', 'text-red-800');
                        document.getElementById('alert').innerText = 'An error occurred while logging in with Google.';
                    }
                }
            };
        }
    </script>
@endpush
