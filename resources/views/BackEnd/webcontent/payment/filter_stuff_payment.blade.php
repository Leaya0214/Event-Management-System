<div class="row  text-end mt-2">
    <div class="col-sm-12">
        <input type="button" onclick="printDiv('printableArea')" class="btn btn-success" value="print" />
    </div>
</div>
<div id="printableArea">
<div class="row">
    <div class="col-md-12 text-center mt-5 mb-4">
        <h4 class="pb-2">Bridal Harmony</h4>
        <h6>Payment Details Of : {{$user_info->name}}</h6>
        <h6>From : {{$from_date}} -- To : {{$to_date}}</h6>
    </div>
</div>
<table class="table table-bordered main-table" data-table="true" id="eventTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Booking ID</th>
            <th>Event Date</th>
            <th>Event Shift</th>
            <th>Event Time</th>
            <th>Event Venue</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @php $total_payment = 0; $i=0; @endphp
        @foreach($eventInfo as $v_info)

            <tr>
                <td>{{++$i}}</td>
                <td>{{$v_info->event_details->event->booking_id}}</td>
               <td>{{$v_info->event_details->date}}</td>
               <td>{{$v_info->event_details->shift->shift_name}}</td>
               @php $time =date('g:i a',strtotime($v_info->event_details->start_time)).' - '.date('g:i a',strtotime($v_info->event_details->end_time))  @endphp
               <td>{{$time}}</td>
               <td>{{$v_info->event_details->venue}}</td>
               <td class="text-end">{{$v_info->payment_amount}}</td>
               @php  $total_payment += $v_info->payment_amount @endphp
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        @php $total = 0;  $total_due = 0; @endphp
        @foreach($query as $v_query)
         @php 
               $total += $v_query->paid;
                @endphp
         @endforeach
         @php $total_due = $total_payment - $total  @endphp
        <tr>
            <th colspan="6" class="text-end mr-2">Total Payment :</th>
            <td class="text-end">{{$total_payment}}</td>
        </tr>
        <tr>
            <th colspan="6" class="text-end mr-2">Total Paid :</th>
            <td class="text-end">{{$total}}</td>
        </tr>
        <tr>
            <th colspan="6" class="text-end pr-2">Current Due :</th>
            <td class="text-end">{{$total_due}}</td>
        </tr>
       
    </tfoot>
</table>
<table class="table table-bordered table-striped mt-3">
    <thead>
        <th>Payment Date</th>
        <th>Paid Amount</th>
        <th>Transaction System</th>
        <th>Transaction ID/Bank No.</th>
        <!--<th>Paid By</th>-->
    </thead>
    <tbody>
        @foreach($query as $v_query)
            <tr>
                <td class="p-2">{{$v_query->payment_date}}</td>
                <td class="p-2">{{$v_query->paid}}</td>
                <td class="p-2">{{$v_query->payment_system}}</td>
                <td class="p-2">{{$v_query->trans_id}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

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