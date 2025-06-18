<div x-data="{
    open: false,
    cancelBookingModal: false,
    scheduleModal: false,
    sparingModal: false
}" class="min-h-full bg-gray-200 shadow rounded-lg">
    <div class=" bg-white rounded-lg py-8 px-6 flex justify-between items-center">
        <div class="bg-cover rounded-xl overflow-hidden group w-20 h-20">
            <img class="w-full h-full object-cover" {{-- src="{{ asset('storage/field/images/' . $sesi->field->photos->first()->photo) }}" alt=""> --}}
                :src="schedule.field.photos.length && schedule.field.photos[0].photo ? $store.storage.url + schedule.field
                    .photos[0].photo :
                    '/assets/images/banner/banner.svg'"
                alt="">
        </div>
        <div class="flex items-center gap-6 ">
            <p class="font-bold text-xl" x-text="schedule.field.name">$sesi->field->name</p>
            <div class="border-l border-gray-400 h-8 my-auto"></div>
            <div>
                {{-- <p class="font-xs ">22 September 2024</p> --}}
                <p class="font-xs" x-text="$store.format.date(schedule.date)">$sesi->formatted_date</p>
                <p class="font-semibold" x-text="schedule.session">$sesi->formatted_session</p>
            </div>
            <div class="border-l border-gray-400 h-8 my-auto"></div>
            <p class="font-semibold" x-text="$store.format.rupiah(schedule.price)">$sesi->field->formatted_price
            </p>
        </div>
        <div :class="styleBookingStatus(schedule.status)" x-text="schedule.status">
            $sesi->formattedStatusRequest ?? $booking->formatted_status
        </div>
        <div>
            <button @click="open = !open" class="size-12 p-2.5 border border-black rounded-lg">
                <img x-show="!open" src="{{ asset('assets/icons/icon-angle-right.svg') }}" alt="">
                <img x-show="open" src="{{ asset('assets/icons/icon-angle-down.svg') }}" alt="">
            </button>
        </div>
    </div>
    <div x-show="open" class="py-7 mx-6 flex justify-between">
        <div class="grid grid-cols-3 gap-14">
            <div class=" space-y-7">
                <div class=" space-y-1">
                    <h6 class="font-semibold text-sm">Tanggal Pemesanan</h6>
                    <p x-text="$store.format.date(schedule.order_date)">$booking->formatted_order_date</p>
                </div>
                <div class=" space-y-1">
                    <h6 class="font-semibold text-sm">Alamat</h6>
                    <p x-text="schedule.user.address || '-'">$booking->rentedBy->address ?? '-'</p>
                </div>
                <div x-show="canRescheduleBooking(schedule.status)">
                    <a :href="`${window.location.origin}/reschedule/${schedule.id}`" @click="scheduleModal = true"
                        class="my-3 px-6 py-3 bg-red-700 text-white font-bold rounded-lg">Ubah Jadwal</a>
                    {{-- @if ($booking->status == 'accept' && $sesi->status_request == null)
                    @endif --}}
                </div>
            </div>
            <div class=" space-y-7">
                <div class=" space-y-1">
                    <h6 class="font-semibold text-sm">Pemesanan</h6>
                    <p x-text="schedule.user.name"> $booking->rentedBy->name </p>
                </div>
                <div class=" space-y-1">
                    <h6 class="font-semibold text-sm">No. Telepon</h6>
                    <p x-text="schedule.user.no_telp">$booking->rentedBy->no_telp</p>
                </div>
                <p x-effect="console.log('schedule status broo', canCancelBooking(schedule.status))"></p>
                <div x-show="canCancelBooking(schedule.status)">
                    <a @click="cancelBookingModal = true"
                        class="my-3 px-6 py-3 bg-red-700 text-white font-bold rounded-lg">Batalkan</a>
                    {{-- @if ($booking->status == 'accept' && $sesi->status_request == null)
                    @endif --}}
                </div>
            </div>
            <div class=" space-y-7">
                <div class=" space-y-1">
                    <h6 class="font-semibold text-sm">Username</h6>
                    <p x-text="schedule.user.username">$booking->rentedBy->username</p>
                </div>
                <div class=" space-t-1">
                    <h6 class="font-semibold text-sm">Email</h6>
                    <p x-text="schedule.user.email"> $booking->rentedBy->email </p>
                </div>
                <div x-show="canSparing(schedule.status, schedule.has_sparing)">
                    <button @click="sparingModal = true"
                        class="px-6 py-3 bg-red-700 text-white font-bold rounded-lg">Jadikan Sparing</button>
                    {{-- @if (!$sesi->sparing && $booking->status == 'accept' && $sesi->status_request == null)
                        <button @click="sparingModal = true"
                            class="my-3 px-6 py-3 bg-red-700 text-white font-bold rounded-lg">Jadikan Sparing</button>
                    @endif --}}
                </div>
            </div>
        </div>
        {{-- <div class="space-y-4">
            <h4 class=" font-bold font-sm">Bukti Transfer</h4>
            <button @click="proofTransfer = true" class="bg-cover rounded-xl overflow-hidden group w-79 h-45">
                <img class="w-full h-full object-cover"
                    src="{{ route('booking.paymentImage', basename($booking->uploud_payment)) }}" alt="">
            </button>
        </div> --}}
    </div>

    <!-- Close Modal Button -->
    {{-- <div x-show="proofTransfer" x-cloak class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
        @click="proofTransfer = false">
        <div @click.stop class="bg-white p-2 rounded-lg justify-center flex flex-col text-center">
            <div class="rounded-lg overflow-hidden group w-79">
                <img class="w-full h-full" src="{{ route('booking.paymentImage', basename($booking->uploud_payment)) }}"
                    alt="">
            </div>
        </div>
    </div> --}}

    <!-- Cancel Modal -->
    <div x-show="cancelBookingModal" x-cloak class="fixed inset-0 flex items-center justify-center bg-black/50 z-20">
        <div class="bg-white p-6 rounded-lg justify-center flex flex-col text-center">
            <h2 class="text-xl font-bold mb-4 font-2xl">Yakin ingin batalkan pesanan?</h2>
            {{-- <p>Konfirmasi Pembatalan Pemesanan Anda</p> --}}
            <div class="mt-4 w-full">
                <input type="text" name="reason" id="reason"
                    class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-4"
                    placeholder="Masukan alasan pembatalan" x-model="cancelReason" required />
                <button @click="cancelBookingModal = false"
                    class="px-4 py-2 w-1/2 bg-gray-300 rounded-lg mr-2">Kembali</button>
                <button @click="cancelBooking(schedule.id ); cancelBookingModal = false"
                    class="px-4 py-2 bg-red-700 text-white rounded-lg">
                    <div x-show="isLoading">
                        <img src="{{ asset('assets/icons/loading.gif') }}" width="20" alt="">
                    </div>Ya,Batalkan
                </button>
            </div>
        </div>
    </div>

    <!-- Sparing Modal -->
    <div x-show="sparingModal" x-cloak class="fixed inset-0 flex items-center justify-center bg-black/50">
        <form action="" method="POST" class="bg-white p-4 rounded-lg w-80"
            @submit.prevent="createSparing(schedule.id); sparingModal = false">
            <h2 class="text-xl text-center font-bold mb-4 font-2xl">Buat Sparing</h2>
            <div class="mb-6">
                <label for="nama_tim" class="block mb-2 text-sm font-medium text-gray-900">Nama
                    Tim</label>
                <input type="text" id="nama_tim" name="team_name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Wajib Memasukan Nama Tim" disabled :value="schedule.user.team" />
            </div>
            <div class="mb-6">
                <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi
                    Singkat</label>
                <input type="text" id="deskripsi" name="description"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukan deskripsi singkat" x-model="sparingDescription" />
            </div>
            <div class="flex justify-end">
                <button @click="sparingModal = false" type="button"
                    class="px-4 py-2 bg-gray-300 rounded-lg mr-2">Cancel</button>
                <input type="hidden" name="id_list_booking">
                <button type="submit" class="px-4 py-2 bg-red-700 text-white rounded-lg">
                    <div x-show="isLoading">
                        <img src="{{ asset('assets/icons/loading.gif') }}" width="20" alt="">
                    </div>Save
                </button>
            </div>
        </form>
    </div>

    <!-- Modal Error Besar -->
    <div x-show="error" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/30">
        <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-8 text-center relative">
            <button @click="error = null"
                class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-2xl">&times;</button>
            <svg class="mx-auto mb-4 w-16 h-16 text-red-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                </path>
            </svg>
            <h2 class="text-2xl font-bold mb-2 text-red-600">Terjadi Kesalahan</h2>
            <p class="mb-6 text-gray-700 text-lg" x-text="error"></p>
            <button @click="error = null"
                class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition">Tutup</button>
        </div>
    </div>
</div>
