<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to MedEquip') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Hero Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <h1 class="text-4xl font-bold text-blue-600 mb-4">Your Trusted Medical Equipment Partner</h1>
                    <p class="text-lg text-gray-600 mb-6">Welcome to the leading online marketplace for high-quality medical equipment and supplies. We ensure healthcare professionals and facilities have access to the best medical equipment they need.</p>
                    <a href="{{ route('product') }}" class="inline-block bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition-colors">
                        Browse Products
                    </a>
                </div>
            </div>

            <!-- Features Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="text-blue-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Quality Assured</h3>
                    <p class="text-gray-600">All our medical equipment meets strict quality standards and comes with proper certification.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="text-blue-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Fast Delivery</h3>
                    <p class="text-gray-600">Quick and reliable delivery service to ensure you receive your medical equipment when you need it.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="text-blue-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Expert Support</h3>
                    <p class="text-gray-600">Our team of experts is always ready to assist you with product selection and technical support.</p>
                </div>
            </div>

            <!-- About Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <h2 class="text-3xl font-semibold mb-6">About Us</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <p class="text-gray-600 mb-4">
                                We are dedicated to providing healthcare professionals with the highest quality medical equipment. Our extensive catalog includes everything from basic medical supplies to advanced diagnostic equipment.
                            </p>
                            <p class="text-gray-600 mb-4">
                                With years of experience in the medical equipment industry, we understand the importance of reliability and quality in healthcare. That's why we carefully select each product in our inventory to ensure it meets our strict standards.
                            </p>
                            <p class="text-gray-600">
                                Our commitment to excellence extends beyond our products to our customer service. We pride ourselves on providing expert guidance and support to help you make informed decisions about your medical equipment needs.
                            </p>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-lg font-semibold mb-2">Our Mission</h4>
                                <p class="text-gray-600">To provide healthcare professionals with reliable, high-quality medical equipment that enables them to deliver the best possible care to their patients.</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-lg font-semibold mb-2">Quality Promise</h4>
                                <p class="text-gray-600">Every product we offer undergoes rigorous quality checks and comes with necessary certifications to ensure safety and reliability.</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-lg font-semibold mb-2">Customer First</h4>
                                <p class="text-gray-600">We prioritize customer satisfaction by offering competitive prices, reliable shipping, and excellent after-sales support.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>