<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BOOK-STORE') }}</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" href="https://imgur.com/ZOy8S6I.png">
    <link rel="shortcut icon" href="https://imgur.com/ZOy8S6I.png">

    <!-- Styles -->
    @include('admin.layouts.styles')
    @stack('styles')
</head>

<body>
    <!-- Left Panel -->
    @include('admin.layouts.sidebar')
    <!-- /Left Panel -->

    <!-- Right Panel -->
    <div class="right-panel">
        <!-- Search Bar -->
        <div class="header-search">
            <div class="search-container">
                <form action="#" method="GET" class="search-form">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search ..." name="search">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    @include('admin.layouts.footer')
    <!-- /Footer -->

    <!-- Scripts -->
    @include('admin.layouts.scripts')
    @stack('scripts')
</body>
</html>