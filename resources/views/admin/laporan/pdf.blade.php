<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan PDF</title>
    <style>
        @page {
            size: landscape;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: auto; /* Untuk memastikan tabel tidak putus di tengah */
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .print-date {
            position: absolute;
            bottom: 20px; /* Atur jarak dari bawah */
            right: 20px; /* Atur jarak dari kanan */
            font-size: 10px; /* Ukuran font tanggal cetak */
        }

        /* Gaya QR Code */
        .qr-code {
            position: absolute;
            bottom: 20px; /* Atur jarak dari atas */
            left: 20px; /* Atur jarak dari kiri */
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="font-sans">
    <div style="text-align: center;">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path(asset('assets/images/perpustakaan.png')))) }}"
            width="100" height="100" />
        <h1 style="font-size: 20px; font-weight: bold; margin-top: 0;">Library Stanford</h1>
    </div>

    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-4">Laporan Data {{ $jenis == 'anggota' ? 'Anggota' : ($jenis == 'buku' ? 'Buku' : 'Peminjaman') }}</h2>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        @if($jenis == 'anggota')
                        <th class="border border-gray-300 px-4 py-2">#</th>
                        <th class="border border-gray-300 px-4 py-2">Kode Anggota</th>
                        <th class="border border-gray-300 px-4 py-2">Nama</th>
                        <th class="border border-gray-300 px-4 py-2">Alamat</th>
                        <th class="border border-gray-300 px-4 py-2">Jenis</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Daftar</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Buat</th>
                        <th class="border border-gray-300 px-4 py-2">Dibuat Oleh</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Update</th>
                        <th class="border border-gray-300 px-4 py-2">Di Update Oleh</th>
                        @elseif($jenis == 'buku')
                        <th class="border border-gray-300 px-4 py-2">#</th>
                        <th class="border border-gray-300 px-4 py-2">Gambar</th>
                        <th class="border border-gray-300 px-4 py-2">Kode Buku</th>
                        <th class="border border-gray-300 px-4 py-2">Judul</th>
                        <th class="border border-gray-300 px-4 py-2">Nama Pengarang</th>
                        <th class="border border-gray-300 px-4 py-2">Tahun Terbit</th>
                        <th class="border border-gray-300 px-4 py-2">ISBN</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                        <th class="border border-gray-300 px-4 py-2">Kondisi</th>
                        <th class="border border-gray-300 px-4 py-2">Jumlah Halaman</th>
                        <th class="border border-gray-300 px-4 py-2">Jumlah Buku</th>
                        <th class="border border-gray-300 px-4 py-2">PDF</th>
                        <th class="border border-gray-300 px-4 py-2">WORD</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Buat</th>
                        <th class="border border-gray-300 px-4 py-2">Dibuat Oleh</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Update</th>
                        <th class="border border-gray-300 px-4 py-2">Di Update Oleh</th>
                        @elseif($jenis == 'peminjaman')
                        <th class="border border-gray-300 px-4 py-2">#</th>
                        <th class="border border-gray-300 px-4 py-2">Anggota</th>
                        <th class="border border-gray-300 px-4 py-2">Buku</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Pinjam</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Kembali</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Buat</th>
                        <th class="border border-gray-300 px-4 py-2">Dibuat Oleh</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Update</th>
                        <th class="border border-gray-300 px-4 py-2">Di Update Oleh</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if($data)
                    @foreach($data as $value)
                    <tr>
                        @if($jenis == 'anggota')
                        <td class="border border-gray-300 px-4 py-2">{{ $value->anggota_id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->anggota_kode }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->anggota_nama }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->anggota_alamat }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->anggota_jenis }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->anggota_tgl_daftar }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->created_at }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->created_by }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->updated_at }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->updated_by }}</td>
                        @elseif($jenis == 'buku')
                        <td class="border border-gray-300 px-4 py-2">{{ $value->buku_id }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if($value->buku_gambar && file_exists(public_path('buku-gambar/'.$value->buku_gambar)))
                            <div style="width: 80px; height: 80px; border: 1px solid #ccc; overflow: hidden; margin: auto;">
                                <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('buku-gambar/'.$value->buku_gambar))) }}"
                                    alt="Gambar Buku" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            @else
                            <p class="border border-gray-300 px-4 py-2">Tidak Ada Gambar</p>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->buku_kode }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->buku_judul }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->buku_pengarang }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->buku_tahun_terbit }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->buku_isbn }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->buku_status }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->buku_kondisi }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->buku_jumlah_halaman }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->buku_jumlah_buku }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if($value->buku_pdf)
                            <a href="{{ url('buku-pdf/'.$value->buku_pdf) }}" class="text-blue-500 hover:underline"
                                target="_blank">PDF</a>
                            @else
                            <p class="border border-gray-300 px-4 py-2">Tidak Ada PDF</p>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if($value->buku_word)
                            <a href="{{ url('buku-word/'.$value->buku_word) }}" class="text-blue-500 hover:underline"
                                target="_blank">WORD</a>
                            @else
                            <p class="border border-gray-300 px-4 py-2">Tidak Ada WORD</p>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->created_at }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->created_by }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->updated_at }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->updated_by }}</td>
                        @elseif($jenis == 'peminjaman')
                        <td class="border border-gray-300 px-4 py-2">{{ $value->peminjaman_id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->anggota->anggota_nama }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->buku->buku_judul }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->peminjaman_tgl }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->peminjaman_tgl_pengembalian }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->status }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->created_at }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->created_by }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->updated_at }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $value->updated_by }}</td>
                        @endif
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="15" class="border border-gray-300 px-4 py-2 text-center">Tidak ada data
                            tersedia</td>
                    </tr>
                    @endif
                </tbody>
            </table>
             <!-- QR Code -->
      <div class="qr-code">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path(asset('assets/images/QRcode.png')))) }}" width="100" height="100" />
     </div>
        </div>
        <div class="print-date">
            Cetak: {{ \Carbon\Carbon::now('Asia/Jakarta')->isoFormat('dddd, D MMMM Y, HH:mm:ss') }}
        </div>
    </div>
    <script>
        window.onload = function () {
            window.print();
        }
    </script>
</body>

</html>
