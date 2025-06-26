<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SyamCare - Alat Kesehatan Terpercaya</title>
    <meta name="description" content="SyamCare menyediakan alat kesehatan berkualitas tinggi dengan pengiriman cepat ke seluruh Indonesia. Solusi terpercaya untuk kebutuhan medis Anda.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    @endif
</head>

<body class="font-sans antialiased">
    <!-- Navigation Header -->
    <header class="relative bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4 md:py-6">
                <!-- Logo -->
                <div class="flex items-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-blue-600">SyamCare</h1>
                    <span class="ml-2 text-sm text-gray-500 hidden sm:inline">Alat Kesehatan Terpercaya</span>
                </div>

                <!-- Navigation Links -->
                @if (Route::has('login'))
                <nav class="flex items-center space-x-2 sm:space-x-4">
                    @auth
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
                        Dashboard
                    </a>
                    @else
                    <a href="{{ route('login') }}"
                       class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors duration-200">
                        Masuk
                    </a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors duration-200">
                        Daftar
                    </a>
                    @endif
                    <a href="{{ route('admin.login') }}"
                       class="text-blue-600 hover:text-blue-800 px-3 py-2 text-sm font-medium border border-blue-200 rounded-md hover:bg-blue-50 transition-colors duration-200">
                        Admin
                    </a>
                    @endauth
                </nav>
                @endif
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-50 via-white to-blue-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">
            <div class="text-center">
                <!-- Main Heading -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                    Solusi Alat Kesehatan
                    <span class="text-blue-600 block">Terpercaya</span>
                </h1>

                <!-- Subtitle -->
                <p class="mt-6 text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    SyamCare menyediakan berbagai peralatan kesehatan berkualitas tinggi dengan standar medis internasional.
                    Dipercaya oleh ribuan profesional kesehatan di seluruh Indonesia.
                </p>

                <!-- CTA Buttons -->
                <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4 sm:gap-6">
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center justify-center px-8 py-3 bg-blue-600 text-white text-lg font-semibold rounded-lg hover:bg-blue-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                        Mulai Berbelanja
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a href="#features"
                       class="inline-flex items-center justify-center px-8 py-3 border-2 border-blue-600 text-blue-600 text-lg font-semibold rounded-lg hover:bg-blue-600 hover:text-white transition-all duration-200">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>

        <!-- Background Decoration -->
        <div class="absolute top-0 right-0 -mt-4 -mr-4 opacity-10">
            <svg class="w-64 h-64 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                    Mengapa Memilih SyamCare?
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Komitmen kami adalah memberikan pelayanan terbaik dengan produk berkualitas tinggi
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group text-center p-6 rounded-xl bg-gray-50 hover:bg-blue-50 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors duration-300">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Produk Berkualitas</h3>
                    <p class="text-gray-600">
                        Semua produk telah tersertifikasi dan memenuhi standar medis internasional untuk keamanan dan efektivitas
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="group text-center p-6 rounded-xl bg-gray-50 hover:bg-blue-50 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors duration-300">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Pengiriman Cepat</h3>
                    <p class="text-gray-600">
                        Layanan pengiriman ekspres ke seluruh Indonesia dengan kemasan aman dan tracking real-time
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="group text-center p-6 rounded-xl bg-gray-50 hover:bg-blue-50 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors duration-300">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 100 19.5 9.75 9.75 0 000-19.5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Dukungan 24/7</h3>
                    <p class="text-gray-600">
                        Tim customer service profesional siap membantu Anda kapan saja dengan konsultasi produk gratis
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-3xl sm:text-4xl font-bold mb-2">1000+</div>
                    <div class="text-blue-100">Produk Tersedia</div>
                </div>
                <div>
                    <div class="text-3xl sm:text-4xl font-bold mb-2">5000+</div>
                    <div class="text-blue-100">Pelanggan Puas</div>
                </div>
                <div>
                    <div class="text-3xl sm:text-4xl font-bold mb-2">50+</div>
                    <div class="text-blue-100">Kota Terjangkau</div>
                </div>
                <div>
                    <div class="text-3xl sm:text-4xl font-bold mb-2">24/7</div>
                    <div class="text-blue-100">Layanan Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 sm:py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Siap Memulai Perjalanan Kesehatan Anda?
            </h2>
            <p class="text-lg text-gray-600 mb-8">
                Bergabunglah dengan ribuan profesional kesehatan yang telah mempercayai SyamCare
            </p>
            <a href="{{ route('login') }}"
               class="inline-flex items-center justify-center px-8 py-4 bg-blue-600 text-white text-lg font-semibold rounded-lg hover:bg-blue-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                Mulai Berbelanja Sekarang
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <h3 class="text-2xl font-bold text-blue-400 mb-4">SyamCare</h3>
                    <p class="text-gray-300 mb-4">
                        Penyedia alat kesehatan terpercaya dengan komitmen memberikan solusi terbaik
                        untuk kebutuhan medis profesional dan personal.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="{{ route('login') }}" class="hover:text-blue-400 transition-colors">Berbelanja</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-blue-400 transition-colors">Daftar</a></li>
                        <li><a href="{{ route('admin.login') }}" class="hover:text-blue-400 transition-colors">Admin</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li>Email: info@syamcare.com</li>
                        <li>Telepon: (021) 123-4567</li>
                        <li>WhatsApp: +62 812-3456-7890</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} SyamCare. Seluruh hak cipta dilindungi undang-undang.</p>
            </div>
        </div>
    </footer>
</body>

</html>
