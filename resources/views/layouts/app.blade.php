<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'OjjoEstates') - Real Estate</title>

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/jquery.selectBox.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/dropzone.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/rangeslider.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/leaflet.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/map.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/jquery.mCustomScrollbar.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/fonts/flaticon/font/flaticon.css') }}">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPlayfair+Display:400,700%7CRoboto:100,300,400,400i,500,700">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="{{ asset('assets/css/skins/default.css') }}">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom CSS -->
    @stack('styles')
</head>
<body id="top" class="index-body">
    <!-- Page loader -->
    <div class="page_loader"></div>

    <!-- Header -->
    @include('partials.header')

    <!-- Flash Messages -->
    @if(session('success') || session('error') || session('warning') || session('info'))
        <div class="flash-messages">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-triangle"></i> {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fa fa-info-circle"></i> {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        
        <style>
            .flash-messages {
                position: fixed;
                top: 80px;
                right: 20px;
                z-index: 1050;
                max-width: 400px;
            }
            
            .flash-messages .alert {
                margin-bottom: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                border: none;
                border-radius: 8px;
            }
            
            .flash-messages .alert i {
                margin-right: 8px;
            }
            
            @media (max-width: 768px) {
                .flash-messages {
                    top: 70px;
                    right: 10px;
                    left: 10px;
                    max-width: none;
                }
            }
        </style>
        
        <script>
            // Auto-hide flash messages after 5 seconds
            setTimeout(function() {
                $('.flash-messages .alert').fadeOut('slow');
            }, 5000);
        </script>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Vite assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- External JS libraries -->
    <script src="{{ asset('assets/js/jquery-2.2.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.selectBox.js') }}"></script>
    <script src="{{ asset('assets/js/rangeslider.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.filterizr.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/backstretch.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.countdown.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.scrollUp.js') }}"></script>
    <script src="{{ asset('assets/js/particles.min.js') }}"></script>
    <script src="{{ asset('assets/js/typed.min.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.mb.YTPlayer.js') }}"></script>
    <script src="{{ asset('assets/js/leaflet.js') }}"></script>
    <script src="{{ asset('assets/js/leaflet-providers.js') }}"></script>
    <script src="{{ asset('assets/js/leaflet.markercluster.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/maps.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4omYJlOaP814WDcCG8eubXcbhB-44Uac"></script>
    <script src="{{ asset('assets/js/ie-emulation-modes-warning.js') }}"></script>
    
    <!-- Custom JS Script (Main template JavaScript) -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    
    <!-- Custom Scripts -->
    <script>
        $(document).ready(function() {
            // Sidebar functionality
            $('#drawer-toggle, .humberger').on('click', function(e) {
                e.preventDefault();
                $('.nav-sidebar').addClass('sidebar-open');
                $('body').addClass('sidebar-active');
            });
            
            $('#dismiss').on('click', function() {
                $('.nav-sidebar').removeClass('sidebar-open');
                $('body').removeClass('sidebar-active');
            });
            
            // Close sidebar when clicking on overlay
            $(document).on('click', function(e) {
                if ($(e.target).hasClass('sidebar-active')) {
                    $('.nav-sidebar').removeClass('sidebar-open');
                    $('body').removeClass('sidebar-active');
                }
            });
        });
    </script>
</body>
</html> 