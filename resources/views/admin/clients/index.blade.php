@extends('layout.app')
@section('title', 'Client Management')
@section('content')
    <div class="py-3 mb-3 flex justify-end">
        <a href="{{ route('admin.developer.create') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Create</a>
    </div>
    @if (session('success'))
    <div class="container py-16">
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
    
    @endif
    <div class="bg-white shadow-md rounded-xl p-4">

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
                            Nama Perusahan
                        </th>
                        <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">
                            Action
                        </th>
                    </tr>
                </thead>

                @foreach ($clients as $data)
                    <tbody class="divide-y divide-gray-200">

                        <!-- Dummy Data 1 -->
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-center text-gray-800">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-center text-gray-800">{{ $data->name }}</td>
                            <td class="px-4 py-3 text-center text-gray-800">{{ $data->email }}</td>
                            <td class="px-4 py-3 text-center text-gray-800">{{ $data->company->name }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('admin.client.edit', $data->id) }}"
                                        class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded-md text-xs font-medium transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.developer.destroy', $data->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md text-xs font-medium transition"
                                            data-toggle="tooltip" data-original-title="Delete product">
                                            Delete
                                        </button>
                                    </form>
                                    
                                </div>
                            </td>
                        </tr>


                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection