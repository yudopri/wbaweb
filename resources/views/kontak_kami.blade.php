@extends('layouts.app')

@section('title', 'Kontak | PT Wira Buana Arum')

@section('content')

<section class="bg-blue-900 text-white py-20">
    <div class="container mx-auto text-center">
     <h1 class="text-4xl font-bold">
      Kontak Kami
     </h1>
     <div class="mt-10 flex justify-center">
      <img alt="Person holding a tablet" class="h-40" height="150" src="https://storage.googleapis.com/a1aa/image/gl7Zc0W3dj6yCJaYb3r1fs6oTvCfxxWKfvgTI7P5cffJh78dC.jpg" width="150"/>
     </div>
    </div>
   </section>
   <section class="bg-red-500 text-white py-10">
    <div class="container mx-auto text-center">
     <p>
      Jika anda memiliki pertanyaan tentang jasa yang kami sediakan, segera hubungi kami di
     </p>
     <p class="font-bold">
      PT WIRA BUANA ARUM
     </p>
    </div>
   </section>
   <section class="bg-white py-10">
    <div class="container mx-auto text-center">
     <div class="bg-red-500 text-white p-6 rounded-lg inline-block">
      <h2 class="text-xl font-bold">
       KANTOR PUSAT
      </h2>
      <p>
       Permata Sukodono Raya Blok A1 No. 8, Sukodono, Sidoarjo
      </p>
      <p>
       Telepon: (031) 58834012
      </p>
      <p>
       Fax: (031) 58834013
      </p>
      <p>
        E-mail: ptwba@yahoo.co.id
       </p>
     </div>
    </div>
   </section>
   <section class="bg-gray-100 py-10">
    <div class="container mx-auto">
     <h2 class="text-center text-2xl font-bold mb-6">
      KANTOR CABANG
     </h2>
     <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="bg-white p-6 rounded-lg shadow-md">
       <h3 class="text-xl font-bold">
        BANYUWANGI
       </h3>
       <p>
        Perum Permata Banyuwangi K1, Kalipuro, Banyuwangi
       </p>
       <p>
        Telepon: (0333) 3381922
       </p>
       <p>
        E-mail: ptwbabanyuwangi@yahoo.co.id
       </p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-md">
       <h3 class="text-xl font-bold">
        BALI
       </h3>
       <p>
        Jl. Sidakarya Gg. Taman Melati No. 1, Denpasar, Bali
       </p>
       <p>
       E-mail: ptwbabali@yahoo.co.id
       </p>
      </div>
     </div>
    </div>
   </section>

   @endsection
