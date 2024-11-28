<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'keterangan', 'tmt', 'nik', 'departemen_id', 'jabatan_id', 'gada_id',
        'ttl', 'telp', 'nik_ktp', 'berlaku', 'status', 'pendidikan', 'email', 'nama_ibu',
        'sertifikat', 'no_regkta', 'no_kta', 'alamat_ktp', 'alamat_domisili',
        'bpjsket', 'no_npwp'
    ];

    // Relasi Employee dengan Departemen
    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }

    // Relasi Employee dengan Jabatan
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    // Relasi Employee dengan Gada
    public function gada()
    {
        return $this->belongsTo(Gada::class);
    }
}
