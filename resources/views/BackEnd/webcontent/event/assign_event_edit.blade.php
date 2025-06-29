@extends('BackEnd.master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<style>
    .round-button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 50%;
        background-color: #3498db;
        color: #ffffff;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .round-button:hover {
        background-color: #2980b9;
    }

    .chosen-container-single .chosen-single span {
        max-height: 40px;
    }
</style>

@section('content')
    <div class="content-header row align-items-center m-0" id="bedcumb">
        <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
            <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" style="color: #d75b49">Home</a></li>
                <li id="moduleName" class="breadcrumb-item active">
                    Assign Data Edit </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                {{-- <h4 class="card-header">Booking Data </h4> --}}
                <div class="card-body" style="margin-left:50px; margin-right:20px">
                    <form action="{{ route('assigtn.event.update', $id) }}" class="form-inner" enctype="multipart/form-data"
                        method="post" accept-charset="utf-8">
                        @csrf
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p class="alert alert-danger">{{ $error }}</p>
                            @endforeach
                        @endif
                         @php
                                $i = 1;
                                $p = 0;
                            @endphp
                        <input type="hidden" name="details_id" value="{{ $id }}">
                        @if (sizeof($assignedPhotographer))
                            <h4 class="text-center mt-3">Assigned Photographer</h4>
                            <hr>

                            @foreach ($assignedPhotographer as $photographer)
                                <input type="hidden" name="status" value="1">
                                <div class="form-group row pb-3 mt-3">
                                    <label class="col-sm-3 mt-4">Photographer {{ $i++ }}</label>
                                    <label class="col-sm-1  mt-4">:</label>
                                    <div class="col-sm-7  mt-4">

                                       <input type="text" name="" id="" class="form-control"
                                            value="{{ $photographer->user->name }}" readonly>
                                          <input type="hidden" name="old_photographer[]" value="{{ $photographer->assigned_user_id }}">

                                    </div>
                                </div>
                                <div class="form-group row pb-3 hide" id="hide-{{ $p }}">
                                    <label for="" class="col-sm-3  form-label"> New Payment</label>
                                    <label for="" class="col-sm-1  form-label">:</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="new_payment[{{ $photographer->assigned_user_id }}]" id="payment"
                                            class="form-control" data-package-payment="" value="">
                                    </div>
                                </div>
                                @php
                                    $payment = App\Models\BackEnd\EventwisePayment::where(
                                        'user_id',
                                        $photographer->assigned_user_id,
                                    )->where(
                                        'event_details_id',
                                        $id
                                    )->first();
                                @endphp
                                <div class="form-group row pb-3" id="old-{{ $p }}">
                                    @if ($payment && $payment->user_id == $photographer->assigned_user_id)
                                        <label for="" class="col-sm-3 mt-4 form-label">Old Payment</label>
                                        <label for="" class="col-sm-1 mt-4 form-label">:</label>
                                        <div class="col-sm-7 mt-4">
                                            <input type="text" name="old_payment[]" id="payment"
                                                class="form-control" data-package-payment=""
                                                value="{{ $payment->payment_amount }}">
                                        </div>

                                    @endif
                                </div>
                                <div class="col-sm-1">
                                    {{-- <a href="{{ route('delete.assign.user', $photographer->id) }}"
                                        class="btn btn-danger"><i class="fa fa-minus"></i></a> --}}
                                <button class="btn btn-danger" onclick="deleteUser({{ $photographer->id }})">
                                    <i class="fa fa-minus"></i>
                                </button>
                                </div>
                            @endforeach
                        @endif
                           @php
                                $i = 1;
                                $c = 1;
                            @endphp
                        @if (sizeof($assignedCinematographer))
                            <h4 class="text-center mt-3">Assigned Cinematographer</h4>
                            <hr>


                            @foreach ($assignedCinematographer as $cinematographer)
                                <div class="form-group row pb-3 mt-4">
                                    <label class="col-sm-3">Cinematographer {{ $i++ }}</label>
                                    <label class="col-sm-1">:</label>
                                    <div class="col-sm-7">

                                        <input type="text" name="" id="" class="form-control"
                                            value="{{ $cinematographer->user->name }}" readonly>
                                        <input type="hidden" name="old_photographer[]" value="{{ $cinematographer->assigned_user_id }}">

                                    </div>
                                    <div class="col-sm-1">
                                        {{-- <a href="{{ route('delete.assign.user', $cinematographer->id) }}"
                                            class="btn btn-danger"><i class="fa fa-minus"></i></a> --}}
                                            <button class="btn btn-danger" onclick="deleteUser({{ $cinematographer->id }})">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row pb-3 hide" id="hide-{{ $c++ }}">
                                    <label for="" class="col-sm-3  form-label"> New Payment</label>
                                    <label for="" class="col-sm-1  form-label">:</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="new_payment[]"
                                            id="payment" class="form-control" data-package-payment="" value="">
                                    </div>
                                </div>
                                @php
                                    $payment2 = App\Models\BackEnd\EventwisePayment::where(
                                        'user_id',
                                        $cinematographer->assigned_user_id,
                                    )->where(
                                        'event_details_id',
                                        $id
                                    )->first();
                                @endphp
                                <div class="form-group row pb-3" id="old-{{ $c++ }}">
                                    @if ($payment2 && $payment2->user_id == $cinematographer->assigned_user_id)
                                        <label for="" class="col-sm-3 mt-4 form-label">Old Payment</label>
                                        <label for="" class="col-sm-1 mt-4 form-label">:</label>
                                        <div class="col-sm-7 mt-4">
                                            <input type="text"
                                                name="old_payment[]"
                                                id="payment" class="form-control" data-package-payment=""
                                                value="{{ $payment2->payment_amount }}">
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                           @php
                                $i = 1;
                                $pe = 1;
                            @endphp
                        @if (sizeof($assignedPhotoEditor))
                            <h4 class="text-center mt-4">Assigned Photo Editor</h4>
                            <hr>

                            @foreach ($assignedPhotoEditor as $photoEditor)
                                <div class="form-group row pb-3 mt-4">
                                    <label class="col-sm-3">Photo Editor {{ $i++ }}</label>
                                    <label class="col-sm-1">:</label>
                                    <div class="col-sm-7">

                                        <input type="text" name="" id="" class="form-control"
                                            value="{{ $photoEditor->user->name }}" readonly>
                                        <input type="hidden" name="old_photographer[]" value="{{ $photoEditor->assigned_user_id }}">

                                    </div>
                                    <div class="col-sm-1">
                                        {{-- <a href="{{ route('delete.assign.user', $photoEditor->id) }}"
                                            class="btn btn-danger"><i class="fa fa-minus"></i></a> --}}
                                        <button class="btn btn-danger" onclick="deleteUser({{ $photoEditor->id }})">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    </div>
                                </div>
                                <div class="form-group row pb-3 hide" id="hide-{{ $pe++ }}">
                                    <label for="" class="col-sm-3  form-label"> New Payment</label>
                                    <label for="" class="col-sm-1  form-label">:</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="new_payment[{{ $photoEditor->assigned_user_id }}]"
                                            id="payment" class="form-control" data-package-payment="" value="">
                                    </div>
                                </div>
                                @php
                                    $payment3 = App\Models\BackEnd\EventwisePayment::where(
                                        'user_id',
                                        $photoEditor->assigned_user_id,
                                    )->where(
                                        'event_details_id',
                                        $id
                                    )->first();
                                @endphp
                                <div class="form-group row pb-3" id="old-{{ $p++ }}">
                                    @if ($payment3 && $payment3->user_id == $photoEditor->assigned_user_id)
                                        <label for="" class="col-sm-3 mt-4 form-label">Old Payment</label>
                                        <label for="" class="col-sm-1 mt-4 form-label">:</label>
                                        <div class="col-sm-7 mt-4">
                                            <input type="text"
                                                name="old_payment[]" id="payment"
                                                class="form-control" data-package-payment=""
                                                value="{{ $payment3->payment_amount }}">
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                          @php
                                $i = 1;
                                $ce = 1;
                            @endphp
                        @if (sizeof($assignedCineEditor))
                            <h4 class="text-center mt-4">Assigned Cine Editor</h4>
                            <hr>

                            @foreach ($assignedCineEditor as $cineEditor)
                                <div class="form-group row pb-3 mt-4">
                                    <label class="col-sm-3">Cine Editor {{ $i++ }}</label>
                                    <label class="col-sm-1">:</label>
                                    <div class="col-sm-7">

                                        <input type="text" name="" id="" class="form-control"
                                            value="{{ $cineEditor->user->name }}" readonly>
                                        <input type="hidden" name="old_photographer[]" value="{{ $cineEditor->assigned_user_id }}">

                                    </div>
                                    <div class="col-sm-1">
                                        {{-- <a href="{{ route('delete.assign.user', $cineEditor->id) }}"
                                            class="btn btn-danger"><i class="fa fa-minus"></i></a> --}}
                                    <button class="btn btn-danger" onclick="deleteUser({{ $cineEditor->id }})">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    </div>

                                </div>
                                <div class="form-group row pb-3 hide" id="hide-{{ $ce++ }}">
                                    <label for="" class="col-sm-3  form-label"> New Payment</label>
                                    <label for="" class="col-sm-1  form-label">:</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="new_payment[{{ $cineEditor->assigned_user_id }}]"
                                            id="payment" class="form-control" data-package-payment="" value="">
                                    </div>
                                </div>
                                @php
                                    $payment4 = App\Models\BackEnd\EventwisePayment::where(
                                        'user_id',
                                        $cineEditor->assigned_user_id,
                                    )->where(
                                        'event_details_id',
                                        $id)->first();
                                @endphp
                                <div class="form-group row pb-3" id="old-{{ $ce++ }}">
                                    @if ($payment4 && $payment4->user_id == $cineEditor->assigned_user_id)
                                        <label for="" class="col-sm-3 mt-4 form-label">Old Payment</label>
                                        <label for="" class="col-sm-1 mt-4 form-label">:</label>
                                        <div class="col-sm-7 mt-4">
                                            <input type="text" name="old_payment[]"
                                                id="payment" class="form-control" data-package-payment=""
                                                value="{{ $payment4->payment_amount }}">
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif

                        <div class="form-group text-end pt-5 pb-3">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

    <script>
        $(".hide").hide();
        $(document).ready(function() {
            $('.chosen-select').chosen();
        });
    </script>
    <script>
        function filterCategory(e) {
            $("#old-" + id).show();
            var text = e.id;
            var id = text.replace('user_id-', '');
            console.log(id);
            var user_id = document.getElementById('user_id-' + id).value;
            var url = "{{ route('user.type') }}";
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    user_id
                },
                success: function(data) {
                    console.log(data);
                    if (data == 'Freelancer') {
                        $("#hide-" + id).show();
                        $("#old-" + id).hide();
                    }
                    if (data == 'Full Time') {
                        $("#hide-" + id).hide();
                        $("#old-" + id).hide();
                    }
                    // $(".chosen-select").chosen();
                }
            });
        }


    </script>
    <script>
    function deleteUser(userId) {
        if (!confirm("Are you sure you want to delete this user?")) {
            return;
        }

        fetch(`/deleteAssignUser/${userId}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || 'Failed to delete user');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert(data.message || "User deleted successfully!");
                location.reload();
            } else {
                alert(data.message || "Failed to delete user!");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert(error.message || "Something went wrong!");
        });
    }
</script>

@endsection
