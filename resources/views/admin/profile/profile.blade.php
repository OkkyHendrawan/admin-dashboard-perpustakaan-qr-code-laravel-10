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
                        <a href="{{ url ('admin/dashboard')}}" class="text-slate-400 dark:text-zink-200">Dashboard</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        {{ $header_tittle }}
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="grid grid-cols-1 gap-5 lg:grid-cols-12 2xl:grid-cols-12">
                        <div class="lg:col-span-2 2xl:col-span-1">
                            <div class="relative inline-block rounded-full shadow-md size-20 bg-slate-100 profile-user xl:size-28">
                                <img src="{{ asset('profil-foto/' . Auth::user()->foto_profil) }}" alt="Foto Profile" class="object-cover border-0 rounded-full img-thumbnail user-profile-image">
                                <div class="absolute bottom-0 flex items-center justify-center rounded-full size-8 ltr:right-0 rtl:left-0 profile-photo-edit">
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="lg:col-span-10 2xl:col-span-9">
                            <h5 class="mb-1">{{ Auth::user()->name }}<i data-lucide="badge-check" class="inline-block size-4 text-sky-500 fill-sky-100 dark:fill-custom-500/20"></i></h5>
                            <div class="flex gap-3 mb-4">
                                <p class="text-slate-500 dark:text-zink-200"><i data-lucide="user-circle" class="inline-block size-4 ltr:mr-1 rtl:ml-1 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-500"></i> Freeport (kadang free, kadang repot)</p>
                                <p class="text-slate-500 dark:text-zink-200"><i data-lucide="map-pin" class="inline-block size-4 ltr:mr-1 rtl:ml-1 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-500"></i> Bali, Indonesia</p>
                            </div>
                            <p class="mt-4 text-slate-500 dark:text-zink-200">{{ Auth::user()->about_me }}</p>
                            <div class="flex gap-2 mt-4">
                                <a href="https://www.instagram.com/okkyzarco?igsh=MWRudWd4Y3A2aGR5MQ==" class="flex items-center justify-center text-pink-500 transition-all duration-200 ease-linear bg-pink-100 rounded size-9 hover:bg-pink-200 dark:bg-pink-500/20 dark:hover:bg-pink-500/30">
                                    <i data-lucide="instagram" class="size-4"></i>
                                </a>
                                <a href="https://www.linkedin.com/in/okky-hendrawan-b00194294?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" class="flex items-center justify-center transition-all duration-200 ease-linear rounded text-custom-500 bg-custom-100 size-9 hover:bg-custom-200 dark:bg-custom-500/20 dark:hover:bg-custom-500/30">
                                    <i data-lucide="linkedin" class="size-4"></i>
                                </a>
                                <a href="https://github.com/OkkyHendrawan" class="flex items-center justify-center transition-all duration-200 ease-linear rounded size-9 text-slate-500 bg-slate-100 hover:bg-slate-200 dark:bg-zink-600 dark:hover:bg-zink-500">
                                    <i data-lucide="github" class="size-4"></i>
                                </a>
                            </div>
                        </div>
                    </div><!--end grid-->
                </div>
                <div class="card-body !py-0">
                    <ul class="flex flex-wrap w-full text-sm font-medium text-center nav-tabs">
                        <li class="group active">
                            <a href="javascript:void(0);" data-tab-toggle="" data-target="personalTabs" class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 dark:group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">Personal Info</a>
                        </li>
                    </ul>
                </div>
            </div><!--end card-->
            <div class="tab-content">
                <div class="block tab-pane" id="personalTabs">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-1 text-15">Personal Information</h6>
                            <p class="mb-4 text-slate-500 dark:text-zink-200">Update your photo and personal details here easily.</p>
                                <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                                    <div class="xl:col-span-6">
                                        <label for="firstName" class="inline-block mb-2 text-base font-medium">Username</label>
                                        <input type="text" id="firstName" name="first_name" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" value="{{ Auth::user()->name }}" readonly>
                                    </div><!--end col-->
                                    <div class="xl:col-span-6">
                                        <label for="lastName" class="inline-block mb-2 text-base font-medium">Alamat Email</label>
                                        <input type="text" id="lastName" name="last_name" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" value="{{ Auth::user()->email }}" readonly>
                                    </div><!--end col-->
                                    <div class="xl:col-span-6">
                                        <label for="firstName" class="inline-block mb-2 text-base font-medium">Nama Depan</label>
                                        <input type="text" id="firstName" name="first_name" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" value="{{ Auth::user()->first_name }}" readonly>
                                    </div><!--end col-->
                                    <div class="xl:col-span-6">
                                        <label for="lastName" class="inline-block mb-2 text-base font-medium">Nama Belakang</label>
                                        <input type="text" id="lastName" name="last_name" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" value="{{ Auth::user()->last_name }}" readonly>
                                    </div><!--end col-->
                                    <div class="xl:col-span-6">
                                        <label for="address" class="inline-block mb-2 text-base font-medium">Alamat</label>
                                        <input type="text" id="address" name="address" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" value="{{ Auth::user()->address }}" readonly>
                                    </div><!--end col-->
                                    <div class="xl:col-span-6">
                                        <label for="city" class="inline-block mb-2 text-base font-medium">Kota</label>
                                        <input type="city" id="city" name="city" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" value="{{ Auth::user()->city }}" readonly>
                                    </div><!--end col-->
                                    <div class="xl:col-span-6">
                                        <label for="country" class="inline-block mb-2 text-base font-medium">Negara</label>
                                        <input type="text" id="country" name="country" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" value="{{ Auth::user()->country }}" readonly>
                                    </div><!--end col-->
                                    <div class="xl:col-span-6">
                                        <label for="postal_code" class="inline-block mb-2 text-base font-medium">Kode Pos</label>
                                        <input type="text" id="postal_code" name="postal_code" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" value="{{ Auth::user()->postal_code }}" readonly>
                                    </div><!--end col-->
                                    <div class="xl:col-span-6">
                                        <label for="about_me" class="inline-block mb-2 text-base font-medium">Tentang Saya</label>
                                        <input type="text" id="about_me" name="about_me" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" value="{{ Auth::user()->about_me }}" readonly>
                                    </div><!--end col-->
                                    <div class="xl:col-span-12">
                                        <a href="{{ route('admin.profile.edit') }}" class="inline-flex items-center px-4 py-2 text-base font-medium text-center text-white transition-all duration-300 ease-linear rounded-md shadow-md bg-custom-500 hover:bg-custom-600 dark:bg-custom-800 dark:hover:bg-custom-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9 9a1 1 0 011-1h2a1 1 0 010 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            Edit Profil
                                        </a>
                                    </div><!--end col-->

                                </div><!--end row-->
                            </form><!--end form-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div>
            </div><!--end tab-content-->
        </div>
    </div><!--end container-->
</div><!--end relative-->
</div>
@endsection
