@extends('BackEnd.master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

@endsection
@section('content')
<div class="col-md-12">
        <div class="card">
            <div class="card-header text-center">
                <h4>Filter Expense Data</h4> 
            </div>
            <div class="card-body">
                @if (check_permission('expense.add'))
                <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2 text-end">
                        <a class="btn btn-md btn-success" href="{{route('expense.add')}}"> <i class="fa fa-plus"></i> Add Expense</a>
                    </div>
                </div>
                @endif
                <form action="">
                    <div class="form-group row pb-3" id="bank">
                        <div class="col-md-4">
                            <label for="name" class="col-form-label">Expense Type</label>
                            <select name="expense_type" id="expense_type" class="form-control form-select chosen-select">
                                <option value="" selected disabled>Select Type</option>
                                <option value="Fixed">Fixed</option>
                                <option value="Office Expense">Office Expense</option>
                                <option value="Variable">Variable</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="name" class="col-form-label">Expense Category</label>
                            <select name="category_id" id="category_id" class="form-control form-select chosen-select">
                                <option value="" selected disabled>Select Category</option>
                                @foreach($expenseCategory as $category)
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
        <a href="{{url('account/expese-print')}}" onClick="printDiv('printDiv'); " target="_blank" class="btn btn-warning float-end m-2" >
            <i class="fa fa-print" aria-hidden="true"></i> Print 
        </a>
    </div>
</div>

<div class="col-md-12 grid-margin stretch-card mt-3">
    <div class="card">
        <div class="card-body">
            <div class="row  pr-3">
                <div class="col-md-6">
                    <h6 class="card-title">Expense Table</h6>
                    <p class="text-muted mb-3">Manage Expenses</p>
                </div>
            </div>
            <div class="table-responsive pt-3">
                <table class="table table-bordered table-hover user_table"
                style="width:100%; text-align:center;" data-table="true" id="expenseTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Inv.</th>
                            <th>Expense Date</th>
                            <th>Expense Amount</th>
                            <th>Expense Category</th>
                            <th>Expense Type</th>
                            <th>Expense Details</th>
                            <th>Action</th>
                            <th>Expense For</th>
                            <th>Payment Type</th>
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
        function load_data(from_date ="", to_date="", expense_type="",category_id =""){
            $('#expenseTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('expense.all') }}',
                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        expense_type: expense_type,
                        category_id : category_id
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
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'remarks',
                        name: 'remarks'
                    },
                        {
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'expense_for',
                        name: 'expense_for'
                    },
                    
                    {
                        data: 'payment_type',
                        name: 'payment_type'
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
            var expense_type = document.getElementById('expense_type').value;
            var from_date = document.getElementById('from-date').value;
            var to_date = document.getElementById('to-date').value;
            var category_id = document.getElementById('category_id').value;
            var urldata = '{!! route('expense.all') !!}';
            $.ajax({
            type: "GET",
            url: urldata,
            data: {
                from_date,
                to_date,
                expense_type,
                category_id
            },
            success: function(data) {
                $('#expenseTable').DataTable().destroy();
                load_data(from_date,to_date,expense_type,category_id)
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
                url: '/account/delete-expense/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('Data deleted successfully');
                    var table = $('#expenseTable').DataTable();
                        var rowToDelete = table.row($('.delete[data-id="' + id + '"]').closest('tr')); // Target specific row using delete button (if applicable)

                        if (rowToDelete.length) { // Check if row exists before removal
                            rowToDelete.remove().draw();
                        } else {
                            // Handle potential row not found scenario (optional)
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