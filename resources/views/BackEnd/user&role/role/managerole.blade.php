@extends('BackEnd.master')


<style>
    fieldset.scheduler-border {
        border: 1px solid #1CAF9A !important;
        padding: 20px !important;
        margin: 20px !important;
        border-radius: 5px;
        /* background: #ddf6fd; */
    }

    legend.scheduler-border {
        font-size: 1.2rem !important;
        /* font-weight: bold !important; */
        text-align: center !important;
        background: #17A2B8;
        width: 50%;
        color: rgb(255, 255, 255);
        border-radius: 5px;
    }


    table td .text{
        /* white-space: normal */
        word-wrap: break-word !important;         /* All browsers since IE 5.5+ */
        overflow-wrap: break-word !important; 
    }

    .datepicker table td,
    .datepicker table th,
    .table td,
    .table th {
    white-space: nowrap;
}

</style>

@section('content')

    <div class="container mt-3">
        <div class="row  pr-3">
            @can('role.create')
            <div class="col-md-12 text-end">
                <a href="" class="btn btn-md btn-info text-white" data-bs-toggle="modal" data-bs-target="#roleCreate"><i
                        class="fa fa-plus"></i> Create Role</a>
            </div>
            @endcan
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-header">
                        <h4 class="text-center ">Roles & Permission</h4>
                    </div>
                    <div class="card-body">
                        <table id="users" class="custom-table table table-striped table-bordered table-hover user_table"
                            style="width:100%; text-align:center;" data-table="true">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Permission</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach ($roles as $role)
                                    <tr style="font-size: 14px">
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $role->name }}</td>
                                         <style>
                                            td.new-td {
                                                    overflow: hidden;
                                                    text-overflow: ellipsis;
                                                    white-space: normal; 
                                                    max-height: 500px;
                                                    width: 100%;
                                                    display: -webkit-box;
                                                    -webkit-line-clamp: 3;
                                                    }
                                        </style>
                                        <td class="text new-td" style=" word-wrap: break-word ;overflow-wrap: break-word;">
                                                @foreach($role->permissions as $permission)
                                                {{$permission->name}},
                                            @endforeach
                                           
                                        </td>
                                        <td>
                                            @can('role.edit')
                                                    <a href="{{ route('role.edit', $role->id) }}" 
                                                        style="padding:2px; color:white" class="btn btn-xs btn-primary btn-sm mr-1">
                                                        <svg width="16" height="14" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-edit">
                                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                        </svg>
                                                    </a>
                                                    @endcan
                                                    @can('role.delete')
                                                    <a href="{{ route('role.delete', $role->id) }}"
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
        </div>
    </div>

    <div class="modal fade" id="roleCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('role.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- @isset($system) value="{{$system->title}}" @endisset  --}}
                    <div class="modal-body"> 
                       <div class="form-group row pt-3">
                            <label for="title" class="col-sm-3 col-form-label">Role Name</label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Enter role name">
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

@section('script')
@endsection
