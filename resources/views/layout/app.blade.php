<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous" />
</head>

<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <div class="w-64 bg-blue-800 text-white flex flex-col">
            <!-- Logo -->
            <div class="p-4 text-xl font-bold border-b border-blue-700">
                <i class="fas fa-chart-line mr-2"></i>
                Dashboard
            </div>

            <!-- Menu Navigasi -->
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="flex items-center p-2 rounded hover:bg-blue-700 bg-blue-700">
                            <i class="fas fa-home mr-3"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 rounded hover:bg-blue-700">
                            <i class="fas fa-users mr-3"></i>
                            Pengguna
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 rounded hover:bg-blue-700">
                            <i class="fas fa-shopping-cart mr-3"></i>
                            Produk
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 rounded hover:bg-blue-700">
                            <i class="fas fa-chart-bar mr-3"></i>
                            Laporan
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 rounded hover:bg-blue-700">
                            <i class="fas fa-cog mr-3"></i>
                            Pengaturan
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center p-2 rounded hover:bg-blue-700">
                                <i class="fa-solid fa-arrow-right-from-bracket mr-3"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-blue-700">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=0D8ABC&color=fff"
                        alt="Profile" class="w-10 h-10 rounded-full">
                    <div class="ml-3">
                        <p class="font-medium">Admin User</p>
                        <p class="text-sm text-blue-200">admin@example.com</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow">
                <div class="flex justify-between items-center p-4">
                    <div class="flex items-center">
                        <button id="sidebarToggle" class="text-gray-500 focus:outline-none lg:hidden">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="ml-4 text-xl font-semibold">Dashboard Utama</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-bell"></i>
                        </button>
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-envelope"></i>
                        </button>
                        <div class="relative">
                            <button class="flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                                <img src="https://ui-avatars.com/api/?name=Admin+User&background=0D8ABC&color=fff"
                                    alt="Profile" class="w-8 h-8 rounded-full">
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
            const sidebar = document.querySelector('.w-64');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('absolute');
            sidebar.classList.toggle('z-50');
        });
    </script>
</body>

</html>