<div class="card-body">
    <ul class="nav nav-tabs nav-border-top nav-border-top-info mb-3" role="tablist" id="myTab">
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#reservasi_hari_ini" role="tab" aria-selected="true">
                Reservasi Hari Ini <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('tgl_pergi', Carbon::today())) }}</span>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#konfirmasi_reservasi" role="tab" aria-selected="true">
                Konfirmasi Reservasi <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->whereBetween('id_status', [1, 3])) }}</span>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#riwayat" role="tab" aria-selected="false" tabindex="-1">
                Riwayat <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->whereBetween('id_status', [4, 14])) }}</span>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#lihat_semua" role="tab" aria-selected="false" tabindex="-1">
                Lihat Semua
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
                                    <th scope="row"><a href="#" class="fw-medium">3120</a></th>
                                    <td>Dani Ali Cahyadi</td>
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
                                <th scope="col">No</th>
                                <th scope="col">ID Pemesanan</th>
                                <th scope="col">Pemesan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Mobil</th>
                                <th scope="col">Supir</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservasi_mobil->whereIn('id_status', [1, 2, 3]) as $row)
                                <tr>
                                    <th scope="row"><a href="#" class="fw-medium">{{ $loop->iteration }}</a></th>
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
        <div class="tab-pane" id="riwayat" role="tabpanel">
            <div>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0" id="riwayatTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">ID Pemesanan</th>
                                <th scope="col">Pemesan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Mobil</th>
                                <th scope="col">Supir</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservasi_mobil->whereBetween('id_status', [4, 14]) as $row)
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
                                    <td><a href="javascript:void(0);" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
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