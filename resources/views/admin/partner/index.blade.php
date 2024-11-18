@extends('adminlte::page')

@section('title', 'Data partner')

@section('content_header')
    <h1>Data partner</h1>
@stop

@section('content')
    <a href="{{ route('admin.partner.create') }}" class="btn btn-primary mb-3">Add New Partner</a>

    @if(session('message'))
        <p class="alert alert-info">{{ session('message') }}</p>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Perusahaan</th>
                <th>Icon</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($partners as $partner)
                <tr>
                    <td>{{ $partner->name_partner }}</td>
                    <td>
                        @if($partner->icon)
                        <img src="{{ asset('storage/icons/partners/' . basename($partner->icon)) }}" alt="Current Icon" width="100">
                        @else
                            <img src="{{ asset('images/default-icon.jpg') }}" alt="Default Icon" width="100">
                        @endif
                    </td>
                    <td>
                        <!-- View Service -->
                        <a href="{{ route('admin.partner.show', $partner->id) }}" class="btn btn-info btn-sm">View</a>

                        <!-- Edit Service -->
                        <a href="{{ route('admin.partner.edit', $partner->id) }}" class="btn btn-warning btn-sm">Edit</a>


                        <!-- Delete Service -->
                        <form action="{{ route('admin.partner.destroy', $partner->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this service?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
