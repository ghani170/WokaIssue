<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | WokaIssue</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="icon" href="{{ asset('icon/logo-woka.png') }}" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous" />

    {{-- Hapus CDN Tailgrids jika tidak digunakan, atau pastikan CSS-nya tidak bentrok --}}

    <script src="https://cdn.jsdelivr.net/npm/tailgrids@2.3.0/plugin.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailgrids@2.3.0/assets/css/tailwind.min.css" rel="stylesheet" />

    <style>
        table.dataTable {
            border-collapse: collapse !important;
            width: 100%;
        }

        /* ... CSS DataTables Anda yang lain ... */

        table.dataTable thead th {
            background-color: #f3f4f6;
            text-align: center;
            /* bg-gray-100 */
            color: #374151;
            /* text-gray-700 */
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.75rem;
            border-bottom: 1px solid #e5e7eb;
        }

        table.dataTable tbody td {
            padding: 0.75rem;
            font-size: 0.875rem;
            color: #374151;
        }

        table.dataTable tbody tr:hover {
            background-color: #f9fafb;
            /* bg-gray-50 */
        }

        .dataTables_paginate {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            margin-top: 1rem;
        }

        .dataTables_paginate a {
            padding: 0.25rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            cursor: pointer;
            color: #4b5563;
        }

        .dataTables_paginate a:hover {
            background-color: #e5e7eb;
        }

        .dataTables_paginate .current {
            background-color: #2563eb;
            color: white;
            border-color: #2563eb;
        }

        .dataTables_filter {
            margin-bottom: 1rem;
        }

        .dataTables_filter input {
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            outline: none;
        }

        .dataTables_filter input:focus {
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.4);
        }

        .dataTables_length select {
            padding: 0.25rem 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            outline: none;
        }

        .dataTables_length select:focus {
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.4);
        }

        .dataTables_info {
            margin-top: 0.75rem;
            font-size: 0.875rem;
            color: #4b5563;
        }

        /* Styling tambahan agar dropdown header muncul dengan benar */
        .header-dropdown-container {
            position: relative;
        }
    </style>

</head>

