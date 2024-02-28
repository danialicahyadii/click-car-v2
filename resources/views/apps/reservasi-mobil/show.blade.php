@extends('layouts.app')
@section('css')
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css"
/>
<style>
    #demo {
        background-image: url('{{ asset('path/to/your/image.jpg') }}'); /* Path diarahkan ke folder public */
        background-repeat: no-repeat; /* Menghilangkan pengulangan gambar */
        background-size: 30%; /* Mengatur ukuran gambar latar belakang */
        background-position: center center; /* Menempatkan gambar di tengah */
        /* height: 300px; Sesuaikan tinggi sesuai kebutuhan Anda */
        border-radius: 15px; /* Mengatur border radius */
        overflow: hidden; /* Menghilangkan gambar latar belakang yang berlebihan */
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
                    <h4 class="mb-sm-0">Invoice Details</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                            <li class="breadcrumb-item active">Invoice Details</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="card" id="demo">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Pemesan</p>
                                        <h5 class="fs-14 mb-0"><span id="invoice-no">Lani Asep Sutisna</span></h5>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                        <h5 class="fs-14 mb-0"><span id="invoice-date">23 Nov, 2021</span> <small class="text-muted" id="invoice-time">02:36PM</small></h5>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Status</p>
                                        <span class="badge bg-success-subtle text-success fs-11" id="payment-status">Selesai</span>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Pemeriksa</p>
                                        <h5 class="fs-14 mb-0"><span id="total-amount">Rizal Afriadi</span></h5>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4 border-top border-top-dashed">
                                <div class="row g-3 align-items-center justify-content-center">
                                    <div class="col-3">
                                        <h6 class="text-muted text-uppercase fw-semibold mb-3">Asal</h6>
                                        <p class="text-muted mb-1" id="billing-address-line-1">305 S San Gabriel Blvd</p>
                                        <p class="text-muted mb-1"><span>Phone: +</span><span id="billing-phone-no">(123) 456-7890</span></p>
                                        <p class="text-muted mb-0"><span>Tax: </span><span id="billing-tax-no">12-3456789</span> </p>
                                    </div>
                                    <!--end col-->
                                    <div class="col-3 text-center">
                                        <h4 class="text-muted mb-1"><i class="ri-arrow-right-fill"></i></h4>
                                    </div>
                                    <!--end col-->
                                    <div class="col-3">
                                        <h6 class="text-muted text-uppercase fw-semibold mb-3">Tujuan</h6>
                                        <p class="text-muted mb-1" id="shipping-address-line-1">305 S San Gabriel Blvd</p>
                                        <p class="text-muted mb-1"><span>Phone: +</span><span id="shipping-phone-no">(123) 456-7890</span></p>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr class="table-active">
                                                <th scope="col" style="width: 50px;">#</th>
                                                <th scope="col">Nama Penumpang</th>
                                                <th scope="col">NPP</th>
                                                <th scope="col">No. HP</th>
                                            </tr>
                                        </thead>
                                        <tbody id="products-list">
                                            <tr>
                                                <th scope="row">01</th>
                                                <td class="text-start">
                                                    <span class="fw-medium">Dani Ali Cahyadi</span>
                                                    <p class="text-muted mb-0">Pelaksana ESS Devops</p>
                                                </td>
                                                <td>20010202B</td>
                                                <td>081289124536</td>
                                        </tbody>
                                    </table><!--end table-->
                                </div>
                                <div class="border-top border-top-dashed mt-2">
                                    <div class="row ms-4 mt-4">
                                        <h6 class="text-muted text-uppercase fw-semibold mb-3">Detail Reservasi :</h6>
                                    </div>
                                    <div class="row ms-4 justify-content-center">
                                        <div class="col-6">
                                            <p class="text-muted mb-1">Mobil : <span class="fw-medium" id="payment-method">Hi-Ace Commuter B 7505 II</span></p>
                                            <p class="text-muted mb-1">Supir : <span class="fw-medium" id="card-holder-name">David Nichols</span></p>
                                            <p class="text-muted mb-1">Jenis Kendaraan : <span class="fw-medium" id="card-number">Hi-Ace</span></p>
                                            <p class="text-muted">Jenis Plat : <span class="fw-medium" id=""></span><span id="card-total-amount">Ganjil</span></p>
                                        </div>
                                        <div class="col-6">
                                            <p class="text-muted mb-1">Keperluan : <span class="fw-medium" id="payment-method">Rapat Audit</span></p>
                                            <p class="text-muted mb-1">PIC : <span class="fw-medium" id="card-holder-name">Dani Ali Cahyadi</span></p>
                                            <p class="text-muted mb-1">No WA PIC : <span class="fw-medium" id="card-number">081289124536</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top border-top-dashed mt-2">
                                    <div class="row ms-4 mt-4">
                                        <h6 class="text-muted text-uppercase fw-semibold mb-3">Catatan :</h6>
                                    </div>
                                    <div class="row ms-4 justify-content-center">
                                        <div class="col-6">
                                            <div class="d-flex mb-4">
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="fs-13">Requester <small class="text-muted">20 Dec 2021 - 05:47AM</small></h5>
                                                    <p class="text-muted">Lanjutkan</p>
                                                    <h5 class="fs-13">Atasan Requester <small class="text-muted">20 Dec 2021 - 05:47AM</small></h5>
                                                    <p class="text-muted">Lanjutkan</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex mb-4">
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="fs-13">Admin Umum <small class="text-muted">20 Dec 2021 - 05:47AM</small></h5>
                                                    <p class="text-muted">Lanjutkan</p>
                                                    <h5 class="fs-13">Driver <small class="text-muted">20 Dec 2021 - 05:47AM</small></h5>
                                                    <p class="text-muted">Lanjutkan</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                    <a href="javascript:window.print()" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Print</a>
                                    <a href="javascript:void(0);" class="btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Download</a>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                    </div><!--end row-->
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
@endpush