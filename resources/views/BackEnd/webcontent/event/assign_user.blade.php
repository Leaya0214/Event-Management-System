   @php
       $eventDetails = $event->details;
   @endphp
   <div class="modal fade bg-dark photographer-{{ $event->id }}" id="photographer-{{ $event->id }}" tabindex="-1"
       role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <div class="modal-header bg-primary">
                   <h2 class="text-white text-center">Assign photographer</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <form action="{{ route('assignEvent') }}" method="POST" id="photographerAssignForm-{{ $event->id }}"
                   data-id="{{ $event->id }}">
                   @csrf
                   <div class="modal-body">
                       <div id="message-photographer-{{ $event->id }}" class="mt-3 border-1 p-2">

                       </div>
                       @php  $i = 0; @endphp
                       @foreach ($eventDetails as $detail)
                           @if ($detail->status != '0' && $detail->status != '2')
                               @php
                                   $i++;
                                   $assignPhotographer = App\Models\BackEnd\EventDetailsLog::where(
                                       'event_details_id',
                                       $detail->id,
                                   )->get();
                               @endphp

                               <div class="row-col-12">
                                   <h4 class="text-center mt-3 mb-4"> {{ $detail->type->type_name }}</h4>
                               </div>
                               <div class="form-group row pb-3">
                                   <div class="col-md-6">
                                       <strong>Event Date :</strong> {{ $detail->date }}<br>
                                       <strong class="mb-2">Event Time :</strong>
                                       {{ date('g:i a', strtotime($detail->start_time)) . ' - ' . date('g:i a', strtotime($detail->end_time)) }}<br>
                                       <strong class="mb-2">Event District
                                           :</strong>{{ $detail->district->district }}<br>
                                       <strong class="mb-2">Event Location :</strong>{{ $detail->venue }}<br>
                                   </div>
                                   <div class="col-md-6">
                                       <strong class="mb-2">Package :</strong>
                                       {{ $detail->category->category_name }}<br>
                                       <strong class="mb-2">Package Details :</strong>
                                       {{ $detail->package->name }}<br>
                                       <strong class="mb-2">Package Amount :</strong>
                                       {{ $detail->package->discount }}<br>
                                   </div>
                               </div>
                               <div class="form-group row pb-3">
                                   @if (
                                       $assignPhotographer->contains('event_details_id', $detail->id) &&
                                           in_array('1', $assignPhotographer->pluck('status')->toArray()))
                                       <div class="col-md-12">
                                           <strong> Assigned Photographer:</strong>
                                           @foreach ($assignPhotographer as $photographer)
                                               @if ($photographer->event_details_id == $detail->id && $photographer->status == 1)
                                                   {{ $photographer->user->name }},
                                               @endif
                                           @endforeach
                                       </div>
                                   @else
                                       <label class="col-sm-3">Select Photographer</label>
                                       <label class="col-sm-1">:</label>
                                       <div class="col-sm-6">
                                           <input type="hidden" name="status" value="1">
                                           <select name="user[{{ $detail->id }}][{{ $i }}]"
                                               class="form-control" id="userId-{{ $detail->id }}"
                                               onchange="filterCategory(this,{{ $detail->id }})">
                                               <option selected disabled>Choose Photographer..</option>
                                               @foreach ($users as $p_user)
                                                   @php
                                                       $positions = json_decode($p_user->position);
                                                   @endphp
                                                   @if ($positions && in_array('Photographer', $positions))
                                                       <option value="{{ $p_user->id }}{{ $p_user->category }}">
                                                           {{ $p_user->name }}-{{ $p_user->category }}-{{ $p_user->experience_level }}
                                                       </option>
                                                   @endif
                                               @endforeach
                                           </select>
                                       </div>
                                   @endif
                                   <div class="hide" id="hideDiv1-{{ $detail->id }}">
                                       <div class="form-group row pb-3 mt-3">
                                           <label class="col-sm-3">Amount</label>
                                           <label class="col-sm-1">:</label>
                                           <div class="col-sm-7">
                                               <input type="text"
                                                   name="payment[{{ $detail->id }}][{{ $i }}]"
                                                   id="payment{{ $detail->id }}" class="form-control payment"
                                                   value="" placeholder="Type Amount">
                                           </div>
                                       </div>
                                       {{-- <div class="form-group row pb-3">
                                            <label class="col-sm-3">Advance</label>
                                            <label class="col-sm-1">:</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="advance[{{ $detail->id }}][{{ $i }}]" id="advance{{ $detail->id }}"
                                                    class="form-control advance" value="" placeholder="Advance" onkeyup="calculateDueAmount(this)">
                                            </div>
                                        </div>
                                        <div class="form-group row pb-3">
                                            <label class="col-sm-3">Due</label>
                                            <label class="col-sm-1">:</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="due[{{ $detail->id }}][{{ $i }}]" id="due{{ $detail->id }}"
                                                    class="form-control due" value="" placeholder="Due">
                                            </div>
                                        </div> --}}
                                   </div>
                                   <div id="photographer-wrapper{{ $detail->id }}">
                                   </div>

                               </div>

                               <button type="button" class="col-sm-2 btn btn-success add mt-2"
                                   id="addpt-{{ $detail->id }}" onclick="addMore(this)">+ Add More
                               </button>
                           @endif
                       @endforeach
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                       <button type="submit" class="btn btn-primary">Save</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
   <div class="modal fade bg-dark cinematographer-{{ $event->id }}" id="cinematographer-{{ $event->id }}"
       tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <div class="modal-header bg-primary">
                   <h2 class="text-white text-center">Assign Cinematographer</h2>
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <form action="{{ route('assignEvent') }}" method="POST"
                   id="cinematographerAssignForm-{{ $event->id }}" data-id="{{ $event->id }}">
                   @csrf
                   <div class="modal-body">
                       <div id="message-cinematographer-{{ $event->id }}" class="mt-3 border-1 p-2">

                       </div>
                       @php $j = 0; @endphp
                       @foreach ($eventDetails as $c_detail)
                           @if ($c_detail->status != '0' && $c_detail->status != '2')
                               @php
                                   $j++;
                                   $assignCinematographer = App\Models\BackEnd\EventDetailsLog::where(
                                       'event_details_id',
                                       $c_detail->id,
                                   )->get();
                               @endphp
                               <input type="hidden" name="status" value="2">
                               <div class="row-col-12">
                                   <h4 class="text-center mt-3 mb-4"> {{ $c_detail->type->type_name }}</h4>
                               </div>
                               <div class="form-group row pb-3">
                                   <div class="col-md-6">
                                       <strong>Event Date :</strong> {{ $c_detail->date }}<br>
                                       <strong>Event Time :</strong>
                                       {{ date('g:i a', strtotime($c_detail->start_time)) . ' - ' . date('g:i a', strtotime($c_detail->end_time)) }}<br>
                                       <strong class="mb-3">Event District
                                           :</strong>{{ $c_detail->district->district }}<br>
                                       <strong class="mb-3">Event Location :</strong>{{ $c_detail->venue }}<br>
                                   </div>
                                   <div class="col-md-6">
                                       <strong>Package :</strong> {{ $c_detail->category->category_name }}<br>
                                       <strong>Package Details :</strong> {{ $c_detail->package->name }}<br>
                                       <strong>Package Amount :</strong> {{ $c_detail->package->discount }}<br>
                                   </div>
                               </div>
                               <div class="form-group row pb-3">
                                   @if (
                                       $assignCinematographer->contains('event_details_id', $c_detail->id) &&
                                           in_array('2', $assignCinematographer->pluck('status')->toArray()))
                                       <div class="col-md-12">
                                           <strong> Assigned Cinematographer:</strong>
                                           @foreach ($assignCinematographer as $cinematographer)
                                               @if ($cinematographer->event_details_id == $c_detail->id && $cinematographer->status == 2)
                                                   {{ $cinematographer->user->name }},
                                               @endif
                                           @endforeach
                                       </div>
                                   @else
                                       <label class="col-sm-3">Select Cinematographer</label>
                                       <label class="col-sm-1">:</label>
                                       <div class="col-sm-6">
                                           <select name="user[{{ $c_detail->id }}][{{ $j }}]"
                                               class="form-control" id="userId-{{ $c_detail->id }}"
                                               onchange="filterCategory(this,{{ $c_detail->id }})">
                                               <option selected disabled>Choose Cinematographer..</option>
                                               @foreach ($users as $c_user)
                                                   @php
                                                       $positions = json_decode($c_user->position);
                                                   @endphp
                                                   @if ($positions && in_array('Cinematographer', $positions))
                                                       <option value="{{ $c_user->id }}{{ $c_user->category }}">
                                                           {{ $c_user->name }}-{{ $c_user->category }}-{{ $c_user->experience_level }}
                                                       </option>
                                                   @endif
                                               @endforeach
                                           </select>
                                       </div>
                                   @endif
                                   <div class="hide" id="hideDiv2-{{ $c_detail->id }}">
                                       <div class="form-group row pb-3">
                                           <label class="col-sm-3">Amount</label>
                                           <label class="col-sm-1">:</label>
                                           <div class="col-sm-7">
                                               <input type="text"
                                                   name="payment[{{ $c_detail->id }}][{{ $j }}]"
                                                   id="payment" class="form-control" value=""
                                                   placeholder="Type Amount">
                                           </div>
                                       </div>
                                       {{-- <div class="form-group row pb-3">
                                        <label class="col-sm-3">Advance</label>
                                        <label class="col-sm-1">:</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="advance[{{ $c_detail->id }}]" id="advance"
                                                class="form-control" value="" placeholder="Advance">
                                        </div>
                                    </div>
                                    <div class="form-group row pb-3">
                                        <label class="col-sm-3">Due</label>
                                        <label class="col-sm-1">:</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="due[{{ $c_detail->id }}]" id="due"
                                                class="form-control" value="" placeholder="Due">
                                        </div>
                                    </div> --}}
                                   </div>

                                   <div id="cinematographer-wrapper{{ $c_detail->id }}">
                                   </div>
                               </div>
                               <button type="button" class="col-sm-2 btn btn-success add"
                                   id="addct-{{ $c_detail->id }}" onclick="addMore(this)">+ Add More</button>
                           @endif
                       @endforeach
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                       <button type="submit" class="btn btn-primary">Save</button>
                   </div>
               </form>

           </div>
       </div>
   </div>
   <div class="modal fade bg-dark photoeditor-{{ $event->id }}" id="photoEditor-{{ $event->id }}"
       tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <div class="modal-header bg-primary">
                   <h2 class="text-white text-center">Assign Photo Editor</h2>
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <form action="{{ route('assignEvent') }}" method="POST"
                   id="photoEditorAssignForm-{{ $event->id }}" data-id="{{ $event->id }}">
                   @csrf
                   <input type="hidden" name="status" value="3">
                   <div class="modal-body">
                       <div id="message-photoEditor-{{ $event->id }}" class="mt-3 border-1 p-2">

                       </div>
                       @foreach ($eventDetails as $pE_detail)
                           @php $k = 0; @endphp
                           @if ($pE_detail->status != '0' && $pE_detail->status != '2')
                               @php
                                   ++$k;
                                   $assignPhotoEditors = App\Models\BackEnd\EventDetailsLog::where(
                                       'event_details_id',
                                       $pE_detail->id,
                                   )->get();
                               @endphp
                               <div class="row-col-12">
                                   <h4 class="text-center mt-3 mb-4"> {{ $pE_detail->type->type_name }}</h4>
                               </div>
                               <div class="form-group row pb-3">
                                   <div class="col-md-6">
                                       <strong>Event Date :</strong> {{ $pE_detail->date }}<br>
                                       <strong>Event Time :</strong>
                                       {{ date('g:i a', strtotime($pE_detail->start_time)) . ' - ' . date('g:i a', strtotime($pE_detail->end_time)) }}<br>
                                       <strong class="mb-3">Event District
                                           :</strong>{{ $pE_detail->district->district }}<br>
                                       <strong class="mb-3">Event Location :</strong>{{ $pE_detail->venue }}<br>
                                   </div>
                                   <div class="col-md-6">
                                       <strong>Package :</strong> {{ $pE_detail->category->category_name }}<br>
                                       <strong>Package Details :</strong> {{ $pE_detail->package->name }}<br>
                                   </div>
                               </div>
                               <div class="form-group row pb-3">
                                   @if (
                                       $assignPhotoEditors->contains('event_details_id', $pE_detail->id) &&
                                           in_array('3', $assignPhotoEditors->pluck('status')->toArray()))
                                       <div class="col-md-12">
                                           <strong> Assigned Photo Editor:</strong>
                                           @foreach ($assignPhotoEditors as $p_editor)
                                               @if ($p_editor->event_details_id == $pE_detail->id && $p_editor->status == 3)
                                                   {{ $p_editor->user->name }},
                                               @endif
                                           @endforeach
                                       </div>
                                   @else
                                       <label class="col-sm-3">Select Photo Editor</label>
                                       <label class="col-sm-1">:</label>
                                       <div class="col-sm-6">
                                           <select name="user[{{ $pE_detail->id }}][{{ $k }}]"
                                               class="form-control" id="userId-{{ $pE_detail->id }}"
                                               onchange="filterCategory(this,{{ $pE_detail->id }})">
                                               <option selected disabled>Choose Photo Editor..</option>
                                               @foreach ($users as $pE_user)
                                                   @php
                                                       $positions = json_decode($pE_user->position);
                                                   @endphp
                                                   @if ($positions && in_array('Photo Editor', $positions))
                                                       <option value="{{ $pE_user->id }}{{ $pE_user->category }}">
                                                           {{ $pE_user->name }}-{{ $pE_user->category }}-{{ $pE_user->experience_level }}
                                                       </option>
                                                   @endif
                                               @endforeach
                                           </select>
                                       </div>
                                   @endif
                                   <button type="button" class="col-sm-2 btn btn-success add"
                                       id="addpE-{{ $pE_detail->id }}" onclick="addMore(this)">+ Add More</button>
                               </div>
                               <div class="hide" id="hideDiv3-{{ $pE_detail->id }}">
                                   <div class="form-group row pb-3">
                                       <label class="col-sm-3">Amount</label>
                                       <label class="col-sm-1">:</label>
                                       <div class="col-sm-7">
                                           <input type="text"
                                               name="payment[{{ $pE_detail->id }}][{{ $k }}]"
                                               id="payment" class="form-control" value=""
                                               placeholder="Type Amount">
                                       </div>
                                   </div>
                               </div>
                               <div id="photoEditor-wrapper{{ $pE_detail->id }}">
                               </div>
                           @endif
                       @endforeach
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                       <button type="submit" class="btn btn-primary">Save</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
   <div class="modal fade bg-dark cineeditor-{{ $event->id }}" id="cineEditor-{{ $event->id }}"
       tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <div class="modal-header bg-primary">
                   <h2 class="text-white text-center">Assign Cine Editor</h2>
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <form action="{{ route('assignEvent') }}" method="POST"
                   id="cineEditorAssignForm-{{ $event->id }}" data-id="{{ $event->id }}">
                   @csrf
                   <input type="hidden" name="status" value="4">
                   <div class="modal-body">
                       <div id="message-cineEditor-{{ $event->id }}" class="mt-3 border-1 p-2">

                       </div>
                       @php $l=0; @endphp
                       @foreach ($eventDetails as $cE_detail)
                           @if ($cE_detail->status != '0' && $cE_detail->status != '2')
                               @php
                                   ++$l;
                                   $assignCineEditor = App\Models\BackEnd\EventDetailsLog::where(
                                       'event_details_id',
                                       $cE_detail->id,
                                   )->get();
                               @endphp
                               <div class="row-col-12">
                                   <h4 class="text-center mt-3 mb-4"> {{ $cE_detail->type->type_name }}</h4>
                               </div>
                               <div class="form-group row pb-3">
                                   <div class="col-md-6">
                                       <strong>Event Date :</strong> {{ $cE_detail->date }}<br>
                                       <strong>Event Time :</strong>
                                       {{ date('g:i a', strtotime($cE_detail->start_time)) . ' - ' . date('g:i a', strtotime($cE_detail->end_time)) }}<br>
                                       <strong class="mb-3">Event District
                                           :</strong>{{ $cE_detail->district->district }}<br>
                                       <strong class="mb-3">Event Location :</strong>{{ $cE_detail->venue }}<br>
                                   </div>
                                   <div class="col-md-6">
                                       <strong>Package :</strong> {{ $cE_detail->category->category_name }}<br>
                                       <strong>Package Details :</strong> {{ $cE_detail->package->name }}<br>
                                   </div>
                               </div>
                               <div class="form-group row pb-3">
                                   @if (
                                       $assignPhotoEditors->contains('event_details_id', $cE_detail->id) &&
                                           in_array('4', $assignPhotoEditors->pluck('status')->toArray()))
                                       <div class="col-md-12">
                                           <strong> Assigned Cine Editor:</strong>
                                           @foreach ($assignPhotoEditors as $c_editor)
                                               @if ($c_editor->event_details_id == $cE_detail->id && $c_editor->status == 4)
                                                   {{ $c_editor->user->name }},
                                               @endif
                                           @endforeach
                                       </div>
                                   @else
                                       <label class="col-sm-3">Select Cine Editor</label>
                                       <label class="col-sm-1">:</label>
                                       <div class="col-sm-6">
                                           <select name="user[{{ $cE_detail->id }}][{{ $l }}]"
                                               class="form-control" id="userId-{{ $cE_detail->id }}"
                                               onchange="filterCategory(this,{{ $cE_detail->id }})">
                                               <option selected disabled>Choose Cine Editor..</option>
                                               @foreach ($users as $cE_user)
                                                   @php
                                                       $positions = json_decode($cE_user->position);
                                                   @endphp
                                                   @if ($positions && in_array('Cine Editor', $positions))
                                                       <option value="{{ $cE_user->id }}{{ $cE_user->category }}">
                                                           {{ $cE_user->name }}-{{ $cE_user->category }}-{{ $cE_user->experience_level }}
                                                       </option>
                                                   @endif
                                               @endforeach
                                           </select>
                                       </div>
                                   @endif
                                   <button type="button" class="col-sm-2 btn btn-success add"
                                       id="addcE-{{ $cE_detail->id }}" onclick="addMore(this)">+ Add More</button>
                               </div>

                               <div class="hide" id="hideDiv4-{{ $cE_detail->id }}">
                                   <div class="form-group row pb-3">
                                       <label class="col-sm-3">Amount</label>
                                       <label class="col-sm-1">:</label>
                                       <div class="col-sm-7">
                                           <input type="text"
                                               name="payment[{{ $cE_detail->id }}][{{ $l }}]"
                                               id="payment" class="form-control" value=""
                                               placeholder="Type Amount">
                                       </div>
                                   </div>
                               </div>
                               <div id="cineEditor-wrapper{{ $cE_detail->id }}">
                               </div>
                           @endif
                       @endforeach
                   </div>

                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                       <button type="submit" class="btn btn-primary">Save</button>
                   </div>
               </form>
           </div>
       </div>
   </div>

   <script>
       var t = 1;

       function addMore(e) {
           const text = e.id;
           const pId = text.replace('addpt-', '');
           const cId = text.replace('addct-', '');
           console.log(cId);
           const pEId = text.replace('addpE-', '');
           const cEId = text.replace('addcE-', '');
           t++;
           $('#photographer-wrapper' + pId).append(`
                <div class="col-md-12  mt-3">
                    <div class="form-group row pb-3">
                        <input type="hidden" name="status" value="1">
                                <label class="col-sm-3 ">Other Photographer</label>
                                <label  class="col-sm-1">:</label>
                                <div class="col-sm-6">
                                    <select name="user[` + pId + `][` + t + `]" class="form-control" id="userId-` +
               pId + `" onchange="filterAppendCategory(this,` + pId + `,` + t + `)">
                                        <option selected disabled>Choose Photographer..</option>
                                    @foreach ($users as $p_user)
                                        @php
                                            $positions = json_decode($p_user->position);
                                        @endphp
                                        @if ($positions && in_array('Photographer', $positions))
                                            <option value="{{ $p_user->id }}{{ $p_user->category }}">{{ $p_user->name }}-{{ $p_user->category }}-{{ $p_user->experience_level }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="hide" id="append1-` + pId + `` + t + `">
                                <div class="form-group row pb-3">
                                    <label  class="col-sm-3">Amount</label>
                                    <label  class="col-sm-1">:</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="payment[` + pId + `][` + t + `]" id="payment[` + pId + `]" class="form-control" value="" placeholder="Type Amount">
                                    </div>
                                </div>
                            </div>
                            <span class="remove btn btn-danger text-center" style="width: fit-content; margin-bottom:12px"><i class="fa fa-times"></i></span>
                </div>`)

           // $('.chosen-select').chosen({
           //     search_contains: true,
           // });

           $('#photographer-wrapper' + pId).on('click', '.remove', function() {
               $(this).parent().remove();
           });

           $('#cinematographer-wrapper' + cId).append(`
                <div class="col-md-12 mt-3">
                    <div class="form-group row pb-3 ">
                        <input type="hidden" name="status" value="2">
                                <label class="col-sm-3 ">Other Cinematographer</label>
                                <label  class="col-sm-1">:</label>
                                <div class="col-sm-6">
                                    <select name="user[` + cId + `][` + t + `]" class="form-control" id="userId-` +
               cId + `" onchange="filterAppendCategory(this,` + cId + `,` + t + `)">
                                        <option selected disabled>Choose Cinematographer..</option>
                                    @foreach ($users as $ct_user)
                                        @php
                                            $positions = json_decode($ct_user->position);
                                        @endphp
                                        @if ($positions && in_array('Cinematographer', $positions))
                                            <option value="{{ $ct_user->id }}{{ $ct_user->category }}">{{ $ct_user->name }}-{{ $ct_user->category }}-{{ $ct_user->experience_level }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="hide" id="append2-` + cId + `` + t + `">
                            <div class="form-group row pb-3">
                                <label  class="col-sm-3">Amount</label>
                                <label  class="col-sm-1">:</label>
                                <div class="col-sm-6">
                                    <input type="text" name="payment[` + cId + `][` + t + `]" id="payment[` + cId + `]" class="form-control" value="" placeholder="Type Amount">
                                </div>
                            </div>

                            </div>
                            <span class="remove btn btn-danger text-center" style="width: fit-content; margin-bottom:12px"><i class="fa fa-times"></i></span>
                </div>`)

           // $('.chosen-select').chosen({
           //     search_contains: true,
           // });

           $('#cinematographer-wrapper' + cId).on('click', '.remove', function() {
               $(this).parent().remove();
           });
           $('#photoEditor-wrapper' + pEId).append(`
                <div class="col-md-12  mt-3">
                    <div class="form-group row pb-3">
                        <input type="hidden" name="status" value="3">
                                <label class="col-sm-3 mt-3">Other Photo Editor</label>
                                <label  class="col-sm-1">:</label>
                                <div class="col-sm-6">
                                    <select name="user[` + pEId + `][` + t + `]" class="form-control" id="userId-` +
               pEId + `" onchange="filterAppendCategory(this,` + pEId + `,` + t + `)">
                                        <option selected disabled>Choose Photo Editor..</option>
                                    @foreach ($users as $pe_user)
                                        @php
                                            $positions = json_decode($pe_user->position);
                                        @endphp
                                        @if ($positions && in_array('Photo Editor', $positions))
                                            <option value="{{ $pe_user->id }}{{ $pe_user->category }}">{{ $pe_user->name }}-{{ $pe_user->category }}-{{ $pe_user->experience_level }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="hide" id="append3-` + pEId + `` + t + `">
                            <div class="form-group row pb-3">
                                <label  class="col-sm-3">Amount</label>
                                <label  class="col-sm-1">:</label>
                                <div class="col-sm-6">
                                    <input type="text" name="payment[` + pEId + `][` + t + `]" id="payment[` + pEId + `]" class="form-control" value="" placeholder="Type Amount">
                                </div>
                            </div>
                            </div>
                            <span class="remove btn btn-danger text-center" style="width: fit-content; margin-bottom:12px"><i class="fa fa-times"></i></span>
                </div>`)

           // $('.chosen-select').chosen({
           //     search_contains: true,
           // });

           $('#photoEditor-wrapper' + pEId).on('click', '.remove', function() {
               $(this).parent().remove();
           });
           $('#cineEditor-wrapper' + cEId).append(`
                <div class="col-md-12  mt-3">
                    <div class="form-group row pb-3">
                        <input type="hidden" name="status" value="4">
                                <label class="col-sm-3 mt-3">Other Cine Editor</label>
                                <label  class="col-sm-1">:</label>
                                <div class="col-sm-6">
                                    <select name="user[` + cEId + `][` + t + `]" class="form-control" id="userId-` +
               cEId + `" onchange="filterAppendCategory(this,` + cEId + `,` + t + `)">
                                        <option selected disabled>Choose Cine Editor..</option>
                                    @foreach ($users as $ce_user)
                                        @php
                                            $positions = json_decode($ce_user->position);
                                        @endphp
                                        @if ($positions && in_array('Cine Editor', $positions))
                                            <option value="{{ $ce_user->id }}{{ $ce_user->category }}">{{ $ce_user->name }}-{{ $ce_user->category }}-{{ $ce_user->experience_level }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="hide" id="append4-` + cEId + `` + t + `">
                            <div class="form-group row pb-3">
                                <label  class="col-sm-3">Amount</label>
                                <label  class="col-sm-1">:</label>
                                <div class="col-sm-6">
                                    <input type="text" name="payment[` + cEId + `][` + t + `]" id="payment[` + cEId + `]" class="form-control" value="" placeholder="Type Amount">
                                </div>
                            </div>
                            </div>
                            <span class="remove btn btn-danger text-center" style="width: fit-content; margin-bottom:12px"><i class="fa fa-times"></i></span>
                </div>`)

           // $('.chosen-select').chosen({
           //     search_contains: true,
           // });

           $('#cineEditor-wrapper' + cEId).on('click', '.remove', function() {
               $(this).parent().remove();
           });
       }
   </script>

   <script>
    $(document).ready(function() {
    // Handle photographer form submission
    $('form[id^="photographerAssignForm"]').off('submit').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var submitButton = form.find('button[type="submit"]');
        var formData = form.serialize();
        var modalBody = form.closest('.modal-content').find('.modal-body');
        var id = form.data('id');

        // Disable the submit button
        submitButton.prop('disabled', true);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            dataType: 'json',
        })
        .done((response) => {
            if (response.hasOwnProperty('message')) {
                modalBody.find('#message-photographer-' + id).html(
                    '<p class="text-success text-center">' + response.message + '</p>'
                );
                setTimeout(function() {
                    $('#photographer-' + id).modal('hide');
                    form[0].reset();
                }, 3000);
            } else {
                console.error('Unexpected response format:', response);
            }
        })
        .fail((xhr) => {
            console.error('Error updating data:', xhr.responseText);
        })
        .always(() => {
            // Re-enable the submit button
            submitButton.prop('disabled', false);
        });
    });

    $('form[id^="cinematographerAssignForm"]').off('submit').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var submitButton = form.find('button[type="submit"]');
        var formData = form.serialize();
        var modalBody = form.closest('.modal-content').find('.modal-body');
        var id = form.data('id');

        submitButton.prop('disabled', true);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            dataType: 'json',
        })
        .done((response) => {
            if (response.hasOwnProperty('message')) {
                modalBody.find('#message-cinematographer-' + id).html(
                    '<p class="text-success text-center">' + response.message + '</p>'
                );
                setTimeout(function() {
                    $('#cinematographer-' + id).modal('hide');
                    form[0].reset();
                }, 3000);
            } else {
                console.error('Unexpected response format:', response);
            }
        })
        .fail((xhr) => {
            console.error('Error updating data:', xhr.responseText);
        })
        .always(() => {
            submitButton.prop('disabled', false);
        });
    });

    // Handle photo editor form submission
    $('form[id^="photoEditorAssignForm"]').off('submit').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var submitButton = form.find('button[type="submit"]');
        var formData = form.serialize();
        var modalBody = form.closest('.modal-content').find('.modal-body');
        var id = form.data('id');

        // Disable the submit button
        submitButton.prop('disabled', true);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            dataType: 'json',
        })
        .done((response) => {
            if (response.hasOwnProperty('message')) {
                modalBody.find('#message-photoEditor-' + id).html(
                    '<p class="text-success text-center">' + response.message + '</p>'
                );
                setTimeout(function() {
                    $('#photoEditor-' + id).modal('hide');
                    form[0].reset();
                }, 3000);
            } else {
                console.error('Unexpected response format:', response);
            }
        })
        .fail((xhr) => {
            console.error('Error updating data:', xhr.responseText);
        })
        .always(() => {
            // Re-enable the submit button
            submitButton.prop('disabled', false);
        });
    });

    // Handle cine editor form submission
    $('form[id^="cineEditorAssignForm"]').off('submit').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var submitButton = form.find('button[type="submit"]');
        var formData = form.serialize();
        var modalBody = form.closest('.modal-content').find('.modal-body');
        var id = form.data('id');

        // Disable the submit button
        submitButton.prop('disabled', true);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            dataType: 'json',
        })
        .done((response) => {
            if (response.hasOwnProperty('message')) {
                modalBody.find('#message-cineEditor-' + id).html(
                    '<p class="text-success text-center">' + response.message + '</p>'
                );
                setTimeout(function() {
                    $('#cineEditor-' + id).modal('hide');
                    form[0].reset();
                }, 3000);
            } else {
                console.error('Unexpected response format:', response);
            }
        })
        .fail((xhr) => {
            console.error('Error updating data:', xhr.responseText);
        })
        .always(() => {
            // Re-enable the submit button
            submitButton.prop('disabled', false);
        });
    });
});
   </script>
