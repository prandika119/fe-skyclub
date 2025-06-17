<!-- Dashboard Tab Content -->
<div x-show="activeTab === 'dashboard'" class="mt-10">
    <h2 class="font-bold text-3xl mb-4">Dashboard</h2>

    <!-- Tab Menu for Bookings -->
    <div class="mt-8 px-6 shadow bg-white rounded-lg">
        <div class="grid grid-cols-3 -mb-px text-sm font-semibold" role="tablist">
            <div class="text-center py-4"
                :class="{ 'text-red-600 border-b-4 border-black': activeDashboardTab === 'lapangan' }">
                <button @click="activeDashboardTab = 'lapangan'" class="inline-block">Lapangan</button>
            </div>
            <div class="text-center py-4"
            :class="{ 'text-red-600 border-b-4 border-black': activeDashboardTab === 'fiturTambahan' }">
                <button @click="activeDashboardTab = 'fiturTambahan'" class="inline-block">Fitur Tambahan</button>
            </div>
            <div class="text-center py-4"
                :class="{ 'text-red-600 border-b-4 border-black': activeDashboardTab === 'artikel' }">
                <button @click="activeDashboardTab = 'artikel'" class="inline-block">Artikel</button>
            </div>
        </div>
    </div>

    <!-- Dashboard Tab Contents -->
    <div x-data="fieldHandler()" x-init="fetchField(fieldId)" x-show="activeDashboardTab === 'lapangan'" class="mt-8 space-y-10">
        <div x-data="{ photoSectionOpen: false }" class="min-h-full bg-gray-200 shadow rounded-lg">
            
            <!-- Gambar Section -->
            <div class=" bg-white rounded-lg py-8 px-6 flex justify-between items-center">
                <p class=" font-medium text-lg">Edit dan Tambahkan Gambar</p>
                <div>
                    <button @click="photoSectionOpen = !photoSectionOpen" class="size-12 p-2.5 border border-black rounded-lg">
                        <img x-show="!photoSectionOpen" src="{{ asset('assets/icons/icon-angle-right.svg') }}" alt="">
                        <img x-show="photoSectionOpen" src="{{ asset('assets/icons/icon-angle-down.svg') }}" alt="">
                    </button>
                </div>
            </div>
            <div x-show="photoSectionOpen" class="py-7 mx-6 p-4">
                <!-- Container utama untuk foto + tombol upload -->
                <div class="flex flex-row items-center overflow-x-auto space-x-3 p-3 bg-gray-50 rounded-lg">
                    <!-- Foto-foto yang ada -->
                     <template x-if="field && !isLoading">
                         <template x-for="photo in field.photos" :key="photo.id">
                             <div class="flex-shrink-0 relative group">
                                 <img 
                                     :src="photo.photo || '/placeholder.jpg'" 
                                     :alt="'Photo ' + photo.id"
                                     class="h-40 w-40 object-cover rounded-lg shadow-md border border-gray-200">
                                 <!-- Tombol hapus -->
                                 <button @click="deletePhoto(photo.id)" 
                                         class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                     </svg>
                                 </button>
                             </div>
                         </template>
                     </template>

                    <!-- Tombol Tambah Foto -->
                    <div class="flex-shrink-0">
                        <label class="cursor-pointer flex flex-col items-center justify-center h-40 w-40 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-400 transition-colors">
                            <input type="file" 
                                accept="image/*" 
                                class="hidden" 
                                @change="uploadPhoto"
                                :disabled="isUploading">
                            <template x-if="!isUploading">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    <span class="text-sm text-gray-500 mt-1">Tambah Foto</span>
                                </div>
                            </template>
                            <template x-if="isUploading">
                                <div class="flex flex-col items-center">
                                    <span class="text-sm text-gray-500" x-text="'Uploading: ' + uploadProgress + '%'"></span>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                                        <div class="bg-blue-600 h-2.5 rounded-full" :style="'width: ' + uploadProgress + '%'"></div>
                                    </div>
                                </div>
                            </template>
                        </label>
                    </div>
                </div>
                <!-- Tampilkan error -->
                <div x-show="error" class="text-red-500 mt-2" x-text="error"></div>
            </div>
        </div>

        <!-- Description Section -->
        <div x-data="{ descriptionSectionOpen: false }" class="min-h-full bg-gray-200 shadow-lg rounded-lg">
            <div class=" bg-white rounded-lg py-8 px-6 flex justify-between items-center">
                <p class=" font-medium text-lg">Edit dan Tambahkan Deskripsi</p>
                <div>
                    <button @click="descriptionSectionOpen = !descriptionSectionOpen" class="size-12 p-2.5 border border-black rounded-lg">
                        <img x-show="!descriptionSectionOpen" src="{{ asset('assets/icons/icon-angle-right.svg') }}" alt="">
                        <img x-show="descriptionSectionOpen" src="{{ asset('assets/icons/icon-angle-down.svg') }}" alt="">
                    </button>
                </div>
            </div>
            <div x-show="descriptionSectionOpen" class="py-7 mx-6 p-4">
                <!-- Container utama untuk foto + tombol upload -->
                <p x-text="field.description"></p>
            </div>
        </div>

        <!-- Fasility Section -->
        <div x-data="{ fasilitySectionOpen: false }" class="min-h-full bg-gray-200 shadow-lg rounded-lg">
            <div class=" bg-white rounded-lg py-8 px-6 flex justify-between items-center">
                <p class=" font-medium text-lg">Edit dan Tambahkan Fasilitas</p>
                <div>
                    <button @click="fasilitySectionOpen = !fasilitySectionOpen" class="size-12 p-2.5 border border-black rounded-lg">
                        <img x-show="!fasilitySectionOpen" src="{{ asset('assets/icons/icon-angle-right.svg') }}" alt="">
                        <img x-show="fasilitySectionOpen" src="{{ asset('assets/icons/icon-angle-down.svg') }}" alt="">
                    </button>
                </div>
            </div>
            <div x-show="fasilitySectionOpen" class="py-7 mx-6 p-4">
                <!-- Container utama untuk foto + tombol upload -->
                <p x-text="field.description"></p>
            </div>
        </div>

        <!-- Schedule Section -->
        <div x-data="{ scheduleSectionOpen: false }" class="min-h-full bg-gray-200 shadow-lg rounded-lg">
            <div class=" bg-white rounded-lg py-8 px-6 flex justify-between items-center">
                <p class=" font-medium text-lg">Edit dan Tambahkan Jadwal</p>
                <div>
                    <button @click="scheduleSectionOpen = !scheduleSectionOpen" class="size-12 p-2.5 border border-black rounded-lg">
                        <img x-show="!scheduleSectionOpen" src="{{ asset('assets/icons/icon-angle-right.svg') }}" alt="">
                        <img x-show="scheduleSectionOpen" src="{{ asset('assets/icons/icon-angle-down.svg') }}" alt="">
                    </button>
                </div>
            </div>
            <div x-show="scheduleSectionOpen" class="py-7 mx-6 p-4">
                <!-- Container utama untuk foto + tombol upload -->
                <p x-text="field.description"></p>
            </div>
        </div>

        <!-- Location Section -->
        <div x-data="{ locationSectionOpen: false }" class="min-h-full bg-gray-200 shadow-lg rounded-lg">
            <div class=" bg-white rounded-lg py-8 px-6 flex justify-between items-center">
                <p class=" font-medium text-lg">Edit dan Tambahkan Lokasi</p>
                <div>
                    <button @click="locationSectionOpen = !locationSectionOpen" class="size-12 p-2.5 border border-black rounded-lg">
                        <img x-show="!locationSectionOpen" src="{{ asset('assets/icons/icon-angle-right.svg') }}" alt="">
                        <img x-show="locationSectionOpen" src="{{ asset('assets/icons/icon-angle-down.svg') }}" alt="">
                    </button>
                </div>
            </div>
            <div x-show="locationSectionOpen" class="py-7 mx-6 p-4">
                <!-- Container utama untuk foto + tombol upload -->
                <p x-text="field.description"></p>
            </div>
        </div>


        {{-- @forelse ($bookings as $booking)
            @foreach ($booking->listBooking as $sesi)
                <x-drop-booking :booking="$booking" :sesi="$sesi" />
            @endforeach
        @empty
            <p>Tidak ada jadwal yang telah dipesan</p>
        @endforelse --}}
        
    </div>
    <div x-show="activeDashboardTab === 'fiturTambahan'" class="mt-8 space-y-10">

        {{-- @for ($x = 0; $x < 3; $x++)
            <x-drop-sparing />
        @endfor --}}
        
    </div>
    <div x-show="activeDashboardTab === 'artikel'" class="mt-8 space-y-10">

        {{-- @for ($x = 0; $x < 2; $x++)
            <x-drop-history-booking />
        @endfor
        @for ($x = 0; $x < 2; $x++)
            <x-drop-history-sparing />
        @endfor --}}
        
    </div>
