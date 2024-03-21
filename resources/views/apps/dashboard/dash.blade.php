@extends('layouts.app')
@section('css')
@endsection
@section('page-content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ $title ? $title : '' }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ $title ? $title : '' }}</a></li>
                            <li class="breadcrumb-item active">Dash</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row project-wrapper">
            <div class="col-12">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                            <i class="ri-roadster-fill" class="text-primary"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Mobil Tersedia</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="{{ $count_mobil - $booking }}">0</span></h4>
                                        </div>
                                        <p class="text-muted text-truncate mb-0">Mobil</p>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </div><!-- end col -->

                    <div class="col-xl-4">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-warning-subtle text-warning rounded-2 fs-2">
                                            <i data-feather="briefcase" class="text-warning"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-medium text-muted mb-3">Total Reservasi</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="{{ $setuju }}">0</span></h4>
                                        </div>
                                        <p class="text-muted mb-0">Reservasi</p>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </div><!-- end col -->

                    <div class="col-xl-4">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle text-success rounded-2 fs-2">
                                            <i data-feather="navigation" class="text-success"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Mobil Keluar</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="{{ $booking }}">0</span></h4>
                                        </div>
                                        <p class="text-muted text-truncate mb-0">Mobil</p>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Mobil Tersedia</h4>
                            </div><!-- end card header -->
                            <div class="card-header p-1 border-0 bg-soft-light">
                                    <!-- With Indicators -->
                                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner" role="listbox">
                                            @for ($j = 0; $j < 3; $j++)
                                        <div class="carousel-item {{ $j == 0 ? 'active' : '' }}">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <img src="{{ URL::to('/assets/img/park3.png') }}"
                                                                class="d-block w-100" alt="profile Pic" width="100%">
                                                            @php
                                                                $start = $j * 14 + 1;
                                                                $end = min(($j + 1) * 14, $count_mobil);
                                                            @endphp
                                                            @for ($i = $start; $i <= $end; $i++)
                                                                @if ($i == 1 - $booking)
                                                                    <img class="mobil8"
                                                                        src="{{ URL::to('/assets/img/mobil4.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 2 - $booking)
                                                                    <img class="mobil9"
                                                                        src="{{ URL::to('/assets/img/mobil5.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 3 - $booking)
                                                                    <img class="mobil10"
                                                                        src="{{ URL::to('/assets/img/mobil4.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 4 - $booking)
                                                                    <img class="mobil11"
                                                                        src="{{ URL::to('/assets/img/mobil5.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 5 - $booking)
                                                                    <img class="mobil12"
                                                                        src="{{ URL::to('/assets/img/mobil5.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 6 - $booking)
                                                                    <img class="mobil13"
                                                                        src="{{ URL::to('/assets/img/mobil4.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 7 - $booking)
                                                                    <img class="mobil14"
                                                                        src="{{ URL::to('/assets/img/mobil4.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 8 - $booking)
                                                                    <img class="mobil1"
                                                                        src="{{ URL::to('/assets/img/mobil6.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 9 - $booking)
                                                                    <img class="mobil2"
                                                                        src="{{ URL::to('/assets/img/mobil7.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 10 - $booking)
                                                                    <img class="mobil3"
                                                                        src="{{ URL::to('/assets/img/mobil6.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 11 - $booking)
                                                                    <img class="mobil4"
                                                                        src="{{ URL::to('/assets/img/mobil6.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 12 - $booking)
                                                                    <img class="mobil5"
                                                                        src="{{ URL::to('/assets/img/mobil7.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 13 - $booking)
                                                                    <img class="mobil6"
                                                                        src="{{ URL::to('/assets/img/mobil6.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 14 - $booking)
                                                                    <img class="mobil7"
                                                                        src="{{ URL::to('/assets/img/mobil6.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 15 - $booking)
                                                                    <img class="mobil8"
                                                                        src="{{ URL::to('/assets/img/mobil4.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 16 - $booking)
                                                                    <img class="mobil9"
                                                                        src="{{ URL::to('/assets/img/mobil5.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 17 - $booking)
                                                                    <img class="mobil10"
                                                                        src="{{ URL::to('/assets/img/mobil5.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 18 - $booking)
                                                                    <img class="mobil11"
                                                                        src="{{ URL::to('/assets/img/mobil4.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 19 - $booking)
                                                                    <img class="mobil12"
                                                                        src="{{ URL::to('/assets/img/mobil5.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 20 - $booking)
                                                                    <img class="mobil13"
                                                                        src="{{ URL::to('/assets/img/mobil5.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 21 - $booking)
                                                                    <img class="mobil14"
                                                                        src="{{ URL::to('/assets/img/mobil4.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 22 - $booking)
                                                                    <img class="mobil1"
                                                                        src="{{ URL::to('/assets/img/mobil7.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 23 - $booking)
                                                                    <img class="mobil2"
                                                                        src="{{ URL::to('/assets/img/mobil7.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 24 - $booking)
                                                                    <img class="mobil3"
                                                                        src="{{ URL::to('/assets/img/mobil6.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 25 - $booking)
                                                                    <img class="mobil4"
                                                                        src="{{ URL::to('/assets/img/mobil7.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 26 - $booking)
                                                                    <img class="mobil5"
                                                                        src="{{ URL::to('/assets/img/mobil6.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 27 - $booking)
                                                                    <img class="mobil6"
                                                                        src="{{ URL::to('/assets/img/mobil6.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 28 - $booking)
                                                                    <img class="mobil7"
                                                                        src="{{ URL::to('/assets/img/mobil6.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 29 - $booking)
                                                                    <img class="mobil8"
                                                                        src="{{ URL::to('/assets/img/mobil4.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 30 - $booking)
                                                                    <img class="mobil9"
                                                                        src="{{ URL::to('/assets/img/mobil4.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 31 - $booking)
                                                                    <img class="mobil10"
                                                                        src="{{ URL::to('/assets/img/mobil4.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 32 - $booking)
                                                                    <img class="mobil11"
                                                                        src="{{ URL::to('/assets/img/mobil5.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 33 - $booking)
                                                                    <img class="mobil12"
                                                                        src="{{ URL::to('/assets/img/mobil4.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 34 - $booking)
                                                                    <img class="mobil13"
                                                                        src="{{ URL::to('/assets/img/mobil5.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 35 - $booking)
                                                                    <img class="mobil14"
                                                                        src="{{ URL::to('/assets/img/mobil4.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 36 - $booking)
                                                                    <img class="mobil1"
                                                                        src="{{ URL::to('/assets/img/mobil6.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 37 - $booking)
                                                                    <img class="mobil2"
                                                                        src="{{ URL::to('/assets/img/mobil7.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 38 - $booking)
                                                                    <img class="mobil3"
                                                                        src="{{ URL::to('/assets/img/mobil6.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 39 - $booking)
                                                                    <img class="mobil4"
                                                                        src="{{ URL::to('/assets/img/mobil6.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 40 - $booking)
                                                                    <img class="mobil5"
                                                                        src="{{ URL::to('/assets/img/mobil7.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 41 - $booking)
                                                                    <img class="mobil6"
                                                                        src="{{ URL::to('/assets/img/mobil6.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @elseif($i == 42 - $booking)
                                                                    <img class="mobil7"
                                                                        src="{{ URL::to('/assets/img/mobil7.png') }}"
                                                                        alt="profile Pic" width="100%">
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                            </div><!-- end card header -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header p-0 border-0 bg-soft-light text-center">
                                <div class="mb-4 mt-4">
                                    @if ($booking == 1)
                                        <img src="{{ URL::to('/assets/img/mobiljalan2.gif') }}" alt="profile Pic"
                                            width="50%">
                                    @elseif($booking > 1)
                                        <img src="{{ URL::to('/assets/img/mobil.gif') }}" alt="profile Pic" width="50%">
                                    @else
                                        <img src="{{ URL::to('/assets/img/mobilkosong.png') }}" alt="profile Pic"
                                            width="50%">
                                    @endif
                                </div>
                            </div><!-- end card header -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">RANKING BAR CHART TOP 5</h4>
                                <div>
                                    <button type="button" class="btn btn-secondary btn-sm">
                                        <i class="bx bx-filter mb-0 me-1"></i> Filter Bulan
                                    </button>
                                </div>
                            </div><!-- end card header -->
                            <div class="card-body p-2 pb-2">
                                <div>
                                    <div id="column_chart" class="apex-charts">

                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end col -->
        </div><!-- end row -->

    </div>
    <!-- container-fluid -->
</div>
@endsection
@push('js')
<!-- prismjs plugin -->
<script src="{{ URL::asset('assets/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/dashboard-projects.init.js') }}"></script>
<script>
     var options = {
          series: [{
          name: 'Net Profit',
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
          name: 'Revenue',
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }, {
          name: 'Free Cash Flow',
          data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
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
        xaxis: {
          categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
          title: {
            text: '$ (thousands)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#column_chart"), options);
        chart.render();
</script>
@endpush