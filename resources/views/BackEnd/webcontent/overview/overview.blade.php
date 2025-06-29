@extends('BackEnd.master')
<style>
    table tbody td {
        padding-left: 25px !important;
        padding-top: 10px !important;
        font-size: 15px;
        color: rgba(20, 18, 18, 0.89);
    }
    table tbody td .description{
        text-align: center !important;
        align-items: center;
    }
    .description .container{
        margin:0px !important;
        width:100%;
    }
    
    
</style>

<style>
    .description {
        max-height: 100px; /* Adjust height as needed */
        overflow: hidden; /* Hide overflow */
        text-overflow: ellipsis; /* Show ellipsis for overflowing text */
        white-space: nowrap; /* Prevent wrapping */
    }
    
    .description .header{
        margin:0px !important;
        padding:0px !important;
    }
    
    .description .container{
        margin:0px !important;
        padding:0px !important;
    }

    .description.expanded {
        max-height: none; /* Remove height restriction when expanded */
        white-space: normal; /* Allow wrapping */
    }

    .expand-btn {
        cursor: pointer;
        color: #007bff; /* Bootstrap primary color */
        text-decoration: underline;
    }
</style>


@section('css')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row  pr-3">
                    <div class="col-md-6">
                        <h6 class="card-title">content table</h6>
                        <p class="text-muted mb-3">Manage contents</p>
                    </div>
                    @can('staticContent.create')
                    <div class="col-md-6 text-end">
                        <a href="{{ route('content.add') }}" class="btn btn-md btn-primary">
                            <i class="fa fa-plus"></i> Add New </a>
                    </div>
                    @endcan
                </div>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th width="10%">Content</th>
                                <th width="20%">Image</th>
                                <th width="20%">Details</th>
                                <th width="10%">Status</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl = 0; ?>
                            @foreach ($contents as $content)
                                <tr>
                                    <td width="10%">{{ ++$sl }}</td>
                                    <td width="10%">{{ $content->type }}</td>
                                    <td width="10%">
                                        @if($content->image)
                                        <img src="{{ asset('backend/content/' . $content->image) }}"
                                            style="width:150;height: 60px; border-radius:0%">
                                         @endif
                                    </td>
                                    <td class="description" width="20%">
                                        <div id="descriptionContent" class="description">
                                            {!! $content->description !!}
                                        </div>
                                        <span id="expandButton" class="expand-btn">Read more</span>
                                    </td>

                                    <td  width="10%">
                                        @if ($content->status == 1)
                                            <span
                                                style="background-color: rgb(66, 134, 66); color:white; border-radius:5px;"
                                                class="btn btn-xs btn-sm mr-1">Active</span>
                                        @else
                                            <span style="color:white; border-radius:5px; background-color:rgb(177, 28, 2); "
                                                class="btn btn-xs  btn-sm mr-1">Inactive</span>
                                        @endif
                                    </td>
                                    <td  width="20%">
                                        @can('staticContent.edit')
                                        @if ($content->status == 1)
                                            <a href="{{ route('content.status', $content->id) }}" style="padding:2px;"
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
                                            <a href="{{ route('content.status',$content->id) }}"
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
                                        <a href="{{ route('content.edit',$content->id) }}" style="padding:2px;"
                                            class="btn btn-xs btn-primary btn-sm mr-1">
                                            <svg width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        </a>
                                        @endcan
                                        @can('staticContent.delete')
                                        <a href="{{ route('content.delete',$content->id) }}"
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
    <script>
                document.getElementById('expandButton').addEventListener('click', function() {
                var descriptionContent = document.getElementById('descriptionContent');
                descriptionContent.classList.toggle('expanded');
        
                // Change the button text based on the state
                this.textContent = descriptionContent.classList.contains('expanded') ? 'Read less' : 'Read more';
            });
    </script>

@endsection
