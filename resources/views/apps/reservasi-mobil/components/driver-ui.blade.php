<div class="card-body">
    <ul class="nav nav-tabs nav-border-top nav-border-top-info mb-3" role="tablist" id="myTab">
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#reservasi_hari_ini" role="tab" aria-selected="true">
                Reservasi Hari Ini @if (count($reservasi_mobil->where('tgl_pergi', Carbon::today())) > 0)
                <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('tgl_pergi', Carbon::today())) }}</span>
                @endif
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#konfirmasi_reservasi" role="tab" aria-selected="true">
                Konfirmasi Reservasi @if (count($reservasi_mobil->whereIn('id_status', [14, 13])) > 0)
                <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->whereIn('id_status', [13, 14])) }}</span>
                @endif
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#riwayat" role="tab" aria-selected="false" tabindex="-1">
                Riwayat @if(count($reservasi_mobil->where('id_status', 5)) > 0)
                <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->whereBetween('id_status', [4, 14])) }}</span>
            @endif
            </a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content text-muted">
        <div class="tab-pane" id="reservasi_hari_ini" role="tabpanel">
            <div>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0" id="reservasi_hari_iniTable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Pemesan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Mobil</th>
                                <th scope="col">Supir</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservasi_mobil->where('tgl_pergi', Carbon::today()->isoFormat('Y-MM-DD')) as $row)
                                <tr>
                                    <th scope="row"><a href="{{ url('reservasi-mobil/show', $row->id) }}" class="fw-medium">3120</a></th>
                                    <td><a href="{{ url('reservasi-mobil/show', $row->id) }}" class="fw-medium">Dani Ali Cahyadi</a></td>
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
                                    <td>INNOVA B 1806 HKR</td>
                                    <td>M.TAUFIK HIDAYAT (KAPOL)</td>
                                    <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>  
            
        </div>
        <div class="tab-pane" id="konfirmasi_reservasi" role="tabpanel">
            <div>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0" id="konfirmasi_reservasiTable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Pemesan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Mobil</th>
                                <th scope="col">Supir</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservasi_mobil->whereIn('id_status', [13, 14]) as $row)
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
                                    <td>{{ $row->mobil->nama }}</td>
                                    <td>{{ $row->supir->nama }}</td>
                                    <td><a href="{{ url('reservasi-mobil/show', $row->id) }}" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>
        <div class="tab-pane" id="riwayat" role="tabpanel">
            <div>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0" id="riwayatTable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Pemesan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Mobil</th>
                                <th scope="col">Supir</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservasi_mobil->where('id_status', 5) as $row)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
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
                                        <span class="badge rounded-pill text-bg-success">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 6)
                                        <span class="badge rounded-pill text-bg-danger">{{ $row->status->status }}</span>
                                        @elseif($row->id_status == 7)
                                        <span class="badge rounded-pill text-bg-danger">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 12)
                                        <span class="badge rounded-pill text-bg-warning">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 13)
                                        <span class="badge rounded-pill text-bg-warning">{{ $row->status->status }}</span>
                                        @elseif ($row->id_status == 14)
                                        <span class="badge rounded-pill text-bg-info">{{ $row->status->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $row->mobil->nama }}</td>
                                    <td>{{ $row->supir->nama }}</td>
                                    <td><a href="{{ url('reservasi-mobil/show', $row->id) }}" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>  
            
        </div>
        <div class="tab-pane" id="lihat_semua" role="tabpanel">
            <div>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0" id="lihat_semuaTable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Pemesan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Mobil</th>
                                <th scope="col">Supir</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><a href="#" class="fw-medium">#3120</a></th>
                                <td>DANI ALI CAHYADI</td>
                                <td><span class="badge rounded-pill text-bg-success">Selesai</span></td>
                                <td>INNOVA B 1806 HKR</td>
                                <td>M.TAUFIK HIDAYAT (KAPOL)</td>
                                <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>
    </div>
</div><!-- end card-body -->