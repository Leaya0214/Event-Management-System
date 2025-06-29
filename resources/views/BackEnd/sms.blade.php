@extends('BackEnd.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h5 class="text-center"> Send SMS</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('store-sms')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Send To(Mobile NO.):</label>
                            <input type="text" name="mobile_no" id="" class="form-control" placeholder="Type Mobile NO." required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Message:</label>
                            <textarea name="message" class="form-control" id="" cols="30" rows="10" placeholder="Type message Here.." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success mt-3 text-end">Send SMS</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h5 class="text-center">All SMS</h5>
                </div>
                <div class="card-body">
                   <table class="table table-bordered" id="smsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Phone Number</th>
                                <th>Message</th>
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
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#smsTable').DataTable({
       processing: true,
       serverSide: true,
       ajax: '{{route('sms.all')}}',
       columns: [{
               data: 'DT_RowIndex',
               name: 'DT_RowIndex',
               searchable: false,
               orderable: false
           },
           {
               data: 'phone',
               name: 'phone'
           },
           {
               data: 'message',
               name: 'message'
           },
           {
               data: 'action',
               name: 'action'
           },
       ]
   });
});
</script>
@endsection