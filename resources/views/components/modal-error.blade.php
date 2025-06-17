<!-- Modal Error Besar -->
<div x-show="error" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
    <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-8 text-center relative">
        <button @click="error = null"
            class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-2xl">&times;</button>
        <svg class="mx-auto mb-4 w-16 h-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
            </path>
        </svg>
        <h2 class="text-2xl font-bold mb-2 text-red-600">Terjadi Kesalahan</h2>
        <p class="mb-6 text-gray-700" x-text="error"></p>
        <button @click="error = null"
            class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition">Tutup</button>
    </div>
</div>
