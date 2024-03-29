<!-- Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Options</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Dropdown Filter di Dalam Modal -->
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="filterSelectType">Filter Type:</label>
                                <select class="form-control" name="filter_type" id="filterSelect">
                                    <option value="" disabled selected>Please Select Filter</option>
                                    <option value="YTD">Year to Date</option>
                                    <option value="MTD">Month to Date</option>
                                    <option value="ByMonth">Choose By Month</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div id="filterMonthSelect" class="form-group" >
                                <label for="filterMonthSelect">Month :</label>
                                <select class="form-control" name="month" id="month">
                                    <option value="" disabled selected>Please Select Filter</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="button-submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
