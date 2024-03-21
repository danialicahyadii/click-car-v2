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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Master Data</a></li>
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
                        <h4 class="card-title mb-0 flex-grow-1">Tabel {{ $title ? $title : '' }}</h4>
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <a href="{{ url('supir/create') }}" class="btn btn-info">Tambah Data</a>
                            </div>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-0" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Entitas</th>
                                            <th scope="col">Dibuat</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($supir->where('id_entitas', Auth::user()->id_entitas) as $row)
                                            <tr>
                                                <th scope="row"><a href="#" class="fw-medium">{{ $loop->iteration }}</a></th>
                                                <td>{{ $row->nama }}</td>
                                                <td>
                                                    @if ($row->id_status == 2)
                                                        <span class="badge rounded-pill text-bg-danger">Tidak Aktif</span>
                                                    @elseif ($row->id_status == 1)
                                                        <span class="badge rounded-pill text-bg-success">Aktif</span>
                                                    @endif
                                                </td>
                                                <td>{{ $row->entitas->nama }}</td>
                                                <td>{{ $row->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('supir.edit', $row->id) }}" class="btn btn-info btn-sm edit-btn"><i class="ri-pencil-fill fs-16"></i></a>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#myModalDelete{{ $row->id }}" class="btn btn-danger btn-sm edit-btn"><i class="ri-delete-bin-fill fs-16"></i></a>
                                                    @include('apps.supir.components.modal-delete')
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div><!-- end card-body -->
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
        $('#myTable').DataTable( {
            responsive: true,
            pageLength: 10,
        } );
    </script>
@endpush