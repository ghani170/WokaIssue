@extends('layout.app')

@section('title', 'Edit Company')

@section('content')
<div class="mt-6">

    <h2 class="text-2xl font-semibold mb-4">Edit Perusahaan</h2>

    <form action="{{ route('client.laporan.update', $laporan->id) }}" method="POST"
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

        <div>
            <label for="tipe" class="block text-sm font-medium text-gray-700 mb-2">Tipe</label>
            <select name="tipe" id="tipe"
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="Bug" {{ $laporan->tipe == 'bug' ? 'selected' : '' }}>Bug</option>
                <option value="Feature" {{ $laporan->tipe == 'feature' ? 'selected' : '' }}>Feature</option>
                <option value="Support" {{ $laporan->tipe == 'support' ? 'selected' : '' }}>Support</option>
            </select>
        </div>

        <div class="mb-5">
            <label class="block text-sm font-medium text-gray-700 mb-2">Dokumentasi</label>
            @foreach ($lampiran as $lam)
            <img src="{{ asset('storage/' . $lam->dokumentasi) }}"
                class="w-32 h-32 object-cover rounded-lg mb-3 border">
            @endforeach


            <input type="file"
                name="dokumentasi"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 cursor-pointer" />
        </div>

        <div class="flex items-center gap-3 mt-5">
            <button type="submit"
                class="bg-black text-white px-5 py-2 rounded-lg hover:bg-gray-900 transition">
                Update
            </button>

            <a href="{{ route('client.laporan.index') }}"
                class="px-5 py-2 border border-gray-400 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                Kembali
            </a>
        </div>

    </form>

</div>
@endsection