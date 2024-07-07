<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
    data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">
<head>

    <meta charset="utf-8">
    <title>{{ !empty($header_tittle) ? $header_tittle : '' }} - Stanford Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Library University Stanford" name="description">
    <meta content="" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}assets/images/perpustakaan.png">
    <!-- Layout config Js -->
    <script src="{{ asset('/') }}assets/js/layout.js"></script>
    <!-- Icons CSS -->

    <!-- Menyertakan file Bootstrap CSS dan JS -->

    <link rel="stylesheet" href="{{ asset('/') }}assets/css/starcode2.css">
    @yield('style')
</head>

<body
    class="text-base bg-body-bg text-body font-public dark:text-zink-100 dark:bg-zink-800 group-data-[skin=bordered]:bg-body-bordered group-data-[skin=bordered]:dark:bg-zink-700">
    <!-- Preloader -->
    <div id="preloader" class="fixed inset-0 flex items-center justify-center bg-white dark:bg-zink-800 z-50">
        <svg class="animate-spin h-12 w-12 text-blue-500 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M3 10h4v4H3zm14 0h4v4h-4zm-7-7v4H6a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1h-4V3a1 1 0 0 0-2 0z"></path>
        </svg>
    </div>

    <div class="group-data-[sidebar-size=sm]:min-h-sm group-data-[sidebar-size=sm]:relative">
        @include('layout.header')
        @yield('content')
        @include('layout.footer')
    </div>
    <script src="{{ asset('/') }}assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/%40popperjs/core/umd/popper.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/tippy.js/tippy-bundle.umd.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/prismjs/prism.js"></script>
    <script src="{{ asset('/') }}assets/libs/lucide/umd/lucide.js"></script>
    <script src="{{ asset('/') }}assets/js/starcode.bundle.js"></script>
    <!-- list js-->
    <script src="{{ asset('/') }}assets/libs/list.js/list.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/list.pagination.js/list.pagination.min.js"></script>
    <script src="{{ asset('/') }}assets/libs/flatpickr/flatpickr.min.js"></script>
    <!-- Sweet Alerts js -->
    <script src="{{ asset('/') }}assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ asset('/') }}assets/js/pages/sweetalert.init.js"></script>

    <!--apexchart js-->
    <script src="{{ asset('/') }}assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- mixed init js-->
    <script src="{{ asset('/') }}assets/js/pages/apexcharts-mixed.init.js"></script>

    <!-- App js -->
    <script src="{{ asset('/') }}assets/js/app.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hide preloader when content is loaded
            var preloader = document.getElementById('preloader');
            if (preloader) {
                preloader.style.display = 'none';
            }
        });
    </script>
    @yield('script')
</body>
</html>
