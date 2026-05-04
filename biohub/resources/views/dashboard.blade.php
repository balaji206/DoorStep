<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Dashboard
        </h2>
    </x-slot>

    <div class="py-10 max-w-3xl mx-auto px-4">

        {{-- Profile Card --}}
        <div class="bg-white rounded-xl shadow p-6 mb-6 flex items-center gap-4">
            <div class="w-16 h-16 rounded-full bg-purple-200 flex items-center justify-center text-3xl">
                👤
            </div>
            <div>
                <h2 class="text-xl font-bold">{{ auth()->user()->name }}</h2>
                <p class="text-gray-500 text-sm">{{auth()->user()->email}}</p>
                <p class="text-purple-600 text-sm">biohub.com/{{auth()->user()->name}}</p>
            </div>
        </div>

        {{-- Links Section --}}
        <div class="bg-white rounded-xl shadow p-6">

            {{-- Header --}}
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold">My Links</h3>
                <a href="{{ route('links.create') }}"
                   class="bg-purple-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-purple-700">
                    + Add Link
                </a>
            </div>

            {{-- Dummy Links for now --}}
            <div class="flex justify-between items-center border-b py-3">
                <div>
                    <p class="font-medium">My Portfolio</p>
                    <p class="text-gray-400 text-sm">https://portfolio.com</p>
                </div>
                <div class="flex gap-3">
                    <a href="#" class="text-blue-500 text-sm">Edit</a>
                    <a href="#" class="text-red-500 text-sm">Delete</a>
                </div>
            </div>

            <div class="flex justify-between items-center border-b py-3">
                <div>
                    <p class="font-medium">GitHub</p>
                    <p class="text-gray-400 text-sm">https://github.com</p>
                </div>
                <div class="flex gap-3">
                    <a href="#" class="text-blue-500 text-sm">Edit</a>
                    <a href="#" class="text-red-500 text-sm">Delete</a>
                </div>
            </div>

            <div class="flex justify-between items-center py-3">
                <div>
                    <p class="font-medium">LinkedIn</p>
                    <p class="text-gray-400 text-sm">https://linkedin.com</p>
                </div>
                <div class="flex gap-3">
                    <a href="#" class="text-blue-500 text-sm">Edit</a>
                    <a href="#" class="text-red-500 text-sm">Delete</a>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>