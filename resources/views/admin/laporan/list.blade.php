@extends('layout.app')
@section('content')
<div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">{{ $header_tittle }}</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="{{ route('admin.dashboard') }}" class="text-slate-400 dark:text-zink-200">Dashboard</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        {{ $header_tittle }}
                    </li>
                </ul>
            </div>
            <div class="card" id="laporanList">
                <div class="card-body">
                    <form action="{{ route('admin.laporan.cetak') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="jenis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Laporan</label>
                            <select class="form-select mt-1 block w-full border-slate-200 dark:border-zink-500 dark:bg-zink-800 dark:text-gray-300 focus:ring focus:border-custom-500 focus:outline-none sm:text-sm rounded-md" id="jenis" name="jenis">
                                <option value="anggota">Data Anggota</option>
                                <option value="buku">Data Buku</option>
                                <option value="peminjaman">Data Peminjaman</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="format" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Format Cetak</label>
                            <select class="form-select mt-1 block w-full border-slate-200 dark:border-zink-500 dark:bg-zink-800 dark:text-gray-300 focus:ring focus:border-custom-500 focus:outline-none sm:text-sm rounded-md" id="format" name="format">
                                <option value="pdf">PDF</option>
                                <option value="excel">Excel</option>
                                <option value="word">Word</option>
                            </select>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <button type="submit" class="flex items-center px-4 py-2 border border-purple-500 text-purple-500 rounded-md hover:bg-purple-500 hover:text-white focus:outline-none focus:ring focus:ring-purple-200 focus:border-purple-600 dark:border-zink-500 dark:hover:bg-purple-600 dark:hover:text-white dark:focus:border-custom-800 dark:focus:bg-purple-600 dark:focus:text-white dark:focus:ring">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg> Cetak
                            </button>
                            <button type="button" id="cetak" class="flex items-center px-4 py-2 border border-green-500 text-green-500 rounded-md hover:bg-green-500 hover:text-white focus:outline-none focus:ring focus:ring-green-200 focus:border-green-600 dark:border-zink-500 dark:hover:bg-green-600 dark:hover:text-white dark:focus:border-custom-800 dark:focus:bg-green-600 dark:focus:text-white dark:focus:ring">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM12 19v-8m0 0-3 3m3-3l3 3m-3-3l-3 3"></path></svg> Tampilkan Laporan
                            </button>
                            <button type="button" id="reset" class="flex items-center px-4 py-2 border border-orange-500 text-orange-500 rounded-md hover:bg-orange-500 hover:text-white focus:outline-none focus:ring focus:ring-orange-200 focus:border-orange-600 dark:border-zink-500 dark:hover:bg-orange-600 dark:hover:text-white dark:focus:border-custom-800 dark:focus:bg-orange-600 dark:focus:text-white dark:focus:ring">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg> Reset
                            </button>
                        </div>
                    </form>
                    @if(isset($data))
                    <div class="overflow-x-auto">
                        <table class="w-full whitespace-nowrap" id="peminjamanTable">
                            <thead class="bg-slate-100 dark:bg-zink-600">
                                <tr>
                                    @if($jenis == 'anggota')
                                    <div class="card-header pb-0">
                                        <h6>Laporan Anggota</h6>
                                    </div>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >ID</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Kode Anggota</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Nama Anggota</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Alamat</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Status</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Tanggal Daftar</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Tanggal Buat</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Dibuat Oleh</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Tanggal Update</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Di Update Oleh</th>
                                    @elseif($jenis == 'buku')
                                        <div class="card-header pb-0">
                                            <h6>Laporan Buku</h6>
                                        </div>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >ID</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Gambar</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Kode Buku</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Judul</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Nama Pengarang</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Tahun Terbit</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >ISBN</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Status</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Kondisi</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Jumlah Halaman</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Jumlah Buku</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >PDF</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >WORD</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Tanggal Buat</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Dibuat Oleh</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Tanggal Update</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Di Update Oleh</th>
                                    @elseif($jenis == 'peminjaman')
                                        <div class="card-header pb-0">
                                            <h6>Laporan Peminjaman</h6>
                                        </div>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >ID</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Nama Anggota</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Judul Buku</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Tanggal Pinjam</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Tanggal Kembali</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Status</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Denda</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Tanggal Buat</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Dibuat Oleh</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Tanggal Update</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" >Di Update Oleh</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @if($jenis == 'anggota')
                                @foreach($data as $value)
                                <tr>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->anggota_id }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->anggota_kode }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->anggota_nama }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->anggota_alamat }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->anggota_jenis }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->anggota_tgl_daftar }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->created_at }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->created_by }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->updated_at }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->updated_by }}</td>
                                </tr>
                                @endforeach
                                @elseif($jenis == 'buku')
                                @foreach($data as $value)
                                <tr>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->buku_id }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                        @if($value->buku_gambar && file_exists(public_path('buku-gambar/'.$value->buku_gambar)))
                                        <div style="width: 80px; height: 80px; border: 1px solid #ccc; overflow: hidden; margin: auto;">
                                            <img src="{{ asset('buku-gambar/'.$value->buku_gambar) }}" alt="Gambar Buku" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        @else
                                        <p>Tidak Ada Gambar</p>
                                        @endif
                                    </td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->buku_kode }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->buku_judul }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->buku_nama_pengarang }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->tahun_terbit }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->buku_isbn }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->buku_status }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->buku_kondisi }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->buku_jumlah_halaman }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->buku_jumlah_buku }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                        @if($value->buku_pdf)
                                        <a href="{{ asset('buku-pdf/' . $value->buku_pdf) }}" target="_blank">{{ $value->buku_pdf }}</a>
                                        @else
                                        Tidak Ada PDF
                                        @endif
                                    </td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                        @if($value->buku_word)
                                        <a href="{{ asset('buku-word/' . $value->buku_word) }}" target="_blank">{{ $value->buku_word }}</a>
                                        @else
                                        Tidak Ada WORD
                                        @endif
                                    </td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->created_at }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->created_by }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->updated_at }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->updated_by }}</td>
                                </tr>
                                @endforeach
                                @elseif($jenis == 'peminjaman')
                                @foreach($data as $value)
                                <tr>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->peminjaman_id }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ optional($value->anggota)->anggota_nama }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ optional($value->buku)->buku_judul }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->peminjaman_tgl }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->peminjaman_tgl_pengembalian }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->status }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->peminjaman_denda }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->created_at }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->created_by }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->updated_at }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $value->updated_by }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('cetak').addEventListener('click', function() {
        var jenisLaporan = document.getElementById('jenis').value;
        window.location.href = "{{ route('admin.laporan.cetak') }}" + "?jenis=" + jenisLaporan;
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var resetButton = document.getElementById('reset');
        if (resetButton) {
            resetButton.addEventListener('click', function() {
                var tableBody = document.getElementById('tableBody');
                if (tableBody) {
                    // Hapus isi tabel dengan mengatur innerHTML menjadi string kosong
                    tableBody.innerHTML = '';
                } else {
                    console.error('Elemen dengan id "tableBody" tidak ditemukan.');
                }
            });
        } else {
            console.error('Tombol reset tidak ditemukan.');
        }
    });
</script>

@endsection
