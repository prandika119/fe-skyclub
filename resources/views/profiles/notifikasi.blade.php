@extends('layouts.master')
@section('content')
    <div x-data="notifikasiHandler()" x-init="fetchNotif()" class="mt-17.5 mb-5">
        <p class="font-semibold text-base mb-4">Notifikasi</p>
        <h1 class="font-bold text-5xl mb-6">Notifikasi</h1>
        <p class="text-lg">Berikut adalah list notifikasi yang tersedia saat ini.</p>

        <div class="w-full space-y-2.5 py-2">
            <template x-for="notification in notifications" :key="notification.id">
                <div class="px-4 py-2 rounded-lg shadow flex justify-between items-center text-base">
                    <div class="flex items-start">
                        <button @click="markAsRead(notification.id)" class="text-red-600 hover:underline">Lihat</button>
                    </div>
                    <span :class="notification.read_at ? 'font-normal' : 'font-bold'"
                        x-text="notification.data.message"></span>
                    <span x-text="formatDate(notification.created_at)"></span>
                </div>
            </template>
            <template x-if="notifications.length === 0">
                <p>Tidak Ada Notifikasi</p>
            </template>
        </div>
    </div>

    <script>
        function notifikasiHandler() {
            return {
                notifications: [],
                async fetchNotif() {
                    // Ambil data notifikasi dari backend
                    try {
                        const response = await axios.get('/users/current/notifications');
                        this.notifications = response.data.data.data;
                    } catch (error) {
                        console.error('Error fetching notifications:', error);
                    }
                },
                async markAsRead(id) {
                    // Kirim request ke backend untuk mark as read
                    try {
                        await axios.post(`users/current/notifications/${id}/read`);
                        // redirect to my profile
                        await Alpine.store('user').refreshLocalStorage(); // Refresh data user di local storage
                        await this.fetchNotif(); // Refresh data setelah menandai sebagai dibaca
                        window.location.href = '/users/profile-user';

                    } catch (error) {
                        console.error('Error marking notification as read:', error);
                    }
                },
                formatDate(dateStr) {
                    // Format tanggal sesuai kebutuhan, contoh: 27 May 2024 | 10:30
                    const date = new Date(dateStr);
                    return date.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    }) + ' | ' + date.toLocaleTimeString('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                }
            }
        }
    </script>
@endsection
@push('script')
    <script>
        function notifikasiHandler() {
            return {
                notifications: [

                ],
                async fetchNotif() {
                    // Ambil data notifikasi dari backend
                    try {
                        const response = await axios.get('/users/current/notifications');
                        this.notifications = response.data.data;
                    } catch (error) {
                        console.error('Error fetching notifications:', error);
                    }
                }
                async markAsRead(id) {
                    // Kirim request ke backend untuk mark as read
                    // await axios.post(`/notification/${id}/mark-as-read`);
                    // Setelah berhasil, update data lokal
                    const notif = this.notifications.find(n => n.id === id);
                    if (notif) notif.read_at = new Date().toISOString();
                },
                formatDate(dateStr) {
                    // Format tanggal sesuai kebutuhan, contoh: 27 May 2024 | 10:30
                    const date = new Date(dateStr);
                    return date.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    }) + ' | ' + date.toLocaleTimeString('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                }
            }
        }
    </script>
@endpush
