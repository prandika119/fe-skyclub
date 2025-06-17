@extends('layouts.adminFullPage')

@section('content')
    <div class="relative overflow-x-auto px-5 pt-2">
        <table x-data="bookingHandler()" x-init="fetchBookings()" class="min-w-full leading-normal mb-5">
            <thead>
                <tr class="shadow-lg rounded-xl ring-1 ring-gray-200">
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-s-xl">
                        Daftar Pesanan
                    </th>
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nama Pemesan
                    </th>
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Tanggal Pesanan
                    </th>
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Harga
                    </th>
                    <th scope="col"
                        class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>
                    {{-- <th scope="col" class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-e-xl">
                    Bukti Pembayaran
                </th> --}}
                </tr>
            </thead>
            <tbody>
                <template x-if="bookings.length > 0">
                    <template x-for="booking in bookings" :key="booking.id">
                        <tr class="rounded-xl hover:bg-gray-50 divide-y divide-gray-200">
                            <td class="py-4 px-5 text-left text-sm align-middle">
                                <ol>
                                    <template x-for="schedule in booking.list_bookings" :key="schedule.id">
                                        <li x-text="`${$store.format.date(schedule.date)} | ${schedule.session}`"></li>
                                    </template>
                                </ol>
                            </td>
                            <td x-text="booking.user.name" class="py-4 px-5 text-left text-sm align-middle"></td>
                            <td x-text="$store.format.date(booking.order_date)"
                                class="py-4 px-5 text-left text-sm align-middle">
                            </td>
                            <td x-text="$store.format.rupiah(booking.price_after_discount)"
                                class="py-4 px-5 text-left text-sm align-middle"></td>
                            <td x-text="booking.status" class="py-4 px-5 text-left text-sm align-middle"
                                :class="statusClass(booking.status)"></td>
                            </td>
                        </tr>
                    </template>
                </template>
                <template x-if="bookings.length === 0 && !isLoading">
                    <tr>
                        <td colspan="5" class="py-7 text-center text-sm text-gray-500">No bookings found</td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <script>
        function bookingHandler() {
            return {
                bookings: [],
                isLoading: false,
                async fetchBookings() {
                    this.isLoading = true;
                    try {
                        const response = await axios.get('/bookings');
                        this.bookings = response.data.data || [];
                        console.log(this.bookings);
                    } catch (error) {
                        console.error('Error fetching bookings:', error);
                        this.bookings = [];
                    } finally {
                        this.isLoading = false;
                    }
                },
                statusClass(status) {
                    switch (status) {
                        case 'accepted':
                            return 'text-green-600 text-sm font-medium me-2 px-2.5 py-0.5 rounded ';
                        case 'done':
                            return 'text-green-600 text-sm font-medium me-2 px-2.5 py-0.5 rounded ';
                        case 'waiting':
                            return 'text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded ';
                        case 'rejected':
                            return ' text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded ';
                        default:
                            return 'text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded ';
                    }
                },
            }
        }
    </script>
@endsection
