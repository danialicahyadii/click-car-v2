<div class="modal fade" id="myModalDelete{{ $row->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon
                    src="https://cdn.lordicon.com/xekbkxul.json"
                    trigger="loop"
                    delay="1000"
                    colors="primary:#121331,secondary:#c71f16,tertiary:#e8e230,quaternary:#ebe6ef"
                    style="width:120px;height:120px">
                </lord-icon>
                
                <div class="mt-4">
                    <h4 class="mb-3">Apakah Anda yakin akan hapus ?</h4>
                    <p class="text-muted mb-4"> Data ini akan dihapus dari sistem ini.</p>
                    <div class="hstack gap-2 justify-content-center">
                        <form method="POST" action="{{ route('supir.destroy', $row->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <div class="form-group">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>