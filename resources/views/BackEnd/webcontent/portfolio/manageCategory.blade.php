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
                        <h6 class="card-title">Portfolio Category</h6>
                        <p class="text-muted mb-3">Manage Data</p>
                    </div>
                    <div class="col-md-6 text-end">
                        @can('portfolio.create')
                        <button type="button" class="btn btn-primary w-md" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <h6><i class="fas fa-plus"></i> Add New</h6>
                        </button>
                        @endcan
                    </div>
                </div>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php $sl = 0; ?>
                            @foreach ($portfolioCategories as $category)
                                <tr>
                                    <td>{{ ++$sl }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @if ($category->status == 1)
                                            <span
                                                style="background-color: rgb(66, 134, 66); color:white; border-radius:5px;"
                                                class="btn btn-xs btn-sm mr-1">Active</span>
                                        @else
                                            <span style="color:white; border-radius:5px; background-color:rgb(177, 28, 2); "
                                                class="btn btn-xs  btn-sm mr-1">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @can('portfolio.edit')
                                        @if ($category->status == 1)
                                            <a href="{{ route('portfolio.category.status', $category->id) }}" style="padding:2px;"
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
                                            <a href="{{ route('portfolio.category.status', $category->id) }}"
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
                                        <a href="" data-bs-toggle="modal" data-bs-target=".edit-{{ $category->id }}"
                                            style="padding:2px; color:white" class="btn btn-xs btn-info btn-sm mr-1">
                                            <svg width="16" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </a>
                                        @endcan
                                        @can('portfolio.delete')

                                        <a href="{{ route('portfolio.category.delete', $category->id) }}"
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

                                {{-- Edit Modal - --}}
                                <div class="modal fade bg-dark edit-{{ $category->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('portfolio.category.update', $category->id) }}" method="POST"
                                                class="form-horizontal" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                
                                                    <div class="form-group row pt-3">
                                                        <label for="title" class="col-sm-3 col-form-label">Category
                                                            Name </label>
                                                        <label for="" class="col-sm-1 col-form-label">:</label>
                                                        <div class="col-sm-8">
                                                            <input name="name" type="text" class="form-control"
                                                                value="{{ $category->name }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('portfolio.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- @isset($system) value="{{$system->title}}" @endisset  --}}
                    <div class="modal-body"> 
                        <div class="form-group row pt-3">
                            <label for="position" class="col-sm-3 col-form-label">Category Name</label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-8">
                                <input name="name" type="text" class="form-control">
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
