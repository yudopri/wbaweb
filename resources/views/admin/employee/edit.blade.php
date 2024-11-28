@extends('adminlte::page')

@section('title', 'Edit Employee')

@section('content_header')
    <h1>Edit Employee</h1>
@stop

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control" 
                value="{{ old('name',$employee->name) }}" required>
        </div>

        <!-- NIK -->
        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" name="nik" id="nik" class="form-control" 
                value="{{  Crypt::decryptString(old('nik', $employee->nik)) }}" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" 
                value="{{ old('email', $employee->email) }}" required>
        </div>

        <!-- Departemen -->
        <div class="form-group">
            <label for="departemen_id">Departemen</label>
            <select name="departemen_id" id="departemen_id" class="form-control" required>
                <option value="">Pilih Departemen</option>
                @foreach($departements as $departemen)
                    <option value="{{ $departemen->id }}" 
                        {{ old('departemen_id', $employee->departemen_id) == $departemen->id ? 'selected' : '' }}>
                        {{ $departemen->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Jabatan -->
        <div class="form-group">
            <label for="jabatan_id">Jabatan</label>
            <select name="jabatan_id" id="jabatan_id" class="form-control" required>
                <option value="">Pilih Jabatan</option>
                @foreach($jabatans as $jabatan)
                    <option value="{{ $jabatan->id }}" 
                        {{ old('jabatan_id', $employee->jabatan_id) == $jabatan->id ? 'selected' : '' }}>
                        {{ $jabatan->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Gada -->
        <div class="form-group">
            <label for="gada_id">Gada</label>
            <select name="gada_id" id="gada_id" class="form-control" required>
                <option value="">Pilih Gada</option>
                @foreach($gadas as $gada)
                    <option value="{{ $gada->id }}" 
                        {{ old('gada_id', $employee->gada_id) == $gada->id ? 'selected' : '' }}>
                        {{ $gada->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Sertifikat -->
        <div class="form-group">
            <label for="sertifikat">Sertifikat</label>
            <input type="file" name="sertifikat" id="sertifikat" class="form-control">
            @if($employee->sertifikat)
                <p><a href="{{ asset('storage/' . $employee->sertifikat) }}" target="_blank">Lihat Sertifikat</a></p>
            @endif
        </div>

        @if(auth()->user()->role === 'head')
            <!-- Keterangan -->
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control">{{ old('keterangan', $employee->keterangan) }}</textarea>
            </div>

            <!-- TMT -->
            <div class="form-group">
                <label for="tmt">TMT</label>
                <input type="date" name="tmt" id="tmt" class="form-control" value="{{ old('tmt', $employee->tmt) }}">
            </div>
        @endif

        <!-- TTL -->
        <div class="form-group">
            <label for="ttl">TTL</label>
            <input type="date" name="ttl" id="ttl" class="form-control" value="{{ old('ttl', $employee->ttl) }}" required>
        </div>

       <!-- Additional Input Fields -->

<div class="form-group">
    <label for="telp">Telp</label>
    <input type="text" name="telp" id="telp" class="form-control" 
        value="{{  Crypt::decryptString(old('telp', $employee->telp)) }}" required>
</div>

<div class="form-group">
    <label for="nik_ktp">NIK KTP</label>
    <input type="text" name="nik_ktp" id="nik_ktp" class="form-control" 
        value="{{  Crypt::decryptString(old('nik_ktp',$employee->nik_ktp)) }}" required>
</div>

<div class="form-group">
    <label for="berlaku">Berlaku</label>
    <input type="text" name="berlaku" id="berlaku" class="form-control" 
        value="{{ old('berlaku', $employee->berlaku) }}" required>
</div>

<div class="form-group">
    <label for="status">Status</label>
    <input type="text" name="status" id="status" class="form-control" 
        value="{{ old('status', $employee->status) }}" required>
</div>

<div class="form-group">
    <label for="pendidikan">Pendidikan</label>
    <input type="text" name="pendidikan" id="pendidikan" class="form-control" 
        value="{{ old('pendidikan', $employee->pendidikan) }}" required>
</div>

<div class="form-group">
    <label for="nama_ibu">Nama Ibu</label>
    <input type="text" name="nama_ibu" id="nama_ibu" class="form-control" 
        value="{{  Crypt::decryptString(old('nama_ibu', $employee->nama_ibu)) }}" required>
</div>

<div class="form-group">
    <label for="no_regkta">No Reg KTA</label>
    <input type="text" name="no_regkta" id="no_regkta" class="form-control" 
        value="{{  Crypt::decryptString(old('no_regkta',$employee->no_regkta)) }}" required>
</div>

<div class="form-group">
    <label for="no_kta">No KTA</label>
    <input type="text" name="no_kta" id="no_kta" class="form-control" 
        value="{{  Crypt::decryptString(old('no_kta', $employee->no_kta)) }}" required>
</div>

<div class="form-group">
    <label for="alamat_ktp">Alamat KTP</label>
    <input type="text" name="alamat_ktp" id="alamat_ktp" class="form-control" 
        value="{{  Crypt::decryptString(old('alamat_ktp', $employee->alamat_ktp)) }}" required>
</div>

<div class="form-group">
    <label for="alamat_domisili">Alamat Domisili</label>
    <input type="text" name="alamat_domisili" id="alamat_domisili" class="form-control" 
        value="{{  Crypt::decryptString(old('alamat_domisili', $employee->alamat_domisili)) }}" required>
</div>

<div class="form-group">
    <label for="bpjsket">BPJS Ketenagakerjaan</label>
    <input type="text" name="bpjsket" id="bpjsket" class="form-control" 
        value="{{ old('bpjsket', Crypt::decryptString($employee->bpjsket)) }}" required>
</div>

<div class="form-group">
    <label for="no_npwp">No NPWP</label>
    <input type="text" name="no_npwp" id="no_npwp" class="form-control" 
        value="{{  Crypt::decryptString(old('no_npwp', $employee->no_npwp)) }}" required>
</div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@stop
