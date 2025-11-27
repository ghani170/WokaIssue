<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1',
                        secondary: '#8b5cf6',
                        dark: '#1f2937',
                        light: '#f9fafb'
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        }
    </style>
</head>

<body class="min-h-screen flex items-center bg-blue-100 justify-center p-4">
    <div class="fixed top-0 left-0 w-full h-1/2  rounded-b-[50px] z-0"></div>

    <div class="relative z-10 w-full max-w-md">
        <div class="bg-white/20 backdrop-blur-md rounded-2xl shadow-xl overflow-hidden border border-white/20">
            <div class="p-8">
                <div class="text-center mb-8">
                    <div class="w-20 h-20 rounded-full bg-blue-400 flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-user-lock text-white text-3xl"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800">Welcome In WokaIssue</h1>
                    <p class="text-gray-500 mt-2">Sign in to access your account</p>
                </div>

                <form class="space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" id="email" name="email" placeholder="Enter your email"
                                class="pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200 outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Password</label>

                        <div class="relative">
                            <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

                            <input type="password" id="password" name="password"
                                class="pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200 outline-none" placeholder="Enter your passwword">

                            <button type="button" id="togglePassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <script>
                        document.getElementById('togglePassword').onclick = function() {
                            const pwd = document.getElementById('password');
                            const icon = this.querySelector('i');

                            const show = pwd.type === "password";
                            pwd.type = show ? "text" : "password";
                            icon.className = show ? "fas fa-eye-slash" : "fas fa-eye";
                        };
                    </script>
                    <button type="submit"
                        class=" bg-blue-500 text-white py-3 px-4 rounded-lg font-semibold hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Sign In
                    </button>
                </form>


            </div>
        </div>

        <p class="text-center text-black text-sm mt-6">© 2025 Woka. All rights reserved.</p>
    </div>
</body>

</html>