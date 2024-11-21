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
        @foreach($partners as $partner)
        <div class="bg-white p-4 shadow">
            <img
                alt="{{ $partner->name_partner }}"
                height="100"
                src="{{ asset('storage/' . $partner->icon) }}"
                width="450"
            />
        </div>
        @endforeach
    </div>
</section>

@endsection
