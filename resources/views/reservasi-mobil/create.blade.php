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
        {{-- <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Tabel Reservasi</h4>
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <a href="{{ url('reservasi-mobil/create') }}" class="btn btn-outline-info">+ Buat Reservasi</a>
                            </div>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <ul class="nav nav-tabs mb-3" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#home" role="tab" aria-selected="true">
                                    Konfirmasi Reservasi <span class="badge bg-danger rounded-circle">274</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#product1" role="tab" aria-selected="false" tabindex="-1">
                                    Riwayat <span class="badge bg-danger rounded-circle">9448</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab" aria-selected="false" tabindex="-1">
                                    Lihat Semua
                                </a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content  text-muted">
                            <div class="tab-pane" id="home" role="tabpanel">
                                <div>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap mb-0" id="myTable">
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
                            <div class="tab-pane" id="product1" role="tabpanel">
                                <div>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap mb-0" id="myTable-1">
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
                            <div class="tab-pane" id="messages" role="tabpanel">
                                <div>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap mb-0" id="myTable-2">
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
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div> --}}

    </div>
    <!-- container-fluid -->
</div>
@endsection
@push('js')
    <script>
        $('#myTable').DataTable( {
            pageLength: 5,
            // dom: 'Bfrtip',
        } );
        $('#myTable-1').DataTable( {
            pageLength: 5,
            // dom: 'Bfrtip',
        } );
        $('#myTable-2').DataTable( {
            pageLength: 5,
            // dom: 'Bfrtip',
        } );
    </script>
@endpush