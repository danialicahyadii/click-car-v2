<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah {{ $title ? $title : '' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <form action="{{ route('mobil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" placeholder="Enter firstname">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" placeholder="Enter lastname">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="genderInput" class="form-label">Gender</label>
                            <div>
                                <!-- Inline Radios -->
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="inlineRadio1" value="option1">
                                    <label class="form-check-label" for="inlineRadio1">1</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions2" id="inlineRadio2" value="option2">
                                    <label class="form-check-label" for="inlineRadio2">2</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions3" id="inlineRadio3" value="option3" disabled>
                                    <label class="form-check-label" for="inlineRadio3">3 (disabled)</label>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="emailInput" class="form-label">Email</label>
                                <input type="email" class="form-control" id="emailInput" placeholder="Enter your email">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="passwordInput" class="form-label">Password</label>
                                <input type="password" class="form-control" id="passwordInput" value="451326546">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
        </form>
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->