@extends('BackEnd.master')
<style>
    table tbody td {
        padding-left: 25px !important;
        padding-top: 10px !important;
        font-size: 12px;
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
                        <h6 class="card-title">Team Member Table</h6>
                        <p class="text-muted mb-3">Manage Team Member</p>
                    </div>
                    @can('teamMember.create')
                    <div class="col-md-6 text-end">
                        <a href="{{ route('member.create') }}" class="btn btn-md btn-primary">
                            <i class="fa fa-plus"></i> Add New Member </a>
                    </div>
                    @endcan
                </div>
                <div class="table-responsive pt-3">
                    <table class="table table-striped table-bordered table-hover user_table" id="users"  
                    style="width:100%; text-align:center;"  data-table="true">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $sl = 0 @endphp
                            @foreach($members as $member)
                            <tr style="font-size:12px;">
                                <td>{{++$sl}}</td>
                                <td>{{$member->name}}</td>
                                <td>{{$member->designation}}</td>
                                <td>{{ Str::words(strip_tags($member->details),10) }}</td>
                                <td>
                                    @can('teamMember.edit')
                                    @if ($member->status == 1)
                                    <a href="{{ route('member.status', $member->id) }}" style="padding:2px;"
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
                                    <a href="{{ route('member.status',$member->id) }}"
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
                            
                                <a href="{{ route('member.edit',$member->id) }}" style="padding:2px;"
                                    class="btn btn-xs btn-primary btn-sm mr-1">
                                    <svg width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                                @endcan
                                @can('teamMember.delete')
                                <a href="{{ route('member.delete',$member->id) }}"
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

{{-- <script type="text/javascript">
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

</script> --}}
@endsection
