@extends('layouts.app')
@section('css')
<script type='text/javascript' src='{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}'></script>
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
                            <li class="breadcrumb-item"><a href="{{ url('checklist-kendaraan') }}">{{ $title ? $title : '' }}</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <form action="{{ url('checklist-kendaraan/store') }}" method="POST" id="checklistForm">
            @csrf
            @include('apps.checklist-kendaraan.components.form')
            <div class="form-group mb-4">
                <input type="text" name="id_supir" value="{{ $supir->id }}" hidden>
                <input type="text" name="id_mobil" value="{{ $mobil->id }}" hidden>
                <a href="{{ url('checklist-kendaraan') }}" class="btn btn-warning"><span class="fe fe-arrow-left"></span> Kembali</a>
                <button id="btnSimpan" class="btn btn-primary" disabled><span class="fe fe-save"></span> Simpan</button>
            </div>
        </form>
    </div>
    <!-- container-fluid -->
</div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(){
        flatpickr(".tgl-inspeksi", {
                minDate: "today",
                maxDate: "today",
                altInput: true,
                altFormat: "F j, Y",
            });
        $('input[type="radio"]').change(function() {
            let kondisi = $(this).val();
            let formCheckDiv = $(this).closest('.form-check');
            let textarea = formCheckDiv.closest('tr').find('.keterangan-textarea');
            
            if ($(this).val() === "cacat") {
                // Hapus class d-none dari textarea
                textarea.removeClass('d-none');
            } else {
                // Jika tidak, tambahkan class d-none kembali ke textarea
                textarea.addClass('d-none');
                textarea.val('');
            }
        });
        let data = $('.tgl-inspeksi').data('row');
        $('.tgl-inspeksi').change(function(){
            let value = $(this).val();
            if(value > data){
                $('#alasan').removeClass('d-none');
            }else{
                $('#alasan').addClass('d-none');
            }
        })
    });
</script>
<script>
    // Function to confirm before saving using SweetAlert
    function confirmBeforeSave(event) {
        event.preventDefault();

        // Show confirmation dialog with SweetAlert
        Swal.fire({
            title: 'Apakah Anda yakin checklist sudah sesuai?',
            text: 'Pastikan semua terisi!',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value == true) {
                document.getElementById('checklistForm').submit();
            }
        });
    }

    // Add event listener to the Save button
    document.getElementById('btnSimpan').addEventListener('click', confirmBeforeSave);

    // Function to enable or disable the Save button based on form validity
    function toggleSaveButton() {
        var isValid = document.getElementById('checklistForm').checkValidity();
        document.getElementById('btnSimpan').disabled = !isValid;
    }

    // Add event listener to form inputs for validation
    var formInputs = document.querySelectorAll('#checklistForm input, #checklistForm select');
    formInputs.forEach(function(input) {
        input.addEventListener('input', toggleSaveButton);
    });
</script>
@endpush