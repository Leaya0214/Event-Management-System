@extends('FrontEnd.profile.profile')
@section ('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-light text-center" style="background-color:#1db180">
                <h4>About Me</h4>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column text-center">
                    <div class="mt-3">
                        <label class="form-label text-dark col-sm-6"><strong>Name :</strong></label>
                        <label class="form-label text-crimson col-sm-6" style="color: #852e40">{{$clientInfo->name}}</label>
    
                        <label class="form-label text-dark col-sm-6"><strong>Address :</strong></label>
                        <label class="form-label text-crimson col-sm-6" style="color: #852e40">{{ $clientInfo->address }}</label>
    
                        <label class="form-label text-dark col-sm-6"><strong>Contact Number :</strong></label>
                        <label class="form-label text-crimson col-sm-6" style="color: #852e40">{{ $clientInfo->primary_no }}</label>
    
                        <label class="form-label text-dark col-sm-6"><strong>Alternate Number :</strong></label>
                        <label class="form-label text-crimson col-sm-6" style="color: #852e40">{{ $clientInfo->alternate_no }}</label>
    
                        <label class="form-label text-dark col-sm-6"><strong>Email :</strong></label>
                        <label class="form-label text-crimson col-sm-6" style="color: #852e40">{{ $clientInfo->email }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-light text-center" style="background-color:rgb(29, 177, 177)">
                <h4>My Events</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr style="font-size:14px">
                            <th>Event Date</th>
                            <th>Event Venue</th>
                            <th>Package</th>
                            <th>Package Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        @php $details = App\Models\BackEnd\EventDetails::where('master_id',$event->id)->whereNotIn('status',[0,2])->get();
                         @endphp
                        @foreach($details as $detail)
                        <tr style="font-size:14px">
                            <td>{{$detail->date}}</td>
                            <td>{{$detail->venue}}</td>
                            <td>{{$detail->category->category_name}}</td>
                            <td>{{$detail->package->name}}</td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-2">
        <div class="card">
            <div class="card-header text-light text-center" style="background-color:#3362b9">
                <h4>Payments</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr style="font-size:14px">
                            <th>Booking ID</th>
                            <th>Total Payment</th>
                            <th>Total Paid</th>
                            <th>Total Due</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        @php $details = App\Models\BackEnd\EventDetails::where('master_id',$event->id)->whereNotIn('status',[0,2])->get() @endphp
                        @foreach($details as $detail)
                        <tr style="font-size:14px">
                            <td>{{$detail->date}}</td>
                            <td>{{$detail->venue}}</td>
                            <td>{{$detail->category->category_name}}</td>
                            <td>{{$detail->package->name}}</td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
