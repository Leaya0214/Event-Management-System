@extends('BackEnd.master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')
 <h4 class="mb-4">Filter Data</h4>
<div class="row border-success p-2">
    <label for="" class="col-sm-2 form-label">From Date :</label>
    <div class="col-md-3">
        <input type="date" class="form-control" id="from_date" placeholder="Enter From Date" value="">
    </div>
    <label for="" class="col-sm-2 form-label">To Date :</label>
<div class="col-md-3">
    <input type="date" class="form-control" id="to_date" placeholder="Enter To Date"  value="">
</div>

<div class="col-md-2">
    <button type="button" class="btn btn-success" id="filterBtn">Filter</button>
</div>
</div>
<div class="col-md-12 grid-margin stretch-card mt-4">
    <div class="card">
        <div class="card-header">
            <div class="row  pr-3 mt-3">
                <div class="col-md-6">
                    <h6 class="">Event Footage Backup List </h6>
                    <p class="text-muted mb-3"></p>
                </div>
            </div>
        </div>
        <div class="card-body">
              
            <div class="table-responsive pt-3 ">
                <table class="table table-bordered table-hover user_table"
                style="width:100%; text-align:center;" data-table="true" id="eventDetailsTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Event Date</th>
                            <th>Event Venue</th>
                            <th>Footage Backup</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#eventDetailsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('get-list') }}',
                data: function(d) {
                    d.from_date = $('#from_date').val();
                    d.to_date = $('#to_date').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false },
                { data: 'date', name: 'date' },
                { data: 'venue', name: 'venue' },
                { data: 'footage', name: 'footage' },
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