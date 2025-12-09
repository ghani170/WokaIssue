@extends('layout.app')

@section('title', 'Edit Company')

@section('content')
<div class="mt-6">

    <h2 class="text-2xl font-semibold mb-4">Edit Perusahaan</h2>

    <form action="{{ route('admin.company.update', $company->id) }}" method="POST"
        class="bg-white shadow-md rounded-xl p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Perusahaan</label>

            <input type="text" id="name" name="name"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2
                focus:ring-black focus:border-black transition"
                value="{{ old('name', $company->name) }}">

            @error('name')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>

            <textarea id="alamat" name="alamat" rows="3"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2
                focus:ring-black focus:border-black transition">{{ old('alamat', $company->alamat) }}</textarea>

            @error('alamat')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>

            <input type="text" id="telepon" name="telepon"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2
                focus:ring-black focus:border-black transition"
                value="{{ old('telepon', $company->telepon) }}">

            @error('telepon')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div class="flex items-center gap-3 mt-5">
            <button type="submit"
                class="bg-blue-500 text-white px-5 py-2 rounded-lg hover:bg-blue-800 transition cursor-pointer">
                Update
            </button>

            <a href="{{ route('admin.company.index') }}"
                class="px-5 py-2 border border-gray-400 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                Kembali
            </a>
        </div>

    </form>

</div>
@endsection
