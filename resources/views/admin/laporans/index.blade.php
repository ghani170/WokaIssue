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
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">nama developer</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">title</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">deskripsi</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">tipe</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">prioritas</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">deadline</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

                @foreach ($laporans as $l)
                    <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-center text-gray-800">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->project->nama_project }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->client->name }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">
                        <select name="developer_id" id="">
                            <option value="" disabled selected>Pilih developer</option>
                            @foreach ($developer as $dev)
                            <option value="{{ $dev->id }}">{{ $dev->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->title }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->deskripsi }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->tipe }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">
                        <select name="prioritas" id="">
                            <option value="" disabled selected>Pilih prioritas</option>
                            <option value="Critical">Critical</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </td>
                    <td class="px-4 py-3 text-center text-gray-800">
                        @if ($l->status == 'High' || $l->status == 'Critical'  )
                        <input type="date" name="deadline" value="{{ $l->deadline ?? '' }}">
                        @endif
                    </td>
                </tr>
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