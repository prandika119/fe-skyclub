<!DOCTYPE html>
<html class="h-full bg-gray-100">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pembayaran Berhasil</title>
        <link rel="stylesheet" href="/build/assets/app.css">
        <script defer src="/build/assets/app.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-full">
        <x-navbar></x-navbar>
        <div class="my-10" x-data="{
            now: new Date(),
            get tanggal() {
                return this.now.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
            },
            get jam() {
                return this.now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false }) + ' WIB';
            }
        }">
            <div class="border bg-white shadow p-5 rounded-xl px-[70px] py-[40px] mt-32 mx-auto w-[765px]">
                <div class="flex flex-col items-center text-center mb-12">
                    <img src="{{ asset('assets/icons/icon_success.svg') }}" alt="">
                    <h4 class="text-5xl font-bold">Success</h4>
                    <div class="flex items-center text-lg">
                        <p x-text="tanggal"></p>
                        <span class="w-1.5 h-1.5 mx-1.5 bg-black rounded-full dark:bg-gray-400"></span>
                        <p x-text="jam"></p>
                    </div>
                </div>
                <div class="text-center text-xl font-medium mb-6">
                    <p>Pembayaran Sudah Berhasil</p>
                    <p>Terimakasih Sudah Mempercayai Layanan Kami</p>
                </div>
                <div class="flex items-stretch space-x-3">
                    <a href="/users/profile-user"
                        class="bg-red-600 w-full text-center py-3 rounded-lg font-bold text-white">Cek
                        Status Pembayaran</a>
                    <a href="/field-schedule"
                        class="bg-red-600 w-full text-center py-3 rounded-lg font-bold text-white">Pesan
                        Lagi</a>
                </div>
            </div>
        </div>
        <script src="/path/to/flowbite/dist/flowbite.min.js"></script>
    </body>

</html>
