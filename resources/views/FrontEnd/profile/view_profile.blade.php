<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    body {
        margin-top: 20px;
        color: #1a202c;
        text-align: left;
        background-color: #cfdae9;
    }

    .main-body {
        padding: 15px;
    }

    .card {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col,
    .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }

    .mb-3,
    .my-3 {
        margin-bottom: 1rem !important;
    }

    .bg-gray-300 {
        background-color: #e2e8f0;
    }

    .h-100 {
        height: 100% !important;
    }

    .shadow-none {
        box-shadow: none !important;
    }
    ul li{
        list-style: none;
    }
</style>

<body>
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-12 mb-3">
                    <div class="card text-light">
                        <div class="card-header" style="background: #0493ac">
                            <h4 class="text-light text-center">Personal Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column">
                                <div class="row-cols-12 text-end">
                                    <button class="btn btn-primary">Book New Event</button>
                                </div>
                                <div class="mt-3 row-cols-3">
                                    <label class="form-label text-dark col-sm-3">Name : {{ $clientInfo->name }}
                                    </label> 
                                    <label class="form-label text-dark col-sm-3">Address : {{ $clientInfo->address }}</label>
                                    <label class="form-label text-dark col-sm-3">Contact Number : {{ $clientInfo->primary_no }}
                                    </label> 
                                    <label class="form-label text-dark col-sm-3">Alternate Number : {{ $clientInfo->alternate_no }}
                                    </label> 
                                    <label class="form-label text-dark col-sm-3">Email : {{ $clientInfo->email }}</label>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background: #947bb4">
                            <h4 class="text-light text-center">Event Details</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr style="font-size: 13px;">
                                        <th>#</th>
                                        <th>Event Date</th>
                                        <th>Venue</th>
                                        <th>Event Time</th>
                                        <th>Location</th>
                                        <th>Event Type</th>
                                        <th>Package Name</th>
                                        <th>Package Details</th>
                                        <th>Instructions</th>
                                        <th>Add Note</th>
                                        <th>Status</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl = 0; @endphp
                                    @foreach($events as $v_event)
                                    @php  $details = App\Models\BackEnd\EventDetails::where('master_id',$v_event->id)->whereNotIn('status',[0,2])->get() @endphp
                                        @foreach($details as $v_detail)
                                            <tr style="font-size:14px">
                                                <td>{{++$sl}}</td>
                                                <td>{{$v_detail->date}}</td>
                                                <td>{{$v_detail->venue}}</td>
                                                <td>{{date('g:i a',strtotime($v_detail->start_time)).' - '.date('g:i a',strtotime($v_detail->end_time))}}</td>
                                                <td>{{$v_detail->district->district}}</td>
                                                <td>{{$v_detail->type->type_name}}</td>
                                                <td>{{$v_detail->category->category_name}}</td>
                                                <td>{{$v_detail->package->name}}</td>
                                                <td>{{$v_event->instructions}}</td>
                                                <td>
                                                    <a href="#" class="btn btn-success btn-sm">Photo Selection</a>
                                                    <a href="#" class="btn btn-warning btn-sm mt-2">Video Song Selection</a>
                                                </td>
                                                <td>
                                                    @if($v_detail->status == 1)
                                                        <button class="btn btn-success btn-sm">Active</button>
                                                    @elseif($v_detail->status == 3)
                                                        <button class="btn btn-info btn-sm">Raw Collection</button>
                                                    @elseif($v_detail->status == 4)
                                                        <button class="btn btn-success btn-sm">Photo Edit</button>
                                                    @elseif($v_detail->status == 5)
                                                        <button class="btn btn-info btn-sm">Video Edit</button>
                                                    @elseif($v_detail->status == 6)
                                                        <button class="btn btn-success btn-sm">Delivered</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </div>
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header" style="background: #3979c2">
                            <h4 class="text-light text-center">Payment Details</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr style="font-size: 13px;">
                                        <th>#</th>
                                        <th>Booking ID</th>
                                        <th>Event Dates</th>
                                        <th>Package</th>
                                        <th>Package Price</th>
                                        <th>Transportation</th>
                                        <th>Accommodation</th>
                                        <th>Others Charge</th>
                                        <th>Total Price</th>
                                        <th>Advance</th>
                                        <th>Due</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl = 0; @endphp
                                    @foreach($payments as $payment)
                                    <tr>
                                        <td>{{++$sl}}</td>
                                        <td>@if($payment->event_master){{$payment->event_master->booking_id}}@endif</td>
                                        <td>
                                            <ul>
                                                @php  $details = App\Models\BackEnd\EventDetails::where('master_id',$payment->event_id)->whereNotIn('status',[0,2])->get() @endphp
                                                @foreach($details as $v_detail)
                                                    <li>{{$v_detail->date}}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach($details as $v_detail)
                                                    <li>{{$v_detail->category->category_name}}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach($details as $v_detail)
                                                    <li>{{$v_detail->package->discount}}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach($details as $v_detail)
                                                    <li>{{$v_detail->package->transportation}}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach($details as $v_detail)
                                                    <li>{{$v_detail->package->accommodation}}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach($details as $v_detail)
                                                    <li>{{$v_detail->package->shift_charge}}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{$payment->payment_amount}}</td>
                                        <td>{{$payment->advance}}</td>
                                        <td>{{$payment->due_amount}}</td>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                    @php $logs =  App\Models\BackEnd\Paymentlog::where('payment_id',$payment->id)->get(); @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @if($logs)
                            <h4 class="text-center">Payment History</h4>
                            <table  class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Payment Date</th>
                                        <th>Booking Id</th>
                                        <th>Paid</th>
                                        <th>Payment System</th>
                                        <th>Transaction Id/ Bank Acc.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logs as $log)
                                    <tr>
                                        <td>{{$log->payment_date}}</td>
                                        <td>@if($log->payment->event_master){{$log->payment->event_master->booking_id}}@endif</td>
                                        <td>{{$log->amount}}</td>
                                        <td>{{$log->payment_method}}</td>
                                        <td>{{$log->transaction_id}}</td>
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
    </div>
</body>
</html>
