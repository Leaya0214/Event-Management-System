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
                <h4 class="card-header">Add User Information</h4>
                <div class="card-body" style="margin-left:50px; margin-right:20px">
                    <form action="{{route('user.store')}}" class="form-inner"
                        enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        @csrf
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                            <p class="alert alert-danger">{{$error}}</p>
                            @endforeach
                        @endif
                        <div class="form-group row pb-3">
                            <label for="name" class="col-sm-2 col-form-label">Name<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="name" type="text" class="form-control" id="name"
                                    placeholder="Type Name...." >
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="email" class="col-sm-2 col-form-label">Email<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="email" type="text" class="form-control" id="email"
                                    placeholder="Type Email...." >
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="password" class="col-sm-2 col-form-label">Password<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="password" type="password" class="form-control" id="name"
                                    placeholder="Type Passwrod...." >
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="phone" class="col-sm-2 col-form-label">Phone Number<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="phone" type="text" class="form-control" id="phone"
                                    placeholder="Type Phone...." >
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="designation" class="col-sm-2 col-form-label">Designation<i
                                class="text-danger">*</i></label>
                            <label for="designation" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="designation" type="text" class="form-control" placeholder="Type Position">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="address" class="col-sm-2 col-form-label">Address<i
                                class="text-danger">*</i></label>
                            <label for="address" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                               <input type="text" name="address" id="" class="form-control" placeholder="Type address...">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="image" class="col-sm-2 col-form-label">Image</label>
                            <label for="image" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="image" type="file" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="user_type" class="col-sm-2 col-form-label">User Type</label>
                            <label for="user_type" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                               <select name="type" class="form-control" id="">
                                    <option selected disbaled>-------Select User Type--------</option>
                                    <option value="admin">Admin</option>
                                    <option value="stuff">Stuff</option>
                               </select>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="link" class="col-sm-2 col-form-label">Add Social Media Link</label>
                            <label for="link" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                               <input type="text" name="fb_link" id="" class="form-control" placeholder="Facebook link ...">
                               <input type="text" name="insta_link" id="" class="form-control mt-2" placeholder="Instagram Link...">
                               <input type="text" name="linkedin" id="" class="form-control mt-2" placeholder="LinkedIn Link...">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="description" class="col-sm-2 col-form-label">Add More Details</label>
                            <label for="description" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <textarea name="details" class="form-control textarea" id="summernote" cols="30" rows="10"></textarea>
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
