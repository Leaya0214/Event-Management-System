@extends('BackEnd.master')
<style>
    table tbody td {
        padding-left: 25px !important;
        padding-top: 10px !important;
        font-size: 15px;
        color: rgba(20, 18, 18, 0.89);
    }

    table tbody td .description {
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
                        <h6 class="card-title">Events</h6>
                        <p class="text-muted mb-3"></p>
                    </div>
                </div>
                <div class="table-responsive pt-3">
                    <table class="table table-striped table-bordered table-hover user_table" id="staffEventTable"
                        style="width:100%; text-align:center;" data-table="true">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Booking Info</th>
                                <th>Event Date & Time</th>
                                <th>Event District</th>
                                <th>Event Venue</th>
                                <th>Action</th>
                                <th>Assigned User</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @foreach ($events as $v_event)
            @php
                $reviews = App\Models\CustomerExperience::where('detail_id', $v_event->eventDetail->id)->get();
                $officeReviews = App\Models\OfficeExperience::where('detail_id', $v_event->eventDetail->id)->get();
                $artistReviews = App\Models\BackEnd\PhotographerExperience::where(
                    'event_detail_id',
                    $v_event->eventDetail->id,
                )->get();
            @endphp
            <div class="modal fade bg-dark view_modal-{{ $v_event->id }}" id="" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Share Experience</h5>
                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                        </div>
                        <form action="{{ route('photographer.experience') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="event_detail_id" id=""
                                            value="{{ $v_event->eventDetail->id }}">
                                        <textarea class="form-control textarea" name="experience" id="" cols="30" rows="10"
                                            placeholder="Share Your Experience About This Event"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-sm btn-default" data-bs-dismiss="modal">close</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="modal fade viewExperience-{{ $v_event->id }}" id="" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="text-center">Event Experiences</h4>
                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    @if (count($reviews) > 0)
                                        <h5 class="text-center py-3">Customer Review To Artists</h5>
                                        <table class="table table-hover table-bordered table-striped" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="p-3" width="10%">Artist Name</th>
                                                    <th class="p-3" width="15%">Artist Designation</th>
                                                    <th class="p-3" width="75%">Customer Review</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <style>
                                                    td.p-3.new-td {
                                                        overflow: hidden;
                                                        text-overflow: ellipsis;
                                                        white-space: normal;
                                                        max-height: 500px;
                                                        width: 100%;
                                                        display: -webkit-box;
                                                        -webkit-line-clamp: 3;
                                                    }
                                                </style>
                                                @foreach ($reviews as $v_review)
                                                    <tr>
                                                        <td class="p-3" width="10%">{{ $v_review->artist->name }}</td>
                                                        <td class="p-3" width="15%">
                                                            {{ $v_review->artist->designation }}</td>
                                                        <td class="p-3 new-td" width="75%"> {{ $v_review->experience }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                    @if (count($officeReviews) > 0)
                                        <h5 class="text-center pt-4 pb-4">Office Review To Artists</h5>
                                        <table class="table table-hover table-bordered table-striped" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="p-3" width="10%">Artist Name</th>
                                                    <th class="p-3" width="15%">Artist Designation</th>
                                                    <th class="p-3" width="75%">Office Review</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <style>
                                                    td.p-3.new-td {
                                                        overflow: hidden;
                                                        text-overflow: ellipsis;
                                                        white-space: normal;
                                                        max-height: 500px;
                                                        width: 100%;
                                                        display: -webkit-box;
                                                        -webkit-line-clamp: 3;
                                                    }
                                                </style>
                                                @foreach ($officeReviews as $office_review)
                                                    <tr>
                                                        <td class="p-3" width="10%">{{ $office_review->user->name }}
                                                        </td>
                                                        <td class="p-3" width="15%">
                                                            {{ $office_review->user->designation }}</td>
                                                        <td class="p-3 new-td" width="75%">
                                                            {{ $office_review->experience }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                    @if (count($artistReviews) > 0)
                                        <h5 class="text-center pt-4 pb-4">Artist Review To Customer</h5>
                                        <table class="table table-hover table-bordered table-striped mb-5" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="p-3" width="10%">Artist Name</th>
                                                    <th class="p-3" width="15%">Artist Designation</th>
                                                    <th class="p-3" width="75%">Review</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <style>
                                                    td.p-3.new-td {
                                                        overflow: hidden;
                                                        text-overflow: ellipsis;
                                                        white-space: normal;
                                                        max-height: 500px;
                                                        width: 100%;
                                                        display: -webkit-box;
                                                        -webkit-line-clamp: 3;
                                                    }
                                                </style>
                                                @foreach ($artistReviews as $artist_review)
                                                    <tr>
                                                        <td class="p-3" width="10%">
                                                            {{ $artist_review->user->name }}</td>
                                                        <td class="p-3" width="15%">
                                                            {{ $artist_review->user->designation }}</td>
                                                        <td class="p-3 new-td" width="75%">
                                                            {{ $artist_review->experience }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade selections-{{ $v_event->id }}" id="" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="text-center">Client Selections</h4>
                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    @if ($v_event->eventDetail->photo_selection)
                                        <h5 class="text-center">Photo Selection</h5>
                                        <p>{!! $v_event->eventDetail->photo_selection !!}</p>
                                    @endif
                                    @if ($v_event->eventDetail->video_selection)
                                        <h5 class="text-center">Video Selection</h5>
                                        <p class="mt-4">{!! $v_event->eventDetail->video_selection !!}</p>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade viewDetail-{{ $v_event->id }}" id="" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="text-center">Client Selections</h4>
                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12  mt-4">
                                    <p class=""> <span class="text-bold" style="font-size:20px; "> <b>Client
                                                Instructions : </b></span>
                                        @if ($v_event->eventDetail->event->instructions)
                                            {{ $v_event->eventDetail->event->instructions }}
                                        @endif
                                    </p>
                                    <p></p>
                                </div>
                                <div class="col-md-12 mt-3 mb-3">
                                    <p class=""> <span class="text-bold" style="font-size:20px; "> <b>Office
                                                Instructions : </b></span>
                                        @if ($v_event->eventDetail->event->office_instructions)
                                            {{ $v_event->eventDetail->event->office_instructions }}
                                        @endif
                                    </p>
                                </div>

                                <div class="col-md-12 mt-3 mb-3 text-center ">
                                    <p class=""> <span class="text-bold" style="font-size:20px; "> <b>Client Info
                                            </b></span></p>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="p-3">Booking ID</th>
                                                    <th class="p-3">Client Name</th>
                                                    <th class="p-3">Client Email</th>
                                                    <th class="p-3">Phone</th>
                                                    <th class="p-3">Alternate Number</th>
                                                    <th class="p-3">Bride Name</th>
                                                    <th class="p-3">Groom Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="p-3">{{ $v_event->eventDetail->event->booking_id }}</td>
                                                    <td class="p-3">{{ $v_event->eventDetail->event->client->name }}
                                                    </td>
                                                    <td class="p-3">{{ $v_event->eventDetail->event->client->email }}
                                                    </td>
                                                    <td class="p-3">
                                                        {{ $v_event->eventDetail->event->client->primary_no }}</td>
                                                    <td class="p-3">
                                                        {{ $v_event->eventDetail->event->client->alternate_no }}</td>
                                                    <td class="p-3">{{ $v_event->eventDetail->event->bride_name }}</td>
                                                    <td class="p-3">{{ $v_event->eventDetail->event->groom_name }}</td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <h4 class="text-center mt-5 mb-2">Event Info </h4>
                                <div class="form-group row p-3">
                                    <label class="col-sm-2 p-1">Event Shift</label>
                                    <label class="col-sm-1 p-1">:</label>
                                    <div class="col-md-3 p-1">
                                        {{ $v_event->eventDetail->type->type_name }}
                                    </div>

                                    <label class="col-sm-2 p-1">Event Shift</label>
                                    <label class="col-sm-1 p-1">:</label>
                                    <div class="col-md-3 p-1">
                                        {{ $v_event->eventDetail->shift->shift_name }}
                                    </div>

                                    <label class="col-sm-2 p-1">Date</label>
                                    <label class="col-sm-1 p-1">:</label>
                                    <div class="col-md-3 p-1">
                                        {{ $v_event->eventDetail->date }}
                                    </div>
                                    <label class="col-sm-2 p-1">Time</label>
                                    <label class="col-sm-1 p-1">:</label>
                                    <div class="col-md-3 p-1">
                                        @php $time =date('g:i a',strtotime($v_event->eventDetail->start_time)).' - '.date('g:i a',strtotime($v_event->eventDetail->end_time))  @endphp
                                        {{ $time }}
                                    </div>
                                    <label class="col-sm-2 p-1">District</label>
                                    <label class="col-sm-1 p-1">:</label>
                                    <div class="col-md-3 p-1">
                                        {{ $v_event->eventDetail->district->district }}
                                    </div>
                                    <label class="col-sm-2 p-1">Venue</label>
                                    <label class="col-sm-1 p-1">:</label>
                                    <div class="col-md-3 p-1">
                                        {{ $v_event->eventDetail->venue }}
                                    </div>
                                    <label class="col-sm-2 p-1">Package</label>
                                    <label class="col-sm-1 p-1">:</label>
                                    <div class="col-md-3 p-1">
                                        {{ $v_event->eventDetail->category->category_name }}
                                    </div>
                                    <label class="col-sm-2 p-1">Package Details</label>
                                    <label class="col-sm-1 p-1">:</label>
                                    <div class="col-md-3 p-1">
                                        {{ $v_event->eventDetail->package->name }}
                                    </div>
                                </div>
                                <div class="row  mt-3 mb-5">
                                    <div class="col-md-12 ">
                                        <p class=""> <span class="text-bold" style="font-size:20px; "> <b>Add ONS :
                                                </b></span>
                                            @if ($v_event->eventDetail->add_ons)
                                                {{ $v_event->eventDetail->add_ons }}
                                            @endif
                                        </p>
                                        <p></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    @endsection



    @section('js')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#staffEventTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('stuff.event.all') }}',
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
                            data: 'district',
                            name: 'district'
                        },
                        {
                            data: 'venue',
                            name: 'venue'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                        {
                            data: 'assign_user',
                            name: 'assign_user'
                        },
                    ]
                });
            });
        </script>
    @endsection
