@extends('layouts.master')
@section('content')
    <div class="rounded-xl shadow-lg p-5 justify-self-center my-10 mt-24" x-data="walletHandler()" x-init="fetchTransactions()">
        <h1 class="font-semibold text-4xl mb-7">My Wallet</h1>
        <div class="flex space-x-20">
            <div>
                <div class="flex flex-col p-12 pt-6 bg-cover bg-no-repeat bg-center h-[321px] w-[616px] rounded-2xl mb-7"
                    style="background-image: url('{{ asset('assets/images/wallet.png') }}');">
                    <div class="flex justify-between">

                        <p class="font-bold text-xl text-white" x-text="user.name"></p>
                        <p class="font-bold text-xl text-white" x-text="sensorPhone(user.no_telp)"></p>
                    </div>
                    <div class="flex justify-between mt-auto">
                        <div class="space-y-2">
                            <p class="text-xl font-semibold text-white">Balance</p>
                            <p class="text-4xl font-bold text-white" x-text="$store.format.rupiah(user.wallet)"></p>
                        </div>
                        <svg class="place-self-end" width="18" height="18" viewBox="0 0 18 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0 14C1.06087 14 2.07828 14.4214 2.82843 15.1716C3.57857 15.9217 4 16.9391 4 18H0V14ZM0 7C6.075 7 11 11.925 11 18H9C9 15.6131 8.05179 13.3239 6.36396 11.636C4.67613 9.94821 2.38695 9 0 9V7ZM0 0C9.941 0 18 8.059 18 18H16C16 9.163 8.837 2 0 2V0Z"
                                fill="white" />
                        </svg>
                    </div>
                </div>

                <div class="flex justify-center space-x-10 pb-5">
                    <a href="{{ route('wallet.topup') }}"
                        class="shadow-lg flex flex-col items-center justify-center drop-shadow rounded-xl w-[120px] h-[120px]">
                        <svg width="40" height="38" viewBox="0 0 40 38" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.50033 37.833C4.17116 37.833 3.03371 37.3601 2.08799 36.4144C1.14227 35.4687 0.668603 34.3304 0.666992 32.9996V28.1663C0.666992 27.4816 0.898992 26.908 1.36299 26.4456C1.82699 25.9833 2.40055 25.7513 3.08366 25.7496C3.76677 25.748 4.34113 25.98 4.80674 26.4456C5.27235 26.9113 5.50355 27.4848 5.50033 28.1663V32.9996H34.5003V28.1663C34.5003 27.4816 34.7323 26.908 35.1963 26.4456C35.6603 25.9833 36.2339 25.7513 36.917 25.7496C37.6001 25.748 38.1745 25.98 38.6401 26.4456C39.1057 26.9113 39.3369 27.4848 39.3337 28.1663V32.9996C39.3337 34.3288 38.8608 35.4671 37.9151 36.4144C36.9694 37.3617 35.8311 37.8346 34.5003 37.833H5.50033ZM17.5837 8.47048L13.0524 13.0017C12.5691 13.4851 11.9955 13.7171 11.3317 13.6977C10.668 13.6784 10.0936 13.4263 9.60866 12.9413C9.1656 12.458 8.93361 11.8941 8.91266 11.2496C8.89172 10.6052 9.12372 10.0413 9.60866 9.55798L18.3087 0.857979C18.5503 0.616312 18.8121 0.445535 19.0941 0.345646C19.376 0.245757 19.6781 0.195008 20.0003 0.193397C20.3225 0.191785 20.6246 0.242535 20.9066 0.345646C21.1885 0.448757 21.4503 0.619535 21.692 0.857979L30.392 9.55798C30.8753 10.0413 31.1073 10.6052 31.088 11.2496C31.0687 11.8941 30.8367 12.458 30.392 12.9413C29.9087 13.4246 29.3351 13.6768 28.6713 13.6977C28.0076 13.7187 27.4332 13.4867 26.9482 13.0017L22.417 8.47048V25.7496C22.417 26.4344 22.185 27.0087 21.721 27.4727C21.257 27.9367 20.6834 28.1679 20.0003 28.1663C19.3172 28.1647 18.7437 27.9327 18.2797 27.4703C17.8157 27.0079 17.5837 26.4344 17.5837 25.7496V8.47048Z"
                                fill="black" />
                        </svg>
                        <p class="font-semibold text-lg mt-2">Top Up</p>
                    </a>
                    <a href="/wallet/withdraw"
                        class="shadow-lg flex flex-col items-center justify-center drop-shadow rounded-xl w-[120px] h-[120px]">
                        <svg width="40" height="39" viewBox="0 0 40 39" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20.0003 28.1399C19.6781 28.1399 19.376 28.09 19.0941 27.9901C18.8121 27.8902 18.5503 27.7186 18.3087 27.4753L9.60866 18.7753C9.12533 18.292 8.89333 17.7281 8.91266 17.0837C8.93199 16.4392 9.16399 15.8753 9.60866 15.392C10.092 14.9087 10.6664 14.6573 11.3317 14.638C11.9971 14.6187 12.5707 14.8499 13.0524 15.3316L17.5837 19.8628V2.58367C17.5837 1.89895 17.8157 1.32539 18.2797 0.863001C18.7437 0.400612 19.3172 0.168612 20.0003 0.167001C20.6834 0.165389 21.2578 0.39739 21.7234 0.863001C22.189 1.32861 22.4202 1.90217 22.417 2.58367V19.8628L26.9482 15.3316C27.4316 14.8483 28.0059 14.6163 28.6713 14.6356C29.3367 14.6549 29.9103 14.9071 30.392 15.392C30.835 15.8753 31.067 16.4392 31.088 17.0837C31.1089 17.7281 30.8769 18.292 30.392 18.7753L21.692 27.4753C21.4503 27.717 21.1885 27.8886 20.9066 27.9901C20.6246 28.0916 20.3225 28.1415 20.0003 28.1399ZM5.50033 38.8337C4.17116 38.8337 3.03371 38.3608 2.08799 37.4151C1.14227 36.4694 0.668603 35.3311 0.666992 34.0003V29.167C0.666992 28.4823 0.898992 27.9087 1.36299 27.4463C1.82699 26.9839 2.40055 26.7519 3.08366 26.7503C3.76677 26.7487 4.34113 26.9807 4.80674 27.4463C5.27235 27.9119 5.50355 28.4855 5.50033 29.167V34.0003H34.5003V29.167C34.5003 28.4823 34.7323 27.9087 35.1963 27.4463C35.6603 26.9839 36.2339 26.7519 36.917 26.7503C37.6001 26.7487 38.1745 26.9807 38.6401 27.4463C39.1057 27.9119 39.3369 28.4855 39.3337 29.167V34.0003C39.3337 35.3295 38.8608 36.4678 37.9151 37.4151C36.9694 38.3624 35.8311 38.8353 34.5003 38.8337H5.50033Z"
                                fill="black" />
                        </svg>
                        <p class="font-semibold text-lg mt-2">Withdraw</p>
                    </a>
                </div>
            </div>
            <div class=" w-96">
                {{-- <div class="flex justify-between font-semibold text-lg items-center mb-4">
                    Recent Transaction
                    <a href="#" class="text-xs text-gray-700">Lihat semua</a>
                </div> --}}
                <div class="flex flex-col space-y-3">
                    <div class="w-96">
                        <div class="flex justify-between font-semibold text-lg items-center mb-4">
                            Recent Transaction
                            <a href="#" class="text-xs text-gray-700" @click.prevent="showAll = true">Lihat semua</a>
                        </div>
                        <div class="flex flex-col space-y-3">
                            <template x-for="transaction in transactions.slice(0, 6)" :key="transaction.id">
                                <div
                                    :class="transaction.transaction_type === 'topup' ?
                                        'rounded-lg flex flex-row border-s-8 border-red-600 items-center shadow-md px-3 py-2' :
                                        transaction.transaction_type === 'withdraw' ?
                                        'rounded-lg flex flex-row border-s-8 border-green-400 items-center shadow-md px-3 py-2' :
                                        'rounded-lg flex flex-row border-s-8 border-blue-500 items-center shadow-md px-3 py-2'">
                                    <template x-if="transaction.transaction_type === 'topup'">
                                        {{-- <svg width="30" height="29" ...></svg> --}}
                                        <svg width="30" height="29" viewBox="0 0 40 38" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5.50033 37.833C4.17116 37.833 3.03371 37.3601 2.08799 36.4144C1.14227 35.4687 0.668603 34.3304 0.666992 32.9996V28.1663C0.666992 27.4816 0.898992 26.908 1.36299 26.4456C1.82699 25.9833 2.40055 25.7513 3.08366 25.7496C3.76677 25.748 4.34113 25.98 4.80674 26.4456C5.27235 26.9113 5.50355 27.4848 5.50033 28.1663V32.9996H34.5003V28.1663C34.5003 27.4816 34.7323 26.908 35.1963 26.4456C35.6603 25.9833 36.2339 25.7513 36.917 25.7496C37.6001 25.748 38.1745 25.98 38.6401 26.4456C39.1057 26.9113 39.3369 27.4848 39.3337 28.1663V32.9996C39.3337 34.3288 38.8608 35.4671 37.9151 36.4144C36.9694 37.3617 35.8311 37.8346 34.5003 37.833H5.50033ZM17.5837 8.47048L13.0524 13.0017C12.5691 13.4851 11.9955 13.7171 11.3317 13.6977C10.668 13.6784 10.0936 13.4263 9.60866 12.9413C9.1656 12.458 8.93361 11.8941 8.91266 11.2496C8.89172 10.6052 9.12372 10.0413 9.60866 9.55798L18.3087 0.857979C18.5503 0.616312 18.8121 0.445535 19.0941 0.345646C19.376 0.245757 19.6781 0.195008 20.0003 0.193397C20.3225 0.191785 20.6246 0.242535 20.9066 0.345646C21.1885 0.448757 21.4503 0.619535 21.692 0.857979L30.392 9.55798C30.8753 10.0413 31.1073 10.6052 31.088 11.2496C31.0687 11.8941 30.8367 12.458 30.392 12.9413C29.9087 13.4246 29.3351 13.6768 28.6713 13.6977C28.0076 13.7187 27.4332 13.4867 26.9482 13.0017L22.417 8.47048V25.7496C22.417 26.4344 22.185 27.0087 21.721 27.4727C21.257 27.9367 20.6834 28.1679 20.0003 28.1663C19.3172 28.1647 18.7437 27.9327 18.2797 27.4703C17.8157 27.0079 17.5837 26.4344 17.5837 25.7496V8.47048Z"
                                                fill="black" />
                                        </svg>
                                    </template>
                                    <template x-if="transaction.transaction_type === 'withdraw'">
                                        <svg width="34" height="27" ...></svg>
                                        <svg width="34" height="27" viewBox="0 0 40 39" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20.0003 28.1399C19.6781 28.1399 19.376 28.09 19.0941 27.9901C18.8121 27.8902 18.5503 27.7186 18.3087 27.4753L9.60866 18.7753C9.12533 18.292 8.89333 17.7281 8.91266 17.0837C8.93199 16.4392 9.16399 15.8753 9.60866 15.392C10.092 14.9087 10.6664 14.6573 11.3317 14.638C11.9971 14.6187 12.5707 14.8499 13.0524 15.3316L17.5837 19.8628V2.58367C17.5837 1.89895 17.8157 1.32539 18.2797 0.863001C18.7437 0.400612 19.3172 0.168612 20.0003 0.167001C20.6834 0.165389 21.2578 0.39739 21.7234 0.863001C22.189 1.32861 22.4202 1.90217 22.417 2.58367V19.8628L26.9482 15.3316C27.4316 14.8483 28.0059 14.6163 28.6713 14.6356C29.3367 14.6549 29.9103 14.9071 30.392 15.392C30.835 15.8753 31.067 16.4392 31.088 17.0837C31.1089 17.7281 30.8769 18.292 30.392 18.7753L21.692 27.4753C21.4503 27.717 21.1885 27.8886 20.9066 27.9901C20.6246 28.0916 20.3225 28.1415 20.0003 28.1399ZM5.50033 38.8337C4.17116 38.8337 3.03371 38.3608 2.08799 37.4151C1.14227 36.4694 0.668603 35.3311 0.666992 34.0003V29.167C0.666992 28.4823 0.898992 27.9087 1.36299 27.4463C1.82699 26.9839 2.40055 26.7519 3.08366 26.7503C3.76677 26.7487 4.34113 26.9807 4.80674 27.4463C5.27235 27.9119 5.50355 28.4855 5.50033 29.167V34.0003H34.5003V29.167C34.5003 28.4823 34.7323 27.9087 35.1963 27.4463C35.6603 26.9839 36.2339 26.7519 36.917 26.7503C37.6001 26.7487 38.1745 26.9807 38.6401 27.4463C39.1057 27.9119 39.3369 28.4855 39.3337 29.167V34.0003C39.3337 35.3295 38.8608 36.4678 37.9151 37.4151C36.9694 38.3624 35.8311 38.8353 34.5003 38.8337H5.50033Z"
                                                fill="black" />
                                        </svg>
                                    </template>
                                    <template x-if="transaction.transaction_type === 'booking'">
                                        <svg width="34" height="27" viewBox="0 0 34 27" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1 1.5H11.8117C12.4423 1.49992 13.0667 1.62409 13.6493 1.86539C14.2319 2.1067 14.7612 2.46042 15.207 2.90635L20.2009 7.89977M5.80022 15.8995H1M11.4005 6.29983L14.6006 9.49972C14.8107 9.70982 14.9774 9.95926 15.0911 10.2338C15.2049 10.5083 15.2634 10.8025 15.2634 11.0997C15.2634 11.3968 15.2049 11.691 15.0911 11.9655C14.9774 12.2401 14.8107 12.4895 14.6006 12.6996C14.3905 12.9097 14.141 13.0764 13.8665 13.1901C13.592 13.3038 13.2977 13.3623 13.0005 13.3623C12.7034 13.3623 12.4091 13.3038 12.1346 13.1901C11.8601 13.0764 11.6106 12.9097 11.4005 12.6996L9.00036 10.2997C7.6243 11.6756 5.4434 11.8308 3.88493 10.6629L3.40011 10.2997"
                                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M5.79883 11.9002V19.1C5.79883 22.1175 5.79883 23.6246 6.73647 24.5622C7.67411 25.4998 9.18138 25.4998 12.1991 25.4998H26.5998C29.6175 25.4998 31.1248 25.4998 32.0624 24.5622C33.0001 23.6246 33.0001 22.1175 33.0001 19.1V14.3002C33.0001 11.2827 33.0001 9.77552 32.0624 8.83796C31.1248 7.90039 29.6175 7.90039 26.5998 7.90039H12.9992"
                                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M22.2018 16.7003C22.2018 17.4429 21.9068 18.155 21.3817 18.6801C20.8566 19.2052 20.1443 19.5002 19.4017 19.5002C18.659 19.5002 17.9468 19.2052 17.4217 18.6801C16.8966 18.155 16.6016 17.4429 16.6016 16.7003C16.6016 15.9577 16.8966 15.2455 17.4217 14.7205C17.9468 14.1954 18.659 13.9004 19.4017 13.9004C20.1443 13.9004 20.8566 14.1954 21.3817 14.7205C21.9068 15.2455 22.2018 15.9577 22.2018 16.7003Z"
                                                stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </template>
                                    <div class="flex flex-col items-center ml-3">
                                        <div class="font-bold text-base" x-text="typeFormat(transaction.transaction_type) ">
                                        </div>
                                        <div class="text-sm font-semibold text-gray-500"
                                            x-text="dateFormat(transaction.created_at)">
                                        </div>
                                    </div>
                                    <div class="font-semibold text-lg ml-auto"
                                        x-text="amountFormat(transaction.amount, transaction.transaction_type)">
                                    </div>
                                </div>
                            </template>
                            <template x-if="transactions.length === 0">
                                <p class="text-gray-500 text-center">Tidak ada transaksi</p>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Modal Semua Transaksi -->
                <div x-show="showAll" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/60">
                    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full p-6 relative">
                        <button @click="showAll = false"
                            class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-2xl">&times;</button>
                        <h2 class="text-xl font-bold mb-4">Semua Transaksi</h2>
                        <div class="flex flex-col space-y-3 max-h-[60vh] overflow-y-auto">
                            <template x-for="transaction in transactions" :key="transaction.id">
                                <div
                                    :class="transaction.transaction_type === 'topup' ?
                                        'rounded-lg flex flex-row border-s-8 border-red-600 items-center shadow-md px-3 py-2' :
                                        transaction.transaction_type === 'withdraw' ?
                                        'rounded-lg flex flex-row border-s-8 border-green-400 items-center shadow-md px-3 py-2' :
                                        'rounded-lg flex flex-row border-s-8 border-blue-500 items-center shadow-md px-3 py-2'">
                                    <!-- ...isi transaksi sama seperti di list utama... -->
                                    <div class="flex flex-col items-center ml-3">
                                        <div class="font-bold text-base"
                                            x-text="typeFormat(transaction.transaction_type)"></div>
                                        <div class="text-sm font-semibold text-gray-500"
                                            x-text="dateFormat(transaction.created_at)"></div>
                                    </div>
                                    <div class="font-semibold text-lg ml-auto"
                                        x-text="amountFormat(transaction.amount, transaction.transaction_type)"></div>
                                </div>
                            </template>
                            <template x-if="transactions.length === 0">
                                <p class="text-gray-500 text-center">Tidak ada transaksi</p>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function walletHandler() {
            return {
                transactions: [],
                user: {},
                showAll: false,
                async fetchTransactions() {
                    try {
                        const response = await axios.get('/wallet');
                        this.transactions = response.data.data;
                        this.user = Alpine.store('user').data;
                        console.log(this.transactions);
                    } catch (error) {
                        console.error('Error fetching transactions:', error);
                    }
                },
                async user() {
                    Alpine.store('user').refreshLocalStorage();
                },
                sensorPhone(number) {
                    if (!number || typeof number !== 'string') return '';
                    return number.slice(0, -4) + '****';
                },
                dateFormat(dateStr) {
                    if (!dateStr) return '';
                    const date = new Date(dateStr);
                    // Format: 24 Mei 2025, 13:42
                    return date.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    }) + ', ' + date.toLocaleTimeString('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false,
                        timeZone: 'Asia/Jakarta'
                    });
                },
                typeFormat(type) {
                    switch (type) {
                        case 'topup':
                            return 'Top Up';
                        case 'withdraw':
                            return 'Withdraw';
                        case 'booking':
                            return 'Payment';
                        case 'refund':
                            return 'Refund';
                        default:
                            return type.charAt(0).toUpperCase() + type.slice(1);
                    }
                },
                amountFormat(amount, type) {
                    if (type == 'topup' || type == 'refund') {
                        return Alpine.store('format').rupiah(amount);
                    } else {
                        return '-' + Alpine.store('format').rupiah(amount);
                    }
                }
            }
        }
    </script>
@endsection

@push('script')
@endpush
