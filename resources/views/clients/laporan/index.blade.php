@extends('layout.app')

@section('title','Laporan')

@section('content')
<div class="bg-white shadow-md rounded-xl p-4">
    <div class="py-3 mb-3 flex justify-end">
        <a href="{{ route('client.laporan.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Create</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm" id="kelas">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                        No
                    </th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                        Nama Project
                    </th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                        Company
                    </th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                        Title
                    </th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                        Tipe
                    </th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                        Status
                    </th>
                    </th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                        Action
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach ($laporans as $data)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $data->project->nama_project }}</td>
                    <td class="text-center">{{ $data->project->company->name }}</td>
                    <td class="text-center">{{ $data->title }}</td>
                    <td class="text-center">{{ $data->tipe }}</td>
                    <td class="text-center font-bold">
                        <span
                            class="px-3 py-1 {{ $data->status == 'Pending' ? 'bg-gray-500 inline-block w-20' : ($data->status == 'Working' ? 'bg-green-500 inline-block w-20' : ($data->status == 'Done' ? 'bg-cyan-500 inline-block w-20' : 'bg-orange-500 inline-block w-20')) }} text-white rounded-lg text-xs">
                            {{ $data->status }}
                        </span>

                    <td class="px-4 py-3">
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ route('client.laporan.show', $data->id) }}"
                                class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded-md text-xs font-medium transition">
                                Detail
                            </a>
                            <a href="{{ route('client.laporan.edit', $data->id) }}"
                                class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded-md text-xs font-medium transition">
                                Edit
                            </a>
                            <form action="{{ route('client.laporan.destroy', $data->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md text-xs font-medium transition">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection