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
                            <li class="breadcrumb-item"><a href="{{ url('checklist-kendaraan') }}">{{ $title ? $title : '' }}</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <form action="{{ url('checklist-kendaraan/store') }}" method="POST" id="checklistForm">
            @csrf
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-xl-5">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0 fs-14">Detail Informasi Kendaraan</h6>
                        </div>
                        <div class="card-body mb-2">
                            <div class="table-responsive table-card">
                                <table class="table table-borderless align-middle mb-0 table-sm">
                                    <tbody>
                                        <tr>
                                            <td class="fw-medium" style="width: 40%;">No Polisi</td>
                                            <td>: {{ $mobil->nomor_polisi }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Tgl Habis STNK</td>
                                            <td>: {{ $mobil->habis_stnk }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Type Kendaraan</td>
                                            <td>: {{ $mobil->jenis_kendaraan->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Tahun Kendaraan</td>
                                            <td>: {{ $mobil->tahun_pembuatan }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Load Maksimum</td>
                                            <td>: {{ $mobil->load_maksimum }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">KM Kendaraan</td>
                                            <td><input class="form-control form-control-sm" type="number" name="km_saat_inspeksi" placeholder="KM Saat Inspeksi (Km)" min="1" required autofocus></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Tgl Inspeksi</td>
                                            <td><input class="form-control form-control-sm tgl-inspeksi" data-row={{ $mobil->tgl_inspeksi_selanjutnya }} name="tgl_inspeksi" required></td>
                                        </tr>
                                        <tr id="alasan" class="d-none">
                                            <td class="fw-medium">Alasan Telat</td>
                                            <td colspan="2"><textarea class="form-control form-control-sm" name="alasan_telat" placeholder="Contoh: Hari Senin saya Cuti" required></textarea></td>
                                          </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
                <div class="col-xxl-4 col-xl-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0 fs-14">Detail Informasi PIC</h5>
                        </div>
                        <div class="card-body mb-2">
                            <div class="table-responsive table-card">
                                <table class="table table-borderless align-middle mb-0 table-sm">
                                    <tbody>
                                        <tr>
                                            <td class="fw-medium" style="width: 40%;">Nama</td>
                                            <td>: {{ $supir->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">No HP</td>
                                            <td>: {{ $supir->nomor_hp }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Tanggal Lahir</td>
                                            <td>: {{ $supir->ttl }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Alamat</td>
                                            <td>: {{ $supir->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Tgl Habis SIM</td>
                                            <td>: {{ $supir->habis_sim }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Jenis SIM</td>
                                            <td>: @if ($supir->jenis_sim == 2) Umum @else Perorangan @endif</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">No HP Darurat</td>
                                            <td><input class="form-control form-control-sm" type="number" name="nomor_hp_darurat" placeholder="Optional" min="0"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Form Inspeksi Kendaraan</h4>
                            <div class="flex-shrink-0">
                                {{-- <span class="badge badge-label bg-dark"><i class="mdi mdi-circle-medium"></i> {{ $mobil->nama }}</span> --}}
                                {{-- <span class="badge bg-primary">{{ $mobil->nama }}</span class="badge bg-primary"> --}}
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-bordered table-nowrap align-middle mb-0" id="tabel-monitoring">
                                    <thead>
                                        <tr class="text-center">
                                            <th  rowspan="2" style="text-align: center; vertical-align: middle;">Item</th>
                                            <th  colspan="2" style="text-align: center; vertical-align: middle;">Kondisi</th>
                                            <th  colspan="2" rowspan="2" style="text-align: center; vertical-align: middle;">Keterangan</th>
                                        </tr>
                                        <tr class="text-center">
                                            <th>Baik</th>
                                            <th>Cacat</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td class="text-center" colspan="5" style="background-color: #f0f0f0;">General</td>
                                        </tr>
                                        @foreach ($item_inspeksi->where('tipe_inspeksi', 'General')->where('jenis_kendaraan', 1) as $row)
                                            <tr>
                                                <td style="width: 30%;">{{ $row->item }}</td>
                                                <td class="text-center">
                                                    <div class="form-check form-check-inline form-radio-success">
                                                        <input class="form-check-input" type="radio" name="{{ $row->name }}" value="baik" required>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-check-inline form-radio-danger">
                                                        <input class="form-check-input" type="radio" name="{{ $row->name }}" value="cacat" required>
                                                    </div>
                                                </td>
                                                <td colspan="2">
                                                    <textarea class="form-control d-none keterangan-textarea" name="keterangan_{{ $row->name }}" placeholder="Keterangan"></textarea>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-center" colspan="5" style="background-color: #f0f0f0;">Perlengkapan Safety</td>
                                        </tr>
                                        @foreach ($item_inspeksi->where('tipe_inspeksi', 'Perlengkapan Safety')->where('jenis_kendaraan', 1) as $row)
                                            <tr>
                                                <td style="width: 30%;">{{ $row->item }}</td>
                                                <td class="text-center">
                                                    <div class="form-check form-check-inline form-radio-success">
                                                        <input class="form-check-input" type="radio" name="{{ $row->name }}" value="baik" required>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-check-inline form-radio-danger">
                                                        <input class="form-check-input" type="radio" name="{{ $row->name }}" value="cacat" required>
                                                    </div>
                                                </td>
                                                <td colspan="2">
                                                    <textarea class="form-control d-none keterangan-textarea" name="keterangan_{{ $row->name }}" placeholder="Keterangan"></textarea>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-center" colspan="3">Kesimpulan</td>
                                            <td class="text-center">
                                                <input type="radio" class="btn-check" name="kesimpulan" id="success-outlined" autocomplete="off" value="laik">
                                                <label class="btn btn-outline-success" for="success-outlined">Laik</label>
                    
                                                <input type="radio" class="btn-check" name="kesimpulan" id="danger-outlined" autocomplete="off" value="tidak_laik">
                                                <label class="btn btn-outline-danger" for="danger-outlined">Tidak Laik</label>
                                            </td>
                                        </tr>
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <div class="form-group mb-4">
                <input type="text" name="id_supir" value="{{ $supir->id }}" hidden>
                <input type="text" name="id_mobil" value="{{ $mobil->id }}" hidden>
                <a href="{{ url('checklist-kendaraan') }}" class="btn btn-warning"><span class="fe fe-arrow-left"></span> Kembali</a>
                <button id="btnSimpan" class="btn btn-primary" disabled><span class="fe fe-save"></span> Simpan</button>
            </div>
        </form>
    </div>
    <!-- container-fluid -->
</div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(){
        flatpickr(".tgl-inspeksi", {
                minDate: "today",
                maxDate: "today",
                altInput: true,
                altFormat: "F j, Y",
            });
        $('input[type="radio"]').change(function() {
            var name = $(this).attr('name');
            var textarea = $('textarea[name="keterangan_' + name + '"]');
            
            if ($(this).val() == 'cacat') {
                textarea.removeClass('d-none');
            } else {
                textarea.addClass('d-none');
            }
        });
        let data = $('.tgl-inspeksi').data('row');
        $('.tgl-inspeksi').change(function(){
            let value = $(this).val();
            if(value > data){
                $('#alasan').removeClass('d-none');
            }else{
                $('#alasan').addClass('d-none');
            }
        })
    });
</script>
<script>
    // Function to confirm before saving using SweetAlert
    function confirmBeforeSave(event) {
        event.preventDefault();

        // Show confirmation dialog with SweetAlert
        Swal.fire({
            title: 'Apakah Anda yakin checklist sudah sesuai?',
            text: 'Pastikan semua terisi!',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value == true) {
                document.getElementById('checklistForm').submit();
            }
        });
    }

    // Add event listener to the Save button
    document.getElementById('btnSimpan').addEventListener('click', confirmBeforeSave);

    // Function to enable or disable the Save button based on form validity
    function toggleSaveButton() {
        var isValid = document.getElementById('checklistForm').checkValidity();
        document.getElementById('btnSimpan').disabled = !isValid;
    }

    // Add event listener to form inputs for validation
    var formInputs = document.querySelectorAll('#checklistForm input, #checklistForm select');
    formInputs.forEach(function(input) {
        input.addEventListener('input', toggleSaveButton);
    });
</script>
@endpush