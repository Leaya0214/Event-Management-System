  @php
    $details  = $event->details;
    $eventDetails = $event->details;
    $payment = $event->payment;
@endphp

 <div class="modal fade" id="view_modal-{{ $event->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl ">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h3 class="text-white">Event Information</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
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
                                            <td class="p-3">{{ $event->booking_id }}</td>
                                            <td class="p-3">{{ $event->client->name }}</td>
                                            <td class="p-3">{{ $event->client->email }}</td>
                                            <td class="p-3">{{ $event->client->primary_no }}</td>
                                            <td class="p-3">{{ $event->client->alternate_no }}</td>
                                            <td class="p-3">{{ $event->bride_name }}</td>
                                            <td class="p-3">{{ $event->groom_name }}</td>

                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            @if($payment)
                            <div class="col-md-12 mt-3">
                                <h3 class="text-center mb-3">Payment Information</h3>
                                <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="p-3">Booking ID</th>
                                            <th class="p-3">Payment Amount</th>
                                            <th class="p-3">Paid</th>
                                            <th class="p-3">Due</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="p-3">{{ $payment->event_master->booking_id }}</td>
                                            <td class="p-3">{{ $payment->payment_amount }}</td>
                                            <td class="p-3">{{ $payment->advance }}</td>
                                            <td class="p-3">{{ $payment->due_amount }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            @endif
                             <div class="col-md-12  mt-4">
                                <p class=""> <span class="text-bold" style="font-size:20px; "> <b>Client Instructions : </b></span> {{ $event->instructions }}</p>
                                <p></p>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
                                <p class=""> <span class="text-bold" style="font-size:20px; "> <b>Office Instructions : </b></span> {{ $event->office_instructions }}</p>
                            </div>
                        </div>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($eventDetails as $detail)
                          @php
                            $footages  = App\Models\BackEnd\FootageBackup::where('event_details_id', $detail->id)->get();
                        @endphp
                            <h4 class="text-center mt-5 mb-2">Event-{{++$i}} : {{ $detail->type->type_name }}</h4>
                            <div class="form-group row p-3">
                                <label class="col-sm-2 p-1">Event Shift</label>
                                <label class="col-sm-1 p-1">:</label>
                                <div class="col-md-3 p-1">
                                    {{ $detail->shift->shift_name }}
                                </div>
                                <label class="col-sm-2 p-1">Date</label>
                                <label class="col-sm-1 p-1">:</label>
                                <div class="col-md-3 p-1">
                                    {{ $detail->date }}
                                </div>
                                <label class="col-sm-2 p-1">Time</label>
                                <label class="col-sm-1 p-1">:</label>
                                <div class="col-md-3 p-1">
                                    @php $time =date('g:i a',strtotime($detail->start_time)).' - '.date('g:i a',strtotime($detail->end_time))  @endphp
                                    {{ $time }}
                                </div>
                                <label class="col-sm-2 p-1">District</label>
                                <label class="col-sm-1 p-1">:</label>
                                <div class="col-md-3 p-1">
                                    {{ $detail->district->district }}
                                </div>
                                <label class="col-sm-2 p-1">Venue</label>
                                <label class="col-sm-1 p-1">:</label>
                                <div class="col-md-3 p-1">
                                    {{ $detail->venue }}
                                </div>
                                <label class="col-sm-2 p-1">Package</label>
                                <label class="col-sm-1 p-1">:</label>
                                <div class="col-md-3 p-1">
                                    {{ $detail->category->category_name }}
                                </div>
                                <label class="col-sm-2 p-1">Package Details</label>
                                <label class="col-sm-1 p-1">:</label>
                                <div class="col-md-3 p-1">
                                    {{ $detail->package->name }}
                                </div>
                                <!--<label class="col-sm-2 p-1">Price</label>-->
                                <!--<label class="col-sm-1 p-1">:</label>-->
                                <!--<div class="col-md-3 p-1">-->
                                <!--    {{ $detail->package_price ? $detail->package_price: $detail->package->discount  }}-->
                                <!--</div>-->
                                @if ($detail->transportation != null || $detail->accomodation != null || $detail->shift_charge != null)
                                    <label class="col-sm-2 p-1">Transportation</label>
                                    <label class="col-sm-1 p-1">:</label>
                                    <div class="col-md-3 p-1">
                                        {{ $detail->transportation }}
                                    </div>
                                    <label class="col-sm-2 p-1">Accomodation</label>
                                    <label class="col-sm-1 p-1">:</label>
                                    <div class="col-md-3 p-1">
                                        {{ $detail->accomodation }}
                                    </div>
                                    <label class="col-sm-2 p-1">Shift Charge</label>
                                    <label class="col-sm-1 p-1">:</label>
                                    <div class="col-md-3 p-1">
                                        {{ $detail->shift_charge }}
                                    </div>
                                    <label class="col-sm-2 p-1">Total Price</label>
                                    <label class="col-sm-1 p-1">:</label>
                                    <div class="col-md-3 p-1">
                                        {{ $detail->package_price }}
                                    </div>
                                @endif
                                @if($detail->add_ons)
                                <label class="col-sm-2 p-1">Add Ons</label>
                                    <label class="col-sm-1 p-1">:</label>
                                    <div class="col-md-3 p-1">
                                        {{ $detail->add_ons }}
                                    </div>
                                @endif
                                @if(count($footages)>0)
                                <h4 class="mt-3 mt-5 text-center">Footage Backup</h4>
                                @foreach($footages as $footage)
                                    <div class="col-md-12 p-1 text-center">
                                        <br>{{ $footage->footage_backup }}
                                    </div>
                                @endforeach
                                @endif
                                @if($detail->photo_selection ||$detail->video_selection)<h4 class="mt-3 mt-5 text-center">Client Selections </h4> @endif
                                @if($detail->photo_selection)
                                <label class="col-sm-2 p-1 mt-3">Photo Selection</label>
                                <label class="col-sm-1 p-1 mt-3">:</label>
                                <div class="col-md-9 p-1 mt-3">
                                    {!! $detail->photo_selection !!}<br>
                                </div>
                                @endif
                                @if($detail->video_selection)
                                <label class="col-sm-2 p-1">Video Selection</label>
                                <label class="col-sm-1 p-1">:</label>
                                <div class="col-md-3 p-1">
                                    {{ $detail->video_selection }}
                                </div>
                                @endif
                            </div>
                            @php $user = App\Models\BackEnd\EventDetailsLog::where('event_details_id',$detail->id)->get(); @endphp
                            @if(count($user)>0)
                            <h4 class="mt-3 mb-2 text-center">Assigned User</h4>
                            <h5 id="delteMessage"></h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover" id="assignUserTable" >
                                        <thead>
                                            <tr>
                                                <th class="p-3">Name</th>
                                                <th class="p-3">Email</th>
                                                <th class="p-3">Mobile No.</th>
                                                <th class="p-3">Position</th>
                                                <th class="p-3">Category</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($user as $v_user)
                                            <tr data-id="{{ $v_user->id}}">
                                                <td class="p-3">{{$v_user->user->name}}</td>
                                                <td class="p-3">{{$v_user->user->email}}</td>
                                                <td class="p-3">{{$v_user->user->phone}}</td>
                                                <td class="p-3">
                                                    @if($v_user->status==1) Photographer
                                                    @elseif($v_user->status==2) Cinematographer
                                                    @elseif($v_user->status==3) Photo Editor
                                                    @else Cine Editor
                                                    @endif
                                                </td>
                                                <td class="p-3">{{$v_user->user->category}}</td>
                                                 <td>
                                                    <a
                                                    onclick="deleteassignUser('{{ $v_user->id }}')"
                                                    data-id="{{ $v_user->id  }}"
                                                    href="javascript:void(0);"
                                                    class="btn btn-danger delete">
                                                    <i class="fa fa-minus"></i>
                                                </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                        @endforeach

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">close</button>
                    </div>
                </div>
            </div>
        </div>
