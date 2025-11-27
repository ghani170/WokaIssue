@extends('layout.app')

@section('title','Company')

@section('content')
<div class="bg-white shadow-md rounded-xl p-4">
    <div class="py-3 mb-3 flex justify-end">
        @if (session('success'))
        <div id="alert-box" class="container">
            <div class="inline-flex rounded-lg bg-green-light-6 px-[18px] py-4">
                <p class="flex items-center text-sm font-medium text-[#004434]">
                    <span class="mr-3 flex h-5 w-5 items-center justify-center rounded-full bg-green">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_961_15641)">
                                <path
                                    d="M6.00002 0.337494C2.86877 0.337494 0.337524 2.86874 0.337524 5.99999C0.337524 9.13124 2.86877 11.6812 6.00002 11.6812C9.13128 11.6812 11.6813 9.13124 11.6813 5.99999C11.6813 2.86874 9.13128 0.337494 6.00002 0.337494ZM6.00002 10.8375C3.33752 10.8375 1.18127 8.66249 1.18127 5.99999C1.18127 3.33749 3.33752 1.18124 6.00002 1.18124C8.66252 1.18124 10.8375 3.35624 10.8375 6.01874C10.8375 8.66249 8.66252 10.8375 6.00002 10.8375Z"
                                    fill="white" />
                                <path
                                    d="M7.61255 4.25624L5.3813 6.43124L4.3688 5.43749C4.20005 5.26874 3.93755 5.28749 3.7688 5.43749C3.60005 5.60624 3.6188 5.86874 3.7688 6.03749L4.9688 7.19999C5.0813 7.31249 5.2313 7.36874 5.3813 7.36874C5.5313 7.36874 5.6813 7.31249 5.7938 7.19999L8.21255 4.87499C8.3813 4.70624 8.3813 4.44374 8.21255 4.27499C8.0438 4.10624 7.7813 4.10624 7.61255 4.25624Z"
                                    fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_961_15641">
                                    <rect width="12" height="12" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </span>
                    {{ session('success') }}
                </p>
            </div>
        </div>
        @elseif(session('error'))
        <div id="alert-box" class="container">
            <div
                class="inline-flex rounded-lg bg-red-light-6 px-[18px] py-4 shadow-[0px_2px_10px_0px_rgba(0,0,0,0.08)]">
                <p class="flex items-center text-sm font-medium text-[#BC1C21]">
                    <span class="mr-3 flex h-5 w-5 items-center justify-center rounded-full bg-red">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_961_15656)">
                                <path
                                    d="M6 0.337494C2.86875 0.337494 0.3375 2.86874 0.3375 5.99999C0.3375 9.13124 2.86875 11.6812 6 11.6812C9.13125 11.6812 11.6813 9.13124 11.6813 5.99999C11.6813 2.86874 9.13125 0.337494 6 0.337494ZM6 10.8375C3.3375 10.8375 1.18125 8.66249 1.18125 5.99999C1.18125 3.33749 3.3375 1.18124 6 1.18124C8.6625 1.18124 10.8375 3.35624 10.8375 6.01874C10.8375 8.66249 8.6625 10.8375 6 10.8375Z"
                                    fill="white" />
                                <path
                                    d="M7.725 4.25625C7.55625 4.0875 7.29375 4.0875 7.125 4.25625L6 5.4L4.85625 4.25625C4.6875 4.0875 4.425 4.0875 4.25625 4.25625C4.0875 4.425 4.0875 4.6875 4.25625 4.85625L5.4 6L4.25625 7.14375C4.0875 7.3125 4.0875 7.575 4.25625 7.74375C4.33125 7.81875 4.44375 7.875 4.55625 7.875C4.66875 7.875 4.78125 7.8375 4.85625 7.74375L6 6.6L7.14375 7.74375C7.21875 7.81875 7.33125 7.875 7.44375 7.875C7.55625 7.875 7.66875 7.8375 7.74375 7.74375C7.9125 7.575 7.9125 7.3125 7.74375 7.14375L6.6 6L7.74375 4.85625C7.89375 4.6875 7.89375 4.425 7.725 4.25625Z"
                                    fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_961_15656">
                                    <rect width="12" height="12" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </span>
                    {{ session('error') }}
                </p>
            </div>

        </div>

        @endif
        <a href="{{ route('admin.company.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Create</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm" id="table">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                        No
                    </th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                        Nama Perusahaan
                    </th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                        Alamat
                    </th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                        Telepon
                    </th>
                    </th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                        Action
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach ($company as $data)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $data->name}}</td>
                    <td class="text-center">{{ $data->alamat }}</td>
                    <td class="text-center">{{ $data->telepon }}</td>
                    <td class="px-4 py-3">
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ route('admin.company.edit', $data->id ) }}"
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

                @endforeach

            </tbody>
        </table>
    </div>
</div>
<script>
    setTimeout(() => {
        const alertBox = document.getElementById('alert-box');
        if (alertBox) {
            alertBox.style.transition = "opacity 0.5s ease";
            alertBox.style.opacity = "0";
            setTimeout(() => alertBox.remove(), 500);
        }
    }, 3000);
</script>
@endsection