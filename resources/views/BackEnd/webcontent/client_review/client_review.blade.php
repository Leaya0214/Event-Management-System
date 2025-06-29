@extends('BackEnd.master')
<style>

    table tbody td {
        padding-left: 25px !important;
        padding-top: 10px !important;
        font-size: 15px;
        color: rgba(20, 18, 18, 0.89);
    }
</style>
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row  pr-3">
                    <div class="col-md-6">
                        <h6 class="card-title">review table</h6>
                        <p class="text-muted mb-3">Manage reviews</p>
                    </div>
                    @can('clientReview.create')
                    <div class="col-md-6 text-end">
                        <a href="{{ route('client_review.add') }}" class="btn btn-md btn-primary">
                            <i class="fa fa-plus"></i> Add Review </a>
                    </div>
                    @endcan
                </div>
                <div class="table-responsive pt-3">
                    <table  class="table table-bordered table-hover user_table"
                    style="width:100%; text-align:center;" data-table="true">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Client Name</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Background Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl = 0; ?>
                            @foreach ($clientReviews as $review)
                                <tr>
                                    <td>{{ ++$sl }}</td>
                                    <td>{{ $review->client_name }}</td>
                                    <td>{{ $review->rating }}</td>
                                    <td>{!! Str::words($review->comment,15) !!}</td>
                                    <td>
                                        <img src="{{ asset('backend/client_review/' . $review->bg_image) }}"
                                        style="width:50px;height: 50px; border-radius:50%">
                                    </td>
                                   
                                    <td>
                                        @if ($review->status == 1)
                                            <span
                                                style="background-color: rgb(66, 134, 66); color:white; border-radius:5px;"
                                                class="btn btn-xs btn-sm mr-1">Active</span>
                                        @else
                                            <span style="color:white; border-radius:5px; background-color:rgb(177, 28, 2); "
                                                class="btn btn-xs  btn-sm mr-1">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @can('clientReview.edit')
                                        @if ($review->status == 1)
                                            <a href="{{ route('client_review.status', $review->id) }}" style="padding:2px;"
                                                class="btn btn-xs btn-success btn-sm mr-1">
                                                <svg xmlns="" width="16" height="14" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-arrow-up">
                                                    <line x1="12" y1="19" x2="12" y2="5">
                                                    </line>
                                                    <polyline points="5 12 12 5 19 12"></polyline>
                                                </svg></a>
                                        @else
                                            <a href="{{ route('client_review.status',$review->id) }}"
                                                style="padding:2px;background-color:rgb(202, 63, 82); color:white"
                                                class="btn btn-xs btn-sm mr-1"><svg width="16" height="14"
                                                    viewBox="0 0 26 26" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-arrow-down">
                                                    <line x1="12" y1="5" x2="12" y2="19">
                                                    </line>
                                                    <polyline points="19 12 12 19 5 12"></polyline>
                                                </svg></a>
                                        @endif
                                        {{-- <a href=""  data-bs-toggle="modal" 
                                            data-bs-target=".image_modal-{{ $review->id }}" style="padding:2px; color:white"
                                            class="btn btn-xs btn-info btn-sm mr-1">
                                            <svg  width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </a> --}}
                                        <a href="{{ route('client_review.edit',$review->id) }}" style="padding:2px;"
                                            class="btn btn-xs btn-primary btn-sm mr-1">
                                            <svg width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        </a>
                                        @endcan
                                        @can('clientReview.delete')
                                        <a href="{{ route('client_review.delete',$review->id) }}"
                                            onclick="return confirm('Are you sure you want to delete?');"
                                            style="padding: 2px;" class="delete btn btn-xs btn-danger btn-sm mr-1"><svg
                                                width="16" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg></a>
                                        @endcan
                                    </td>
                                </tr>
                                 {{-- View Modal -
                                <div class="modal fade bg-dark image_modal-{{ $review->id }}" id=""
                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                data-bs-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @php
                                                           $extension = pathinfo($review->image_video, PATHINFO_EXTENSION);
                                                        @endphp
                                                        @if($extension == 'jpg')
                                                         <img src="{{ asset('backend/review/' . $review->image_video) }}" alt=""  width="200" height="240">
                                                        @else
                                                        <iframe id="Geeks3" width="400" height="360"
                                                        src="{{ asset('backend/review/' . $review->image_video) }}"
                                                        frameborder="0" allowfullscreen>
                                                        </iframe>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12 mt-2">
                                                    {!! $review->description !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-default"
                                                data-bs-dismiss="modal">close</button>
                                            </div>

                                        </div>
                                    </div>
                                </div> --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
