<!-- Varying modal content -->
<div class="modal fade" id="batal" tabindex="-1" aria-labelledby="varyingcontentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('reservasi-mobil/batal', $reservasi_mobil->id) }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="batal">Catatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @role('Admin Driver')
                        <div class="mb-3">
                            <label class="form-label">Persetujuan</label>
                            <select class="form-control id-status" name="id_status">
                                <option value="2">Kembalikan ke Umum</option>
                                <option value="12">Batalkan</option>
                            </select>   
                        </div>
                    @endrole
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Catatan:</label>
                        <input type="text" name="id_reservasi" value="{{ $reservasi_mobil->id }}" hidden>
                        <textarea class="form-control" name="catatan" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>