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
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->company_id }}</td>
                    <td>{{ $data->project_id }}</td>
                    <td>{{ $data->deskripsi }}</td>
                    <td>{{ $data->status }}</td>
                    <td class="text-center">
                        <a href="" class="btn btn-sm btn-warning me-2">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus dudi ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
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