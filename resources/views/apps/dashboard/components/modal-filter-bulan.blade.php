<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Filter Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mb-2">
                <form action="javascript:void(0);">
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <label class="form-label">Jenis Filter :</label>
                                <select class="form-control" name="filter_type" id="filterSelect">
                                    <option value="" disabled selected>Pilih Jenis Filter</option>
                                    <option value="YTD">Year to Date</option>
                                    <option value="MTD">Month to Date</option>
                                    <option value="ByMonth">Choose By Month</option>
                                </select>
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6" id="filterMonthSelect">
                            <div>
                                <label class="form-label">Bulan :</label>
                                <select class="form-control" name="month" id="month">
                                    <option value="" disabled selected>Pilih Bulan</option>
                                    <option value="January">Januari</option>
                                    <option value="February">Februari</option>
                                    <option value="March">Maret</option>
                                    <option value="April">April</option>
                                    <option value="May">Mei</option>
                                    <option value="June">Juni</option>
                                    <option value="July">Juli</option>
                                    <option value="August">Agustus</option>
                                    <option value="September">September</option>
                                    <option value="October">Oktober</option>
                                    <option value="November">November</option>
                                    <option value="December">Desember</option>
                                </select>
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="button-submit">Submit</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>