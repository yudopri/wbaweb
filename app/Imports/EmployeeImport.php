<?php
namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeesImport implements ToModel
{
    public function model(array $row)
    {
        return new Employee([
            'name' => $row[0],
            'nik' => $row[1],
            'email' => $row[2],
            'departemen_id' => $row[3],
            'jabatan_id' => $row[4],
            'gada' => $row[5],
            'sertifikat' => $row[6],
        ]);
    }
}
