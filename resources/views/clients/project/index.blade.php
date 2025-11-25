@extends('layout.app')

@section('title','Project')

@section('content')
<div class="bg-white shadow-md rounded-xl p-7">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm" id="kelas">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs ">
                        No
                    </th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                        Nama Perusahaan
                    </th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                        Nama Project
                    </th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                        Deskripsi
                    </th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                        Status
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse ($project as $data)
                <tr>
                    <td class="text text-center">{{ $loop->iteration }}</td>
                    <td class="text text-center">{{ $data->company->name }}</td>
                    <td class="text text-center">{{ $data->nama_project }}</td>
                    <td class="text text-center">{{ $data->deskripsi }}</td>
                    <td class="text-center">
                        <span class="px-3 py-1 bg-green-500 text-white rounded-lg text-xs">
                            {{ $data->status }}
                        </span>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-3">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection