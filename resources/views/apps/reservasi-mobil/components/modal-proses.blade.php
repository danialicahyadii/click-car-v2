<!-- Varying modal content -->
<div class="modal fade" id="proses" tabindex="-1" aria-labelledby="varyingcontentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('reservasi-mobil/setuju') }}" method="POST">
                @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="proses">Proses</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @role('Admin Umum')
                    <div class="mb-3">
                        <label class="form-label">Persetujuan</label>
                        <select class="form-control id-status" name="id_status" id="id_status">
                            <option selected disabled>Pilih Persetujuan</option>
                            <option value="3" @if ($reservasi_mobil->id_pengantaran != 3)
                                selected
                            @endif>Disetujui Umum (Mobil)</option>
                            <option @if ($reservasi_mobil->id_pengantaran == 3)
                                selected
                            @endif value="4">Disetujui Umum (Kode Transportasi Online)</option>
                        </select>   
                    </div>
                    <div class="mb-3 d-none" id="id_pengantaran">
                        <label class="form-label">Pilih Pengantaran</label>
                        <select class="form-control id-pengantaran" name="id_pengantaran">
                            <option selected disabled>Pilih Persetujuan</option>
                            <option value="2" @if ($reservasi_mobil->id_pengantaran == 2)
                                selected
                            @endif>Ditunggu</option>
                            <option value="1" @if ($reservasi_mobil->id_pengantaran == 1)
                                selected
                            @endif>Di Drop</option>
                        </select>   
                    </div>
                @endrole
                @role('Admin Driver')
                    @if ($reservasi_mobil->id_status == 3)    
                        <div class="mb-3">
                            <!-- Warning Alert -->
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                Mohon pilih ulang Jenis kendaraan jika ingin mengganti <b>Mobil</b> atau <b>Driver !</b>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <label class="form-label">Pilih Jenis Kendaraan</label>
                            <select class="form-control jenis-kendaraan" name="id_jenis_kendaraan" id="id_jenis_kendaraan">
                                <option selected disabled>Pilih Jenis Kendaraan</option>
                                @foreach ($jenis_kendaraan as $row)
                                    <option value="{{ $row->id }}" @if (!empty($reservasi_mobil->id_jenis_kendaraan))
                                        @if ($reservasi_mobil->id_jenis_kendaraan == $row->id)
                                            selected
                                        @endif
                                    @endif>{{ $row->nama }}</option>
                                @endforeach
                            </select>   
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih Mobil</label>
                            <select class="form-control" name="id_mobil" id="mobil">
                                <option selected disabled>Pilih Mobil</option>
                                @foreach ($mobil as $row)
                                    <option value="{{ $row->id }}" @if (!empty($reservasi_mobil->id_mobil))
                                        @if ($reservasi_mobil->id_mobil == $row->id)
                                            selected
                                        @endif
                                    @endif>{{ $row->nama }}</option>
                                @endforeach
                            </select>   
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih Driver</label>
                            <select class="form-control" name="id_supir" id="supir">
                                <option selected disabled>Pilih Driver</option>
                                @foreach ($supir as $row)
                                    <option value="{{ $row->id }}" @if (!empty($reservasi_mobil->id_supir))
                                        @if ($reservasi_mobil->id_supir == $row->id)
                                            selected
                                        @endif
                                    @endif>{{ $row->nama }}</option>
                                @endforeach
                            </select>   
                        </div>
                    @else
                        <div class="row align-items-center mb-2">
                            <div class="col-8">
                                <label for="basiInput" class="form-label">Voucher</label>
                                <input type="text" class="form-control" name="nama_voucher[]" placeholder="Masukkan Voucher">
                            </div>
                            <div class="col-2">
                                <a href="javascript:void(0);" class="btn btn-primary btn-icon waves-effect waves-light add-voucher" style="margin-top: 30px;"><i class="ri-add-line"></i></a>
                            </div>
                        </div>
                        <div class="daftar-voucher">
                        </div>                   
                    @endif
                @endrole
                <div class="mb-3">
                    <input type="text" name="id_reservasi" value="{{ $reservasi_mobil->id }}" hidden>
                    <label for="message-text" class="col-form-label">Catatan:</label>
                    <textarea class="form-control" name="komentar" rows="4" placeholder="Masukkan Catatan"></textarea>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>