<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        // Mendapatkan semua data gallery
        $galleries = Gallery::latest()->paginate(9);  // Menambahkan paginasi
        return view('admin.gallery.index', compact('galleries'));
    }

    public function showUser()
    {
        // Menampilkan gallery untuk pengguna dengan paginasi
        $galleries = Gallery::latest()->paginate(9);
        return view('galleries', compact('galleries'));
    }

    public function show($id)
    {
        // Mengambil gallery berdasarkan ID
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.show', compact('gallery'));
    }

    public function create()
    {
        // Menampilkan form untuk menambah gallery baru
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang masuk, termasuk gambar
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        // Simpan gambar ke direktori gallery di storage
        $imagePath = $request->file('image_url')->store('gallery', 'public'); // Menyimpan di disk 'local'

        // Simpan data gallery baru
        Gallery::create([
            'title' => $request->title,
            'image_url' => $imagePath,  // Menyimpan path gambar
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item added successfully.');
    }

    public function edit(Gallery $gallery, $id)
    {
        // Mengambil gallery berdasarkan ID untuk diedit
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        // Validasi data yang masuk, termasuk gambar
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        // Update gambar jika ada file gambar baru
        if ($request->hasFile('image_url')) {
            // Menghapus gambar lama jika ada
            if ($gallery->image_url) {
                \Storage::disk('local')->delete($gallery->image_url);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image_url')->store('gallery', 'public');
            $gallery->image_url = $imagePath;  // Update path gambar
        }

        // Update judul gallery
        $gallery->title = $request->title;

        // Simpan perubahan
        $gallery->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        // Menghapus item gallery dan gambar terkait dari storage
        if ($gallery->image_url) {
            \Storage::disk('local')->delete($gallery->image_url);
        }

        // Hapus data gallery dari database
        $gallery->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item deleted successfully.');
    }
}
