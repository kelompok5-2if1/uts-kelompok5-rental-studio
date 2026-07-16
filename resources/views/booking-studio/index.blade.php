<x-app-layout>
@php
    $userRole = strtolower(Auth::user()->role ?? 'admin');
    $canManage = $userRole === 'admin';
    $canExport = in_array($userRole, ['admin', 'owner'], true);
@endphp

<div class="p-6">

    <h1 class="text-3xl font-bold mb-5">
        Booking Studio
    </h1>

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-5">
        @if($canManage)
            <a href="{{ route('booking-studio.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                Tambah Booking
            </a>
        @endif
        @if($canExport)
            <a href="{{ route('booking-studio.export.excel') }}"
                class="bg-green-600 text-white px-4 py-2 rounded">
                Export Excel
            </a>
        @endif
        
        <form action="{{ route('booking-studio.index') }}" method="GET" class="w-full md:w-auto">
            <div class="flex flex-col md:flex-row gap-2">
                <input type="text" 
                       name="search" 
                       value="{{ $search }}" 
                       placeholder="Cari pelanggan atau studio..."
                       class="px-4 py-2 border rounded w-full md:w-48">
                <select name="status" 
                        class="px-4 py-2 border rounded w-full md:w-auto"
                        onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="Pending" {{ $status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Selesai" {{ $status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Batal" {{ $status == 'Batal' ? 'selected' : '' }}>Batal</option>
                </select>
                <button type="submit" 
                        class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition whitespace-nowrap">
                    Cari
                </button>
                @if($search || $status)
                    <a href="{{ route('booking-studio.index') }}" 
                       class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition whitespace-nowrap">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="overflow-x-auto shadow rounded-lg">
        <table class="table-auto w-full mt-5 border">

            <thead>

                <tr class="bg-gray-200">

                    <th class="border p-2">No</th>
                    <th class="border p-2">Pelanggan</th>
                    <th class="border p-2">Studio</th>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Jam</th>
                    <th class="border p-2">Total</th>
                    <th class="border p-2">Status</th>
                    @if($canManage)
                        <th class="border p-2">Aksi</th>
                    @endif

                </tr>

            </thead>

            <tbody>

                @forelse($bookingStudio as $item)

                <tr>

                    <td class="border p-2">
                        {{ $bookingStudio->firstItem() + $loop->index }}
                    </td>

                    <td class="border p-2">
                        {{ $item->pelanggan->nama }}
                    </td>

                    <td class="border p-2">
                        {{ $item->studio->nama_studio }}
                    </td>

                    <td class="border p-2">
                        {{ $item->tanggal_booking }}
                    </td>

                    <td class="border p-2">
                        {{ $item->jam_mulai }}
                        -
                        {{ $item->jam_selesai }}
                    </td>

                    <td class="border p-2">
                        Rp {{ number_format($item->total_harga) }}
                    </td>

                    <td class="border p-2">
                        <span class="px-3 py-1 rounded text-white text-sm
                            {{ $item->status == 'Selesai' ? 'bg-green-500' : ($item->status == 'Batal' ? 'bg-red-500' : 'bg-yellow-500') }}">
                            {{ $item->status }}
                        </span>
                    </td>

                    @if($canManage)
                        <td class="border p-2 text-center">
                            <a href="{{ route('booking-studio.edit', $item->id) }}"
                               class="bg-yellow-400 px-3 py-1 rounded text-sm hover:bg-yellow-500 transition">
                                Edit
                            </a>
                            <form action="{{ route('booking-studio.destroy', $item->id) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="event.preventDefault(); confirmDelete(event);"
                                        class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    @else
                        <td class="border p-2 text-center text-gray-400">-</td>
                    @endif

                </tr>

                @empty

                <tr>
                    <td class="border p-2 text-center" colspan="{{ $canManage ? 8 : 7 }}">
                        Tidak ada data booking studio
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>
    </div>

    <div class="mt-6">
        {{ $bookingStudio->links() }}
    </div>

</div>

</x-app-layout>

        

