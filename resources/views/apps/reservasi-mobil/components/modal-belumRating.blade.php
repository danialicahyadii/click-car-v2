<div class="modal fade" id="modalBelumRating" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <lord-icon
                    src="https://cdn.lordicon.com/jxzkkoed.json"
                    trigger="loop"
                    delay="1000"
                    style="width:120px;height:120px">
                </lord-icon>
                
                <div class="mt-4">
                    <h4 class="mb-3"> Mohon Maaf !! </h4>
                    <p class="text-muted mb-4">Silahkan Beri penilaian pada reservasi sebelumnya terlebih dahulu. Terimakasih.</p>
                    <div class="hstack gap-2 justify-content-center">
                        <a href="{{ url('reservasi-mobil/create') }}" class="btn btn-warning" >Tetap Lanjut</a>
                        <a href="javascript:void(0);" class="btn btn-success" data-bs-dismiss="modal">Oke Siap</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>