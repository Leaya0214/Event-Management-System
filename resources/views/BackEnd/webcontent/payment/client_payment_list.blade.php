@extends('BackEnd.master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')
    <h4 class="mb-4">Filter Client Payments Data</h4>
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

    <div class="row mt-5 ml-3" id="hidden" style="display: none">
        <div class="col-md-12">
            <h4 class="mb-3">Client's Total Payment: <b style="color:green" id="totalPayment"></b></h4>
            <h4 class="mb-3">Total Paid  : <b style="color:green" id="totalAmount"></b></h4>
            <h4>Total Due: <b style="color:red" id="totalDue"></b></h4>
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row  pr-3 mt-5">
                    <div class="col-md-12 ">
                        <h6 class="card-title text-center">Client Payment History</h6>
                        <p class="text-muted mb-3"></p>
                    </div>
                </div>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered table-hover user_table" style="width:100%; text-align:center;"
                        data-table="true" id="clientPaymentTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice Id</th>
                                <th>Booking Id</th>
                                <th>Client Name</th>
                                <th>Payment</th>
                                <th>Advance</th>
                                <th>Due</th>
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

    @foreach ($payments as $payment)
        <div class="modal fade bg-dark view_modal-{{ $payment->id }}" id="" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Payment Details</h5>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Payment Date</th>
                                            <th>Amount</th>
                                            <th>Payment System</th>
                                            <th>Transaction ID/Bank Account</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $logs = App\Models\BackEnd\Paymentlog::where('payment_id',$payment->id)->get(); @endphp
                                        @foreach ($logs as $log)
                                            <tr>
                                                <td>{{ $log->payment_date }}</td>
                                                <td>{{ $log->amount }}</td>
                                                <td>{{ $log->payment_method }}</td>
                                                <td>{{ $log->transaction_id }}</td>
                                            </tr>
                                        @endforeach
                                        <tr></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-bs-dismiss="modal">close</button>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#clientPaymentTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url:'{{ route('client.getAll') }}',
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
                        data: 'inv',
                        name: 'inv'
                    },
                    {
                        data: 'booking_id',
                        name: 'booking_id'
                    },
                    {
                        data: 'client',
                        name: 'client'
                    },
                    {
                        data: 'payment',
                        name: 'payment'
                    },
                    {
                        data: 'advance',
                        name: 'advance'
                    },
                    {
                        data: 'due',
                        name: 'due'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });

            $('#filterBtn').click(function() {
                $('#clientPaymentTable').DataTable().ajax.reload(function(json) {
                $('#hidden').show();
                $('#totalPayment').text(json.totalPayment);
                $('#totalAmount').text(json.totalAmount);
                $('#totalDue').text(json.totalDue);
            });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(function() {
            $('.textarea').summernote({
                height: 250
            })
        })
    </script>

   
@endsection
