
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet"
        href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
        integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesgeet"
        href="https://rawgit.com/creativetimofficial/material-kit/master/assets/css/material-kit.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

</head>
<style>
    html * {
        -webkit-font-smoothing: antialiased;
    }

    .h6,
    h6 {
        font-size: .75rem !important;
        font-weight: 500;
        font-family: Roboto, Helvetica, Arial, sans-serif;
        line-height: 1.5em;
        text-transform: uppercase;
    }

    .name h6 {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .navbar {
        border: 0;
        border-radius: 3px;
        padding: .625rem 0;
        margin-bottom: 20px;
        color: #555;
        background-color: #fff !important;
        box-shadow: 0 4px 18px 0 rgba(0, 0, 0, .12), 0 7px 10px -5px rgba(0, 0, 0, .15) !important;
        z-index: 1000 !important;
        transition: all 150ms ease 0s;

    }

    .navbar.navbar-transparent {
        z-index: 1030;
        background-color: transparent !important;
        box-shadow: none !important;
        padding-top: 25px;
        color: #fff;
    }

    .navbar .navbar-brand {
        position: relative;
        color: inherit;
        height: 50px;
        font-size: 1.125rem;
        line-height: 30px;
        padding: .625rem 0;
        font-weight: 300;
        -webkit-font-smoothing: antialiased;
    }

    .navbar .navbar-nav .nav-item .nav-link:not(.btn) .material-icons {
        margin-top: -7px;
        top: 3px;
        position: relative;
        margin-right: 3px;
    }

    .navbar .navbar-nav .nav-item .nav-link .material-icons {
        font-size: 1.25rem;
        max-width: 24px;
        margin-top: -1.1em;
    }

    .navbar .navbar-nav .nav-item .nav-link .fa,
    .navbar .navbar-nav .nav-item .nav-link .material-icons {
        font-size: 1.25rem;
        max-width: 24px;
        margin-top: 0px;
    }

    .navbar .navbar-nav .nav-item .nav-link {
        position: relative;
        color: inherit;
        padding: .9375rem;
        font-weight: 400;
        font-size: 12px;
        border-radius: 3px;
        line-height: 20px;
    }

    a .material-icons {
        vertical-align: middle;
    }

    .fixed-top {
        position: fixed;
        z-index: 1030;
        left: 0;
        right: 0;
    }

    .profile-page .page-header {
        height: 380px;
        background-position: center;
    }

    .page-header {
        height: 100vh;
        background-size: cover;
        margin: 0;
        padding: 0;
        border: 0;
        display: flex;
        align-items: center;
    }

    .header-filter:after,
    .header-filter:before {
        position: absolute;
        z-index: 1;
        width: 100%;
        height: 100%;
        display: block;
        left: 0;
        top: 0;
        content: "";
    }

    .header-filter::before {
        background: #4b4a4b;
    }

    .main-raised {
        margin: -60px 30px 0;
        border-radius: 6px;
        box-shadow: 0 16px 24px 2px rgba(0, 0, 0, .14), 0 6px 30px 5px rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2);
    }

    .main {
        background: #FFF;
        position: relative;
        z-index: 3;
    }

    .profile-page .profile {
        text-align: center;
    }

    .profile-page .profile img {
        max-width: 160px;
        width: 100%;
        margin: 0 auto;
        -webkit-transform: translate3d(0, -50%, 0);
        -moz-transform: translate3d(0, -50%, 0);
        -o-transform: translate3d(0, -50%, 0);
        -ms-transform: translate3d(0, -50%, 0);
        transform: translate3d(0, -50%, 0);
    }

    .img-raised {
        box-shadow: 0 5px 15px -8px rgba(0, 0, 0, .24), 0 8px 10px -5px rgba(0, 0, 0, .2);
    }

    .rounded-circle {
        border-radius: 50% !important;
    }

    .img-fluid,
    .img-thumbnail {
        max-width: 100%;
        height: auto;
    }

    .title {
        margin-top: 30px;
        margin-bottom: 30px;
        min-height: 32px;
        color: #3C4858;
        font-weight: 700;
        font-family: "Roboto Slab", "Times New Roman", serif;
    }

    .profile-page .description {
        margin: 1.071rem auto 0;
        max-width: 600px;
        color: #201f1f;
        font-weight: 300;
    }

    p {
        font-size: 14px;
        margin: 0 0 10px;
    }

    .profile-page .profile-tabs {
        margin-top: 4.284rem;
    }

    .nav-pills,
    .nav-tabs {
        border: 0;
        border-radius: 3px;
        padding: 0 15px;
    }

    .nav .nav-item {
        position: relative;
        margin: 0 2px;
    }

    .nav-pills.nav-pills-icons .nav-item .nav-link {
        border-radius: 4px;
    }

    .nav-pills .nav-item .nav-link.active {
        color: #fff;
        background-color: #dabf29;
        box-shadow: 0 5px 20px 0 rgba(0, 0, 0, .2), 0 13px 24px -11px #dabf29;
    }

    .nav-pills .nav-item .nav-link {
        line-height: 24px;
        font-size: 12px;
        font-weight: 500;
        min-width: 100px;
        color: #555;
        transition: all .3s;
        border-radius: 30px;
        padding: 10px 15px;
        text-align: center;
    }

    .nav-pills .nav-item .nav-link:not(.active):hover {
        background-color: rgba(200, 200, 200, .2);
    }


    .nav-pills .nav-item i {
        display: block;
        font-size: 30px;
        padding: 15px 0;
    }

    .tab-space {
        padding: 20px 0 50px;
    }

    .profile-page .gallery {
        margin-top: 3.213rem;
        padding-bottom: 20px;
    }

    .profile-page .gallery img {
        width: 100%;
        margin-bottom: 2.142rem;
    }

    .profile-page .profile .name {
        margin-top: -80px;
    }

    img.rounded {
        border-radius: 6px !important;
    }

    .tab-content>.active {
        display: block;
    }

    /*buttons*/
    .btn {
        position: relative;
        padding: 12px 30px;
        margin: .3125rem 1px;
        font-size: .75rem;
        font-weight: 400;
        line-height: 1.428571;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 0;
        border: 0;
        border-radius: .2rem;
        outline: 0;
        transition: box-shadow .2s cubic-bezier(.4, 0, 1, 1), background-color .2s cubic-bezier(.4, 0, .2, 1);
        will-change: box-shadow, transform;
    }

    .btn.btn-just-icon {
        font-size: 20px;
        height: 41px;
        min-width: 41px;
        width: 41px;
        padding: 0;
        overflow: hidden;
        position: relative;
        line-height: 41px;
    }

    .btn.btn-just-icon fa {
        margin-top: 0;
        position: absolute;
        width: 100%;
        transform: none;
        left: 0;
        top: 0;
        height: 100%;
        line-height: 41px;
        font-size: 20px;
    }

    .btn.btn-link {
        background-color: transparent;
        color: #999;
    }

    /* dropdown */

    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
        float: left;
        min-width: 11rem !important;
        margin: .125rem 0 0;
        font-size: 1rem;
        color: #212529;
        text-align: left;
        background-color: #fff;
        background-clip: padding-box;
        border-radius: .25rem;
        transition: transform .3s cubic-bezier(.4, 0, .2, 1), opacity .2s cubic-bezier(.4, 0, .2, 1);
    }

    .dropdown-menu.show {
        transition: transform .3s cubic-bezier(.4, 0, .2, 1), opacity .2s cubic-bezier(.4, 0, .2, 1);
    }


    .dropdown-menu .dropdown-item:focus,
    .dropdown-menu .dropdown-item:hover,
    .dropdown-menu a:active,
    .dropdown-menu a:focus,
    .dropdown-menu a:hover {
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .14), 0 7px 10px -5px #dabf29;
        background-color: #dabf29;
        color: #FFF;
    }

    .show .dropdown-toggle:after {
        transform: rotate(180deg);
    }

    .dropdown-toggle:after {
        will-change: transform;
        transition: transform .15s linear;
    }


    .dropdown-menu .dropdown-item,
    .dropdown-menu li>a {
        position: relative;
        width: auto;
        display: flex;
        flex-flow: nowrap;
        align-items: center;
        color: #333;
        font-weight: 400;
        text-decoration: none;
        font-size: .8125rem;
        border-radius: .125rem;
        margin: 0 .3125rem;
        transition: all .15s linear;
        min-width: 7rem;
        padding: 0.625rem 1.25rem;
        min-height: 1rem !important;
        overflow: hidden;
        line-height: 1.428571;
        text-overflow: ellipsis;
        word-wrap: break-word;
    }

    .dropdown-menu.dropdown-with-icons .dropdown-item {
        padding: .75rem 1.25rem .75rem .75rem;
    }

    .dropdown-menu.dropdown-with-icons .dropdown-item .material-icons {
        vertical-align: middle;
        font-size: 24px;
        position: relative;
        margin-top: -4px;
        top: 1px;
        margin-right: 12px;
        opacity: .5;
    }

    /* footer */

    footer {
        margin-top: 10px;
        color: #555;
        padding: 25px;
        font-weight: 300;

    }

    .footer p {
        margin-bottom: 0;
        font-size: 14px;
        margin: 0 0 10px;
        font-weight: 300;
    }

    footer p a {
        color: #555;
        font-weight: 400;
    }

    footer p a:hover {
        color: #dabf29;
        text-decoration: none;
    }
