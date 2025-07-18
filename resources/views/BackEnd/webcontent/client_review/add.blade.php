@extends('BackEnd/master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

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
                <h4 class="card-header">Add Client Review</h4>
                <div class="card-body" style="margin-left:50px; margin-right:20px">
                    <form action="{{route('client_review.store')}}" class="form-inner"
                        enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        @csrf
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                            <p class="alert alert-danger">{{$error}}</p>
                            @endforeach
                        @endif
                        <div class="form-group row pb-3">
                            <label for="name" class="col-sm-2 col-form-label">Client Name<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="name" type="text" class="form-control" id="name"
                                    placeholder="Type Client Name" >
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="date" class="col-sm-2 col-form-label">Date of Review</label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="date" type="date" class="form-control" id="date"
                                   value="{{ date("Y-m-d") }}" >
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="rating" class="col-sm-2 col-form-label">Review/Rating(Out of 5)</label>
                            <label for="rating" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                               <input type="text" class="form-control" name="rating" placeholder="Give Rating Here..">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="image" class="col-sm-2 col-form-label">Background Image</label>
                            <label for="image" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control"  name="image" id="">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="comment" class="col-sm-2 col-form-label">Comment</label>
                            <label for="comment" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <textarea name="comment" class="form-control "  cols="10" rows="5"></textarea>
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

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(function () {
        $('.textarea').summernote({
            height:150
        })
    })
</script>
@endsection
