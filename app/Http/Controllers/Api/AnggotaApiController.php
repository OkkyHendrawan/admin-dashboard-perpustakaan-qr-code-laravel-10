<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnggotaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnggotaApiController extends Controller
{
    // Menampilkan daftar anggota
    public function index()
    {
        $anggota = AnggotaModel::where('is_delete', 0)->get();
        return response()->json(['success' => true, 'data' => $anggota]);
    }

    // Menambahkan anggota baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'anggota_kode' => 'required',
            'anggota_nama' => 'required|string|max:100',
            'anggota_alamat' => 'nullable|string|max:255',
            'anggota_jenis' => 'nullable|in:Aktif,Tidak Aktif',
            'anggota_tgl_daftar' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $anggota = new AnggotaModel;
        $anggota->anggota_kode = $request->anggota_kode;
        $anggota->anggota_nama = $request->anggota_nama;
        $anggota->anggota_alamat = $request->anggota_alamat;
        $anggota->anggota_jenis = $request->anggota_jenis;
        $anggota->anggota_tgl_daftar = $request->anggota_tgl_daftar;
        $anggota->is_delete = 0;
        // $anggota->created_by = Auth::user()->name;
        $anggota->created_at = now('Asia/Jakarta');
        $anggota->save();

        return response()->json(['success' => true, 'message' => 'Anggota berhasil ditambahkan', 'data' => $anggota]);
    }

    // Menampilkan detail anggota
    public function show($id)
    {
        $anggota = AnggotaModel::find($id);

        if (is_null($anggota) || $anggota->is_delete) {
            return response()->json(['success' => false, 'message' => 'Anggota tidak ditemukan']);
        }

        return response()->json(['success' => true, 'data' => $anggota]);
    }

    // Mengupdate anggota
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'anggota_kode' => 'required',
            'anggota_nama' => 'required|string|max:100',
            'anggota_alamat' => 'nullable|string|max:255',
            'anggota_jenis' => 'nullable|in:Aktif,Tidak Aktif',
            'anggota_tgl_daftar' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $anggota = AnggotaModel::find($id);

        if (is_null($anggota) || $anggota->is_delete) {
            return response()->json(['success' => false, 'message' => 'Anggota tidak ditemukan']);
        }

        $anggota->anggota_kode = $request->anggota_kode;
        $anggota->anggota_nama = $request->anggota_nama;
        $anggota->anggota_alamat = $request->anggota_alamat;
        $anggota->anggota_jenis = $request->anggota_jenis;
        $anggota->anggota_tgl_daftar = $request->anggota_tgl_daftar;
        // $anggota->updated_by = Auth::user()->name;
        $anggota->updated_at = now('Asia/Jakarta');
        $anggota->save();

        return response()->json(['success' => true, 'message' => 'Anggota berhasil diperbarui', 'data' => $anggota]);
    }

    // Menghapus anggota secara lembut
    public function destroy($id)
    {
        $anggota = AnggotaModel::find($id);

        if (is_null($anggota) || $anggota->is_delete) {
            return response()->json(['success' => false, 'message' => 'Anggota tidak ditemukan']);
        }

        $anggota->is_delete = 1;
        // $anggota->updated_by = Auth::user()->name;
        $anggota->updated_at = now('Asia/Jakarta');
        $anggota->save();

        return response()->json(['success' => true, 'message' => 'Anggota berhasil dihapus']);
    }

    // Mencari anggota
    public function search(Request $request)
    {
        $query = AnggotaModel::query()->where('is_delete', 0);

        if ($request->has('anggota_nama')) {
            $query->where('anggota_nama', 'like', '%' . $request->anggota_nama . '%');
        }

        if ($request->has('anggota_jenis')) {
            $query->where('anggota_jenis', $request->anggota_jenis);
        }

        $anggota = $query->get();

        return response()->json(['success' => true, 'data' => $anggota]);
    }
}
