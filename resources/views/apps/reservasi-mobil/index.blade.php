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
                                    <a href="{{ url('reservasi-mobil/create') }}" class="btn btn-info">+ Buat Reservasi</a>
                                </div>
                            </div>
                        @endif
                    </div><!-- end card header -->
                    @role('Admin|Admin Umum|Admin Driver|Driver')
                        @include('apps.reservasi-mobil.components.admin-ui')
                    @endrole
                    @role('Requester')
                        @include('apps.reservasi-mobil.components.requester-ui')
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
        $(document).ready(function() {
            $('#reservasi_hari_iniTable, #konfirmasi_reservasiTable, #riwayatTable, #lihat_semuaTable, #sedang_diprosesTable, #perlu_diprosesTable, #reservasi_selesaiTable, #reservasi_ditolakTable, #ratingTable').DataTable({
                pageLength: 10
            });
        });
    </script>
@endpush