<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SkyClub</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('header')

    </head>

    <body class="h-full bg-basic bg-[#FAFBFC] ">
        <x-navbar></x-navbar>

        <div class="h-20"></div>
        {{-- <main class="min-h-full px-26 my-10">
        @yield('content')
    </main> --}}
        <main class="min-h-full md:py-6 lg:py-8 xl:py-10 px-4 sm:px-6 md:px-10 lg:px-18 xl:px-26">
            @yield('content')
        </main>

        <x-bottom></x-bottom>
        <script src="{{ asset('node_modules/flowbite/dist/flowbite.min.js') }}"></script>
        <script>
            function logoutHandler() {
                return {
                    isLoading: false,
                    errors: {},
                    async submitLogout() {
                        user.clearUser();
                        window.location.href = '/';
                        this.isLoading = true;
                        try {
                            // const response = await axios.post('/users/logout');
                            // console.log(response);
                        } catch (error) {
                            console.error(error);
                        } finally {
                            this.isLoading = false;
                        }
                    }
                }
            }
        </script>
        @stack('script')
    </body>


</html>
