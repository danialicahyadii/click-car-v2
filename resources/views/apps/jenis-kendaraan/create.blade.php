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
                            <li class="breadcrumb-item"><a href="{{ url('jenis-kendaraan') }}">{{ $title ? $title : '' }}</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <form action="{{ route('jenis-kendaraan.store') }}" method="POST" id="form">
            @csrf
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Form Tambah Data Jenis Kendaraan</h4>
                        </div><!-- end card header -->
                        <div class="card-body pb-5">
                            <div class="row gy-4">
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Nama Jenis Kendaraan</label>
                                        <input type="text" class="form-control" name="nama" placeholder="contoh : Avanza">
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <div class="form-group mb-4">
                <a href="{{ url()->previous() }}" class="btn btn-warning"><i class="ri-arrow-go-back-fill"></i> Kembali</a>
                <button id="btnSimpan" class="btn btn-primary"><i class="ri-send-plane-fill"></i> Simpan</button>
            </div>
        </form>

    </div>
    <!-- container-fluid -->
</div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#form').submit(function(event) {
            event.preventDefault(); 

            let isFormValid = true;

            $(this).find('input[type="text"], input[type="date"]').each(function() {
                if ($.trim($(this).val()) === '') {
                    isFormValid = false;
                }
            });

            
            $(this).find('select').each(function() {
                if (!$(this).val() || $(this).val() === '') {
                    isFormValid = false; 
                }
            });

            if (!isFormValid) {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Ada data yang belum diisi!',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Oke'
                });
            } else {
                this.submit(); 
            }
        });

        $('#btnSimpan').on('click', function() {
            $('#form').submit();
        });
    });
</script>
@endpush