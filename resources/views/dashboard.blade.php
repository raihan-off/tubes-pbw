<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 background-color="#2F3241">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Selamat Datang Admin Guide.in") }}
                </div>
                <div class="gambar" style="margin-left: 25%; width: 45%">
                    <img class="welcome-image" src="img/welcome.jpeg" alt="welcome-img">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
