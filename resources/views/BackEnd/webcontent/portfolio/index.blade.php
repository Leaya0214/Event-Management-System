@extends('BackEnd.master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row  pr-3">
                <div class="col-md-6">
                    <h6 class="card-title">Portfolio Table</h6>
                    <p class="text-muted mb-3">Manage All Portfolio</p>
                </div>
                @can('portfolio.create')
                <div class="col-md-6 text-end">
                    <a href="{{route('portfolio.add')}}" class="btn btn-md btn-primary">
                    <i class="fa fa-plus"></i> Add New</a>

                </div>
                @endcan
            </div>
            <div class="table-responsive pt-3">
                <table class="table table-bordered table-hover"
                style="width:100%; text-align:center;" data-table="true" id="portfolioTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            {{-- <th>Portfolio Section</th> --}}
                            <th>Portfolio Type</th>
                            <th>Thumbnail Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach($portfolios as $portfolio)
<div class="modal fade bg-dark image_modal-{{ $portfolio->id }}" id=""
    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Portfolio Details</h5>
                <button type="button" class="close"
                data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group row pb-3">
                    <label  class="col-sm-2 col-form-label">Thumbnail Image</label>
                    <label  class="col-sm-1 col-form-label">:</label>
                    <div class="col-sm-9">
                        <img src="{{asset('backend/portfolio/'.$portfolio->image)}}" alt="" height="250" width="250">
                    </div>
                </div>
                @if($portfolio->video)
                <div class="form-group row pb-3">
                    <label  class="col-sm-2 col-form-label">Video</label>
                    <label  class="col-sm-1 col-form-label">:</label>
                    <div class="col-sm-9">
                        <iframe style="height:300px; width:100%;"
                        src="{{ getYoutubeEmbedUrl($portfolio->video) }}" frameborder="0"
                        allow="autoplay; encrypted-media" gesture="media"
                        allowfullscreen=""></iframe>
                    </div>
                </div>
                @endif
                <div class="form-group row pb-3">
                    <div class="col-sm-12">
                        <textarea name="" class="textarea form-control" id="" cols="30" rows="10">{!! $portfolio->description !!}</textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default"
                data-bs-dismiss="modal">close</button>
            </div>

        </div>
    </div>
</div>
@endforeach
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#portfolioTable').DataTable({
       processing: true,
       serverSide: true,
       ajax: '{{route('portfolio.all')}}',
       columns: [{
               data: 'DT_RowIndex',
               name: 'DT_RowIndex',
               searchable: false,
               orderable: false
           },
           {
               data: 'type',
               name: 'type'
           },
           {
               data: 'image',
               name: 'image'
           },
           {
               data: 'status',
               name: 'status'
           },
           {
               data: 'action',
               name: 'action'
           },
       ]
   });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(function () {
        $('.textarea').summernote({
            height:250
        })
    })
</script>
@endsection