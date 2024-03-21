<div class="card-body">
    <ul class="nav nav-tabs nav-border-top nav-border-top-success mb-3" role="tablist" id="myTab">
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#sedang_diproses" role="tab" aria-selected="true">
                Sedang Diproses @if (count($reservasi_mobil->where('id_user', Auth::user()->id)->whereIn('id_status', [1,2,3,4,14,13])) > 0)
                <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('id_user', Auth::user()->id)->whereIn('id_status', [1,2,3,4,14,13])) }}</span>
                @endif
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#perlu_diproses" role="tab" aria-selected="true">
                Perlu Diproses @if (count($reservasi_mobil->where('id_atasan', Auth::user()->id)->where('id_status', 1)) > 0)
                <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('id_atasan', Auth::user()->id)->where('id_status', 1)) }}</span>
                @endif
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#reservasi_selesai" role="tab" aria-selected="true">
                Selesai @if (count($reservasi_mobil->where('id_user', Auth::user()->id)->where('id_status', 5)->where('id_pengantaran', '!=', 3)) > 0)
                <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('id_user', Auth::user()->id)->where('id_status', 5)->where('id_pengantaran', '!=', 3)) }}</span>
                @endif
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#voucher" role="tab" aria-selected="false" tabindex="-1">
                Voucher @if(count($reservasi_mobil->where('id_user', Auth::user()->id)->where('id_pengantaran', 3)->where('id_status', 5)) > 0)
                <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('id_user', Auth::user()->id)->where('id_pengantaran', 3)->where('id_status', 5)) }}</span>
                @endif
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#reservasi_ditolak" role="tab" aria-selected="true">
                Ditolak @if (count($reservasi_mobil->where('id_user', Auth::user()->id)->whereIn('id_status', [6,7,12])) > 0)
                <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('id_user', Auth::user()->id)->whereIn('id_status', [6,7,12])) }}</span>
                @endif
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
                            @foreach ($reservasi_mobil->where('id_user', Auth::user()->id)->whereIn('id_status', [1,2,3,4,14,13]) as $row)
                            <tr>
                                <th scope="row"><a href="#" class="fw-medium">{{ $loop->iteration }}</a></th>
                                <td><a href="{{ url('reservasi-mobil/show', $row->kode_pemesanan) }}" class="fw-medium">{{ $row->user->name }}</a></td>
                                <td>
                                    @if ($row->id_status == 1 || $row->id_status == 14)
                                    <span class="badge bg-info">{{ $row->status->status }}</span>
                                    @elseif ($row->id_status == 2)
                                    <span class="badge bg-primary">{{ $row->status->status }}</span>
                                    @elseif ($row->id_status == 3 || $row->id_status == 13)
                                    <span class="badge bg-warning">{{ $row->status->status }}</span>
                                    @elseif ($row->id_status == 4 || $row->id_status == 5)
                                    <span class="badge bg-success">{{ $row->status->status }}</span>
                                    @elseif ($row->id_status == 6 || $row->id_status == 7 || $row->id_status == 12)
                                    <span class="badge bg-danger">{{ $row->status->status }}</span>
                                    @endif
                                </td>
                                <td>@if (!empty($row->id_mobil)){{ $row->mobil->nama }}@else Transportasi Online @endif</td>
                                <td>{{ $row->supir->nama }}</td>
                                <td><a href="{{ url('reservasi-mobil/show', $row->id) }}" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
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
                            @foreach ($reservasi_mobil->where('id_atasan', Auth::user()->id)->where('id_status', 1) as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ url('reservasi-mobil/show', $row->kode_pemesanan) }}" class="fw-medium">{{ $row->user->name }}</a></td>
                                    <td>
                                        @if ($row->id_status == 1 || $row->id_status == 14)
                                        <span class="badge bg-info">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 2)
                                        <span class="badge bg-primary">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 3 || $row->id_status == 13)
                                        <span class="badge bg-warning">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 4 || $row->id_status == 5)
                                        <span class="badge bg-success">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 6 || $row->id_status == 7 || $row->id_status == 12)
                                        <span class="badge bg-danger">{{ $row->status->status }}</span>
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
                            @foreach ($reservasi_mobil->where('id_user', Auth::user()->id)->where('id_status', 5)->where('id_pengantaran', '!=', 3) as $row)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td><a href="{{ url('reservasi-mobil/show', $row->kode_pemesanan) }}" class="fw-medium">{{ $row->user->name }}</a></td>
                                    <td>
                                        @if ($row->id_status == 1)
                                        <span class="badge bg-info">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 2)
                                        <span class="badge bg-primary">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 3)
                                        <span class="badge bg-warning">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 4)
                                        <span class="badge bg-success">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 5)
                                        <span class="badge bg-success">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 6)
                                        <span class="badge bg-danger">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 13)
                                        <span class="badge bg-warning">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 14)
                                        <span class="badge bg-info">{{ $row->status->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $row->mobil->nama }}</td>
                                    <td>{{ $row->supir->nama }}</td>
                                    <td>
                                        @if ($row->flag_rating == null && $row->rating_driver == null && $row->review_driver == null)
                                            <a href="{{ url('reservasi-mobil/show', $row->kode_pemesanan) }}" class="link-success">Beri Rating <i class="ri-arrow-right-line align-middle"></i></a>
                                        @else
                                            <a href="{{ url('reservasi-mobil/create') }}" class="btn btn-info btn-sm">Pesan Lagi</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>
        <div class="tab-pane" id="voucher" role="tabpanel">
            <div>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0" id="ratingTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Pemesan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Voucher</th>
                                <th scope="col">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservasi_mobil->where('id_user', Auth::user()->id)->where('id_pengantaran', 3)->where('id_status', 5) as $row)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td><a href="{{ url('reservasi-mobil/show', $row->kode_pemesanan) }}">{{ $row->user->name }}</a></td>
                                    <td>
                                        <span class="badge bg-success">{{ $row->status->status }}</span>
                                    </td>
                                    <td>
                                        @foreach ($vouchers->where('id_reservasi', $row->id) as $voucher)
                                            @if (count($vouchers->where('id_reservasi', $row->id)) == 1)
                                                {{ $voucher->nama_voucher }}
                                            @else
                                                <li>{{ $voucher->nama_voucher }}</li>
                                            @endif
                                            @endforeach
                                    </td>
                                    <td><a href="{{ url('reservasi-mobil/show', $row->kode_pemesanan) }}" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
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
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td><a href="{{ url('reservasi-mobil/show', $row->kode_pemesanan) }}" class="fw-medium">{{ $row->user->name }}</a></td>
                                    <td>
                                        @if ($row->id_status == 1 || $row->id_status == 14)
                                        <span class="badge bg-info">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 2)
                                        <span class="badge bg-primary">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 3 || $row->id_status == 13)
                                        <span class="badge bg-warning">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 4 || $row->id_status == 5)
                                        <span class="badge bg-success">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 6 || $row->id_status == 7 || $row->id_status == 12)
                                        <span class="badge bg-danger">{{ $row->status->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $row->mobil->nama }}</td>
                                    <td>{{ $row->supir->nama }}</td>
                                    <td><a href="{{ url('reservasi-mobil/show', $row->kode_pemesanan) }}" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>
    </div>
</div><!-- end card-body -->