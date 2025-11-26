@extends('layout.app')

@section('title', 'Create Project')

@section('content')
<div class="mt-6">

    <h2 class="text-2xl font-semibold mb-4">Tambah Project</h2>

    <form action="{{ route('client.laporan.store') }}" method="POST"
        class="bg-white shadow-md rounded-xl p-6" enctype="multipart/form-data">
        @csrf


        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>

            <input type="text" name="name"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none 
                focus:ring-2 focus:ring-black focus:border-black transition"
                value="{{ $user->name }}" disabled>
            <input type="hidden" name="client_id" value="{{ $user->id }}">

            @error('name')
            <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Project</label>

            <select type="text" name="project_id"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none 
                focus:ring-2 focus:ring-black focus:border-black transition">
                <option value="" disabled selected>-- Pilih Project --</option>
                @foreach ( $projects as $p)
                <option value="{{ $p->id }}">{{ $p->nama_project }}</option>
                @endforeach
            </select>

            @error('nama_project')
            <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>

            <input type="text" name="title"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none 
                focus:ring-2 focus:ring-black focus:border-black transition"
                value="{{ old('title') }}">

            @error('title')
            <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>

            <textarea name="deskripsi" rows="4"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none 
                focus:ring-2 focus:ring-black focus:border-black transition">{{ old('deskripsi') }}</textarea>

            @error('deskripsi')
            <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Tipe</label>

            <select name="tipe"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none 
                focus:ring-2 focus:ring-black focus:border-black transition">
                <option value="" disabled selected>-- Pilih Tipe --</option>
                <option value="Bug">Bug</option>
                <option value="Request">Request</option>
                <option value="Update">Update</option>
            </select>

            @error('tipe')
            <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Dokumentasi (Foto/ File)</label>

            <input type="file" name="dokumentasi"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none 
                focus:ring-2 focus:ring-black focus:border-black transition
                @error('dokumentasi') border-red-500 focus:ring-red-500 @enderror">

            @error('dokumentasi')
            <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>


        <div class="flex items-center gap-3 mt-5">
            <button type="submit"
                class="bg-blue-500 text-white px-5 py-2 rounded-lg hover:bg-gray-900 transition">
                Simpan
            </button>

            <a href="{{ route('client.laporan.index') }}"
                class="px-5 py-2 border border-gray-400 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                Kembali
            </a>
        </div>

    </form>

</div>
@endsection