@extends('BackEnd.master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')
<h4 class="mb-4">Filter Satff Payments Data</h4>

<div class="row">
    <label for="" class="col-sm-2 form-label">From Date :</label>
    <div class="col-md-3">
        <input type="date" class="form-control" id="from_date" placeholder="Enter From Date" value="">
    </div>
    <label for="" class="col-sm-2 form-label">To Date :</label>
    <div class="col-md-3">
        <input type="date" class="form-control" id="to_date" placeholder="Enter To Date" value="">
    </div>

    <div class="col-md-2">
        <button type="button" class="btn btn-success" id="filterBtn" >Filter</button>
    </div>
</div>

<div class="row mt-3 ml-3" id="hidden" style="display: none">
    <div class="col-md-12">
        <h4 class="mb-3">Total Staff Due: <b style="color:red" id="totalDue"></b></h4>
        <h4 class="mb-3">Total Paid: <b style="color:green" id="totalAmount"></b></h4>
    </div>
</div>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row  pr-3">
                <div class="col-md-6">
                    <h6 class="card-title">Staff Payment</h6>
                    <p class="text-muted mb-3"></p>
                </div>
            </div>
            <div class="table-responsive pt-3">
                <table class="table table-bordered table-hover user_table"
                style="width:100%; text-align:center;" data-table="true" id="stuffPaymentTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Staff Name</th>
                            <th>Total Event</th> 
                            <th>Total Payment</th>
                            <th>Total Paid</th>
                            <th>Total Due</th>
                            {{-- <th>Total Advance</th> --}}
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

@foreach($events as $event)
@php 
    $paymentLogs = App\Models\BackEnd\EventwisePayment::where('user_id',$event->user_id)->get();
@endphp

<div class="modal fade bg-dark view_modal-{{ $event->user_id }}" id=""
    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Pyment Details</h5>
                <button type="button" class="close"
                data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table_responsive">

                       <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="p-2" >Event Date</th>
                                <th class="p-2" >Event Venue</th>
                                <th class="p-2" >Assign Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($paymentLogs as $log)
                          <tr>
                            <td>@if($log->event_details){{$log->event_details->date}}@endif</td>
                            <td>@if($log->event_details){!! nl2br(e(wordwrap($log->event_details->venue, 25, "\n", true))) !!}@endif</td>
                            <td>@if($log->event_details){{$log->payment_amount}} @endif</td>
                          </tr>
                          @endforeach
                        </tbody>
                       </table>
                    </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default"
                data-bs-dismiss="modal">close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#stuffPaymentTable').DataTable({
       processing: true,
       serverSide: true,
       ajax: {
            url:'{{ route('staff.getAll') }}',
            data: function(d) {
                    d.from_date = $('#from_date').val();
                    d.to_date = $('#to_date').val();
                }
            },
       columns: [{
               data: 'DT_RowIndex',
               name: 'DT_RowIndex',
               searchable: false,
               orderable: false
           },
           {
               data: 'staff',
               name: 'staff'
           },
           {
               data: 'total_event',
               name: 'total_event'
           },
           {
               data: 'total_payment',
               name: 'total_payment'
           },
           {
               data: 'total_paid',
               name: 'total_paid'
           },
           {
               data: 'total_due',
               name: 'total_due'
           },
           {
               data: 'action',
               name: 'action'
           },
       ]
   });

   $('#filterBtn').click(function() {
        $('#stuffPaymentTable').DataTable().ajax.reload(function(json) {
        $('#hidden').show();
        $('#totalAmount').text(json.totalAmount);
        $('#totalDue').text(json.totalDue);
    });
});
});
</script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(function () {
        $('.textarea').summernote({
            height:250
        })
    })
</script>
@endsection