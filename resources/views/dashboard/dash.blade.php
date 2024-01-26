@extends('layouts.app')
@section('page-content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row project-wrapper">
            <div class="col-12">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-primary text-primary rounded-2 fs-2">
                                            <i class="ri-roadster-fill" class="text-primary"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Mobil Tersedia</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="15">0</span></h4>
                                        </div>
                                        <p class="text-muted text-truncate mb-0">Mobil</p>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </div><!-- end col -->

                    <div class="col-xl-4">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-warning text-warning rounded-2 fs-2">
                                            <i data-feather="briefcase" class="text-warning"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-medium text-muted mb-3">Total Reservasi</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="8886">0</span></h4>
                                        </div>
                                        <p class="text-muted mb-0">Reservasi</p>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </div><!-- end col -->

                    <div class="col-xl-4">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-success text-success rounded-2 fs-2">
                                            <i data-feather="navigation" class="text-success"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Mobil Keluar</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="0">0</span></h4>
                                        </div>
                                        <p class="text-muted text-truncate mb-0">Mobil</p>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Mobil Tersedia</h4>
                            </div><!-- end card header -->
                            <div class="card-header p-1 border-0 bg-soft-light">
                                    <!-- With Indicators -->
                                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class=""></li>
                                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" class="" aria-current="true"></li>
                                        </ol>
                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item active">
                                                <img class="d-block img-fluid mx-auto" src="{{ asset('assets/img/park3.png') }}" alt="First slide">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block img-fluid mx-auto" src="{{ asset('assets/img/park3.png') }}" alt="Second slide">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block img-fluid mx-auto" src="{{ asset('assets/img/park3.png') }}" alt="Third slide">
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                            </div><!-- end card header -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header p-0 border-0 bg-soft-light text-center">
                                <div class="mb-4 mt-4">
                                    <!-- Responsive Images -->
                                    <img src="{{ asset('assets/img/mobiljalan1.gif') }}" class="img-fluid" alt="Responsive image">
                                </div>
                            </div><!-- end card header -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">RANKING BAR CHART TOP 5</h4>
                                <div>
                                    <button type="button" class="btn btn-secondary btn-sm">
                                        <i class="bx bx-filter mb-0 me-1"></i> Filter Bulan
                                    </button>
                                </div>
                            </div><!-- end card header -->
                            <div class="card-body p-2 pb-2">
                                <div>
                                    <div id="column_chart" class="apex-charts">

                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row project-wrapper">
            <div class="col-8">
                <div class="card card-height-100">
                    <div class="card-header d-flex align-items-center">
                        <h4 class="card-title flex-grow-1 mb-0">Active Projects</h4>
                        <div class="flex-shrink-0">
                            <a href="javascript:void(0);" class="btn btn-soft-info btn-sm">Export Report</a>
                        </div>
                    </div><!-- end cardheader -->
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-nowrap table-centered align-middle">
                                <thead class="bg-light text-muted">
                                    <tr>
                                        <th scope="col">Project Name</th>
                                        <th scope="col">Project Lead</th>
                                        <th scope="col">Progress</th>
                                        <th scope="col">Assignee</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" style="width: 10%;">Due Date</th>
                                    </tr><!-- end tr -->
                                </thead><!-- thead -->

                                <tbody>
                                    <tr>
                                        <td class="fw-medium">Brand Logo Design</td>
                                        <td>
                                            <img src="assets/images/users/avatar-1.jpg" class="avatar-xxs rounded-circle me-1" alt="">
                                            <a href="javascript: void(0);" class="text-reset">Donald Risher</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-1 text-muted fs-13">53%</div>
                                                <div class="progress progress-sm  flex-grow-1" style="width: 68%;">
                                                    <div class="progress-bar bg-primary rounded" role="progressbar" style="width: 53%" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group flex-nowrap">
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-soft-warning">Inprogress</span></td>
                                        <td class="text-muted">06 Sep 2021</td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="fw-medium">Redesign - Landing Page</td>
                                        <td>
                                            <img src="assets/images/users/avatar-2.jpg" class="avatar-xxs rounded-circle me-1" alt="">
                                            <a href="javascript: void(0);" class="text-reset">Prezy William</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 text-muted me-1">0%</div>
                                                <div class="progress progress-sm flex-grow-1" style="width: 68%;">
                                                    <div class="progress-bar bg-primary rounded" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-soft-danger">Pending</span></td>
                                        <td class="text-muted">13 Nov 2021</td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="fw-medium">Multipurpose Landing Template</td>
                                        <td>
                                            <img src="assets/images/users/avatar-3.jpg" class="avatar-xxs rounded-circle me-1" alt="">
                                            <a href="javascript: void(0);" class="text-reset">Boonie Hoynas</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 text-muted me-1">100%</div>
                                                <div class="progress progress-sm flex-grow-1" style="width: 68%;">
                                                    <div class="progress-bar bg-primary rounded" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-7.jpg" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-8.jpg" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-soft-success">Completed</span></td>
                                        <td class="text-muted">26 Nov 2021</td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="fw-medium">Chat Application</td>
                                        <td>
                                            <img src="assets/images/users/avatar-5.jpg" class="avatar-xxs rounded-circle me-1" alt="">
                                            <a href="javascript: void(0);" class="text-reset">Pauline Moll</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 text-muted me-1">64%</div>
                                                <div class="progress flex-grow-1 progress-sm" style="width: 68%;">
                                                    <div class="progress-bar bg-primary rounded" role="progressbar" style="width: 64%" aria-valuenow="64" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-soft-warning">Progress</span></td>
                                        <td class="text-muted">15 Dec 2021</td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="fw-medium">Create Wireframe</td>
                                        <td>
                                            <img src="assets/images/users/avatar-6.jpg" class="avatar-xxs rounded-circle me-1" alt="">
                                            <a href="javascript: void(0);" class="text-reset">James Bangs</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 text-muted me-1">77%</div>
                                                <div class="progress flex-grow-1 progress-sm" style="width: 68%;">
                                                    <div class="progress-bar bg-primary rounded" role="progressbar" style="width: 77%" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-xxs">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-soft-warning">Progress</span></td>
                                        <td class="text-muted">21 Dec 2021</td>
                                    </tr><!-- end tr -->
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div>

                        <div class="align-items-center mt-xl-3 mt-4 justify-content-between d-flex">
                            <div class="flex-shrink-0">
                                <div class="text-muted">Showing <span class="fw-semibold">5</span> of <span class="fw-semibold">25</span> Results </div>
                            </div>
                            <ul class="pagination pagination-separated pagination-sm mb-0">
                                <li class="page-item disabled">
                                    <a href="#" class="page-link">←</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">1</a>
                                </li>
                                <li class="page-item active">
                                    <a href="#" class="page-link">2</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">3</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">→</a>
                                </li>
                            </ul>
                        </div>

                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-4">
                <div class="card card-height-100">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Projects Status</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <a class="dropdown-btn text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    All Time <i class="mdi mdi-chevron-down ms-1"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">All Time</a>
                                    <a class="dropdown-item" href="#">Last 7 Days</a>
                                    <a class="dropdown-item" href="#">Last 30 Days</a>
                                    <a class="dropdown-item" href="#">Last 90 Days</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="prjects-status" data-colors='["--vz-success", "--vz-primary", "--vz-warning", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
                        <div class="mt-3">
                            <div class="d-flex justify-content-center align-items-center mb-4">
                                <h2 class="me-3 ff-secondary mb-0">258</h2>
                                <div>
                                    <p class="text-muted mb-0">Total Projects</p>
                                    <p class="text-success fw-medium mb-0">
                                        <span class="badge badge-soft-success p-1 rounded-circle"><i class="ri-arrow-right-up-line"></i></span> +3 New
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-2">
                                <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-success align-middle me-2"></i> Completed</p>
                                <div>
                                    <span class="text-muted pe-5">125 Projects</span>
                                    <span class="text-success fw-medium fs-12">15870hrs</span>
                                </div>
                            </div><!-- end -->
                            <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-2">
                                <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-primary align-middle me-2"></i> In Progress</p>
                                <div>
                                    <span class="text-muted pe-5">42 Projects</span>
                                    <span class="text-success fw-medium fs-12">243hrs</span>
                                </div>
                            </div><!-- end -->
                            <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-2">
                                <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-warning align-middle me-2"></i> Yet to Start</p>
                                <div>
                                    <span class="text-muted pe-5">58 Projects</span>
                                    <span class="text-success fw-medium fs-12">~2050hrs</span>
                                </div>
                            </div><!-- end -->
                            <div class="d-flex justify-content-between py-2">
                                <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-danger align-middle me-2"></i> Cancelled</p>
                                <div>
                                    <span class="text-muted pe-5">89 Projects</span>
                                    <span class="text-success fw-medium fs-12">~900hrs</span>
                                </div>
                            </div><!-- end -->
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-xxl-4">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Top 10 Driver Terfavorit</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Last 30 Days<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Yesterday</a>
                                    <a class="dropdown-item" href="#">Last 7 Days</a>
                                    <a class="dropdown-item" href="#">Last 30 Days</a>
                                    <a class="dropdown-item" href="#">This Month</a>
                                    <a class="dropdown-item" href="#">Last Month</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="table-responsive table-card">
                            <table class="table table-borderless table-nowrap align-middle mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">Member</th>
                                        <th scope="col">Hours</th>
                                        <th scope="col">Tasks</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="d-flex">
                                            <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">Donald Risher</h5>
                                                <p class="fs-12 mb-0 text-muted">Product Manager</p>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">110h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            258
                                        </td>
                                        <td style="width:5%;">
                                            <div id="radialBar_chart_1" data-colors='["--vz-primary"]' data-chart-series="50" class="apex-charts" dir="ltr"></div>
                                        </td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="d-flex">
                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">Jansh Brown</h5>
                                                <p class="fs-12 mb-0 text-muted">Lead Developer</p>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">83h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            105
                                        </td>
                                        <td>
                                            <div id="radialBar_chart_2" data-colors='["--vz-primary"]' data-chart-series="45" class="apex-charts" dir="ltr"></div>
                                        </td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="d-flex">
                                            <img src="assets/images/users/avatar-7.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">Carroll Adams</h5>
                                                <p class="fs-12 mb-0 text-muted">Lead Designer</p>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">58h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            75
                                        </td>
                                        <td>
                                            <div id="radialBar_chart_3" data-colors='["--vz-primary"]' data-chart-series="75" class="apex-charts" dir="ltr"></div>
                                        </td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="d-flex">
                                            <img src="assets/images/users/avatar-4.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">William Pinto</h5>
                                                <p class="fs-12 mb-0 text-muted">UI/UX Designer</p>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">96h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            85
                                        </td>
                                        <td>
                                            <div id="radialBar_chart_4" data-colors='["--vz-warning"]' data-chart-series="25" class="apex-charts" dir="ltr"></div>
                                        </td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="d-flex">
                                            <img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">Garry Fournier</h5>
                                                <p class="fs-12 mb-0 text-muted">Web Designer</p>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">76h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            69
                                        </td>
                                        <td>
                                            <div id="radialBar_chart_5" data-colors='["--vz-primary"]' data-chart-series="60" class="apex-charts" dir="ltr"></div>
                                        </td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="d-flex">
                                            <img src="assets/images/users/avatar-5.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">Susan Denton</h5>
                                                <p class="fs-12 mb-0 text-muted">Lead Designer</p>
                                            </div>
                                        </td>

                                        <td>
                                            <h6 class="mb-0">123h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            658
                                        </td>
                                        <td>
                                            <div id="radialBar_chart_6" data-colors='["--vz-success"]' data-chart-series="85" class="apex-charts" dir="ltr"></div>
                                        </td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="d-flex">
                                            <img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">Joseph Jackson</h5>
                                                <p class="fs-12 mb-0 text-muted">React Developer</p>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">117h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            125
                                        </td>
                                        <td>
                                            <div id="radialBar_chart_7" data-colors='["--vz-primary"]' data-chart-series="70" class="apex-charts" dir="ltr"></div>
                                        </td>
                                    </tr><!-- end tr -->
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xxl-4">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Top 10 Driver Terfavorit</h4>
                        <div class="flex-shrink-0">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Last 30 Days<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Yesterday</a>
                                    <a class="dropdown-item" href="#">Last 7 Days</a>
                                    <a class="dropdown-item" href="#">Last 30 Days</a>
                                    <a class="dropdown-item" href="#">This Month</a>
                                    <a class="dropdown-item" href="#">Last Month</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="table-responsive table-card">
                            <table class="table table-borderless table-nowrap align-middle mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">Member</th>
                                        <th scope="col">Hours</th>
                                        <th scope="col">Tasks</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="d-flex">
                                            <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">Donald Risher</h5>
                                                <p class="fs-12 mb-0 text-muted">Product Manager</p>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">110h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            258
                                        </td>
                                        {{-- <td style="width:5%;">
                                            <div id="radialBar_chart_1" data-colors='["--vz-primary"]' data-chart-series="50" class="apex-charts" dir="ltr"></div>
                                        </td> --}}
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="d-flex">
                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">Jansh Brown</h5>
                                                <p class="fs-12 mb-0 text-muted">Lead Developer</p>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">83h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            105
                                        </td>
                                        {{-- <td>
                                            <div id="radialBar_chart_2" data-colors='["--vz-primary"]' data-chart-series="45" class="apex-charts" dir="ltr"></div>
                                        </td> --}}
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="d-flex">
                                            <img src="assets/images/users/avatar-7.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">Carroll Adams</h5>
                                                <p class="fs-12 mb-0 text-muted">Lead Designer</p>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">58h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            75
                                        </td>
                                        <td>
                                            <div id="radialBar_chart_3" data-colors='["--vz-primary"]' data-chart-series="75" class="apex-charts" dir="ltr"></div>
                                        </td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="d-flex">
                                            <img src="assets/images/users/avatar-4.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">William Pinto</h5>
                                                <p class="fs-12 mb-0 text-muted">UI/UX Designer</p>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">96h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            85
                                        </td>
                                        <td>
                                            <div id="radialBar_chart_4" data-colors='["--vz-warning"]' data-chart-series="25" class="apex-charts" dir="ltr"></div>
                                        </td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="d-flex">
                                            <img src="assets/images/users/avatar-6.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">Garry Fournier</h5>
                                                <p class="fs-12 mb-0 text-muted">Web Designer</p>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">76h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            69
                                        </td>
                                        <td>
                                            <div id="radialBar_chart_5" data-colors='["--vz-primary"]' data-chart-series="60" class="apex-charts" dir="ltr"></div>
                                        </td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="d-flex">
                                            <img src="assets/images/users/avatar-5.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">Susan Denton</h5>
                                                <p class="fs-12 mb-0 text-muted">Lead Designer</p>
                                            </div>
                                        </td>

                                        <td>
                                            <h6 class="mb-0">123h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            658
                                        </td>
                                        <td>
                                            <div id="radialBar_chart_6" data-colors='["--vz-success"]' data-chart-series="85" class="apex-charts" dir="ltr"></div>
                                        </td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td class="d-flex">
                                            <img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-xs rounded-3 me-2">
                                            <div>
                                                <h5 class="fs-13 mb-0">Joseph Jackson</h5>
                                                <p class="fs-12 mb-0 text-muted">React Developer</p>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">117h : <span class="text-muted">150h</span></h6>
                                        </td>
                                        <td>
                                            125
                                        </td>
                                        <td>
                                            <div id="radialBar_chart_7" data-colors='["--vz-primary"]' data-chart-series="70" class="apex-charts" dir="ltr"></div>
                                        </td>
                                    </tr><!-- end tr -->
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

    </div>
    <!-- container-fluid -->
</div>
@endsection
@push('js')
<!-- prismjs plugin -->
<script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>
<script>
     var options = {
          series: [{
          name: 'Net Profit',
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
          name: 'Revenue',
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }, {
          name: 'Free Cash Flow',
          data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
          title: {
            text: '$ (thousands)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#column_chart"), options);
        chart.render();
</script>
@endpush