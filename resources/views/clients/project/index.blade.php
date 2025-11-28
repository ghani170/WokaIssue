@extends('layout.app')
@section('title', 'Project')
@section('content')
<div class="bg-white shadow-md rounded-xl p-4">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm" id="table">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">no</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">nama perusahaan</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">nama project</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">deskripsi</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">status</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

                @foreach ($project as $l)
                    <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-center text-gray-800">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->company->name }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->nama_project }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->deskripsi }}</td>
                    <td class="text-center">
                        <span class="px-3 py-1 {{ $l->status == 'Active' ? 'bg-green-500' : ($l->status == 'Maintenance' ? 'bg-yellow-500' : 'bg-red-500') }} text-white font-bold rounded-lg text-md">
                            {{ $l->status }}
                        </span>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection