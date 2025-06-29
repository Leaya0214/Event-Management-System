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
                <h4 class="card-header">Update Portfolio Data</h4>
                <div class="card-body" style="margin-left:50px; margin-right:20px">
                    <form action="{{route('portfolio.update',$portfolio->id)}}" class="form-inner"
                        enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        @csrf
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                            <p class="alert alert-danger">{{$error}}</p>
                            @endforeach
                        @endif
                        <div class="form-group row pb-3">
                            <div class="form-group row pb-3">
                                <label for="type" class="col-sm-2 col-form-label">Portfolio Type<i
                                        class="text-danger">*</i> </label>
                                <label for="" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9">
                                   <select name="type" class="form-control" data-placeholder="Select a type..." id="type">
                                    <option value="" disabled selected>--------Select a type--------</option>
                                        <option value="Photography" @if($portfolio->type == 'Photography') selected="selected" @endif >Photography</option>
                                        <option value="Cinematography" @if($portfolio->type == 'Cinematography') selected="selected" @endif >Cinematography</option>
                                   </select>
                                </div>
                            </div>
                            <label for="title" class="col-sm-2 col-form-label">Portfolio Title<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="title" type="text" class="form-control" id="title"
                                    placeholder="Type title..."  value="{{$portfolio->title}}">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="image" class="col-sm-2 col-form-label">Thumbnail Image</label>
                            <label for="image" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <img src="{{asset('backend/portfolio/'.$portfolio->image)}}" alt="" height="100" width="100">
                                <input name="image" type="file" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row pb-3"id="category-box">
                            <label for="category" class="col-sm-2 col-form-label">Categories</label>
                            <label for="category" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9" >
                                @foreach ($portfolioCategories as $category)
                                {{-- @foreach($subjects_id as $subject_id) --}}
                                    <input type="checkbox" name="category_id[]" value="{{$category->id}}"style="box-shadow: unset; margin-left:15px;"
                                    @if($portfolio_category_ids)
                                    @foreach($portfolio_category_ids as $category_id)
                                        @if($category_id == $category->id)
                                            checked
                                        @endif
                                    @endforeach
                                    @endif
                                    >  {{$category->name}}
                                    
                                @endforeach
                            </div>
                        </div>
                        
                        @if($portfolio->type == 'Cinematography')
                        <div class="form-group row pb-3">
                            <label for="video" class="col-sm-2 col-form-label">Video</label>
                            <label for="video" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                {{-- <iframe src="{{asset('backend/portfolio/'.$portfolio->video)}}" frameborder="0" height="100" width="100"></iframe> --}}
                                <input name="video" type="text" class="form-control" placeholder="You Tube Video Link" value="{{$portfolio->video}}">
                            </div>
                            {{-- <div class="col-md-1">
                                <button type="button" class="btn btn-sm add_image"
                                    style=" background-color: #0fc74c; color: #fff;"> + Add </button>
                            </div>
                            <div class="row images mt-3">
                            </div> --}}
                        </div>
                        @endif

                        <div class="form-group row pb-3" id="portfolio-gallery">
                            <label for="gallery" class="col-sm-2 col-form-label">Gallery Image</label>
                            <label for="gallery" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-8">
                                {{-- @dd($portfolio_gallery) --}}
                                @foreach($portfolio_gallery as $image)
                                <img src="{{asset('backend/portfolio_gallery/'.$image->image)}}" alt="" height="100px" width="100px">
                                <a href="{{route('portfolio_image.delete',$image->id)}}">
                                    <span class="btn btn-danger"> <i class="fa-solid fa-xmark"></i> </span>
                                </a>
                                @endforeach
                                <button type="button" class="btn btn-sm new_image"
                                style=" background-color: #0fc74c; color: #fff;"> + Add More </button>
                            </div>
                            <div class="col-md-12">
                               
                            </div>
                            <div class="row images mt-3">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="description" class="col-sm-2 col-form-label">Portfolio Description</label>
                            <label for="description" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control textarea" id="summernote" cols="30" rows="10">{!! $portfolio->description !!}</textarea>
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>

      $(document).ready(function() {
        var selectedType = $('#type').val();
            console.log(type);
            if(selectedType == 'Cinematography'){
                $('#video').show();
                $('#portfolio-gallery').hide();
                $('#category-box').hide();
            }else{
                $('#video').hide(); 
                $('#portfolio-gallery').show();
                $('#category-box').show();

            }
            $('#type').on('change',function(){
            var type = $('#type').val();
            if(type == 'Cinematography'){
                $('#video').show();
                $('#portfolio-gallery').hide();
                $('#category-box').hide();
            }else{
                $('#video').hide(); 
                $('#portfolio-gallery').show();
                $('#category-box').show();
                }
            });
            var j = 0;
            $('.new_image').click(function() {
                j++;
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
