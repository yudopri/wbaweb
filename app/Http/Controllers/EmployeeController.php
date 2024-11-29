<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\Gada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt; // Correct import for Crypt
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeeExport;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;


class EmployeeController extends Controller
{
    // Menampilkan daftar employee dengan pencarian dan filter
    public function index(Request $request)
    {
        $search = $request->input('search');
        $departemenId = $request->input('departemen_id');
        $jabatanId = $request->input('jabatan_id');
        $gada = $request->input('gada');

        $employees = Employee::with(['departemen', 'jabatan', 'gada']) // Eager loading relasi
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%$search%")
                      ->orWhere('nik', 'like', "%$search%");
            })
            ->when($departemenId, function ($query, $departemenId) {
                $query->where('departemen_id', $departemenId);
            })
            ->when($jabatanId, function ($query, $jabatanId) {
                $query->where('jabatan_id', $jabatanId);
            })
            ->when($gada !== null, function ($query, $gada) {
                $query->where('gada', $gada);
            })
            ->paginate(10);

        $departemens = Departemen::all();
        $jabatans = Jabatan::all();
        $gadas = Gada::all();

        return view('admin.employee.index', compact('employees', 'departemens', 'jabatans', 'gadas'));
    }



    // Menampilkan form tambah employee
    public function create()
    {
        $departemens = Departemen::all();
        $jabatans = Jabatan::all();
        $gadas = Gada::all();
        return view('admin.employee.create', compact('departemens', 'jabatans', 'gadas'));
    }

    // Menyimpan data employee baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|unique:employees',
            'email' => 'required|email|unique:employees',
            'departemen_id' => 'required|exists:departemens,id',
            'jabatan_id' => 'required|exists:jabatans,id',
            'gada_id' => 'required|exists:gadas,id',
            'sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string',
            'tmt' => 'nullable|date',
            'ttl' => 'nullable|date',
            'telp' => 'nullable|string',
            'nik_ktp' => 'nullable|string',
            'berlaku' => 'nullable|string',
            'status' => 'nullable|string',
            'pendidikan' => 'nullable|string',
            'nama_ibu' => 'nullable|string',
            'no_regkta' => 'nullable|string',
            'no_kta' => 'nullable|string',
            'alamat_ktp' => 'nullable|string',
            'alamat_domisili' => 'nullable|string',
            'bpjsket' => 'nullable|string',
            'no_npwp' => 'nullable|string',
        ]);

        // Encrypt sensitive fields before saving
        $data = $request->all();

        $data['nik'] = Crypt::encryptString($request->nik);
        $data['nik_ktp'] = Crypt::encryptString($request->nik_ktp);
        $data['no_regkta'] = Crypt::encryptString($request->no_regkta);
        $data['no_kta'] = Crypt::encryptString($request->no_kta);
        $data['nama_ibu'] = Crypt::encryptString($request->nama_ibu);
        $data['alamat_ktp'] = Crypt::encryptString($request->alamat_ktp);
        $data['alamat_domisili'] = Crypt::encryptString($request->alamat_domisili);
        $data['bpjsket'] = Crypt::encryptString($request->bpjsket);
        $data['telp'] = Crypt::encryptString($request->telp);
        $data['no_npwp'] = Crypt::encryptString($request->no_npwp);

        if ($request->hasFile('sertifikat')) {
            $data['sertifikat'] = $request->file('sertifikat')->store('sertificates', 'public');
        }

        Employee::create($data);

        return redirect()->route('admin.employee.index')->with('success', 'Employee created successfully.');
    }

    // Menampilkan detail employee
    public function show($id)
{
    $employee = Employee::with(['departemen', 'jabatan', 'gada'])->findOrFail($id);
    return view('admin.employee.show', compact('employee'));
}

    // Menampilkan form edit employee
    public function edit($id)
{
    // Fetch the employee by ID or handle the error if not found
    $employee = Employee::find($id);

    // If the employee is not found, redirect or show an error
    if (!$employee) {
        return redirect()->route('admin.employee.index')->with('error', 'Employee not found');
    }

    // Fetch other data like departments, positions, and gadgets
    $departements = Departemen::all();  // Correct spelling here
    $jabatans = Jabatan::all();
    $gadas = Gada::all();

    // Pass the data to the view
    return view('admin.employee.edit', compact('employee', 'departements', 'jabatans', 'gadas'));
}


    // Menghapus employee
    public function destroy(Employee $employee)
    {
        // Hapus file sertifikat terkait jika ada
        if ($employee->sertifikat) {
            Storage::delete('public/sertificates/' . $employee->sertifikat);
        }

        $employee->delete();

        return redirect()->route('admin.employee.index')->with('success', 'Employee deleted successfully.');
    }

    // Update employee data
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|unique:employees,nik,' . $employee->id,
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'departemen_id' => 'required|exists:departemens,id',
            'jabatan_id' => 'required|exists:jabatans,id',
            'gada_id' => 'required|exists:gadas,id',
            'sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string',
            'tmt' => 'nullable|date',
            'ttl' => 'nullable|date',
            'telp' => 'nullable|string',
            'nik_ktp' => 'nullable|string',
            'berlaku' => 'nullable|string',
            'status' => 'nullable|string',
            'pendidikan' => 'nullable|string',
            'nama_ibu' => 'nullable|string',
            'no_regkta' => 'nullable|string',
            'no_kta' => 'nullable|string',
            'alamat_ktp' => 'nullable|string',
            'alamat_domisili' => 'nullable|string',
            'bpjsket' => 'nullable|string',
            'no_npwp' => 'nullable|string',
        ]);

        $data = $request->all();

        // Encrypt sensitive fields before saving
        $data['nik'] = Crypt::encryptString($request->nik);
        $data['nik_ktp'] = Crypt::encryptString($request->nik_ktp);
        $data['no_regkta'] = Crypt::encryptString($request->no_regkta);
        $data['no_kta'] = Crypt::encryptString($request->no_kta);
        $data['nama_ibu'] = Crypt::encryptString($request->nama_ibu);
        $data['alamat_ktp'] = Crypt::encryptString($request->alamat_ktp);
        $data['alamat_domisili'] = Crypt::encryptString($request->alamat_domisili);
        $data['bpjsket'] = Crypt::encryptString($request->bpjsket);
        $data['telp'] = Crypt::encryptString($request->telp);
        $data['no_npwp'] = Crypt::encryptString($request->no_npwp);

        if ($request->hasFile('sertifikat')) {
            // Hapus file sertifikat lama
            if ($employee->sertifikat) {
                Storage::delete('public/sertificates/' . $employee->sertifikat);
            }
            $data['sertifikat'] = $request->file('sertifikat')->store('sertificates', 'public');
        }

        $employee->update($data);

        return redirect()->route('admin.employee.index')->with('success', 'Employee updated successfully.');
    }
     // Export Employees
     public function export()
     {
         return (new EmployeeExport())->download();
     }


     public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv',
    ]);

    // Simpan file yang diunggah ke penyimpanan sementara
    $filePath = $request->file('file')->store('temp');

    // Path lengkap file yang diunggah
    $fullPath = Storage::path($filePath);

    // Baca file Excel menggunakan Spreadsheet
    $spreadsheet = IOFactory::load($fullPath);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    // Mulai dari baris kedua (skip header)
    foreach ($rows as $index => $row) {
        if ($index === 0) continue;

        Employee::create([
            'name' => $row[1],
            'nik' => Crypt::encryptString($row[4]), // Encrypt the 'nik'
            'email' => $row[14],
            'departemen_id' => $row[5],
            'jabatan_id' => $row[6],
            'gada_id' => $row[7],
            'sertifikat' => $row[16], // Assumes the path or filename is in the spreadsheet
            'keterangan' => $row[2],
            'tmt' => $this->transformDate($row[3]), // Ensure this function is correctly implemented or use Carbon
            'ttl' => $this->transformDate($row[8]), // Ensure this function is correctly implemented or use Carbon
            'telp' => Crypt::encryptString($row[9]), // Encrypt the 'telp'
            'nik_ktp' => Crypt::encryptString($row[10]), // Encrypt the 'nik_ktp'
            'berlaku' => $row[11],
            'status' => $row[12],
            'pendidikan' => $row[13],
            'nama_ibu' => Crypt::encryptString($row[15]), // Encrypt the 'nama_ibu'
            'no_regkta' => Crypt::encryptString($row[17]), // Encrypt the 'no_regkta'
            'no_kta' => Crypt::encryptString($row[18]), // Encrypt the 'no_kta'
            'alamat_ktp' => Crypt::encryptString($row[19]), // Encrypt the 'alamat_ktp'
            'alamat_domisili' => Crypt::encryptString($row[20]), // Encrypt the 'alamat_domisili'
            'bpjsket' => Crypt::encryptString($row[21]), // Encrypt the 'bpjsket'
            'no_npwp' => Crypt::encryptString($row[22]), // Encrypt the 'no_npwp'
        ]);
    }

    // Hapus file sementara
    Storage::delete($filePath);

    return redirect()->route('admin.employee.index')->with('success', 'Data berhasil diimpor!');
}
private function transformDate($date)
{
    // Jika tanggal adalah instance Carbon, langsung kembalikan
    if ($date instanceof \Carbon\Carbon) {
        return $date->format('Y-m-d');
    }

    // Jika tanggal berupa string, ubah ke format Y-m-d
    try {
        return \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    } catch (\Exception $e) {
        try {
            return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
        } catch (\Exception $e) {
            return null; // Kembalikan null jika gagal
        }
    }
}

}