</style>

<body class="profile-page">
     <nav class="navbar navbar-color-on-scroll navbar-transparent fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
        <div class="container">
            <a class="navbar-brand" href="" target="_blank">Bridal Harmony</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('client-logout') }}" style="text-decoration: none; font-weight: 800; color: white;">Logout <i class="fa fa-arrow-circle-right"></i></a></li>
                </ul>
            </div>
            <div class="ml-auto d-lg-none">
                <a class="nav-link" href="{{ route('client-logout') }}" style="text-decoration: none; font-weight: 800; color: white;">Logout <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </nav>

    <div class="page-header header-filter" data-parallax="true"
        style="background-image:url('http://wallpapere.org/wp-content/uploads/2012/02/black-and-white-city-night.png');">
    </div>
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                        <div class="profile">
                            <div class="avatar">
                                <img src="{{ asset('frontend/images/pp.jpg') }}" alt="Circle Image"
                                    class="img-raised rounded-circle img-fluid">
                            </div>
                            <div class="name">
                                <h3 class="title">{{ $clientInfo->name }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <div class="card card-sm">
                            <div class="card-header bg-primary text-center text-white" style="padding: 0.2rem">
                                <h5 class="pt-2">About Me</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-column" style="font-size: 14px;">
                                    <div class="mt-2">
                                        <label class="form-label text-dark col-sm-4"><strong>Address </strong></label>
                                        <label class="form-label text-dark col-sm-1"><strong>:</strong></label>
                                        <label class="form-label text-crimson"
                                            style="color: #852e40">{{ $clientInfo->address }}</label><br>

                                        <label class="form-label text-dark col-sm-4"><strong>Contact Number
                                            </strong></label>
                                        <label class="form-label text-dark col-sm-1"><strong> : </strong></label>
                                        <label class="form-label text-crimson"
                                            style="color: #852e40">{{ $clientInfo->primary_no }}</label><br>

                                        <label class="form-label text-dark col-sm-4"><strong>Alternate Number
                                            </strong></label>
                                        <label class="form-label text-dark col-sm-1"><strong>:</strong></label>
                                        <label class="form-label text-crimson"
                                            style="color: #852e40">{{ $clientInfo->alternate_no }}</label><br>

                                        <label class="form-label text-dark col-sm-4"><strong>Email </strong></label>
                                        <label class="form-label text-dark col-sm-1"><strong> :</strong></label>
                                        <label class="form-label text-crimson"
                                            style="color: #852e40">{{ $clientInfo->email }}</label><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ml-auto mr-auto">
                        <div class="card" style="height: 200px">
                            <div class="card-header bg-success text-center text-white" style="padding: 0.2rem">
                                <h5 class="pt-2">At a Glance</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-column" style="font-size: 14px;">
                                    <div class="mt-2">
                                        <label class="form-label text-dark text-center col-sm-12">
                                            <h4>Total Event </h4>
                                        </label>
                                        @php
                                            $eventDetails = collect();
                                        @endphp
                                        @foreach ($events as $v_event)
                                            @php

                                                $details = App\Models\BackEnd\EventDetails::where(
                                                    'master_id',
                                                    $v_event->id,
                                                )
                                                    ->whereNotIn('status', [0, 2])
                                                    ->get();
                                                $eventDetails = $eventDetails->merge($details);
                                            @endphp
                                        @endforeach

                                        <label class="form-label text-crimson col-sm-12 text-center"
                                            style="color: #852e40; font-size:30px;">{{ count($eventDetails) }}</label><br>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <a href="#!" style="text-decoration: none; color:black">See More<i
                                        class="fa fa-arrow-right pl-2" style="color: #852e40"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <div class="profile-tabs">
                            <ul class="nav nav-pills nav-pills-icons justify-content-center" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#event" role="tab" data-toggle="tab">
                                        <i class="material-icons">settings</i>
                                        Event Details
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#payments" role="tab" data-toggle="tab">
                                        <i class="material-icons">payments</i>
                                        Payment Details
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#artist" role="tab" data-toggle="tab">
                                        <i class="material-icons">favorite</i>
                                        Artist Details
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#share" role="tab" data-toggle="tab">
                                        <i class="material-icons">share</i>
                                        Share Experience
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="tab-content tab-space">
                    <div class="tab-pane active text-center gallery" id="event">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" style="background: #947bb4">
                                        <h4 class="text-light text-center">Event Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="studioTable"
                                                data-table="true">
                                                <thead>
                                                    <tr style="font-size: 13px;">
                                                        <th>#</th>
                                                        <th>Event Date</th>
                                                        <th>Venue</th>
                                                        <th>Event Type</th>
                                                        <th>Event Time</th>
                                                        <th>Package Name</th>
                                                        <th>Package Details</th>
                                                         <th>Add Selection & View Details</th>
                                                        <th>Delivery Date</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>


                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <style>
                        ul li {
                            list-style: none;
                        }
                    </style>
                    <div class="tab-pane text-center gallery" id="payments">
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <div class="card">
                                    <div class="card-header" style="background: #3979c2">
                                        <h4 class="text-light text-center">Payment Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="paymentTable"
                                                width="100%">
                                                <thead>
                                                    <tr style="font-size: 13px;">
                                                        <th>#</th>
                                                        <th>Booking No.</th>
                                                        <th>Total Payment</th>
                                                        <th>Total Paid</th>
                                                        <th>Total Due</th>
                                                        <th>View Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane text-center gallery" id="artist">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" style="background: #1b8e92">
                                        <h4 class="text-light text-center">Artist Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-sm">
                                                <thead>
                                                    <tr style="font-size: 13px;">
                                                        <th>#</th>
                                                        <th>Event Date</th>
                                                        <th>Venue</th>
                                                        <th>Event Time</th>
                                                        <th>Photographer Info</th>
                                                        <th>Cinematographer Info</th>
                                                        <th>Photo Editor Name</th>
                                                        <th>Video Editor Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $sl =0; @endphp
                                                    @foreach ($uniqueDetailsIds as $id)
                                                        @php
                                                            $event = App\Models\BackEnd\EventDetails::where(
                                                                'id',
                                                                $id,
                                                            )->first();
                                                            $assign_event = App\Models\BackEnd\EventDetailsLog::where(
                                                                'event_details_id',
                                                                $id,
                                                            )->get();
                                                        @endphp
                                                        <tr style="font-size:14px">
                                                            <td>{{ ++$sl }}</td>
                                                            <td width="10%">{{ $event->date }}</td>
                                                            <td width="20%">{{ $event->venue }}</td>
                                                            <td width="7%">{{ $event->start_time }}</td>
                                                            <td width="20%">
                                                                @foreach ($assign_event as $v_event)
                                                                    @if ($v_event->status == 1)
                                                                        <strong>Name : </strong>
                                                                        {{ $v_event->user->name }}
                                                                        <br>
                                                                        <strong>Contact No : </strong>
                                                                        {{ $v_event->user->phone }} <br>
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td width="20%">
                                                                @foreach ($assign_event as $v_event)
                                                                    @if ($v_event->status == 2)
                                                                        <strong>Name : </strong>
                                                                        {{ $v_event->user->name }}
                                                                        <br>
                                                                        <strong>Contact No: </strong>
                                                                        {{ $v_event->user->phone }} <br>
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td width="20%">
                                                                @foreach ($assign_event as $v_event)
                                                                    @if ($v_event->status == 3)
                                                                        <strong>Name : </strong>
                                                                        {{ $v_event->user->name }}<br>
                                                                        <strong>Contact No: </strong>
                                                                        {{ $v_event->user->phone }}<br>
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td width="20%">
                                                                @foreach ($assign_event as $v_event)
                                                                    @if ($v_event->status == 4)
                                                                        <strong>Name : </strong>
                                                                        {{ $v_event->user->name }}<br>
                                                                        <strong>Contact No: </strong>
                                                                        {{ $v_event->user->phone }}<br>
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane text-center gallery" id="share">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" style="background: #0f9f50">
                                        <h4 class="text-light text-center">Share Your Experice</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-sm"
                                                id="shareExperience" width="100%">
                                                <thead>
                                                    <tr style="font-size: 13px;" class="text-center">
                                                        <th>#</th>
                                                        <th>Event Date</th>
                                                        <th>Venue</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @foreach ($events as $event)
        @php
            $details = App\Models\BackEnd\EventDetails::where('master_id', $event->id)
                ->whereNotIn('status', [0, 2])
                ->get();
        @endphp
        @foreach ($details as $detail)
            <div class="modal fade" id="exampleModal-{{ $detail->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title" id="exampleModalLabel">Give Your Selection</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"
                                aria-label="Close">X</button>
                        </div>
                        <form action="{{ route('store-info') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- @isset($system) value="{{$system->title}}" @endisset  --}}
                            <div class="modal-body">
                                <input type="hidden" name="event_id" value="{{ $detail->id }}">
                                <div class="form-group row pt-3">
                                    <div class="col-sm-12">
                                        <label for="image" class="form-label text-bold"><strong>Photo Selection
                                                Giving Process:</strong> </label>
                                    </div>
                                    @if ($detail->package->type->id == 4 || $detail->package->type->id == 5 || $detail->package->type->id == 6)
                                        <style>
                                            .note-toolbar {
                                                background-color: rgb(57, 60, 61) !important;
                                            }
                                        </style>
                                        <div class="col-sm-12">
                                            <textarea name="photo_selection" class="form-control border pt-2 pl-2 " id="photo_selection" cols="20"
                                                rows="6"
                                                placeholder="You can give us photo number of upload selected photos to a
                                                        drive & give that drive link here ">
                                            @if ($detail->photo_selection != null)
{!! $detail->photo_selection !!}
@endif
                                            </textarea>
                                        </div>
                                </div>
        @endif
        @if ($detail->package->type->id == 4 || $detail->package->type->id == 6)
            <div class="form-group row pt-3">
                <div class="col-sm-12">
                    <label for="position" class="form-label text-bold"><strong>Video Song Selection Process
                            :</strong></label>
                    <label for="" class="form-label">:</label>
                </div>
                <style>
                    .note-editor .note-toolbar,
                    .note-popover .popover-content {
                        background: #4b4a4b !important;
                    }
                </style>
                <div class="col-sm-12">
                    <textarea name="video_selection" class="form-control border pt-2 pl-2 " id="video_selection" cols="20"
                        rows="6"
                        placeholder=" Give us you tube song link here. Atleast 1 song for trailer & 7-8
                                                    song for Cine Edit.">
                                    @if ($detail->video_selection != null)
{!! $detail->video_selection !!}
@endif
                                    </textarea>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <p style="color: #b80a0a">NB:: Give this selection as soon as possible. If you give us selection lately
                    then final edit will be
                    late.</p>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <P>For any other query Contact with us : +88 0177171 1590 or +88 0174222 5584</P>
            </div>
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
        </div>
        </div>
        </div>
           <div class="modal fade" id="details-{{ $detail->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title" id="exampleModalLabel">Event Details</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"
                                aria-label="Close">X</button>
                        </div>
                        <style>
                            .modal-body {
                                word-wrap: break-word;
                                overflow-y: auto;
                            }
                        </style>
                        <div class="modal-body">
                        <div class="form-group row pt-3 pl-2">
                            <label class="col-sm-2 p-1">Event Date</label>
                            <label class="col-sm-1 p-1">:</label>
                            <div class="col-md-3 p-1">
                                {{ $detail->date }}
                            </div>
                        </div>
                        <div class="form-group row pt-3 pl-2">
                            <label class="col-sm-2 p-1">Venue</label>
                            <label class="col-sm-1 p-1">:</label>
                            <div class="col-md-3 p-1">
                                {{ $detail->venue }}
                            </div>
                            
                        </div>
                        <div class="form-group row pt-3 pl-2">
                            <label class="col-sm-2 p-1">Add Ons</label>
                            <label class="col-sm-1 p-1">:</label>
                            @if($detail->add_ons)
                                <div class="col-md-6 p-1">
                                    {{ $detail->add_ons }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group row pt-3 pl-2">
                            <label class="col-sm-2 p-1">Instructions</label>
                            <label class="col-sm-1 p-1">:</label>
                            @if($detail->event->instructions)
                            <div class="col-md-3 p-1">
                                {{$detail->event->instructions }}
                            </div>
                            @endif
                        </div>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                   
                    </div>
                </div>
            </div>
        @php

            $artists = App\Models\BackEnd\EventDetailsLog::where('event_details_id', $detail->id)->get();

            $reviews = App\Models\CustomerExperience::where('detail_id', $detail->id)->get();
            $artistReviews = App\Models\BackEnd\PhotographerExperience::where('event_detail_id', $detail->id)->get();
        @endphp

        <div class="modal fade experienceModal-{{ $detail->id }}" id="" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <form action="{{ route('clientReviewStore') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- @isset($system) value="{{$system->title}}" @endisset  --}}
                        <input type="hidden" name="detail_id" value="{{ $detail->id }}">
                        <div class="modal-body">
                            <input type="hidden" name="event_id" value="{{ $detail->id }}">
                            <div class="form-group row pt-3">
                                <div class="col-sm-12">
                                    <label for="artist" class="form-label text-bold"><strong>Select Artist</strong>
                                    </label>
                                    <select name="artist_id" id="artist" class="form-control">
                                        @foreach ($artists as $v_artist)
                                            <option value="{{ $v_artist->assigned_user_id }}">
                                                {{ $v_artist->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row pt-3">
                                <div class="col-sm-12">
                                    <label for="experience" class="form-label text-bold"><strong>Share
                                            Experience</strong> </label>
                                    <textarea name="experience" class="form-control" id="" cols="30" rows="10"
                                        placeholder="Share Yore Experience About The Artist"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade viewExperience-{{ $detail->id }}" id="" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title" id="exampleModalLabel">Your Reviews To Artist</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            @if ($reviews)
                                <table class="table table-bordered table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Artist Name</th>
                                            <th>Artist Designation</th>
                                            <th>Your Review</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reviews as $v_review)
                                            <tr>
                                                <td>{{ $v_review->artist->name }}</td>
                                                <td>{{ $v_review->artist->designation }}</td>
                                                <td>{{ $v_review->experience }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade artistExperience-{{ $detail->id }}" id="" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title" id="exampleModalLabel">Artist Review</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            @if ($artistReviews)
                                <table class="table table-bordered table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Artist Name</th>
                                            <th>Artist Designation</th>
                                            <th>Review</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($artistReviews as $artist_review)
                                            <tr>
                                                <td>{{ $artist_review->user->name }}</td>
                                                <td>{{ $artist_review->user->designation }}</td>
                                                <td>{{ $artist_review->experience }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endforeach

    @foreach ($payments as $payment)
        @php

            $eventdetails = App\Models\BackEnd\EventDetails::where('master_id', $payment->event_id)
                ->whereNotIn('status', [0, 2])
                ->get();
            $logs = App\Models\BackEnd\Paymentlog::where('payment_id', $payment->id)->get();
        @endphp
        <div class="modal fade viewModal-{{ $payment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title" id="exampleModalLabel">Payment Info</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    @if ($eventdetails)
                                        <h4 class="text-center">Event Information</h4>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Event Date</th>
                                                    <th>Package</th>
                                                    <th>Package Price</th>
                                                    <th>Transportation</th>
                                                    <th>Accomodation</th>
                                                    <th>Additional Service Cost</th>
                                                </tr>
                                            <tbody>
                                                @foreach ($eventdetails as $detail)
                                                    <tr>
                                                        <td>{{ $detail->date }}</td>
                                                        <td>{{ $detail->category->category_name }}</td>
                                                        <td>{{ $detail->package->discount }}</td>
                                                        <td>{{ $detail->transportation }}</td>
                                                        <td>{{ $detail->accommodation }}</td>
                                                        <td>{{ $detail->shift_charge }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            </thead>
                                        </table>
                                </div>
                                @if ($logs)
                                    <h4 class="text-center">Payment History</h4>
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr style="font-size: 13px;">
                                                <th>Payment Date</th>
                                                <th>Paid</th>
                                                <th>Payment System</th>
                                                <th>Transaction Id/ Bank Acc.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($logs as $log)
                                                <tr style="font-size: 13px;">
                                                    @if ($log->payment->event_master)
                                                        <td>{{ $log->payment_date }}</td>
                                                        <td>{{ $log->amount }}</td>
                                                        <td>{{ $log->payment_method }}</td>
                                                        <td>{{ $log->transaction_id }}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                @endif
                            @else
                                <h4>Events are Pending</h4>
    @endif
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    @endforeach

    <!--<footer class="footer text-center ">-->
    <!--    <p>Made with <a href="https://demos.creative-tim.com/material-kit/index.html" target="_blank">Material Kit</a>-->
    <!--        by Creative Tim</p>-->
    <!--</footer>-->

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
        integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
        integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous">
    </script>




</body>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(function() {
        $('.textarea').summernote({
            height: 250,
            dialogsInBody: true,
        })
    })
</script>

<script src="{{ asset('backend') }}/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="{{ asset('backend') }}/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
<script>
    $(document).ready(function() {
        $('#studioTable').DataTable({
            processing: true,
            serverSide: true,
            lengthChange: false,
            searching: false, paging: false,
            ajax: '{{ route('getDetail') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'event_date',
                    name: 'event_date'
                },
                {
                    data: 'venue',
                    name: 'venue'
                },
                {
                    data: 'event_type',
                    name: 'event_type'
                },
                {
                    data: 'event_time',
                    name: 'event_time'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'package',
                    name: 'package'
                },
                {
                    data: 'selection',
                    name: 'selection'
                },
                {
                    data: 'delivery_date',
                    name: 'delivery_date'
                },
                {
                    data: 'status',
                    name: 'status'
                },
            ],

            columnDefs: [{
                    width: '150px',
                    targets: [1]
                },
                {
                    width: '200px',
                    targets: [2]
                },
                {
                    width: '120px',
                    targets: [3]
                },
                {
                    width: '150px',
                    targets: [4]
                }
            ]
        });
        $('#paymentTable').DataTable({
            processing: true,
            serverSide: true,
            lengthChange: false,
             searching: false, paging: false,
            ajax: '{{ route('getClientPayment') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'booking_id',
                    name: 'booking_id'
                },
                {
                    data: 'total_payment',
                    name: 'total_payment'
                },
                {
                    data: 'total_advance',
                    name: 'total_advance'
                },
                {
                    data: 'total_due',
                    name: 'total_due'
                },
                {
                    data: 'view_details',
                    name: 'view_details'
                },
            ]

        });
        $('#shareExperience').DataTable({
            processing: true,
            serverSide: true,
            lengthChange: false,
             searching: false, paging: false,
            ajax: '{{ route('shareExperience') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'event_date',
                    name: 'event_date'
                },
                {
                    data: 'venue',
                    name: 'venue'
                },
                {
                    data: 'share',
                    name: 'share'
                },
            ]

        });
    });
