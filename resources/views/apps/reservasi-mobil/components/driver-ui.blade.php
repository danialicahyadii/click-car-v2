<div class="card-body">
    <ul class="nav nav-tabs nav-border-top nav-border-top-info mb-3" role="tablist" id="myTab">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" data-bs-toggle="tab" href="#reservasi_hari_ini" role="tab" aria-selected="true">
                Reservasi Hari Ini @if (count($reservasi_mobil->where('tgl_pergi', Carbon::today()->isoFormat('Y-MM-DD'))) > 0)
                <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('tgl_pergi', Carbon::today()->isoFormat('Y-MM-DD'))) }}</span>
                @endif
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#konfirmasi_reservasi" role="tab" aria-selected="true">
                Konfirmasi Reservasi @if (count($reservasi_mobil->whereIn('id_status', [4, 14, 13])) > 0)
                <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->whereIn('id_status', [4, 13, 14])) }}</span>
                @endif
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#riwayat" role="tab" aria-selected="false" tabindex="-1">
                Riwayat @if(count($reservasi_mobil->where('id_status', 5)) > 0)
                <span class="badge bg-danger rounded-circle">{{ count($reservasi_mobil->where('id_status', 5)) }}</span>
            @endif
            </a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content text-muted">
        <div class="tab-pane active" id="reservasi_hari_ini" role="tabpanel">
            <div>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0" id="reservasi_hari_iniTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Pemesan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Mobil</th>
                                <th scope="col">Waktu Berangkat</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservasi_mobil->where('tgl_pergi', Carbon::today()->isoFormat('Y-MM-DD')) as $row)
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
                                    <td>{{ Carbon::parse($row->waktu_keberangkatan)->format('h:i T') }}</td>
                                    <td><a href="{{ url('reservasi-mobil/show', $row->kode_pemesanan) }}" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
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
                                <th scope="col">Pemesan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Mobil</th>
                                <th scope="col">Tgl Pergi</th>
                                <th scope="col">Tgl Pulang</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservasi_mobil->whereIn('id_status', [4, 13, 14]) as $row)
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
                                    <td>{{ $row->mobil->nama }}</td>
                                    <td>{{ Carbon::parse($row->waktu_keberangkatan)->format('F, d Y h:i A T') }}</td>
                                    <td>{{ Carbon::parse($row->waktu_penyelesaian)->format('F, d Y h:i A T') }}</td>
                                    <td><a href="{{ url('reservasi-mobil/show', $row->kode_pemesanan) }}" class="link-success">View More <i class="ri-arrow-right-line align-middle"></i></a></td>
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
                                <th scope="col">Pemesan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Mobil</th>
                                <th scope="col">Tgl Pergi</th>
                                <th scope="col">Tgl Pulang</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservasi_mobil->where('id_status', 5) as $row)
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
                                    <td>
                                        {{ Carbon::parse($row->waktu_keberangkatan)->format('d F, Y h:i T') }}
                                    </td>
                                    <td>
                                        {{ Carbon::parse($row->waktu_penyelesaian)->format('d F, Y h:i T') }}
                                    </td>
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