@extends('layouts.app')

@section('title', 'Client | PT Wira Buana Arum')

@section('content')

<section class="bg-blue-900 text-white py-16 relative">
    <div class="container mx-auto text-center">
        <h1 class="text-4xl font-bold">
            Our Clients
        </h1>
    </div>
</section>

<section class="bg-gray-100 py-16">
    <div class="container mx-auto grid grid-cols-3 gap-8 item-center">
        <div class="bg-white p-4 shadow">
            <img alt="BCA Logo" height="100" src="{{ asset('assets/image/pelindo.png') }}" width="450"/>
        </div>
        <div class="bg-white p-4 shadow">
            <img alt="BCA Finance Logo" height="100" src="{{ asset('assets/image/uhw.png') }}" width="450"/>
        </div>
        <div class="bg-white p-4 shadow">
            <img alt="Bank Maspion Logo" height="100" src="{{ asset('assets/image/asdp.png') }}" width="450"/>
        </div>
        <div class="bg-white p-4 shadow">
            <img alt="Bank BPD Logo" height="100" src="{{ asset('assets/image/intiland.png') }}" width="450"/>
        </div>
        <div class="bg-white p-4 shadow">
            <img alt="PT. Paiton Padang Global Logo" height="100" src="{{ asset('assets/image/bankindia.png') }}" width="450"/>
        </div>
        <div class="bg-white p-4 shadow">
            <img alt="Pioneer Logo" height="100" src="{{ asset('assets/image/fks.png') }}" width="450"/>
        </div>
        <div class="bg-white p-4 shadow">
            <img alt="Techno Group Logo" height="100" src="{{ asset('assets/image/ptindocement.png') }}" width="450"/>
        </div>
        <div class="bg-white p-4 shadow">
            <img alt="Shinhan Bank Logo" height="100" src="{{ asset('assets/image/onemed.png') }}" width="450"/>
        </div>
        <div class="bg-white p-4 shadow">
            <img alt="Mensa Binasukses PT Logo" height="100" src="{{ asset('assets/image/maxxi.png') }}" width="450"/>
        </div>
        <div class="bg-white p-4 shadow">
            <img alt="Bank Mayapada Logo" height="100" src="{{ asset('assets/image/hs.png') }}" width="450"/>
        </div>
        <div class="bg-white p-4 shadow">
            <img alt="ECS Logo" height="100" src="{{ asset('assets/image/pizza.jpg') }}" width="450"/>
        </div>
        <div class="bg-white p-4 shadow">
            <img alt="Securities Sinarmas Logo" height="100" src="{{ asset('assets/image/paninbank.png') }}" width="450"/>
        </div>
        <div class="bg-white p-4 shadow">
            <img alt="Panti Nirmala Logo" height="100" src="{{ asset('assets/image/ekahusada.png') }}" width="450"/>
        </div>
        <div class="bg-white p-4 shadow">
            <img alt="Bank Bumi Arta Logo" height="100" src="{{ asset('assets/image/daihatsu.png') }}" width="450"/>
        </div>
        <div class="bg-white p-4 shadow">
            <img alt="Heron Logo" height="100" src="{{ asset('assets/image/isuzu.png') }}" width="450"/>
        </div>
        <div class="bg-white p-4 shadow">
            <img alt="BPR Kota Logo" height="100" src="{{ asset('assets/image/ptjatim.png') }}" width="450"/>
        </div>
        <div class="bg-white p-4 shadow">
            <img alt="Hoya Logo" height="100" src="{{ asset('assets/image/harvestar.png') }}" width="450"/>
        </div>
    </div>
</section>

@endsection
