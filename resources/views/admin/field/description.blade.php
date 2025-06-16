@extends('layouts.admin')

@push('header')
    @vite(['resources/js/descriptionField.js'])
@endpush

@section('content')
    <div x-data="fieldDescHandler()">
        <div class="bg-white shadow rounded-lg border-gray-600 dark:border-gray-600 h-fit mb-4 p-6">
            <p class="font-semibold mb-2 text-2xl">Update Data Lapangan</p>
            <p class="mb-5 font-light text-gray-500 sm:text-xl">Silahkah atur data lapangan anda</p>
            <div class="mb-4">
                <form action="" method="post">
                    <!-- input field name -->
                    <div class="mt-4">
                        <label for="field_name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama Lapangan</label>
                        <input type="text" id="field_name" name="field_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
                            placeholder="Masukkan nama lapangan" x-model="field.name">
                    </div>


                    <!-- input description -->
                    <div class="mt-4">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">Deskripsi</label>
                        <textarea id="description" maxlength="2999" name="description"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500 h-64 custom-scrollbar"
                            placeholder="Tulis deskripsi lapangan disini..." rows="4" x-model="field.description">$fieldDescription</textarea>
                        <div class="flex mt-2 items-center space-x-2">
                            <p id="charCount" class="text-sm text-gray-500">0 characters</p>
                            <p class="text-sm text-gray-500">|</p>
                            <p class="text-sm text-gray-500">Max 2999 characters</p>
                        </div>
                    </div>

                    <!-- input price in weekday -->
                    <div class="mt-4">
                        <label for="price_weekday" class="block mb-2 text-sm font-medium text-gray-900 ">Harga
                            (Weekday)</label>
                        <input type="number" id="price_weekday" name="price_weekday"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
                            placeholder="Masukkan harga untuk weekday" x-model="field.weekday_price">
                    </div>

                    <!-- input price in weekend -->
                    <div class="mt-4">
                        <label for="price_weekend" class="block mb-2 text-sm font-medium text-gray-900 ">Harga
                            (Weekend)</label>
                        <input type="number" id="price_weekend" name="weekend_price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
                            placeholder="Masukkan harga untuk weekend" x-model="field.weekend_price">
                    </div>

                    <div class="flex justify-end">
                        <button id="updateButton" @click.prevent="updateField()"
                            class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-gradient-to-r hover:from-red-500 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg border-gray-600 dark:border-gray-600 h-fit mb-4 p-6">
            <p class="font-semibold mb-2 text-2xl">Fasilitas Lapangan</p>
            <p class="mb-5 font-light text-gray-500 sm:text-xl">Pilih Fasilitas Lapangan</p>
            <div class="mb-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <template x-for="facility in facilities" :key="facility.id">
                        <label
                            class="rounded-lg flex items-center space-x-4 text-xl border border-gray-800 hover:bg-red-500 p-2 cursor-pointer font-semibold"
                            :class="{ 'bg-red-300': selected.includes(facility.id) }">
                            <input type="checkbox" :name="facility.name" :value="facility.id" class="hidden"
                                @change="toggleSelection(facility.id)">
                            <img class="w-10 h-10" :src="`/assets/icons/icon_${facility.name}.svg`" alt="">
                            <p x-text="facility.name"></p>
                        </label>
                    </template>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function fieldDescHandler() {
            return {
                loading: false,
                fieldId: null,
                field: {},
                facilities: [],
                selected: [],
                async init() {
                    await this.fetchField();
                    await this.fetchAllFacilities();
                },
                async fetchField() {
                    try {
                        const resField = await axios.get('/fields'); // Mengambil ID field pertama
                        console.log("resField: " + resField);
                        this.fieldId = resField.data.data[0].id; // Mengambil ID field pertama
                        console.log("fieldId: " + this.fieldId);
                        const response = await axios.get(`/fields/${this.fieldId}`);
                        this.field = response.data.data; // Menyimpan data field dari response
                        this.selected = this.field.facilities.map(facility => facility
                            .id); // Menyimpan ID fasilitas yang sudah dipilih
                        console.log("description: " + this.description);
                        console.log("facilities: " + this.facilities);
                        console.log("selected: " + this.selected);
                    } catch (error) {
                        console.error('Error fetching field data:', error);
                    }
                },
                async fetchAllFacilities() {
                    try {
                        const response = await axios.get('/field-facilities');
                        this.facilities = response.data.data; // Menyimpan data fasilitas dari response
                        console.log("facilities: " + this.facilities);
                    } catch (error) {
                        console.error('Error fetching facilities:', error);
                    }
                },
                async updateField() {
                    try {
                        this.loading = true;
                        const response = await axios.put(`/fields/${this.fieldId}`, {
                            name: this.field.name,
                            description: this.field.description,
                            weekday_price: this.field.weekday_price,
                            weekend_price: this.field.weekend_price,
                        });
                        console.log('Description updated successfully:', response.data);
                        // Optionally, you can show a success message or reload the page
                        location.reload();
                    } catch (error) {
                        console.error('Error updating description:', error);
                        alert('Gagal memperbarui deskripsi lapangan. Silakan coba lagi.');
                    } finally {
                        this.loading = false;
                    }
                },
                async toggleSelection(facilityId) {
                    console.log("facilityId sinii bro: " + facilityId);
                    // const facility = this.facilities.find(item => item.name.toLowerCase() === facility);
                    if (this.selected.includes(facilityId)) {
                        this.selected = this.selected.filter(item => item !== facilityId);
                        await this.removeFacility(facilityId);
                    } else {
                        this.selected.push(facilityId);
                        await this.addFacility(facilityId);
                    }
                },
                async addFacility(facilityId) {
                    try {
                        const response = await axios.post(`fields/${this.fieldId}/facilities/${facilityId}`)
                        console.log('Facility updated successfully:', response.data);
                    } catch (error) {
                        console.error('Error updating facility:', error);
                    }
                },
                async removeFacility(facilityId) {
                    try {
                        const response = await axios.delete(`fields/${this.fieldId}/facilities/${facilityId}`);
                        console.log('Facility deleted successfully:', response.data);
                    } catch (error) {
                        console.error('Error deleting facility:', error);
                    }
                }
            }
        }

        // function facilitySelection(initialSelected) {
        //     return {
        //         selected: initialSelected || [],
        //         toggleSelection(facility) {
        //             if (this.selected.includes(facility)) {
        //                 this.selected = this.selected.filter(item => item !== facility);
        //             } else {
        //                 this.selected.push(facility);
        //             }
        //             this.updateFacilitiesOnServer();
        //         },

        //     }
        // }
    </script>
@endpush
