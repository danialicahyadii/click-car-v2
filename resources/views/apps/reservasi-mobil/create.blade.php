@extends('layouts.app')
@section('css')
    <script type='text/javascript' src='{{ URL::asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}'></script>
    <script type='text/javascript' src='{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}'></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Reservasi Mobil</a></li>
                            <li class="breadcrumb-item active">{{ $title ? $title : '' }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        @if ($errors->any())
            <!-- Warning Alert -->
            <div class="alert alert-warning alert-dismissible bg-warning text-white alert-label-icon fade show" role="alert">
                <i class="ri-alert-line label-icon"></i><strong>Warning</strong> - Harap diisi semua !
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            {{-- <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div> --}}
        @endif
        <form action="{{ url('reservasi-mobil/store') }}" method="POST" id="form-reservasi">
            @csrf
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Buat Reservasi</h4>
                        </div><!-- end card header -->
                        <div class="card-body pb-5">
                            <div class="row gy-4">
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Asal</label>
                                        <input type="text" class="form-control" name="asal" value="{{ old('asal') }}" placeholder="Masukkan Lokasi Penjemputan..." id="origin-input">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Tujuan</label>
                                        <input type="text" class="form-control" name="tujuan" value="{{ old('tujuan') }}" placeholder="Masukkan Lokasi Tujuan..." id="destination-input">
                                    </div>
                                    <div id="map"></div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label">Keperluan</label>
                                        <input type="text" class="form-control" name="keperluan" value="{{ old('keperluan') }}" placeholder="Masukkan Keperluan...">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Penumpang</label>
                                        <select class="form-control" data-choices data-choices-removeItem name="id_penumpang[]" multiple>
                                            <option value="">Pilih Penumpangnya</option>
                                            @foreach ($penumpang as $row)
                                                <option value="{{ $row->id }}" @if(old('id_penumpang') && in_array($row->id, old('id_penumpang'))) selected @endif>{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label class="form-label">Tanggal Pergi</label>
                                        <input type="date" class="form-control flatpickr-input" name="tgl_pergi" value="{{ old('tgl_pergi') }}" id="tgl_pergi">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label class="form-label">Tanggal Pulang</label>
                                        <input type="date" class="form-control flatpickr-input" name="tgl_pulang" value="{{ old('tgl_pulang') }}" id="tgl_pulang">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="readonlyInput" class="form-label">Waktu Pergi</label>
                                        <input type="time" class="form-control" data-provider="timepickr" data-default-time="{{ old('wktu_pergi') }}" name="wktu_pergi" id="wktu_pergi">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="disabledInput" class="form-label">Waktu Pulang</label>
                                        <input type="time" class="form-control" data-provider="timepickr" data-default-time="{{ old('wktu_plng') }}" name="wktu_plng" id="wktu_plng">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="iconInput" class="form-label">Pemeriksa Atasan</label>
                                        <select class="form-control" name="id_atasan" data-choices data-choices-search-false data-choices-sorting-false>
                                            @foreach ($atasan as $row)
                                                <option value="{{ $row->id }}" {{ old('id_atasan') == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="iconrightInput" class="form-label">Pengantaran</label>
                                        <select class="form-control" name="id_pengantaran" id="id_pengantaran" data-choices data-choices-search-false data-choices-sorting-false>
                                            <option value="" disabled selected>Pilih Pengantaran</option>
                                            <option value="1" {{ old('id_pengantaran') == 1 ? 'selected' : '' }}>Didrop</option>
                                            <option value="2" {{ old('id_pengantaran') == 2 ? 'selected' : '' }}>Ditunggu</option>
                                            <option value="3" {{ old('id_pengantaran') == 3 ? 'selected' : '' }}>Transportasi Online(Voucher)</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="exampleInputdate" class="form-label">NPP Kifest</label>
                                        <input type="text" class="form-control" name="pic" value="{{ old('pic') }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="exampleInputtime" class="form-label">Nama Lengkap PIC</label>
                                        <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="exampleInputpassword" class="form-label">No HP PIC/Penumpang (WA Only)</label>
                                        <input type="text" class="form-control" name="no_tlpn" value="{{ old('no_tlpn') }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="exampleFormControlTextarea5" class="form-label">Catatan</label>
                                        <textarea class="form-control" name="komentar" value="{{ old('komentar') }}" rows="3"></textarea>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card d-none" id="request_kendaraan">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Request Kendaraan</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="row gy-4">
                                <div class="col-xxl-4 col-md-4">
                                    <div>
                                        <label for="iconInput" class="form-label">Pilih Jenis Kendaraan</label>
                                        <select class="form-control jenis-kendaraan" name="id_jenis_kendaraan" id="id_jenis_kendaraan">
                                            <option selected disabled>Pilih Jenis Kendaraan</option>
                                            @foreach ($jenis_kendaraan as $row)
                                                <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-4">
                                    <div>
                                        <label for="iconInput" class="form-label">Pilih Mobil</label>
                                        <select class="form-control" name="id_mobil" id="mobil">
                                            <option selected disabled>Pilih Mobil</option>
                                        </select>
                                        <div id="warning-message-car" style="display: none; color: red;">Mobil ini tidak tersedia.</div>   
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-4">
                                    <div>
                                        <label for="iconInput" class="form-label">Pilih Driver</label>
                                        <select class="form-control" name="id_supir" id="supir">
                                            <option selected disabled>Pilih Driver</option>
                                            @foreach ($supir as $row)
                                                <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                            @endforeach
                                        </select>
                                        <div id="warning-message-driver" style="display: none; color: red;">Supir ini tidak tersedia.</div>
                                    </div>
                                </div>
                                
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <div class="form-group mb-4">
                <a href="{{ url('reservasi-mobil') }}" class="btn btn-warning"><i class="ri-arrow-go-back-fill"></i> Kembali</a>
                <button class="btn btn-primary btn-load" id="btnSubmit"><i class="ri-send-plane-fill"></i> Reservasi</button>
            </div>
        </form>
    </div>
    <!-- container-fluid -->
</div>
@endsection
@push('js')
    @include('apps.reservasi-mobil.components.script-search-google-maps')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ URL::asset('assets/js/pages/select2.init.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            let form_reservasi = document.getElementById("form-reservasi");
            let submitButton = document.getElementById("btnSubmit");

                form_reservasi.addEventListener("submit", function(event) {
                    event.preventDefault(); // Prevent the form from submitting immediately

                    submitButton.disabled = true;
                    submitButton.innerHTML = `Loading... <span class="spinner-border flex-shrink-0">
                        <span class="visually-hidden">Loading...</span></span>`;

                    // Set a timeout for 2 seconds (2000 milliseconds)
                    setTimeout(function() {
                    // Your code to execute after the timeout (1 seconds) goes here
                    form_reservasi.submit();
                    }, 1000);
                });
            });
    </script>
    <script>
        $(document).ready(function() {
            flatpickr("#tgl_pergi, #tgl_pulang", {
                minDate: "today",
                maxDate: new Date().fp_incr(14),
                altInput: true,
                altFormat: "F j, Y",
                // defaultDate: "today"
            });
            flatpickr("#wktu_pergi, #wktu_plng", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });
            $('.jenis-kendaraan').select2();
            let nilai_pengantaran = $('#id_pengantaran').val();
            if (nilai_pengantaran && nilai_pengantaran != 3) {
                $("#request_kendaraan").removeClass("d-none");
            } else {
                $("#request_kendaraan").addClass("d-none");
            }
            $("#id_pengantaran").on('change', function() {
                let nilai_pengantaran = $('#id_pengantaran').val();
                if (nilai_pengantaran != 3){
                    $("#request_kendaraan").removeClass("d-none");
                }else {
                    $("#request_kendaraan").addClass("d-none");
                }
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
        });
    </script>
     @if ($errors->any())
     <script>
         Swal.fire({
             icon: 'warning',
            //  title: 'Validation Error',
             html: 'Masih ada yang kosong',
             confirmButtonText: 'Kembali'
         });
     </script>
     @endif
@endpush