@extends('layouts.app')
@section('css')
<meta http-equiv="refresh" content="30">
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
                            <li class="breadcrumb-item"><a href="{{ url('reservasi-mobil') }}">{{ $title ? $title : '' }}</a></li>
                            <li class="breadcrumb-item active">Index</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Warning Alert -->
        @role('Admin Driver|Driver')
        @if ($checklistExists == false)
            {{-- <div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Kamu belum melakukan Inspeksi Kendaraanmu
                <button type="button" class="btn-close" data-bs-dismiss=" alert" aria-label="Close"></button>
            </div> --}}
            <!-- Dark Alert -->
            <!-- Warning Alert -->
            <div class="alert alert-warning alert-dismissible bg-warning text-white alert-label-icon fade show" role="alert">
                <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Kamu belum melakukan Inspeksi Kendaraanmu
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @endrole


        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Tabel Reservasi</h4>
                        @role('Full Admin|Admin Umum')
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <a href="{{ url('reservasi-mobil/create') }}" class="btn btn-info">+ Buat Reservasi</a>
                                </div>
                            </div>
                        @elserole('Requester')
                            @if (in_array(Auth::user()->level_jabatan,[4,5,6]))
                                <div class="flex-shrink-0">
                                    <div class="form-check form-switch form-switch-right form-switch-md">
                                        @if ($belumRating >= 2)
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalBelumRating" class="btn btn-info">+ Buat Reservasi</a>
                                            @include('apps.reservasi-mobil.components.modal-belumRating')
                                        @else
                                            <a href="{{ url('reservasi-mobil/create') }}" class="btn btn-info">+ Buat Reservasi</a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endrole
                    </div><!-- end card header -->
                    @role('Admin|Admin Umum')
                        @include('apps.reservasi-mobil.components.admin-ui')
                    @endrole
                    @role('Requester')
                        @include('apps.reservasi-mobil.components.requester-ui')
                    @endrole
                    @role('Admin Driver')
                        @include('apps.reservasi-mobil.components.admin-driver-ui')
                    @endrole
                    @role('Driver')
                        @include('apps.reservasi-mobil.components.driver-ui')
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