<div x-data="userHandler()" x-init="fetchUser()" x-show="activeTab === 'account'" class="mt-10">
    <h2 class="font-bold text-3xl mb-4">Account</h2>
    <div class="px-6 py-8 mt-8 rounded-xl bg-white ring-1 ring-gray-200 shadow-lg space-y-8">
        <!-- Loading State -->
        <template x-if="isLoading">
            <div class="space-y-6">
                <div x-repeat="6" class="flex justify-between items-center">
                    <div class="space-y-2">
                        <div class="h-4 w-24 bg-gray-300 rounded"></div>
                        <div class="h-6 w-48 bg-gray-300 rounded"></div>
                    </div>
                    <div class="h-10 w-32 bg-gray-300 rounded"></div>
                </div>
            </div>
        </template>

        <!-- Error State -->
        <template x-if="error">
            <div class="text-red-500 text-center py-8" x-text="error"></div>
        </template>

        <!-- User Data -->
        <template x-if="!isLoading && user">
            <div class=" space-y-8">
                <!-- Name -->
                <div class="flex justify-between items-center">
                    <div>
                        <p class=" text-gray-600">Name</p>
                        <p class="font-semibold text-xl" x-text="user.name"></p>
                    </div>
                    <a class="px-6 border-2 border-red-500 self-stretch items-center flex rounded-lg space-x-1 text"
                        href="/">
                        <img src="{{ asset('assets/icons/icon-change.svg') }}" alt="">
                        <p>Change</p>
                    </a>
                </div>
                
                <!-- Email -->
                <div class="flex justify-between items-center">
                    <div class="space-y2">
                        <p class=" text-gray-600">Email</p>
                        <p class="font-semibold text-xl" x-text="user.email"></p>
                    </div>
                    <a class="px-6 border-2 border-red-500 self-stretch items-center flex rounded-lg space-x-1"
                        href="/">
                        <img src="{{ asset('assets/icons/icon-change.svg') }}" alt="">
                        <p>Change</p>
                    </a>
                </div>
                
                <!-- Password -->
                <div class="flex justify-between items-center">
                    <div class="space-y2">
                        <p class=" text-gray-600">Password</p>
                        <p class="font-semibold text-xl">************</p>
                    </div>
                    <a class="px-6 border-2 border-red-500 self-stretch items-center flex rounded-lg space-x-1"
                        href="/">
                        <img src="{{ asset('assets/icons/icon-change.svg') }}" alt="">
                        <p>Change</p>
                    </a>
                </div>
                
                <!-- Phone Number -->
                <div class="flex justify-between items-center">
                    <div class="space-y2">
                        <p class="text-gray-600">Phone number</p>
                        <p class="font-semibold text-xl" x-text="user.no_telp || '-'"></p>
                    </div>
                    <a class="px-6 border-2 border-red-500 self-stretch items-center flex rounded-lg space-x-1"
                        href="/">
                        <img src="{{ asset('assets/icons/icon-change.svg') }}" alt="">
                        <p>Change</p>
                    </a>
                </div>
                
                <!-- Address -->
                <div class="flex justify-between items-center">
                    <div class="space-y2">
                        <p class="text-gray-600">Address</p>
                        <p class="font-semibold text-xl" x-text="user.address || '-'"></p>
                    </div>
                    <a class="px-6 border-2 border-red-500 self-stretch items-center flex rounded-lg space-x-1"
                        href="/">
                        <img src="{{ asset('assets/icons/icon-change.svg') }}" alt="">
                        <p>Change</p>
                    </a>
                </div>
                
                <!-- Date of Birth -->
                <div class="flex justify-between items-center">
                    <div class="space-y2">
                        <p class="text-gray-600">Date of birth</p>
                        <p class="font-semibold text-xl" x-text="user.date_of_birth || '-'"></p>
                    </div>
                    <a class="px-6 border-2 border-red-500 self-stretch items-center flex rounded-lg space-x-1"
                        href="/">
                        <img src="{{ asset('assets/icons/icon-change.svg') }}" alt="">
                        <p>Change</p>
                    </a>
                </div>
                
                <!-- Team Name -->
                <div class="flex justify-between items-center">
                    <div class="space-y2">
                        <p class="text-gray-600">Nama Tim</p>
                        <p class="font-semibold text-xl" x-text="user.team || '-'"></p>
                    </div>
                    <a class="px-6 border-2 border-red-500 self-stretch items-center flex rounded-lg space-x-1"
                        href="/">
                        <img src="{{ asset('assets/icons/icon-change.svg') }}" alt="">
                        <p>Change</p>
                    </a>
                </div>
            </div>
        </template>
    </div>
</div>