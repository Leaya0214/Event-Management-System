@extends('BackEnd.master')

@section('content')
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row  pr-3">
                <div class="col-md-6">
                    <h6 class="card-title">Package Branch</h6>
                    <p class="text-muted mb-3">Manage All Package Branches</p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{route('package_branch.add')}}" class="btn btn-md btn-primary">
                    <i class="fa fa-plus"></i> Add New</a>

                </div>
            </div>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Package Branch</th>
                            <th>Branch Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php $i = 0; ?>
                          
                            @foreach($branches as $branch)
                           
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $branch->branch_name }}</td>
                                <td>{{ $branch->address }}</td>

                                <td>
                                    @if ($branch->status == 1)
                                        <span
                                            style="background-color: rgb(66, 134, 66); color:white; border-radius:5px;"
                                            class="btn btn-xs btn-sm mr-1">Active</span>
                                    @else
                                        <span style="color:white; border-radius:5px; background-color:rgb(177, 28, 2); "
                                            class="btn btn-xs  btn-sm mr-1">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($branch->status == 1)
                                        <a href="{{ route('package_branch.status', $branch->id) }}" style="padding:2px;"
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
                                        <a href="{{ route('package_branch.status',$branch->id) }}"
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
                                    <a href="{{ route('package_branch.edit',$branch->id) }}" style="padding:2px;"
                                        class="btn btn-xs btn-primary btn-sm mr-1">
                                        <svg width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </a>
                                    <a href="{{ route('package_branch.delete',$branch->id) }}"
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
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

