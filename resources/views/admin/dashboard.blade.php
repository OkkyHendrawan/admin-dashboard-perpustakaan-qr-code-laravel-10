@extends('layout.app')

@section('content')
<body class="text-base bg-body-bg text-body font-public dark:text-zink-100 dark:bg-zink-800 group-data-[skin=bordered]:bg-body-bordered group-data-[skin=bordered]:dark:bg-zink-700">
    <div class="group-data-[sidebar-size=sm]:min-h-sm group-data-[sidebar-size=sm]:relative">
        <div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">

            <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
                <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

                    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                        <div class="grow">
                            <h5 class="text-16">Dashboard</h5>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-x-5">
                        <!-- Total Buku -->
                        <div class="order-1 md:col-span-6 lg:col-span-3 col-span-12 2xl:order-1 bg-green-100 dark:bg-green-500/20 card 2xl:col-span-2 group-data-[skin=bordered]:border-green-500/20 relative overflow-hidden">
                            <div class="card-body">
                                <i data-lucide="book" class="absolute top-0 stroke-1 size-32 text-green-200/50 dark:text-green-500/20 ltr:-right-10 rtl:-left-10"></i>
                                <div class="flex items-center justify-center bg-green-500 rounded-md size-12 text-15 text-green-50">
                                    <i data-lucide="book"></i>
                                </div>
                                <h5 class="mt-5 mb-2"><span class="counter-value" data-target="{{ $totalBuku }}">0</span></h5>
                                <p class="text-slate-500 dark:text-slate-200">Total Buku</p>
                            </div>
                        </div>
                        <!-- Total Peminjaman -->
                        <div class="order-2 md:col-span-6 lg:col-span-3 col-span-12 2xl:order-1 bg-orange-100 dark:bg-orange-500/20 card 2xl:col-span-2 group-data-[skin=bordered]:border-orange-500/20 relative overflow-hidden">
                            <div class="card-body">
                                <i data-lucide="list-filter" class="absolute top-0 stroke-1 size-32 text-orange-200/50 dark:text-orange-500/20 ltr:-right-10 rtl:-left-10"></i>
                                <div class="flex items-center justify-center bg-orange-500 rounded-md size-12 text-15 text-orange-50">
                                    <i data-lucide="shopping-cart"></i>
                                </div>
                                <h5 class="mt-5 mb-2"><span class="counter-value" data-target="{{ $totalPeminjaman }}">0</span></h5>
                                <p class="text-slate-500 dark:text-slate-200">Total Peminjaman</p>
                            </div>
                        </div>
                        <!-- Total Anggota -->
                        <div class="order-3 md:col-span-6 lg:col-span-3 col-span-12 2xl:order-1 bg-sky-100 dark:bg-sky-500/20 card 2xl:col-span-2 group-data-[skin=bordered]:border-sky-500/20 relative overflow-hidden">
                            <div class="card-body">
                                <i data-lucide="users" class="absolute top-0 stroke-1 size-32 text-sky-200/50 dark:text-sky-500/20 ltr:-right-10 rtl:-left-10"></i>
                                <div class="flex items-center justify-center rounded-md size-12 bg-sky-500 text-15 text-sky-50">
                                    <i data-lucide="users"></i>
                                </div>
                                <h5 class="mt-5 mb-2"><span class="counter-value" data-target="{{ $totalAnggota }}">0</span></h5>
                                <p class="text-slate-500 dark:text-slate-200">Total Anggota</p>
                            </div>
                        </div>
                        <!-- Total Kategori -->
                        <div class="order-4 md:col-span-6 lg:col-span-3 col-span-12 2xl:order-1 bg-purple-100 dark:bg-purple-500/20 card 2xl:col-span-2 group-data-[skin=bordered]:border-purple-500/20 relative overflow-hidden">
                            <div class="card-body">
                                <i data-lucide="kanban" class="absolute top-0 stroke-1 size-32 text-purple-200/50 dark:text-purple-500/20 ltr:-right-10 rtl:-left-10"></i>
                                <div class="flex items-center justify-center bg-purple-500 rounded-md size-12 text-15 text-purple-50">
                                    <i data-lucide="layers"></i>
                                </div>
                                <h5 class="mt-5 mb-2"><span class="counter-value" data-target="{{ $totalKategori }}">0</span></h5>
                                <p class="text-slate-500 dark:text-slate-200">Total Kategori</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-2">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-4 text-15">Line Column</h6>
                                <div id="lineColumnChart" class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-4 text-15">Multiple Y-Axis</h6>
                                <div id="multipleYaxisChart" class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-4 text-15">Basic</h6>
                                <div id="basicPolar" class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-4 text-15">Basic</h6>
                                <div id="basicColumnChart" class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div><!--end grid-->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

        </div>

    </div>
    <!-- end main content -->

    <!-- Script untuk inisialisasi grafik -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Line Column Chart
            var lineColumnOptions = {
                chart: {
                    type: 'line',
                    height: 350,
                },
                series: [{
                    name: 'Buku',
                    type: 'column',
                    data: {!! json_encode($bukuData) !!}
                }, {
                    name: 'Peminjaman',
                    type: 'line',
                    data: {!! json_encode($peminjamanData) !!}
                }],
                xaxis: {
                    categories: {!! json_encode($labels) !!}
                },
                yaxis: [{
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#008FFB'
                    },
                    labels: {
                        style: {
                            colors: '#008FFB',
                        }
                    },
                    title: {
                        text: "Total Buku",
                        style: {
                            color: '#008FFB',
                        }
                    }
                }, {
                    opposite: true,
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#FF5733'
                    },
                    labels: {
                        style: {
                            colors: '#FF5733',
                        },
                    },
                    title: {
                        text: "Total Peminjaman",
                        style: {
                            color: '#FF5733',
                        }
                    }
                }],
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function (y) {
                            if (typeof y !== "undefined") {
                                return y.toFixed(0) + " counts";
                            }
                            return y;
                        }
                    }
                }
            };

            // Multiple Y-Axis Chart
            var multipleYaxisOptions = {
                chart: {
                    height: 350,
                    type: 'line',
                    stacked: false,
                },
                stroke: {
                    width: [0, 2, 5],
                    curve: 'smooth'
                },
                plotOptions: {
                    bar: {
                        columnWidth: '50%'
                    }
                },
                series: [{
                    name: 'Anggota',
                    type: 'column',
                    data: {!! json_encode($anggotaData) !!}
                }, {
                    name: 'Peminjaman',
                    type: 'line',
                    data: {!! json_encode($peminjamanData) !!}
                }],
                xaxis: {
                    categories: {!! json_encode($labels) !!}
                },
                yaxis: [{
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#008FFB'
                    },
                    labels: {
                        style: {
                            colors: '#008FFB',
                        }
                    },
                    title: {
                        text: "Total Anggota",
                        style: {
                            color: '#008FFB',
                        }
                    }
                }, {
                    opposite: true,
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#FF5733'
                    },
                    labels: {
                        style: {
                            colors: '#FF5733',
                        },
                    },
                    title: {
                        text: "Total Peminjaman",
                        style: {
                            color: '#FF5733',
                        }
                    }
                }],
                tooltip: {
                    followCursor: true,
                    y: {
                        formatter: function (y) {
                            if (typeof y !== "undefined") {
                                return y.toFixed(0) + " counts";
                            }
                            return y;
                        }
                    }
                }
            };

            // Basic Polar Chart
            var totalBuku = {!! $totalBuku !!};
            var totalAnggota = {!! $totalAnggota !!};
            var totalPeminjaman = {!! $totalPeminjaman !!};

            var basicPolarOptions = {
                chart: {
                    height: 350,
                    type: 'polarArea',
                },
                series: [totalBuku, totalAnggota, totalPeminjaman],
                labels: ['Total Buku', 'Total Anggota', 'Total Peminjaman'],
                fill: {
                    opacity: 1
                },
                stroke: {
                    width: 1,
                    colors: undefined
                },
                yaxis: {
                    show: false
                },
                legend: {
                    position: 'bottom'
                },
                plotOptions: {
                    polarArea: {
                        rings: {
                            strokeWidth: 0
                        }
                    }
                },
                title: {
                    text: "Polar Chart: Total Buku, Anggota, dan Peminjaman"
                },
                theme: {
                    monochrome: {
                        enabled: true,
                        shadeTo: 'light',
                        shadeIntensity: 0.6
                    }
                }
            };

            // Basic Column Chart
            var basicColumnOptions = {
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        endingShape: 'rounded',
                        columnWidth: '55%',
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                series: [{
                    name: 'Buku',
                    data: {!! json_encode($bukuData) !!}
                }, {
                    name: 'Anggota',
                    data: {!! json_encode($anggotaData) !!}
                }],
                xaxis: {
                    categories: {!! json_encode($labels) !!}
                },
                yaxis: {
                    title: {
                        text: 'Counts'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + " counts"
                        }
                    }
                }
            };

            // Render Charts
            var lineColumnChart = new ApexCharts(document.querySelector("#lineColumnChart"), lineColumnOptions);
            lineColumnChart.render();

            var multipleYaxisChart = new ApexCharts(document.querySelector("#multipleYaxisChart"), multipleYaxisOptions);
            multipleYaxisChart.render();

            var basicPolarChart = new ApexCharts(document.querySelector("#basicPolar"), basicPolarOptions);
            basicPolarChart.render();

            var basicColumnChart = new ApexCharts(document.querySelector("#basicColumnChart"), basicColumnOptions);
            basicColumnChart.render();
        });
    </script>

    <!-- End Script -->

    </div>
</div>
@endsection