<body class="bg-gray-50 h-full overflow-hidden"> {{-- Tambahkan overflow-hidden untuk body --}}

    <div class="flex h-full">
        <div class="flex">
            <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

            <div id="sidebar"
                class="w-64 bg-gradient-to-b from-blue-800 to-blue-900 text-white flex flex-col transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static fixed inset-y-0 left-0 z-50 -translate-x-full">
                <div class="p-6 text-xl font-bold border-b border-blue-700 flex items-center">
                    <img src="{{ asset('icon/logo-woka.png') }}" alt="WokaIssue Logo" class="w-12 h-8" />
                    <span class="bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">WokaIssue</span>
                </div>

                <nav class="flex-1 p-4 overflow-y-auto">
                    <ul class="space-y-2">
                        @php $user = Auth::user(); @endphp

                        @if ($user->role === 'admin')
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center p-3 rounded-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-md {{ request()->routeIs('admin.dashboard*') ? 'bg-blue-700 shadow-md' : '' }}">
                                <i class="fas fa-home mr-3 w-5 text-center"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.developer.index')}}"
                                class="flex items-center p-3 rounded-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-md {{ request()->routeIs('admin.developer*') ? 'bg-blue-700 shadow-md' : '' }}">
                                <i class="fa-solid fa-people-group mr-3 w-5 text-center"></i>
                                Kelola Developer
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.client.index')}}"
                                class="flex items-center p-3 rounded-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-md {{ request()->routeIs('admin.client*') ? 'bg-blue-700 shadow-md' : '' }}">
                                <i class="fa-solid fa-people-group mr-3 w-5 text-center"></i>
                                Kelola Client
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.laporan.index')}}"
                                class="flex items-center p-3 rounded-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-md {{ request()->routeIs('admin.laporan.index') ? 'bg-blue-700 shadow-md' : '' }}">
                                <i class="fa-solid fa-folder-plus mr-3 w-5 text-center"></i>
                                Laporan Masuk Client
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.laporan.activity')}}"
                                class="flex items-center p-3 rounded-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-md {{ request()->routeIs('admin.laporan.activity') ? 'bg-blue-700 shadow-md' : '' }}">
                                <i class="fa-solid fa-folder-open mr-3 w-5 text-center"></i>
                                Laporan Activity
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.project.index') }}"
                                class="flex items-center p-3 rounded-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-md {{ request()->routeIs('admin.project*') ? 'bg-blue-700 shadow-md' : '' }}">
                                <i class="fa-solid fa-bars-progress mr-3 w-5 text-center"></i>
                                Project
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.company.index') }}"
                                class="flex items-center p-3 rounded-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-md {{ request()->routeIs('admin.company*') ? 'bg-blue-700 shadow-md' : '' }}">
                                <i class="fa-solid fa-building mr-3 w-5 text-center"></i>
                                Company
                            </a>
                        </li>
                        @endif

                        @if ($user->role === 'client')
                        <li>
                            <a href="{{ route('client.dashboard') }}"
                                class="flex items-center p-3 rounded-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-md {{ request()->routeIs('client.dashboard*') ? 'bg-blue-700 shadow-md' : '' }}">
                                <i class="fas fa-home mr-3 w-5 text-center"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{route('client.laporan.index')}}"
                                class="flex items-center p-3 rounded-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-md {{ request()->routeIs('client.laporan*') ? 'bg-blue-700 shadow-md' : '' }}">
                                <i class="fa-solid fa-folder-open mr-3 w-5 text-center"></i>
                                Laporan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('client.project.index') }}"
                                class="flex items-center p-3 rounded-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-md {{ request()->routeIs('client.project*') ? 'bg-blue-700 shadow-md' : '' }}">
                                <i class="fa-solid fa-bars-progress mr-3 w-5 text-center"></i>
                                Project
                            </a>
                        </li>
                        @endif

                        @if ($user->role === 'developer')
                        <li>
                            <a href="{{ route('dev.dashboard') }}"
                                class="flex items-center p-3 rounded-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-md {{ request()->routeIs('dev.dashboard*') ? 'bg-blue-700 shadow-md' : '' }}">
                                <i class="fas fa-home mr-3 w-5 text-center"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{route('dev.laporan.index')}}"
                                class="flex items-center p-3 rounded-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-md {{ request()->routeIs('dev.laporan.index') ? 'bg-blue-700 shadow-md' : '' }}">
                                <i class="fa-solid fa-folder-open mr-3 w-5 text-center"></i>
                                Laporan Client Masuk
                            </a>
                        </li>
                        <li>
                            <a href="{{route('dev.laporan.selesai')}}"
                                class="flex items-center p-3 rounded-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-md {{ request()->routeIs('dev.laporan.selesai') ? 'bg-blue-700 shadow-md' : '' }}">
                                <i class="fa-solid fa-folder-closed mr-3 w-5 text-center"></i>
                                Laporan Client Selesai
                            </a>
                        </li>
                        <li>
                            <a href="{{route('dev.laporan.ditolak')}}"
                                class="flex items-center p-3 rounded-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-md {{ request()->routeIs('dev.laporan.ditolak') ? 'bg-blue-700 shadow-md' : '' }}">
                                <i class="fa-solid fa-folder-closed mr-3 w-5 text-center"></i>
                                Laporan Client Ditolak
                            </a>
                        </li>
                        @endif

                        <li class="mt-8 pt-4 border-t border-blue-700">
                            <form action="{{ route('logout') }}" method="POST"
                                class="flex items-center p-3 rounded-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-md">
                                @csrf
                                <button type="submit" class="flex items-center w-full">
                                    <i class="fa-solid fa-arrow-right-from-bracket mr-3 w-5 text-center"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>

                <div class="p-4 border-t border-blue-700">
                    <div class="flex items-center">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff"
                            alt="Profile" class="w-10 h-10 rounded-full ring-2 ring-blue-400">
                        <div class="ml-3">
                            <p class="font-medium truncate max-w-[140px]">{{ $user->name }}</p>
                            <p class="text-sm text-blue-200 truncate max-w-[140px]">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-1 flex flex-col overflow-y-auto min-h-screen">
            <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30"> {{-- Tambahkan sticky top-0
                dan z-30 --}}
                <div class="flex justify-between items-center p-4">
                    <div class="flex items-center">
                        <button id="sidebarToggle"
                            class="text-gray-600 focus:outline-none lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fas fa-bars text-lg"></i>
                        </button>
                        <h1 class="ml-4 text-xl font-semibold text-gray-800 hidden sm:block">
                            @yield('title', 'Dashboard')</h1>
                    </div>

                    <div class="flex items-center space-x-4">
                        {{-- Notifikasi --}}
                        <button
                            class="text-gray-500 hover:text-blue-600 p-2 rounded-full hover:bg-blue-50 transition-colors relative">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        {{-- Pesan --}}
                        <button
                            class="text-gray-500 hover:text-blue-600 p-2 rounded-full hover:bg-blue-50 transition-colors relative">
                            <i class="fas fa-envelope text-lg"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        {{-- Dropdown Profil --}}
                        <div class="relative header-dropdown-container">
                            <button id="dropdownButton"
                                class="flex items-center text-gray-700 hover:text-blue-600 focus:outline-none p-1 rounded-full hover:bg-blue-50 transition-colors">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff"
                                    alt="Profile" class="w-9 h-9 rounded-full ring-2 ring-blue-200">
                            </button>

                            <div id="dropdownMenu"
                                class="hidden absolute right-0 mt-3 w-56 origin-top-right bg-white rounded-md shadow-xl ring-1 ring-gray-200 ring-opacity-5 focus:outline-none z-40">
                                <div class="py-1">
                                    <div class="px-4 py-3 border-b border-gray-100">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $user->name }}</p>
                                        <p class="text-sm text-gray-500 truncate">{{ $user->email }}</p>
                                    </div>

                                    {{-- Menggunakan route yang disarankan pada jawaban sebelumnya, jika Anda membuatnya
                                    --}}


                                    <button id="editProfileButton"
                                        class="flex items-center w-full px-4 py-2 text-sm text-blue-600 hover:bg-blue-50 border-t border-gray-100">
                                        <i class="fas fa-edit mr-3"></i>
                                        Edit Profil
                                    </button>

                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-100 border-t border-gray-100">
                                            <i class="fas fa-sign-out-alt mr-3"></i>
                                            logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-6 overflow-y-auto">
                @yield('content')
            </main>

        </div>
    </div>
    <div id="editProfilePopup"
        class="hidden fixed bg-white/30 inset-0 flex items-center justify-center p-4 z-[9999]">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full transform transition-all">
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gray-800">Edit Profil</h3>
                <button id="closePopup" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="p-6">
                <div class="mb-6 text-center">
                    <div class="relative inline-block">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff"
                            alt="Profile" class="w-24 h-24 rounded-full ring-4 ring-blue-100 mx-auto">

                    </div>
                </div>

                <form action="{{ route('profil.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukan Password (Opsional)"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>


                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" id="cancelEdit"
                            class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @yield('scripts')

    <script>
        // Ambil data user dari PHP/Laravel
        const userName = "{{ Auth::user()->name }}";
        const userEmail = "{{ Auth::user()->email }}";

        // Perbaikan: Tempatkan logika untuk dropdown di dalam container dropdownnya, bukan di luar.
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        // Logika Dropdown
        dropdownButton.addEventListener('click', function() {
            // Memastikan dropdown berada di bawah elemen yang memicunya
            dropdownMenu.classList.toggle('hidden');
        });

        // Tutup dropdown saat klik di luar
        document.addEventListener('click', function(event) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        // Logika Popup Edit Profil
        const editProfileButton = document.getElementById('editProfileButton');
        const editProfilePopup = document.getElementById('editProfilePopup');
        const closePopup = document.getElementById('closePopup');
        const cancelEdit = document.getElementById('cancelEdit');

        editProfileButton.addEventListener('click', function() {
            editProfilePopup.classList.remove('hidden');
            dropdownMenu.classList.add('hidden'); // Tutup dropdown saat popup terbuka
        });

        // Tutup popup dari tombol X
        closePopup.addEventListener('click', function() {
            editProfilePopup.classList.add('hidden');
        });

        // Tutup popup dari tombol Batal
        cancelEdit.addEventListener('click', function() {
            editProfilePopup.classList.add('hidden');
        });

        // Tutup popup saat klik di luar konten (overlay)
        editProfilePopup.addEventListener('click', function(event) {
            if (event.target === editProfilePopup) {
                editProfilePopup.classList.add('hidden');
            }
        });

        // Script DataTables
        $(document).ready(function() {
            $('#table').DataTable();
        });

        // Script Sidebar Toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        document.getElementById('sidebarOverlay').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 1024) {
                    const sidebar = document.getElementById('sidebar');
                    const overlay = document.getElementById('sidebarOverlay');

                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>