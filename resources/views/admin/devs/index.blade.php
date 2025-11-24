@extends('layout.app')
@section('title', 'Client Management')
@section('content')
    <div class="bg-white shadow-md rounded-xl p-4">
        <div class="py-3 mb-3 flex justify-end">
            <a href="{{ route('admin.developer.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Create</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm" id="kelas">

                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                            No
                        </th>
                        <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                            Name
                        </th>
                        <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                            Email
                        </th>
                        <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                            Action
                        </th>
                    </tr>
                </thead>

                @foreach ($devs as $data )
                <tbody class="divide-y divide-gray-200">

                    <!-- Dummy Data 1 -->
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-center text-gray-800">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 text-center text-gray-800">{{ $data->name }}</td>
                        <td class="px-4 py-3 text-center text-gray-800">{{ $data->email }}</td>
                        <td class="px-4 py-3">
                            <div class="flex justify-center items-center gap-2">
                                <a href="#"
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

                    
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection