<?php

namespace App\Http\Controllers;

use App\Models\BukuModel;
use App\Models\AnggotaModel;
use App\Models\PeminjamanModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;
use Dompdf\Options;

class LaporanController extends Controller
{
    // Menampilkan halaman laporan
    public function index()
    {
        $data['header_tittle']= "Daftar Laporan";
        return view('admin.laporan.list', $data);
    }

    // Proses pencetakan laporan dalam format PDF, Excel, atau Word
    public function cetak(Request $request)
    {
        $jenis = $request->input('jenis');
        $header_tittle ='';

        // Mengambil data berdasarkan jenis yang dipilih
        if ($jenis == 'anggota') {
            $data = AnggotaModel::where('is_delete', 0)->get();
            $header_tittle = 'Laporan Anggota';
        } elseif ($jenis == 'buku') {
            $data = BukuModel::where('is_delete', 0)->get();
            $header_tittle = 'Laporan Buku';
        } elseif ($jenis == 'peminjaman') {
            $data = PeminjamanModel::where('is_delete', 0)->get();
            $header_tittle = 'Laporan Peminjaman';
        } else {
            $data = null;
        }

        // Menentukan format cetakan
        if ($request->has('format')) {
            $format = $request->input('format');

            if ($format == 'pdf') {
                return $this->cetakPdf($data, $jenis);
            } elseif ($format == 'excel') {
                return $this->cetakExcel($data, $jenis);
            } elseif ($format == 'word') {
                return $this->cetakWord($data, $jenis);
            }
        }

        return view('admin.laporan.list', compact('data', 'jenis', 'header_tittle'));
    }

    // Fungsi untuk mencetak laporan dalam format PDF
    private function cetakPdf($data, $jenis)
    {
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);

        $pdfView = view('admin.laporan.pdf', compact('data', 'jenis'));
        $html = $pdfView->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $output = $dompdf->output();
        $fileName = "Laporan_$jenis.pdf";
        $pdfPath = public_path($fileName);
        file_put_contents($pdfPath, $output);

