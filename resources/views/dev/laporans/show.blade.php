@extends('layout.app')

@section('content')

<div class="w-full mt-6">
    <div class="bg-blue-600 rounded-xl p-6 shadow-lg text-white">
        <div class="flex justify-between items-start">
            <div>
                <h2 class="text-xl font-semibold">{{ $laporan->title }}</h2>
                <div class="flex gap-2 mt-2">
                    <span class="px-3 py-1 bg-blue-800 rounded text-sm">
                        {{ $laporan->client->name }}
                    </span>
                </div>
            </div>
            <div>
                <span class="px-4 py-1 bg-blue-800 rounded text-sm">
                    {{ $laporan->project->company->name }}
                </span>
            </div>
        </div>
    </div>
</div>

<!-- TABS -->
<div class="mt-6 border-b border-gray-200">
    <nav class="flex gap-6">
        <button class="tab-btn active-tab" data-tab="tab1">Keterangan</button>
        <button class="tab-btn" data-tab="tab2">Dokumentasi</button>
        <button class="tab-btn" data-tab="tab3">Customer Service</button>
    </nav>
</div>

<div class="mt-6">

    <!-- TAB 1 -->
    <div id="tab1" class="tab-content block">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="font-semibold mb-4">Detail Laporan</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">
                <span class="font-medium">Nama Project :</span>
                <span class="md:col-span-2">{{ $laporan->project->nama_project }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">
                <span class="font-medium">Developer :</span>
                <span class="md:col-span-2">{{ $laporan->developer->name ?? 'Belum ditentukan' }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">
                <span class="font-medium">Tipe :</span>
                <span class="md:col-span-2">{{ $laporan->tipe }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">
                <span class="font-medium">Prioritas :</span>
                <span class="md:col-span-2">{{ $laporan->prioritas ?? '-' }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">
                <span class="font-medium">Status :</span>
                <span class="md:col-span-2">{{ $laporan->status }}</span>
            </div>

            <div class="font-medium mt-4 mb-2">Detail kegiatan :</div>
            <div class="bg-gray-100 p-4 rounded text-sm">
                {{ $laporan->deskripsi }}
            </div>
        </div>
    </div>

    <!-- TAB 2 -->
    <div id="tab2" class="tab-content hidden">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="font-semibold mb-4">Dokumentasi Kegiatan</h3>

            <div class="flex gap-3 flex-wrap">
                @foreach ($lampiran as $lam)
                @php
                $file = $lam->dokumentasi;
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                @endphp

                {{-- GAMBAR → PREVIEW --}}
                @if (in_array($ext, ['jpg','jpeg','png']))
                <img src="{{ asset('storage/'.$file) }}"
                    class="w-32 h-32 object-cover rounded-lg border cursor-pointer preview-image">

                {{-- FILE LAIN → DOWNLOAD --}}
                @else
                <a href="{{ asset('storage/'.$file) }}"
                    download
                    class="w-32 h-32 border rounded-lg flex flex-col items-center justify-center
                              gap-1 bg-gray-50 hover:bg-gray-100">
                    <i class="fa-solid fa-download text-2xl"></i>
                    <span class="text-xs">{{ strtoupper($ext) }}</span>
                </a>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <!-- TAB 3 -->
    <div id="tab3" class="tab-content hidden">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="font-semibold mb-4">Customer Service</h3>

            <div class="bg-gray-100 p-4 rounded h-64 overflow-y-auto mb-4">
                @foreach ($messages as $msg)
                @if ($msg->sender_id == auth()->id())
                <div class="text-right mb-3">
                    <div class="inline-block bg-green-600 text-white px-3 py-2 rounded-lg">
                        {{ $msg->message }}
                    </div>
                </div>
                @else
                <div class="text-left mb-3">
                    <div class="inline-block bg-gray-300 px-3 py-2 rounded-lg">
                        {{ $msg->message }}
                    </div>
                </div>
                @endif
                @endforeach
            </div>

            <form action="{{ route('dev.laporan.sendMessage', $laporan->id) }}" method="POST">
                @csrf
                <textarea name="message" class="w-full border p-2 rounded" placeholder="Tulis pesan..."></textarea>
                <button class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">Kirim</button>
            </form>
        </div>
    </div>
</div>

<div id="image-modal"
    class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="relative bg-white rounded-xl shadow-xl p-3 max-w-[600px] max-h-[85vh]">
        <button id="close-image"
            class="absolute -top-4 -right-4 bg-white w-9 h-9 rounded-full text-2xl">&times;</button>
        <img id="modal-image" class="max-h-[80vh] max-w-full object-contain rounded-lg">
    </div>
</div>

<a href="{{ route('dev.laporan.index') }}"
    class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300 px-4 py-2 mt-6 rounded-lg">
    <i class="fa-solid fa-arrow-left"></i> Kembali
</a>

<script>
    const tabs = document.querySelectorAll('.tab-btn');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(btn => {
        btn.onclick = () => {
            tabs.forEach(b => b.classList.remove('active-tab'));
            contents.forEach(c => c.classList.add('hidden'));
            btn.classList.add('active-tab');
            document.getElementById(btn.dataset.tab).classList.remove('hidden');
        };
    });

    const modal = document.getElementById('image-modal');
    const modalImg = document.getElementById('modal-image');

    document.querySelectorAll('.preview-image').forEach(img => {
        img.onclick = () => {
            modalImg.src = img.src;
            modal.classList.remove('hidden');
        };
    });

    document.getElementById('close-image').onclick = () => {
        modal.classList.add('hidden');
        modalImg.src = '';
    };
</script>

<style>
    .tab-btn {
        padding: .75rem 1rem;
        border-bottom: 2px solid transparent;
        color: #4b5563;
        font-weight: 500;
    }

    .active-tab {
        color: #1f2937;
        border-bottom-color: #1f2937;
    }
</style>

@endsection