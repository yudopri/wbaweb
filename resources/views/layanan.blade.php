@extends('layouts.app')

@section('title', 'Layanan | PT Wira Buana Arum')

@section('content')
<main class="bg-blue-800 text-white py-16">
   <div class="container mx-auto text-center">
    <h1 class="text-4xl font-bold mb-4">
     Layanan
    </h1>
    <img alt="Person giving thumbs up" class="mx-auto mb-8" height="400" src="{{ asset('assets/image/layanan.jpg') }}" width="400"/>
   </div>
</main>

<section class="bg-white py-16">
  <div class="container mx-auto text-center">
    <p class="mb-8">
     Berikut daftar Tenaga Kerja Outsourcing yang kami sediakan:
    </p>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
     @foreach ($services as $index => $service)
      <div class="flex items-center justify-between bg-blue-900 text-white p-4 rounded-lg">
        <span class="bg-red-600 rounded-full w-8 h-8 flex items-center justify-center">
         {{ $index + 1 }}
        </span>
        <span>
         {{ $service->name_service }} <!-- Display service name -->
        </span>
      </div>
     @endforeach
    </div>
    <p class="mt-8">
     Hubungi kami jika ada pertanyaan lebih lanjut mengenai jenis Tenaga Kerja yang anda perlukan.
    </p>
    <button class="mt-4 bg-red-600 text-white py-2 px-4 rounded-lg">
     KONTAK KAMI
    </button>
  </div>
</section>
@endsection
