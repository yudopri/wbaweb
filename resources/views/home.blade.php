@extends('layouts.app')

@section('title', 'Home | PT Wira Buana Arum')

@section('content')

<!-- Hero Section -->
<section class="relative">
    <img
        src="{{ asset('assets/image/slide_1.jpeg') }}"
        alt="Hero Background"
        class="w-full h-96 object-cover"
    >
    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center px-6 md:px-12">
        <div class="text-center text-secondary max-w-3xl mx-auto">
            <h1 class="text-4xl font-bold text-white">PT. Wira Buana Arum</h1>
            <p class="mt-4 text-lg text-white">
                PT. Wira Buana Arum adalah perusahaan yang bergerak di bidang penyediaan sumber daya manusia (SDM) profesional, melayani kebutuhan tenaga kerja di berbagai sektor industri. Mereka menyediakan tenaga kerja seperti driver, customer service, security, office boy, tenaga produksi, dan lain-lain, dengan pengalaman yang cukup luas dalam mengelola dan mengawasi tenaga kerja bagi perusahaan mitra di seluruh Indonesia.
            </p>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="bg-secondary py-16">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-primary">
        <div class="bg-primary p-8 rounded-lg shadow-lg text-secondary">
            <h2 class="text-xl font-bold mb-4">Fasilitas</h2>
            <ul class="list-disc list-inside space-y-2">
                <li>Menyediakan tenaga pengganti (free of charge)</li>
                <li>Program pelatihan periodik</li>
                <li>Koperasi simpan pinjam</li>
                <li>Santunan duka cita dan sukacita</li>
                <li>Absensi dan guard patrol online</li>
            </ul>
            <a href="/fasilitas" class="mt-4 inline-block bg-blue-700 text-white py-2 px-4 rounded text-center">READ MORE</a>
        </div>
        <div class="bg-primary p-8 rounded-lg shadow-lg text-secondary">
            <h2 class="text-xl font-bold mb-4">Layanan</h2>
            <p>PT Citra Indojaya Perkasa menyediakan beragam tenaga kerja outsourcing berpengalaman yang siap terjun ke dalam perusahaan anda.</p>
            <a href="/layanan" class="mt-4 inline-block bg-blue-700 text-white py-2 px-4 rounded text-center">READ MORE</a>
        </div>
        <div class="bg-primary p-8 rounded-lg shadow-lg text-secondary">
            <h2 class="text-xl font-bold mb-4">Program Kerja</h2>
            <p>Mencakup perencanaan, organisasi dan kontrol setiap tenaga kerja dengan bantuan koordinator lapangan serta berbagai macam program pembinaan yang disesuaikan dengan kebutuhan.</p>
            <a href="/programkerja" class="mt-4 inline-block bg-blue-700 text-white py-2 px-4 rounded text-center">READ MORE</a>
        </div>
    </div>
</section>

<!-- Clients Section -->
<section class="py-16 bg-gray-200">
    <div class="container mx-auto text-center">
        <h2 class="text-2xl font-bold text-primary mb-8">OUR CLIENTS</h2>
        <!-- Wrapping div for overflow hidden -->
        <div class="overflow-hidden relative">
            <!-- Flex container for logos with sliding effect -->
            <div class="flex space-x-8 animate-slide">
                <img src="{{ asset('assets/image/pelindo.png') }}" alt="Client Logo 1" class="w-24 h-auto">
                <img src="{{ asset('assets/image/uhw.png') }}" alt="Client Logo 2" class="w-24 h-auto">
                <img src="{{ asset('assets/image/asdp.png') }}" alt="Client Logo 3" class="w-24 h-auto">
                <img src="{{ asset('assets/image/intiland.png') }}" alt="Client Logo 4" class="w-24 h-auto">
                <img src="{{ asset('assets/image/bankindia.png') }}" alt="Client Logo 5" class="w-24 h-auto">
                <img src="{{ asset('assets/image/onemed.png') }}" alt="Client Logo 6" class="w-24 h-auto">
                <img src="{{ asset('assets/image/ptindocement.png') }}" alt="Client Logo 7" class="w-24 h-auto">
                <img src="{{ asset('assets/image/fks.png') }}" alt="Client Logo 8" class="w-24 h-auto">
                <img src="{{ asset('assets/image/maxxi.png') }}" alt="Client Logo 9" class="w-24 h-auto">
                <img src="{{ asset('assets/image/hs.png') }}" alt="Client Logo 10" class="w-24 h-auto">
                <img src="{{ asset('assets/image/pizza.jpg') }}" alt="Client Logo 11" class="w-24 h-auto">
                <img src="{{ asset('assets/image/harvestar.png') }}" alt="Client Logo 12" class="w-24 h-auto">
                <img src="{{ asset('assets/image/isuzu.png') }}" alt="Client Logo 13" class="w-24 h-auto">
                <img src="{{ asset('assets/image/daihatsu.png') }}" alt="Client Logo 14" class="w-24 h-auto">
                <img src="{{ asset('assets/image/paninbank.png') }}" alt="Client Logo 15" class="w-24 h-auto">
                <img src="{{ asset('assets/image/ptjatim.png') }}" alt="Client Logo 16" class="w-24 h-auto">
                <img src="{{ asset('assets/image/ekahusada.png') }}" alt="Client Logo 17" class="w-24 h-auto">
            </div>
        </div>
        <a href="/client" class="bg-blue-700 text-white py-2 px-4 rounded mt-4 inline-block text-center">LIHAT KLIEN LAINNYA</a>
    </div>
</section>

@endsection
