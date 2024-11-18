@extends('layouts.app')

@section('title', 'Program Kerja | PT Wira Buana Arum')

@section('content')

<section class="bg-blue-800 text-white py-20">
            <div class="container mx-auto text-center">
                <h1 class="text-4xl font-bold">Program Kerja</h1>
            </div>
        </section>
        <section class="bg-white py-20">
            <div class="container mx-auto flex flex-col items-center">
                <div class="w-2/3 flex flex-col items-center">
                    <img src="https://placehold.co/600x400" alt="Training Session" class="rounded-lg shadow-lg mb-8">
                    <p class="text-center text-lg">
                        PT Wira Buana Arum menerapkan Standard Operating Procedure (SOP) bagi setiap Tenaga Kerja dan berperan aktif dalam pemberian Service Luar Negeri yang didapat dari para Client.
                        Kami bekerjasama dengan Instansi Pemerintah (Dinas Tenaga Kerja) dan Instansi Pelatihan (Pusdiklat) THP serta terlibat dalam Asosiasi Penyalur Tenaga Kerja, guna menjadikan Sumberdaya Professional dan Terpercaya.
                    </p>
                </div>
            </div>
        </section>
        <section class="bg-red-600 text-white py-20">
            <div class="container mx-auto flex flex-col items-center">
                <h2 class="text-3xl font-bold mb-8">Program Pembinaan Tenaga Kerja</h2>
                <div class="w-2/3 flex flex-col items-center">
                    <p class="text-center text-lg mb-8">
                        Program pembinaan rutin adalah pembinaan Tenaga Kerja yang dilakukan secara rutin. Pelatihan ini bersifat teknis (mendapatkan sertifikat keahlian), dengan tujuan untuk meningkatkan pengetahuan SOP, kedisiplinan dan Attitude/mental Tenaga Kerja.
                        Program pembinaan khusus adalah pembinaan kerjasama sekaligus magang yang dilakukan dengan periodik, dengan berbagai materi training yang disesuaikan dengan kebutuhan masing-masing Tenaga Kerja. Berikut adalah materi yang diberikan:
                    </p>
                    <ul class="list-disc list-inside text-left space-y-2">
                        <li><i class="fas fa-check-circle text-blue-500"></i> Penataran Keterampilan</li>
                        <li><i class="fas fa-check-circle text-blue-500"></i> Penerapan Motivasi dan Pengarahan Lebih Lanjut</li>
                        <li><i class="fas fa-check-circle text-blue-500"></i> Pengarahan Cleaning Equipment dan Chemical</li>
                        <li><i class="fas fa-check-circle text-blue-500"></i> Pelatihan Excellent Service</li>
                        <li><i class="fas fa-check-circle text-blue-500"></i> Seminar Motivasi untuk pembentukan karakter</li>
                        <li><i class="fas fa-check-circle text-blue-500"></i> Dan berbagai macam pelatihan lainnya</li>
                    </ul>
                    <img src="https://placehold.co/600x400" alt="Training Session" class="rounded-lg shadow-lg mt-8">
                </div>
            </div>
        </section>


        @endsection
