@extends('adminlte::page')

@section('title', 'Data Departemen')

@section('content_header')
    <h1>Data Departemen</h1>
@stop

@section('content')
    @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif
    @if(auth()->user()->role === 'head')
    <!-- Tombol Tambah -->
    <a href="{{ route('admin.departemen.create') }}" class="btn btn-primary mb-3">Tambah Departemen</a>

    <!-- Tabel Departemen -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Departemen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departemens as $index => $departemen)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $departemen->name }}</td>
                    <td>
                        <a href="{{ route('admin.departemen.edit', $departemen->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.departemen.destroy', $departemen->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
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
