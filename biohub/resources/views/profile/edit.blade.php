<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Profile
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto px-4 space-y-6">

            {{-- Update Profile Info --}}
            <div class="bg-white shadow rounded-xl p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-xl">
                        👤
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">Profile Information</h3>
                        <p class="text-sm text-gray-500">Update your name and email</p>
                    </div>
                </div>
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Update Password --}}
            <div class="bg-white shadow rounded-xl p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-xl">
                        🔒
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">Update Password</h3>
                        <p class="text-sm text-gray-500">Keep your account secure</p>
                    </div>
                </div>
                @include('profile.partials.update-password-form')
            </div>

            {{-- Delete Account --}}
            <div class="bg-white shadow rounded-xl p-6 border border-red-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-xl">
                        ⚠️
                    </div>
                    <div>
                        <h3 class="font-bold text-red-600">Danger Zone</h3>
                        <p class="text-sm text-gray-500">Delete your account permanently</p>
                    </div>
                </div>
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>