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
                            <label for="basiInput" class="form-label">Nama Supir</label>
                            <input type="text" class="form-control" name="nama" value="@if(!empty($supir->nama)){{ $supir->nama }}@endif" placeholder="contoh : Boyke">
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="basiInput" class="form-label">Nomor Handphone</label>
                            <input type="text" class="form-control" name="nomor_hp" value="@if(!empty($supir->nomor_hp)){{ $supir->nomor_hp }}@endif" placeholder="contoh : 6281289124536">
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="basiInput" class="form-label">Entitas</label>
                            <select class="form-control" name="id_entitas">
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
                                <option value="1" {{ !empty($supir->id_status) ? $supir->id_status == 1 ? 'selected' : '' : ''}}>Aktif</option>
                                <option value="2" {{ !empty($supir->id_status) ? $supir->id_status == 2 ? 'selected' : '' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="basiInput" class="form-label">Jenis SIM</label>
                            <select class="form-control" name="jenis_sim">
                                <option disabled selected>Pilih Jenis SIM</option>
                                <option value="1" {{ !empty($supir->jenis_sim) ? $supir->jenis_sim == 1 ? 'selected' : '' : ''}}>Perorangan</option>
                                <option value="2" {{ !empty($supir->jenis_sim) ? $supir->jenis_sim == 2 ? 'selected' : '' : '' }}>Umum</option>
                            </select>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="basiInput" class="form-label">Masa Aktif SIM</label>
                            <input type="date" class="form-control" name="habis_sim" value="@if(!empty($supir->habis_sim)){{ $supir->habis_sim }}@endif" placeholder="contoh : 2021">
                        </div>
                    </div>
                    <!--end col-->
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!-- end col -->
</div>