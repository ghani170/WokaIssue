@extends('layout.app')
@section('title', 'Detail Laporan')
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
    <nav class="flex gap-6">
        <button class="tab-btn active-tab" data-tab="tab1">Keterangan</button>
        <button class="tab-btn" data-tab="tab2">Dokumentasi</button>
        <button class="tab-btn" data-tab="tab4">Lampiran Developer</button>
        <button class="tab-btn" data-tab="tab3">Customer Service</button>
    </nav>
</div>

<!-- Tab Content -->
<div class="mt-6">

    <!-- TAB 1 -->
    <div id="tab1" class="tab-content">
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

            <div class="font-medium mt-4 mb-2">Detail kegiatan :</div>
            <div class="bg-gray-100 p-4 rounded">
                {{ $laporan->deskripsi }}
            </div>
        </div>
    </div>

    <!-- TAB 2 -->
    <div id="tab2" class="tab-content hidden">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="font-semibold mb-4">Lampiran Laporan</h3>

            <div class="flex gap-3 flex-wrap">
                @foreach ($lampiran as $lam)
                @if (Str::endsWith($lam->dokumentasi, ['jpg','jpeg','png']))
                <img src="{{ asset('storage/'.$lam->dokumentasi) }}"
                    class="w-32 h-32 object-cover rounded-lg border cursor-pointer preview-image2">
                @else
                <a href="{{ asset('storage/'.$lam->dokumentasi) }}"
                    download
                    class="w-32 h-32 border rounded-lg flex flex-col items-center justify-center
                                  bg-gray-50 hover:bg-gray-100 text-gray-700">
                    <i class="fa-solid fa-download text-2xl"></i>
                    <span class="text-xs mt-1">Download</span>
                </a>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <!-- TAB 4 -->
    <div id="tab4" class="tab-content hidden">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="font-semibold mb-4">Lampiran Developer</h3>

            <div class="flex gap-3 flex-wrap">
                @foreach ($lampiranDev as $lamp)
                @if (Str::endsWith($lamp->dokumentasi_developer, ['jpg','jpeg','png']))
                <img src="{{ asset('storage/'.$lamp->dokumentasi_developer) }}"
                    class="w-32 h-32 object-cover rounded-lg border cursor-pointer preview-image2">
                @else
                <a href="{{ asset('storage/'.$lamp->dokumentasi_developer) }}"
                    download
                    class="w-32 h-32 border rounded-lg flex flex-col items-center justify-center
                                  bg-gray-50 hover:bg-gray-100 text-gray-700">
                    <i class="fa-solid fa-download text-2xl"></i>
                    <span class="text-xs mt-1">Download</span>
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
                <div class="{{ $msg->sender_id == auth()->id() ? 'text-right' : 'text-left' }} mb-2">
                    <div class="inline-block px-3 py-2 rounded-lg
                            {{ $msg->sender_id == auth()->id() ? 'bg-blue-600 text-white' : 'bg-white shadow' }}">
                        {{ $msg->message }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- MODAL PREVIEW GAMBAR -->
<div id="image-modal"
    class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="relative bg-white rounded-xl p-3">
        <button id="close-modal"
            class="absolute -top-4 -right-4 bg-white w-9 h-9 rounded-full text-2xl">&times;</button>
        <img id="modal-image" class="max-h-[80vh] max-w-full rounded">
    </div>
</div>

<script>
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabs = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            tabBtns.forEach(b => b.classList.remove('active-tab'));
            tabs.forEach(t => t.classList.add('hidden'));
            btn.classList.add('active-tab');
            document.getElementById(btn.dataset.tab).classList.remove('hidden');
        });
    });

    const modal = document.getElementById('image-modal');
    const modalImg = document.getElementById('modal-image');

    document.querySelectorAll('.preview-image2').forEach(img => {
        img.onclick = () => {
            modalImg.src = img.src;
            modal.classList.remove('hidden');
        };
    });

    document.getElementById('close-modal').onclick = () => modal.classList.add('hidden');
</script>

<style>
    .tab-btn {
        padding: .75rem 1rem;
        font-weight: 500;
        color: #6b7280
    }

    .active-tab {
        border-bottom: 2px solid #111827;
        color: #111827
    }
</style>

@endsection