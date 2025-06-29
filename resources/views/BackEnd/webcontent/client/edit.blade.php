@extends('BackEnd/master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="content-header row align-items-center m-0" id="bedcumb">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
    <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('client-index')}}">Client</a></li>
    <li id="moduleName" class="breadcrumb-item active">
    Edit Client</li>
    </ol>
    </nav>
</div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <h4 class="card-header">Edit Client Information</h4>
                <div class="card-body" style="margin-left:50px; margin-right:20px">
                    <form action="{{route('client-update',$client->id)}}" class="form-inner"
                        enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        @csrf
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                            <p class="alert alert-danger">{{$error}}</p>
                            @endforeach
                        @endif
                        <div class="form-group row pb-3">
                            <label for="title" class="col-sm-2 col-form-label">Client Name<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="name" type="text" class="form-control" id="title"
                                    placeholder="Edit Name..." value="{{$client->name}}" >
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="title" class="col-sm-2 col-form-label">Client Email<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="email" type="text" class="form-control" id="title"
                                    placeholder="Edit Email..." value="{{$client->email}}" >
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="title" class="col-sm-2 col-form-label">Client Address<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="address" type="text" class="form-control" id="title"
                                    placeholder="Edit Address..." value="{{$client->address}}" >
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="title" class="col-sm-2 col-form-label">Client Password<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="password" type="password" class="form-control" id="title"
                                    placeholder="Type Password" value="{{$client->password}}" >
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="title" class="col-sm-2 col-form-label">Primary No.<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="primary_no" type="text" class="form-control" id="title"
                                    placeholder="Type Primary No..." value="{{$client->primary_no}}" >
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="title" class="col-sm-2 col-form-label">Alternate Number<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="title" type="text" class="form-control" id="title"
                                    placeholder="Type Alternate No..." value="{{$client->alternate_no}}" >
                            </div>
                        </div>  
                        
                        <div class="form-group text-end  pb-3">
                            <button type="reset" class="btn btn-primary w-md m-b-5">Reset</button>
                            <button type="submit" class="btn btn-success w-md m-b-5">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
@endsection

@section('js')

@endsection