        return $dompdf->stream($fileName);
    }

    // Fungsi untuk mencetak laporan dalam format Excel
    private function cetakExcel($data, $jenis)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $header = $this->getHeader($jenis);
        $sheet->fromArray([$header], NULL, 'A1');

        if ($data->isNotEmpty()) {
            $rowData = $data->map(function ($item) use ($jenis) {
                return $this->formatRow($item, $jenis);
            })->toArray();
            $sheet->fromArray($rowData, NULL, 'A2');
            $lastColumn = $sheet->getHighestDataColumn();
            $sheet->setAutoFilter('A1:' . $lastColumn . '1');
        }

        $fileName = "Laporan_$jenis.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        exit;
    }

    // Fungsi untuk mencetak laporan dalam format Word
    private function cetakWord($data, $jenis)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        if ($jenis == 'anggota') {
            $section->addTitle('Laporan Anggota', 1);
            $table = $section->addTable();
            $table->addRow();
            $table->addCell(1750)->addText('Kode Anggota');
            $table->addCell(1750)->addText('Nama');
            $table->addCell(1750)->addText('Alamat');
            $table->addCell(1750)->addText('Jenis');
            $table->addCell(1750)->addText('Tanggal Daftar');

            foreach ($data as $value) {
                $table->addRow();
                $table->addCell(1750)->addText($value->anggota_kode);
                $table->addCell(1750)->addText($value->anggota_nama);
                $table->addCell(1750)->addText($value->anggota_alamat);
                $table->addCell(1750)->addText($value->anggota_jenis);
                $table->addCell(1750)->addText($value->anggota_tgl_daftar);
            }
        } elseif ($jenis == 'buku') {
            $section->addTitle('Laporan Buku', 1);
            $table = $section->addTable();
            $table->addRow();
            $table->addCell(1750)->addText('Kode Buku');
            $table->addCell(1750)->addText('Judul');
            $table->addCell(1750)->addText('Nama Pengarang');
            $table->addCell(1750)->addText('Tahun Terbit');
            $table->addCell(1750)->addText('ISBN');

            foreach ($data as $value) {
                $table->addRow();
                $table->addCell(1750)->addText($value->buku_kode);
                $table->addCell(1750)->addText($value->buku_judul);
                $table->addCell(1750)->addText($value->buku_nama_pengarang);
                $table->addCell(1750)->addText($value->tahun_terbit);
                $table->addCell(1750)->addText($value->buku_isbn);
            }
        } elseif ($jenis == 'peminjaman') {
            $section->addTitle('Laporan Peminjaman', 1);
            $table = $section->addTable();
            $table->addRow();
            $table->addCell(1750)->addText('Anggota');
            $table->addCell(1750)->addText('Buku');
            $table->addCell(1750)->addText('Tanggal Pinjam');
            $table->addCell(1750)->addText('Tanggal Kembali');
            $table->addCell(1750)->addText('Status');

            foreach ($data as $value) {
                $table->addRow();
                $table->addCell(1750)->addText($value->anggota->anggota_nama);
                $table->addCell(1750)->addText($value->buku->buku_judul);
                $table->addCell(1750)->addText($value->peminjaman_tgl);
                $table->addCell(1750)->addText($value->peminjaman_tgl_pengembalian);
                $table->addCell(1750)->addText($value->status);
            }
        }

        $fileName = "Laporan_$jenis.docx";
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $phpWord->save($tempFile, 'Word2007');

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }

    private function getHeader($jenis)
    {
        $header = [];
        if ($jenis == 'anggota') {
            $header = ['ID', 'Kode Anggota', 'Nama', 'Alamat', 'Jenis', 'Tanggal Daftar', 'Tanggal Buat', 'Dibuat Oleh', 'Tanggal Update', 'Di Update Oleh'];
        } elseif ($jenis == 'buku') {
            $header = ['ID', 'Gambar', 'Kode Buku', 'Judul', 'Nama Pengarang', 'Tahun Terbit', 'ISBN', 'Status', 'Kondisi', 'Jumlah Halaman', 'Jumlah Buku', 'PDF', 'WORD', 'Tanggal Buat', 'Dibuat Oleh', 'Tanggal Update', 'Di Update Oleh'];
        } elseif ($jenis == 'peminjaman') {
            $header = ['ID', 'Anggota', 'Buku', 'Tanggal Pinjam', 'Tanggal Kembali', 'Status', 'Tanggal Buat', 'Dibuat Oleh', 'Tanggal Update', 'Di Update Oleh'];
        }
        return $header;
    }

    private function formatRow($item, $jenis)
    {
        if ($jenis == 'anggota') {
            return [
                $item->anggota_id,
                $item->anggota_kode,
                $item->anggota_nama,
                $item->anggota_alamat,
                $item->anggota_jenis,
                $item->anggota_tgl_daftar,
                $item->created_at,
                $item->created_by,
                $item->updated_at,
                $item->updated_by
            ];
        } elseif ($jenis == 'buku') {
            return [
                $item->buku_id,
                $item->buku_gambar,
                $item->buku_kode,
                $item->buku_judul,
                $item->buku_nama_pengarang,
                $item->tahun_terbit,
                $item->buku_isbn,
                $item->buku_status,
                $item->buku_kondisi,
                $item->buku_jumlah_halaman,
                $item->buku_jumlah_buku,
                $item->buku_pdf,
                $item->buku_word,
                $item->created_at,
                $item->created_by,
                $item->updated_at,
                $item->updated_by
            ];
        } elseif ($jenis == 'peminjaman') {
            return [
                $item->peminjaman_id,
                $item->anggota->anggota_nama,
                $item->buku->buku_judul,
                $item->peminjaman_tgl,
                $item->peminjaman_tgl_pengembalian,
                $item->status,
                $item->created_at,
                $item->created_by,
                $item->updated_at,
                $item->updated_by
            ];
        }
    }
}
