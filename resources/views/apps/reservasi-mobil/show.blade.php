@extends('layouts.app')
@section('css')
<script type='text/javascript' src='{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css" />
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
                            <li class="breadcrumb-item active">Show</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        @hasanyrole('Admin Driver|Driver')
        @if(Carbon::now() >= Carbon::parse($reservasi_mobil->waktu_keberangkatan) &&
        $reservasi_mobil->id_supir == Auth::user()->supir->id &&
        ($reservasi_mobil->id_status == 13 || $reservasi_mobil->id_status == 14))
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
                                @if ($reservasi_mobil->id_status == 14 && Carbon::now() >= Carbon::parse($reservasi_mobil->date_expired))
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
                <div class="card ribbon-box border right" id="demo">
                    @if ($reservasi_mobil->id_status == 5)
                    <div class="ribbon-two ribbon-two-success"><span>Selesai</span></div>
                    @endif
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
                                        @if ($reservasi_mobil->id_pengantaran == 1)
                                        <span class="badge bg-warning">Didrop</span>
                                        @elseif($reservasi_mobil->id_pengantaran == 2)
                                        <span class="badge bg-warning">Ditunggu</span>
                                        @else
                                        <span class="badge bg-warning">Voucher</span>
                                        @endif
                                        @if ($reservasi_mobil->id_status == 1 || $reservasi_mobil->id_status == 14)
                                        <span class="badge bg-info">{{ $reservasi_mobil->status->status }}</span>
                                        @elseif ($reservasi_mobil->id_status == 2)
                                        <span class="badge bg-primary">{{ $reservasi_mobil->status->status }}</span>
                                        @elseif ($reservasi_mobil->id_status == 3 || $reservasi_mobil->id_status == 13)
                                        <span class="badge bg-warning">{{ $reservasi_mobil->status->status }}</span>
                                        @elseif ($reservasi_mobil->id_status == 4 || $reservasi_mobil->id_status == 5)
                                        <span class="badge bg-success">{{ $reservasi_mobil->status->status }}</span>
                                        @elseif ($reservasi_mobil->id_status == 6 || $reservasi_mobil->id_status == 7 || $reservasi_mobil->id_status == 12)
                                        <span class="badge bg-danger">{{ $reservasi_mobil->status->status }}</span>
                                        @endif
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
                        @role('Requester|Admin Umum')
                            @if ($reservasi_mobil->id_status == 5 && $reservasi_mobil->id_pengantaran != 3)
                                <div class="col-lg-12">
                                    <form action="{{ url('reservasi-mobil/rating', $reservasi_mobil->id) }}" method="post">
                                        @csrf
                                        <div class="card-body p-4 border-top border-top-dashed">
                                            <div class="row g-3 align-items-center justify-content-center">
                                                <div class="text-center">
                                                    <h6 class="text-uppercase fw-semibold">Kasih rating ke driver?</h6>
                                                    <h6 class="text-uppercase fw-semibold">(1 mengecewakan, 5 mantap!)</h6>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                            <div class="row g-3 align-items-center justify-content-center">
                                                <div class="text-center mb-3">
                                                    <div id="basic-rater" dir="ltr"></div>
                                                    <input type="text" name="rating_driver" @if (!empty($reservasi_mobil->rating_driver))
                                                    value="{{ $reservasi_mobil->rating_driver }}"
                                                @endif hidden>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <div class="row g-3 align-items-center justify-content-center">
                                                <div class="col-8 text-center d-none" id="review">
                                                    <label>Review</label>
                                                    <textarea class="form-control" id="message-text" name="review_driver" rows="4"></textarea>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                            <div class="row g-3 align-items-center justify-content-center mt-2">
                                                <div class="col-8 text-center d-none" id="button-rating">
                                                    <button type="submit" class="btn btn-success btn-sm">Selesai</button>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </div>
                                        <!--end card-body-->
                                    </form>
                                </div><!--end col-->
                            @endif
                            @if (!empty($reservasi_mobil->id_mobil) && $reservasi_mobil->id_pengantaran != 3)
                                <div class="col-lg-12">
                                    <div class="card-body p-4 border-top border-top-dashed">
                                        <div class="row g-3 align-items-center justify-content-center">
                                            <div class="col-lg-6 col-12">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <img src="@if (!empty($reservasi_mobil->supir->user->photo_profile)) {{ URL::asset('profile-images/' . $reservasi_mobil->supir->user->photo_profile) }} @else {{ URL::asset('assets/img/icon-user.png') }}
                                                        @endif" alt="" class="avatar-sm rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <h6 class="mb-1"><a href="pages-profile.html">{{ $reservasi_mobil->supir->nama }}</a></h6>
                                                        <p class="text-muted mb-0">{{ $reservasi_mobil->mobil->nama }}</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <a href="https://wa.me/{{ $reservasi_mobil->supir->nomor_hp }}" target="_blank" style="font-size: 30px;" class=""><span class="ri-whatsapp-fill text-success"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end card-body-->
                                </div><!--end col-->
                            @endif
                        @endrole
                        @if ($reservasi_mobil->id_pengantaran == 3 && $reservasi_mobil->id_status == 5)
                            <div class="col-lg-12">
                                <div class="card-body p-4 border-top border-top-dashed text-center">
                                    <div class="row">
                                        <h6 class="text-muted text-uppercase fw-semibold mb-3">Kode Voucher :</h6>
                                    </div>
                                    <div class="row">
                                        @foreach ($voucher as $row)
                                        <h4><span class="badge text-bg-success">{{ $row->nama_voucher }}</span></h4>
                                        @endforeach
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end card-body-->
                            </div><!--end col-->
                        @endif
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
                                        <h6 class="text-muted text-uppercase fw-semibold mb-3">Catatan :</h6>
                                    </div>
                                    <div class="row ms-4 justify-content-center">
                                        <div class="col-6">
                                            <div class="d-flex mb-4">
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="fs-13">Requester</h5>
                                                    <p class="text-muted">{{ $reservasi_mobil->komentar ?? '-' }}</p>
                                                    <h5 class="fs-13">Atasan Requester</h5>
                                                    <p class="text-muted">{{ $reservasi_mobil->komentar_atasan ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex mb-4">
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="fs-13">Admin Umum</h5>
                                                    <p class="text-muted">{{ $reservasi_mobil->komentar_umum ?? '-' }}</p>
                                                    <h5 class="fs-13">Driver</h5>
                                                    <p class="text-muted">{{ $reservasi_mobil->komentar_supir ?? '-' }}</p>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{ asset('assets/libs/rater-js/index.js') }}"></script>
<script> 
    var starRatinghover = raterJs( {
        starSize:22,
        rating: 0, 
        element:document.querySelector("#rater-onhover"), 
        rateCallback:function rateCallback(rating, done) {
            this.setRating(rating);
            let nilaiRatingBaru = this.getRating();
            let elemenInput = document.querySelector("input[name='rating_penumpang']");
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
<script>
    let valueExisting = document.querySelector("input[name='rating_driver']")
    let isi = valueExisting.value;
    var basicRating = raterJs( {
        starSize:30, 
        rating: isi, 
        element:document.querySelector("#basic-rater"), 
        rateCallback:function rateCallback(rating, done) {
            this.setRating(rating);
            document.getElementById("review").classList.remove("d-none");
            document.getElementById("button-rating").classList.remove("d-none");
            let nilaiRating = this.getRating();
            let elemenInputRating = document.querySelector("input[name='rating_driver']");
            elemenInputRating.value = nilaiRating;
            done(); 
        }
    });
</script>
<script>
    $(document).ready(function() {
        flatpickr('.waktu-penyelesaian', {
            minDate: "today",
            enableTime: true,
        });
        $('.id-status').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Select'
        });
        $("#id_status").on('change', function() {
                let id_status = $('#id_status').val();
                if (id_status == 3){
                    $("#id_pengantaran").removeClass("d-none");
                    $('.id-pengantaran').select2({
                        minimumResultsForSearch: Infinity,
                        placeholder: 'Select'
                    });
                }else {
                    $("#id_pengantaran").addClass("d-none");
                }
            });
        $('.jenis-kendaraan, #mobil, #supir').select2({
            minimumResultsForSearch: Infinity,
        });
        $('#id_jenis_kendaraan').change(function() {
            $('#mobil').html('<option selected disabled value="">Silahkan Pilih Mobil</option>');
            let carOption = this.value;
            let tgl_pergi = $('#tgl_pergi').val();
            let tgl_pulang = $('#tgl_pulang').val();
            let time_start = $('#wktu_pergi').val();
            let time_end = $('#wktu_plng').val();
            let token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: "/reservasi-mobil/get-available-car",
                method: "GET",
                data: {
                    "tgl_pergi": tgl_pergi,
                    "tgl_pulang": tgl_pulang,
                    "time_start": time_start,
                    "time_end": time_end,
                    "carOption": carOption,
                    "_token": token
                },
                success: function(response) {
                    if (response.status === "success") {
                        function formatState (data) {
                            if (!data.element) {
                                return data.text;
                            }
                            var $element = $(data.element);
                            var $status = $element.data('status');
                            if ($status === 'Silahkan Pilih Mobil') {
                                return data.text; // Tampilkan teks tanpa badge
                            }
                            var badgeClass = $status === 'Available' ? 'bg-success' : 'bg-danger';
                            var $badge = $('<span class="badge ' + badgeClass + ' ms-2"></span>').text($status);

                            var $newOption = $('<div></div>').append(data.text).append($badge);
                            return $newOption;
                        };

                        $("#mobil").select2({
                        templateResult: formatState
                        });
                        $.each(response.data, function(key, value) {
                            $('#mobil').append('<option value="'+ value.id +'" data-status="' + value.status + '" data-plat="' + value.id_plat + '">' + value.nama + '</span></option>')
                        });
                        $('#mobil').trigger('change');
                        $('#mobil').on('change', function() {
                        var selectedOption = $(this).find(':selected');
                        var status = selectedOption.data('status');
                        var id_plat = selectedOption.data('plat');
                        var d = new Date();
                        var day = d.getDate();
                        if (status === 'Not Available') {
                            $('#warning-message-car').show();
                            // $(this).val(
                            //     ''
                            //     ); // Menghapus pemilihan mobil yang tidak tersedia
                        } else {
                            $('#warning-message-car').hide();
                        }
                        console.log(response.statusDate);

                        //Notif Gage Sudirman
                        if (response.statusDate == "Hari ini genap" && id_plat == 1) {
                            Swal.fire({
                                title: 'Warning',
                                text: 'Tanggal Pergi genap dan mobil yang dipilih ganjil',
                                icon: 'warning',
                                confirmButtonText: 'Ok'
                            });
                        } else if (response.statusDate == 'Hari ini ganjil' && id_plat == 2) {
                            Swal.fire({
                                title: 'Warning',
                                text: 'Tanggal Pergi ganjil dan mobil yang dipilih genap',
                                icon: 'warning',
                                confirmButtonText: 'Ok'
                            });
                        }
                    });
                    } else {
                        console.error("Error: " + response.message);
                    }
                },
                error: function(error) {
                    console.error("AJAX Error:", error);
                }
            });
        });
        $('#mobil').change(function() {
            $('#supir').html('<option selected disabled value="">Silahkan Pilih Supir</option>');
            let carOption = this.value;
            let tgl_pergi = $('#tgl_pergi').val();
            let tgl_pulang = $('#tgl_pulang').val();
            let time_start = $('#wktu_pergi').val();
            let time_end = $('#wktu_plng').val();
            let token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: "/reservasi-mobil/get-available-drivers",
                method: "GET",
                data: {
                    "tgl_pergi": tgl_pergi,
                    "tgl_pulang": tgl_pulang,
                    "time_start": time_start,
                    "time_end": time_end,
                    "carOption": carOption,
                    "_token": token
                },
                success: function(response) {
                    if (response.status === "success") {
                        function formatState (data) {
                            if (!data.element) {
                                return data.text;
                            }
                            var $element = $(data.element);
                            var $status = $element.data('status');
                            if ($status === 'Silahkan Pilih Supir') {
                                return data.text; // Tampilkan teks tanpa badge
                            }
                            var badgeClass = $status === 'Available' ? 'bg-success' : 'bg-danger';
                            var $badge = $('<span class="badge ' + badgeClass + ' ms-2"></span>').text($status);

                            var $newOption = $('<div></div>').append(data.text).append($badge);
                            return $newOption;
                        };

                        $("#supir").select2({
                        templateResult: formatState
                        });
                        $.each(response.data, function(key, value) {
                            $('#supir').append('<option value="' + value.id +'" data-status="' + value.status + '">' + value.nama + '</span></option>');
                        });

                        $('#supir').trigger('change');

                        $('#supir').on('change', function() {
                            var selectedOption = $(this).find(':selected');
                            var status = selectedOption.data('status');

                            if (status === 'Not Available') {
                                $('#warning-message-driver').show();
                                //  // Menghapus pemilihan mobil yang tidak tersedia
                            } else {
                                $('#warning-message-driver').hide();
                            }
                        });
                    } else {
                        // Handle any error or unexpected response
                        console.error("Error: " + response.message);
                    }
                },
                error: function(error) {
                    // Handle the AJAX error here
                    console.error("AJAX Error:", error);
                }
            });
        });
        $(".add-voucher").click(function(){
            // Dapatkan element parent dari tombol yang diklik (div dengan kelas "row")
            var parentDiv = $(this).closest('.row');

            // Buat elemen input baru
            var newInput = $('<div class="row align-items-center mb-2">' +
                                '<div class="col-8 mt-2">' +
                                    '<input type="text" class="form-control" name="nama_voucher[]" placeholder="Masukkan Voucher">' +
                                '</div>' +
                                '<div class="col-2">' +
                                    '<a href="javascript:void(0);" class="btn btn-danger btn-icon waves-effect waves-light remove-voucher" style="margin-top: 9px;"><i class="ri-close-line"></i></a>' +
                                '</div>' +
                            '</div>');

            // Sisipkan elemen input baru setelah element parent
            parentDiv.after(newInput);
        });

        $(document).on("click", ".remove-voucher", function(){
            $(this).closest('.row').remove();
        });
    });
</script>
@endpush