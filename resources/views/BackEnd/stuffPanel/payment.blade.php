@extends('BackEnd.master')
<style>
    table tbody td {
        padding-left: 25px !important;
        padding-top: 10px !important;
        font-size: 15px;
        color: rgba(20, 18, 18, 0.89);
    }
    table tbody td .description{
        text-align: center !important;
        align-items: center;
    }
</style>
@section('css')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
@endsection
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row  pr-3">
                    <div class="col-md-6">
                        <h6 class="card-title">Payment Details</h6>
                        <p class="text-muted mb-3"></p>
                    </div>
                </div>
                <div class="table-responsive pt-3">
                    <table class="table table-striped table-bordered table-hover user_table text-center" id="staffEventTable"  
                    style="width:100%;"  data-table="true">
                        <thead class="bg-success">
                            <tr>
                                <th class=" text-light">#</th>
                                <th class=" text-light">Booking ID</th>
                                <th class=" text-light">Event Date</th>
                                <th class=" text-light">Event Shift</th>
                                <th class=" text-light">Payment</th>
                            </tr>
                        </thead>
                    </table>
                    @if($payments)
                    <table class="table table-striped table-bordered table-hover user_table text-center mt-4 mb-4">
                        <thead style="background: #0f6865">
                            <tr>
                                <th class=" text-light">Total Event</th>
                                <th class=" text-light">Total Payment</th>
                                <th class=" text-light">Total Paid</th>
                                <th class=" text-light">Total Due</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                                <td>{{count($payments)}}</td>
                                @php
                                    $total_payment = 0;
                                    $total_paid    = 0;
                                    foreach($payments as $p){
                                        $total_payment += $p->payment_amount;

                                    }
                                    $paid = App\Models\BackEnd\StaffPayment::where('user_id',auth()->user()->id)->sum('paid');

                                    if($paid){
                                        $total_paid = $paid;
                                        $total_due = $total_payment - $total_paid ;
                                    }else{
                                        $total_due = $total_payment;
                                    }
                                    
                                @endphp
                                <td>{{$total_payment}}</td>
                                <td>{{$total_paid}}</td>
                                <td>{{$total_due}}</td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                    <table class="table table-striped table-bordered table-hover user_table text-center" id="staffPayment"  
                    style="width:100%;"  data-table="true">
                        <thead class="bg-primary">
                            <tr>
                                <th class=" text-light">#</th>
                                <th class=" text-light">Payment Date</th>
                                <th class=" text-light">Paid</th>
                                <th class=" text-light">Payment System</th>
                                <th class=" text-light">Transaction ID/Bank Acc.</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    @endsection

@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        $('#staffEventTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('stuff.payment.all')}}',
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
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'shift',
                    name: 'shift'
                },
                {
                    data: 'payment_amount',
                    name: 'payment_amount'
                },
            ]
        });

        $('#staffPayment').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('payment-log')}}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                },
                {
                    data: 'payment_date',
                    name: 'payment_date'
                },
                {
                    data: 'paid',
                    name: 'paid'
                },
                {
                    data: 'payment_system',
                    name: 'payment_system'
                },
                {
                    data: 'trans_id',
                    name: 'trans_id'
                },
            ]
        });
    });

</script>
@endsection
