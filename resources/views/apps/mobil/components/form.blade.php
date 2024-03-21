<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Form Tambah Data Mobil</h4>
            </div><!-- end card header -->
            <div class="card-body pb-5">
                <div class="row gy-4">
                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="basiInput" class="form-label">Nama Mobil</label>
                            <input type="text" class="form-control" name="nama" value="@if(!empty($mobil->nama)){{ $mobil->nama }}@endif" placeholder="contoh : Innova B 18907 TJK">
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="basiInput" class="form-label">Nomor Polisi</label>
                            <input type="text" class="form-control" name="nomor_polisi" value="@if(!empty($mobil->nomor_polisi)){{ $mobil->nomor_polisi }}@endif" placeholder="contoh : B 18907 TJK">
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="basiInput" class="form-label">Nomor STNK</label>
                            <input type="text" class="form-control" name="nomor_stnk" value="@if(!empty($mobil->nomor_stnk)){{ $mobil->nomor_stnk }}@endif" placeholder="contoh : 12312B42 G">
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="basiInput" class="form-label">Plat Nomor</label>
                            <select class="form-control" name="id_plat">
                                <option disabled selected>Pilih Jenis Plat</option>
                                @foreach ($plats as $plat)
                                    <option value="{{ $plat->id }}" @if(!empty($mobil->id_plat))@if ($mobil->id_plat == $plat->id) selected @endif @endif>{{ $plat->nomor_plat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="basiInput" class="form-label">Jenis Kendaraan</label>
                            <select class="form-control" name="id_jenis_kendaraan">
                                <option disabled selected>Pilih Jenis Kendaraan</option>
                                @foreach ($jenis_kendaraan as $row)
                                    <option value="{{ $row->id }}" @if(!empty($mobil->id_plat))@if ($mobil->id_jenis_kendaraan == $row->id) selected @endif @endif>{{ $row->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="basiInput" class="form-label">Tahun Pembelian</label>
                            <input type="number" class="form-control" name="tahun_pembelian" value="@if(!empty($mobil->tahun_pembelian)){{ $mobil->tahun_pembelian }}@endif" placeholder="contoh : 2021">
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="basiInput" class="form-label">Warna Mobil</label>
                            <input type="text" class="form-control" name="id_warna_mobil" value="@if(!empty($mobil->id_warna_mobil)){{ $mobil->id_warna_mobil }}@endif" placeholder="contoh : Hitam">
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="basiInput" class="form-label">Entitas</label>
                            <select class="form-control" name="id_entitas">
                                <option value="">Pilih Entitas</option>
                                @foreach ($entitas as $row)
                                    <option value="{{ $row->id }}" @if(!empty($mobil->id_entitas))@if ($mobil->id_entitas == $row->id) selected @endif @endif>{{ $row->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="basiInput" class="form-label">Status</label>
                            <select class="form-control" name="id_status">
                                <option disabled selected>Pilih Status</option>
                                @foreach ($status as $row)
                                    <option value="{{ $row->id }}" @if(!empty($mobil->id_status))@if ($mobil->id_status == $row->id) selected @endif @endif>{{ $row->status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="basiInput" class="form-label">PIC</label>
                            <select class="form-control" name="id_supir">
                                <option disabled selected>Pilih Supir</option>
                                @foreach ($supir as $row)
                                    <option value="{{ $row->id }}" @if(!empty($mobil->id_supir))@if ($mobil->id_supir == $row->id) selected @endif @endif>{{ $row->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="exampleFormControlTextarea5" class="form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="3">@if (!empty($mobil->keterangan)){{ $mobil->keterangan }}@endif</textarea>
                        </div>
                    </div>
                    <!--end col-->
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!-- end col -->
</div>