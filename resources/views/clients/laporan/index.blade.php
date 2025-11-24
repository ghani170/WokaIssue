@extends('layout.app')

@section('title','Laporan')

@section('content')
<div class="p-6">

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
    <div
        id="alert-success"
        class="fixed top-6 left-1/2 -translate-x-1/2 bg-green-100 text-green-700 border-l-4 border-green-600 px-5 py-3 rounded-md shadow-md animate-fadeIn"
    >
        <i class="bi bi-check-circle-fill mr-2"></i>
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            const box = document.getElementById('alert-success');
            if (box) {
                box.classList.add('opacity-0', '-translate-y-5', 'transition-all', 'duration-500');
                setTimeout(() => box.remove(), 600);
            }
        }, 3000);
    </script>
    @endif

    {{-- ALERT ERROR --}}
    @if (session('error'))
    <div
        id="alert-error"
        class="fixed top-6 left-1/2 -translate-x-1/2 bg-red-100 text-red-700 border-l-4 border-red-600 px-5 py-3 rounded-md shadow-md animate-fadeIn"
    >
        <i class="bi bi-exclamation-triangle-fill mr-2"></i>
        {{ session('error') }}
    </div>

    <script>
        setTimeout(() => {
            const box = document.getElementById('alert-error');
            if (box) {
                box.classList.add('opacity-0', '-translate-y-5', 'transition-all', 'duration-500');
                setTimeout(() => box.remove(), 600);
            }
        }, 3000);
    </script>
    @endif

    {{-- Animasi --}}
    <style>
        @keyframes fadeInSlide {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeInSlide .4s ease-out; }
    </style>

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Data Laporan</h1>

        <a href=""
           class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm shadow hover:bg-blue-700">
            <i class="bi bi-plus-circle mr-1"></i> Tambah
        </a>
    </div>

    {{-- CARD --}}
    <div class="bg-white rounded-lg shadow p-5 overflow-x-auto">

        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead>
                <tr class="bg-gray-50 text-gray-700">
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Nama</th>
                    <th class="px-4 py-2 text-left">Company</th>
                    <th class="px-4 py-2 text-left">Judul</th>
                    <th class="px-4 py-2 text-left">Deskripsi</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-center">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse ($laporan as $no => $row)
                <tr>
                    <td class="px-4 py-2">{{ $no + 1 }}</td>
                    <td class="px-4 py-2">{{ ucfirst($row->name) }}</td>
                    <td class="px-4 py-2">{{ $row->company->nama_company ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $row->judul }}</td>
                    <td class="px-4 py-2">{{ Str::limit($row->deskripsi, 40) }}</td>
                    <td class="px-4 py-2">{{ $row->status }}</td>

                    <td class="px-4 py-2 text-center">
                        <div class="inline-flex gap-2">

                            {{-- Edit --}}
                            <a href="{{ route('client.laporan.edit', $row->id) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-xs shadow">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            {{-- Hapus --}}
                            <form action="{{ route('client.laporan.destroy', $row->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus laporan ini?');">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs shadow">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">
                        Tidak ada laporan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
@endsection
