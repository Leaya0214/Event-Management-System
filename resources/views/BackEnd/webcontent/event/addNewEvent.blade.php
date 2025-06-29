@extends('BackEnd.master')

@section('content')
    <div class="content-header row align-items-center m-0" id="bedcumb">
        <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
            <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" style="color: #d75b49">Home</a></li>
                <li id="moduleName" class="breadcrumb-item active">
                    Event </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h4 class="card-header text-center">New Event 1 </h4>
            <div class="card-body" style="margin-left:50px; margin-right:20px">
                <form action="{{ route('event.store') }}" class="form-inner" enctype="multipart/form-data" method="post"
                    accept-charset="utf-8">
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger">{{ $error }}</p>
                        @endforeach
                    @endif
                    <input type="hidden" name="master_id" value="{{$eventMaster->id}}">
                    <div class="form-group row pb-3">
                        <label class="col-sm-3">Event Date</label>
                        <label class="col-sm-1">:</label>
                        <div class="col-sm-8">
                            <input name="date[]" required="" class="form-control" type="text"
                                placeholder="Event Date" id="date" onfocus="(this.type='date')" class="">
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-3">Event Shift</label>
                        <label class="col-sm-1">:</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="shift_id[]" id="shift_id" placeholder="">
                                <option selected disabled>Enter Shift</option>
                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->shift_id }}">{{ $shift->shift_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-3">Event Time</label>
                        <label class="col-sm-1">:</label>
                        <div class="col-sm-3">
                            <input type="time" name="start_time[]" id="start_time" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <p>To </p>
                        </div>
                        <div class="col-sm-3">
                            <input type="time" name="end_time[]" id="end_time" placeholder="DD/MM/YY"
                                class="form-control">
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-3">Event Type</label>
                        <label class="col-sm-1">:</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="type_id[]" id="type_id" placeholder="">
                                <option selected disabled>Event Type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->type_id }}">{{ $type->type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-3">Event District</label>
                        <label class="col-sm-1">:</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="district_id[]" id="district_id" placeholder="">
                                <option selected disabled>Event District</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->district_id }}">{{ $district->district }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-3">Venue</label>
                        <label class="col-sm-1">:</label>
                        <div class="col-sm-8">
                            <textarea id="venue" class="form-control" name="venue[]" rows="3" placeholder="Event Location / Venue"></textarea>
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-sm-3">Package</label>
                        <label class="col-sm-1">:</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="category_id[]" id="category_id_1" placeholder=""
                                onchange="filterPackage(this)">
                                <option selected disabled>Package </option>
                                @foreach ($package_category as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row pb-3">
                        <label class="col-sm-3">Package Details</label>
                        <label class="col-sm-1">:</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="package_id[]" id="package_id_1" placeholder=""
                                onchange="letAmount(this)">
                                <option selected disabled>Package Details</option>
                                @foreach ($package as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="col-sm-1 btn btn-success" id="add" onclick="addNewEvent(this)">+
                            Add</button>
                    </div>
                    <div class="new-event">

                    </div>
                        
                       <div class="form-group text-start  pb-3">
                                <button type="reset" class="btn btn-primary w-md m-b-5">Reset</button>
                                <button type="submit" class="btn btn-success w-md m-b-5">Save</button>
                            </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let i = 1;

         function addNewEvent() {
            ++i;
            $('.new-event').append(`<hr>
            <div class="col-md-12">
                <h4 class="text-center mb-3">New Event `+ i +` </h4>
                            <div class="form-group row pb-3">
                                <label class="col-sm-3">Event Date</label>
                                <label class="col-sm-1">:</label>
                                <div class="col-sm-8">
                                    <input name="date[]" required="" class="form-control" type="text"
                                        placeholder="Event Date" id="date" onfocus="(this.type='date')"
                                        class="">
                                </div>

                            </div>
                            <div class="form-group row pb-3">
                                <label class="col-sm-3">Event Shift</label>
                                <label class="col-sm-1">:</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="shift_id[]" id="shift_id" placeholder="">
                                        <option selected disabled>Enter Shift</option>
                                        @foreach ($shifts as $shift)
                                            <option value="{{ $shift->shift_id }}">{{ $shift->shift_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row pb-3">
                                <label class="col-sm-3">Event Time</label>
                                <label class="col-sm-1">:</label>
                                <div class="col-sm-3">
                                    <input type="time" name="start_time[]" id="start_time" class="form-control">
                                </div>
                                <div class="col-sm-2">
                                    <p>To </p>
                                </div>
                                <div class="col-sm-3">
                                    <input type="time" name="end_time[]" id="end_time" placeholder="DD/MM/YY"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row pb-3">
                                <label class="col-sm-3">Event Type</label>
                                <label class="col-sm-1">:</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="type_id[]" id="type_id" placeholder="">
                                        <option selected disabled>Event Type</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->type_id }}">{{ $type->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row pb-3">
                                <label class="col-sm-3">Event District</label>
                                <label class="col-sm-1">:</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="district_id[]" id="district_id" placeholder="">
                                        <option selected disabled>Event District</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->district_id }}">{{ $district->district }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row pb-3">
                                <label class="col-sm-3">Venue</label>
                                <label class="col-sm-1">:</label>
                                <div class="col-sm-8">
                                    <textarea id="venue" class="form-control" name="venue[]" rows="3" placeholder="Event Location / Venue"></textarea>
                                </div>
                            </div>
                            <div class="form-group row pb-3">
                                <label class="col-sm-3">Package</label>
                                <label class="col-sm-1">:</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="category_id[]" id="category_id_`+i+`" placeholder=""
                                        onchange="filterPackage(this)">
                                        <option selected disabled>Package</option>
                                        @foreach ($package_category as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row pb-3">
                                <label class="col-sm-3">Package Details</label>
                                <label class="col-sm-1">:</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="package_id[]" id="package_id_`+i+`" placeholder=""
                                        onchange="letAmount(this)">
                                        <option selected disabled>Package</option>
                                        @foreach ($package as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <span class="remove btn btn-danger text-center" style="width: fit-content; margin-bottom:12px"><i class="fa fa-times"></i></span>
                            </div>
                            `);

            $('.new-event').on('click', '.remove', function() {
                $(this).parent().remove();
            });
        }
    </script>

    <script>
         function filterPackage(e) {
            const text = e.id;
            const id = text.replace('category_id_', '');
            const category_id = document.getElementById('category_id_' + id).value;
            var allPackageIds = [];
            $.ajax({
                url: '{{ route('package.filter') }}',
                data: { category_id: category_id }, // Sending data in key-value format
                type: 'GET',
            success: function(res) {
                $('#package_id_'+id).html('<option  selected disabled>Package Details </option>');
                        $.each(res, function (key, value) {
                            $('#package_id_'+id).append('<option value="' + value.id + '">' + value.name + '</option>');
                           
                });  
                    },
                error: function(err) {
                alert('No data );');
                }
            });
       
}
    </script>

    
@endsection
