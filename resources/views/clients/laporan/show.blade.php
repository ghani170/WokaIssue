@extends('layout.app')

@section('content')

<div class="w-full mt-6">
    <div class="bg-blue-600 rounded-xl p-6 shadow-lg text-white">
        <div class="flex justify-between items-start">
            <div>
                <h2 class="text-xl font-semibold">{{ $laporan->title }}</h2>
                <div class="flex gap-2 mt-2">
                    <span class="px-3 py-1 bg-blue-800 rounded text-sm">{{ $laporan->client->name }}</span>
                </div>
            </div>
            <div>
                <span class="px-4 py-1 bg-blue-800 rounded text-sm">{{ $laporan->project->company->name }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Tabs -->
<div class="mt-6 border-b border-gray-200">
    <nav class="flex gap-6" aria-label="Tabs">
        <button class="tab-btn {{ session('active_tab') == null ? 'active-tab' : '' }}" data-tab="tab1">Keterangan</button>
        <button class="tab-btn" data-tab="tab2">Dokumentasi</button>
        <button class="tab-btn" data-tab="tab4">Lampiran Developer</button>
        <button class="tab-btn {{ session('active_tab') == 'tab3' ? 'active-tab' : '' }}" data-tab="tab3">Customer Service</button>
    </nav>
</div>


<!-- Tab Content -->
<div class="mt-6">
    <!-- TAB 1 -->
    <div id="tab1" class="tab-content {{ session('active_tab') == null ? 'block' : 'hidden' }}">
        <div class="bg-white shadow rounded-lg p-6">

            <h3 class="font-semibold mb-4">Detail Laporan</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">
                <span class="font-medium">Nama Project :</span>
                <span class="md:col-span-2">{{ $laporan->project->nama_project }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">
                <span class="font-medium">Developer yang Bertanggung jawab :</span>
                <span class="md:col-span-2">{{ $laporan->developer->name ?? 'Belum ditentukan' }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">
                <span class="font-medium">Tipe Laporan :</span>
                <span class="md:col-span-2">{{ $laporan->tipe }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">
                <span class="font-medium">Prioritas Laporan :</span>
                <span class="md:col-span-2">{{ $laporan->prioritas ?? 'Belum ditentukan' }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">
                <span class="font-medium">Status Laporan :</span>
                <span class="md:col-span-2">{{ $laporan->status }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">
                <span class="font-medium">Deadline Laporan :</span>
                <span class="md:col-span-2">{{ $laporan->deadline ?? 'Belum ditentukan' }}</span>
            </div>

            <div class="font-medium mt-4 mb-2">Detail kegiatan :</div>
            <div class="bg-gray-100 p-4 rounded">
                <p class="text-gray-700 text-sm">
                    {{ $laporan->deskripsi }}
                </p>
            </div>

        </div>
    </div>


    <!-- TAB 2 -->
    <div id="tab2" class="tab-content hidden">
        <div class="bg-white shadow rounded-lg p-6">

            <h3 class="font-semibold mb-4">Lampiran Laporan</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">
                <span class="font-medium">Foto Dokumentasi :</span>
                <div class="md:col-span-2 flex gap-3">
                    @foreach ($lampiran as $lam)
                    <img src="{{ asset('storage/' . $lam->dokumentasi ?? 'Tidak Ada Lampiran') }}"
                        class="w-32 h-32 object-cover rounded-lg mb-3 border">
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <!-- TAB 2 -->
    <div id="tab4" class="tab-content hidden">
        <div class="bg-white shadow rounded-lg p-6">

            <h3 class="font-semibold mb-4">Lampiran Developer</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">
                <span class="font-medium">Foto Dokumentasi :</span>
                <div class="md:col-span-2 flex gap-3">
                    @foreach ($lampiranDev as $lamp)
                    <img src="{{ asset('storage/' . $lamp->dokumentasi_developer ?? 'Tidak Ada Lampiran') }}"
                        class="w-32 h-32 object-cover rounded-lg mb-3 border">
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <!-- TAB 3 -->
    <div id="tab3" class="tab-content {{ session('active_tab') == 'tab3' ? 'block' : 'hidden' }}">
        <div class="bg-white shadow rounded-lg p-6">

            <h3 class="font-semibold mb-4">Customer Service</h3>

            {{-- LIST PESAN --}}
            <div class="bg-gray-100 p-4 rounded h-64 overflow-y-auto mb-4">
                @foreach ($messages as $msg)

                {{-- Pesan milik user yang sedang login --}}
                @if ($msg->sender_id == auth()->id())

                <div class="text-right mb-3">
                    <div class="inline-block bg-blue-600 text-white px-3 py-2 rounded-lg">
                        {{ $msg->message }}
                    </div>
                    <div class="text-xs text-gray-500">
                        {{ \Carbon\Carbon::parse($msg->created_at)->diffForHumans() }}
                    </div>
                </div>

                @else
                {{-- Pesan dari developer --}}
                <div class="text-left mb-3">
                    <div class="inline-block bg-white text-gray-800 px-3 py-2 rounded-lg shadow">
                        {{ $msg->message }}
                    </div>
                    <div class="text-xs text-gray-500">
                        {{ \Carbon\Carbon::parse($msg->created_at)->diffForHumans() }}
                    </div>
                </div>
                @endif

                @endforeach

            </div>

            {{-- FORM KIRIM PESAN --}}
            <form action="{{ route('client.laporan.sendMessage', $laporan->id) }}" method="POST">
                @csrf
                <textarea name="message" class="w-full border p-2 rounded" placeholder="Tulis pesan..."></textarea>
                <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">Kirim</button>
            </form>

        </div>
    </div>

</div>
<a href="{{ route('client.laporan.index') }}"
    class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 mt-4 rounded-lg mb-4">
    <i class="mt-1 fa-solid fa-arrow-left"></i> Kembali
</a>



{{-- Tailwind Tab Script --}}
<script>
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    function activateTab(tab) {
        tabButtons.forEach(btn => btn.classList.remove('active-tab'));
        tabContents.forEach(c => c.classList.add('hidden'));

        document.querySelector(`[data-tab="${tab}"]`).classList.add('active-tab');
        document.getElementById(tab).classList.remove('hidden');
    }

    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => activateTab(btn.dataset.tab));
    });
    document.addEventListener('DOMContentLoaded', function() {
    const activeTab = "{{ session('active_tab') }}";
    if (activeTab) return;
    activateTab("tab1");
});

</script>

<style>
    .tab-btn {
        padding: 0.75rem 1rem;
        font-weight: 500;
        border-bottom: 2px solid transparent;
        color: #4b5563;
    }

    .active-tab {
        color: #1f2937;
        border-bottom-color: #1f2937;
    }
</style>


@endsection