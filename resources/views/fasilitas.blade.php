@extends('layouts.app')

@section('title', 'Fasilitas | PT Wira Buana Arum')

@section('content')

<main>
    <!-- Fasilitas Section -->
    <section class="bg-blue-900 text-white py-16">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold mb-8">Fasilitas</h1>

            <p class="max-w-2xl mx-auto mb-8">
                PT Wira Buana Arum menyediakan berbagai fasilitas untuk memberikan kenyamanan dan menjadi mitra terpercaya bagi Client maupun Tenaga Kerja.
            </p>

            <!-- Image of security personnel -->
            <div class="flex justify-center mb-8">
                <img alt="Security personnel of PT. CIP" class="rounded-lg" height="200" src="https://storage.googleapis.com/a1aa/image/CNxsafGFZISnHiQHKhtp67CaSuESnMjGFZadZxWFNOsIgy3JA.jpg" width="300"/>
            </div>

            <!-- Grid of features -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-3xl mx-auto">
                <div class="bg-white text-blue-900 p-4 rounded-lg shadow-md flex items-center">
                    <i class="fas fa-check-circle text-red-500 mr-2"></i>
                    Pengisian Kedisiplinan (Client)
                </div>
                <div class="bg-white text-blue-900 p-4 rounded-lg shadow-md flex items-center">
                    <i class="fas fa-check-circle text-red-500 mr-2"></i>
                    Pengisian Kedisiplinan (Tenaga Kerja)
                </div>
                <div class="bg-white text-blue-900 p-4 rounded-lg shadow-md flex items-center">
                    <i class="fas fa-check-circle text-red-500 mr-2"></i>
                    BPJS Kesehatan dan BPJS Ketenagakerjaan
                </div>
                <div class="bg-white text-blue-900 p-4 rounded-lg shadow-md flex items-center">
                    <i class="fas fa-check-circle text-red-500 mr-2"></i>
                    ID Card dan Site Card yang dapat diunduh
                </div>
                <div class="bg-white text-blue-900 p-4 rounded-lg shadow-md flex items-center">
                    <i class="fas fa-check-circle text-red-500 mr-2"></i>
                    Absensi menggunakan aplikasi online
                </div>
                <div class="bg-white text-blue-900 p-4 rounded-lg shadow-md flex items-center">
                    <i class="fas fa-check-circle text-red-500 mr-2"></i>
                    Test Kesehatan online (DLS) kepada Tenaga Kerja
                </div>
                <div class="bg-white text-blue-900 p-4 rounded-lg shadow-md flex items-center">
                    <i class="fas fa-check-circle text-red-500 mr-2"></i>
                    Online Survey kepuasan Client secara berkala
                </div>
                <div class="bg-white text-blue-900 p-4 rounded-lg shadow-md flex items-center">
                    <i class="fas fa-check-circle text-red-500 mr-2"></i>
                    Aplikasi Presensi Online (Guard Patrol)
                </div>
            </div>
        </div>
    </section>

    <!-- Penggantian Tenaga Kerja Section -->
    <section class="bg-white text-blue-900 py-16">
        <div class="container mx-auto text-center">
            <!-- Image of professional team -->
            <div class="flex justify-center mb-8">
                <img alt="Professional team of PT. CIP" class="rounded-lg" height="200" src="https://storage.googleapis.com/a1aa/image/q6f6xnsvFa3MJib8V5AXrT9o2wmqwGFov6zq3pkRSrvOgy3JA.jpg" width="300"/>
            </div>

            <h2 class="text-3xl font-bold mb-4">Penggantian Tenaga Kerja</h2>
            <p class="max-w-2xl mx-auto">
                PT Wira Buana Arum memberikan layanan penggantian personil bagi Tenaga Kerja yang tidak memenuhi target performance yang telah disepakati dengan Client, secara free of charge. Kami menjadikan tenaga pengganti karyawan/mitra Tenaga Kerja yang diamanahkan di perusahaan Client sebagai hal yang utama, baik dari sisi skill dan etos kerja.
            </p>
        </div>
    </section>
</main>

@endsection
