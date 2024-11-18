@extends('adminlte::page')

@section('title', 'Data Article')

@section('content_header')
    <h1>Data Article</h1>
@stop

@section('content')
    <a href="{{ route('admin.article.create') }}" class="btn btn-primary mb-3">Add New Article</a>

    @if(session('success'))
        <p class="alert alert-info">{{ session('success') }}</p>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ Str::limit($article->description, 50) }}</td>
                    <td>
                        @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" alt="Article Image" width="100">
                        @else
                            <img src="{{ asset('images/default-image.jpg') }}" alt="Default Image" width="100">
                        @endif
                    </td>
                    <td>{{ $article->date }}</td>
                    <td>
                        <!-- View Article -->
                        <a href="{{ route('admin.article.show', $article->id) }}" class="btn btn-info btn-sm">View</a>

                        <!-- Edit Article -->
                        <a href="{{ route('admin.article.edit', $article->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Delete Article -->
                        <form action="{{ route('admin.article.destroy', $article->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this article?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
