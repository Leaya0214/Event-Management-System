<!DOCTYPE html>
<html lang="en">

<head>
    @include('BackEnd/includes/links')
    @yield('css')
</head>

<body class="sidebar-dark">
    <div class="main-wrapper">

        <!-- Sidebar -->
        
        @include('BackEnd/includes/sidebar')

        <div class="page-wrapper">
            <!-- Top Bar/Navbar -->
            @include('BackEnd/includes/navbar')

            <div class="page-content">
            <!--- Page Content Start -->
              @yield('content')

            </div>

            @include('BackEnd/includes/footer')
        </div>
    </div>
    @yield('js')

</body>

</html>
