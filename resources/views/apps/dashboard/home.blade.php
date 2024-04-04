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
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ $title ? $title : '' }}</a></li>
                            <li class="breadcrumb-item active">Home</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="card">
            <div class="row align-items-center">
                <div class="col-12 col-md-5 col-lg-6 p-3">
                    <!-- Image -->
                    <img src="{{ asset('assets/img/dashboard.png') }}" alt="..." class="img-fluid mb-6 mb-md-0">
                </div>
                <div class="col-12 col-md-7 col-lg-6 p-5">
                    <!-- Heading -->
                    <h2>
                        Kimia Farma E-Reservation Car: Click Car.
                    </h2>
                    <!-- Text -->
                    <p class="fs-lg text-gray-700 mb-5">
                        Merupakan sistem yang memfasilitasi reservasi kendaraan secara digital untuk memenuhi kebutuhan perjalanan dinas karyawan dengan memberikan akses yang mudah, fleksibilitas, dan dukungan terhadap aktivitas bisnis perusahaan. Selain itu, fitur pelacakan dan pelaporan juga dapat menjadi aspek penting dalam manajemen dan pengawasan perjalanan dinas.
                    </p>
                    <!-- Stats -->
                    <div class="d-flex">
                        <div class="col-4">
                            <h3 class="mb-0">
                                <span data-countup="{&quot;startVal&quot;: 0}" data-to="100" data-aos="" data-aos-id="countup:in" class="aos-init aos-animate">100</span>%
                            </h3>
                            <p class="text-gray-700 mb-0">
                                Integrasi
                            </p>
                        </div>
                        <div class="col-2 border-start border-gray-300"></div>
                        <div class="col-4">
                            <h3 class="mb-0">
                                <span data-countup="{&quot;startVal&quot;: 0}" data-to="24" data-aos="" data-aos-id="countup:in" class="aos-init aos-animate">24</span>/
                                <span data-countup="{&quot;startVal&quot;: 0}" data-to="7" data-aos="" data-aos-id="countup:in" class="aos-init aos-animate">7</span>
                            </h3>
                            <p class="text-gray-700 mb-0">
                                Realtime
                            </p>
                        </div>
                    </div>
            
                </div>
            </div> <!-- / .row -->
            </div>

    </div>
    <!-- container-fluid -->
</div>
@endsection
@push('js')
<!-- prismjs plugin -->
<script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>
@endpush