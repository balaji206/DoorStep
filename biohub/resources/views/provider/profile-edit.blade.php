<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Business Profile
        </h2>
    </x-slot>

    <div class="py-10 max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-xl shadow p-6">

            <form method="POST" action="{{ route('provider.profile.update') }}">
                @csrf
                @method('PUT')

                {{-- Business Name --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Business Name</label>
                    <input type="text" name="business_name"
                        value="{{ old('business_name', $provider->business_name) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        required />
                    @error('business_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        required>
                        <option value="">-- Select Category --</option>
                        <option value="Salon" {{ old('category', $provider->category) == 'Salon' ? 'selected' : '' }}>💈 Salon</option>
                        <option value="Mechanic" {{ old('category', $provider->category) == 'Mechanic' ? 'selected' : '' }}>🔧 Mechanic</option>
                        <option value="Clinic" {{ old('category', $provider->category) == 'Clinic' ? 'selected' : '' }}>🏥 Clinic</option>
                        <option value="Cleaning" {{ old('category', $provider->category) == 'Cleaning' ? 'selected' : '' }}>🧹 Cleaning</option>
                        <option value="Electrician" {{ old('category', $provider->category) == 'Electrician' ? 'selected' : '' }}>⚡ Electrician</option>
                        <option value="Plumber" {{ old('category', $provider->category) == 'Plumber' ? 'selected' : '' }}>🔩 Plumber</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="3"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $provider->description) }}</textarea>
                </div>

                {{-- Location --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <input type="text" name="location"
                        value="{{ old('location', $provider->location) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        required />
                    @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="text" name="phone"
                        value="{{ old('phone', $provider->phone) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        required />
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 bg-indigo-600 text-white py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">
                        Save Changes
                    </button>
                    <a href="{{ route('provider.dashboard') }}"
                        class="flex-1 text-center bg-gray-100 text-gray-700 py-2 rounded-lg font-semibold hover:bg-gray-200 transition">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>