</script>

<script>
    var big_image;

    $(document).ready(function() {
        BrowserDetect.init();

        $('body').bootstrapMaterialDesign();

        window_width = $(window).width();

        $navbar = $('.navbar[color-on-scroll]');
        scroll_distance = $navbar.attr('color-on-scroll') || 500;

        $navbar_collapse = $('.navbar').find('.navbar-collapse');

        //  Activate the Tooltips
        $('[data-toggle="tooltip"], [rel="tooltip"]').tooltip();

        // Activate Popovers
        $('[data-toggle="popover"]').popover();

        if ($('.navbar-color-on-scroll').length != 0) {
            $(window).on('scroll', materialKit.checkScrollForTransparentNavbar);
        }

        materialKit.checkScrollForTransparentNavbar();

        if (window_width >= 768) {
            big_image = $('.page-header[data-parallax="true"]');
            if (big_image.length != 0) {
                $(window).on('scroll', materialKit.checkScrollForParallax);
            }

        }


    });

    $(document).on('click', '.navbar-toggler', function() {
        $toggle = $(this);

        if (materialKit.misc.navbar_menu_visible == 1) {
            $('html').removeClass('nav-open');
            materialKit.misc.navbar_menu_visible = 0;
            $('#bodyClick').remove();
            setTimeout(function() {
                $toggle.removeClass('toggled');
            }, 550);

            $('html').removeClass('nav-open-absolute');
        } else {
            setTimeout(function() {
                $toggle.addClass('toggled');
            }, 580);


            div = '<div id="bodyClick"></div>';
            $(div).appendTo("body").click(function() {
                $('html').removeClass('nav-open');

                if ($('nav').hasClass('navbar-absolute')) {
                    $('html').removeClass('nav-open-absolute');
                }
                materialKit.misc.navbar_menu_visible = 0;
                $('#bodyClick').remove();
                setTimeout(function() {
                    $toggle.removeClass('toggled');
                }, 550);
            });

            if ($('nav').hasClass('navbar-absolute')) {
                $('html').addClass('nav-open-absolute');
            }

            $('html').addClass('nav-open');
            materialKit.misc.navbar_menu_visible = 1;
        }
    });

    materialKit = {
        misc: {
            navbar_menu_visible: 0,
            window_width: 0,
            transparent: true,
            fixedTop: false,
            navbar_initialized: false,
            isWindow: document.documentMode || /Edge/.test(navigator.userAgent)
        },

        initFormExtendedDatetimepickers: function() {
            $('.datetimepicker').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });
        },

        initSliders: function() {
            // Sliders for demo purpose
            var slider = document.getElementById('sliderRegular');

            noUiSlider.create(slider, {
                start: 40,
                connect: [true, false],
                range: {
                    min: 0,
                    max: 100
                }
            });

            var slider2 = document.getElementById('sliderDouble');

            noUiSlider.create(slider2, {
                start: [20, 60],
                connect: true,
                range: {
                    min: 0,
                    max: 100
                }
            });
        },

        checkScrollForParallax: function() {
            oVal = ($(window).scrollTop() / 3);
            big_image.css({
                'transform': 'translate3d(0,' + oVal + 'px,0)',
                '-webkit-transform': 'translate3d(0,' + oVal + 'px,0)',
                '-ms-transform': 'translate3d(0,' + oVal + 'px,0)',
                '-o-transform': 'translate3d(0,' + oVal + 'px,0)'
            });
        },

        checkScrollForTransparentNavbar: debounce(function() {
            if ($(document).scrollTop() > scroll_distance) {
                if (materialKit.misc.transparent) {
                    materialKit.misc.transparent = false;
                    $('.navbar-color-on-scroll').removeClass('navbar-transparent');
                }
            } else {
                if (!materialKit.misc.transparent) {
                    materialKit.misc.transparent = true;
                    $('.navbar-color-on-scroll').addClass('navbar-transparent');
                }
            }
        }, 17)
    };

    // Returns a function, that, as long as it continues to be invoked, will not
    // be triggered. The function will be called after it stops being called for
    // N milliseconds. If `immediate` is passed, trigger the function on the
    // leading edge, instead of the trailing.

    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this,
                args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            }, wait);
            if (immediate && !timeout) func.apply(context, args);
        };
    };

    var BrowserDetect = {
        init: function() {
            this.browser = this.searchString(this.dataBrowser) || "Other";
            this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator
                .appVersion) || "Unknown";
        },
        searchString: function(data) {
            for (var i = 0; i < data.length; i++) {
                var dataString = data[i].string;
                this.versionSearchString = data[i].subString;

                if (dataString.indexOf(data[i].subString) !== -1) {
                    return data[i].identity;
                }
            }
        },
        searchVersion: function(dataString) {
            var index = dataString.indexOf(this.versionSearchString);
            if (index === -1) {
                return;
            }

            var rv = dataString.indexOf("rv:");
            if (this.versionSearchString === "Trident" && rv !== -1) {
                return parseFloat(dataString.substring(rv + 3));
            } else {
                return parseFloat(dataString.substring(index + this.versionSearchString.length + 1));
            }
        },

        dataBrowser: [{
                string: navigator.userAgent,
                subString: "Chrome",
                identity: "Chrome"
            },
            {
                string: navigator.userAgent,
                subString: "MSIE",
                identity: "Explorer"
            },
            {
                string: navigator.userAgent,
                subString: "Trident",
                identity: "Explorer"
            },
            {
                string: navigator.userAgent,
                subString: "Firefox",
                identity: "Firefox"
            },
            {
                string: navigator.userAgent,
                subString: "Safari",
                identity: "Safari"
            },
            {
                string: navigator.userAgent,
                subString: "Opera",
                identity: "Opera"
            }
        ]

    };
</script>
