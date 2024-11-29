<?php

namespace App\Exports;

use App\Models\Employee;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Crypt;

class EmployeeExport
{
    /**
     * Mengexport data ke format Excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function download()
    {
        // Ambil semua data employees
        $employees = Employee::all();

        // Membuat instance Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Menetapkan sheet aktif
        $sheet = $spreadsheet->getActiveSheet();

        // Menetapkan headings
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Keterangan');
        $sheet->setCellValue('D1', 'TMT');
        $sheet->setCellValue('E1', 'NIK');
        $sheet->setCellValue('F1', 'Departemen ID');
        $sheet->setCellValue('G1', 'Jabatan ID');
        $sheet->setCellValue('H1', 'Gada ID');
        $sheet->setCellValue('I1', 'TTL');
        $sheet->setCellValue('J1', 'Telepon');
        $sheet->setCellValue('K1', 'NIK KTP');
        $sheet->setCellValue('L1', 'Berlaku');
        $sheet->setCellValue('M1', 'Status');
        $sheet->setCellValue('N1', 'Pendidikan');
        $sheet->setCellValue('O1', 'Email');
        $sheet->setCellValue('P1', 'Nama Ibu');
        $sheet->setCellValue('Q1', 'Sertifikat');
        $sheet->setCellValue('R1', 'No Reg KTA');
        $sheet->setCellValue('S1', 'No KTA');
        $sheet->setCellValue('T1', 'Alamat KTP');
        $sheet->setCellValue('U1', 'Alamat Domisili');
        $sheet->setCellValue('V1', 'BPJS Ketenagakerjaan');
        $sheet->setCellValue('W1', 'No NPWP');
        $sheet->setCellValue('X1', 'Created At');
        $sheet->setCellValue('Y1', 'Updated At');

        // Menambahkan data dari database ke dalam sheet
        $row = 2; // Baris kedua untuk data
        foreach ($employees as $employee) {
            $sheet->setCellValue('A' . $row, $employee->id);
            $sheet->setCellValue('B' . $row, $employee->name);
            $sheet->setCellValue('C' . $row, $employee->keterangan);
            $sheet->setCellValue('D' . $row, $employee->tmt);
            $sheet->setCellValue('E' . $row, Crypt::decryptString($employee->nik));
            $sheet->setCellValue('F' . $row, $employee->departemen_id);
            $sheet->setCellValue('G' . $row, $employee->jabatan_id);
            $sheet->setCellValue('H' . $row, $employee->gada_id);
            $sheet->setCellValue('I' . $row, $employee->ttl);
            $sheet->setCellValue('J' . $row, Crypt::decryptString($employee->telp));
            $sheet->setCellValue('K' . $row, Crypt::decryptString($employee->nik_ktp));
            $sheet->setCellValue('L' . $row, $employee->berlaku);
            $sheet->setCellValue('M' . $row, $employee->status);
            $sheet->setCellValue('N' . $row, $employee->pendidikan);
            $sheet->setCellValue('O' . $row, $employee->email);
            $sheet->setCellValue('P' . $row, Crypt::decryptString($employee->nama_ibu));
            $sheet->setCellValue('Q' . $row, $employee->sertifikat);
            $sheet->setCellValue('R' . $row, Crypt::decryptString($employee->no_regkta));
            $sheet->setCellValue('S' . $row, Crypt::decryptString($employee->no_kta));
            $sheet->setCellValue('T' . $row, Crypt::decryptString($employee->alamat_ktp));
            $sheet->setCellValue('U' . $row, Crypt::decryptString($employee->alamat_domisili));
            $sheet->setCellValue('V' . $row, Crypt::decryptString($employee->bpjsket));
            $sheet->setCellValue('W' . $row, Crypt::decryptString($employee->no_npwp));
            $sheet->setCellValue('X' . $row, $employee->created_at);
            $sheet->setCellValue('Y' . $row, $employee->updated_at);
            $row++;
        }

        // Menyimpan file Excel dan mengunduhnya
        $writer = new Xlsx($spreadsheet);
        $fileName = 'employees.xlsx';

        // Output file ke browser
        $response = response()->stream(function() use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment;filename="employees.xlsx"',
            'Cache-Control' => 'max-age=0',
        ]);

        return $response;
    }
}
