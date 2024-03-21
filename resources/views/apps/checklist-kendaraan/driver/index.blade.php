@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<style>
    #green-background {
        background-color: rgb(0, 243, 0);
        cursor: pointer;
    }
    #red-background {
        background-color: rgb(255, 187, 0);
        cursor: pointer;
    }
    
</style>
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
                            <li class="breadcrumb-item"><a href="{{ url('checklist-kendaraan') }}">{{ $title ? $title : '' }}</a></li>
                            <li class="breadcrumb-item active">Index</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <!-- Primary Alert -->
        <div class="alert alert-warning alert-dismissible alert-additional fade show" role="alert">
            <div class="alert-body">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <i class="ri-user-smile-line fs-16 align-middle"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="alert-heading">Perhatian !</h5>
                        <p class="mb-0">Pastikan semua kendaraan berwarna hijau disetiap minggunya. Jadwal Inspeksi adalah setiap Hari Senin</p>
                        <p class="mb-0">Kalau masih ada kendaraan berwarna kuning, artinya kamu belum melakukan inspeksi pada minggu tersebut.</p>
                        <p class="mb-0">Untuk melakukan inspeksi kendaraan, klik kotak yang berwarna kuning.</p>
                    </div>
                </div>
            </div>
            {{-- <div class="alert-content">
                <p class="mb-0">Jadwal melakukan checklist kendaraan adalah setiap Hari Senin.</p>
            </div> --}}
        </div>


        <div class="row justify-content-center">
            @foreach ($mobil as $row)
            @php
                $inspeksi = Carbon::now()->isoFormat('Y-MM-DD') >= $row->tgl_inspeksi_selanjutnya;
                if($inspeksi == false){
                    $class = 'green-background';
                    $pointerEvents = 'pointer-events: none;'; // Menambahkan CSS untuk menonaktifkan klik
                }else{
                    $class = 'red-background';
                    $pointerEvents = '';
                }
            @endphp
            <div class="col-xxl-2 col-lg-3 col-sm-5">
                <div class="card card-body text-center card-animate" style="{{ $pointerEvents }}" id="{{ $class }}" data-id="{{ Crypt::encrypt($row->id) }}">
                    <div class="avatar-sm mx-auto mb-3">
                        <img class="rounded-circle avatar-sm" alt="200x200" src="{{ asset('assets/img/icon-car.png') }}">
                    </div>
                    <h4 class="card-title text-white">{{ $row->nama }}</h4>
                </div>
            </div>
            @endforeach
        </div>
        <!-- end row -->

    </div>
    <!-- container-fluid -->
</div>
@endsection
@push('js')
<script>
    $(document).ready(function(){
        $('.card-animate').click(function(){
            let id = $(this).data('id');
            let url = "{{ url('checklist-kendaraan/create') }}/" + id ;
            window.location.href = url;
        });
    });
</script>
@endpush