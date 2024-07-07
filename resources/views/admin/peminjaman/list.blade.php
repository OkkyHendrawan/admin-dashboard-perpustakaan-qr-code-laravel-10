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
            <div class="card" id="peminjamanList">
                @include('auth.message')
                <div class="card-body">
                    <div class="grid grid-cols-1 gap-5 mb-5 xl:grid-cols-2">
                        <div>
                            <div class="relative xl:w-4/6">
                                <form action="{{ route('peminjaman.search') }}" method="GET" class="flex items-center">
                                    <div class="relative flex-1">
                                        <input type="text" name="search" class="ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Search Buku dan Nama Pengarang" autocomplete="off">
                                        <i data-lucide="search" class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-600"></i>
                                    </div>
                                    <button type="submit" class="ml-2 text-sky-500 btn bg-sky-100 hover:text-white hover:bg-sky-600 focus:text-white focus:bg-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:ring active:ring-sky-100 dark:bg-sky-500/20 dark:text-sky-400 dark:hover:bg-sky-500 dark:hover:text-white dark:focus:bg-sky-500 dark:focus:text-white dark:active:bg-sky-500 dark:active:text-white dark:ring-sky-400/20">
                                        <i data-lucide="search" class="inline-block w-4 h-4 mr-1 text-sky-500 fill-current"></i>
                                        Search
                                    </button>
                                    <a href="{{ route('admin.peminjaman.list') }}" class="ml-2 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20">
                                        <i class="align-baseline ltr:pr-1 rtl:pl-1 ri-refresh-line"></i>
                                        Reset
                                    </a>
                                </form>
                            </div>
                        </div>
                        <div class="ltr:md:text-end rtl:md:text-start">
                            <a href="{{ route('admin.peminjaman.form_create') }}" class="text-custom-500 btn bg-custom-100 hover:text-white hover:bg-custom-600 focus:text-white focus:bg-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:ring active:ring-custom-100 dark:bg-custom-500/20 dark:text-custom-500 dark:hover:bg-custom-500 dark:hover:text-white dark:focus:bg-custom-500 dark:focus:text-white dark:active:bg-custom-500 dark:active:text-white dark:ring-custom-400/20">
                                <i class="align-bottom ri-add-line me-1"></i> Tambah Peminjaman
                            </a>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full whitespace-nowrap" id="peminjamanTable">
                            <thead class="bg-slate-100 dark:bg-zink-600">
                                <tr>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" data-sort="peminjaman_id">ID</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" data-sort="peminjaman_anggota_id">Nama Anggota</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" data-sort="peminjaman_buku_id">Judul Buku</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" data-sort="peminjaman_tgl">Tanggal Pinjam</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" data-sort="peminjaman_tgl_pengembalian">Tanggal Kembali</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" data-sort="peminjaman_denda">Denda</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" data-sort="status">Status</th>
                                    <th class="sort px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-left rtl:text-right" data-sort="action">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @foreach($peminjaman as $value)
                                <tr>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 peminjaman_id">{{ $value->peminjaman_id }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 peminjaman_anggota_id">{{ $value->anggota->anggota_nama }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 peminjaman_buku_id">{{ $value->buku->buku_judul }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 status">
                                        <span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-blue-100 border-transparent text-blue-500 dark:bg-blue-500/20 dark:border-transparent text-uppercase">{{ $value->peminjaman_tgl }}</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 status">
                                        <span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-purple-100 border-transparent text-purple-500 dark:bg-purple-500/20 dark:border-transparent text-uppercase">{{ $value->peminjaman_tgl_pengembalian }}</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 peminjaman_tgl_pengembalian">
                                        @if($value->peminjaman_denda)
                                            <span class="text-red-500">Rp {{ number_format($value->peminjaman_denda, 2, ',', '.') }}</span>
                                        @else
                                            <span class="text-gray-500">Tidak ada denda</span>
                                        @endif
                                    </td>

                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 status">
                                        @if ($value->status == 'Dipinjam')
                                            <span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-yellow-100 border-transparent text-yellow-500 dark:bg-yellow-500/20 dark:border-transparent text-uppercase">
                                                {{ $value->status }}
                                            </span>
                                        @elseif ($value->status == 'Kembali')
                                        <span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent text-uppercase">
                                                {{ $value->status }}
                                            </span>
                                        @else
                                            <span>{{ $value->status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                        <div class="flex gap-2">
                                            <div class="edit">
                                                <a href="{{ route('admin.peminjaman.edit', $value->peminjaman_id) }}" class="text-orange-500 bg-orange-100 btn hover:text-white hover:bg-orange-600 focus:text-white focus:bg-orange-600 focus:ring focus:ring-orange-100 active:text-white active:bg-orange-600 active:ring active:ring-orange-100 dark:bg-orange-500/20 dark:text-orange-500 dark:hover:bg-orange-500 dark:hover:text-white dark:focus:bg-orange-500 dark:focus:text-white dark:active:bg-orange-500 dark:active:text-white dark:ring-orange-400/20">
                                                    <i class="align-bottom ri-pencil-line me-1"></i>Edit</a>
                                            </div>
                                            <div class="preview">
                                                <button data-modal-target="#previewModal{{ $value->peminjaman_id }}" class="text-yellow-500 bg-yellow-100 btn hover:text-white hover:bg-yellow-600 focus:text-white focus:bg-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:ring active:ring-yellow-100 dark:bg-yellow-500/20 dark:text-yellow-500 dark:hover:bg-yellow-500 dark:hover:text-white dark:focus:bg-yellow-500 dark:focus:text-white dark:active:bg-yellow-500 dark:active:text-white dark:ring-yellow-400/20">
                                                    <i class="ri-eye-line me-1"></i> Preview
                                                </button>
                                            </div>
                                            <div class="delete">
                                                <button data-modal-target="#deleteModal{{ $value->peminjaman_id }}" class="text-red-500 bg-red-100 btn hover:text-white hover:bg-red-600 focus:text-white focus:bg-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:ring active:ring-red-100 dark:bg-red-500/20 dark:text-red-500 dark:hover:bg-red-500 dark:hover:text-white dark:focus:bg-red-500 dark:focus:text-white dark:active:bg-red-500 dark:active:text-white dark:ring-red-400/20">
                                                    <i class="align-bottom ri-delete-bin-2-line me-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Preview Modal -->
                                <div id="previewModal{{ $value->peminjaman_id }}" class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                                    <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
                                        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                                            <h5 class="text-16">Detail Peminjaman</h5>
                                            <button data-modal-close="previewModal{{ $value->peminjaman_id }}" class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500">
                                                <i data-lucide="x" class="size-5"></i>
                                            </button>
                                        </div>
                                        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                                            <p class="text-center text-slate-500 dark:text-zink-200"><span class="font-semibold">ID:</span> {{ $value->peminjaman_id }}</p>
                                            <p class="text-center text-slate-500 dark:text-zink-200"><span class="font-semibold">Nama Anggota:</span> {{ $value->anggota->anggota_nama }}</p>
                                            <p class="text-center text-slate-500 dark:text-zink-200"><span class="font-semibold">Judul Buku:</span> {{ $value->buku->buku_judul }}</p>
                                            <p class="text-center text-slate-500 dark:text-zink-200"><span class="font-semibold">Tanggal Pinjam:</span> {{ $value->peminjaman_tgl }}</p>
                                            <p class="text-center text-slate-500 dark:text-zink-200"><span class="font-semibold">Tanggal Pengembalian:</span> {{ $value->peminjaman_tgl_pengembalian }}</p>
                                            <p class="text-center text-slate-500 dark:text-zink-200"><span class="font-semibold">Denda:</span>
                                                @if($value->peminjaman_denda)
                                                    Rp {{ number_format($value->peminjaman_denda, 2, ',', '.') }}
                                                @else
                                                    Tidak ada denda
                                                @endif
                                            </p>
                                            <p class="text-center text-slate-500 dark:text-zink-200"><span class="font-semibold">Status:</span> {{ $value->status }}</p>
                                        </div>
                                        <div class="flex items-center justify-between p-4 mt-auto border-t border-slate-200 dark:border-zink-500">
                                            <button data-modal-close="previewModal{{ $value->peminjaman_id }}" class="text-red-500 bg-red-100 btn hover:text-white hover:bg-red-600 focus:text-white focus:bg-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:ring active:ring-red-100 dark:bg-red-500/20 dark:text-red-500 dark:hover:bg-red-500 dark:hover:text-white dark:focus:bg-red-500 dark:focus:text-white dark:active:bg-red-500 dark:active:text-white dark:ring-red-400/20">
                                                Close <i class="align-baseline ltr:pl-1 rtl:pr-1 ri-close-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div id="deleteModal{{ $value->peminjaman_id }}" class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                                    <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
                                        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                                            <h5 class="text-16">Delete Peminjaman</h5>
                                            <button data-modal-hide class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500">
                                                <i data-lucide="x" class="size-5"></i>
                                            </button>
                                        </div>
                                        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                                            <p class="text-slate-500 dark:text-zink-200">
                                                Apakah Anda yakin ingin menghapus Peminjaman dengan Nama <span class="font-semibold">{{ $value->anggota->anggota_nama }}</span>?
                                            </p>
                                        </div>
                                        <div class="flex items-center justify-between p-4 mt-auto border-t border-slate-200 dark:border-zink-500">
                                            <button data-modal-hide class="text-red-500 bg-red-100 btn hover:text-white hover:bg-red-600 focus:text-white focus:bg-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:ring active:ring-red-100 dark:bg-red-500/20 dark:text-red-500 dark:hover:bg-red-500 dark:hover:text-white dark:focus:bg-red-500 dark:focus:text-white dark:active:bg-red-500 dark:active:text-white dark:ring-red-400/20">
                                                Close <i class="align-baseline ltr:pl-1 rtl:pr-1 ri-close-line"></i>
                                            </button>
                                            <form action="{{ route('admin.peminjaman.softDeletePeminjaman', $value->peminjaman_id) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="text-purple-500 bg-white border-purple-500 border-dashed btn hover:text-purple-500 hover:bg-purple-50 hover:border-purple-600 focus:text-purple-600 focus:bg-purple-50 focus:border-purple-600 active:text-purple-600 active:bg-purple-50 active:border-purple-600 dark:bg-zink-700 dark:ring-purple-400/20 dark:hover:bg-purple-800/20 dark:focus:bg-purple-800/20 dark:active:bg-purple-800/20">
                                                    Delete <i class="ri-delete-bin-2-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    {{ $peminjaman->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalToggleButtons = document.querySelectorAll('[data-modal-target]');
    const modalHideButtons = document.querySelectorAll('[data-modal-hide]');

    modalToggleButtons.forEach(button => {
        button.addEventListener('click', function () {
            const modal = document.querySelector(button.getAttribute('data-modal-target'));
            if (modal) {
                modal.classList.remove('hidden');
            }
        });
    });

    modalHideButtons.forEach(button => {
        button.addEventListener('click', function () {
            const modal = button.closest('.fixed');
            if (modal) {
                modal.classList.add('hidden');
            }
        });
    });
});
</script>
@endsection
