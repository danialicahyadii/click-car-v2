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
                        <h4 class="card-title mb-0 flex-grow-1">Tabel Activity Log</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-0" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Diakses</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activity_log as $row)
                                            <tr>
                                                <th scope="row"><a href="#" class="fw-medium">{{ $loop->iteration }}</a></th>
                                                <td>{{ $row->user->name }}</td>
                                                <td>{{ $row->description }}</td>
                                                <td>{{ $row->created_at }}</td>
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
@include('role.components.modal-edit')
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.edit-btn').click(function () {
                let id = $(this).data('id');
                let name = $(this).data('name');
                $('#edit_id').val(id);
                $('#edit_name').val(name);
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#editForm').submit(function (event) {
                event.preventDefault();
    
                // Ambil nilai dari modal dan lakukan operasi penyimpanan di sini
                let editedId = $('#edit_id').val();
                let editedName = $('#edit_name').val();
                // let editedPermission = $('#edit_permission').val();
                // console.log(editedPermission, editedName)
    
                // Lakukan operasi penyimpanan sesuai kebutuhan, misalnya kirim ke server dengan AJAX
                $.ajax({
                    type: 'PUT', // Gunakan metode PUT untuk pembaruan
                    url: `/roles/${editedId}`,
                    data: { 
                        name: editedName, 
                        _token: '{{ csrf_token() }}',
                     },
                    success: function(response) {
                        if(response.message == 'Data berhasil diperbarui'){
                            window.location.reload();
                        }
                        // Handle respon dari server (jika diperlukan)
                        // $('#editModal').modal('hide'); // Tutup modal setelah berhasil disimpan
                    },
                    error: function(error) {
                        // Handle kesalahan (jika diperlukan)
                    }
                });
            });
        });
    </script>
    
@endpush