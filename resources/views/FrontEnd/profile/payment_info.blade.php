@extends('FrontEnd.profile.profile')
@section ('content')
<style>
    ul li{
        list-style: none;
    }
</style>
    <div class="row">
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
                                <td>@if($log->payment->event_id){{$log->payment->event_master->booking_id}}@endif</td>
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
@endsection