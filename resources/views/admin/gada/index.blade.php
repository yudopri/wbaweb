@extends('adminlte::page')

@section('title', 'Daftar GADA')

@section('content_header')
    <h1>Daftar GADA</h1>
@stop

@section('content')
    @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif
    @if(auth()->user()->role === 'head')
    <!-- Tombol untuk menambah GADA -->
    <div class="mb-3">
        <a href="{{ route('admin.gada.create') }}" class="btn btn-primary">Tambah GADA</a>
    </div>

    <!-- Tabel Daftar GADA -->
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama GADA</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gadas as $index => $gada)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $gada->name }}</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.gada.edit', $gada->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <!-- Form Hapus -->
                                <form action="{{ route('admin.gada.destroy', $gada->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus GADA ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data GADA.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    {{ $gadas->links() }}
    @elseif(auth()->user()->role === 'karyawan')
        <h3>Khusus Kepala</h3>
    @endif
@stop
