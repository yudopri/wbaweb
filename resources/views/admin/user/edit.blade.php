@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1>Edit User</h1>
@stop

@section('content')
    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary mb-3">Back to Users List</a>

    <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Name field -->
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <!-- Email field -->
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>

    <!-- Password field (Optional) -->
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control">
        <small>Leave empty if you don't want to change the password.</small>
    </div>

    <!-- Password confirmation field -->
    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
    </div>

    <!-- Verifikasi field -->
    <div class="form-group">
        <label for="verifikasi">Verified</label>
        <select name="verifikasi" class="form-control" id="verifikasi">
            <option value="1" {{ old('verifikasi', $user->verifikasi) == 1 ? 'selected' : '' }}>Verified</option>
            <option value="0" {{ old('verifikasi', $user->verifikasi) == 0 ? 'selected' : '' }}>Not Verified</option>
        </select>
        @error('verifikasi')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Profile Picture field -->
    <div class="form-group">
        <label for="profile_picture">Profile Picture</label>
        <input type="file" name="profile_picture" id="profile_picture" class="form-control">

        <!-- Display current profile picture if it exists -->
        @if($user->profile_picture)
            <div class="mt-2">
                <label>Current Profile Picture:</label><br>
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" width="100" height="100">
            </div>
        @endif

        @error('profile_picture')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary">Update User</button>
</form>

@stop
