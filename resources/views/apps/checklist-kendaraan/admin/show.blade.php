@extends('layouts.app')
@section('page-content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-n4 mx-n4 mb-n5">
                    <div class="bg-warning-subtle">
                        <div class="card-body pb-4 mb-5">
                            <div class="row">
                                <div class="col-md">
                                    <div class="row align-items-center">
                                        <div class="col-md-auto">
                                            <div class="avatar-md mb-md-0 mb-4">
                                                <div class="avatar-title bg-white rounded-circle">
                                                    <img src="{{ asset('assets/img/icon-car.png') }}" alt="" class="avatar-sm" />
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md">
                                            <h4 class="fw-semibold" id="ticket-title">{{ $mobil->nama }}</h4>
                                            <div class="hstack gap-3 flex-wrap">
                                                <div class="text-muted"><i class="ri-building-line align-bottom me-1"></i><span id="ticket-client">{{ $mobil->entitas->nama }}</span></div>
                                                <div class="vr"></div>
                                                <div class="text-muted">Terakhir Service : <span class="fw-medium " id="create-date">{{ Carbon::parse($mobil->terakhir_service)->isoFormat('D MMM, YYYY') }}</span></div>
                                                <div class="vr"></div>
                                                <div class="text-muted">Inspeksi Selanjutnya : <span class="fw-medium" id="due-date">{{ Carbon::parse($mobil->tgl_inspeksi_selanjutnya)->isoFormat('D MMM, YYYY') }}</span></div>
                                                <div class="vr"></div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div><!-- end card body -->
                    </div>
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row justify-content-center">
            <div class="col-xxl-5 col-xl-5">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0 fs-14">Detail Informasi Kendaraan</h6>
                    </div>
                    <div class="card-body mb-2">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless align-middle mb-0 table-sm">
                                <tbody>
                                    <tr>
                                        <td class="fw-medium" style="width: 40%;">No Polisi</td>
                                        <td>: {{ $mobil->nomor_polisi }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Tgl Habis STNK</td>
                                        <td>: {{ $mobil->habis_stnk }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Type Kendaraan</td>
                                        <td>: {{ $mobil->jenis_kendaraan->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Tahun Kendaraan</td>
                                        <td>: {{ $mobil->tahun_pembuatan }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Load Maksimum</td>
                                        <td>: {{ $mobil->load_maksimum }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">KM Saat Ini</td>
                                        <td>: {{ $mobil->km_kendaraan }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
            <div class="col-xxl-5 col-xl-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 fs-14">Detail Informasi PIC</h5>
                    </div>
                    <div class="card-body mb-2">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless align-middle mb-0 table-sm">
                                <tbody>
                                    <tr>
                                        <td class="fw-medium" style="width: 40%;">Nama</td>
                                        <td>: {{ $supir->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">No HP</td>
                                        <td>: {{ $supir->nomor_hp }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Tanggal Lahir</td>
                                        <td>: {{ $supir->ttl }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Alamat</td>
                                        <td>: {{ $supir->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Jenis Kelamin</td>
                                        <td>: {{ $supir->jk }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Jenis SIM</td>
                                        <td>: @if ($supir->jenis_sim == 2) Umum @else Perorangan @endif</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Monitoring Bulan {{ Carbon::create()->month($month)->locale('id')->monthName }} {{ Carbon::create()->year($year)->isoFormat('Y') }}</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <input type="text" id="get-id" value="{{ Crypt::encrypt($mobil->id) }}" hidden>
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted">Bulan<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <a class="dropdown-item" onclick="changeMonth(1)">Januari</a>
                                    <a class="dropdown-item" onclick="changeMonth(2)">Februari</a>
                                    <a class="dropdown-item" onclick="changeMonth(3)">Maret</a>
                                    <a class="dropdown-item" onclick="changeMonth(4)">April</a>
                                    <a class="dropdown-item" onclick="changeMonth(5)">Mei</a>
                                    <a class="dropdown-item" onclick="changeMonth(6)">Juni</a>
                                    <a class="dropdown-item" onclick="changeMonth(7)">Juli</a>
                                    <a class="dropdown-item" onclick="changeMonth(8)">Agustus</a>
                                    <a class="dropdown-item" onclick="changeMonth(9)">September</a>
                                    <a class="dropdown-item" onclick="changeMonth(10)">Oktober</a>
                                    <a class="dropdown-item" onclick="changeMonth(11)">November</a>
                                    <a class="dropdown-item" onclick="changeMonth(12)">Desember</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-nowrap align-middle mb-0" id="tabel-monitoring">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" style="width :10%">Week</th>
                                        <th scope="col" style="width :20%">Periode</th>
                                        <th scope="col" style="width :30%">Status</th>
                                        <th scope="col" style="width :20%">Tanggal Inspeksi</th>
                                        <th scope="col" style="width :40%">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($weeksInMonth as $week)
                                        <tr class="text-center">
                                            <td>Minggu ke-{{ $week['week_number'] }}</td>
                                            <td>{{ Carbon::parse($week['start_date'])->translatedFormat('d F Y') }} s/d {{ Carbon::parse($week['end_date'])->translatedFormat('d F Y') }}
                                            </td>
                                            <td>
                                                @if ($week['inspections'])
                                                    <span class="badge bg-success me-1">Sudah Inspeksi</span>
                                                    @if ($week['inspections']->first()->id_status == 1)
                                                        <span class="badge bg-warning">Menunggu Approval SPV Umum</span>
                                                    @elseif ($week['inspections']->first()->id_status == 2)
                                                        <span class="badge bg-success">Disetujui Umum</span>
                                                    @else
                                                        <span class="badge bg-warning">Dikembalikan ke Driver</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-danger">Belum Inspeksi</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($week['inspections'])
                                                    {{ Carbon::parse($week['inspections']->first()->tgl_inspeksi)->translatedFormat('l, d F Y') }}
                                                @else
                                                 - 
                                                 @endif
                                            </td>
                                            <td>
                                                @if($week['inspections'])
                                                    <a href="{{ url('checklist-kendaraan/show-inspeksi', Crypt::encrypt($week['inspections'][0]->id)) }}" class="ms-1">View More...</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div><!-- container-fluid -->
</div>
@endsection
@push('js')
<script>
    function changeMonth(month) {
            let year = {{ Carbon::now()->year }}; // Ganti dengan tahun yang sesuai
            let id = document.getElementById('get-id').value;
            window.location.href = '/checklist-kendaraan/show/'+ id +'/' + month + '/' + year;
        }
</script>
@endpush