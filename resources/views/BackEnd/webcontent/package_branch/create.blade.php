@extends('BackEnd/master')

@section('content')

<div class="content-header row align-items-center m-0" id="bedcumb">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
    <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
    <li id="moduleName" class="breadcrumb-item active">
    Dashboard</li>
    </ol>
    </nav>
</div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <h4 class="card-header">Add Package Branch</h4>
                <div class="card-body" style="margin-left:50px; margin-right:20px">
                    <form action="{{route('package_branch.store')}}" class="form-inner"
                        enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        @csrf
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                            <p class="alert alert-danger">{{$error}}</p>
                            @endforeach
                        @endif
                    
                        <div class="form-group row pb-3">
                            <label for="branch_name" class="col-sm-2 col-form-label">Package Branch<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="branch_name" type="text" class="form-control"
                                    placeholder="Package Branch Name" >
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="address" class="col-sm-2 col-form-label">Branch Address<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="address" type="text" class="form-control"
                                    placeholder="Package Branch Address" >
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="branch_name" class="col-sm-2 col-form-label">Background Image<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="image" type="file" class="form-control" 
                                    placeholder="Package Branch Name" >
                            </div>
                        </div>
                        
                        <div class="form-group text-end  pb-3">
                            <button type="reset" class="btn btn-primary w-md m-b-5">Reset</button>
                            <button type="submit" class="btn btn-success w-md m-b-5">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
@endsection

