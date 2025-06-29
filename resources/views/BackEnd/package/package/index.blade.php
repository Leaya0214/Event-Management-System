@extends('BackEnd.master')


@section('content')
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row  pr-3">
                <div class="col-md-6">
                    <h6 class="card-title">Packages</h6>
                    <p class="text-muted mb-3">Manage All Packages</p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{route('package.add')}}" class="btn btn-md btn-primary">
                    <i class="fa fa-plus"></i> Add New</a>

                </div>
            </div>
            <div class="table-responsive pt-3">
                <table class="table table-bordered" id="packageTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Branch Name</th>
                            <th>Package Type</th>
                            <th>Package Category</th>
                            <th>Title</th>
                            <th>Position</th>
                            <th>Amount</th>
                            <th>Short Details</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            {{-- {{-- <?php $i = 0; ?>
                          
                            @foreach($packages as $package)
                           
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $package->branch->branch_name }}</td>
                                <td>{{ $package->type->package_type_name }}</td>
                                <td>{{ $package->category->category_name }}</td>
                                <td>{{ $package->name }}</td>
                                <td>{{ $package->discount }}</td>
                                <td>{!! $package->short_details !!}</td>

                                <td>
                                    @if ($package->status == 1)
                                        <span
                                            style="background-color: rgb(66, 134, 66); color:white; border-radius:5px;"
                                            class="btn btn-xs btn-sm mr-1">Active</span>
                                    @else
                                        <span style="color:white; border-radius:5px; background-color:rgb(177, 28, 2); "
                                            class="btn btn-xs  btn-sm mr-1">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($package->status == 1)
                                        <a href="{{ route('package.status', $package->id) }}" style="padding:2px;"
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
                                        <a href="{{ route('package.status',$package->id) }}"
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
                                    <a href=""  data-bs-toggle="modal" 
                                            data-bs-target=".image_modal-{{ $package->id }}" style="padding:2px; color:white"
                                            class="btn btn-xs btn-info btn-sm mr-1">
                                            <svg  width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </a>
                                    <a href="{{ route('package.edit',$package->id) }}" style="padding:2px;"
                                        class="btn btn-xs btn-primary btn-sm mr-1">
                                        <svg width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </a>
                                    <a href="{{ route('package.delete',$package->id) }}"
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
                        
                            <div class="modal fade bg-dark image_modal-{{ $package->id }}" id=""
                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close"
                                            data-bs-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <label for="name" class="col-sm-2 col-form-label">Background Image
                                                </label>
                                                <label for="" class="col-sm-1 col-form-label">:</label>
                                                <div class="col-sm-9">
                                                    <img src="{{asset('backend/package/'.$package->pkg_image)}}" alt="" height="130" width="130">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="name" class="col-sm-2 col-form-label">Branch
                                                </label>
                                                <label for="" class="col-sm-1 col-form-label">:</label>
                                                <div class="col-sm-9">
                                                    {{$package->branch->branch_name}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="name" class="col-sm-2 col-form-label">Type
                                                </label>
                                                <label for="" class="col-sm-1 col-form-label">:</label>
                                                <div class="col-sm-9">
                                                    {{$package->type->package_type_name}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="name" class="col-sm-2 col-form-label">Category
                                                </label>
                                                <label for="" class="col-sm-1 col-form-label">:</label>
                                                <div class="col-sm-9">
                                                    {{$package->category->category_name}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="" class="col-sm-2 col-form-label">Title
                                                </label>
                                                <label for="" class="col-sm-1 col-form-label">:</label>
                                                <div class="col-sm-9">
                                                    {{$package->name}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="name" class="col-sm-2 col-form-label">Amount
                                                </label>
                                                <label for="" class="col-sm-1 col-form-label">:</label>
                                                <div class="col-sm-9">
                                                    {{$package->amount}}
                                                </div>
                                            </div>
                                            @if($package->discount)
                                            <div class="row">
                                                <label for="name" class="col-sm-2 col-form-label">Discount
                                                </label>
                                                <label for="" class="col-sm-1 col-form-label">:</label>
                                                <div class="col-sm-9">
                                                    {{$package->discount}}
                                                </div>
                                            </div>
                                            @endif
                                            <div class="row">
                                                <label for="name" class="col-sm-2 col-form-label">Short Details
                                                </label>
                                                <label for="" class="col-sm-1 col-form-label">:</label>
                                                <div class="col-sm-9">
                                                    {{$package->short_details}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="name" class="col-sm-2 col-form-label">Long Details
                                                </label>
                                                <label for="" class="col-sm-1 col-form-label">:</label>
                                                <div class="col-sm-9">
                                                    {!! $package->long_details !!}
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
                            @endforeach --}}
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
        $('#packageTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('package.all')}}',
        columns: [{
               data: 'DT_RowIndex',
               name: 'DT_RowIndex',
               searchable: false,
               orderable: false
           },
           {
               data: 'branch_name',
               name: 'branch_name'
           },
           {
               data: 'package_type',
               name: 'package_type'
           },
           {
               data: 'category',
               name: 'category'
           },
           {
               data: 'name',
               name: 'name'
           },
           {
               data: 'position',
               name: 'position'
           },
           {
               data: 'amount',
               name: 'amount'
           },
           {
               data: 'short_details',
               name: 'short_details'
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

@endsection

