@extends('BackEnd.master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

@endsection
@section('content')
<div class="col-md-12">
        <div class="card">
            <div class="card-header text-center">
                <h4>Filter Income Data</h4> 
            </div>
            <div class="card-body">
                @if (check_permission('income.add'))
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2 text-end">
                            <a class="btn btn-md btn-success" href="{{route('income.add')}}"> <i class="fa fa-plus"></i> Add Income</a>
                        </div>
                    </div>
                @endif
                <form action="">
                    <div class="form-group row pb-3" id="bank">
                        <div class="col-md-4">
                            <label for="name" class="col-form-label">Income Category</label>
                            <select name="category_id" id="category_id" class="form-control form-select chosen-select">
                                <option value="" selected disabled>Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="name" class="col-form-label">From Date</label>
                            <input type="date" name="from_date" id="from-date" class="form-control"
                                placeholder="">
                        </div>
                        <div class="col-md-4">
                            <label for="name" class="col-form-label">To Date</label>
                            <input type="date" name="to_date" id="to-date" class="form-control"
                                placeholder="">
                        </div>
                        <div class="col-sm-2">
                            <button type="button" id="filter" class="btn btn-primary " style="margin-top: 37px;">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>

<div class="row">
    <div class="col-12 text-right">
        {{-- <a href="{{url('account/expese-print')}}" onClick="printDiv('printDiv'); " target="_blank" class="btn btn-warning float-end m-2" >
            <i class="fa fa-print" aria-hidden="true"></i> Print 
        </a> --}}
    </div>
</div>

<div class="col-md-12 grid-margin stretch-card mt-3">
    <div class="card">
        <div class="card-body">
            <div class="row  pr-3">
                <div class="col-md-6">
                    <h6 class="card-title">Income Table</h6>
                    <p class="text-muted mb-3">Manage Incomes</p>
                </div>
            </div>
            <div class="table-responsive pt-3">
                <table class="table table-bordered table-hover user_table"
                style="width:100%; text-align:center;" data-table="true" id="incomeTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Inv.</th>
                            <th>Income Date</th>
                            <th>Income Amount</th>
                            <th>Income Category</th>
                            <th>Note</th>
                            <th>Payment Type</th>
                            <th>Action</th>
                            <th>Document</th>
                            <th>Transaction ID</th>
                            <th>Account No</th>
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
        load_data();
        function load_data(from_date ="", to_date="", category_id=""){
            $('#incomeTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('income.all') }}',
                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        category_id: category_id
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'invoice',
                        name: 'invoice'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'remarks',
                        name: 'remarks'
                    },
                    {
                        data: 'payment_type',
                        name: 'payment_type'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'document',
                        name: 'document'
                    },
                    {
                        data: 'transaction_id',
                        name: 'transaction_id'
                    },
                    {
                        data: 'account_no',
                        name: 'account_no'
                    },
                    
                ]
            });
    }
       
   $('#filter').click(function () {
            var category_id = document.getElementById('category_id').value;
            var from_date = document.getElementById('from-date').value;
            var to_date = document.getElementById('to-date').value;
            var urldata = '{!! route('income.all') !!}';
            $.ajax({
            type: "GET",
            url: urldata,
            data: {
                from_date,
                to_date,
                category_id
            },
            success: function(data) {
                $('#incomeTable').DataTable().destroy();
                load_data(from_date,to_date,category_id)
            }
        });
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


<script>
    function viewBalanceSheet(){
        $('#main_table').hide();
        $('.btn-warning').hide();
        var start_date = document.getElementById('fromDate').value;
        var end_date = document.getElementById('toDate').value;
        var url = "{{route('filter.balance.sheet')}}"

        $.ajax({
            type:'GET',
            url:url,
            data:{start_date,end_date},
            success:function(data){
                $('#wrapper').html(data);
            }
        });
    }

    function deleteData(id) {
        if (confirm('Are you sure you want to delete this data?')) {
            $.ajax({
                url: '/account/delete-income/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('Data deleted successfully');
                    var table = $('#incomeTable').DataTable();
                        var rowToDelete = table.row($('.delete[data-id="' + id + '"]').closest('tr')); 

                        if (rowToDelete.length) { 
                            rowToDelete.remove().draw();
                        } else {
                            console.warn('Row with ID ' + id + ' not found in DataTable');
                        }
                },
                error: function(xhr) {
                    console.error('Error deleting data:', xhr.responseText);
                }
            });
        }
    }
</script>
@endsection