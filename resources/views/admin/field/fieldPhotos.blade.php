@extends('layouts.admin')

@push('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/dropzoneFieldPhoto.js'])
@endpush

@section('content')
    {{-- field image --}}
    <div x-data="fieldImageHandler()" class="bg-white shadow rounded-lg border-gray-300 mb-4 p-6">
        <p class="font-semibold mb-2 text-2xl">Gambar Lapangan</p>
        <p class="mb-5 font-light text-gray-500 sm:text-xl">Masukan gambar lapangan</p>
        <template x-if="loading">
            <div class="text-center py-8">Memuat gambar...</div>
        </template>
        <template x-if="error">
            <div class="text-red-500" x-text="error"></div>
        </template>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4" x-show="!loading">
            <template x-for="image in photos" :key="image.id">
                <div>
                    <!-- Modal Trigger -->
                    <button type="button" @click="openModal = image.id">
                        <div :id="`image-${image.id}`"
                            class="overflow-hidden rounded-lg border-gray-300 h-32 md:h-64 cursor-pointer">
                            <img class="w-full h-full" :src="$store.storage.getPhoto(image.photo)" alt="">
                            {{-- <div class="items-center justify-center w-full h-full bg-center bg-cover bg-no-repeat"
                                    :style="`background-image: url('http://10.33.35.50/storage/${image.photo}')`"> --}}
                        </div>
                    </button>

                    <!-- Modal -->
                    <div x-show="openModal === image.id"
                        class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full bg-black/40"
                        style="display: none;">
                        <div class="relative w-full max-w-2xl">
                            <div class="relative bg-white rounded-lg shadow p-6">
                                <div class="flex items-start justify-between p-4 border-b rounded-t">
                                    <h3 class="text-xl font-semibold text-gray-900">
                                        Gambar Lapangan
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center  "
                                        @click="openModal = null">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <div class="p-6 bg-center bg-cover bg-no-repeat space-y-6 h-1/2">
                                    <img class="object-cover w-full h-full rounded-lg"
                                        :src="$store.storage.getPhoto(image.photo)" alt="Gambar Lapangan">
                                </div>
                                <button @click="deleteImage(image.id)"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <!-- Tombol add dengan dropzone tetap, silakan lanjutkan sendiri -->
        <div class="rounded-lg border-gray-300 h-32 md:h-64">
            <div id="dropzone-image" class="dropzone hover:bg-gray-100 flex items-center justify-center w-full h-full">
            </div>
        </div>
    </div>
    {{-- <p class="font-semibold mb-2 text-2xl">Gambar Lapangan</p>
        <p class="mb-5 font-light text-gray-500 sm:text-xl">Masukan gambar lapangan</p>
        album image
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            @foreach ($fieldPhotos as $image)
                <!-- Modal Trigger -->
                <button type="button" data-modal-target="modal-{{ $image->id }}"
                    data-modal-toggle="modal-{{ $image->id }}">
                    <div id="image-{{ $image->id }}"
                        class="overflow-hidden rounded-lg border-gray-300 h-32 md:h-64 cursor-pointer">
                        <div class="items-center justify-center w-full h-full bg-center bg-cover bg-no-repeat"
                            style="background-image: url('{{ asset('storage/field/images/' . $image->photo) }}');">
                        </div>
                    </div>
                </button>

                <!-- Modal -->
                <div id="modal-{{ $image->id }}" tabindex="-1" aria-hidden="true"
                    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                    <div class="relative w-full h-full max-w-2xl md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <div class="flex items-start justify-between p-4 border-b rounded-t">
                                <h3 class="text-xl font-semibold text-gray-900">
                                    Gambar Lapangan
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center  "
                                    data-modal-hide="modal-{{ $image->id }}">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 bg-center bg-cover bg-no-repeat space-y-6 h-1/2">
                                <img class="object-cover w-full h-full rounded-lg"
                                    src="{{ asset('storage/field/images/' . $image->photo) }}" alt="Gambar Lapangan">
                            </div>
                            <button onclick="deleteImage({{ $image->id }})"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
            tombol add dengan dropzone
            <div class="rounded-lg  border-gray-300 h-32 md:h-64">
                <div id="dropzone-image" class="dropzone hover:bg-gray-100 flex items-center justify-center w-full h-full">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
            </div>
        </div> --}}

    {{-- Banner Image --}}
    {{-- <div class="bg-white shadow rounded-lg border-gray-600 h-fit mb-4 p-6">
        <p class="font-semibold mb-2 text-2xl">Gambar Banner</p>
        <p class="mb-5 font-light text-gray-500 sm:text-xl">Ganti gambar untuk banner pada halaman
            dashboard</p>
        <div class="rounded-lg border-gray-300 h-[300px] sm:h-[400px] md:h-[500px]">
            <div id="dropzone-banner-1"
                class="dropzone flex items-center justify-center w-full h-full bg-center bg-cover bg-no-repeat"
                style="background-image: url('{{ Storage::url('images/banner/banner_1.png') }}');">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
        </div>
    </div> --}}

    {{-- slider image --}}
    {{-- <div class="bg-white shadow rounded-lg border-gray-300 mb-4 p-6">
        <p class="font-semibold mb-2 text-2xl">Gambar Slider</p>
        <p class="mb-5 font-light text-gray-500 sm:text-xl">Ganti gambar untuk slider pada halaman
            dashboard</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
            <div class="rounded-lg border-gray-300 md:h-64">
                <div id="dropzone-slider-1"
                    class="dropzone flex items-center justify-center w-full h-full bg-center bg-cover bg-no-repeat rounded-lg"
                    style="background-image: url('{{ Storage::url('images/slider/album_1.png') }}');">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
            </div>
            <div class="rounded-lg border-gray-300 md:h-64">
                <div id="dropzone-slider-2"
                    class="dropzone flex items-center justify-center w-full h-full bg-center bg-cover bg-no-repeat"
                    style="background-image: url('{{ Storage::url('images/slider/album_2.png') }}');">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
            </div>
            <div class="rounded-lg border-gray-300 md:h-64">
                <div id="dropzone-slider-3"
                    class="dropzone flex items-center justify-center w-full h-full bg-center bg-cover bg-no-repeat"style="background-image: url('{{ Storage::url('images/slider/album_3.png') }}');">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@push('script')
    <script>
        function deleteImage(id) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            axios.delete(`/admin/delete-image/${id}`, {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    }
                })
                .then(response => {
                    if (response.data.success) {
                        console.log('Image deleted successfully');
                        // Optionally, remove the image element from the DOM
                        // location.reload();
                        document.getElementById(`image-${id}`).remove();
                    } else {
                        console.log('Error deleting image: ' + response.data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function fieldImageHandler() {
            return {
                photos: [],
                fieldId: 0,
                loading: false,
                error: '',
                openModal: null,
                async init() {
                    await this.fetchPhotos();
                },
                async fetchPhotos() {
                    try {
                        this.loading = true;
                        const resField = await axios.get('/fields'); // Mengambil ID field pertama
                        console.log("resField: " + resField);
                        this.fieldId = resField.data.data[0].id;
                        const res = await axios.get(`fields/${this.fieldId}`);
                        this.photos = res.data.data.photos; // sesuaikan struktur respons API Anda
                    } catch (e) {
                        this.error = 'Gagal memuat gambar';
                    } finally {
                        this.loading = false;
                    }
                },
                async deleteImage(id) {
                    if (!confirm('Yakin hapus gambar?')) return;
                    try {
                        await axios.delete(`fields/photos/${id}`);
                        this.photos = this.photos.filter(img => img.id !== id);
                    } catch (e) {
                        alert('Gagal menghapus gambar');
                    } finally {
                        this.openModal = null; // Tutup modal setelah menghapus
                    }
                }
            }
        }
    </script>
@endpush
