<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Rental Studio
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">

                    <h1 class="text-2xl font-bold mb-6">
                        Menu Dashboard
                    </h1>

                    <a href="{{ route('pelanggan.index') }}"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded">

                        Data Pelanggan

                    </a>

                    <a href="{{ route('studio.index') }}"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-5 rounded ml-3">

                        Data Studio

                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>