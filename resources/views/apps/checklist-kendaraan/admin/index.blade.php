@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<style>
    .green-background {
        background-color: rgb(0, 243, 0);
        border-radius: 10px;
    }
    .red-background {
        background-color: rgb(255, 58, 58);
        border-radius: 10px;
    }
</style>
@endsection
@section('page-content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ $title ? $title : '' }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $title ? $title : '' }}</a></li>
                            <li class="breadcrumb-item active">Index</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            @foreach ($mobil as $row)
                @php
                    $start_date = Carbon::createFromDate($year, $month, 1)->startOfMonth();
                    if ($start_date->dayOfWeek !== Carbon::MONDAY) {
                        $start_date->next(Carbon::MONDAY);
                    }
                    $end_date = $start_date->copy()->endOfMonth();
                    $weeklyInspections = \App\Models\ChecklistKendaraan::where('id_mobil', $row->id)
                        ->whereBetween('tgl_inspeksi', [$start_date, $end_date])
                        ->get()
                        ->groupBy(function ($inspection) {
                            return Carbon::parse($inspection->tgl_inspeksi)->weekOfYear;
                        });

                    $weeksInMonth = [];
                    $currentDate = $start_date->copy();
                    while ($currentDate->month == $month) {
                        $weekNumber = $currentDate->weekOfMonth;

                        $inspections = $weeklyInspections->get($currentDate->weekOfYear, []);

                        $weeksInMonth[] = [
                            'week_number' => $weekNumber,
                            'start_date' => $currentDate->copy()->startOfWeek(),
                            'end_date' => $currentDate->copy()->endOfWeek(),
                            'inspections' => $inspections,
                        ];

                        $currentDate->addWeek();
                    }
                @endphp
                {{-- {{ dd($weeksInMonth) }} --}}
                <div class="col-xxl-3 col-lg-4 col-sm-6 project-card">
                    <div class="card card-animate" style="cursor: pointer;" data-id="{{ Crypt::encrypt($row->id) }}" data-row="{{ $row }}" data-month="{{ $month }}" data-year="{{ $year }}">
                        <div class="card-body mt-2">
                            <div class="d-flex flex-column">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm">
                                            <span class="avatar-title bg-light-subtle rounded p-1">
                                                <img src="{{ asset('assets/img/icon-car.png') }}" alt="" class="img-fluid">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 fs-15">{{ $row->nama }}</h5>
                                        <p class="text-muted text-truncate-two-lines mb-3">{{ $row->driver->nama }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-auto justify-content-center">
                                @foreach ($weeksInMonth as $week)
                                    <div class="col-2 text-center">
                                        @if ($week['inspections'])
                                            @if ($week['inspections']->first()->id_status == 2)
                                                <span class="badge bg-success">W{{$week['week_number'] }}</span>
                                            @else
                                                <span class="badge bg-warning">W{{$week['week_number'] }}</span>
                                            @endif
                                        @else
                                            <span class="badge bg-danger">W{{$week['week_number'] }}</span>
                                        @endif
                                    </div>  
                                @endforeach
                            </div>  
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            @endforeach
        </div>
        <!-- end row -->

    </div>
    <!-- container-fluid -->
</div>
@endsection
@push('js')
<script>
    $(document).ready(function(){
        $('.card-animate').click(function(){
            let id = $(this).data('id');
            let row = $(this).data('row');
            let month = $(this).data('month');
            let year = $(this).data('year');
            if(row.id_supir == null){
                Toastify({
                    text: "Belum Memiliki PIC",
                    duration: 3000,
                    className: "info",
                    position: "center", // `left`, `center` or `right`
                    style: {
                        backgroundColor: "#FFA500" // Warna kuning tua
                    }
                }).showToast();
            }else{
                let url = "{{ url('checklist-kendaraan/show') }}/" + id + "/" + month + "/" + year;
                window.location.href = url;
            }
        });
    });
</script>
@endpush