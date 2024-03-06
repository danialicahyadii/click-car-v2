@extends('layouts.app')
@section('css')
<script type='text/javascript' src='{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}'></script>
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
                            <li class="breadcrumb-item"><a href="{{ url('reservasi-mobil') }}">Reservasi Mobil</a></li>
                            <li class="breadcrumb-item active">{{ $title ? $title : '' }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        @hasanyrole('Admin Driver|Driver')
        @if ($reservasi_mobil->id_supir == Auth::user()->supir->id && $reservasi_mobil->id_status == 13 || $reservasi_mobil->id_status == 14)
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="hstack gap-2 justify-content-end d-print-none">
                            <!-- Varying Modal Content -->
                            <div class="hstack gap-2 flex-wrap" class="page-title-right">
                                <button type="button" class="btn @if ($reservasi_mobil->id_status == 13)
                                    btn-danger @else btn-success
                                @endif" data-bs-toggle="modal" data-bs-target="#actionDriver"><i class="ri-car-fill align-bottom me-1"></i>@if ($reservasi_mobil->id_status == 13)
                                    Akhiri Perjalanan @else Mulai
                                @endif</button>
                                @if ($reservasi_mobil->id_status == 14)
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#batal"><i class="ri-close-fill align-bottom me-1"></i> Batal</button>
                                @endif
                                @include('apps.reservasi-mobil.components.modal-actionDriver')
                                @include('apps.reservasi-mobil.components.modal-batal')
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
        @endif
        @endrole

        <div class="row align-items-center justify-content-center">
            <div class="col-xxl-9">
                <div class="card" id="demo">
                    <div class="row">
                        {{-- <div class="col-lg-12">
                            <div class="card-header border-bottom-dashed p-4">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <img src="{{ asset('assets/images/logo-dark.png') }}" class="card-logo card-logo-dark" alt="logo dark" height="17">
                                        <img src="{{ asset('assets/images/logo-light.png') }}" class="card-logo card-logo-light" alt="logo light" height="17">
                                        <div class="mt-sm-5 mt-4">
                                            <h6 class="text-muted text-uppercase fw-semibold">Address</h6>
                                            <p class="text-muted mb-1" id="address-details">California, United States</p>
                                            <p class="text-muted mb-0" id="zip-code"><span>Zip-code:</span> 90201</p>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 mt-sm-0 mt-3">
                                        <img src="{{ asset('assets/images/logo-dark.png') }}" class="card-logo card-logo-dark" alt="logo dark" height="17">
                                        <img src="{{ asset('assets/images/logo-light.png') }}" class="card-logo card-logo-light" alt="logo light" height="17">
                                        <div class="mt-sm-5 mt-4">
                                            <h6 class="text-muted text-uppercase fw-semibold">Address</h6>
                                            <p class="text-muted mb-1" id="address-details">California, United States</p>
                                            <p class="text-muted mb-0" id="zip-code"><span>Zip-code:</span> 90201</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end card-header-->
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Pemesan</p>
                                        <h5 class="fs-14 mb-0"><span id="invoice-no">{{ $reservasi_mobil->user->name }}</span></h5>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                        <h5 class="fs-14 mb-0"><span id="invoice-date">{{ Carbon::parse($reservasi_mobil->created_at)->locale('en')->isoFormat('D MMM, Y') }}</span> <small class="text-muted" id="invoice-time">{{ Carbon::parse($reservasi_mobil->created_at)->isoFormat('h:mmA') }}
                                        </small></h5>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Status</p>
                                        <span class="badge bg-success-subtle text-success fs-11" id="payment-status">{{ $reservasi_mobil->status->status }}</span>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Pemeriksa</p>
                                        <h5 class="fs-14 mb-0"><span id="total-amount">{{ $reservasi_mobil->atasan->name }}</span></h5>
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
                                    <div class="col-5 col-xl-3">
                                        <h6 class="text-uppercase fw-semibold">Asal</h6>
                                        <p class="text-muted mb-1" id="billing-address-line-1">{{ $reservasi_mobil->asal }}</p>
                                    </div>
                                    <!--end col-->
                                    <div class="col-2 col-xl-3 text-center">
                                        <h4 class="text-muted mb-1"><i class="ri-arrow-right-fill"></i></h4>
                                    </div>
                                    <!--end col-->
                                    <div class="col-5 col-xl-3">
                                        <h6 class="text-uppercase fw-semibold">Tujuan</h6>
                                        <p class="text-muted mb-1" id="shipping-address-line-1">{{ $reservasi_mobil->tujuan }}</p>
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
                                                <th scope="col" style="width: 50px;">No</th>
                                                <th scope="col">Nama Penumpang</th>
                                                <th scope="col">NPP</th>
                                                <th scope="col">No. HP</th>
                                            </tr>
                                        </thead>
                                        <tbody id="products-list">
                                            @foreach ($penumpang as $row)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td class="text-start">
                                                        <span class="fw-medium">{{ $row->user->name }}</span>
                                                        <p class="text-muted mb-0">{{ $row->user->nama_jabatan }}</p>
                                                    </td>
                                                    <td>{{ $row->user->npp }}</td>
                                                    <td>+{{ $row->user->nomor_hp }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table><!--end table-->
                                </div>
                                <div class="border-top border-top-dashed mt-2">
                                    <div class="row ms-4 mt-4">
                                        <h6 class="text-muted text-uppercase fw-semibold mb-3">Detail Reservasi :</h6>
                                    </div>
                                    <div class="row ms-4 justify-content-center">
                                        <div class="col-6">
                                            <div class="d-flex mb-4">
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="fs-13">Mobil</h5>
                                                    <p class="text-muted">{{ $reservasi_mobil->mobil->nama }}</p>
                                                    <h5 class="fs-13">Jenis Kendaraan</h5>
                                                    <p class="text-muted">{{ $reservasi_mobil->jenisKendaraan->nama }}</p>
                                                    <h5 class="fs-13">Jenis Plat</h5>
                                                    <p class="text-muted">{{ $reservasi_mobil->mobil->Plat->nomor_plat }}</p>
                                                    <h5 class="fs-13">Supir</h5>
                                                    <p class="text-muted">{{ $reservasi_mobil->supir->nama }}</p>
                                                    <h5 class="fs-13">No Hp Supir</h5>
                                                    <p class="text-muted">{{ $reservasi_mobil->supir->nomor_hp }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex mb-4">
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="fs-13">Keperluan</h5>
                                                    <p class="text-muted">{{ $reservasi_mobil->keperluan }}</p>
                                                    <h5 class="fs-13">Tanggal Pergi</h5>
                                                    <p class="text-muted">{{ Carbon::parse($reservasi_mobil->tgl_pergi)->locale('en')->isoFormat('D MMM, Y') }} - Jam {{ Carbon::parse($reservasi_mobil->wktu_pergi)->isoFormat('H:mm') }} WIB</p>
                                                    <h5 class="fs-13">Tanggal Pulang</h5>
                                                    <p class="text-muted">{{ Carbon::parse($reservasi_mobil->tgl_pulang)->locale('en')->isoFormat('D MMM, Y') }} - Jam {{ Carbon::parse($reservasi_mobil->wktu_plng)->isoFormat('H:mm') }} WIB</p>
                                                    <h5 class="fs-13">PIC</h5>
                                                    <p class="text-muted">{{ $reservasi_mobil->nama }}</p>
                                                    <h5 class="fs-13">No WA PIC</h5>
                                                    <p class="text-muted">{{ $reservasi_mobil->no_tlpn }}</p>
                                                </div>
                                            </div>
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
                                                    <h5 class="fs-13">Requester</h5>
                                                    <p class="text-muted">{{ $reservasi_mobil->komentar }}</p>
                                                    <h5 class="fs-13">Atasan Requester</h5>
                                                    <p class="text-muted">{{ $reservasi_mobil->komentar_atasan }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex mb-4">
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="fs-13">Admin Umum</h5>
                                                    <p class="text-muted">{{ $reservasi_mobil->komentar_umum }}</p>
                                                    <h5 class="fs-13">Driver</h5>
                                                    <p class="text-muted">{{ $reservasi_mobil->komentar_supir }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                    <!-- Varying Modal Content -->
                                    <div class="hstack gap-2 flex-wrap">
                                        @role('Requester')
                                            @if ($reservasi_mobil->id_status == 1 && $reservasi_mobil->id_atasan == Auth::user()->id)
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#proses"><i class="ri-check-double-fill align-bottom me-1"></i> Proses</button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#batal"><i class="ri-close-fill align-bottom me-1"></i> Batal</button>
                                                @include('apps.reservasi-mobil.components.modal-proses')
                                                @include('apps.reservasi-mobil.components.modal-batal')
                                            @endif
                                        @endrole
                                        @role('Admin Umum')
                                            @if ($reservasi_mobil->id_status == 2)
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#proses"><i class="ri-check-double-fill align-bottom me-1"></i> Proses</button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#batal"><i class="ri-close-fill align-bottom me-1"></i> Batal</button>
                                                @include('apps.reservasi-mobil.components.modal-proses')
                                                @include('apps.reservasi-mobil.components.modal-batal')
                                            @endif
                                        @endrole
                                        @role('Admin Driver')
                                            @if ($reservasi_mobil->id_status == 3 || $reservasi_mobil->id_status == 4)
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#proses"><i class="ri-check-double-fill align-bottom me-1"></i> Proses</button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#batal"><i class="ri-close-fill align-bottom me-1"></i> Batal</button>
                                                @include('apps.reservasi-mobil.components.modal-proses')
                                                @include('apps.reservasi-mobil.components.modal-batal')
                                            @endif
                                        @endrole
                                    </div>
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
<!-- rater-js plugin -->
<script src="{{ asset('assets/libs/rater-js/index.js') }}"></script>
<script>
    var starRatinghover = raterJs( {
        starSize:22,
        rating: 1, 
        element:document.querySelector("#rater-onhover"), 
        rateCallback:function rateCallback(rating, done) {
            this.setRating(rating);
            let nilaiRatingBaru = this.getRating();
            let elemenInput = document.querySelector("input[name='rating']");
            elemenInput.value = nilaiRatingBaru; 
            done(); 
        }, 
        onHover:function(currentIndex, currentRating) {
            document.querySelector('.ratingnum').textContent = currentIndex; 
        }, 
        onLeave:function(currentIndex, currentRating) {
            document.querySelector('.ratingnum').textContent = currentRating; 
        }
    });
</script>
@endpush