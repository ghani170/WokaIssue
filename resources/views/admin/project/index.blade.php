@extends('layout.app')

@section('title','Project')

@section('content')
<div class="bg-white shadow-md rounded-xl p-4">
    <div class="py-3 mb-3 flex justify-end">
        <a href="{{ route('admin.project.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Create</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm" id="kelas">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
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
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                        Action
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
                    <td class="text text-center">{{ $data->status }}</td>
                    <td class="px-4 py-3">
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ route('admin.project.edit', $data->id) }}"
                                class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded-md text-xs font-medium transition">
                                Edit
                            </a>
                            <button
                                class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md text-xs font-medium transition">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        <i class="bi bi-info-circle"></i> Belum ada data Project.
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
@endsection