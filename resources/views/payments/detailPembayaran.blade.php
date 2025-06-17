@extends('layouts.master')
@section('content')
    <x-navbar></x-navbar>

    <div class="min-h-full px-16 my-12 pt-20" x-data="paymentHandler()">
        <div class=" grid grid-cols-2 gap-10">
            <div>
                <h2 class=" font-bold text-3xl mb-4">Detail Pembayaran</h2>
                <h4 class=" font-bold text-2xl mb-5" x-text="field.name">$field->name</h4>
                <div class="flex items-center mb-4">
                    <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 22 20">
                        <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                    </svg>
                    <p class=" font-bold text-2xl"
                        x-text="field.review?.average > 0 ? field.review.average : 'Belum ada rating'">
                        $averageRating</p>
                    <span class="w-1.5 h-1.5 mx-5 bg-black rounded-full dark:bg-gray-400"></span>
                    <p class=" font-bold text-2xl">Lokasi</p>
                </div>
                <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
                <h4 class=" font-bold text-2xl" x-text="field.name">$field->name</h4>
                <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
                <div class="space-y-1">
                    <template x-for="(schedule, index) in schedules" :key="index">
                        <div>
                            <div class="flex items-center">
                                <p x-text="$store.format.date(schedule.date)"></p>
                            </div>
                            <div
                                class="flex items-center justify-between border-s-8 border-red-600 bg-white p-2.5 font-bold text-base rounded-xl">
                                <p x-text="schedule.session"></p>
                                <p x-text="$store.format.rupiah(schedule.price)"></p>
                            </div>
                        </div>
                    </template>
                </div>

                <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">

                <div x-data="{ dropDown: 'up' }">
                    <div class="flex justify-between mb-4">
                        <h5 class=" font-bold text-2xl">Metode Pembayaran</h5>
                        <svg x-show="dropDown == 'up'" @click="dropDown='down'" class="w-6 h-6 text-gray-800"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m5 15 7-7 7 7" />
                        </svg>
                        <svg x-show="dropDown == 'down'" @click="dropDown='up'" class="w-6 h-6 text-gray-800"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 9-7 7-7-7" />
                        </svg>
                    </div>
                    <div x-show="dropDown == 'down'"
                        class="flex justify-between shadow bg-white rounded-lg items-center p-2.5 text-base">
                        <div class="flex items-center space-x-2">
                            <img src="{{ Storage::url('images/Transfer_bank.svg') }}" alt="">
                            <p>Wallet</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input id="default-radio-1" type="radio" value="" name="default-radio"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" required>
                            <label for="default-radio-1" class="ms-2 font-medium text-gray-900 "
                                x-text="$store.format.rupiah(full_total)">
                                formatRupiah $harga_total</label>
                        </div>
                    </div>
                </div>



            </div>
            <div class=" space-y-4" x-data="{ inputVoucher: 'false' }">
                <button @click="inputVoucher = !inputVoucher"
                    class="w-full py-3 border-2 border-red-600 text-center text-base rounded-xl font-bold text-red-600 flex items-center justify-center">
                    <img src="{{ asset('assets/icons/icon_voucher.svg') }}" alt="Voucher Icon" class="w-5 h-5 mr-2">
                    Gunakan Voucher
                </button>
                {{-- voucher --}}

                <form x-show="inputVoucher" class="flex items-center w-full" action="" method="POST"
                    @submit.prevent="checkVoucher()">
                    @csrf
                    <label for="simple-search" class="sr-only">Voucher</label>
                    <div class="relative w-full flex-grow">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <img src="{{ asset('assets/icons/icon_voucher.svg') }}" alt="Voucher Icon" class="w-5 h-5 mr-2">
                        </div>
                        <input type="text" id="simple-search" name="voucher" autocomplete="off"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full ps-10 p-2.5 "
                            :class="!validVoucher ? 'border-red-600' : 'border-gray-300'"
                            :class="validVoucher ? 'border-green-600' : 'border-gray-300'"
                            placeholder="Masukan Kode Voucher..." x-model="code_voucher" />

                    </div>
                    <button type="submit"
                        class="p-2.5 ms-2 text-sm font-medium text-white bg-red-600 rounded-lg border border-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 flex-grow">
                        <p>Gunakan</p>
                        <span class="sr-only">Gunakan</span>
                    </button>
                </form>
                <p x-show="!validVoucher" class="text-sm text-red-600 dark:text-red-500"><span class="font-medium"
                        x-text="messageVoucher">
                </p>
                <p x-show="validVoucher" class="text-sm text-green-600 dark:text-green-500"><span class="font-medium"
                        x-text="messageVoucher">voucherSuccess</p>


                {{-- end voucher --}}
                <div class="border border-gray-600 p-5 rounded-xl">
                    <div class="flex items-center space-x-3">
                        <img class="rounded-xl h-[100px]" src="{{ Storage::url('images/album_1.svg') }}" alt="">
                        <div>
                            <h3 class="font-bold text-2xl" x-text="field.name">$field->name</h3>
                            <div class="flex items-center mb-4">
                                <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <p class=" font-bold text-2xl mx-1.5"
                                    x-text="field.review?.average > 0 ? field.review.average : 'Belum ada rating'">
                                    $averageRating</p>
                                <p class=" font-semibold text-2xl" x-text="` (${field.review.count} reviews)`">
                                    ($countRating
                                    Reviews)</p>
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
                    <h3 class=" text-2xl font-bold mb-4">Detail Harga</h3>
                    <div class=" text-base space-y-1">
                        <div class="flex items-center justify-between">
                            <p>Biaya Sewa</p>
                            <p x-text="$store.format.rupiah(sub_total)">$sub_total</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p>Potongan Voucher</p>
                            <p x-text="$store.format.rupiah(discount)">formatRupiah$voucher</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p>Biaya Transaksi</p>
                            <p x-text="$store.format.rupiah(transaction_fee)">Rp 0</p>
                        </div>
                    </div>
                    <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
                    <div class="flex items-center justify-between">
                        <p class=" font-bold text-2xl">Total</p>
                        <p class=" font-bold" x-text="$store.format.rupiah(calculateTotal())">formatRupiah
                            $harga_total</p>
                    </div>
                </div>

                <form action="" method="POST" @submit.prevent="paymentProcess()">
                    @csrf
                    <button type="submit"
                        class="w-full py-3 border-2 bg-red-600 text-center text-2xl rounded-xl font-bold text-white flex items-center justify-center">
                        <img x-show="!isLoading" src="{{ asset('assets/icons/icon_shield.svg') }}" alt="Voucher Icon"
                            class="mr-2">
                        <div x-show="isLoading" class="mr-3">
                            <img src="{{ asset('assets/icons/loading.gif') }}" width="30" alt="">
                        </div>
                        <span>Bayar</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Modal Error Besar -->
        <div x-show="error" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/70">
            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-8 text-center relative">
                <button @click="error = null"
                    class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-2xl">&times;</button>
                <svg class="mx-auto mb-4 w-16 h-16 text-red-500" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
                <h2 class="text-2xl font-bold mb-2 text-red-600">Terjadi Kesalahan</h2>
                <p class="mb-6 text-gray-700 text-xl" x-text="error"></p>
                <button @click="error = null"
                    class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition">Tutup</button>
            </div>
        </div>

    </div>