</div>

<script>
function fieldHandler() {
    return {
        field: null,
        isLoading: false,
        error: null,
        isUploading: false, // Tambah state untuk upload
        uploadProgress: 0, // Progres upload
        
        // Fungsi fetch data lapangan
        async fetchField(fieldId) {
            this.isLoading = true;
            this.error = null;
            
            try {
                const response = await axios.get(`/fields/${fieldId}`);
                this.field = response.data.data;
            } catch (error) {
                console.error('Error fetching field:', error);
                this.error = error.response?.data?.message || 'Gagal memuat data lapangan';
                this.field = null;
            } finally {
                this.isLoading = false;
            }
        },
        
        // Upload foto
        async uploadPhoto(event) {
            // 1. Validasi ketersediaan data
            if (!this.field?.id) {
                this.error = "Data lapangan belum siap. Silakan refresh halaman.";
                return;
            }

            // 2. Validasi file
            const file = event.target.files[0];
            if (!file) return;

            if (!file.type.startsWith('image/')) {
                this.error = "Hanya file gambar yang diperbolehkan";
                return;
            }

            // 3. Proses upload
            this.isUploading = true;
            this.error = null;

            try {
                const formData = new FormData();
                formData.append('photo', file);
                formData.append('field_id', this.field.id);

                const response = await axios.post(
                    `/api/fields/${this.field.id}/photos`, 
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'Authorization': `Bearer ${localStorage.getItem('token')}`
                        }
                    }
                );

                // 4. Update tampilan
                if (!this.field.photos) this.field.photos = [];
                this.field.photos.push(response.data);
                event.target.value = '';
                
                alert("Foto berhasil ditambahkan!");
            } catch (error) {
                console.error("Upload error:", error);
                this.error = error.response?.data?.message || "Gagal mengupload foto";
            } finally {
                this.isUploading = false;
            }
        }
    }
}
</script>
