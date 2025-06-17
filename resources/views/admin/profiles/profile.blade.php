@extends('layouts.master')
@section('content')
    {{-- Banner --}}
<div x-data="userHandler()" x-init="fetchUser()">
    <div class="flex flex-col items-center">
        <div class=" relative bg-cover rounded-xl overflow-hidden group w-full h-[350px]">
            <img class="w-full h-full object-cover" src="{{ asset('assets/images/default-banner.jpg') }}" alt="profile-banner">
            <a href="/" class="items-center justify-center flex space-x-2 absolute bottom-5 right-5 bg-red-600 rounded-lg px-4 py-2 font-semibold text-white">
                <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.47656 11.0171V13.0063C8.47656 13.1327 8.42629 13.2549 8.33691 13.3442C8.24757 13.4334 8.12626 13.4829 8 13.4829C7.87374 13.4829 7.75243 13.4334 7.66309 13.3442C7.57371 13.2549 7.52344 13.1327 7.52344 13.0063V11.0171H8.47656ZM8 0.51709C9.1727 0.51709 10.2831 0.912313 11.1523 1.63525L11.3232 1.78467C11.9947 2.39911 12.4789 3.18551 12.752 4.09717L12.8555 4.49463C12.8772 4.59219 12.9265 4.68168 12.9971 4.75244C13.05 4.80551 13.1131 4.84712 13.1826 4.87354L13.2539 4.89502C13.7478 5.0068 14.219 5.20151 14.6201 5.46436L14.7881 5.58154C15.5661 6.15796 15.9766 6.95355 15.9766 7.88135C15.9765 8.77811 15.6417 9.53944 15.0059 10.0933L14.875 10.2007C14.238 10.6959 13.3503 10.9702 12.375 10.9702H8.52344V6.25635L9.63086 7.36377C9.6796 7.41248 9.73708 7.45174 9.80078 7.47803C9.8645 7.50431 9.93303 7.51726 10.002 7.51709C10.0709 7.51691 10.1395 7.50368 10.2031 7.47705C10.2349 7.46376 10.2646 7.44639 10.293 7.42725L10.373 7.36182C10.5521 7.18069 10.5644 6.90036 10.4277 6.6958L10.3604 6.61279L8.37012 4.62354C8.27196 4.52545 8.13876 4.47021 8 4.47021C7.89604 4.47021 7.79525 4.50134 7.70996 4.55811L7.62988 4.62354L5.63965 6.61377C5.46603 6.78746 5.42978 7.05743 5.55078 7.26221L5.6123 7.34521C5.65994 7.39768 5.71778 7.44074 5.78223 7.47021C5.84663 7.49964 5.91652 7.51538 5.9873 7.51709C6.05811 7.51879 6.12858 7.50628 6.19434 7.47998C6.22718 7.46684 6.2587 7.45052 6.28809 7.43115L6.37012 7.36377L7.47656 6.25732V10.9702H4.25C3.19213 10.9702 2.20206 10.6434 1.43945 10.0474L1.29004 9.92432C0.473359 9.21748 0.0234375 8.24025 0.0234375 7.16846C0.0234856 6.17429 0.390597 5.29625 1.08789 4.61475L1.23145 4.48096C1.73277 4.03917 2.37066 3.71069 3.08008 3.52295L3.3877 3.45166C3.46773 3.4355 3.54318 3.40048 3.60742 3.3501C3.63931 3.32505 3.66823 3.29662 3.69336 3.26514L3.75781 3.16162C4.02452 2.60011 4.40023 2.09824 4.8623 1.68506L5.06543 1.51318C5.8851 0.861407 6.90038 0.51709 8 0.51709Z" fill="white" stroke="white" stroke-width="0.046875"/>
                </svg>
                <span>Upload new cover</span></a>
        </div>
        <div class="relative">
            <div class="-mt-20 relative bg-cover rounded-full overflow-hidden group size-40 ring-4 ring-red-700">
                <img class="w-full h-full object-cover" :src="user.profile_photo || '/assets/images/profile.svg'" alt="Profile Photo">
            </div>
            <button class="absolute bottom-0 right-0 p-2.5 bg-red-600 rounded-full">
                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <img class="absolute top-0 left-0 -mt-20" src="{{ asset('assets/icons/verified.svg') }}" alt="">
        </div>
    </div>

    <div class="mt-8 flex flex-col items-center space-y-2">
        <!-- Profile Section -->
        <template x-if="isLoading">
            <div class="animate-pulse">
                <div class="h-8 w-48 bg-gray-200 rounded"></div>
                <div class="h-6 w-64 bg-gray-200 rounded mt-2"></div>
            </div>
        </template>
        
        <template x-if="!isLoading && user">
            <div class="flex flex-col items-center">
                <h5 class="text-2xl font-semibold" x-text="user.name"></h5>
                <p class="text-base text-gray-600" x-text="user.email"></p>
            </div>
        </template>
        
        <template x-if="error">
            <div class="text-red-500" x-text="error"></div>
        </template>

        {{-- tab --}}
        <div x-data="{ activeTab: 'account', activeDashboardTab: 'lapangan', activeBookingTab: 'field' }" class="w-full">
            <!-- Tab Menu for Account and History -->
            <div class="mt-8 px-6 shadow-lg bg-white rounded-lg">
                <div class="grid grid-cols-3 -mb-px text-sm font-semibold" role="tablist">
                    <div class="text-center py-4"
                        :class="{ 'text-red-600 border-b-4 border-red-600': activeTab === 'account' }">
                        <button @click="activeTab = 'account'" class="inline-block">Account</button>
                    </div>
                    <div class="text-center py-4"
                        :class="{ 'text-red-600 border-b-4 border-red-600': activeTab === 'dashboard' }">
                        <button @click="activeTab = 'dashboard'" class="inline-block">Dashboard</button>
                    </div>
                    <div class="text-center py-4"
                        :class="{ 'text-red-600 border-b-4 border-red-600': activeTab === 'history' }">
                        <button @click="activeTab = 'history'" class="inline-block">History</button>
                    </div>
                </div>
            </div>
            @include('admin.profiles.account')
            @include('admin.profiles.dashboard')
            @include('admin.profiles.history')
        </div>
    </div>
</div>
<script>
function userHandler() {
    return {
        user: [],
        isLoading: false,
        async fetchUser() {
            this.isLoading = true;
            try {
                const response = await axios.get('/users/current');
                this.user = response.data.data || [];
            } catch (error) {
                console.error('Error fetching user:', error);
                this.user = [];
            } finally {
                this.isLoading = false;
            }
        }
    }
}

</script>
@endsection