<div x-data="{ open: false, cancelSparingModal: false, cancelSparingId: null }" class="min-h-full bg-gray-200 shadow rounded-lg">
    <div class=" bg-white rounded-lg py-8 px-6 flex justify-between items-center">
        <div class="bg-cover rounded-xl overflow-hidden group w-20 h-20">
            <img class="w-full h-full object-cover"
                :src="$store.storage.getPhoto(sparing.field.photos[0]?.photo, '/assets/images/banner/banner.svg')"
                alt="">
        </div>
        <div class="flex items-center gap-6 ">
            <p class="font-bold text-xl" x-text="sparing.field.name">$req_sparing->sparing->listBooking->field->name</p>
            <div class="border-l border-gray-400 h-7 my-auto"></div>
            <p class="font-bold" x-text="sparing.field.name">
                $req_sparing->sparing->createdBy->team . ' VS ' . $req_sparing->user->team </p>
            <div class="border-l border-gray-400 h-7 my-auto"></div>
            <div>
                <p class="font-xs" x-text="sparing.date">$req_sparing->sparing->listBooking->formatted_date</p>
                <p class="font-semibold" x-text="sparing.session">
                    $req_sparing->sparing->listBooking->formatted_session </p>
            </div>
        </div>
        <template x-if="sparing.user.id == $store.user.data.id">
            <div x-text="sparing.status" :class="sparingStatusClass(sparing.status)">
                $req_sparing->formatted_status_request
            </div>
        </template>
        <div>
            <button @click="open = !open" class="size-12 p-2.5 border border-black rounded-lg">
                <img x-show="!open" src="{{ asset('assets/icons/icon-angle-right.svg') }}" alt="">
                <img x-show="open" src="{{ asset('assets/icons/icon-angle-down.svg') }}" alt="">
            </button>
        </div>
    </div>
    <div x-show="open" class="py-7 mx-6 p-4 ">

        <template x-for="sparing_req in sparing.sparing_request">
            <template
                x-if="sparing.user.id === $store.user.data.id && sparing_req.status != 'rejected' || sparing_req.user.id === $store.user.data.id ">
                <div class="mx-auto w-full">
                    <div class="flex items-center gap-10">
                        <div class="flex gap-10 mx-auto">
                            <div class="space-y-7">
                                <div class=" space-y-1">
                                    <h6 class="font-semibold text-sm">Tanggal Pemesanan</h6>
                                    <p x-text="sparing.date">
                                        $req_sparing->sparing->listBooking->booking->formatted_order_date
                                    </p>
                                </div>
                                <div class=" space-y-1">
                                    <h6 class="font-semibold text-sm">Alamat</h6>
                                    <p x-text="sparing.user.adress || '-'">$req_sparing->sparing->createdBy->address ??
                                        '-'
                                    </p>
                                </div>
                            </div>
                            <div class=" space-y-7">
                                <div class=" space-y-1">
                                    <h6 class="font-semibold text-sm">Pemesan</h6>
                                    <p x-text="sparing.user.name">$req_sparing->sparing->createdBy->name</p>
                                </div>
                                <div class=" space-y-1">
                                    <h6 class="font-semibold text-sm">No. Telepon</h6>
                                    <p x-text="sparing.user.no_telp">$req_sparing->sparing->createdBy->no_telp</p>
                                </div>
                            </div>
                            <div class=" space-y-7">
                                <div class=" space-y-1">
                                    <h6 class="font-semibold text-sm">Username</h6>
                                    <p x-text="sparing.user.username">$req_sparing->sparing->createdBy->username</p>
                                </div>
                                <div class=" space-y-1">
                                    <h6 class="font-semibold text-sm">Email</h6>
                                    <p x-text="sparing.user.email">$req_sparing->sparing->createdBy->email</p>
                                </div>
                            </div>
                        </div>
                        <div class="border-l border-gray-400 h-32 mx-4 my-auto"></div>
                        <div class="flex gap-10 mx-auto">
                            <div class=" space-y-7">
                                <div class=" space-y-1">
                                    <h6 class="font-semibold text-sm">Tanggal Pengajuan</h6>
                                    <p x-text="sparing_req.created_at">$req_sparing->created_at</p>
                                </div>
                                <div class=" space-y-1">
                                    <h6 class="font-semibold text-sm">Alamat</h6>
                                    <p x-text="sparing_req.user.address || '-'">$req_sparing->user->address ?? '-'</p>
                                </div>
                            </div>
                            <div class=" space-y-7">
                                <div class=" space-y-1">
                                    <h6 class="font-semibold text-sm">Penantang</h6>
                                    <p x-text="sparing_req.user.name"> $req_sparing->user->name </p>
                                </div>
                                <div class=" space-y-1">
                                    <h6 class="font-semibold text-sm">No. Telepon</h6>
                                    <p x-text="sparing_req.user.no_telp">$req_sparing->user->no_telp</p>
                                </div>
                            </div>
                            <div class=" space-y-7">
                                <div class=" space-y-1">
                                    <h6 class="font-semibold text-sm">Username</h6>
                                    <p x-text="sparing_req.user.username">$req_sparing->user->username</p>
                                </div>
                                <div class=" space-y-1">
                                    <h6 class="font-semibold text-sm">Email</h6>
                                    <p x-text="sparing_req.user.email">$req_sparing->user->email </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center mt-8 justify-self-center space-x-28">
                        <div class="bg-cover rounded-full overflow-hidden group size-16">
                            <img class="w-full h-full object-cover"
                                :src="sparing.user.profile_photo ? $store.storage.url + sparing.user.profile_photo :
                                    '/assets/images/profile.svg'"
                                alt="">
                        </div>
                        {{-- view for main user --}}
                        <template x-if="sparing.user.id == $store.user.data.id && sparing_req.status != 'rejected'">
                            <div>
                                <template x-if="sparing_req.status == 'waiting'">
                                    <div class="flex gap-2">
                                        <button @click="acceptSparing(sparing_req.id)"
                                            class="m-3 px-6 py-3 bg-yellow-200 text-red-700 font-bold rounded-lg">
                                            Konfirmasi
                                        </button>
                                        <button @click="cancelSparingModal = true; cancelSparingId = sparing_req.id"
                                            class="m-3 px-6 py-3 bg-red-700 text-white font-bold rounded-lg">
                                            Batalkan
                                        </button>
                                    </div>
                                </template>
                                <template x-if="sparing_req.status == 'accepted'">
                                    <p>VS</p>
                                </template>
                            </div>
                            {{-- <p x-text="sparing_req.status"></p> --}}
                        </template>

                        {{-- view for request user --}}
                        <template x-if="sparing_req.user.id == $store.user.data.id">
                            <div>
                                <template x-if="sparing_req.status === 'accepted'">
                                    <p>VS</p>
                                </template>
                                <template x-if="sparing_req.status !== 'accepted'">
                                    <p x-text="sparing_req.status" :class="sparingStatusClass(sparing_req.status)">
                                    </p>
                                </template>
                            </div>
                        </template>
                        <div class="bg-cover rounded-full overflow-hidden group size-16">
                            <img class="w-full h-full object-cover"
                                :src="sparing_req.user.profile_photo ? $store.storage.url + sparing_req.user.profile_photo :
                                    '/assets/images/profile.svg'"
                                alt="">

                        </div>
                    </div>
                    <hr class="border-gray-300 my-6">
                </div>
            </template>
        </template>

        <!-- Cancel Modal -->
        <div x-show="cancelSparingModal" x-cloak
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-20">
            <div class="bg-white p-6 rounded-lg justify-center flex flex-col text-center">
                <h2 class="text-xl font-bold mb-4 font-2xl">Yakin ingin menolak sparing?</h2>
                <p>Konfirmasi Penolakan Sparing</p>
                <div class="mt-4 flex justify-center">
                    <button @click="cancelSparingModal = false; cancelSparingId = null"
                        class="px-4 py-2 bg-gray-300 rounded-lg mr-2">Kembali</button>
                    <button @click="rejectSparing(cancelSparingId); cancelSparingModal = false; cancelSparingId = null"
                        class="px-4 py-2 bg-red-700 text-white rounded-lg">Ya,
                        Tolak</button>
                </div>
            </div>
        </div>

        <template x-if="sparing.sparing_request.length == 0">
            <div class="flex justify-center items-center">
                <div class="flex gap-10">
                    <div class="space-y-7">
                        <div class="space-y-1">
                            <h6 class="font-semibold text-sm">Tanggal Pemesanan</h6>
                            <p x-text="sparing.date"></p>
                        </div>
                        <div class="space-y-1">
                            <h6 class="font-semibold text-sm">Alamat</h6>
                            <p x-text="sparing.user.address || '-'"></p>
                        </div>
                    </div>
                    <div class="space-y-7">
                        <div class="space-y-1">
                            <h6 class="font-semibold text-sm">Pemesan</h6>
                            <p x-text="sparing.user.name"></p>
                        </div>
                        <div class="space-y-1">
                            <h6 class="font-semibold text-sm">No. Telepon</h6>
                            <p x-text="sparing.user.no_telp"></p>
                        </div>
                    </div>
                    <div class="space-y-7">
                        <div class="space-y-1">
                            <h6 class="font-semibold text-sm">Username</h6>
                            <p x-text="sparing.user.username"></p>
                        </div>
                        <div class="space-y-1">
                            <h6 class="font-semibold text-sm">Email</h6>
                            <p x-text="sparing.user.email"></p>
                        </div>
                    </div>

                    <div class="flex space-x-28 items-center justify-self-center">
                        <div class="bg-cover rounded-full overflow-hidden group size-16">
                            <img class="w-full h-full object-cover"
                                :src="sparing.user.profile_photo ? $store.storage.url + sparing.user.profile_photo :
                                    '/assets/images/profile.svg'"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
