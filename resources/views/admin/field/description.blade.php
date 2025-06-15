@extends('layouts.admin')

@push('header')
    @vite(['resources/js/descriptionField.js'])
@endpush

@section('content')
    <div class="bg-white shadow rounded-lg border-gray-600 dark:border-gray-600 h-fit mb-4 p-6">
        <p class="font-semibold mb-2 text-2xl">Deskripsi Lapangan</p>
        <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">Masukkan deskripsi Lapangan</p>
        <div class="mb-4">
            <form action="{{ route('description.update') }}" method="post">
                @csrf
                <textarea id="description" maxlength="2999" name="description"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500 h-64 custom-scrollbar"
                    placeholder="Tulis deskripsi lapangan disini..." rows="4">{{ $fieldDescription }}</textarea>
                <div class="flex justify-between">
                    <div class="flex mt-2 items-center space-x-2">
                        <p id="charCount" class="text-sm text-gray-500 dark:text-gray-400">0 characters</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">|</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Max 2999 characters</p>
                    </div>
                    <button id="updateButton"
                        class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-gradient-to-r hover:from-red-500 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div x-data="facilitySelection({{ json_encode($selectedFacilities) }})" class="bg-white shadow rounded-lg border-gray-600 dark:border-gray-600 h-fit mb-4 p-6">
        <p class="font-semibold mb-2 text-2xl">Fasilitas Lapangan</p>
        <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">Pilih Fasilitas Lapangan</p>
        <div class="mb-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <label
                    class="rounded-lg flex items-center space-x-4 text-xl border border-gray-800 hover:bg-red-500 p-2 cursor-pointer font-semibold"
                    :class="{ 'bg-red-300': selected.includes('mushola') }">
                    <input type="checkbox" name="fasilitas[]" value="mushola" class="hidden"
                        @change="toggleSelection('mushola')">
                    <img class="w-10 h-10" src="{{ asset('assets/icons/icon_mosque.svg') }}" alt="">
                    <p class="ml-2">Mushola</p>
                </label>
                <label
                    class="rounded-lg flex items-center space-x-4 text-xl border border-gray-800 hover:bg-red-500 p-2 cursor-pointer font-semibold"
                    :class="{ 'bg-red-300': selected.includes('parking') }">
                    <input type="checkbox" name="fasilitas[]" value="parking" class="hidden"
                        @change="toggleSelection('parking')">
                    <img class="w-10 h-10" src="{{ asset('assets/icons/icon_parking.svg') }}" alt="">
                    <h1>Parkir Penonton</h1>
                </label>
                <label
                    class="rounded-lg flex items-center space-x-4 text-xl border border-gray-800 hover:bg-red-500 p-2 cursor-pointer font-semibold"
                    :class="{ 'bg-red-300': selected.includes('tribune') }">
                    <input type="checkbox" name="fasilitas[]" value="tribune" class="hidden"
                        @change="toggleSelection('tribune')">
                    <img class="w-10 h-10" src="{{ asset('assets/icons/icon_tribune.svg') }}" alt="">
                    <p>Tribun Penonton</p>
                </label>
                <label
                    class="rounded-lg flex items-center space-x-4 text-xl border border-gray-800 hover:bg-red-500 p-2 cursor-pointer font-semibold"
                    :class="{ 'bg-red-300': selected.includes('wifi') }">
                    <input type="checkbox" name="fasilitas[]" value="wifi" class="hidden"
                        @change="toggleSelection('wifi')">
                    <img class="w-10 h-10" src="{{ asset('assets/icons/icon_wifi.svg') }}" alt="">
                    <p>Wifi</p>
                </label>
                <label
                    class="rounded-lg flex items-center space-x-4 text-xl border border-gray-800 hover:bg-red-500 p-2 cursor-pointer font-semibold"
                    :class="{ 'bg-red-300': selected.includes('toilet') }">
                    <input type="checkbox" name="fasilitas[]" value="toilet" class="hidden"
                        @change="toggleSelection('toilet')">
                    <img class="w-10 h-10" src="{{ asset('assets/icons/icon_toilet.svg') }}" alt="">
                    <p>Toilet</p>
                </label>
                <label
                    class="rounded-lg flex items-center space-x-4 text-xl border border-gray-800 hover:bg-red-500 p-2 cursor-pointer font-semibold"
                    :class="{ 'bg-red-300': selected.includes('shower') }">
                    <input type="checkbox" name="fasilitas[]" value="shower" class="hidden"
                        @change="toggleSelection('shower')">
                    <img class="w-10 h-10" src="{{ asset('assets/icons/icon_shower.svg') }}" alt="">
                    <p>Shower</p>
                </label>
                <label
                    class="rounded-lg flex items-center space-x-4 text-xl border border-gray-800 hover:bg-red-500 p-2 cursor-pointer font-semibold"
                    :class="{ 'bg-red-300': selected.includes('canteen') }">
                    <input type="checkbox" name="fasilitas[]" value="canteen" class="hidden"
                        @change="toggleSelection('canteen')">
                    <img class="w-10 h-10" src="{{ asset('assets/icons/icon_eat.svg') }}" alt="">
                    <p>Kantin</p>
                </label>
                <label
                    class="rounded-lg flex items-center space-x-4 text-xl border border-gray-800 hover:bg-red-500 p-2 cursor-pointer font-semibold"
                    :class="{ 'bg-red-300': selected.includes('sauna') }">
                    <input type="checkbox" name="fasilitas[]" value="sauna" class="hidden"
                        @change="toggleSelection('sauna')">
                    <img class="w-10 h-10" src="{{ asset('assets/icons/icon_sauna.svg') }}" alt="">
                    <p>Sauna</p>
                </label>
                <label
                    class="rounded-lg flex items-center space-x-4 text-xl border border-gray-800 hover:bg-red-500 p-2 cursor-pointer font-semibold"
                    :class="{ 'bg-red-300': selected.includes('medical') }">
                    <input type="checkbox" name="fasilitas[]" value="medical" class="hidden"
                        @change="toggleSelection('medical')">
                    <img class="w-10 h-10" src="{{ asset('assets/icons/icon_med.svg') }}" alt="">
                    <p>Medis</p>
                </label>
                <label
                    class="rounded-lg flex items-center space-x-4 text-xl border border-gray-800 hover:bg-red-500 p-2 cursor-pointer font-semibold"
                    :class="{ 'bg-red-300': selected.includes('locker') }">
                    <input type="checkbox" name="fasilitas[]" value="locker" class="hidden"
                        @change="toggleSelection('locker')">
                    <img class="w-10 h-10" src="{{ asset('assets/icons/icon_locker.svg') }}" alt="">
                    <p>Locker</p>
                </label>
                <label
                    class="rounded-lg flex items-center space-x-4 text-xl border border-gray-800 hover:bg-red-500 p-2 cursor-pointer font-semibold"
                    :class="{ 'bg-red-300': selected.includes('gym') }">
                    <input type="checkbox" name="fasilitas[]" value="gym" class="hidden"
                        @change="toggleSelection('gym')">
                    <img class="w-10 h-10" src="{{ asset('assets/icons/icon_weight.svg') }}" alt="">
                    <p>GYM</p>
                </label>
                <label
                    class="rounded-lg flex items-center space-x-4 text-xl border border-gray-800 hover:bg-red-500 p-2 cursor-pointer font-semibold"
                    :class="{ 'bg-red-300': selected.includes('run') }">
                    <input type="checkbox" name="fasilitas[]" value="run" class="hidden"
                        @change="toggleSelection('run')">
                    <img class="w-10 h-10" src="{{ asset('assets/icons/icon_run.svg') }}" alt="">
                    <p>Lintasan Lari</p>
                </label>
                <label
                    class="rounded-lg flex items-center space-x-4 text-xl border border-gray-800 hover:bg-red-500 p-2 cursor-pointer font-semibold"
                    :class="{ 'bg-red-300': selected.includes('security') }">
                    <input type="checkbox" name="fasilitas[]" value="security" class="hidden"
                        @change="toggleSelection('security')">
                    <img class="w-10 h-10" src="{{ asset('assets/icons/icon_security.svg') }}" alt="">
                    <p>Security</p>
                </label>
            </div>
        </div>
    </div>
    {{-- <div class="bg-white shadow rounded-lg border-gray-600 dark:border-gray-600 h-fit mb-4 p-6">
    <p class="font-semibold mb-2 text-2xl">Fasilitas Lapangan</p>
    <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">Pilih Fasilitas Lapangan</p>
    <div class="mb-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <label class="rounded-lg flex items-center space-x-8 text-2xl border border-gray-800 hover:border-red-500 p-4 cursor-pointer">
                <input type="checkbox" name="fasilitas[]" value="Mushola" class="hidden">
                <img src="{{ asset('assets/icons/icon_mosque.svg') }}" alt="">
                <p class="ml-2">Mushola</p>
            </label>
            <label class="rounded-lg flex items-center space-x-8 text-2xl border border-gray-800 hover:border-red-500 p-4 cursor-pointer">
                <input type="checkbox" name="fasilitas[]" value="Parkir Penonton" class="hidden">
                <img src="{{ asset('assets/icons/icon_parking.svg') }}" alt="">
                <h1>Parkir Penonton</h1>
            </label>
            <label class="rounded-lg flex items-center space-x-8 text-2xl border border-gray-800 hover:border-red-500 p-4 cursor-pointer">
                <input type="checkbox" name="fasilitas[]" value="Tribun Area" class="hidden">
                <img src="{{ asset('assets/icons/icon_bed.svg') }}" alt="">
                <p>Tribun Area</p>
            </label>
            <label class="rounded-lg flex items-center space-x-8 text-2xl border border-gray-800 hover:border-red-500 p-4 cursor-pointer">
                <input type="checkbox" name="fasilitas[]" value="Wifi" class="hidden">
                <img src="{{ asset('assets/icons/icon_wifi.svg') }}" alt="">
                <p>Wifi</p>
            </label>

        </div>
    </div>
    <div class="mt-4">
        <p class="font-semibold mb-2 text-2xl">Fasilitas yang Dipilih:</p>
        <ul id="selectedFacilities" class="list-disc pl-5 text-gray-700 dark:text-gray-300"></ul>
    </div>
</div> --}}
@endsection
@push('script')
    <script>
        function facilitySelection(initialSelected) {
            return {
                selected: initialSelected || [],
                toggleSelection(facility) {
                    if (this.selected.includes(facility)) {
                        this.selected = this.selected.filter(item => item !== facility);
                    } else {
                        this.selected.push(facility);
                    }
                    this.updateFacilitiesOnServer();
                },
                updateFacilitiesOnServer() {
                    axios.post('{{ route('facilities.update') }}', {
                            facilities: this.selected
                        })
                        .then(response => {
                            console.log('Facilities updated successfully');
                            locaton.reload();
                        })
                        .catch(error => {
                            console.error('Error updating facilities:', error);
                        });
                }
            }
        }
    </script>
@endpush
