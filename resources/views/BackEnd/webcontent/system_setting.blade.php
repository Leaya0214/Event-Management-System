@extends('BackEnd.master')
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
        <br>
  
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <h4 class="card-header">Syestem Setting</h4>
                <div class="card-body" style="margin-left:50px; margin-right:20px">
                    <form action="{{route('system.setting.update',$system->id)}}" class="form-inner"
                        enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        @csrf

                        @if($errors->any())
                            @foreach($errors->all() as $error)
                            <p class="alert alert-danger">{{$error}}</p>
                            @endforeach
                        @endif
                        <div class="form-group row pb-3">
                            <label for="title" class="col-sm-2 col-form-label">Website Title <i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="title" type="text" class="form-control" id="title"
                                    placeholder="Website Title" @isset($system) value="{{$system->title}}" @endisset >
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="name" class="col-sm-2 col-form-label">Website Name</label>
                            <label for="name" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="name" type="text" class="form-control" id="name"
                                    placeholder="Website Name" @isset($system) value="{{$system->name}}" @endisset>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="office_address" class="col-sm-2 col-form-label">Office Address</label>
                            <label for="office_address" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="office_address" type="text" class="form-control" id="office_address"
                                    placeholder="office_address" @isset($system) value="{{$system->office_address}}" @endisset>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <label for="email" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="email" type="text" class="form-control" id="email" placeholder="Email"
                                @isset($system) value="{{$system->email}}" @endisset>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                            <label for="phone" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="phone" type="text" class="form-control" placeholder="+88017XXXXXX"
                                @isset($system) value="{{$system->phone}}" @endisset>
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="favicon" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <img src="{{asset('backend/system_setting/'.$system->favicon)}}"  width="40" height="40"
                                    alt="Favicon" class="img-thumbnail" />
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="favicon" class="col-sm-2 col-form-label">Favicon</label>
                            <label for="favicon" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input type="file" name="favicon" id="favicon">
                                <input type="hidden" name="old_favicon" value="">
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="logo" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <img src="{{asset('backend/system_setting/'.$system->logo)}}"  width="100" height="100"
                                    alt="Picture" class="img-thumbnail" />
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="logo" class="col-sm-2 col-form-label">Logo</label>
                            <label for="logo" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input type="file" name="logo" id="logo">
                                <input type="hidden" name="old_logo" value="assets/img/icons/2023-10-12/l.png">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="banner" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <img src="{{asset('backend/system_setting/'.$system->website_banner)}}"  width="200" height="200"
                                alt="Picture" class="img-thumbnail" />
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="banner" class="col-sm-2 col-form-label">Banner</label>
                            <label for="banner" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input type="file" name="website_banner" id="logo">
                                <input type="hidden" name="website_banner" value="assets/img/icons/2023-10-12/l1.png">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="meta_tag_name" class="col-sm-2 col-form-label">Meta Keyword</label>
                            <label for="meta_tag_name" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="meta_tag_name" type="text" class="form-control" id="storevat"
                                    placeholder="Enter meta tags" @isset($system) value="{{$system->meta_tag_name}}" @endisset >
                                    <small>Type Meta tags here and separate them by coma</small>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="meta_author" class="col-sm-2 col-form-label">Meta Author</label>
                            <label for="meta_author" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="storevat" type="text" class="form-control" name="meta_author" @isset($system) value="{{$system->meta_tag_author}}" @endisset
                                    placeholder="Enter meta author">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="meta_description" class="col-sm-2 col-form-label">Meta Description</label>
                            <label for="meta_description" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <textarea name="meta_description" class="form-control" placeholder="Meta Text" maxlength="140" rows="7">@isset($system) {{$system->meta_tag_description}} @endisset</textarea>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="map_link" class="col-sm-2 col-form-label">Map Link</label>
                            <label for="map_link" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="map_link" type="text" class="form-control" id="map_link"
                                    placeholder="Map Link" @isset($system) value="{{$system->map_link}}" @endisset>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="facebook_link" class="col-sm-2 col-form-label">Facebook Link</label>
                            <label for="facebook_link" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="facebook_link" type="text" class="form-control" id="facebook_link"
                                    placeholder="Facebook Link"  @isset($system) value="{{$system->fb_link}}" @endisset>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="instagram_link" class="col-sm-2 col-form-label">Instagram Link </label>
                            <label for="instagram_link" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="instagram_link" type="text" class="form-control" id="instagram_link"
                                    placeholder="Instagram Link"  @isset($system) value="{{$system->instagram_link}}" @endisset>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="you_tube_link" class="col-sm-2 col-form-label">Youtube Link </label>
                            <label for="you_tube_link" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="you_tube_link" type="text" class="form-control" id="you_tube_link"
                                    placeholder="You Tube Link"  @isset($system) value="{{$system->you_tube_link}}" @endisset>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="copyright" class="col-sm-2 col-form-label">Footer Text </label>
                            <label for="copyright" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <textarea name="copyright" class="form-control" placeholder="Ex : Copyright@2023" maxlength="140" rows="7">@isset($system) {{$system->copy_right}} @endisset</textarea>
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
