@extends('BackEnd/master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

@endsection

@section('content')

<div class="content-header row align-items-center m-0" id="bedcumb">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
    <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}" style="color: #d75b49">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('income.index')}}" style="color: #d75b49">Income</a></li>
    <li id="moduleName" class="breadcrumb-item active">
    Edit Income</li>
    </ol>
    </nav>
</div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <h4 class="card-header">Edit Income</h4>
                <div class="card-body" style="margin-left:50px; margin-right:20px">
                    <form action="{{route('income.update',$income->id)}}" class="form-inner"
                        enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        @csrf
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                            <p class="alert alert-danger">{{$error}}</p>
                            @endforeach
                        @endif 

                        <div class="form-group row pb-3">
                            <label for="name" class="col-sm-2 col-form-label">Income Category </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <select name="category_id" id="" class="form-control form-select chosen-select">
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if($category->id == $income->category_id) selected @endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  

                        <div class="form-group row pb-3">
                            <label for="name" class="col-sm-2 col-form-label">Note<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="remarks" type="text" class="form-control" id="remarks"
                                    placeholder="Type a note Here...." value="{{$income->remarks}}">
                            </div>
                        </div>                    
                        <div class="form-group row pb-3">
                            <label for="name" class="col-sm-2 col-form-label">Amount<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="amount" type="number" class="form-control" id="amount"
                                    placeholder="Type Amount.." value="{{$income->amount}}">
                            </div>
                        </div>                    
                        <div class="form-group row pb-3">
                            <label for="name" class="col-sm-2 col-form-label">Date<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <input name="date" type="date" class="form-control" id="name"
                                value="{{$income->date}}" >
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="name" class="col-sm-2 col-form-label">Payment Type<i
                                    class="text-danger">*</i> </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <select name="payment_type" id="payment" class="form-control form-select" onchange="paymentType();">
                                    <option value="Cash" @if($income->payment_type == 'Cash') selected @endif>Cash</option>
                                    <option value="bKash" @if($income->payment_type == 'bKash') selected @endif>bkash</option>
                                    <option value="Bank" @if($income->payment_type == 'Bank') selected @endif>Bank</option>
                                </select>
                            </div>
                        </div>

                        @if($income->transaction_id)
                            <div class="form-group row pb-3">
                                <label for="name" class="col-sm-2 col-form-label">Transaction Number<i
                                    class="text-danger">*</i></label>
                                <label for="" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="old_transaction_id" id="transaction_id" class="form-control"
                                        placeholder="Type bKash Transaction ID" value="{{$income->transaction_id}}">
                                </div>
                            </div>
                        @else
                            <div class="form-group row pb-3" id="bkash">
                                <label for="name" class="col-sm-2 col-form-label">Transaction Number<i
                                    class="text-danger">*</i></label>
                                <label for="" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="transaction_id" id="transaction_id" class="form-control"
                                        placeholder="Type bKash Transaction ID" >
                                </div>
                            </div>
                        @endif

                        @if($income->account_no)
                            <div class="form-group row pb-3">
                                <label for="name" class="col-sm-2 col-form-label">Account No.<i
                                    class="text-danger">*</i></label>
                                <label for="" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="old_account_no" id="account_no" class="form-control"
                                        placeholder="Type Bank Account No.." value="{{$income->account_no}}">
                                </div>
                            </div>
                        @else
                            <div class="form-group row pb-3" id="bank">
                                <label for="name" class="col-sm-2 col-form-label">Account No.<i
                                    class="text-danger">*</i></label>
                                <label for="" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="account_no" id="account_no" class="form-control"
                                        placeholder="Type Bank Account No..">
                                </div>
                            </div>
                        @endif

                        <div class="form-group row pb-3">
                            <label for="name" class="col-sm-2 col-form-label">Payment Slip(If any)</label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                            <input name="document" type="file" class="form-control" id="document"
                                    placeholder="" >
                                <small class="text-success">Previous Document:{{ $income->document ? $income->document :'' }}</small>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
            $('.chosen-select').chosen();
            $('#bkash').hide();
            $('#bank').hide();
        });
</script>
<script>
    $(function () {

        $('.textarea').summernote({
            height:150
        })
    })

    function paymentType(){
        var payment = document.getElementById('payment').value;
        if(payment == 'Bank'){
            $('#bank').show().prop('required', true);
            $('#bkash').hide();
        }
        else if(payment == 'bKash'){
            $('#bkash').show().prop('required', true);  
            $('#bank').hide()
        }else{
            $('#bkash').hide();
            $('#bank').hide()
        }
    }
</script>
@endsection
