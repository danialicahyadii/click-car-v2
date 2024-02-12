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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Reservasi Mobil</a></li>
                            <li class="breadcrumb-item active">{{ $title ? $title : '' }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Tabel Reservasi</h4>
                        @if (in_array(Auth::user()->level_jabatan,[4,5,6]))
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <a href="{{ url('reservasi-mobil/create') }}" class="btn btn-info">+ Buat Reservasi</a>
                                </div>
                            </div>
                        @endif
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="row gy-4">
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="basiInput" class="form-label">Penjemputan</label>
                                    <input type="text" class="form-control" id="basiInput" placeholder="Masukkan Lokasi Penjemputan...">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="basiInput" class="form-label">Tujuan</label>
                                    <input type="text" class="form-control" id="basiInput" placeholder="Masukkan Lokasi Tujuan...">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="labelInput" class="form-label">Keperluan</label>
                                    <input type="text" class="form-control" id="labelInput" placeholder="Masukkan Keperluan...">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="placeholderInput" class="form-label">Input with Placeholder</label>
                                    <select class="form-select mb-3" aria-label="Default select example" data-choices>
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="valueInput" class="form-label">Input with Value</label>
                                    <input type="text" class="form-control" id="valueInput" value="Input value">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="readonlyPlaintext" class="form-label">Readonly Plain Text Input</label>
                                    <input type="text" class="form-control-plaintext" id="readonlyPlaintext" value="Readonly input" readonly="">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="readonlyInput" class="form-label">Readonly Input</label>
                                    <input type="text" class="form-control" id="readonlyInput" value="Readonly input" readonly="">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="disabledInput" class="form-label">Disabled Input</label>
                                    <input type="text" class="form-control" id="disabledInput" value="Disabled input" disabled="">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="iconInput" class="form-label">Input with Icon</label>
                                    <div class="form-icon">
                                        <input type="email" class="form-control form-control-icon" id="iconInput" placeholder="example@gmail.com">
                                        <i class="ri-mail-unread-line"></i>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="iconrightInput" class="form-label">Input with Icon Right</label>
                                    <div class="form-icon right">
                                        <input type="email" class="form-control form-control-icon" id="iconrightInput" placeholder="example@gmail.com">
                                        <i class="ri-mail-unread-line"></i>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="exampleInputdate" class="form-label">Input Date</label>
                                    <input type="date" class="form-control" id="exampleInputdate">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="exampleInputtime" class="form-label">Input Time</label>
                                    <input type="time" class="form-control" id="exampleInputtime">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="exampleInputpassword" class="form-label">Input Password</label>
                                    <input type="password" class="form-control" id="exampleInputpassword" value="44512465">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="exampleFormControlTextarea5" class="form-label">Example Textarea</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea5" rows="3"></textarea>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="formtextInput" class="form-label">Form Text</label>
                                    <input type="password" class="form-control" id="formtextInput">
                                    <div id="passwordHelpBlock" class="form-text">
                                        Must be 8-20 characters long.
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="colorPicker" class="form-label">Color Picker</label>
                                    <input type="color" class="form-control form-control-color w-100" id="colorPicker" value="#364574">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="borderInput" class="form-label">Input Border Style</label>
                                    <input type="text" class="form-control border-dashed" id="borderInput" placeholder="Enter your name">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <label for="exampleDataList" class="form-label">Datalist example</label>
                                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Search your country...">
                                <datalist id="datalistOptions">
                                    <option value="Switzerland">
                                    </option><option value="New York">
                                    </option><option value="France">
                                    </option><option value="Spain">
                                    </option><option value="Chicago">
                                    </option><option value="Bulgaria">
                                    </option><option value="Hong Kong">
                                </option></datalist>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="exampleInputrounded" class="form-label">Rounded Input</label>
                                    <input type="text" class="form-control rounded-pill" id="exampleInputrounded" placeholder="Enter your name">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="firstnamefloatingInput" placeholder="Enter your firstname">
                                    <label for="firstnamefloatingInput">Asal</label>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>

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
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Mendapatkan tab yang aktif saat ini
            const activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                // Mengatur tab yang aktif sesuai dengan yang disimpan sebelumnya
                $('#myTab a[href="' + activeTab + '"]').tab('show');
            }
        
            // Menyimpan tab yang aktif saat ini saat tab berubah
            $('#myTab a').on('click', function(e) {
                localStorage.setItem('activeTab', $(this).attr('href'));
            });
        });
    </script>
@endpush