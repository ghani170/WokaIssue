@extends('layout.app')
@section('title', 'Laporan Client')
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
                        <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">lampiran</th>
                        <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">

                    @foreach ($laporans as $l)
                        {{-- jika DONE dan lampiran SUDAH ADA (via relasi) → jangan tampilkan --}}
                        @if ($l->status === 'Done' && $l->lampiranDev->isNotEmpty())
                            @continue
                        @endif
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-center text-gray-800">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-center text-gray-800">{{ $l->project->nama_project }}</td>
                            <td class="px-4 py-3 text-center text-gray-800">{{ $l->client->name }}</td>
                            <td class="px-4 py-3 text-center text-gray-800">{{ $l->tipe }}</td>
                            <td class="text-center">
                                <span
                                    class="px-3 py-1 {{ $l->prioritas == 'Low' ? 'bg-yellow-500 inline-block w-20' : ($l->prioritas == 'Medium' ? 'bg-orange-500 inline-block w-20' : ($l->prioritas == 'High' ? 'bg-red-500 inline-block w-20' : 'bg-red-700 inline-block w-20')) }} text-white font-bold rounded-lg text-xs">
                                    {{ $l->prioritas ?? '--//--' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-800">{{ $l->deadline ?? '--,--' }}</td>
                            <td class="px-4 py-3 text-center text-gray-800">
                                <form action="{{ route('dev.laporan.updateStatus', $l->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()"
                                        class="w-30 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black focus:border-black transition">
                                        <option value="Pending" {{ $l->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Working" {{ $l->status == 'Working' ? 'selected' : '' }}>Working</option>
                                        <option value="Done" {{ $l->status == 'Done' ? 'selected' : '' }}>Done</option>
                                        <option value="Rejected" {{ $l->status == 'Rejected' ? 'selected' : '' }}>Reject</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                @if ($l->status === 'Done' && !$l->lampiranDev->isNotEmpty())
                                            <form action="{{ route('dev.laporan.uploadLampiran', $l->id) }}" method="POST"
                                                enctype="multipart/form-data" class="flex items-center space-x-2">
                                                @csrf
                                                @method('PUT')

                                                <input class="block w-full text-sm text-gray-900 
                                       border border-gray-300 rounded-lg cursor-pointer 
                                       bg-gray-50 p-1.5 file:mr-4 file:py-1 file:px-2 
                                       file:rounded-md file:border-0 file:text-sm file:font-semibold
                                       file:bg-indigo-50 file:text-indigo-700 
                                       hover:file:bg-indigo-100 transition duration-150" id="file_input" type="file" name="file">

                                                <button type="submit" class="px-3 py-1.5 
                                       bg-green-600 text-white font-semibold text-sm
                                       rounded-lg shadow-md 
                                       hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2
                                       transition ease-in-out duration-150">
                                                    Upload
                                                </button>
                                            </form>
                                @endif
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection