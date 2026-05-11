<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Business Profile
        </h2>
    </x-slot>

    <div class="py-10 max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-xl shadow p-6">

            <form method="POST" action="{{ route('provider.profile.store') }}">
                @csrf

                {{-- Business Name --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Business Name</label>
                    <input type="text" name="business_name" value="{{ old('business_name') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Johns Salon" required />
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
                        <option value="Salon" {{ old('category') == 'Salon' ? 'selected' : '' }}>💈 Salon</option>
                        <option value="Mechanic" {{ old('category') == 'Mechanic' ? 'selected' : '' }}>🔧 Mechanic</option>
                        <option value="Clinic" {{ old('category') == 'Clinic' ? 'selected' : '' }}>🏥 Clinic</option>
                        <option value="Cleaning" {{ old('category') == 'Cleaning' ? 'selected' : '' }}>🧹 Cleaning</option>
                        <option value="Electrician" {{ old('category') == 'Electrician' ? 'selected' : '' }}>⚡ Electrician</option>
                        <option value="Plumber" {{ old('category') == 'Plumber' ? 'selected' : '' }}>🔩 Plumber</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="3"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Tell customers about your business...">{{ old('description') }}</textarea>
                </div>

                {{-- Location --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <input type="text" name="location" value="{{ old('location') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="123 Main Street, Chennai" required />
                    @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="9876543210" required />
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    Create Profile 🚀
                </button>

            </form>
        </div>
    </div>
</x-app-layout>