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
            <h4 class="card-header text-center">Add Expenses </h4>
            <div class="card-body" style="margin-left:50px; margin-right:20px">
                <form action="{{ route('store-expense') }}" class="form-inner" enctype="multipart/form-data" method="post"
                    accept-charset="utf-8">
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger">{{ $error }}</p>
                        @endforeach
                    @endif
                    <input type="hidden" name="event_id[]" value="{{$event->id}}">
                    <div class="form-group row pb-3">
                        <label for="name" class="col-sm-2 col-form-label">Expense Category </label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-9">
                            <select name="category_id[]" id="" class="form-control form-select chosen-select">
                                <option value="" selected disabled>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  
                    
                     <div class="form-group row pb-3">
                            <label for="name" class="col-sm-2 col-form-label">Expense Type </label>
                            <label for="" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9">
                                <select name="expense_type" id="" class="form-control form-select chosen-select">
                                    <option value="" selected disabled>Select Type</option>
                                    <option value="Fixed">Fixed</option>
                                    <option value="Office Expense">Office Expense</option>
                                    <option value="Variable">Variable</option>
                                </select>
                            </div>
                        </div> 

                    <div class="form-group row pb-3">
                        <label for="name" class="col-sm-2 col-form-label">Note<i
                                class="text-danger">*</i> </label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-9">
                            <input name="remarks[]" type="text" class="form-control" id="remarks"
                                placeholder="Type a note Here...." >
                        </div>
                    </div>                    
                    <div class="form-group row pb-3">
                        <label for="name" class="col-sm-2 col-form-label">Expense Amount<i
                                class="text-danger">*</i> </label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-9">
                            <input name="amount[]" type="number" class="form-control" id="amount"
                                placeholder="Type Amount.." >
                        </div>
                    </div>                    
                    <div class="form-group row pb-3">
                        <label for="name" class="col-sm-2 col-form-label">Expense Date<i
                                class="text-danger">*</i> </label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-9">
                            <input name="date[]" type="date" class="form-control" id="name"
                                value="{{date('Y-m-d')}}">
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label for="name" class="col-sm-2 col-form-label">Payment Type<i
                                class="text-danger">*</i> </label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-9">
                            <select name="payment_type[]" id="payment-1" class="form-control form-select" onchange="paymentType(this);">
                                <option value="Cash">Cash</option>
                                <option value="bKash">bkash</option>
                                <option value="Bank">Bank</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row pb-3 bkash" id="bkash-1">
                        <label for="name" class="col-sm-2 col-form-label">Transaction Number<i
                            class="text-danger">*</i></label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-9">
                            <input type="text" name="transaction_id[]" id="transaction_id" class="form-control"
                                placeholder="Type bKash Transaction ID">
                        </div>
                    </div>

                    <div class="form-group row pb-3 bank" id="bank-1">
                        <label for="name" class="col-sm-2 col-form-label">Account No.<i
                            class="text-danger">*</i></label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-9">
                            <input type="text" name="account_no[]" id="account_no" class="form-control"
                                placeholder="Type Bank Account No..">
                        </div>
                    </div>
                    
                    <div class="form-group row pb-3">
                        <label for="name" class="col-sm-2 col-form-label">Payment Slip(If any)</label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-9">
                            <input name="document[]" type="file" class="form-control" id="document"
                                placeholder="" >
                        </div>

                    </div>

                    <div class="new-expense">

                    </div>

                    

                    <button type="button" class="col-sm-1 btn btn-success mt-2 mb-4" id="add" onclick="addNewEvent(this)">+
                        Add</button>
                        
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
    $(document).ready(function() {
            $('.bkash').hide();
            $('.bank').hide();
        });
</script>
    <script>
        let i = 1;

         function addNewEvent() {
            ++i;
            $('.new-expense').append(`<hr>
            <input type="hidden" name="event_id[]" value="{{$event->id}}">
                    <div class="form-group row pb-3">
                        <label for="name" class="col-sm-2 col-form-label">Expense Category </label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-9">
                            <select name="category_id[]" id="" class="form-control form-select chosen-select">
                                <option value="" selected disabled>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  

                    <div class="form-group row pb-3">
                        <label for="name" class="col-sm-2 col-form-label">Note<i
                                class="text-danger">*</i> </label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-9">
                            <input name="remarks[]" type="text" class="form-control" id="remarks"
                                placeholder="Type a note Here...." >
                        </div>
                    </div>                    
                    <div class="form-group row pb-3">
                        <label for="name" class="col-sm-2 col-form-label">Expense Amount<i
                                class="text-danger">*</i> </label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-9">
                            <input name="amount[]" type="number" class="form-control" id="amount"
                                placeholder="Type Amount.." >
                        </div>
                    </div>                    
                    <div class="form-group row pb-3">
                        <label for="name" class="col-sm-2 col-form-label">Expense Date<i
                                class="text-danger">*</i> </label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-9">
                            <input name="date[]" type="date" class="form-control" id="name"
                                value="{{date('Y-m-d')}}">
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label for="name" class="col-sm-2 col-form-label">Payment Type<i
                                class="text-danger">*</i> </label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-9">
                            <select name="payment_type[]" id="payment-`+i+`" class="form-control form-select" onchange="paymentType(this);">
                                <option value="Cash">Cash</option>
                                <option value="bKash">bkash</option>
                                <option value="Bank">Bank</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row pb-3 bkash" id="bkash-`+i+`">
                        <label for="name" class="col-sm-2 col-form-label">Transaction Number<i
                            class="text-danger">*</i></label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-9">
                            <input type="text" name="transaction_id[]" id="transaction_id" class="form-control"
                                placeholder="Type bKash Transaction ID">
                        </div>
                    </div>

                    <div class="form-group row pb-3 bank" id="bank`+i+`">
                        <label for="name" class="col-sm-2 col-form-label">Account No.<i
                            class="text-danger">*</i></label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-9">
                            <input type="text" name="account_no[]" id="account_no" class="form-control"
                                placeholder="Type Bank Account No..">
                        </div>
                    </div>
                    
                    <div class="form-group row pb-3">
                        <label for="name" class="col-sm-2 col-form-label">Payment Slip(If any)</label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-9">
                            <input name="document[]" type="file" class="form-control" id="document"
                                placeholder="" >
                        </div>
                    </div>
                            <span class="remove btn btn-danger text-center" style="width: fit-content; margin-bottom:12px"><i class="fa fa-times"></i></span>
                            </div>
                            `);
                            $('.bkash').hide();
                        $('.bank').hide();
            $('.new-expense').on('click', '.remove', function() {
                $(this).parent().remove();
            });
        }
    </script>

 

    <script>

    function paymentType(e){
        
        const text = e.id;
        const id = text.replace('payment-', '');
        var payment = document.getElementById('payment-'+id).value;
        if(payment == 'Bank'){
            $('#bank-'+id).show().prop('required', true);
            $('#bkash-'+id).hide();
        }
        else if(payment == 'bKash'){
            $('#bkash-'+id).show().prop('required', true);  
            $('#bank-'+id).hide()
        }else{
            $('#bkash-'+id).hide();
            $('#bank-'+id).hide()
        }
    }
    </script>

    
@endsection
