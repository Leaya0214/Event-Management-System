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
                <h4 class="card-header">Add Service</h4>
                <div class="card-body" style="margin-left:50px; margin-right:20px">
                    <form action="{{route('blog.store')}}" class="form-inner"
                        enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        @csrf
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                            <p class="alert alert-danger">{{$error}}</p>
                            @endforeach
                        @endif
                        <div class="form-group row pb-3">
                            <label for="title" class="col-sm-2 col-form-label">Blog Title<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="title" type="text" class="form-control" id="title"
                                    placeholder="Type Blog Title..." >
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="image" class="col-sm-2 col-form-label">Thumbnail Image</label>
                            <label for="image" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="image" type="file" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="gallery" class="col-sm-2 col-form-label">Gallery Image</label>
                            <label for="gallery" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-8">
                                <input name="gallery[0]" type="file" class="form-control">
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-sm add_image"
                                    style=" background-color: #0fc74c; color: #fff;"> + Add </button>
                            </div>
                            <div class="row images mt-3">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="description" class="col-sm-2 col-form-label">Blog Description</label>
                            <label for="description" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control textarea" id="summernote" cols="30" rows="10"></textarea>
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
      $(document).ready(function() {

            var j = 0;
            $('.add_image').click(function() {
                ++j;
                var m = j + 1;
                $('.images').append(`
                <div class="col-lg-12 image mb-3">
                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-8">
                        <input type="file" class="form-control" name="gallery[` + j + `]" required>
                        </div>
                        <span class="remove btn btn-danger col-md-1" style="height: 35px; width: fit-content; "> <i class="fas fa-times"></i> </span>
                    </div>  
                </div>              
        `);

            });


            $('.images').on('click', '.remove', function() {
                $(this).parent().remove();
            });
        });
</script>
<script>
    $(function () {
        $('.textarea').summernote({
            height:150
        })
    })
</script>
@endsection
