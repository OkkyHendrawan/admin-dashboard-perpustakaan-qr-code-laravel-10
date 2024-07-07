<?php

namespace App\Http\Controllers;

use App\Models\BukuModel;
use App\Models\AnggotaModel;
use App\Models\PeminjamanModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil total buku, peminjaman, dan anggota yang tidak terhapus
        $totalBuku = BukuModel::where('is_delete', 0)->count();
        $totalPeminjaman = PeminjamanModel::where('is_delete', 0)->count();
        $totalAnggota = AnggotaModel::where('is_delete', 0)->count();
        // Total kategori adalah contoh saja, asumsi total statis
        $totalKategori = 3;
        // Mengumpulkan data buku, peminjaman, dan anggota untuk 12 bulan terakhir
        $bukuData = [];
        $peminjamanData = [];
        $anggotaData = [];
        $labels = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i)->month;
            $year = now()->subMonths($i)->year;
            $totalBukuMonth = BukuModel::where('is_delete', 0)
                                      ->whereMonth('created_at', $month)
                                      ->whereYear('created_at', $year)
                                      ->count();
            $totalPeminjamanMonth = PeminjamanModel::where('is_delete', 0)
                                                  ->whereMonth('created_at', $month)
                                                  ->whereYear('created_at', $year)
                                                  ->count();
            $totalAnggotaMonth = AnggotaModel::where('is_delete', 0)
                                            ->whereMonth('created_at', $month)
                                            ->whereYear('created_at', $year)
                                            ->count();
            $bukuData[] = $totalBukuMonth;
            $peminjamanData[] = $totalPeminjamanMonth;
            $anggotaData[] = $totalAnggotaMonth;
            $labels[] = now()->subMonths($i)->format('M Y');
        }
        // Mengambil total buku bulan sebelumnya
        $lastMonthBuku = BukuModel::where('is_delete', 0)
                                 ->whereMonth('created_at', now()->subMonth()->month)
                                 ->count();
        // Mengambil total peminjaman bulan sebelumnya
        $lastMonthPeminjaman = PeminjamanModel::where('is_delete', 0)
                                             ->whereMonth('created_at', now()->subMonth()->month)
                                             ->count();
        // Mengambil total anggota bulan sebelumnya
        $lastMonthAnggota = AnggotaModel::where('is_delete', 0)
                                        ->whereMonth('created_at', now()->subMonth()->month)
                                        ->count();
        // Data untuk header
        $data['header_tittle'] = 'Dashboard';

        return view('admin.dashboard', compact(
            'totalBuku',
            'totalPeminjaman',
            'totalAnggota',
            'totalKategori',
            'bukuData',
            'peminjamanData',
            'anggotaData',
            'labels',
            'lastMonthBuku',
            'lastMonthPeminjaman',
            'lastMonthAnggota'
        ), $data);
    }
}
