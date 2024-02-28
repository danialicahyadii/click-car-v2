<div class="card-body">
    <ul class="nav nav-tabs nav-border-top nav-border-top-success mb-3" role="tablist" id="myTab">
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#sedang_diproses" role="tab" aria-selected="true">
                Sedang Diproses <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('id_user', Auth::user()->id)->whereIn('id_status', [1,2,3])) }}</span>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#perlu_diproses" role="tab" aria-selected="true">
                Perlu Diproses <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('id_atasan', Auth::user()->id)) }}</span>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#reservasi_selesai" role="tab" aria-selected="true">
                Reservasi Selesai <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('id_user', Auth::user()->id)->where('id_status', 5)) }}</span>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#reservasi_ditolak" role="tab" aria-selected="true">
                Reservasi Ditolak <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('id_user', Auth::user()->id)->whereIn('id_status', [6,7,12])) }}</span>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#rating" role="tab" aria-selected="false" tabindex="-1">
                Rating <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('id_user', Auth::user()->id)->where('id_status', 5)->where('flag_rating', 1)) }}</span>
            </a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content text-muted">
        <div class="tab-pane" id="sedang_diproses" role="tabpanel">
            <div>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0" id="sedang_diprosesTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Pemesan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Mobil</th>
                                <th scope="col">Supir</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservasi_mobil->where('id_user', Auth::user()->id)->whereIn('id_status', [1,2,3]) as $row)
                            <tr>
                                <th scope="row"><a href="#" class="fw-medium">{{ $loop->iteration }}</a></th>
                                <td><a href="{{ url('reservasi-mobil/show', $row->id) }}" class="fw-medium">{{ $row->user->name }}</a></td>
                                <td>
                                    @if ($row->id_status == 1)
                                    <span class="badge rounded-pill text-bg-info">{{ $row->status->status }}</span>
                                    @elseif ($row->id_status == 2)
                                    <span class="badge rounded-pill text-bg-primary">{{ $row->status->status }}</span>
                                    @elseif ($row->id_status == 3)
                                    <span class="badge rounded-pill text-bg-warning">{{ $row->status->status }}</span>
                                    @elseif ($row->id_status == 4)
                                    <span class="badge rounded-pill text-bg-success">{{ $row->status->status }}</span>
                                    @elseif ($row->id_status == 5)
                                    <span class="badge rounded-pill text-bg-sucess">{{ $row->status->status }}</span>
                                    @elseif ($row->id_status == 6)
                                    <span class="badge rounded-pill text-bg-danger">{{ $row->status->status }}</span>
                                    @elseif ($row->id_status == 13)
                                    <span class="badge rounded-pill text-bg-warning">{{ $row->status->status }}</span>
                                    @elseif ($row->id_status == 14)
                                    <span class="badge rounded-pill text-bg-info">{{ $row->status->status }}</span>
                                    @endif
                                </td>
                                <td>@if (!empty($row->id_mobil)){{ $row->mobil->nama }}@else Transportasi Online @endif</td>
                                <td>{{ $row->supir->nama }}</td>
                                <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>
        <div class="tab-pane" id="perlu_diproses" role="tabpanel">
            <div>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0" id="perlu_diprosesTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                
                                <th scope="col">Pemesan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Mobil</th>
                                <th scope="col">Supir</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservasi_mobil->where('id_atasan', Auth::user()->id) as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <th scope="row"><a href="#" class="fw-medium">#{{ $row->id }}</a></th>
                                    <td>{{ $row->user->name }}</td>
                                    <td>
                                        @if ($row->id_status == 1)
                                        <span class="badge rounded-pill text-bg-info">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 2)
                                        <span class="badge rounded-pill text-bg-primary">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 3)
                                        <span class="badge rounded-pill text-bg-warning">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 4)
                                        <span class="badge rounded-pill text-bg-success">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 5)
                                        <span class="badge rounded-pill text-bg-sucess">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 6)
                                        <span class="badge rounded-pill text-bg-danger">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 13)
                                        <span class="badge rounded-pill text-bg-warning">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 14)
                                        <span class="badge rounded-pill text-bg-info">{{ $row->status->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $row->mobil->nama }}</td>
                                    <td>{{ $row->supir->nama }}</td>
                                    <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>
        <div class="tab-pane" id="reservasi_selesai" role="tabpanel">
            <div>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0" id="reservasi_selesaiTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                
                                <th scope="col">Pemesan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Mobil</th>
                                <th scope="col">Supir</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservasi_mobil->where('id_user', Auth::user()->id)->where('id_status', 5) as $row)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <th scope="row"><a href="#" class="fw-medium">#{{ $row->id }}</a></th>
                                    <td>{{ $row->user->name }}</td>
                                    <td>
                                        @if ($row->id_status == 1)
                                        <span class="badge rounded-pill text-bg-info">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 2)
                                        <span class="badge rounded-pill text-bg-primary">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 3)
                                        <span class="badge rounded-pill text-bg-warning">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 4)
                                        <span class="badge rounded-pill text-bg-success">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 5)
                                        <span class="badge rounded-pill text-bg-sucess">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 6)
                                        <span class="badge rounded-pill text-bg-danger">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 13)
                                        <span class="badge rounded-pill text-bg-warning">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 14)
                                        <span class="badge rounded-pill text-bg-info">{{ $row->status->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $row->mobil->nama }}</td>
                                    <td>{{ $row->supir->nama }}</td>
                                    <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>
        <div class="tab-pane" id="reservasi_ditolak" role="tabpanel">
            <div>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0" id="reservasi_ditolakTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Pemesan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Mobil</th>
                                <th scope="col">Supir</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservasi_mobil->where('id_user', Auth::user()->id)->whereIn('id_status', [6,7,12]) as $row)
                                <tr>
                                    <th scope="row"><a href="#" class="fw-medium">{{ $loop->iteration }}</a></th>
                                    <td>{{ $row->user->name }}</td>
                                    <td>
                                        @if ($row->id_status == 1)
                                        <span class="badge rounded-pill text-bg-info">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 2)
                                        <span class="badge rounded-pill text-bg-primary">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 3)
                                        <span class="badge rounded-pill text-bg-warning">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 4)
                                        <span class="badge rounded-pill text-bg-success">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 5)
                                        <span class="badge rounded-pill text-bg-sucess">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 6)
                                        <span class="badge rounded-pill text-bg-danger">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 13)
                                        <span class="badge rounded-pill text-bg-warning">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 14)
                                        <span class="badge rounded-pill text-bg-info">{{ $row->status->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $row->mobil->nama }}</td>
                                    <td>{{ $row->supir->nama }}</td>
                                    <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>
        <div class="tab-pane" id="rating" role="tabpanel">
            <div>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0" id="ratingTable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Pemesan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Mobil</th>
                                <th scope="col">Supir</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Review</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservasi_mobil->where('id_user', Auth::user()->id)->where('id_status', 5)->where('flag_rating', 1) as $row)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <th scope="row"><a href="#" class="fw-medium">#{{ $row->id }}</a></th>
                                    <td>{{ $row->user->name }}</td>
                                    <td>
                                        @if ($row->id_status == 1)
                                        <span class="badge rounded-pill text-bg-info">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 2)
                                        <span class="badge rounded-pill text-bg-primary">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 3)
                                        <span class="badge rounded-pill text-bg-warning">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 4)
                                        <span class="badge rounded-pill text-bg-success">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 5)
                                        <span class="badge rounded-pill text-bg-sucess">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 6)
                                        <span class="badge rounded-pill text-bg-danger">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 13)
                                        <span class="badge rounded-pill text-bg-warning">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 14)
                                        <span class="badge rounded-pill text-bg-info">{{ $row->status->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $row->mobil->nama }}</td>
                                    <td>{{ $row->supir->nama }}</td>
                                    <td><i class="ri-star-s-fill text-warning"></i><i class="ri-star-s-fill text-warning"></i><i class="ri-star-s-fill text-warning"></i><i class="ri-star-s-fill text-warning"></i><i class="ri-star-s-fill text-warning"></i></td>
                                    <td>Driver Asik</td>
                                    <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>  
            
        </div>
    </div>
</div><!-- end card-body -->