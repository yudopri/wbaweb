<!-- Nama -->
<div class="form-group">
    <label for="name">Nama</label>
    <input type="text" name="name" id="name" class="form-control" 
        value="{{ old('name', isset($employee) ? $employee->name : '') }}" required>
</div>

<!-- NIK -->
<div class="form-group">
    <label for="nik">NIK</label>
    <input type="text" name="nik" id="nik" class="form-control" 
        value="{{ old('nik', isset($employee) ? $employee->nik : '') }}" required>
</div>

<!-- Email -->
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control" 
        value="{{ old('email', isset($employee) ? $employee->email : '') }}" required>
</div>

<!-- Departemen -->
<div class="form-group">
    <label for="departemen_id">Departemen</label>
    <select name="departemen_id" id="departemen_id" class="form-control" required>
        <option value="">Pilih Departemen</option>
        @foreach($departemens as $departemen)
            <option value="{{ $departemen->id }}" 
                {{ old('departemen_id', isset($employee) ? $employee->departemen_id : '') == $departemen->id ? 'selected' : '' }}>
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
                {{ old('jabatan_id', isset($employee) ? $employee->jabatan_id : '') == $jabatan->id ? 'selected' : '' }}>
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
                {{ old('gada_id', isset($employee) ? $employee->gada_id : '') == $gada->id ? 'selected' : '' }}>
                {{ $gada->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- Sertifikat -->
<div class="form-group">
    <label for="sertifikat">Sertifikat</label>
    <input type="file" name="sertifikat" id="sertifikat" class="form-control">
    @if(isset($employee) && $employee->sertifikat)
        <p><a href="{{ asset('storage/' . $employee->sertifikat) }}" target="_blank">Lihat Sertifikat</a></p>
    @endif
</div>


@if(auth()->user()->role === 'head')
<!-- Keterangan -->
<div class="form-group">
    <label for="keterangan">Keterangan</label>
    <textarea name="keterangan" id="keterangan" class="form-control">{{ old('keterangan',  isset($employee) ? $employee->keterangan : '') }}</textarea>
</div>

<!-- TMT -->
<div class="form-group">
    <label for="tmt">TMT</label>
    <input type="date" name="tmt" id="tmt" class="form-control" value="{{ old('tmt',  isset($employee) ? $employee->tmt : '') }}">
</div>
@endif

<!-- TTL -->
<div class="form-group">
    <label for="ttl">TTL</label>
    <input type="date" name="ttl" id="ttl" class="form-control" value="{{ old('ttl',  isset($employee) ? $employee->ttl : '') }}" required>
</div>

<!-- Input lainnya -->
@php
    $fields = [
        'telp' => 'Telp',
        'nik_ktp' => 'NIK KTP',
        'berlaku' => 'Berlaku',
        'status' => 'Status',
        'pendidikan' => 'Pendidikan',
        'nama_ibu' => 'Nama Ibu',
        'no_regkta' => 'No Reg KTA',
        'no_kta' => 'No KTA',
        'alamat_ktp' => 'Alamat KTP',
        'alamat_domisili' => 'Alamat Domisili',
        'bpjsket' => 'BPJS Ketenagakerjaan',
        'no_npwp' => 'No NPWP'
    ];
@endphp

@foreach ($fields as $field => $label)
    <div class="form-group">
        <label for="{{ $field }}">{{ $label }}</label>
        <input type="text" name="{{ $field }}" id="{{ $field }}" class="form-control" value="{{ old($field,  isset($employee) ? $employee->$field : '')}}" required>
    </div>
@endforeach
