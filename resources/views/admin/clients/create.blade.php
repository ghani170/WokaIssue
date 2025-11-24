@extends('layout.app')

@section('title', 'Create Data Client')

@section('content')
<div class="mx-auto mt-6">

    <h2 class="text-2xl font-semibold mb-4">Tambah Client</h2>

    <form action="{{ route('admin.client.store') }}" method="POST"
        class="bg-white shadow-md rounded-xl p-6">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>

            <input type="text" id="name" name="name"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2
                focus:ring-black focus:border-black transition"
                value="{{ old('name') }}">

            @error('name')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>

            <input type="text" id="email" name="email"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2
                focus:ring-black focus:border-black transition"
                value="{{ old('email') }}">

            @error('email')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <!-- Tombol -->
        <div class="flex items-center gap-3 mt-5">
            <button type="submit"
                class="bg-black text-white px-5 py-2 rounded-lg hover:bg-gray-900 transition">
                Simpan
            </button>

            <a href="{{ route('admin.client.index') }}"
                class="px-5 py-2 border border-gray-400 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                Kembali
            </a>
        </div>
    </form>

</div>
@endsection