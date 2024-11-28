@extends('adminlte::page')

@section('title', 'Data User')

@section('content_header')
    <h1>Data User</h1>
@stop

@section('content')
    @if(auth()->user()->role === 'head')
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3">Add New User</a>

        @if(session('success'))
            <p class="alert alert-info">{{ session('success') }}</p>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Profile Picture</th>
                    <th>Verification Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" width="100">
                            @else
                                <img src="{{ asset('images/default-image.jpg') }}" alt="Default Image" width="100">
                            @endif
                        </td>
                        <td>{{ $user->verifikasi ? 'Verified' : 'Not Verified' }}</td>
                        <td>
                            <!-- Edit User -->
                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <!-- Delete User -->
                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(auth()->user()->role === 'karyawan')
        <h3>Khusus Kepala</h3>
    @endif
@stop
