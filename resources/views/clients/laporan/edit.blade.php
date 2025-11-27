@extends('layout.app')

@section('title', 'Edit Laporan')

@section('content')
<div class="mt-6">

    <h2 class="text-2xl font-semibold mb-4">Edit Laporan</h2>

    <form action="{{ route('client.laporan.update', $laporan->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white shadow-md rounded-xl p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>

            <input type="text" id="name" name="name"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2
            focus:ring-black focus:border-black transition" disabled
                value="{{ old('name', $laporan->client->name) }}">

            @error('name')
            <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="project_id" class="block text-sm font-medium text-gray-700 mb-2">Project</label>
            <select name="project_id" id="project_id"
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                @foreach ($projects as $project)
                <option value="{{ $project->id }}"
                    {{ $laporan->project_id == $project->id ? 'selected' : '' }}>
                    {{ $project->nama_project }} - {{ $project->company->name }}
                </option>
                @endforeach

            </select>
        </div>

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>

            <input type="text" id="title" name="title"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2
            focus:ring-black focus:border-black transition"
                value="{{ old('title', $laporan->title) }}">

            @error('title')
            <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4"
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $laporan->deskripsi }}</textarea>

            @error('title')
            <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-5">
            <label for="tipe" class="block text-sm font-medium text-gray-700 mb-2">Tipe</label>
            <select name="tipe" id="tipe"
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="Bug" {{ $laporan->tipe == 'Bug' ? 'selected' : '' }}>Bug</option>
                <option value="Feature" {{ $laporan->tipe == 'Feature' ? 'selected' : '' }}>Feature</option>
                <option value="Support" {{ $laporan->tipe == 'Support' ? 'selected' : '' }}>Support</option>
            </select>
        </div>

        <div class="mb-5">
            <label class="block text-sm font-medium text-gray-700 mb-2">Dokumentasi Lama</label>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($lampiran as $lam)
                <div class="border p-2 rounded-lg relative">
                    <!-- Checkbox Hapus -->
                    <label class="flex items-center gap-2 mb-2">
                        <input type="checkbox" name="delete_lampiran[]" value="{{ $lam->id }}">
                        <span class="text-sm text-red-600">Hapus</span>
                    </label>

                    <!-- Preview -->
                    @if (Str::endsWith($lam->dokumentasi, ['jpg','jpeg','png']))
                    <img src="{{ asset('storage/' . $lam->dokumentasi) }}"
                        class="w-full h-32 object-cover rounded-lg">
                    @else
                    <a href="{{ asset('storage/' . $lam->dokumentasi) }}"
                        target="_blank"
                        class="text-blue-500 underline">
                        Lihat File
                    </a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        <hr class="my-5">

        <div class="mb-5">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Tambah Dokumentasi Baru
            </label>

            <div id="file-wrapper" class="space-y-3">
                <input type="file"
                    name="dokumentasi[]"
                    accept="image/*,video/*,.pdf,.doc,.docx,.txt"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2" />
            </div>

            <button type="button" id="add-file"
                class="mt-3 px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                + Tambah Lampiran
            </button>
        </div>


        <div class="flex items-center gap-3 mt-5">
            <button type="submit"
                class="bg-blue-500 text-white px-5 py-2 rounded-lg hover:bg-gray-900 transition">
                Update
            </button>

            <a href="{{ route('client.laporan.index') }}"
                class="px-5 py-2 border border-gray-400 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                Kembali
            </a>
        </div>

    </form>

    <script>
        document.getElementById('add-file').addEventListener('click', function() {
            const wrapper = document.getElementById('file-wrapper');
            const input = document.createElement('input');

            input.type = 'file';
            input.name = 'dokumentasi[]';
            input.accept = 'image/*,video/*,.pdf,.doc,.docx,.txt';
            input.className = 'w-full border border-gray-300 rounded-lg px-3 py-2';

            wrapper.appendChild(input);
        });
    </script>
</div>
@endsection