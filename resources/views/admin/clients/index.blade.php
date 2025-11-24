@extends('layout.app')
@section('title', 'Client Management')
@section('content')
    <div class="bg-white shadow-md rounded-xl p-4">
        <div class="py-3 mb-3 flex justify-end">
            <a href="{{ route('admin.client.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Create</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm" id="kelas">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                            Kelas
                        </th>
                        <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                            Created-at
                        </th>
                        <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">

                    <!-- Dummy Data 1 -->
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-center text-gray-800">XI RPL 1</td>
                        <td class="px-4 py-3 text-center text-gray-800">12-11-2025 09:30</td>
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

                    <!-- Dummy Data 2 -->
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-center text-gray-800">XI RPL 2</td>
                        <td class="px-4 py-3 text-center text-gray-800">10-11-2025 14:22</td>
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

                    <!-- Dummy Data 3 -->
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-center text-gray-800">X TKJ 1</td>
                        <td class="px-4 py-3 text-center text-gray-800">05-11-2025 08:10</td>
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
            </table>
        </div>
    </div>
@endsection