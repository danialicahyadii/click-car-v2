<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Clickcar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('errors.components.style')
</head>

<body>

    <div class="auth-page-wrapper pt-5">
        @yield('content')

        @include('errors.components.footer')

    </div>
    <!-- end auth-page-wrapper -->

    @include('errors.components.scripts')

</body>

</html>