@endsection
@push('script')
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script>
        function paymentHandler() {
            return {
                isLoading: false,
                error: null,
                messageError: null,
                field: {},
                schedules: [],
                sub_total: 0,
                discount: 0,
                transaction_fee: 0,
                full_total: 0,
                code_voucher: '',
                users_offline: [],
                selectedUser: 'nothing',
                user_offline: {
                    name: '',
                    no_telp: '',
                    email: ''
                },
                averageRating: 0,
                countRating: 0,
                inputVoucher: false,
                validVoucher: null,
                messageVoucher: null,
                bookingId: null,

                async init() {
                    try {
                        const pathId = window.location.pathname.split('/'); // ['', 'payment', '123']
                        this.bookingId = pathId[2]; // '123'
                        // Ganti booking_id sesuai kebutuhan
                        const res = await axios.get(`/cart/${this.bookingId}`);
                        this.isLoading = true;

                        this.schedules = res.data.data.cart;
                        this.field = this.schedules[0].field;
                        this.sub_total = res.data.data.sub_total;
                        this.discount = res.data.data.discount;
                        this.full_total = res.data.data.total_price;
                        this.code_voucher = res.data.data.code_voucher;


                    } catch (e) {
                        this.error = 'Gagal memuat data pembayaran';
                        window.location.href = '/field-schedule';
                    } finally {
                        this.isLoading = false;
                    }
                },

                async checkVoucher() {
                    this.isLoading = true;
                    try {
                        const res = await axios.post(`voucher/${this.code_voucher}/booking/${this.bookingId}`);
                        console.log(res);
                        this.messageVoucher = res.data.message;
                        this.validVoucher = true;
                        this.discount = res.data.data.discount;
                        this.full_total = res.data.data.total_price;

                    } catch (e) {
                        this.validVoucher = false;
                        this.messageVoucher = e.response.data.message;
                        this.discount = 0;
                        this.full_total = this.sub_total;
                        console.error(e);
                    } finally {
                        this.isLoading = false;
                    }
                },

                async paymentProcess() {
                    this.isLoading = true;
                    try {
                        const res = await axios.post('booking/payment', {
                            booking_id: this.bookingId,
                            total_price: this.calculateTotal(),
                        });
                        await Alpine.store('user').refreshLocalStorage();
                        window.location.href = '/payment-success';
                    } catch (e) {
                        this.error = e.response.data.errors;
                        console.error(e);
                    } finally {
                        this.isLoading = false;
                    }
                },

                calculateTotal() {
                    return this.full_total + this.transaction_fee;
                },
                formatRupiah(angka) {
                    if (!angka) return 'Rp 0';
                    return 'Rp ' + angka.toLocaleString('id-ID');
                }
            }
        }
    </script>
@endpush
