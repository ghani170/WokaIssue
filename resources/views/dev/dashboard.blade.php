@extends('layout.app')

@section('title', 'Developers Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-2 gap-4">

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
            Lihat <span class="font-semibold text-yellow-600">Laporan</span> Client
        </p>
    </div>

    <!-- Card 2 -->
    <div class="bg-white rounded-xl shadow-md p-4">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-600">Total Laporan Selesai</p>
                <h4 class="text-2xl font-semibold">{{ $totalLK }}</h4>
            </div>
            <div class="bg-black text-white p-3 rounded-lg shadow">
                <i class="fa-solid fa-folder-closed px-1 py-1"></i>
            </div>
        </div>

        <hr class="my-3">

        <p class="text-sm">
            Lihat <span class="font-semibold text-green-600">Laporan Client</span> Selesai
        </p>
    </div>

</div>
@endsection