@extends('adminlte::page')

@section('title', 'View Employee')

@section('content_header')
    <h1>View Employee</h1>
@stop

@section('content')
    <!-- Tombol Kembali -->
    <a href="{{ route('admin.employee.index') }}" class="btn btn-secondary mb-3">Back to Employees</a>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $employee->name }}</h3>
        </div>
        <div class="card-body">
            <!-- Name -->
            <div class="mb-3">
                <strong>Name:</strong>
                <p>{{ $employee->name }}</p>
            </div>

            <!-- NIK -->
            <div class="mb-3">
                <strong>NIK:</strong>
                <p>{{ Crypt::decryptString($employee->nik) }}</p>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <strong>Email:</strong>
                <p>{{ $employee->email }}</p>
            </div>

            <!-- Departemen -->
            <div class="mb-3">
                <strong>Departemen:</strong>
                <p>{{ $employee->departemen->name }}</p>
            </div>

            <!-- Jabatan -->
            <div class="mb-3">
                <strong>Jabatan:</strong>
                <p>{{ $employee->jabatan->name }}</p>
            </div>

            <!-- Gada -->
            <div class="mb-3">
                <strong>Gada:</strong>
                <p>{{ $employee->gada->name }}</p>
            </div>

            <!-- Sertifikat -->
            <div class="mb-3">
                <strong>Sertifikat:</strong>
                @if($employee->sertifikat)
                    <a href="{{ asset('storage/' . $employee->sertifikat) }}" target="_blank">View Certificate</a>
                @else
                    <p>No certificate uploaded</p>
                @endif
            </div>
            @if(auth()->user()->role === 'head')
            <!-- Keterangan -->
            <div class="mb-3">
                <strong>Notes:</strong>
                <p>{{ $employee->keterangan }}</p>
            </div>

            <!-- TMT -->
            <div class="mb-3">
                <strong>TMT:</strong>
                <p>{{ $employee->tmt ? \Carbon\Carbon::parse($employee->tmt)->format('d M Y') : 'Not set' }}</p>
            </div>
            @endif
            <!-- TTL -->
            <div class="mb-3">
                <strong>TTL:</strong>
                <p>{{ $employee->ttl ? \Carbon\Carbon::parse($employee->ttl)->format('d M Y') : 'Not set' }}</p>
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <strong>Phone:</strong>
                <p>{{ Crypt::decryptString($employee->telp) }}</p>
            </div>

            <!-- NIK KTP -->
            <div class="mb-3">
                <strong>NIK KTP:</strong>
                <p>{{ Crypt::decryptString($employee->nik_ktp) }}</p>
            </div>

            <!-- Validity -->
            <div class="mb-3">
                <strong>Validity:</strong>
                <p>{{ $employee->berlaku }}</p>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <strong>Status:</strong>
                <p>{{ $employee->status }}</p>
            </div>

            <!-- Pendidikan -->
            <div class="mb-3">
                <strong>Pendidikan:</strong>
                <p>{{ $employee->pendidikan }}</p>
            </div>

            <!-- Mother's Name -->
            <div class="mb-3">
                <strong>Mother's Name:</strong>
                <p>{{ Crypt::decryptString($employee->nama_ibu) }}</p>
            </div>

            <!-- Registration Number -->
            <div class="mb-3">
                <strong>Registration Number:</strong>
                <p>{{ Crypt::decryptString($employee->no_regkta) }}</p>
            </div>

            <!-- KTA Number -->
            <div class="mb-3">
                <strong>KTA Number:</strong>
                <p>{{ Crypt::decryptString($employee->no_kta) }}</p>
            </div>

            <!-- Address on KTP -->
            <div class="mb-3">
                <strong>Address on KTP:</strong>
                <p>{{ Crypt::decryptString($employee->alamat_ktp) }}</p>
            </div>

            <!-- Address on Domisili -->
            <div class="mb-3">
                <strong>Address on Domisili:</strong>
                <p>{{ Crypt::decryptString($employee->alamat_domisili) }}</p>
            </div>

            <!-- BPJS KET -->
            <div class="mb-3">
                <strong>BPJS KET:</strong>
                <p>{{ Crypt::decryptString($employee->bpjsket) }}</p>
            </div>

            <!-- NPWP Number -->
            <div class="mb-3">
                <strong>NPWP Number:</strong>
                <p>{{ Crypt::decryptString($employee->no_npwp) }}</p>
            </div>
        </div>
        <div class="card-footer">
            <!-- Tombol Edit dan Hapus -->
            <a href="{{ route('admin.employee.edit', $employee->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('admin.employee.destroy', $employee->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
            </form>
        </div>
    </div>
@stop
