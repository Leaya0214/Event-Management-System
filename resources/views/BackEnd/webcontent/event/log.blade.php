  @php
            $activity_logs = App\Models\ActivityLog::where('master_id', $event->id)->get();
        @endphp
        <div class="modal fade " id="activity_log-{{ $event->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl ">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h3 class="text-white">Activity Log</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover log-table">
                                    <thead>
                                        <tr>
                                            <th class="p-3" width="5%">Edited Date</th>
                                            <th class="p-3" width="90%">Activity Log</th>
                                            <th class="p-3" width="5%">Created By</th>
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
                                        @foreach($activity_logs as $v_log)
                                        <tr>
                                            <td class="p-3" width="5%">{{ $v_log->created_at->todatestring() }}</td>
                                            <td class="p-3 new-td" >{!! $v_log->log !!}</td>
                                            <td class="p-3" width="5%">@if($v_log->user){{ $v_log->user->name }}@endif</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <!--<button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Update</button>-->
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">close</button>
                    </div>
                </div>
            </div>
        </div>
