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
        <button class="tab-btn active-tab" data-tab="tab1">Keterangan</button>
        <button class="tab-btn" data-tab="tab2">Dokumentasi</button>
    </nav>
</div>

<!-- Tab Content -->
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

            <h3 class="font-semibold mb-4">Dokumentasi Kegiatan</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">
                <span class="font-medium">Foto Dokumentasi :</span>

                <div class="md:col-span-2 flex gap-3 flex-wrap">
                    @foreach ($lampiran as $lam)
                    @if (Str::endsWith($lam->dokumentasi, ['jpg','jpeg','png']))
                    <img src="{{ asset('storage/' . $lam->dokumentasi) }}"
                        class="w-32 h-32 object-cover rounded-lg border cursor-pointer preview-image2">
                    @else
                    <a href="{{ asset('storage/' . $lam->dokumentasi) }}"
                        target="_blank"
                        class="text-blue-500 underline">
                        Lihat File
                    </a>
                    @endif
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <!-- MODAL UNTUK PREVIEW GAMBAR -->
    <div id="image-modal"
        class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">

        <div class="relative bg-white rounded-xl shadow-xl p-3 max-w-[600px] max-h-[85vh]">

            <!-- Tombol Close -->
            <button type="button" id="close-modal"
                class="absolute -top-4 -right-4 bg-white text-gray-700 shadow-lg
                       w-9 h-9 rounded-full flex items-center justify-center
                       hover:bg-gray-100 transition text-2xl">
                &times;
            </button>

            <img id="modal-image"
                class="max-h-[80vh] max-w-full object-contain rounded-lg">
        </div>

    </div>

    <a href="{{ route('admin.laporan.index') }}"
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
        document.addEventListener('DOMContentLoaded', () => {

            const modal = document.getElementById('image-modal');
            const modalImage = document.getElementById('modal-image');
            const closeModal = document.getElementById('close-modal');

            // Buka modal jika gambar diklik
            document.querySelectorAll('.preview-image2').forEach(img => {
                img.addEventListener('click', () => {
                    modalImage.src = img.src;
                    modal.classList.remove('hidden');
                });
            });

            // Tutup modal
            closeModal.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            // Klik background untuk tutup modal
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });

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