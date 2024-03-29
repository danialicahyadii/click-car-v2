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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $title ? $title : '' }}</a></li>
                            <li class="breadcrumb-item active">Show Inspeksi</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="card mt-n4 mx-n4 mb-n5">
                    <div class="bg-warning-subtle">
                        <div class="card-body pb-4 mb-5">
                            <div class="row">
                                <div class="col-md">
                                    <div class="row align-items-center">
                                        <div class="col-md-auto">
                                            <div class="avatar-md mb-md-0 mb-4">
                                                <div class="avatar-title bg-white rounded-circle">
                                                    <img src="{{ asset('assets/img/icon-car.png') }}" alt="" class="avatar-sm" />
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md">
                                            <h4 class="fw-semibold" id="ticket-title">{{ $mobil->nama }}</h4>
                                            <div class="hstack gap-3 flex-wrap">
                                                <div class="text-muted"><i class="ri-building-line align-bottom me-1"></i><span id="ticket-client">{{ $mobil->entitas->nama }}</span></div>
                                                <div class="vr"></div>
                                                <div class="text-muted">Terakhir Service : <span class="fw-medium " id="create-date">{{ Carbon::parse($mobil->terakhir_service)->isoFormat('D MMM, YYYY') }}</span></div>
                                                <div class="vr"></div>
                                                <div class="text-muted">Inspeksi Selanjutnya : <span class="fw-medium" id="due-date">{{ Carbon::parse($mobil->tgl_inspeksi_selanjutnya)->isoFormat('D MMM, YYYY') }}</span></div>
                                                <div class="vr"></div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div><!-- end card body -->
                    </div>
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row --> --}}

        <div class="row justify-content-center">
            <div class="col-xxl-5 col-xl-5">
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
                                        <td class="fw-medium">KM Saat Ini</td>
                                        <td>: {{ $mobil->km_kendaraan }}</td>
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
            <div class="col-xxl-5 col-xl-5">
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
                                        <td class="fw-medium">Jenis Kelamin</td>
                                        <td>: {{ $supir->jk }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Jenis SIM</td>
                                        <td>: @if ($supir->jenis_sim == 2) Umum @else Perorangan @endif</td>
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
                                    @foreach ($detailInspeksi['General'] as $row)
                                        <tr>
                                            <td style="width: 30%;">{{ $row->ItemInspeksi->item }}</td>
                                            <td class="text-center">
                                                <div class="form-check form-check-inline form-radio-success">
                                                    <input class="form-check-input" type="radio" name="data{{ $row->id }}" value="baik" {{ $row->value == 'baik' ? 'checked' : '' }} disabled required>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check form-check-inline form-radio-danger">
                                                    <input class="form-check-input" type="radio" name="data{{ $row->id }}" value="cacat" {{ $row->value == 'cacat' ? 'checked' : '' }} disabled required>
                                                </div>
                                            </td>
                                            <td colspan="2">
                                                {{ $row->ket }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="text-center" colspan="5" style="background-color: #f0f0f0;">Perlengkapan Safety</td>
                                    </tr>
                                    @foreach ($detailInspeksi['Perlengkapan Safety'] as $row)
                                        <tr>
                                            <td style="width: 30%;">{{ $row->ItemInspeksi->item }}</td>
                                            <td class="text-center">
                                                <div class="form-check form-check-inline form-radio-success">
                                                    <input class="form-check-input" type="radio" name="data{{ $row->id }}" value="baik" {{ $row->value == 'baik' ? 'checked' : '' }} disabled required>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check form-check-inline form-radio-danger">
                                                    <input class="form-check-input" type="radio" name="data{{ $row->id }}" value="cacat" {{ $row->value == 'cacat' ? 'checked' : '' }} disabled required>
                                                </div>
                                            </td>
                                            <td colspan="2">
                                                {{ $row->ket }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="text-center" colspan="3">Kesimpulan</td>
                                        <td class="text-center">
                                            <input type="radio" class="btn-check" name="kesimpulan" id="success-outlined" autocomplete="off" {{ $checklist_kendaraan->kesimpulan == 'laik' ? 'checked' : '' }} value="laik" disabled>
                                            <label class="btn btn-outline-success" for="success-outlined">Laik</label>
                
                                            <input type="radio" class="btn-check" name="kesimpulan" id="danger-outlined" autocomplete="off" {{ $checklist_kendaraan->kesimpulan == 'tidak_laik' ? 'checked' : '' }} value="tidak_laik" disabled>
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
            <button type="button" onclick="window.location.href = '{{ url('checklist-kendaraan') }}'" class="btn btn-warning btn-label waves-effect waves-light"><i class="ri-arrow-go-back-fill label-icon align-middle fs-16 me-2"></i> Kembali</button>
            @role('Admin Umum')
                @if ($checklist_kendaraan->id_status == 1)
                    <button type="button" class="btn btn-primary btn-label waves-effect waves-light" id="btnSimpan" data-id={{ $checklist_kendaraan->id }}><i class="ri-check-double-fill label-icon align-middle fs-16 me-2"></i> Approve</button>
                @endif
            @endrole
            @if ($checklist_kendaraan->id_status == 2)
                <button type="button" onclick="window.open('{{ url('checklist-kendaraan/print', Crypt::encrypt($checklist_kendaraan->id)) }}', '_blank')" class="btn btn-info btn-label waves-effect waves-light"><i class="ri-printer-fill label-icon align-middle fs-16 me-2"></i> Cetak</button>
                <button type="button" onclick="window.open('{{ url('checklist-kendaraan/download', Crypt::encrypt($checklist_kendaraan->id)) }}', '_blank')" class="btn btn-success btn-label waves-effect waves-light"><i class="ri-download-fill label-icon align-middle fs-16 me-2"></i> Download</button>
            @endif
        </div>

    </div><!-- container-fluid -->
</div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Function to confirm before saving using SweetAlert
    function confirmBeforeSave(event) {
            event.preventDefault();

            // Show confirmation dialog with SweetAlert
            Swal.fire({
                icon: "question",
                title: "Apa data sudah benar ?",
                text: "Jika sudah di approve, form tidak bisa dikembalikan ke driver!",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Approve",
                denyButtonText: `Return`
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    let id = $('#btnSimpan').data('id');
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');
                    let headers = {
                        'X-CSRF-Token': csrfToken
                    };
                    $.ajax({
                        url: "/checklist-kendaraan/approve/" + id,
                        method: "POST",
                        headers: headers,
                        success: function(response) {
                            console.log(response);
                            let timerInterval;
                            Swal.fire({
                            icon: "success",
                            title: "Approved",
                            html: "Tunggu beberapa saat ....",
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: () => {
                                const timer = Swal.getPopup().querySelector("b");
                                timerInterval = setInterval(() => {
                                timer.textContent = `${Swal.getTimerLeft()}`;
                                }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            }
                            }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log("I was closed by the timer");
                            }
                            window.location.reload();
                            });

                        },
                        error: function(xhr, status, error) {
                            Swal.fire("Error!", "Gagal melakukan approve.", "error");
                        }
                    });
                } else if (result.isDenied) {
                    let id = $('#btnSimpan').data('id');
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');
                    let headers = {
                        'X-CSRF-Token': csrfToken
                    };
                    $.ajax({
                        url: "/checklist-kendaraan/return/" + id,
                        method: "POST",
                        headers: headers,
                        success: function(response) {
                            console.log(response);
                            let timerInterval;
                            Swal.fire({
                            icon: "info",
                            title: "Return",
                            html: "Tunggu beberapa saat ....",
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: () => {
                                const timer = Swal.getPopup().querySelector("b");
                                timerInterval = setInterval(() => {
                                timer.textContent = `${Swal.getTimerLeft()}`;
                                }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            }
                            }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log("I was closed by the timer");
                            }
                            window.location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire("Error!", "Gagal melakukan return.", "error");
                        }
                    });
                }
            });
        }

        // Add event listener to the Save button
        document.getElementById('btnSimpan').addEventListener('click', confirmBeforeSave);

</script>
@endpush