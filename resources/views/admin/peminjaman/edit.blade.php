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
                        <a href="{{ route('admin.peminjaman.list') }}" class="text-slate-400 dark:text-zink-200">Daftar Peminjaman</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        {{ $header_tittle }}
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="block tab-pane" id="peminjamanTabs">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-1 text-15">Informasi Peminjaman</h6>
                            <p class="mb-4 text-slate-500 dark:text-zink-200">Update informasi peminjaman di sini.</p>
                            <form method="POST" action="{{ route('admin.peminjaman.update', $peminjaman->peminjaman_id) }}">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                                    <div class="xl:col-span-6">
                                        <label for="peminjaman_anggota_id" class="inline-block mb-2 text-base font-medium">Nama Anggota</label>
                                        <select id="peminjaman_anggota_id" name="peminjaman_anggota_id" class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required>
                                            @foreach ($daftarAnggota as $anggota)
                                                <option value="{{ $anggota->anggota_id }}" {{ $peminjaman->peminjaman_anggota_id == $anggota->anggota_id ? 'selected' : '' }}>
                                                    {{ $anggota->anggota_nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="xl:col-span-6">
                                        <label for="peminjaman_buku_id" class="inline-block mb-2 text-base font-medium">Judul Buku</label>
                                        <select id="peminjaman_buku_id" name="peminjaman_buku_id" class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" required>
                                            @foreach ($daftarBuku as $buku)
                                                <option value="{{ $buku->buku_id }}" {{ $peminjaman->peminjaman_buku_id == $buku->buku_id ? 'selected' : '' }}>
                                                    {{ $buku->buku_judul }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="xl:col-span-6">
                                        <label for="peminjaman_tgl" class="inline-block mb-2 text-base font-medium">Tanggal Pinjam</label>
                                        <input type="date" id="peminjaman_tgl" name="peminjaman_tgl" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" value="{{ $peminjaman->peminjaman_tgl }}" required>
                                    </div>
                                    <div class="xl:col-span-6">
                                        <label for="peminjaman_tgl_pengembalian" class="inline-block mb-2 text-base font-medium">Tanggal Kembali</label>
                                        <input type="date" id="peminjaman_tgl_pengembalian" name="peminjaman_tgl_pengembalian" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" value="{{ $peminjaman->peminjaman_tgl_pengembalian }}" required>
                                    </div>
                                    <div class="xl:col-span-6">
                                        <label for="status" class="inline-block mb-2 text-base font-medium">Status</label>
                                        <select id="status" name="status" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                            <option value="Dipinjam" {{ $peminjaman->status == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                            <option value="Kembali" {{ $peminjaman->status == 'Kembali' ? 'selected' : '' }}>Kembali</option>
                                        </select>
                                    </div>
                                    <div class="xl:col-span-6">
                                        <label for="peminjaman_denda" class="inline-block mb-2 text-base font-medium">Denda</label>
                                        <input type="text" id="peminjaman_denda" name="peminjaman_denda" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" value="{{ $peminjaman->peminjaman_denda }}" readonly>
                                    </div>
                                </div><!--end grid-->
                                <div class="flex justify-end mt-6 gap-x-4">
                                    <button type="submit"
                                        class="flex items-center justify-center px-4 py-2 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M13 3a1 1 0 011 1v3.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 111.414-1.414L11 7.586V4a1 1 0 011-1zm-1 13a1 1 0 01-1-1v-3.586l-1.293 1.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L9 12.414V16a1 1 0 01-1 1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Simpan
                                    </button>
                                    <button type="submit" formaction="{{ route('admin.peminjaman.updateNota', $peminjaman->peminjaman_id) }}"
                                        class="flex items-center justify-center px-4 py-2 text-white btn bg-green-500 border-green-500 hover:bg-green-600 focus:bg-green-600 focus:ring focus:ring-green-100 active:bg-green-600 dark:bg-green-700 dark:border-green-500 dark:hover:bg-green-600 dark:focus:bg-green-600 dark:active:bg-green-600 dark:ring-green-400/20">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M4 2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2H4zm10 9a1 1 0 01-1 1H7a1 1 0 010-2h6a1 1 0 011 1zM8 6a1 1 0 011 1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Update Nota
                                    </button>
                                    <a href="{{ route('admin.peminjaman.list') }}"
                                        class="flex items-center justify-center px-4 py-2 text-red-500 bg-red-100 btn hover:text-white hover:bg-red-600 focus:text-white focus:bg-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:ring active:ring-red-100 dark:bg-red-500/20 dark:text-red-500 dark:hover:bg-red-500 dark:hover:text-white dark:focus:bg-red-500 dark:focus:text-white dark:active:bg-red-500 dark:active:text-white dark:ring-red-400/20">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 3a7 7 0 00-7 7c0 3.866 4.266 8.546 6.15 10.24a.725.725 0 001.3 0C12.734 18.546 17 13.866 17 10a7 7 0 00-7-7zm0 12a5 5 0 100-10 5 5 0 000 10z"
                                                clip-rule="evenodd" />
                                            <path fill-rule="evenodd"
                                                d="M10 5a3 3 0 100 6 3 3 0 000-6zM8 8a1 1 0 011 1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Batal
                                    </a>
                                </div>
                            </form><!--end form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>

@endsection
