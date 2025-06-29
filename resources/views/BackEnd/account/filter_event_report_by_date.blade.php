<style>
/*    .table>tbody>tr>td,*/
/*    .table>tbody>tr>th,*/
/*    .table>tfoot>tr>td,*/
/*    .table>tfoot>tr>th,*/
/*    .table>thead>tr>td,*/
/*    .table>thead>tr>th {*/
/*        padding: 5px;*/
/*        line-height: 1.42857143;*/
/*        vertical-align: top;*/
/*        border: 0.3px solid rgb(119, 119, 119) ;*/
/*        border-bottom: 0.3px solid rgb(119, 119, 119) !important ;*/
/*        text-align: left !important;*/
/*        font-size: 15px;*/
/*    }*/
</style>


<div class="row">
    @php $date = date('d/m/Y'); @endphp
    <div class="col-md-12 text-end">
        <button class="mt-2 col-sm-1 btn btn-warning"
            onClick="document.title = 'Bridal Harmony-Event Report'; printDiv('printableArea'); "
            style="margin-right:100px"> <i class="fa fa-print"></i> Print </button>
    </div>
</div>

<div id="printableArea">
    <div class="row text-center">
        <div class="col-sm-12">
            <h2><strong> Bridal Harmony</strong></h2>
            <h3 style="margin-top:10px"><strong> Event Report </strong></h3>
            <h6 style="margin-top:10px">{{ date('d/m/Y', strtotime($start_date)) }} -
                {{ date('d/m/Y', strtotime($end_date)) }}</h6>
        </div>
    </div>
    <div class="row mb-5" style="margin-top: 20px">
        <div class="col-sm-12">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th style="width: 100px">Booking ID</th>
                        <th style="width: 100px">Event Date</th>
                        <th style="width: 150px">Event Venue</th>
                        <th style="width: 100px">Event Price</th>
                        <th style="width: 200px">Event Expense</th>
                        <th style="width: 200px">Staff Payment</th>
                        <th style="width: 200px">Fixed Expense Per Event</th>
                        <th style="width: 100px">Total Profit</th>
                    </tr>
                </thead>
                <tbody>
                @php 
    $total_profit = 0;  
    $total_receive = 0; 
    $totalexpense = 0; 
    $total = 0; 
    $i = 0; 
@endphp

@foreach ($event_expense_monthwise as $month => $events)
    @foreach ($events as $v_event)
        @php
            // Ensure $v_event is an array before accessing keys
            if (is_array($v_event)) {
                $expense = App\Models\BackEnd\Expense::where('event_id', $v_event['event_id'])->sum('amount');
                $staff_payment = App\Models\BackEnd\EventwisePayment::where('event_details_id', $v_event['event_id'])->sum('payment_amount');
                $total_expense = $expense + $staff_payment +  $v_event['per_event_expense'];
                $per_event_cost = $v_event['per_event_expense'];
                $total_profit = $v_event['event_price'] - $total_expense;

                // Accumulate totals for the report
                $total_receive += $v_event['event_price'];
                $totalexpense += $total_expense;
                $total += $total_profit;
            } else {
                // Handle the case where $v_event is not an array
                continue;
            }
        @endphp

            <tr>
                <td>{{ ++$i }}</td>
    
                <!-- Event Booking ID with ellipsis for overflow text -->
                <td class="new-td" style="width: 200px">{{ $v_event['booking_id'] ?? 'N/A' }}</td>
    
                <!-- Event Date -->
                <td style="width: 100px">{{ \Carbon\Carbon::parse($v_event['event_date'])->format('d-m-Y') }}</td>
    
                <!-- Event Name with ellipsis for overflow text -->
                <td class="new-td" style="width: 150px">{{ $v_event['event_name'] ?? 'N/A' }}</td>
    
                <!-- Event Price (int value) -->
                <td style="width: 100px">{{ number_format(intval($v_event['event_price']), 0) }}</td>
    
                <!-- Expense (int value) -->
                <td style="width: 100px">{{ number_format(intval($expense)) }}</td>
    
                <!-- Staff Payment (int value) -->
                <td style="width: 100px">{{ number_format(intval($staff_payment)) }}</td>
    
                <!-- Per Event Expense (int value) -->
                <td style="width: 100px">{{ number_format(intval($per_event_cost)) }}</td>
    
                <!-- Total Profit (int value) -->
                <td style="width: 100px">{{ number_format(intval($total_profit)) }}</td>
            </tr>
        @endforeach
    @endforeach


                </tbody>
            </table>
             <table class="table table-bordered"
                            style="margin-top: 50px; margin-bottom:10px;" >
                            <thead>
                                <tr>
                                    <td  class="text-start" style="width: 20px"><b>Total Event Price</b></td>
                                    <td>:</td>
                                    <td class="text-right">{{ number_format($total_receive) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-start" style="width: 20px"><b>Total Expense </b></td>
                                    <td>:</td>
                                    <td class="text-right">{{ number_format($totalexpense) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-start" style="width: 20px"><b>Total Profit</b></td>
                                    <td>:</td>
                                    <td class="text-right">{{ number_format($total) }}</td>
                                </tr>

                            </thead>
                        </table>
        </div>
    </div>

</div>


<script>
    function printDiv(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
