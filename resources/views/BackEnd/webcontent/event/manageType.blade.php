@extends('BackEnd.master')
<style>
    table tbody td {
        padding-left: 0 0 !important;
        font-size: 14px;
    }
    .modal-content iframe {
            margin: 0 auto;
            display: block;
    }
</style>
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row  pr-3">
                    <div class="col-md-6">
                        <h6 class="card-title">Event Type table</h6>
                        <p class="text-muted mb-3">Manage Types</p>
                    </div>
                    <div class="col-md-6 text-end">
                        {{-- <a href="" class="btn btn-md btn-info">
                        <i class="fa fa-plus"></i> Add Slider</a> --}}
                        @can('eventType.create')
                        <button type="button" class="btn btn-primary w-md" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <h6><i class="fas fa-plus"></i> Add Type</h6>
                        </button>
                        @endcan
                    </div>
                </div>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Event Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl = 0; ?>
                            @foreach ($types as $type)
                                <tr>
                                    <td>{{ ++$sl }}</td>
                                    <td>{{ $type->type_name }}</td>
                                    <td>
                                        @can('eventType.edit')
                                        @if ($type->status == 1)
                                        <a href="{{ route('type.status', $type->type_id) }}" style="padding:2px 4px 2px 0;" 
                                         style="text-decoration: none;border:none">
                                            <span
                                                style="background-color: rgb(66, 134, 66); color:white; border-radius:5px;"
                                                class="btn btn-xs btn-sm mr-1">Active</span>
                                        </a>
                                        @else
                                        <a href="{{ route('type.status', $type->type_id) }}" style="padding:2px 4px 2px 0;" 
                                            style="text-decoration: none; border:none;">
                                               <span
                                                   style="background-color: rgb(204, 20, 48); color:white; border-radius:5px;"
                                                   class="btn btn-xs btn-sm mr-1">Inactive</span>
                                           </a>
                                        @endif
                                        @endcan
                                    </td>
                                    <td>
                                        @can('eventType.edit')
                                        <a href="" data-toggle="modal" data-target=".edit-{{ $type->type_id }}"
                                            style="padding:2px; color:white" class="btn btn-xs btn-info btn-sm mr-1">
                                            <svg width="16" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </a>
                                        @endcan
                                        @can('eventType.delete')
                                        <a href="{{ route('type.delete', $type->type_id) }}"
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
                        
                                <div class="modal fade bg-dark edit-{{ $type->type_id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('type.update', $type->type_id) }}" method="POST"
                                                class="form-horizontal" enctype="multipart/form-type">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group row pt-3">
                                                        <label for="type_name" class="col-sm-3 col-form-label">Event Type</label>
                                                        <label for="" class="col-sm-1 col-form-label">:</label>
                                                        <div class="col-sm-8">
                                                            <input name="type_name" id="type_name" type="text" class="form-control" value="{{$type->type_name}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal  -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('type.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                     {{-- @isset($system) value="{{$system->title}}" @endisset   --}}
                    <div class="modal-body"> 
                        <div class="form-group row pt-3">
                            <label for="type_name" class="col-sm-3 col-form-label">Event Type Name</label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-8">
                                <input name="type_name" id="type_name" type="text" class="form-control">
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
@endsection

@section('js')
<script>
    $('.modal-body').resizable({
    alsoResize: "#video",
    minHeight: 150,
    minWidth: 200
}).bind({
    resizestop: function(event, ui){

        $('video').css({
            'height':ui.size.height - 60,
            'width': ui.size.width - 30
        });
    }
});
</script>
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('imageModal'), {});
        const trigg = document.querySelector('#modal-trigger');

        function showModal(el){
        el.show();
        }

        // Event 1:  show after 1 second:
        setTimeout(function() {
        showModal(myModal);
        trigg.style.display = 'inline-block';
        }, 1000)

        // Event 2: show on click:
        trigg.addEventListener('click', function(){
        showModal(myModal);
        });
    </script>
@endsection
