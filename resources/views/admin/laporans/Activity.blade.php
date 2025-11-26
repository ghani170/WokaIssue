@extends('layout.app')

@section('title', 'Laporan Client Selesai')

@section('content')

<div class="bg-white shadow-md rounded-xl p-4">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm" id="kelas">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">no</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">nama project</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">nama client</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">nama developer</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">title</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">deskripsi</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">tipe</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">prioritas</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">deadline</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">status</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach ($laporans as $l)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-center text-gray-800">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->project->nama_project }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->client->name }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->developer->name }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->title }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->deskripsi }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->tipe }}</td>
                    <td class="text-center">
                        @if ($l->prioritas == 'Low')
                        <span class="inline-block w-20 font-bold text-center px-3 py-1 bg-yellow-500 text-white rounded-lg text-xs">
                            Low
                        </span>

                        @elseif ($l->prioritas == 'Medium')
                        <span class="inline-block w-20 font-bold text-center px-3 py-1 bg-orange-500 text-white rounded-lg text-xs">
                            Medium
                        </span>

                        @elseif ($l->prioritas == 'High')
                        <span class="inline-block w-20 font-bold text-center px-3 py-1 bg-red-500 text-white rounded-lg text-xs">
                            High
                        </span>

                        @elseif ($l->prioritas == 'Critical')
                        <span class="inline-block w-20 font-bold text-center px-3 py-1 bg-red-700 text-white rounded-lg text-xs">
                            Critical
                        </span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->deadline ?? '--,--' }}</td>
                    <td class="text-center">
                        @if ($l->status == 'Pending')
                        <span class="inline-block w-20 font-bold text-center px-3 py-1 bg-gray-500 text-white rounded-lg text-xs">
                            Pending
                        </span>
                        @elseif ($l->status == 'Working')
                        <span class="inline-block w-20 font-bold text-center px-3 py-1 bg-green-500 text-white rounded-lg text-xs">
                            Working
                        </span>
                        @elseif ($l->status == 'Done')
                        <span class="inline-block w-20 font-bold text-center px-3 py-1 bg-cyan-500 text-white rounded-lg text-xs">
                            Done
                        </span>
                        @elseif ($l->status == 'Rejected')
                        <span class="inline-block w-20 font-bold text-center px-3 py-1 bg-orange-500 text-white rounded-lg text-xs">
                            Rejected
                        </span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection