  @php
    $customerReviews = App\Models\CustomerExperience::where('detail_id', $detail->id)->get();
    $officeReviews = App\Models\OfficeExperience::where('detail_id', $detail->id)->get();
    $artistReviews = App\Models\BackEnd\PhotographerExperience::where('event_detail_id', $detail->id)->get();
@endphp

<div class="modal fade viewExperience-{{ $detail->id }}" id="viewExperience-{{ $detail->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-center">Event Experiences</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        @if (count($customerReviews) > 0)
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
                                    @foreach ($customerReviews as $v_review)
                                        <tr>
                                            <td class="p-3" width="10%">{{ $v_review->artist->name }}</td>
                                            <td class="p-3" width="15%">{{ $v_review->artist->designation }}</td>
                                            <td class="p-3 new-td" width="75%"> {{ $v_review->experience }}</td>
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
                                            <td class="p-3" width="10%">{{ $office_review->user->name }}</td>
                                            <td class="p-3" width="15%">{{ $office_review->user->designation }}
                                            </td>
                                            <td class="p-3 new-td" width="75%"> {{ $office_review->experience }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        @if (count($artistReviews) > 0)
                            <h5 class="text-center pt-4 pb-4">Artist Review To Customer</h5>
                            <table class="table table-hover table-bordered table-striped" width="100%">
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
                                            <td class="p-3" width="10%">{{ $artist_review->user->name }}</td>
                                            <td class="p-3" width="15%">{{ $artist_review->user->designation }}
                                            </td>
                                            <td class="p-3 new-td" width="75%"> {{ $artist_review->experience }}</td>
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
