@extends('BackEnd.master')
@section("css")
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection
@section('content')
    <!-- breadcame start -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}" class="breadcrumb-link"><span
                                        class="p-1 text-sm text-light bg-success rounded-circle"><i
                                            class="fas fa-home"></i></span> Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('role')}}" class="breadcrumb-link"> Roles</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Role Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- form start -->
    {{-- <div class="form_section">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 mx-auto">
                <div class="inline_val">
                    <div class="content_section my-4">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Edit Role</legend>
                            <form action="{{route('role.update',$role->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-3 col-md-3 text-lg-right text-md-right">
                                            <label for="name"><span class="font-weight-bold">Role Name</span><sup
                                                    class="text-danger">*</sup></label>
                                        </div>
                                        <div class="col-xl-9 col-lg-9 col-md-9">
                                            <input type="text" id="name" name="name" value="{{$role->name}}"
                                                   class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                            <div class="text-danger font-italic">
                                                <p><i class="fas fa-exclamation-circle"></i> {{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <fieldset class="scheduler-border">
                                        <legend class="scheduler-border">Edit Permission</legend>
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12">
                                                <div class="row ml-auto">
                                                    <div class="col-6 text-right">
                                                        <label for="name"><span
                                                                class="font-weight-bold ">Select all</span></label>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="">
                                                            <input type="checkbox" id="select-all" /><br/>
                                                            <span class=""></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            @foreach($permissions as $key => $permission)
                                                <div class="col-xl-4 col-lg-4 col-md-4">
                                                    <div class="row">
                                                        <div class="col-1 text-right mt-2">
                                                            <label for="name"><span
                                                                    class="font-weight-bold text-capitalize">{{$key+1 .'. '}}</span></label>
                                                        </div>
                                                        <div class="col-2">
                                                            <!--<label class="switch">-->
                                                            <!--    <input type="checkbox" class="all_checked"-->
                                                            <!--           {{$role->hasPermissionTo($permission->id)?'checked':''}}  name="permission[{{$permission->id}}]">-->
                                                            <!--    <span class="slider round"></span>-->
                                                            <!--</label>-->
                                                        </div>
                                                        <div class="col-9 mt-2">
                                                            <label for="name"><span
                                                                    class="font-weight-bold text-capitalize">{{$permission->name}}</span></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="form-group">
                                    <h3 class="text-center">
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </h3>
                                </div>
                            </form>
                        </fieldset>
                    </div>
                </div>
            </div>

        </div>
    </div> --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="offset-lg-1 col-lg-10 ">
                            <div class="card card-primary">
                                <form role="form" action="{{ route('role.update', $role->id) }}" method="POST"
                                    enctype="multipart/form-data" >
                                    @csrf
                                    {{-- @method('patch') --}}

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Role Name<code>*</code> </label>
                                            <input type="text" name="name" id="name"
                                                value="{{ old('name') ?? $role->name }}" class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Role Name" required>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                                            @enderror
                                        </div>
                                        <label for="name">Permission</label>

                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input form-check-input" type="checkbox" id="checkPermissionAll" value="1">
                                            <label for="checkPermissionAll" class="custom-control-label">All</label>
                                        </div>
                                        <hr>

                                        @foreach ($permissions_groups as $group)
                                            @php
                                                $permissions = App\Models\User::getPermissionByGroupName($group->name);
                                                // dd($permissions);
                                            @endphp
                                            <div class="row">
    <div class="col-sm-3 col-xs-6">
        <div class="custom-control custom-checkbox">
            <input
                class="custom-control-input form-check-input"
                type="checkbox"
                id="{{ $loop->iteration }}-management"
                value="{{ $group->name }}"
                onclick="checkPermissionByGroup('role-{{ $loop->iteration }}-management-checkbox', this)"
                {{ App\Models\User::roleHasPermissions($role, $permissions->pluck('name')->toArray()) ? "checked" : "" }}
            >
            <label for="{{ $loop->iteration }}-management" class="custom-control-label">{{ $group->name }}</label>
        </div>
    </div>
    <div class="col-sm-9 col-xs-6 role-{{ $loop->iteration }}-management-checkbox">
        @foreach ($permissions as $permission)
            <div class="custom-control custom-checkbox">
                <input
                    class="custom-control-input form-check-input"
                    type="checkbox"
                    name="permissions[]"
                    id="checkPermission{{ $permission->id }}"
                    value="{{ $permission->name }}"
                    onclick="checkSinglePermission('role-{{ $loop->parent->iteration }}-management-checkbox', '{{ $loop->parent->iteration }}-management', {{ $permissions->count() }})"
                    {{ $role->hasPermissionTo($permission->name) ? "checked" : "" }}
                >
                <label class="custom-control-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
            </div>
        @endforeach
    </div>
</div>

                                        @endforeach
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <button type="reset" class="btn btn-primary">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
<script>
    $("#checkPermissionAll").click(function(){
        if($(this).is(':checked')){
            $("input[type=checkbox]").prop('checked', true);
        } else{
            $("input[type=checkbox]").prop('checked', false);
        }
    });

    function checkPermissionByGroup(className, thisObject) {
        var groupIdName     = $("#"+thisObject.id);
        var classCheekBox   = $('.'+className+' input[type=checkbox]');

        if(groupIdName.is(':checked')){
            classCheekBox.prop('checked', true);
        } else{
            classCheekBox.prop('checked', false);
        }

        implementAllChecked();
    }


    function checkSinglePermission(groupClassName, groupID, CountTotalPermission){
        var classCheckBox = $('.'+groupClassName+' input');
        var groupIDCheckBox = $('#'+groupID);
        // console.log($("."+groupClassName+" input:checked").length, CountTotalPermission);
        // If there is any occurrence where something is not selected then make selected = false
        if ($("."+groupClassName+" input:checked").length == CountTotalPermission) {
            groupIDCheckBox.prop('checked', true);
        } else{
            groupIDCheckBox.prop('checked', false);
        }

        implementAllChecked();
    }


    function implementAllChecked() {
        const countPermissions  = {{ count($permissions) }};
        const countPermissionGroups  = {{ count($permissions_groups) }};

        // console.log(countPermissions,countPermissionGroups, $("input[type=checkbox]:checked").length);

        if($("input[type=checkbox]:checked").length == (countPermissions + countPermissionGroups) ){
            $("#checkPermissionAll").prop('checked', true);
        }
        else{
            $("#checkPermissionAll").prop('checked', false);
        }
    }



</script>
@endsection


