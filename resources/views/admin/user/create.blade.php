@extends('adminlte::page')

@section('title', 'Create User')

@section('content_header')
    <h1>Create New User</h1>
@stop

@section('content')
    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary mb-3">Back to Users List</a>

    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Name field -->
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
    </div>

    <!-- Email field -->
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
    </div>

    <!-- Password field -->
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <!-- Password confirmation field -->
    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
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
        @error('profile_picture')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary">Create User</button>
</form>

@stop
