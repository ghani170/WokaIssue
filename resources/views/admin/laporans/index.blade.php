@extends('layout.app')
@section('title', 'Laporan Client')
@section('content')
<div class="bg-white shadow-md rounded-xl p-4">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm" id="table-laporan">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">no</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">nama project</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">nama client</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">nama developer</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">tipe</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">prioritas</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">deadline</th>
                    <th class="px-4 py-3 text-center text-gray-600 font-semibold uppercase text-xs">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

                @foreach ($laporans as $l)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-center text-gray-800">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->project->nama_project }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->client->name }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">
                        <form action="{{ route('admin.laporan.updateDeveloper', $l->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="developer_id" onchange="this.form.submit()" class="w-30 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2
                                                focus:ring-black focus:border-black transition" id="">
                                <option value="">Pilih Developer</option>
                                @foreach ($developer as $dev)
                                <option value="{{ $dev->id }}" @if ($l->developer_id == $dev->id) selected @endif>{{ $dev->name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td class="px-4 py-3 text-center text-gray-800">{{ $l->tipe }}</td>
                    <td class="px-4 py-3 text-center text-gray-800">
                        <form action="{{ route('admin.laporan.updatePrioritas', $l->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="prioritas" onchange="this.form.submit()" class="w-30 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2
                                                focus:ring-black focus:border-black transition" id="">
                                <option value="">Pilih Prioritas</option>
                                <option value="Low" {{ $l->prioritas == 'Low' ? 'selected' : '' }}>Low</option>
                                <option value="Medium" {{ $l->prioritas == 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="High" {{ $l->prioritas == 'High' ? 'selected' : '' }}>High</option>
                                <option value="Critical" {{ $l->prioritas == 'Critical' ? 'selected' : '' }}>Critical
                                </option>
                            </select>
                        </form>
                    </td>
                    <td class="px-4 py-3 text-center text-gray-800">
                        @if ($l->prioritas == 'High' || $l->prioritas == 'Critical')
                        <form action="{{ route('admin.laporan.update', $l->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input class="w-31 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2
                                                    focus:ring-black focus:border-black transition" type="date" name="deadline"
                                value="{{ $l->deadline ?? '' }}" onchange="this.form.submit()">
                        </form>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ route('admin.laporan.show', $l->id) }}"
                                class="px-3 py-1 bg-blue-400 hover:bg-blue-500 text-white rounded-md text-md font-medium transition">
                                Detail
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
        <script>
            if (document.getElementById("table-laporan") && typeof simpleDatatables.DataTable !== 'undefined') {
                const dataTable = new simpleDatatables.DataTable("#search-table", {
                    searchable: true,
                    sortable: false
                });
            }
        </script>
    </div>
</div>

@endsection