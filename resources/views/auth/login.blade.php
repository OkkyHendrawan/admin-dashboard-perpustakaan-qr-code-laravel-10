<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
    data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>{{ !empty($header_title) ? $header_title : '' }} Login - Stanford Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Library University Stanford" name="description">
    <meta content="" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/perpustakaan.png') }}">
    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Icons CSS -->

    <!-- StarCode CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/starcode2.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body
    class="flex items-center justify-center min-h-screen px-4 py-16 bg-cover bg-auth-pattern dark:bg-auth-pattern-dark dark:text-zink-100 font-public">
    <div class="mb-0 border-none shadow-none xl:w-2/3 card bg-white/70 dark:bg-zink-500/70">
        <div class="grid grid-cols-1 gap-0 lg:grid-cols-12">
            <div class="lg:col-span-5">
                <div class="!px-12 !py-12 card-body">
                    @include('auth.message')
                    <div class="text-center">
                        <h4 class="mb-2 text-purple-500 dark:text-purple-500">Welcome Back !</h4>
                        <p class="text-slate-500 dark:text-zink-200">Sign in to continue to Stanford University.</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="hidden px-4 py-3 mb-3 text-sm text-green-500 border border-green-200 rounded-md bg-green-50 dark:bg-green-400/20 dark:border-green-500/50"
                            id="successAlert">
                            You have <b>successfully</b> signed in.
                        </div>
                        <div class="mb-3">
                            <label for="email" class="inline-block mb-2 text-base font-medium">UserName/ Email
                                ID</label>
                            <input type="email" id="email"
                                class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                name="email" placeholder="Enter email">
                            <div id="emailError" class="hidden mt-1 text-sm text-red-500">Please enter a valid email
                                address.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="inline-block mb-2 text-base font-medium">Password</label>
                            <input type="password" id="password"
                                class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                name="password" placeholder="Enter password">
                            <div id="passwordError" class="hidden mt-1 text-sm text-red-500">Password must be at least 8
                                characters long and contain both letters and numbers.</div>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <input id="checkboxDefault1"
                                    class="border rounded-sm appearance-none size-4 bg-slate-100 border-slate-200 dark:bg-zink-600/50 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400"
                                    type="checkbox" value="">
                                <label for="checkboxDefault1"
                                    class="inline-block text-base font-medium align-middle cursor-pointer">Remember
                                    me</label>
                            </div>
                            <div id="rememberError" class="hidden mt-1 text-sm text-red-500">Please check the "Remember
                                me" before submitting the form.</div>
                        </div>
                        <div class="mt-10">
                            <button type="submit"
                                class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Sign
                                In</button>
                        </div>
                        <div class="mt-10 text-center">
                            <p class="mb-0 text-slate-500 dark:text-zink-200">Forgot your password? <a
                                    href="{{ url('forgot-password') }}"
                                    class="font-semibold underline transition-all duration-150 ease-linear text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500">Forgot
                                    Password</a> </p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mx-2 mt-2 mb-2 border-none shadow-none lg:col-span-7 card bg-white/60 dark:bg-zink-500/60">
                <div class="!px-10 !pt-10 h-full !pb-0 card-body flex flex-col">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex justify-center grow">
                            <a href="{{ url(' ') }}">
                                <img src="{{ asset('assets/images/perpustakaan.png') }}" alt=""
                                    class="hidden h-17 dark:block">
                                <img src="{{ asset('assets/images/perpustakaan.png') }}" alt=""
                                    class="block h-17 dark:hidden">
                            </a>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <img src="{{ asset('assets/images/img-01.png') }}" alt=""
                            class="md:max-w-[32rem] mx-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/tippy.js/tippy-bundle.umd.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('assets/libs/lucide/umd/lucide.js') }}"></script>
    <script src="{{ asset('assets/js/starcode.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/auth-login.init.js') }}"></script>
</body>
</html>
