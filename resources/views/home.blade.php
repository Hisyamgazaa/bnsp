<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to SyamCare') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-8 lg:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">
            <!-- Hero Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 lg:p-8 text-gray-900">
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-blue-600 mb-3 sm:mb-4 leading-tight">
                        SyamCare - Solusi Kesehatan Terpercaya
                    </h1>
                    <p class="text-sm sm:text-base lg:text-lg text-gray-600 mb-4 sm:mb-6 leading-relaxed">
                        Selamat datang di SyamCare, toko online terpercaya untuk peralatan kesehatan berkualitas tinggi. Kami menyediakan berbagai produk kesehatan yang Anda butuhkan untuk menjaga kesehatan keluarga.
                    </p>
                    <a href="{{ route('product') }}" class="inline-block bg-blue-500 text-white px-4 py-2 sm:px-6 sm:py-3 rounded-lg hover:bg-blue-600 transition-colors text-sm sm:text-base font-medium">
                        Lihat Produk
                    </a>
                </div>
            </div>

            <!-- Features Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm">
                    <div class="text-blue-500 mb-3 sm:mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 sm:h-12 sm:w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold mb-2">Kualitas Terjamin</h3>
                    <p class="text-sm sm:text-base text-gray-600">Semua produk kesehatan kami memenuhi standar kualitas yang ketat dan dilengkapi dengan sertifikat resmi.</p>
                </div>

                <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm">
                    <div class="text-blue-500 mb-3 sm:mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 sm:h-12 sm:w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold mb-2">Pengiriman Cepat</h3>
                    <p class="text-sm sm:text-base text-gray-600">Layanan pengiriman yang cepat dan terpercaya untuk memastikan produk kesehatan sampai tepat waktu.</p>
                </div>

                <div class="bg-white p-4 sm:p-6 rounded-lg shadow-sm sm:col-span-2 lg:col-span-1">
                    <div class="text-blue-500 mb-3 sm:mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 sm:h-12 sm:w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold mb-2">Dukungan Ahli</h3>
                    <p class="text-sm sm:text-base text-gray-600">Tim ahli kami siap membantu Anda memilih produk yang tepat dan memberikan dukungan teknis terbaik.</p>
                </div>
            </div>

            <!-- About Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 lg:p-8 text-gray-900">
                    <h2 class="text-2xl sm:text-3xl font-semibold mb-4 sm:mb-6">Tentang SyamCare</h2>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                        <div class="space-y-4">
                            <p class="text-sm sm:text-base text-gray-600 leading-relaxed">
                                SyamCare berdedikasi untuk menyediakan produk kesehatan berkualitas tinggi bagi masyarakat Indonesia. Katalog lengkap kami mencakup berbagai kebutuhan kesehatan mulai dari alat kesehatan dasar hingga peralatan medis canggih.
                            </p>
                            <p class="text-sm sm:text-base text-gray-600 leading-relaxed">
                                Dengan pengalaman bertahun-tahun di industri kesehatan, kami memahami pentingnya keandalan dan kualitas dalam produk kesehatan. Itulah sebabnya kami memilih setiap produk dengan cermat untuk memastikan memenuhi standar ketat kami.
                            </p>
                            <p class="text-sm sm:text-base text-gray-600 leading-relaxed">
                                Komitmen kami terhadap keunggulan tidak hanya terbatas pada produk, tetapi juga pada layanan pelanggan. Kami bangga memberikan panduan ahli dan dukungan untuk membantu Anda membuat keputusan yang tepat.
                            </p>
                        </div>
                        <div class="space-y-3 sm:space-y-4">
                            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg">
                                <h4 class="text-base sm:text-lg font-semibold mb-2">Misi Kami</h4>
                                <p class="text-sm sm:text-base text-gray-600">Menyediakan produk kesehatan yang berkualitas dan terpercaya untuk membantu masyarakat menjaga kesehatan dengan lebih baik.</p>
                            </div>
                            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg">
                                <h4 class="text-base sm:text-lg font-semibold mb-2">Jaminan Kualitas</h4>
                                <p class="text-sm sm:text-base text-gray-600">Setiap produk yang kami tawarkan melalui pengecekan kualitas yang ketat dan dilengkapi sertifikasi untuk memastikan keamanan dan keandalan.</p>
                            </div>
                            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg">
                                <h4 class="text-base sm:text-lg font-semibold mb-2">Pelanggan Utama</h4>
                                <p class="text-sm sm:text-base text-gray-600">Kami mengutamakan kepuasan pelanggan dengan menawarkan harga kompetitif, pengiriman terpercaya, dan dukungan after-sales yang excellent.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
