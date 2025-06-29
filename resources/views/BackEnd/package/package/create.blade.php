@extends('BackEnd/master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')

    <div class="content-header row align-items-center m-0" id="bedcumb">
        <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
            <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                <li id="moduleName" class="breadcrumb-item active">
                    Dashboard</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <h4 class="card-header">Add Package</h4>
                <div class="card-body" style="margin-left:50px; margin-right:20px">
                    <form action="{{ route('package.store') }}" class="form-inner" enctype="multipart/form-data"
                        method="post" accept-charset="utf-8">
                        @csrf
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p class="alert alert-danger">{{ $error }}</p>
                            @endforeach
                        @endif

                        <div class="form-group row pb-3">
                            <label class="col-sm-2 form-label" for="">Branch<span
                                    style="color: red;">*</span></label>
                            <label class="col-sm-1" for="">:</label>
                            <div class="col-sm-9">
                                <select class="form-control chosen" name="package_branch_id" id="">
                                    <option value="">--- Select Branch ---</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-2 form-label" for="">Package Type<span
                                    style="color: red;">*</span></label>
                            <label class="col-sm-1" for="">:</label>
                            <div class="col-sm-9">
                                <select class="form-control chosen" name="package_type_id" id="">
                                    <option value="">--- Select Type ---</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->package_type_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-2 form-label" for="">Package Category<span
                                    style="color: red;">*</span></label>
                            <label class="col-sm-1" for="">:</label>
                            <div class="col-sm-9">
                                <select class="form-control chosen" name="package_category_id" id="">
                                    <option value="">--- Select Category ---</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="name" class="col-sm-2 col-form-label">Title<i class="text-danger">*</i>
                            </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="name" type="text" class="form-control"
                                    placeholder="Package Title">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="position" class="col-sm-2 col-form-label">Position<i class="text-danger">*</i>
                            </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="position" type="number" class="form-control"
                                    placeholder="Package Position">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="short_title" class="col-sm-2 col-form-label">Number of Photographer And Cinematographer<i class="text-danger">*</i>
                            </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="short_title" type="text" class="form-control"
                                    placeholder="Type Here..">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="image" class="col-sm-2 col-form-label">Background Image<i class="text-danger">*</i>
                            </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="image" type="file" class="form-control"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="amount" class="col-sm-2 col-form-label">Previous Amount
                            </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="amount" type="number" class="form-control"
                                    placeholder="Previous Amount">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="discount" class="col-sm-2 col-form-label">Current Amount<i class="text-danger">*</i>
                            </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="discount" type="number" class="form-control"
                                    placeholder="Current Amount">
                            </div>
                        </div>

                        {{-- <div class="form-group row pb-3">
                            <label for="duration" class="col-sm-2 col-form-label">Duration<i class="text-danger">*</i>
                            </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="duration" type="text" class="form-control"
                                    placeholder="Package Duration">
                            </div>
                        </div> --}}

                        <div class="form-group row pb-3">
                            <label for="short_details" class="col-sm-2 col-form-label">Short Details
                            </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <textarea name="short_details" type="text" class="form-control "
                                    placeholder="Package short Details"></textarea>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="long_details" class="col-sm-2 col-form-label">Long Details<i class="text-danger">*</i>
                            </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <textarea name="long_details" type="text" class="form-control textarea"
                                    placeholder="Package Long Details"></textarea>
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
