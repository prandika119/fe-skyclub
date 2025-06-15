<!-- Modal Sukses -->
<div x-show="alertSuccess" x-cloak x-transition
    class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full text-center">
        <svg class="mx-auto mb-4 w-16 h-16 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
        <h2 class="text-2xl font-bold mb-2">Berhasil!</h2>
        <p class="mb-6">{{ $message ?? 'Proses Berhasil' }}</p>
        <button @click="alertSuccess = false"
            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Tutup</button>
    </div>
</div>
