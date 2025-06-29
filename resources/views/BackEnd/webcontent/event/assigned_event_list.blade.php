@extends('BackEnd.master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')
 <h4 class="mb-4">Filter Assign Event Data</h4>
            <div class="row">
            <label for="" class="col-sm-2 form-label">From Date :</label>
            <div class="col-md-3">
                <input type="date"  class="form-control" id="from_date" placeholder="Enter From Date" value="">
            </div>
            <label for="" class="col-sm-2 form-label">To Date :</label>
            <div class="col-md-3">
                <input type="date" class="form-control" id="to_date" placeholder="Enter To Date" value="">
            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-success" id="filterBtn">Filter</button>
            </div>
        </div>
<div class="col-md-12 grid-margin stretch-card mt-3">
    <div class="card">
        <div class="card-body">
              <div class="row  pr-3 mt-3">
                <div class="col-md-6">
                    <h6 class="">Assigned Event Details</h6>
                    <p class="text-muted mb-3"></p>
                </div>
            </div>
            <div class="table-responsive pt-3 ">
                <table class="table table-bordered table-hover user_table"
                style="width:100%; text-align:center;" data-table="true" id="eventDetailsTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Event Info</th>
                            <th>Photographer</th>
                            <th>Cinematographer</th>
                            <th>Photo Editor</th>
                            <th>Cine Editor</th>
                            {{-- <th></th> --}}
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

{{-- @foreach($blogs as $blog)
<div class="modal fade bg-dark image_modal-{{ $blog->id }}" id=""
    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Blog Details</h5>
                <button type="button" class="close"
                data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="text-center pb-3">{{$blog->title}}</h5>
                        <img src="{{asset('backend/blog/'.$blog->image)}}" alt="image"  height="500px">
                    </div>
                       <div class="col-md-12 mt-3">
                        <textarea class="form-control textarea" name="" id="" cols="30" rows="10">{!! $blog->description !!}</textarea>
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
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#eventDetailsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('assign-event-list') }}',
                data: function(d) {
                    d.from_date = $('#from_date').val();
                    d.to_date = $('#to_date').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false },
                { data: 'event_info', name: 'event_info' },
                { data: 'assigned_photographer', name: 'assigned_photographer' },
                { data: 'assigned_cinematographer', name: 'assigned_cinematographer' },
                { data: 'assigned_photoeditor', name: 'assigned_photoeditor' },
                { data: 'assigned_cineeditor', name: 'assigned_cineeditor' },
                { data: 'action', name: 'action' },
            ]
        });

        // Function to handle filter button click
        $('#filterBtn').click(function() {
            $('#eventDetailsTable').DataTable().ajax.reload();
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