@extends('layouts.guest')
@section('content')
<div class="auth-page-content overflow-hidden pt-lg-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card overflow-hidden">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="p-lg-5 p-4 auth-one-bg h-100">
                                <div class="bg-overlay"></div>
                                <div class="position-relative h-100 d-flex flex-column">
                                    {{-- <div class="mb-4 float-end">
                                        <a href="index.html" class="d-block">
                                            <img src="{{ asset('assets/img/logo.png') }}" alt="" height="45">
                                        </a>
                                    </div> --}}
                                    <div class="mt-auto">
                                        <div class="mb-3">
                                            <i class="ri-double-quotes-l display-4 text-success"></i>
                                        </div>

                                        <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-indicators">
                                                <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                            </div>
                                            <div class="carousel-inner text-center text-white-50 pb-5">
                                                <div class="carousel-item active">
                                                    <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                </div>
                                                <div class="carousel-item">
                                                    <p class="fs-15 fst-italic">" The theme is really great with an amazing customer support."</p>
                                                </div>
                                                <div class="carousel-item">
                                                    <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end carousel -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-lg-6">
                            <div class="p-lg-5 p-4">
                                <div class="text-center">
                                    <img src="{{ asset('assets/img/logo.png') }}" alt="" height="40">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Masukan data akun login Anda.</p>
                                </div>

                                <div class="mt-4 mb-5">
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                                        </div>

                                        <div class="mb-4">
                                            <div class="float-end">
                                                <a href="{{ route('password.request') }}" class="text-muted">Lupa password?</a>
                                            </div>
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-4">
                                                <input type="password" class="form-control pe-5 password-input" name="password" placeholder="Masukkan Password" id="password-input" required autocomplete="current-password">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>
{{-- 
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div> --}}

                                        <div class="mt-4 mb-5">
                                            <button class="btn btn-success w-100" type="submit">Masuk</button>
                                        </div>

                                        <div class="mt-4 text-center">
                                            <div class="signin-other-title">
                                                <h5 class="fs-13 mb-4 title"></h5>
                                            </div>

                                            {{-- <div>
                                                <img src="{{ asset('assets/img/logo-bumn.png') }}" alt="" height="25" style="margin-top:12px">
                                                <span class="m-4"></span>
                                                <img src="{{ asset('assets/img/logo-kimiafarma.png') }}" alt="" height="35">
                                            </div> --}}
                                        </div>

                                    </form>
                                </div>

                                {{-- <div class="mt-5 text-center">
                                    <p class="mb-0">Don't have an account ? <a href="auth-signup-cover.html" class="fw-semibold text-primary text-decoration-underline"> Signup</a> </p>
                                </div> --}}
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
@endsection