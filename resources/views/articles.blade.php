@extends('layouts.app')

@section('title', 'Article | PT Wira Buana Arum')

@section('content')
<main class="container mx-auto px-4 py-16">
    <h1 class="text-4xl font-bold text-center mb-4">
        Wira Buana Arum Article
    </h1>
    <p class="text-center text-gray-600 mb-8">
        This is your main source for news about Wira Buana Arum Group. Get access to photos of our latest and subscribe to updates.
        <br />
        If you have questions please contact us at
        <a href="mailto:ptwba@yahoo.co.id" class="text-blue-600">
            contact wba@yahoo.co.id
        </a>
    </p>
    <div class="text-center mb-8">
        <a href="/kontak" class="bg-blue-600 text-white px-4 py-2 rounded">
            Contact Us
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($articles as $article)
            <div class="border rounded-lg shadow-lg overflow-hidden">
            <img
    src="{{ $article->image ? asset('storage/' . $article->image) : asset('images/default-image.jpg') }}"
    alt="{{ $article->title }}"
    class="w-full h-48 object-cover"
    width="600"
    height="400"
/>

                <div class="p-4">
                    <h2 class="text-xl font-bold mb-2">
                        {{ $article->title }}
                    </h2>
                    <p class="text-gray-600 mb-4">
                        {{ \Illuminate\Support\Str::limit($article->description, 100) }}
                    </p>
                    <a href="{{ route('article.showReadmore', $article->id) }}" class="text-blue-600">
                        READ MORE
                    </a>
                </div>
                <div class="bg-gray-100 p-4 text-gray-600 text-sm">
                    {{ \Carbon\Carbon::parse($article->date)->format('F j, Y') }}
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center">
                <p class="text-gray-600">No articles found at the moment.</p>
            </div>
        @endforelse
    </div>
    <div class="text-center mt-8">
        {{ $articles->links() }}
    </div>
</main>
@endsection
