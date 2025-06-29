@extends('BackEnd.master')

@section('content')

{{-- <style>
    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
        padding: 5px;
        line-height: 1.42857143;
        vertical-align: top;
        border: 0.3px solid rgb(119, 119, 119) ;
        border-bottom: 0.3px solid rgb(119, 119, 119) ;
        text-align: left !important;
        font-size: 15px;
    }

    .table>thead>tr>th {
        color: rgb(29, 28, 28) !important;
    }
</style> --}}

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                   <h4>Filter by Date</h4> 
                </div>
                <div class="card-body">
                    {{-- <form > --}}
                        <div class="form-group">
                            <label for="fromDate">From Date</label>
                            <input type="date" class="form-control" id="fromDate" name="fromDate">
                        </div>
                        <div class="form-group mt-3">
                            <label for="toDate">To Date</label>
                            <input type="date" class="form-control" id="toDate" name="toDate">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3" onclick="viewFilterReport();">Filter</button>
                    {{-- </form> --}}
                </div>
            </div>
        </div>

        <div id="wrapper">

        </div>
        <div class="col-md-12 mt-5" id="report-view">
            <div class="card">
                <div class="card-header text-center">
                    <h3> Event Report</h3>
                    <h4 class="mt-3">Bridal Harmony</h4>
                    <h5 class="mt-3">For {{$monthname}} - {{$currentYear}}</h5>
                </div>
                <div class="card-body table-responsive">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table" id="main-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="width: 100px">Booking ID</th>
                                        <th style="width: 100px">Event Date</th>
                                        <th style="width: 200px">Event Venue</th>
                                        <th style="width: 100px">Event Price</th>
                                        <th style="width: 100px">Event Expense</th>
                                        <th style="width: 100px">Staff Payment</th>
                                        <th style="width: 100px">Fixed Expense Per Event</th>
                                        <th style="width: 100px">Total Profit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total_profit = 0; $total_receive=0; $totalexpense=0; $total=0;  $i=0; @endphp
                                    @foreach($events as $v_event)
                                    @php 
                                        
                                        $master_event_id = $v_event->event->id;
                                        $master_event_count = App\Models\BackEnd\EventDetails::where('master_id', $master_event_id)->count();
                                        
                                        $package_price_or_discount = $v_event->package_price ? $v_event->package_price : $v_event->package->discount;
                                        
                                        // Determine the base price to use for calculations
                                        $base_price = ($master_event_count == 1) 
                                            ? ($v_event->event->payment ? $v_event->event->payment->payment_amount : 0)
                                            : $package_price_or_discount;
                                        
                                        // Calculate expenses
                                        $expense = App\Models\BackEnd\Expense::where('event_id', $v_event->id)->sum('amount');
                                        $staff_payment = App\Models\BackEnd\EventwisePayment::where('event_details_id', $v_event->id)->sum('payment_amount');
                                        
                                        $per_event_cost = $per_event_expense * $base_price;
                                        
                                        // Calculate totals
                                        $total_expense = $expense + $staff_payment + $per_event_cost;
                                        $total_profit = $base_price - $total_expense;
                                        
                                        $total_receive += $base_price;
                                        $totalexpense += $total_expense;
                                        $total += $total_profit;
                                    @endphp
                                    <tr>
                                        <td>{{++$i}}</td>
                                         <td class="new-td" style="width: 200px">{{$v_event->event->booking_id}}</td>

                                        <td style="width: 100px">{{$v_event->date}}</td>
                                        <style>
                                td.new-td {
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                        white-space: normal; 
                                        max-height: 500px;
                                        width: 100%;
                                        display: -webkit-box;
                                        -webkit-line-clamp: 3;
                                        }
                                        </style>
                                        <td class="new-td" style="width: 200px">{{$v_event->venue}}</td>
                                        <!--<td style="width: 100px">{{$v_event->package->discount ? $v_event->package->discount : $v_event->package_price }}</td>-->
                                        <td style="width: 100px">
                                            @php
                                                $master_event_id = $v_event->event->id;
                                                $master_event_count = App\Models\BackEnd\EventDetails::where('master_id', $master_event_id)->count(); // Adjust model and field names as necessary
                                            @endphp
                                        
                                            @if ($master_event_count == 1)
                                                {{ $v_event->event->payment ? $v_event->event->payment->payment_amount : 0 }}
                                            @else
                                                {{ $v_event->package_price ? $v_event->package_price : $v_event->package->discount   }}
                                            @endif
                                        </td>

                                        <td style="width: 100px">{{$expense}}</td>
                                        <td style="width: 100px">{{$staff_payment}}</td>
                                        <td style="width: 100px">{{number_format($per_event_cost)}}</td>
                                        {{-- @dd() --}}
                                      
                                        {{-- <td style="width: 200px">{{number_format($total_expense)}}</td> --}}
                                        <td  style="width: 100px">{{number_format($total_profit)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                             <table class="table table-bordered"
                            style="margin-top: 50px; margin-bottom:10px;" >
                            <thead>
                                <tr>
                                    <td  class="text-start" style="width: 20px"><b>Total Event Price</b></td>
                                    <td>:</td>
                                    <td class="text-right">{{ $total_receive }}</td>
                                </tr>
                                <tr>
                                    <td class="text-start" style="width: 20px"><b>Total Expense </b></td>
                                    <td>:</td>
                                    <td class="text-right">{{ $totalexpense }}</td>
                                </tr>
                                <tr>
                                    <td class="text-start" style="width: 20px"><b>Total Profit</b></td>
                                    <td>:</td>
                                    <td class="text-right">{{ $total }}</td>
                                </tr>

                            </thead>
                        </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function viewFilterReport(){
        $('#report-view').hide();
        $('.btn-warning').hide();
        var start_date = document.getElementById('fromDate').value;
        var end_date = document.getElementById('toDate').value;
        var url = "{{route('report.filter')}}"

        $.ajax({
            type:'GET',
            url:url,
            data:{start_date,end_date},
            success:function(data){
                $('#wrapper').html(data);
            }
        });
    }
</script>
@endsection