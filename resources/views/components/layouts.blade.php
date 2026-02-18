<!DOCTYPE html>
<html lang="en" data-theme="lofi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title : 'Laravel Project' }}</title>

    <!-- Fonts & CSS -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.1/font/bootstrap-icons.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/remixicon@latest/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="min-h-screen bg-gray-100 font-sans antialiased">

    <!-- Navbar -->
    <nav class="bg-white px-6 py-3 shadow-sm">
        <div class="flex items-center justify-between">
            <a href="/" class="flex items-center gap-2 text-sm font-semibold text-gray-800">
                🍳 Recipe Book
            </a>
            <a href="{{ url('home') }}" class="flex items-center gap-2 text-sm font-semibold text-gray-800">Recipe List
                <i class="ri-list-check"></i>
            </a>
            <div class="flex items-center gap-2">
                @guest
                    <a href="{{ url('login') }}" class="px-3 py-1.5 text-xs font-medium text-gray-700 hover:text-gray-900">
                        Sign In
                    </a>
                    <a href="{{ url('register') }}" class="px-4 py-1.5 text-xs font-semibold text-white bg-green-600 hover:bg-green-700 rounded-md">
                        Register
                    </a>
                @endguest

                @auth
                    <form action="{{ url('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 text-xs font-medium text-gray-700 hover:text-gray-900">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content - Centered -->
    <main class="flex items-start justify-center px-4 pt-12 pb-20">
        <div class="w-full max-w-3xl">
            {{ $slot }}
        </div>
    </main>

    <!-- Footer -->
    <footer class="fixed bottom-0 left-0 right-0 bg-gray-200 py-3 text-center">
        <p class="text-xs text-gray-600">&copy; {{ date('Y') }} Recipe Book – Laravel Practice Project</p>
    </footer>

</body>
</html>
