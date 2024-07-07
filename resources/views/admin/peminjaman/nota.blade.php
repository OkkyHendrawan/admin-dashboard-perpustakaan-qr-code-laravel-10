<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @if (!empty($header_title))
            {{ $header_title }}
        @else
            @if ($is_update)
                Update Nota
            @else
                Cetak Nota
            @endif
        @endif
        - Stanford Library
    </title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            max-width: 300px;
            margin: auto;
            padding: 10px;
            border: 2px solid #000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        h2 {
            margin-bottom: 5px;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        h5 {
            margin-top: 0;
            margin-bottom: 5px;
            font-size: 0.8rem;
        }
        .title-img {
            max-width: 50px; /* Sesuaikan ukuran gambar sesuai kebutuhan */
            margin-right: 10px; /* Jarak antara gambar dengan teks */
        }
        p {
            margin-bottom: 5px;
            font-size: 0.9rem;
        }
        .qr-code {
            margin-top: 10px;
        }
        .qr-code img {
            max-width: 100%;
            height: auto;
            padding: 5px;
            background-color: #fff;
            border: 1px solid #000;
        }
        .footer {
            padding-top: 5px;
            margin-top: 10px;
        }

        @page {
            size: 3.5in 6.2in; /* Ubah ukuran kertas sesuai dengan kebutuhan Anda */
            margin: 5px; /* Pastikan margin diatur ke 0 untuk menghindari margin tambahan */
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ public_path('assets/images/perpustakaan.png') }}" class="title-img" alt="Title Image">
        <h2>Nota Peminjaman Buku</h2>
        <h5>Alamat: Jl. Simorejo Timur 8/3, Surabaya</h5>
        <hr style="border-top: 1px dashed #000;">
        <div>
            <p><strong>Anggota:</strong> {{ $anggota->anggota_nama }}</p>
            <p><strong>Buku:</strong> {{ $buku->buku_judul }}</p>
            <p><strong>Tanggal Peminjaman:</strong> {{ $peminjaman_tgl }}</p>
            <p><strong>Tanggal Pengembalian:</strong> {{ $peminjaman_tgl_pengembalian }}</p>
            <p><strong>Status:</strong> {{ $status }}</p>
            <p><strong>Denda:</strong> Rp {{ number_format($fine, 0, ',', '.') }}</p>
        </div>
        <hr style="border-top: 1px dashed #000;">
        <div class="qr-code">
            <img src="data:image/png;base64, {!! base64_encode($qrCode) !!} ">
        </div>
        <hr style="border-top: 1px dashed #000;">
        <div class="footer">
            <p><strong>Waktu Cetak:</strong> {{ $currentDateTime }}</p>
            <p>Terima Kasih Telah Menyewa Buku di Stanford Library</p> <!-- Ganti dengan teks yang sesuai -->
        </div>
    </div>
</body>
</html>
