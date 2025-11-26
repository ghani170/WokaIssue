@extends('layout.app')
@section('title', 'Laporan Client')
@section('content')
<div class="bg-white shadow-md rounded-xl p-4">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm" id="kelas">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">no</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">nama project</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">nama client</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">title</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">deskripsi</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">tipe</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">prioritas</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">deadline</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">status</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

                @foreach ($laporans as $l)
                @if ($l->status === 'Pending' || $l->status === 'Working')
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-center text-gray-800">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->project->nama_project }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->client->name }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->title }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->deskripsi }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->tipe }}</td>
                    <td class="text-center">
                        @if ($l->status == 'Low')
                        <span class="px-3 py-1 bg-gray-500 text-white rounded-lg text-xs">
                            Low
                        </span>
                        @elseif ($l->status == 'Medium')
                        <span class="px-3 py-1 bg-green-500 text-white rounded-lg text-xs">
                            Medium
                        </span>
                        @elseif ($l->status == 'High')
                        <span class="px-3 py-1 bg-cyan-500 text-white rounded-lg text-xs">
                            High
                        </span>
                        @elseif ($l->status == 'Critical')
                        <span class="px-3 py-1 bg-orange-500 text-white rounded-lg text-xs">
                            Critical
                        </span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->deadline ?? '--,--' }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">
                        <form action="{{ route('dev.laporan.updateStatus', $l->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="w-30 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black focus:border-black transition">
                                <option value="Pending" {{ $l->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Working" {{ $l->status == 'Working' ? 'selected' : '' }}>
                                    Working</option>
                                <option value="Done" {{ $l->status == 'Done' ? 'selected' : '' }}>Done</option>
                                <option value="Rejected" {{ $l->status == 'Rejected' ? 'selected' : '' }}>Reject</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endif
                @endforeach

                <!-- Dummy 1
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-center text-gray-800">1</td>
                        <td class="px-4 py-3 text-center text-gray-800">Sistem Inventaris</td>
                        <td class="px-4 py-3 text-center text-gray-800">PT Maju Jaya</td>
                        <td class="px-4 py-3 text-center text-gray-800">
                            <select name="" id="">
                                <option value="">Pilih developer</option>
                                <option value="critical">jamal</option>
                            </select>
                        </td>
                        <td class="px-4 py-3 text-center text-gray-800">Bug Fixing</td>
                        <td class="px-4 py-3 text-center text-gray-800">Tombol submit tidak berfungsi</td>
                        <td class="px-4 py-3 text-center text-gray-800">Task</td>
                        <td class="px-4 py-3 text-center text-gray-800">
                            <select name="" id="">
                                <option value="">Pilih prioritas</option>
                                <option value="critical">Critical</option>
                                <option value="high">High</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>
                            </select>
                        </td>
                        <td class="px-4 py-3 text-center text-gray-800">
                            <input type="date" name="deadline">
                        </td>
                    </tr> -->
            </tbody>
        </table>
    </div>
</div>

@endsection