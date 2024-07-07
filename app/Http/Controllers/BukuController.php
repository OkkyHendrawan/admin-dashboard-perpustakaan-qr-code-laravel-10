<?php

namespace App\Http\Controllers;

use App\Models\BukuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $buku = BukuModel::getBuku();
        $data['header_tittle']= "Daftar Buku";
        return view('admin.buku.list', compact('buku'), $data);
    }
    // Menampilkan form untuk menambahkan buku baru
    public function form_create()
    {
        $data['header_tittle']= "Tambah Buku";
        return view('admin.buku.add', $data);
    }
    // Proses penambahan buku baru
    public function proses_create(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'buku_judul' => 'required|string|max:255',
            'buku_nama_pengarang' => 'required|string|max:255|unique:buku,buku_nama_pengarang',
            'tahun_terbit' => 'nullable|date_format:Y',
            'buku_isbn' => 'nullable|string|max:20',
            'buku_status' => 'nullable|in:Tersedia,Dipinjam',
            'buku_kondisi' => 'nullable|in:Baik,Rusak',
            'buku_jumlah_halaman' => 'nullable|integer',
            'buku_jumlah_buku' => 'nullable|integer',
            'buku_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'buku_pdf' => 'nullable|mimes:pdf|max:10000',
            'buku_word' => 'nullable|mimes:doc,docx|max:10000',
        ]);
            // Ambil kode buku terakhir dari database
            $lastBuku = BukuModel::orderBy('buku_kode', 'desc')->first();

            // Buat kode buku baru
            if ($lastBuku) {
                $lastKode = (int)substr($lastBuku->buku_kode, 1);
                $newKode = 'B' . ($lastKode + 1);
            } else {
                $newKode = 'B1'; // Jika belum ada buku, mulai dari B1
            }
            $buku = new BukuModel($request->all());
            $buku->buku_kode = $newKode;
        // Simpan file foto ke folder public/buku-gambar
        if ($request->hasFile('buku_gambar')) {
            $photo = $request->file('buku_gambar');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('buku-gambar'), $photoName); // Pindahkan file ke folder public/buku-gambar
            $buku->buku_gambar = $photoName; // Simpan nama file foto ke database
        }
        // Simpan file PDF ke folder public/buku-pdf
        if ($request->hasFile('buku_pdf')) {
            $pdf = $request->file('buku_pdf');
            $pdfName = time() . '_' . $pdf->getClientOriginalName();
            $pdf->move(public_path('buku-pdf'), $pdfName); // Pindahkan file ke folder public/buku-pdf
            $buku->buku_pdf = $pdfName; // Simpan nama file PDF ke database
        }
        // Simpan file Word ke folder public/buku-word
        if ($request->hasFile('buku_word')) {
            $word = $request->file('buku_word');
            $wordName = time() . '_' . $word->getClientOriginalName();
            $word->move(public_path('buku-word'), $wordName); // Pindahkan file ke folder public/buku-word
            $buku->buku_word = $wordName; // Simpan nama file Word ke database
        }
        $buku->created_by = Auth::user()->name;
        $buku->is_delete = 0;
        // Set waktu saat ini sebagai waktu Indonesia Barat (WIB)
        $currentDateTime = now('Asia/Jakarta');
        $buku->created_at = $currentDateTime;
        $buku->updated_at = $currentDateTime;
        $buku->save();
        // Redirect ke halaman daftar buku dengan pesan sukses
        return redirect()->route('admin.buku.list')->with('success', 'Buku berhasil ditambahkan.');
    }
    // Menampilkan form untuk mengedit buku
    public function edit($buku_id)
    {
        $buku = BukuModel::findOrFail($buku_id);
        $data['header_tittle']= "Edit Buku";
        return view('admin.buku.edit', compact('buku'), $data);
    }
    // Proses update data buku
    public function update(Request $request, $buku_id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'buku_judul' => 'required|string|max:255',
            'buku_nama_pengarang' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|date_format:Y',
            'buku_isbn' => 'nullable|string|max:20',
            'buku_status' => 'nullable|in:Tersedia,Dipinjam',
            'buku_kondisi' => 'nullable|in:Baik,Rusak',
            'buku_jumlah_halaman' => 'nullable|integer',
            'buku_jumlah_buku' => 'nullable|integer',
            'buku_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'buku_pdf' => 'nullable|mimes:pdf|max:10000',
            'buku_word' => 'nullable|mimes:doc,docx|max:10000',
        ]);

        $buku = BukuModel::findOrFail($buku_id);
        $buku->fill($request->all());
        $buku->updated_by = Auth::user()->name;
        // Proses gambar
        if ($request->hasFile('buku_gambar')) {
            $gambar = $request->file('buku_gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('buku-gambar'), $gambarName); // Simpan gambar ke folder public/buku-gambar
            $buku->buku_gambar = $gambarName; // Simpan nama gambar ke database
        }
        // Proses PDF
        if ($request->hasFile('buku_pdf')) {
            $pdf = $request->file('buku_pdf');
            $pdfName = time() . '_' . $pdf->getClientOriginalName();
            $pdf->move(public_path('buku-pdf'), $pdfName); // Simpan PDF ke folder public/buku-pdf
            $buku->buku_pdf = $pdfName; // Simpan nama PDF ke database
        }

        // Proses Word
        if ($request->hasFile('buku_word')) {
            $word = $request->file('buku_word');
            $wordName = time() . '_' . $word->getClientOriginalName();
            $word->move(public_path('buku-word'), $wordName); // Simpan Word ke folder public/buku-word
            $buku->buku_word = $wordName; // Simpan nama Word ke database
        }
        // Set waktu saat ini sebagai waktu Indonesia Barat (WIB)
        $currentDateTime = now('Asia/Jakarta');
        $buku->updated_at = $currentDateTime;

        $buku->save();

        // Redirect ke halaman daftar buku dengan pesan sukses
        return redirect()->route('admin.buku.list')->with('success', 'Buku berhasil diperbarui.');
    }
    // Menghapus buku secara lembut yang artinya cuma di tabel saja tidak di database
    public function softDeleteBuku($buku_id)
    {
        // Panggil metode softDeleteBuku dari model BukuModel
        $buku = BukuModel::softDeleteBuku($buku_id);

        if ($buku) {
            // Jika buku berhasil dihapus secara lembut, lakukan tindakan sesuai kebutuhan
            return redirect()->back()->with('success', 'Buku berhasil dihapus.');
        } else {
            // Jika buku tidak ditemukan, tampilkan pesan kesalahan
            return redirect()->back()->with('error', 'Buku tidak ditemukan.');
        }
    }
    // Mencari anggota berdasarkan kriteria tertentu
    public function search(Request $request)
    {
        $data['header_tittle'] = "Mencari Buku";
        $query = BukuModel::query()->where('is_delete', 0); // Filter Tabel Buku yang belum dihapus

        // Filter berdasarkan nama buku
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('buku_judul', 'like', '%' . $searchTerm . '%')
                  ->orWhere('buku_nama_pengarang', 'like', '%' . $searchTerm . '%');
            });
        }
        // Mengambil data buku yang telah difilter dan menggunakan paginasi
        $buku = $query->paginate(5); // Menggunakan paginate dengan jumlah per halaman 5
        // Kembalikan view bersama dengan data Buku
        return view('admin.buku.list', compact('buku'), $data);
    }
}
