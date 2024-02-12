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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Master User</a></li>
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
                        <h4 class="card-title mb-0 flex-grow-1">Tabel Permissions</h4>
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <!-- Default Modals -->
                                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal">+ Tambah</button>
                                @include('permission.components.modal-add')
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
                                            <th scope="col">Guard</th>
                                            <th scope="col">Dibuat</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['permission'] as $row)
                                            <tr>
                                                <th scope="row"><a href="#" class="fw-medium">#{{ $loop->iteration }}</a></th>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->guard_name }}</td>
                                                <td>{{ $row->created_at->diffForHumans() }}</td>
                                                <td><a href="{{ route('users.edit', $row->id) }}" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
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
            pageLength: 10,
            // dom: 'Bfrtip',
        } );
        $('#myTable-1').DataTable( {
            pageLength: 10,
            // dom: 'Bfrtip',
        } );
        $('#myTable-2').DataTable( {
            pageLength: 10,
            // dom: 'Bfrtip',
        } );
    </script>
@endpush