<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\BukuModel;
use App\Models\AnggotaModel;
use Illuminate\Http\Request;
use App\Models\PeminjamanModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PeminjamanController extends Controller
{
    const FINE_RATE = 2000; // Tarif denda per hari keterlambatan

    // Fungsi untuk menghitung denda berdasarkan tanggal pengembalian dan status
    public function calculateFine($returnDate, $status)
    {
        if ($status === 'Kembali') {
            return 0;
        }

        $today = Carbon::today();
        $returnDate = Carbon::parse($returnDate);

        if ($returnDate->isPast()) {
            $daysLate = $returnDate->diffInDays($today);
            return $daysLate * self::FINE_RATE;
        }
        return 0;
    }

    // Menampilkan daftar peminjaman
    public function index()
    {
        $peminjaman = PeminjamanModel::getPeminjaman();

        // Update denda untuk setiap peminjaman
        foreach ($peminjaman as $item) {
            $item->peminjaman_denda = $this->calculateFine($item->peminjaman_tgl_pengembalian, $item->status);
            $item->save();
        }
        $data['header_tittle']= "Daftar Peminjaman";

        return view('admin.peminjaman.list', compact('peminjaman'), $data);
    }

    // Menampilkan form untuk menambahkan peminjaman baru
    public function form_create()
    {
        $data['header_tittle']= "Tambah Peminjaman";
        $anggota = AnggotaModel::where('is_delete', 0)->get();
        $buku = BukuModel::where('is_delete', 0)->get();
        return view('admin.peminjaman.add', compact('anggota', 'buku'), $data);
    }

    // Proses penambahan peminjaman baru
    public function proses_create(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'peminjaman_anggota_id' => 'required',
            'peminjaman_buku_id' => 'required',
            'peminjaman_tgl' => 'required|date',
            'peminjaman_tgl_pengembalian' => 'required|date',
            'status' => 'required|in:Dipinjam,Kembali',
            'peminjaman_denda' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        $fine = $this->calculateFine($request->tgl_pengembalian, $request->status);

        $peminjaman = new PeminjamanModel;
        $peminjaman->peminjaman_anggota_id = $request->peminjaman_anggota_id;
        $peminjaman->peminjaman_buku_id = $request->peminjaman_buku_id;
        $peminjaman->peminjaman_tgl = $request->peminjaman_tgl;
        $peminjaman->peminjaman_tgl_pengembalian = $request->peminjaman_tgl_pengembalian;
        $peminjaman->status = $request->status;
        $peminjaman->peminjaman_denda = $fine;
        $peminjaman->created_by = Auth::user()->name;
        $peminjaman->is_delete = 0;

        // Set waktu saat ini sebagai waktu Indonesia Barat (WIB)
        $currentDateTime = now('Asia/Jakarta');
        $peminjaman->created_at = $currentDateTime;
        $peminjaman->updated_at = $currentDateTime;

        $peminjaman->save();

        // Redirect ke halaman daftar peminjaman dengan pesan sukses
        return redirect()->route('admin.peminjaman.list')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit peminjaman
    public function edit($peminjaman_id)
    {
        $data['header_tittle']= "Edit Peminjaman";
        $peminjaman = PeminjamanModel::findOrFail($peminjaman_id);
        $data['daftarBuku'] = BukuModel::daftarBuku();
        $data['daftarAnggota'] = AnggotaModel::daftarAnggota();

        // Update denda untuk peminjaman yang sedang diedit
        $peminjaman->peminjaman_denda = $this->calculateFine($peminjaman->peminjaman_tgl_pengembalian, $peminjaman->status);
        $peminjaman->save();

        return view('admin.peminjaman.edit', compact('peminjaman'), $data);
    }

    // Proses update data peminjaman
    public function update(Request $request, $peminjaman_id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'peminjaman_anggota_id' => 'required',
            'peminjaman_buku_id' => 'required',
            'peminjaman_tgl' => 'required|date',
            'peminjaman_tgl_pengembalian' => 'required|date',
            'status' => 'required|in:Dipinjam,Kembali',
            'peminjaman_denda' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        $peminjaman = PeminjamanModel::findOrFail($peminjaman_id);

        // Hitung denda baru berdasarkan tanggal pengembalian dan status
        $fine = $this->calculateFine($request->peminjaman_tgl_pengembalian, $request->status);

        $peminjaman->update([
            'peminjaman_anggota_id' => $request->peminjaman_anggota_id,
            'peminjaman_buku_id' => $request->peminjaman_buku_id,
            'peminjaman_tgl' => $request->peminjaman_tgl,
            'peminjaman_tgl_pengembalian' => $request->peminjaman_tgl_pengembalian,
            'status' => $request->status,
            'peminjaman_denda' => $fine,
            'updated_by' => Auth::user()->name,
        ]);

        // Set waktu saat ini sebagai waktu Indonesia Barat (WIB)
        $currentDateTime = now('Asia/Jakarta');
        $peminjaman->updated_at = $currentDateTime;

        $peminjaman->save();

        // Redirect ke halaman daftar peminjaman dengan pesan sukses
        return redirect()->route('admin.peminjaman.list')->with('success', 'Peminjaman berhasil diperbarui.');
    }

    // Menghapus peminjaman secara lembut yang artinya cuma di tabel saja tidak di database
    public function softDeletePeminjaman($peminjaman_id)
    {
        // Panggil metode softDeletePeminjaman dari model PeminjamanModel
        $peminjaman = PeminjamanModel::softDeletePeminjaman($peminjaman_id);

        if ($peminjaman) {
            // Jika peminjaman berhasil dihapus secara lembut, lakukan tindakan sesuai kebutuhan
            return redirect()->back()->with('success', 'Peminjaman berhasil dihapus.');
        } else {
            // Jika peminjaman tidak ditemukan, tampilkan pesan kesalahan
            return redirect()->back()->with('error', 'Peminjaman tidak ditemukan.');
        }
    }

    // Mencari peminjaman berdasarkan kriteria tertentu
    public function search(Request $request)
    {
        $data['header_tittle'] = "Mencari Peminjaman";

        $search = $request->input('search');

        $peminjaman = PeminjamanModel::select('peminjaman.*')
            ->leftJoin('anggota', 'peminjaman.peminjaman_anggota_id', '=', 'anggota.anggota_id')
            ->leftJoin('buku', 'peminjaman.peminjaman_buku_id', '=', 'buku.buku_id')
            ->where('peminjaman.is_delete', 0) // Filter Tabel Peminjaman yang belum dihapus
            ->where(function($query) use ($search) {
                $query->where('anggota.anggota_nama', 'LIKE', '%' . $search . '%')
                      ->orWhere('buku.buku_judul', 'LIKE', '%' . $search . '%');
            })
            ->paginate(5);

        // Update denda untuk setiap peminjaman
        foreach ($peminjaman as $item) {
            $item->peminjaman_denda = $this->calculateFine($item->peminjaman_tgl_pengembalian, $item->status);
            $item->save();
        }

        return view('admin.peminjaman.list', compact('peminjaman'), $data);
    }

public function cetakNota(Request $request)
{
    // Validasi data yang dikirimkan melalui request
    $request->validate([
        'peminjaman_anggota_id' => 'required',
        'peminjaman_buku_id' => 'required',
        'peminjaman_tgl' => 'required|date',
        'peminjaman_tgl_pengembalian' => 'required|date',
        'status' => 'required|in:Dipinjam,Kembali',
        'peminjaman_denda' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
    ]);

    // Temukan data anggota dan buku berdasarkan ID
    $anggota = AnggotaModel::find($request->peminjaman_anggota_id);
    $buku = BukuModel::find($request->peminjaman_buku_id);

    // Jika data anggota atau buku tidak ditemukan, lempar HTTP 404
    if (!$anggota || !$buku) {
        abort(404, 'Anggota or Buku not found');
    }

    // Hitung denda (jika ada)
    $fine = $this->calculateFine($request->peminjaman_tgl_pengembalian, $request->status);

    // Simpan data peminjaman ke dalam database
    $peminjaman = PeminjamanModel::create([
        'peminjaman_anggota_id' => $request->peminjaman_anggota_id,
        'peminjaman_buku_id' => $request->peminjaman_buku_id,
        'peminjaman_tgl' => $request->peminjaman_tgl,
        'peminjaman_tgl_pengembalian' => $request->peminjaman_tgl_pengembalian,
        'status' => $request->status,
        'peminjaman_denda' => $request->input('peminjaman_denda', 0),
    ]);

    // Data yang akan dimasukkan ke dalam QR Code
    $qrData = [
        'anggota_nama' => $anggota->anggota_nama,
        'buku_judul' => $buku->buku_judul,
        'peminjaman_tgl' => $request->peminjaman_tgl,
        'peminjaman_tgl_pengembalian' => $request->peminjaman_tgl_pengembalian,
        'status' => $request->status,
        'fine' => $fine,
        'currentDateTime' => now('Asia/Jakarta')->toDateTimeString(),
    ];

    // Generate QR Code dengan data peminjaman dalam bentuk JSON
    $qrCode = QrCode::size(100)->generate(json_encode($qrData));

    // Data untuk PDF
    $data = [
        'anggota' => $anggota,
        'buku' => $buku,
        'peminjaman_tgl' => $request->peminjaman_tgl,
        'peminjaman_tgl_pengembalian' => $request->peminjaman_tgl_pengembalian,
        'status' => $request->status,
        'fine' => $fine,
        'currentDateTime' => now('Asia/Jakarta')->toDateTimeString(),
        'qrCode' => $qrCode,
        'is_update' => false,
    ];

    // Load view PDF
    $pdf = PDF::loadView('admin.peminjaman.nota', $data);

    // Stream PDF response
    return $pdf->stream('nota-peminjaman.pdf');
}


public function updateNota(Request $request, $peminjaman_id)
{
    // Validasi data
    $validated = $request->validate([
        'peminjaman_anggota_id' => 'required',
        'peminjaman_buku_id' => 'required',
        'peminjaman_tgl' => 'required|date',
        'peminjaman_tgl_pengembalian' => 'required|date',
        'status' => 'required|in:Dipinjam,Kembali',
        'peminjaman_denda' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
    ]);

    // Temukan data peminjaman berdasarkan ID
    $peminjaman = PeminjamanModel::find($peminjaman_id);

    if (!$peminjaman) {
        abort(404, 'Peminjaman not found');
    }

    // Update data peminjaman
    $peminjaman->update([
        'peminjaman_anggota_id' => $validated['peminjaman_anggota_id'],
        'peminjaman_buku_id' => $validated['peminjaman_buku_id'],
        'peminjaman_tgl' => $validated['peminjaman_tgl'],
        'peminjaman_tgl_pengembalian' => $validated['peminjaman_tgl_pengembalian'],
        'status' => $validated['status'],
        'peminjaman_denda' => $request->input('peminjaman_denda', 0),
    ]);

    // Ambil data anggota dan buku untuk ditampilkan di nota yang diperbarui
    $anggota = AnggotaModel::find($validated['peminjaman_anggota_id']);
    $buku = BukuModel::find($validated['peminjaman_buku_id']);
    $fine = $this->calculateFine($validated['peminjaman_tgl_pengembalian'], $validated['status']);

    // Generate QR Code dengan informasi yang diperbarui
    $qrData = [
        'anggota_nama' => $anggota->anggota_nama,
        'buku_judul' => $buku->buku_judul,
        'peminjaman_tgl' => $validated['peminjaman_tgl'],
        'peminjaman_tgl_pengembalian' => $validated['peminjaman_tgl_pengembalian'],
        'status' => $validated['status'],
        'fine' => $fine,
        'currentDateTime' => now('Asia/Jakarta')->toDateTimeString(),
    ];

    $qrCode = QrCode::size(100)->generate(json_encode($qrData));

    // Data untuk nota peminjaman yang diperbarui
    $data = [
        'anggota' => $anggota,
        'buku' => $buku,
        'peminjaman_tgl' => $validated['peminjaman_tgl'],
        'peminjaman_tgl_pengembalian' => $validated['peminjaman_tgl_pengembalian'],
        'status' => $validated['status'],
        'fine' => $fine,
        'currentDateTime' => now('Asia/Jakarta')->toDateTimeString(),
        'qrCode' => $qrCode,
        'is_update' => true,
    ];

    // Load view PDF
    $pdf = PDF::loadView('admin.peminjaman.nota', $data);

    // Stream PDF response
    return $pdf->stream('nota-peminjaman.pdf');
}

}
