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
    Payment Edit</li>
    </ol>
    </nav>
</div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <h4 class="card-header"></h4>
                <div class="card-body" style="margin-left:50px; margin-right:20px;">
                    <form action="{{route('staff.payment.update',$payment->id)}}" class="form-inner"
                        enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        @csrf
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                            <p class="alert alert-danger">{{$error}}</p>
                            @endforeach
                        @endif
                        @php $i = 1; @endphp
                            <div class="form-group row pb-3">
                                <label for="date" class="col-sm-2 col-form-label"> Payment Amount </label>
                                <label for="" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9">
                                    <input name="amount" type="number" class="form-control" id="title"
                                       value="{{$payment->total_amount}}" >
                                </div>
                            </div>
                            <div class="form-group row pb-3">
                                <label for="amount" class="col-sm-2 col-form-label"> Advance </label>
                                <label for="" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9">
                                    <input name="paid" type="number" class="form-control" id="title"
                                       value="{{$payment->paid}}" >
                                </div>
                            </div>
                            <div class="form-group row pb-3">
                                <label for="method" class="col-sm-2 col-form-label"> Due </label>
                                <label for="" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9">
                                    <input name="due" type="text" class="form-control" id="title"
                                       value="{{$payment->due}}" >
                                </div>
                            </div>
                            <div class="form-group row pb-3">
                                <label for="method" class="col-sm-2 col-form-label"> Payment System </label>
                                <label for="" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9">
                                    <select name="method" id="" class="form-control">
                                        <option value="">Select Paymnet System</option>
                                        <option value="Cash" @if($payment->payment_method == 'Cash')selected @endif>Cash</option>
                                        <option value="Bank" @if($payment->payment_method == 'Bank')selected @endif>Bank</option>
                                        <option value="bKash" @if($payment->payment_method == 'bKash')selected @endif>bKash</option>
                                    </select>
                                    {{-- <input name="method" type="text" class="form-control" id="title"
                                       value="{{$payment->payment_system}}" > --}}
                                </div>
                            </div>
                            <div class="form-group row pb-3">
                                <label for="trans_id" class="col-sm-2 col-form-label">Transaction Id/ Acc. No. <i
                                        class="text-danger">*</i> </label>
                                <label for="" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9">
                                    <input name="trans_id" type="text" class="form-control" id="title"
                                        value="{{$payment->trans_id}}" >
                                </div>
                            </div>
                            <div class="form-group row pb-3">
                                <label for="" class="col-sm-2 col-form-label">Payment Date</label>
                                <label for="" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9">
                                    <input name="payment_date" type="date" class="form-control" id="title"
                                        value="{{$payment->payment_date}}" >
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
