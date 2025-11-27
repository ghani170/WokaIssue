@extends('layout.app')

@section('title', 'Admin Dashboard')

@section('content')

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">


        <!-- Card 1 -->
        <div class="bg-white rounded-xl shadow-md p-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-600">Total Laporan Masuk</p>
                    <h4 class="text-2xl font-semibold">{{ $totalLM }}</h4>
                </div>
                <div class="bg-blue-800 text-white p-3 rounded-lg shadow">
                    <i class="fa-solid fa-folder-open px-1 py-1"></i>
                </div>
            </div>

            <hr class="my-3">

            <p class="text-sm">
                Lihat <span class="font-semibold text-yellow-600"><a href="{{ route('admin.laporan.index') }}">Laporan</a></span> Client
            </p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-xl shadow-md p-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-600">Total Laporan Selesai</p>
                    <h4 class="text-2xl font-semibold">{{ $totalLK }}</h4>
                </div>
                <div class="bg-blue-800 text-white p-3 rounded-lg shadow">
                    <i class="fa-solid fa-folder-open px-1 py-1"></i>
                </div>
            </div>

            <hr class="my-3">

            <p class="text-sm">
                Lihat <span class="font-semibold text-green-600"><a href="{{ route('admin.laporan.activity') }}">Laporan Client</a></span> Selesai
            </p>
        </div>

        <!-- Card 3 -->
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
                Lihat Daftar <span class="font-semibold text-cyan-600"><a href="{{ route('admin.project.index') }}">Project</a></span>
            </p>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-xl shadow-md p-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-600">Total Company</p>
                    <h4 class="text-2xl font-semibold">{{ $totalCompany }}</h4>
                </div>
                <div class="bg-blue-800 text-white p-3 rounded-lg shadow">
                    <i class="fa-solid fa-building px-1 py-1"></i>
                </div>
            </div>

            <hr class="my-3">

            <p class="text-sm">
                LIhat <span class="font-semibold text-red-600"><a href="{{ route('admin.company.index') }}">Company</a></span>
            </p>
        </div>


    </div>
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-4">

        <div class="lg:col-span-1 bg-white rounded-xl shadow-md p-6">
            <h3 class="text-xl font-semibold mb-4 text-gray-700">Prioritas Laporan</h3>
            <hr class="mb-4">
            <div class="relative h-64">
                <canvas id="laporanStatusChart"></canvas>
            </div>
        </div>

        <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-4">
            <h3 class="text-lg font-semibold mb-4">5 Laporan Masuk Terbaru</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Client</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Project
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($laporanLatest as $report)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $report->client->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $report->project->nama_project }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $report->created_at->format('d M y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @php
                                        // Tentukan warna badge berdasarkan status
                                        $color = [
                                            'Pending' => 'bg-yellow-100 text-yellow-800',
                                            'Working' => 'bg-blue-100 text-blue-800',
                                            'Done' => 'bg-green-100 text-green-800',
                                            'Rejected' => 'bg-red-100 text-red-800'
                                        ][$report->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                        {{ $report->status }}
                                    </span>

                                    
                                </td>
                                
                            </tr>
                        @endforeach

                        @if ($laporanLatest->isEmpty())
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Belum ada laporan terbaru yang masuk.
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
            <div class="text-right mt-4">
                <a href="{{ route('admin.laporan.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat Semua Laporan →</a>
            </div>
        </div>
    </div>
    </div>

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            // Data dari Controller
            const dataLow = {{ $laporanLow ?? 0 }};
            const dataMedium = {{ $laporanMedium ?? 0 }};
            const dataHigh = {{ $laporanHigh ?? 0 }};
            const dataCritical = {{ $laporanCritical ?? 0 }};

            const ctx = document.getElementById('laporanStatusChart');

            // Buat Grafik Donut/Doughnut Chart
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Low', 'Medium', 'High', 'Critical'],
                    datasets: [{
                        label: 'Jumlah Laporan',
                        data: [dataLow, dataMedium, dataHigh, dataCritical],
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(248, 97, 97, 0.8)',
                            'rgba(185, 36, 16, 0.8)',
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Penting agar grafik mengisi div
                    plugins: {
                        legend: {
                            position: 'bottom', // Letakkan legenda di bawah
                        },
                        title: {
                            display: false,
                            text: 'Status Laporan'
                        }
                    }
                }
            });
        </script>
    @endsection
@endsection