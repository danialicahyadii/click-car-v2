@extends('layouts.app')
@section('css')
<script type='text/javascript' src='{{ URL::asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}'></script>
<script type='text/javascript' src='{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}'></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection
@section('page-content')
<div class="page-content">
    <div class="container-fluid">
        <div class="position-relative mx-n4 mt-n4">
            <div class="profile-wid-bg profile-setting-img">
                <input type="text" id="id" value="{{ $user->id }}" hidden>
                <img src="{{ URL::asset('assets/images/profile-bg.jpg') }}" class="profile-wid-img" alt="">
                <div class="overlay-content">
                    <div class="text-end p-3">
                        <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                            <input id="profile-foreground-img-file-input" type="file" class="profile-foreground-img-file-input">
                            <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light">
                                <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-3">
                <div class="card mt-n5">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                <img src="@if (!empty($user->photo_profile)) {{ URL::asset('profile-images/' . $user->photo_profile) }} @else {{ URL::asset('assets/img/icon-user.png') }}
                                @endif" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                                
                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                    <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title rounded-circle bg-light text-body">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->
            <div class="col-xxl-9">
                <div class="card mt-xxl-n5">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                    <i class="fas fa-home"></i> Personal Details
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#privacy" role="tab">
                                    <i class="far fa-envelope"></i> Privacy Policy
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                <form action="javascript:void(0);">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="firstnameInput" class="form-label">Nama</label>
                                                <input type="text" class="form-control" value="{{ $user->name }}" name="nama" placeholder="Enter your firstname">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Nomor Handphone</label>
                                                <input type="text" class="form-control" name="nomor_hp" placeholder="Enter your phone number" value="+{{ $user->nomor_hp }}">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">Jenis Kelamin</label>
                                                <div class="mt-2 align-self-center">
                                                    <div class="form-check mb-2 form-check-inline">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" name="jk" @if (!empty($user->supir->jk)) @if ($user->supir->jk == 'l') checked @endif @endif>
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Laki - laki
                                                        </label>
                                                    </div>
    
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" name="jk" @if (!empty($user->supir->jk)) @if ($user->supir->jk == 'p') checked @endif @endif>
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            Perempuan
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">Tempat</label>
                                                <input type="text" class="form-control" name="tempat" placeholder="Tempat Kelahiran" value="@if (!empty($user->supir->tempat)) {{ $user->supir->tempat }} @endif">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">Tanggal Lahir</label>
                                                <input type="text" class="form-control" data-provider="flatpickr" name="ttl" data-date-format="d M, Y" data-deafult-date="{{ Carbon::createFromFormat('Y-m-d', $user->supir->ttl)->format('d M, Y') }}" placeholder="Select date" />
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="skillsInput" class="form-label">Surat Izin Mengendarai (SIM)</label>
                                                <select class="form-control" name="sim[]" data-choices data-choices-text-unique-true multiple>
                                                    <option value="SIM A" {{ in_array('SIM A', json_decode($user->supir->sim)) ? 'selected' : '' }}>SIM A</option>
                                                    <option value="SIM B" {{ in_array('SIM B', json_decode($user->supir->sim)) ? 'selected' : '' }}>SIM B</option>
                                                    <option value="SIM B2" {{ in_array('SIM B2', json_decode($user->supir->sim)) ? 'selected' : '' }}>SIM B2</option>
                                                    <option value="SIM C" {{ in_array('SIM C', json_decode($user->supir->sim)) ? 'selected' : '' }}>SIM C</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="designationInput" class="form-label">Jenis SIM A</label>
                                                <select class="form-control" name="jenis_sim" data-choices data-choices-text-unique-true data-choices-search-false data-choices-sorting-false>
                                                    <option value="" disabled selected>Pilih Tipe SIM</option>
                                                    <option value="2" {{ $user->supir->jenis_sim == 1 ? 'selected' : '' }}>Perorangan</option>
                                                    <option value="1" {{ $user->supir->jenis_sim == 2 ? 'selected' : '' }}>Umum</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="JoiningdatInput" class="form-label">Masa Berlaku SIM A</label>
                                                <input type="text" class="form-control" name="habis_sim" data-provider="flatpickr" data-date-format="d M, Y" data-deafult-date="{{ Carbon::createFromFormat('Y-m-d', $user->supir->habis_sim)->format('d M, Y') }}" placeholder="Select date" />
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea" class="form-label">Alamat Tempat Tinggal</label>
                                                <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat" rows="3">{{ $user->supir->alamat }}</textarea>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="mb-3 pb-2">
                                                <label for="exampleFormControlTextarea" class="form-label">Alamat Sesuai KTP</label>
                                                <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat sesuai KTP" rows="3">{{ $user->supir->alamat }}</textarea>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <button type="button" class="btn btn-soft-success">Cancel</button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                            <div class="tab-pane" id="privacy" role="tabpanel">
                                <div class="mb-4 pb-2">
                                    <h5 class="card-title text-decoration-underline mb-3">Security:</h5>
                                    <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0">
                                        <div class="flex-grow-1">
                                            <h6 class="fs-14 mb-1">Two-factor Authentication</h6>
                                            <p class="text-muted">Two-factor authentication is an enhanced security meansur. Once enabled, you'll be required to give two types of identification when you log into Google Authentication and SMS are Supported.</p>
                                        </div>
                                        <div class="flex-shrink-0 ms-sm-3">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-primary">Enable Two-facor Authentication</a>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0 mt-2">
                                        <div class="flex-grow-1">
                                            <h6 class="fs-14 mb-1">Secondary Verification</h6>
                                            <p class="text-muted">The first factor is a password and the second commonly includes a text with a code sent to your smartphone, or biometrics using your fingerprint, face, or retina.</p>
                                        </div>
                                        <div class="flex-shrink-0 ms-sm-3">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-primary">Set up secondary method</a>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0 mt-2">
                                        <div class="flex-grow-1">
                                            <h6 class="fs-14 mb-1">Backup Codes</h6>
                                            <p class="text-muted mb-sm-0">A backup code is automatically generated for you when you turn on two-factor authentication through your iOS or Android Twitter app. You can also generate a backup code on twitter.com.</p>
                                        </div>
                                        <div class="flex-shrink-0 ms-sm-3">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-primary">Generate backup codes</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <h5 class="card-title text-decoration-underline mb-3">Application Notifications:</h5>
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-flex">
                                            <div class="flex-grow-1">
                                                <label for="directMessage" class="form-check-label fs-14">Direct messages</label>
                                                <p class="text-muted">Messages from people you follow</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="directMessage" checked />
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex mt-2">
                                            <div class="flex-grow-1">
                                                <label class="form-check-label fs-14" for="desktopNotification">
                                                    Show desktop notifications
                                                </label>
                                                <p class="text-muted">Choose the option you want as your default setting. Block a site: Next to "Not allowed to send notifications," click Add.</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="desktopNotification" checked />
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex mt-2">
                                            <div class="flex-grow-1">
                                                <label class="form-check-label fs-14" for="emailNotification">
                                                    Show email notifications
                                                </label>
                                                <p class="text-muted"> Under Settings, choose Notifications. Under Select an account, choose the account to enable notifications for. </p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="emailNotification" />
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex mt-2">
                                            <div class="flex-grow-1">
                                                <label class="form-check-label fs-14" for="chatNotification">
                                                    Show chat notifications
                                                </label>
                                                <p class="text-muted">To prevent duplicate mobile notifications from the Gmail and Chat apps, in settings, turn off Chat notifications.</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="chatNotification" />
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex mt-2">
                                            <div class="flex-grow-1">
                                                <label class="form-check-label fs-14" for="purchaesNotification">
                                                    Show purchase notifications
                                                </label>
                                                <p class="text-muted">Get real-time purchase alerts to protect yourself from fraudulent charges.</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="purchaesNotification" />
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h5 class="card-title text-decoration-underline mb-3">Delete This Account:</h5>
                                    <p class="text-muted">Go to the Data & Privacy section of your profile Account. Scroll to "Your data & privacy options." Delete your Profile Account. Follow the instructions to delete your account :</p>
                                    <div>
                                        <input type="password" class="form-control" id="passwordInput" placeholder="Enter your password" value="make@321654987" style="max-width: 265px;">
                                    </div>
                                    <div class="hstack gap-2 mt-3">
                                        <a href="javascript:void(0);" class="btn btn-soft-danger">Close & Delete This Account</a>
                                        <a href="javascript:void(0);" class="btn btn-light">Cancel</a>
                                    </div>
                                </div>
                            </div>
                            <!--end tab-pane-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div>
    <!-- container-fluid -->
</div><!-- End Page-content -->
@endsection
@push('js')
<script src="{{ asset('assets/js/pages/profile-setting.init.js') }}"></script>
@endpush