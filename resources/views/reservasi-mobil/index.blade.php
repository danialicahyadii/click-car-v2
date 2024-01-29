@extends('layouts.app')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Reservasi Mobil</a></li>
                            <li class="breadcrumb-item active">{{ $title ? $title : '' }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Tabel Reservasi</h4>
                        @if (in_array(Auth::user()->level_jabatan,[4,5,6]))
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <a href="{{ url('reservasi-mobil/create') }}" class="btn btn-outline-info">+ Buat Reservasi</a>
                                </div>
                            </div>
                        @endif
                    </div><!-- end card header -->
                    @role('Admin|Admin Umum|Admin Driver|Driver')
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-3" role="tablist" id="myTab">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#reservasi_hari_ini" role="tab" aria-selected="true">
                                    Reservasi Hari Ini <span class="badge bg-danger rounded-circle">1</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#konfirmasi_reservasi" role="tab" aria-selected="true">
                                    Konfirmasi Reservasi <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('id_status', 3)) }}</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#riwayat" role="tab" aria-selected="false" tabindex="-1">
                                    Riwayat <span class="badge bg-danger rounded-circle">9448</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#lihat_semua" role="tab" aria-selected="false" tabindex="-1">
                                    Lihat Semua
                                </a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content text-muted">
                            <div class="tab-pane active" id="reservasi_hari_ini" role="tabpanel">
                                <div>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap mb-0" id="reservasi_hari_iniTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Pemesan</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Mobil</th>
                                                    <th scope="col">Supir</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">#3120</a></th>
                                                    <td>Dani Ali Cahyadi</td>
                                                    <td><span class="badge rounded-pill text-bg-success">Selesai</span></td>
                                                    <td>INNOVA B 1806 HKR</td>
                                                    <td>M.TAUFIK HIDAYAT (KAPOL)</td>
                                                    <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">#3132</a></th>
                                                    <td>Bagus Chalil</td>
                                                    <td><span class="badge rounded-pill text-bg-info">Menunggu Approval Umum</span></td>
                                                    <td>AVANZA B 1121 HKR</td>
                                                    <td>AFRIKO (085781900687)</td>
                                                    <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>  
                                
                            </div>
                            <div class="tab-pane" id="konfirmasi_reservasi" role="tabpanel">
                                <div>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap mb-0" id="konfirmasi_reservasiTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Pemesan</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Mobil</th>
                                                    <th scope="col">Supir</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($reservasi_mobil->where('id_status', 3) as $row)
                                                    <tr>
                                                        <th scope="row"><a href="#" class="fw-medium">{{ $loop->iteration }}</a></th>
                                                        <td>{{ $row->user->name }}</td>
                                                        <td><span class="badge rounded-pill text-bg-info">Menunggu Approval Umum</span></td>
                                                        <td>AVANZA B 1121 HKR</td>
                                                        <td>AFRIKO (085781900687)</td>
                                                        <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>  
                            </div>
                            <div class="tab-pane" id="riwayat" role="tabpanel">
                                <div>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap mb-0" id="riwayatTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Pemesan</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Mobil</th>
                                                    <th scope="col">Supir</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">#3120</a></th>
                                                    <td>Dani Ali Cahyadi</td>
                                                    <td><span class="badge rounded-pill text-bg-success">Selesai</span></td>
                                                    <td>INNOVA B 1806 HKR</td>
                                                    <td>M.TAUFIK HIDAYAT (KAPOL)</td>
                                                    <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">#3132</a></th>
                                                    <td>Bagus Chalil</td>
                                                    <td><span class="badge rounded-pill text-bg-info">Menunggu Approval Umum</span></td>
                                                    <td>AVANZA B 1121 HKR</td>
                                                    <td>AFRIKO (085781900687)</td>
                                                    <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>  
                                
                            </div>
                            <div class="tab-pane" id="lihat_semua" role="tabpanel">
                                <div>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap mb-0" id="lihat_semuaTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Pemesan</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Mobil</th>
                                                    <th scope="col">Supir</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">#3120</a></th>
                                                    <td>DANI ALI CAHYADI</td>
                                                    <td><span class="badge rounded-pill text-bg-success">Selesai</span></td>
                                                    <td>INNOVA B 1806 HKR</td>
                                                    <td>M.TAUFIK HIDAYAT (KAPOL)</td>
                                                    <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div><!-- end card-body -->
                    @endrole
                    @role('Requester')
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-3" role="tablist" id="myTab">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#sedang_diproses" role="tab" aria-selected="true">
                                    Sedang Diproses <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('id_status', 3)) }}</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#perlu_diproses" role="tab" aria-selected="true">
                                    Perlu Diproses <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('id_status', 3)) }}</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#reservasi_selesai" role="tab" aria-selected="true">
                                    Reservasi Selesai <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('id_status', 3)) }}</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#reservasi_ditolak" role="tab" aria-selected="true">
                                    Reservasi Ditolak <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('id_status', 3)) }}</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#rating" role="tab" aria-selected="false" tabindex="-1">
                                    Rating <span class="badge bg-danger rounded-circle">3</span>
                                </a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content text-muted">
                            <div class="tab-pane" id="sedang_diproses" role="tabpanel">
                                <div>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap mb-0" id="sedang_diprosesTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Pemesan</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Mobil</th>
                                                    <th scope="col">Supir</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">#3120</a></th>
                                                    <td>DANI ALI CAHYADI</td>
                                                    <td><span class="badge rounded-pill text-bg-success">Selesai</span></td>
                                                    <td>INNOVA B 1806 HKR</td>
                                                    <td>M.TAUFIK HIDAYAT (KAPOL)</td>
                                                    <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>  
                            </div>
                            <div class="tab-pane active" id="perlu_diproses" role="tabpanel">
                                <div>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap mb-0" id="perlu_diprosesTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Pemesan</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Mobil</th>
                                                    <th scope="col">Supir</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">#3120</a></th>
                                                    <td>DANI ALI CAHYADI</td>
                                                    <td><span class="badge rounded-pill text-bg-success">Selesai</span></td>
                                                    <td>INNOVA B 1806 HKR</td>
                                                    <td>M.TAUFIK HIDAYAT (KAPOL)</td>
                                                    <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>  
                            </div>
                            <div class="tab-pane" id="reservasi_selesai" role="tabpanel">
                                <div>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap mb-0" id="reservasi_selesaiTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Pemesan</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Mobil</th>
                                                    <th scope="col">Supir</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">#3120</a></th>
                                                    <td>DANI ALI CAHYADI</td>
                                                    <td><span class="badge rounded-pill text-bg-success">Selesai</span></td>
                                                    <td>INNOVA B 1806 HKR</td>
                                                    <td>M.TAUFIK HIDAYAT (KAPOL)</td>
                                                    <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>  
                            </div>
                            <div class="tab-pane" id="reservasi_ditolak" role="tabpanel">
                                <div>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap mb-0" id="reservasi_ditolakTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Pemesan</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Mobil</th>
                                                    <th scope="col">Supir</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">#3120</a></th>
                                                    <td>DANI ALI CAHYADI</td>
                                                    <td><span class="badge rounded-pill text-bg-success">Selesai</span></td>
                                                    <td>INNOVA B 1806 HKR</td>
                                                    <td>M.TAUFIK HIDAYAT (KAPOL)</td>
                                                    <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>  
                            </div>
                            <div class="tab-pane" id="rating" role="tabpanel">
                                <div>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap mb-0" id="ratingTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Pemesan</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Mobil</th>
                                                    <th scope="col">Supir</th>
                                                    <th scope="col">Rating</th>
                                                    <th scope="col">Review</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">#3120</a></th>
                                                    <td>Dani Ali Cahyadi</td>
                                                    <td><span class="badge rounded-pill text-bg-success">Selesai</span></td>
                                                    <td>INNOVA B 1806 HKR</td>
                                                    <td>M.TAUFIK HIDAYAT (KAPOL)</td>
                                                    <td><i class="ri-star-s-fill text-warning"></i><i class="ri-star-s-fill text-warning"></i><i class="ri-star-s-fill text-warning"></i><i class="ri-star-s-fill text-warning"></i><i class="ri-star-s-fill text-warning"></i></td>
                                                    <td>Driver Asik</td>
                                                    <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">#3132</a></th>
                                                    <td>Bagus Chalil</td>
                                                    <td><span class="badge rounded-pill text-bg-success">Selesai</span></td>
                                                    <td>AVANZA B 1121 HKR</td>
                                                    <td>AFRIKO (085781900687)</td>
                                                    <td><i class="ri-star-s-fill text-warning"></i><i class="ri-star-s-fill text-warning"></i><i class="ri-star-s-fill text-warning"></i><i class="ri-star-s-fill text-warning"></i><i class="ri-star-s-fill text-warning"></i></td>
                                                    <td>Driver Seru, Ramah</td>
                                                    <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">#3132</a></th>
                                                    <td>Bagus Chalil</td>
                                                    <td><span class="badge rounded-pill text-bg-success">Selesai</span></td>
                                                    <td>AVANZA B 1121 HKR</td>
                                                    <td>AFRIKO (085781900687)</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td><a href="javascript:void(0);" class="link-success">Belum di rating <i class="ri-arrow-right-line align-middle"></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>  
                                
                            </div>
                        </div>
                    </div><!-- end card-body -->
                    @endrole
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>

    </div>
    <!-- container-fluid -->
</div>
@endsection
@push('js')
    <script>
        $('#reservasi_hari_iniTable').DataTable( {
            pageLength: 15,
            // dom: 'Bfrtip',
        } );
        $('#konfirmasi_reservasiTable').DataTable( {
            pageLength: 5,
            // dom: 'Bfrtip',
        } );
        $('#riwayatTable').DataTable( {
            pageLength: 5,
            // dom: 'Bfrtip',
        } );
        $('#lihat_semuaTable').DataTable( {
            pageLength: 5,
            // dom: 'Bfrtip',
        } );
        $('#sedang_diprosesTable').DataTable( {
            pageLength: 15,
            // dom: 'Bfrtip',
        } );
        $('#perlu_diprosesTable').DataTable( {
            pageLength: 5,
            // dom: 'Bfrtip',
        } );
        $('#reservasi_selesaiTable').DataTable( {
            pageLength: 5,
            // dom: 'Bfrtip',
        } );
        $('#reservasi_ditolakTable').DataTable( {
            pageLength: 5,
            // dom: 'Bfrtip',
        } );
        $('#ratingTable').DataTable( {
            pageLength: 5,
            // dom: 'Bfrtip',
        } );
    </script>
@endpush