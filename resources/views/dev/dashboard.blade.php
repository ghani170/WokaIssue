@extends('layout.app')

@section('title', 'Developers Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">

    <!-- Card 1 -->
    <div class="bg-white rounded-xl shadow-md p-4">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-600">Total Laporan Masuk</p>
                <h4 class="text-2xl font-semibold">{{ $totalLM }}</h4>
            </div>
            <div class="bg-black text-white p-3 rounded-lg shadow">
                <i class="fa-solid fa-folder-open px-1 py-1"></i>
            </div>
        </div>

        <hr class="my-3">

        <p class="text-sm">
            Lihat <span class="font-semibold text-yellow-600"><a href="{{ route('dev.laporan.index') }}">Laporan</a></span> Client
        </p>
    </div>

    <div class="bg-white rounded-xl shadow-md p-4">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-600">Total Laporan Ditolak</p>
                <h4 class="text-2xl font-semibold">{{ $totalLD }}</h4>
            </div>
            <div class="bg-black text-white p-3 rounded-lg shadow">
                <i class="fa-solid fa-folder-open px-1 py-1"></i>
            </div>
        </div>

        <hr class="my-3">

        <p class="text-sm">
            Lihat <span class="font-semibold text-yellow-600"><a href="{{ route('dev.laporan.selesai') }}">Laporan</a></span>
        </p>
    </div>

    <!-- Card 2 -->
    <div class="bg-white rounded-xl shadow-md p-4">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-600">Total Laporan Selesai</p>
                <h4 class="text-2xl font-semibold">{{ $totalLS }}</h4>
            </div>
            <div class="bg-black text-white p-3 rounded-lg shadow">
                <i class="fa-solid fa-folder-closed px-1 py-1"></i>
            </div>
        </div>

        <hr class="my-3">

        <p class="text-sm">
            Lihat <span class="font-semibold text-green-600"><a href="{{ route('dev.laporan.selesai') }}">Laporan Selesai</a></span>
        </p>
    </div>

</div>
@endsection