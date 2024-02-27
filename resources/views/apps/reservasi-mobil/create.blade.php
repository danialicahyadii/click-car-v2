@extends('layouts.app')
@section('css')
    <script type='text/javascript' src='{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}'></script>
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
        <form action="{{ url('reservasi-mobil/store') }}" method="POST">
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
                                        <input type="text" class="form-control" name="asal" placeholder="Masukkan Lokasi Penjemputan...">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Tujuan</label>
                                        <input type="text" class="form-control" name="tujuan" placeholder="Masukkan Lokasi Tujuan...">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label">Keperluan</label>
                                        <input type="text" class="form-control" name="keperluan" placeholder="Masukkan Keperluan...">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="placeholderInput" class="form-label">Pilih Nama Penumpang</label>
                                        <select class="form-control" data-choices data-choices-removeItem name="jml_penumpang" value="1" maxlength="10" multiple>
                                            @foreach ($penumpang as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach  
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="valueInput" class="form-label">Tanggal Pergi</label>
                                        <input type="text" class="form-control flatpickr-input" data-provider="flatpickr"  data-altFormat="F j, Y" name="tgl_pergi" id="tgl_pergi">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="readonlyPlaintext" class="form-label">Tanggal Pulang</label>
                                        <input type="text" class="form-control flatpickr-input" data-provider="flatpickr"  data-altFormat="F j, Y" name="tgl_pulang" id="tgl_pulang">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="readonlyInput" class="form-label">Waktu Pergi</label>
                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="00:00" name="wktu_pergi" id="wktu_pergi">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="disabledInput" class="form-label">Waktu Pulang</label>
                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="00:00" name="wktu_plng" id="wktu_plng">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="iconInput" class="form-label">Pemeriksa Atasan</label>
                                        <select class="form-control" name="id_atasan" data-choices data-choices-search-false data-choices-sorting-false>
                                            {{-- <option selected disabled>Pilih Pemeriksa</option> --}}
                                            @foreach ($atasan as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="iconrightInput" class="form-label">Pengantaran</label>
                                        <select class="form-control" id="id_pengantaran" name="id_pengantaran" data-choices data-choices-search-false data-choices-sorting-false>
                                            <option value="" disabled selected>Pilih Pengantaran</option>
                                            <option value="1">Didrop</option>
                                            <option value="2">Ditunggu</option>
                                            <option value="3">Transportasi Online</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="exampleInputdate" class="form-label">NPP Kifest</label>
                                        <input type="text" class="form-control" name="pic">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="exampleInputtime" class="form-label">Nama Lengkap PIC</label>
                                        <input type="text" class="form-control" name="nama">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="exampleInputpassword" class="form-label">No HP PIC/Penumpang (WA Only)</label>
                                        <input type="text" class="form-control" name="no_tlpn">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="exampleFormControlTextarea5" class="form-label">Catatan</label>
                                        <textarea class="form-control" name="komentar" rows="3"></textarea>
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
                                        <select class="form-control" data-choices data-choices-search-false data-choices-sorting-false name="id_jenis_kendaraan" id="id_jenis_kendaraan">
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
                                        <select class="form-control select2" data-choices data-choices-search-false data-choices-sorting-false name="id_mobil" id="mobil">
                                            <option selected disabled>Pilih Mobil</option>
                                        </select>   
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-md-4">
                                    <div>
                                        <label for="iconInput" class="form-label">Pilih Driver</label>
                                        <select class="form-control" data-choices data-choices-search-false data-choices-sorting-false name="id_supir" id="supir">
                                            <option selected disabled>Pilih Driver</option>
                                            @foreach ($supir as $row)
                                                <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                            @endforeach
                                        </select>   
                                    </div>
                                </div>
                                
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <div class="form-group mb-4">
                <a href="{{ url()->previous() }}" class="btn btn-warning"><i class="ri-arrow-go-back-fill"></i> Kembali</a>
                <button type="submit" class="btn btn-primary ms-2"><i class="ri-send-plane-fill"></i> Reservasi</button>
            </div>
        </form>
    </div>
    <!-- container-fluid -->
</div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#reservasi_hari_iniTable, #konfirmasi_reservasiTable, #riwayatTable, #lihat_semuaTable, #sedang_diprosesTable, #perlu_diprosesTable, #reservasi_selesaiTable, #reservasi_ditolakTable, #ratingTable').DataTable({
                pageLength: 10
            });

            $("#id_pengantaran").on('change', function() {
                var nilai_pengantaran = $('#id_pengantaran').val();
                if (nilai_pengantaran != 3){
                    $("#request_kendaraan").removeClass("d-none");
                }else {
                    $("#request_kendaraan").addClass("d-none");
                }
            });

            $('#id_jenis_kendaraan').change(function() {
                // Reset the "Pilih Mobil" dropdown options
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
                            $('#mobil').empty();
                            $.each(response.availableCars, function(index, car) {
                                $('#mobil').append('<option value="' + car.id + '">' + car.nama_mobil + '</option>');
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

        });
    </script>
@endpush