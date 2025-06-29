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
</style>
@section('css')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
@endsection
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row  pr-3">
                    <div class="col-md-6">
                        <h6 class="card-title">User table</h6>
                        <p class="text-muted mb-3">Manage Users</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('user.create') }}" class="btn btn-md btn-primary">
                            <i class="fa fa-plus"></i> Add User </a>
                    </div>
                </div>
                <div class="table-responsive pt-3">
                    <table class="table table-striped table-bordered table-hover user_table" id="users"  
                    style="width:100%; text-align:center;"  data-table="true">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Designation</th>
                                <th>User Type</th>
                                <th>Address</th>
                                {{-- <th>Status</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        // var user = document.getElementById('users');

        // if(user){
        //     console.log('ok');
        // }
        $('#users').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('user.getUser')}}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'designation',
                    name: 'designation'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });
    });

</script>
@endsection
