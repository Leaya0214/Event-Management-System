@extends('FrontEnd.profile.profile')
@section ('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="background: #947bb4">
                <h4 class="text-light text-center">Event Details</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr style="font-size: 13px;">
                            <th>#</th>
                            <th>Event Date</th>
                            <th>Venue</th>
                            <th>Event Time</th>
                            <th>Location</th>
                            <th>Event Type</th>
                            <th>Package Name</th>
                            <th>Package Details</th>
                            <th>Instructions</th>
                            <th>Photo & Video selection</th>
                            <th>Status</th>  
                        </tr>
                    </thead>
                    <tbody>
                        @php $sl = 0; @endphp
                        @foreach($events as $v_event)
                        @php  $details = App\Models\BackEnd\EventDetails::where('master_id',$v_event->id)->whereNotIn('status',[0,2])->get() @endphp
                            @foreach($details as $v_detail)
                                <tr style="font-size:14px">
                                    <td>{{++$sl}}</td>
                                    <td>{{$v_detail->date}}</td>
                                    <td>{{$v_detail->venue}}</td>
                                    <td>{{date('g:i a',strtotime($v_detail->start_time)).' - '.date('g:i a',strtotime($v_detail->end_time))}}</td>
                                    <td>{{$v_detail->district->district}}</td>
                                    <td>{{$v_detail->type->type_name}}</td>
                                    <td>{{$v_detail->category->category_name}}</td>
                                    <td>{{$v_detail->package->name}}</td>
                                    <td>{{$v_event->instructions}}</td>
                                    <td>
                                        <a data-bs-toggle="modal"
                                            data-bs-target="#exampleModal-{{$v_detail->id}}" class="btn btn-xs" style="font-size:12px; background-color:#ec8a5c">Click Here</a>
                                        {{-- <a href="#" class="btn btn-warning btn-sm mt-2"></a> --}}
                                    </td>
                                    <td>
                                        @if($v_detail->status == 1)
                                            <button class="btn btn-success btn-sm">Active</button>
                                        @elseif($v_detail->status == 3)
                                            <button class="btn btn-info btn-sm">Raw Collection</button>
                                        @elseif($v_detail->status == 4)
                                            <button class="btn btn-success btn-sm">Photo Edit</button>
                                        @elseif($v_detail->status == 5)
                                            <button class="btn btn-info btn-sm">Video Edit</button>
                                        @elseif($v_detail->status == 6)
                                            <button class="btn btn-success btn-sm">Delivered</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>  
    </div>
</div>
@foreach($events as $event)
@php  $details = App\Models\BackEnd\EventDetails::where('master_id',$event->id)->whereNotIn('status',[0,2])->get() @endphp
@foreach($details as $detail)
    <div class="modal fade" id="exampleModal-{{$detail->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Photo and Video Selection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('store-info') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- @isset($system) value="{{$system->title}}" @endisset  --}}
                    <div class="modal-body"> 
                        <input type="hidden" name="event_id" value="{{$detail->id}}">
                    <div class="form-group row pt-3">
                            <label for="image" class="col-sm-3 col-form-label text-bold">Photo Selection</label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-8">
                                <textarea name="photo_selection" class="form-control" id="" cols="10" rows="6" placeholder="Drive Link or Type Place Name">@if($detail->photo_selection != null){!! $detail->photo_selection !!} @endif</textarea>
                            </div>
                        </div>
                        <div class="form-group row pt-3">
                            <label for="position" class="col-sm-3 col-form-label text-bold">Video Song Selection</label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-8">
                                <textarea name="video_selection" class="form-control" id="" cols="10" rows="6" placeholder="Video song Links...">@if($detail->video_selection != null){!! $detail->video_selection !!} @endif</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
@endforeach
@endsection
