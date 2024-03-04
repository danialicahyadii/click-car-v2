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
                        <select class="form-control" name="id_status" id="id_status">
                            <option selected disabled>Pilih Persetujuan</option>
                            <option value="3">Disetujui Umum (Mobil)</option>
                            <option value="4">Disetujui Umum (Kode Transportasi Online)</option>
                            <option value="12">Ditolak Umum</option>
                        </select>   
                    </div>
                @endrole
                @role('Admin Driver')
                    @if ($reservasi_mobil->id_status == 3)    
                        <div class="mb-3">
                            <label class="form-label">Pilih Jenis Kendaraan</label>
                            <select class="form-control" name="id_jenis_kendaraan" id="id_jenis_kendaraan">
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
                        <div>
                            <label for="basiInput" class="form-label">Voucher</label>
                            <input type="text" class="form-control" name="voucher_grab" placeholder="Masukkan Voucher">
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