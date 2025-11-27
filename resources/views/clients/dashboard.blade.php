@extends('layout.app')
@section('title', 'Clients Dashboard')
@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full">
    <!-- Card 1 -->
    <div class="bg-white rounded-xl shadow-md p-4">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-600">Total Laporan</p>
                <h4 class="text-2xl font-semibold">{{ $totalLaporan }}</h4>
            </div>
            <div class="bg-blue-800 text-white p-3 rounded-lg shadow">
                <i class="fa-solid fa-folder-open px-1 py-1"></i>
            </div>
        </div>

        <hr class="my-3">

        <p class="text-sm">
            Lihat <span class="font-semibold text-yellow-600"><a href="{{ route('client.laporan.index') }}"></a>Laporan</span> 
        </p>
    </div>

    <!-- Card 2 -->
    <div class="bg-white rounded-xl shadow-md p-4">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-600">Total Project</p>
                <h4 class="text-2xl font-semibold">{{ $totalProject }}</h4>
            </div>
            <div class="bg-blue-800 text-white p-3 rounded-lg shadow">
                <i class="fa-solid fa-bars-progress px-1 py-1"></i>
            </div>
        </div>

        <hr class="my-3">

        <p class="text-sm">
            Lihat <span class="font-semibold text-green-600"><a href="{{ route('client.project.index') }}"></a>Project</span>
        </p>
    </div>
</div>

@endsection