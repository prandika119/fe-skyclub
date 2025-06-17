@extends('layouts.master')

@section('content')
    <div class="min-h-full mt-26 px-16 my-12" x-data="walletHandler()">
        {{-- <div class="min-h-full my-12"> --}}
        <div class=" grid grid-cols-2 gap-10">
            <div>
                <h2 class=" font-bold text-3xl mb-4">Detail Top Up</h2>
                <h4 class=" font-bold text-2xl mb-5" x-text="$store.user.data.name"></h4>
                <hr class="h-px my-4 bg-gray-400 border-0">
                <p>Nominal Top Up</p>
                <input type="number" name="nominal" min="0" x-model="nominal"
                    class="w-full border-2 border-gray-400 rounded-lg p-2 text-2xl font-bold text-gray-800 mb-4">
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <h5 class=" font-bold text-2xl">Metode Pembayaran</h5>
                        <svg x-show="dropDown == 'up'" @click="dropDown='down'" class="w-6 h-6 text-gray-800 justify-center"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m5 15 7-7 7 7" />
                        </svg>
                        <svg x-show="dropDown == 'down'" @click="dropDown='up'" class="w-6 h-6 text-gray-800 justify-center"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 9-7 7-7-7" />
                        </svg>
                    </div>

                    <div x-show="dropDown == 'down'" x-transition class="space-y-2">
                        <template x-for="(method, key) in methods" :key="key">
                            <div @click="selectedMethod = key; dropDown = 'up'"
                                class="cursor-pointer flex justify-between shadow bg-white rounded-lg items-center p-2.5 text-base hover:bg-gray-100 transition">
                                <img :src="method.image" alt="" class="w-10 h-10">
                                <p class="ml-2 font-medium" x-text="method.name"></p>
                                <span class="text-red-600 text-xs px-2 ml-auto">Pilih</span>
                            </div>
                        </template>
                    </div>
                </div>

            </div>
            <div class=" space-y-4">
                <div class="border border-gray-600 p-5 rounded-xl">
                    <div class="flex flex-col items-center justify-center space-y-2">
                        <img class="rounded-xl shadow h-[100px]" :src="methods[selectedMethod].image" alt="">
                        <p class="font-bold text-2xl" x-text="methods[selectedMethod].name"></p>

                    </div>
                    <hr class="h-px my-4 bg-gray-400 border-0">
                    <div class="space-y-4">
                        <div>
                            <h3 class=" text-2xl">Nomor Transfer</h3>
                            <div class="flex items-center justify-between">
                                <p class="font-bold text-2xl" x-text="methods[selectedMethod].number"></p>
                                <a href="#" class="flex items-center font-bold text-xl text-red-600">Salin
                                    <svg class="ml-1" width="15" height="19" viewBox="0 0 15 19" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 1H5C2.79086 1 1 2.79086 1 5V13" stroke="#222222" />
                                        <path
                                            d="M4.5 9.5C4.5 8.31558 4.50074 7.46912 4.57435 6.81625C4.64681 6.17346 4.78457 5.78051 5.01662 5.4781C5.14962 5.30477 5.30477 5.14962 5.4781 5.01662C5.78051 4.78457 6.17346 4.64681 6.81625 4.57435C7.46912 4.50074 8.31558 4.5 9.5 4.5C10.6844 4.5 11.5309 4.50074 12.1837 4.57435C12.8265 4.64681 13.2195 4.78457 13.5219 5.01662C13.6952 5.14962 13.8504 5.30477 13.9834 5.4781C14.2154 5.78051 14.3532 6.17346 14.4257 6.81625C14.4993 7.46912 14.5 8.31558 14.5 9.5V13.5C14.5 14.6844 14.4993 15.5309 14.4257 16.1837C14.3532 16.8265 14.2154 17.2195 13.9834 17.5219C13.8504 17.6952 13.6952 17.8504 13.5219 17.9834C13.2195 18.2154 12.8265 18.3532 12.1837 18.4257C11.5309 18.4993 10.6844 18.5 9.5 18.5C8.31558 18.5 7.46912 18.4993 6.81625 18.4257C6.17346 18.3532 5.78051 18.2154 5.4781 17.9834C5.30477 17.8504 5.14962 17.6952 5.01662 17.5219C4.78457 17.2195 4.64681 16.8265 4.57435 16.1837C4.50074 15.5309 4.5 14.6844 4.5 13.5V9.5Z"
                                            stroke="#222222" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div>
                            <h3 class=" text-2xl mb-1">Total Pembayaran</h3>
                            <div class="flex items-center justify-between">
                                <p class="font-bold text-2xl" x-text="$store.format.rupiah(nominal)"></p>
                                <a href="#" class="flex items-center font-bold text-xl text-red-600">Salin
                                    <svg class="ml-1" width="15" height="19" viewBox="0 0 15 19" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 1H5C2.79086 1 1 2.79086 1 5V13" stroke="#222222" />
                                        <path
                                            d="M4.5 9.5C4.5 8.31558 4.50074 7.46912 4.57435 6.81625C4.64681 6.17346 4.78457 5.78051 5.01662 5.4781C5.14962 5.30477 5.30477 5.14962 5.4781 5.01662C5.78051 4.78457 6.17346 4.64681 6.81625 4.57435C7.46912 4.50074 8.31558 4.5 9.5 4.5C10.6844 4.5 11.5309 4.50074 12.1837 4.57435C12.8265 4.64681 13.2195 4.78457 13.5219 5.01662C13.6952 5.14962 13.8504 5.30477 13.9834 5.4781C14.2154 5.78051 14.3532 6.17346 14.4257 6.81625C14.4993 7.46912 14.5 8.31558 14.5 9.5V13.5C14.5 14.6844 14.4993 15.5309 14.4257 16.1837C14.3532 16.8265 14.2154 17.2195 13.9834 17.5219C13.8504 17.6952 13.6952 17.8504 13.5219 17.9834C13.2195 18.2154 12.8265 18.3532 12.1837 18.4257C11.5309 18.4993 10.6844 18.5 9.5 18.5C8.31558 18.5 7.46912 18.4993 6.81625 18.4257C6.17346 18.3532 5.78051 18.2154 5.4781 17.9834C5.30477 17.8504 5.14962 17.6952 5.01662 17.5219C4.78457 17.2195 4.64681 16.8265 4.57435 16.1837C4.50074 15.5309 4.5 14.6844 4.5 13.5V9.5Z"
                                            stroke="#222222" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-4 bg-gray-400 border-0">
                    <div class="space-y-2">
                        <p class="text-xs">· <span class="font-bold">Penting</span>: Transfer Virtual Account hanya
                            bisa dilakukan dari bank yang kamu pilih</p>
                        <p class="text-xs">· Transaksi kamu baru akan diteruskan ke penjual setelah pembayaran
                            berhasil diverifikasi</p>
                    </div>
                </div>

                <form>
                    {{-- <input type="hidden" name="metode" :value="selectedMethod"> --}}
                    <button type="button" @click="topup()"
                        class="w-full py-3 border-2 bg-red-600 text-center text-2xl rounded-xl font-bold text-white flex items-center justify-center">
                        <div x-show="!isLoading">
                            <img src="{{ asset('assets/icons/icon_shield.svg') }}" alt="Voucher Icon" class="mr-2">
                        </div>

                        <div x-show="isLoading">
                            <img src="{{ asset('assets/icons/loading.gif') }}" width="20" alt="">
                        </div>
                        Bayar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function walletHandler() {
            return {
                selectedMethod: 'dana',
                dropDown: 'down',
                isLoading: false,
                nominal: 0,
                methods: {
                    dana: {
                        name: 'Dana',
                        image: '{{ asset('assets/images/eWallet/dana.png') }}',
                        number: '8823001301230'
                    },
                    gopay: {
                        name: 'Gopay',
                        image: '{{ asset('assets/images/eWallet/gopay.png') }}',
                        number: '8823001304567'
                    },
                    shopeepay: {
                        name: 'Shopee Pay',
                        image: '{{ asset('assets/images/eWallet/shopee.png') }}',
                        number: '8823001308910'
                    },
                    ovo: {
                        name: 'OVO',
                        image: '{{ asset('assets/images/eWallet/ovo.png') }}',
                        number: '8823001301122'
                    },
                    va: {
                        name: 'Transfer Virtual Account',
                        image: '{{ asset('assets/images/eWallet/va.png') }}',
                        number: '8823001303344'
                    },
                },
                async topup() {
                    if (this.nominal <= 0) {
                        alert('Nominal Top Up harus lebih dari 0');
                        return;
                    }
                    try {
                        this.isLoading = true;
                        const response = await axios.post('/wallet/topup', {
                            amount: this.nominal,
                            bank_ewallet: this.selectedMethod,
                            number: Alpine.store('user').data.no_telp
                        });
                        await Alpine.store('user').refreshLocalStorage()
                        window.location.href = "/wallet"
                    } catch (e) {
                        console.error(e.response)
                        alert('Gagal Topup, silahkan coba lagi')
                    } finally {
                        this.isLoading = false;
                    }

                }
            }
        }
    </script>
@endsection
