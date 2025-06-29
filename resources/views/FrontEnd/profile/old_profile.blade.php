<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Client Profile</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link rel="stylesheet" href="{{ asset('frontend/css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom py-3 px-4" style="background-color:#b1961d;"><a href="{{route('client-info')}}" style="text-decoration: none;color:black">Profile</a></div>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light text-light py-3 px-4" href="{{route('event-details')}}"
                    style="background-color:#121c3a">Event Details</a>
                <a class="list-group-item list-group-item-action list-group-item-light text-light py-3 px-4" href="{{route('payment-info')}}"
                    style="background-color:#121c3a">Payment Info</a>
                {{-- <a class="list-group-item list-group-item-action list-group-item-light text-light p-3" href="{{route('event-details')}}"
                    style="background-color:#b36363">Payment History</a> --}}
                <a class="list-group-item list-group-item-action list-group-item-light text-light py-3 px-4" href="{{route('artist-details')}}"
                    style="background-color:#121c3a">Artist Details</a>
                <a class="list-group-item list-group-item-action list-group-item-light text-light py-3 px-4" href="{{route('event-details')}}"
                    style="background-color:#121c3a">Experience</a>
                <a class="list-group-item list-group-item-action list-group-item-light text-light py-3 px-4" href="{{route('client-logout')}}"
                    style="background-color:#121c3a">Log Out</a>
            </div>
        </div>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn" id="sidebarToggle" style="background-color:#404e77; color:white"><i
                            class="fa-solid fa-arrow-left"></i></button>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><span
                            class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <a data-bs-toggle="modal"
                               data-bs-target="#exampleModal" class="btn" id="sidebarToggle" style="background-color:#b1961d; color:white">Book
                                New Event</a>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container-fluid">
                <div class="mt-3">
                    @yield('content')
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
            <script src="js/scripts.js"></script>
            <script>
                window.addEventListener('DOMContentLoaded', event => {
                    const sidebarToggle = document.body.querySelector('#sidebarToggle');
                    if (sidebarToggle) {
                        sidebarToggle.addEventListener('click', event => {
                            event.preventDefault();
                            document.body.classList.toggle('sb-sidenav-toggled');
                            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains(
                                'sb-sidenav-toggled'));
                        });
                    }
                });
            </script>
</body>

</html>
