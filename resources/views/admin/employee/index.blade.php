@extends('adminlte::page')

@section('title', 'Daftar Karyawan')

@section('content_header')
    <h1>Daftar Karyawan</h1>
@stop

@section('content')
    @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif

    <!-- Form Pencarian dan Filter -->
    <div class="mb-4">
        <form action="{{ route('admin.employee.index') }}" method="GET" class="form-inline">
            <!-- Pencarian Nama atau NIK -->
            <div class="form-group mb-2 mr-2">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari nama atau NIK"
                    value="{{ request('search') }}">
            </div>

            <!-- Filter Departemen -->
            <div class="form-group mb-2 mr-2">
                <select name="departemen_id" class="form-control">
                    <option value="">-- Semua Departemen --</option>
                    @foreach($departemens as $departemen)
                        <option value="{{ $departemen->id }}"
                            {{ request('departemen_id') == $departemen->id ? 'selected' : '' }}>
                            {{ $departemen->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Jabatan -->
            <div class="form-group mb-2 mr-2">
                <select name="jabatan_id" class="form-control">
                    <option value="">-- Semua Jabatan --</option>
                    @foreach($jabatans as $jabatan)
                        <option value="{{ $jabatan->id }}"
                            {{ request('jabatan_id') == $jabatan->id ? 'selected' : '' }}>
                            {{ $jabatan->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter GADA -->
            <div class="form-group mb-2 mr-2">
                <select name="gada" class="form-control">
                    <option value="">-- Semua GADA --</option>
                    @foreach($gadas as $gada)
                        <option value="{{ $gada->id }}"
                            {{ request('gada') == $gada->id ? 'selected' : '' }}>
                            {{ $gada->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol Filter -->
            <button type="submit" class="btn btn-primary mb-2">Filter</button>
            <a href="{{ route('admin.employee.index') }}" class="btn btn-secondary mb-2 ml-2">Reset</a>
        </form>
    </div>

    @if(auth()->user()->role === 'head')
    <!-- Tombol Import dan Export -->
    <div class="mb-4">
        <a href="{{ route('admin.employee.export') }}" class="btn btn-info mb-2 ml-2">Export Excel</a>
    </div>
    @endif

    <!-- Tombol Tambah Employee -->
    <a href="{{ route('admin.employee.create') }}" class="btn btn-primary mb-3">Tambah Karyawan</a>

    <!-- Tabel Daftar Karyawan -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIK</th>
                <th>Email</th>
                <th>Departemen</th>
                <th>Jabatan</th>
                <th>GADA</th>
                <th>Sertifikat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ Crypt::decryptString($employee->nik) }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->departemen->name ?? '-' }}</td>
                    <td>{{ $employee->jabatan->name ?? '-' }}</td>
                    <td>{{ $employee->gada->name ?? 'Tidak Ada' }}</td>
                    <td>
                        @if($employee->sertifikat)
                            <a href="{{ asset('storage/' . $employee->sertifikat) }}" target="_blank">Lihat Sertifikat</a>
                        @else
                            Tidak Ada
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.employee.show', $employee->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('admin.employee.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.employee.destroy', $employee->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data karyawan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $employees->links() }}
    
    <!-- Saring ulang pesan sukses di bawah tabel jika ada -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

@stop
