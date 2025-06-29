@extends('FrontEnd.profile.profile')
@section ('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background: #1b8e92">
                    <h4 class="text-light text-center">Artist Details</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr style="font-size: 13px;">
                                <th>#</th>
                                <th>Event Date</th>
                                <th>Venue</th>
                                <th>Event Time</th>
                                <th>Photographer Info</th>
                                <th>Cinematographer Info</th>
                                <th>Photo Editor Name</th>
                                <th>Video Editor Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $sl =0; @endphp
                            @foreach($uniqueDetailsIds as $id)
                                @php
                                    $event = App\Models\BackEnd\EventDetails::where('id',$id)->first();
                                    $assign_event = App\Models\BackEnd\EventDetailsLog::where('event_details_id',$id)->get();
                                @endphp
                                <tr style="font-size:14px">
                                    <td>{{++$sl}}</td>
                                    <td width="7%">{{$event->date}}</td>
                                    <td width="15%">{{$event->venue}}</td>
                                    <td width="7%">{{$event->start_time}}</td>
                                    <td width="20%">
                                        @foreach($assign_event as $v_event)
                                        @if($v_event->status == 1)
                                            <strong>Name : </strong> {{$v_event->user->name}} <br>
                                            <strong>Contact No : </strong> {{$v_event->user->phone}} <br>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td width="20%">
                                        @foreach($assign_event as $v_event)
                                        @if($v_event->status == 2)
                                            <strong>Name : </strong> {{$v_event->user->name}} <br>
                                            <strong>Contact No: </strong> {{$v_event->user->phone}} <br>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td width="20%">
                                        @foreach($assign_event as $v_event)
                                        @if($v_event->status == 3)
                                            <strong>Name : </strong> {{$v_event->user->name}}<br>
                                            <strong>Contact No: </strong> {{$v_event->user->phone}}<br>
                                        @endif
                                        @endforeach
                                    </td>
                                    <td width="20%">
                                        @foreach($assign_event as $v_event)
                                        @if($v_event->status == 4)
                                            <strong>Name : </strong> {{$v_event->user->name}}<br>
                                            <strong>Contact No: </strong> {{$v_event->user->phone}}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>
    </div>
@endsection