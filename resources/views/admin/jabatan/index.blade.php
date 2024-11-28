@extends('adminlte::page')

@section('title', 'Data Jabatan')

@section('content_header')
    <h1>Data Jabatan</h1>
@stop

@section('content')
    @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif
    @if(auth()->user()->role === 'head')
    <!-- Tombol Tambah -->
    <a href="{{ route('admin.jabatan.create') }}" class="btn btn-primary mb-3">Tambah Jabatan</a>

    <!-- Tabel Jabatan -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jabatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jabatans as $index => $jabatan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $jabatan->name }}</td>
                    <td>
                        <a href="{{ route('admin.jabatan.edit', $jabatan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.jabatan.destroy', $jabatan->id) }}" method="POST" style="display:inline;">
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
