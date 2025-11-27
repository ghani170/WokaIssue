@extends('layout.app')

@section('title', 'Laporan Client Selesai')

@section('content')

<div class="bg-white shadow-md rounded-xl p-4">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm" id="table">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">no</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">nama project</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">nama client</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">tipe</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">prioritas</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">deadline</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">status</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach ($laporans as $l)
                @if ($l->status === 'Done')
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-center text-gray-800">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->project->nama_project }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->client->name }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->tipe }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">
                        <span class="px-3 py-1 {{ $l->prioritas == 'Low' ? 'bg-yellow-500 inline-block w-20' : ($l->prioritas == 'Medium' ? 'bg-orange-500 inline-block w-20' : ($l->prioritas == 'High' ? 'bg-red-500 inline-block w-20' : 'bg-red-700 inline-block w-20')) }} text-white font-bold rounded-lg text-xs">
                            {{ $l->prioritas }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->deadline ?? '--,--' }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">
                        <span class="px-3 py-1 {{ $l->status == 'Pending' ? 'bg-gray-500 inline-block w-20' : ($l->status == 'Working' ? 'bg-green-500 inline-block w-20' : ($l->status == 'Done' ? 'bg-cyan-500 inline-block w-20' : 'bg-orange-500 inline-block w-20')) }} text-white font-bold rounded-lg text-xs">
                            {{ $l->status }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ route('dev.laporan.show', $l->id) }}"
                                class="px-3 py-1 bg-blue-400 hover:bg-blue-500 text-white rounded-md text-md font-medium transition">
                                Detail
                            </a>
                        </div>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection