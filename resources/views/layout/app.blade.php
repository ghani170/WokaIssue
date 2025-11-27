<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous" />

    <script src="https://cdn.jsdelivr.net/npm/tailgrids@2.3.0/plugin.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailgrids@2.3.0/assets/css/tailwind.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-50 h-full">
    <!-- Sidebar -->
    <div class="flex h-full">
        <!-- Overlay untuk mobile -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>
        
        <!-- Sidebar -->
        <div id="sidebar" class="w-64 bg-gradient-to-b from-blue-800 to-blue-900 text-white flex flex-col transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static fixed inset-y-0 left-0 z-50 -translate-x-full">
            <!-- Logo -->
            <div class="p-6 text-xl font-bold border-b border-blue-700 flex items-center">
                <i class="fas fa-chart-line mr-3 text-blue-300"></i>
                <span class="bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">WokaIssue</span>
            </div>

            <!-- Menu Navigasi -->
            <nav class="flex-1 p-4 overflow-y-auto">
                <ul class="space-y-2">
                    <!-- Sidebar admin -->
                    @if (auth()->user()->role === 'admin')
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

                    <!-- Sidebar client -->
                    @if (auth()->user()->role === 'client')
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

                    <!-- Sidebar developer -->
                    @if (auth()->user()->role === 'developer')
                    <li>
                        <a href="{{ route('dev.dashboard') }}"
                            class="flex items-center p-3 rounded-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-md {{ request()->routeIs('dev.dashboard*') ? 'bg-blue-700 shadow-md' : '' }}">
                            <i class="fas fa-home mr-3 w-5 text-center"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('dev.laporan.index')}}"
                            class="flex items-center p-3 rounded-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-md {{ request()->routeIs('dev.laporan.index') ? 'bg-blue-700 shadow-md' : '' }}" >
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
                    
                    <!-- Logout Button -->
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

            <!-- User Profile -->
            <div class="p-4 border-t border-blue-700">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff" 
                         alt="Profile" class="w-10 h-10 rounded-full ring-2 ring-blue-400">
                    <div class="ml-3">
                        <p class="font-medium truncate max-w-[140px]">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-blue-200 truncate max-w-[140px]">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden min-h-screen">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex justify-between items-center p-4">
                    <div class="flex items-center">
                        <button id="sidebarToggle" class="text-gray-600 focus:outline-none lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fas fa-bars text-lg"></i>
                        </button>
                        <h1 class="ml-4 text-xl font-semibold text-gray-800 hidden sm:block">@yield('title', 'Dashboard')</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="text-gray-500 hover:text-blue-600 p-2 rounded-full hover:bg-blue-50 transition-colors relative">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        <button class="text-gray-500 hover:text-blue-600 p-2 rounded-full hover:bg-blue-50 transition-colors relative">
                            <i class="fas fa-envelope text-lg"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        <div class="relative">
                            <button class="flex items-center text-gray-700 hover:text-blue-600 focus:outline-none p-1 rounded-full hover:bg-blue-50 transition-colors">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
                                    alt="Profile" class="w-8 h-8 rounded-full ring-2 ring-blue-200">
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        // Close sidebar when clicking on overlay
        document.getElementById('sidebarOverlay').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        // Close sidebar when clicking on a menu item (mobile)
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