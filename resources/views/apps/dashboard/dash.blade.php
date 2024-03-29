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
                
                <div class="row">
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Top 10 Driver Favorit</h4>
                            </div><!-- end card-header -->
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush border-dashed mb-0">
                                    @foreach ($topDrivers->where('id', '!=', 22) as $row)
                                        <li class="list-group-item d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/img/icon-user.png') }}" class="avatar-xs" alt="">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">{{ $row->nama }}</h6>
                                                <p class="text-muted mb-0">{{ $row->reservation_count }} Kali Dirating</p>
                                            </div>
                                            {{-- <div class="flex-shrink-0 text-end">
                                                <h6 class="fs-14 mb-1">$12,863.08</h6>
                                                <p class="text-success fs-12 mb-0">+$67.21 (+4.33%)</p>
                                            </div> --}}
                                        </li><!-- end -->
                                    @endforeach
                                </ul><!-- end ul -->
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Top 10 Kendaraan Favorit</h4>
                            </div><!-- end card-header -->
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush border-dashed mb-0">
                                    @foreach ($topVehicles as $row)
                                        <li class="list-group-item d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/img/icon-car.png') }}" class="avatar-xs" alt="">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">{{ $row->nama }}</h6>
                                                <p class="text-muted mb-0">{{ $row->reservation_count }} Kali Dipesan</p>
                                            </div>
                                            {{-- <div class="flex-shrink-0 text-end">
                                                <h6 class="fs-14 mb-1">$12,863.08</h6>
                                                <p class="text-success fs-12 mb-0">+$67.21 (+4.33%)</p>
                                            </div> --}}
                                        </li><!-- end -->
                                    @endforeach
                                </ul><!-- end ul -->
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Top 10 Penumpang Aktif</h4>
                            </div><!-- end card-header -->
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush border-dashed mb-0">
                                    @foreach ($topUsers as $row)
                                        <li class="list-group-item d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/img/icon-user.png') }}" class="avatar-xs" alt="">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">{{ $row->name }}</h6>
                                                <p class="text-muted mb-0">{{ $row->reservation_count }} Kali Perjalanan</p>
                                            </div>
                                            {{-- <div class="flex-shrink-0 text-end">
                                                <h6 class="fs-14 mb-1">$12,863.08</h6>
                                                <p class="text-success fs-12 mb-0">+$67.21 (+4.33%)</p>
                                            </div> --}}
                                        </li><!-- end -->
                                    @endforeach
                                </ul><!-- end ul -->
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Top 10 Lokasi Favorit</h4>
                            </div><!-- end card-header -->
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush border-dashed mb-0">
                                    @foreach ($topLocation as $row)
                                        <li class="list-group-item d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/img/map.png') }}" class="avatar-xs" alt="">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1" title="{{ $row->tujuan }}">{{ strlen($row->tujuan) > 25 ? substr($row->tujuan, 0, 25) . '...' : $row->tujuan }}</h6>
                                                <p class="text-muted mb-0">{{ $row->location_count }} Kali Dikunjungi</p>
                                            </div>
                                            {{-- <div class="flex-shrink-0 text-end">
                                                <h6 class="fs-14 mb-1">$12,863.08</h6>
                                                <p class="text-success fs-12 mb-0">+$67.21 (+4.33%)</p>
                                            </div> --}}
                                        </li><!-- end -->
                                    @endforeach
                                </ul><!-- end ul -->
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-8">
                        <div class="card pb-3">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Jadwal Hari Ini</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-hover table-borderless table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted bg-light-subtle">
                                            <tr>
                                                <th>Kode</th>
                                                <th>Pemesan</th>
                                                <th>Mobil</th>
                                                <th>Supir</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead><!-- end thead -->
                                        <tbody>
                                            @foreach ($booking_show as $row)
                                                <tr>
                                                    <td>
                                                        <h6 class="fs-14 mb-0">#{{ $row->kode_pemesanan }}</h6>
                                                    </td>
                                                    <td>{{ $row->user->name }}</td>
                                                    <td>
                                                        <h6 class="text-success fs-13 mb-0">{{ $row->mobil->nama }}</h6>
                                                    </td>
                                                    <td>{{ $row->supir->nama }}</td>
                                                    <td>{{ $row->status->status }}</td>
                                                </tr><!-- end -->
                                            @endforeach
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div><!-- end tbody -->
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-4">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Rating</h4>
                            </div><!-- end cardheader -->
                            <div class="card-body">
                                <canvas id="myChart"></canvas>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                </div>
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
<!-- Chart JS -->
{{-- <script src="{{ URL::asset('assets/libs/chart.js/chart.min.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ URL::asset('assets/js/pages/dashboard-projects.init.js') }}"></script>
@include('apps.dashboard.components.bar-chart')
<script>
    const ctx = document.getElementById('myChart');
    const data = {
        datasets: [{
            data: [{{ $rating[1] }}, {{ $rating[3] }}, {{ $rating[5] }}],
            backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
            ],
            hoverOffset: 10
        }],
        labels: ['Tidak Puas', 'Cukup', 'Sangat Puas'],
        };
    new Chart(ctx, {
      type: 'pie',
      data: data,
      options: {
            layout: {
                padding: {
                    bottom: 20 // Menambahkan ruang di bagian bawah untuk label
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom', // Menampilkan legenda di bagian bawah
                }
            },
        },
    });
</script>
@endpush