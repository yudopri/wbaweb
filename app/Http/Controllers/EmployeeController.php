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
use App\Imports\EmployeeImport;

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
 
 
     // Import Employees
     public function import(Request $request)
     {
         $request->validate([
             'file' => 'required|mimes:xlsx,csv',
         ]);
 
         Excel::import(new EmployeesImport, $request->file('file'));
 
         return redirect()->route('admin.employee.index')->with('success', 'Data berhasil diimpor!');
     }
}
