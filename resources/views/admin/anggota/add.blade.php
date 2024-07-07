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
                        <a href="{{ route('admin.anggota.list') }}" class="text-slate-400 dark:text-zink-200">Daftar Anggota</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        {{ $header_tittle }}
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="block tab-pane" id="personalTabs">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-1 text-15">Add New Member</h6>
                            <p class="mb-4 text-slate-500 dark:text-zink-200">Fill in the details below to add a new member.</p>
                            <form method="POST" action="{{ route('admin.anggota.proses_create') }}">
                                @csrf
                                <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                                    <div class="xl:col-span-6">
                                        <label for="anggota_kode" class="inline-block mb-2 text-base font-medium">Anggota Kode</label>
                                        <input type="text" id="anggota_kode" name="anggota_kode" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" value="{{ old('anggota_kode') }}" required readonly>
                                    </div>
                                    <div class="xl:col-span-6">
                                        <label for="anggota_nama" class="inline-block mb-2 text-base font-medium">Nama Anggota</label>
                                        <input type="text" id="anggota_nama" name="anggota_nama" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" value="{{ old('anggota_nama') }}" required>
                                        @error('anggota_nama')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="xl:col-span-6">
                                        <label for="anggota_alamat" class="inline-block mb-2 text-base font-medium">Alamat</label>
                                        <input type="text" id="anggota_alamat" name="anggota_alamat" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" value="{{ old('anggota_alamat') }}">
                                    </div>
                                    <div class="xl:col-span-6">
                                        <label for="anggota_jenis" class="inline-block mb-2 text-base font-medium">Jenis Anggota</label>
                                        <select id="anggota_jenis" name="anggota_jenis" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                            <option value="Aktif" {{ old('anggota_jenis') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="Tidak Aktif" {{ old('anggota_jenis') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <div class="xl:col-span-6">
                                        <label for="anggota_tgl_daftar" class="inline-block mb-2 text-base font-medium">Tanggal Daftar</label>
                                        <input type="date" id="anggota_tgl_daftar" name="anggota_tgl_daftar" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" value="{{ old('anggota_tgl_daftar') }}">
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
                                    <a href="{{ route('admin.anggota.list') }}"
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
