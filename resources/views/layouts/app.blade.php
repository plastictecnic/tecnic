<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Favicon-->
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="theme-blue">

    <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Please wait...</p>
            </div>
        </div>
        <!-- #END# Page Loader -->
        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>
        <!-- #END# Overlay For Sidebars -->
        <!-- Search Bar -->
        {{-- <div class="search-bar">
            <div class="search-icon">
                <i class="material-icons">search</i>
            </div>
            <input type="text" placeholder="START TYPING...">
            <div class="close-search">
                <i class="material-icons">close</i>
            </div>
        </div> --}}
        <!-- #END# Search Bar -->
        <!-- Top Bar -->
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar-collapse" aria-expanded="false"></a>
                    <a href="javascript:void(0);" class="bars"></a>
                    <a class="navbar-brand" href="{{route('home')}}"><img style="display:inline;" width="30px" src="{{asset('images/logo.png')}}" alt=""> PLASTICTECNIC SDN. BHD. <small>REG: 197601004542 (30481-V)</small></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Call Search -->
                        {{-- <li><a href="javascript:void(0);" class="js-search" data-close="true"><i
                                    class="material-icons">search</i></a></li> --}}
                        <!-- #END# Call Search -->
                        <!-- Notifications -->
                        @include('menus.notifications')
                        <!-- #END# Notifications -->
                        <!-- Tasks -->
                        {{-- @include('menus.tasks') --}}
                        <!-- #END# Tasks -->
                        {{-- <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i
                                    class="material-icons">more_vert</i></a></li> --}}
                    </ul>
                </div>
            </div>
        </nav>
        <!-- #Top Bar -->
        <section>
            <!-- Left Sidebar -->
            @include('menus.left-side')
            <!-- #END# Left Sidebar -->
            <!-- Right Sidebar -->
            {{-- @include('menus.right-side') --}}
            <!-- #END# Right Sidebar -->
        </section>

        <section class="content">
            @yield('content')
        </section>

        <script src="{{ asset('js/app.js') }}"></script>

        @yield('custom-js')
</body>
</html>
