<!-- Varying modal content -->
<div class="modal fade" id="actionDriver" tabindex="-1" aria-labelledby="varyingcontentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @if ($reservasi_mobil->id_status == 14)
                <form action="{{ url('reservasi-mobil/action-driver') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="proses">Mulai Perjalanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="text" hidden name="id" value="{{ $reservasi_mobil->id }}">
                            <label for="basicInput" class="form-label">KM Awal</label>
                            <input type="text" class="form-control" name="km_awal" placeholder="Masukkan Km awal">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Start</button>
                    </div>
                </form>
            @endif
            @if ($reservasi_mobil->id_status == 13)
                <form action="{{ url('reservasi-mobil/action-driver') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="proses">Akhiri Perjalanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                <input type="text" hidden name="id" value="{{ $reservasi_mobil->id }}">
                                <label for="basicInput" class="form-label">KM Akhir</label>
                                <input type="number" class="form-control" name="km_akhir" placeholder="Masukkan Km akhir">
                            </div>
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">Waktu Penyelesaian</label>
                                <input type="text" name="waktu_penyelesaian" class="form-control" data-provider="flatpickr" data-date-format="d-m-y" data-enable-time  >
                            </div>
                            <div class="mb-3 text-center">
                                <label>Rating</label>
                                <div dir="ltr">
                                    <div id="rater-onhover" class="align-middle"></div>
                                    <span class="ratingnum badge bg-info align-middle ms-2"></span>
                                    <input type="text" name="rating_penumpang" hidden>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>Review</label>
                                <textarea class="form-control" id="message-text" name="review_penumpang" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Selesai</button>
                    </div>
                </form>    
            @endif
        </div>
    </div>
</div>