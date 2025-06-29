@extends('BackEnd.master')
<link href="http://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css" rel="stylesheet" />
<style>
    .round-button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 50%;
    background-color: #3498db; /* Change this to your preferred background color */
    color: #ffffff; /* Change this to your preferred text color */
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.round-button:hover {
    background-color: #2980b9; /* Change this to the hover background color */
}
.custom-btn{
    background: green;
    color: white;
    padding: 4px;
    width: 0px;
    height: 30px; 
    font-size: 14px;
    border: none;
}
</style>

@section('content')
    <div class="content-header row align-items-center m-0" id="bedcumb">
        <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
            <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" style="color: #d75b49">Home</a></li>
                <li id="moduleName" class="breadcrumb-item active">
                    Evnt Info</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                {{-- <h4 class="card-header">Booking Data </h4> --}}
                <div class="card-body" style="margin-left:50px; margin-right:20px">
                    <form action="{{ route('event.update',$event->id) }}" class="form-inner" enctype="multipart/form-data" method="post"
                        accept-charset="utf-8">
                        @csrf
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p class="alert alert-danger">{{ $error }}</p>
                            @endforeach
                        @endif

                       
                        <div class="form-group row pb-3">
                            <label class="col-sm-3">Bride Name</label>
                            <label class="col-sm-1">:</label>
                            <div class="col-sm-8">
                                <input type="text" id="" name="bride_name" class="form-control" value="{{ $event->bride_name }}">
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <label class="col-sm-3">Groom Name</label>
                            <label class="col-sm-1">:</label>
                            <div class="col-sm-8">
                                <input type="text" id="" name="groom_name" class="form-control" value="{{ $event->groom_name }}">
                            </div>
                        </div>
                         <div class="form-group row pb-3">
                            <label class="col-sm-3">Client Instructions</label>
                            <label class="col-sm-1">:</label>
                            <div class="col-sm-8">
                                <!--<input type="text"id="" name="instructions" class="form-control" value="{{ $event->instructions }}">-->
                                <textarea name="instructions" class="form-control " id="" cols="30" rows="4">@if ($event->instructions){{$event->instructions}} @endif</textarea>

                                
                            </div>
                        </div>
                        
                        <div class="form-group row pb-3">
                            <label class="col-sm-3">Office Instructions</label>
                            <label class="col-sm-1">:</label>
                            <div class="col-sm-8">
                                <!--<input type="text"id="" name="instructions" class="form-control" value="{{ $event->instructions }}">-->
                                <textarea name="office_instructions" class="form-control " id="" cols="30" rows="4">@if ($event->office_instructions){{$event->office_instructions}} @endif</textarea>
                                
                            </div>
                        </div>
                        @php $i = 0; $e = 0; @endphp
                        @foreach ($eventDetails as $key => $v_event)
                            @php  ++$i;  @endphp
                            <input type="hidden" name="v_event_id" id="event_{{ ++$e }}" value="{{ $v_event->id }}">
                            <div class="row mt-4 p-3" style="border: 1px solid rgba(184, 182, 182, 0.955)">
                                <div class="col-md-12 mt-3">
                                    @if($v_event->status == 2)
                                        <h3 class="text-center text-danger">Event {{$i }}</h3>
                                        <p class="text-center text-danger">Inactive</p>
                                    @else
                                        <h3 class="text-center">Event {{$i }}</h3>
                                    @endif
                                    <hr>
                                </div>
                                <div class="form-group row pb-3">
                                    <label class="col-sm-2">Event Type</label>
                                    <label class="col-sm-1">:</label>
                                    <div class="col-sm-3">
                                        <select name="type[{{ $v_event->id }}]" id="" class="form-control">
                                            @foreach($types as $type)
                                            <option value="{{$type->type_id }}"  @if($type->type_id ==  $v_event->type_id) selected @endif >{{ $type->type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        <label class="col-sm-2">Event Shift</label>
                                        <label class="col-sm-1">:</label>
                                        <div class="col-sm-3">
                                            <select name="shift[{{ $v_event->id }}]" id="" class="form-control">
                                                @foreach($shifts as $shift)
                                                <option value="{{$shift->shift_id }}"  @if($shift->shift_id ==  $v_event->shift_id) selected @endif >{{ $shift->shift_name }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                <div class="form-group row pb-3">
                                    <label class="col-sm-2">Event District</label>
                                    <label class="col-sm-1">:</label>
                                    <div class="col-sm-3">
                                        <select name="district[{{$v_event->id}}]" id="" class="form-control">
                                            @foreach($districts as $district)
                                            <option value="{{$district->district_id }}"  @if($district->district_id ==  $v_event->district_id) selected @endif >{{ $district->district }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        <label class="col-sm-2">Event Venue</label>
                                        <label class="col-sm-1">:</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="venue[{{ $v_event->id }}]" class="form-control"
                                            value="{{ $v_event->venue }}">
                                        </div>
                                </div>
                                <div class="form-group row pb-3">
                                    <label class="col-sm-2">Event Date & Time</label>
                                    <label class="col-sm-1">:</label>
                                    <div class="col-sm-2">
                                        <input type="date" name="date[{{ $v_event->id }}]" id="" class="form-control" value="{{ $v_event->date }}">
                                    </div>
                                    @php 
                                    $start_time = date('g:i a',strtotime($v_event->start_time));
                                    $end_time  = date('g:i a',strtotime($v_event->end_time));
                                     @endphp
                                    <div class="col-sm-3">
                                        <input type="text" name="start_time[{{ $v_event->id }}]" id="start_time" class="form-control" value="{{$start_time}}"
                                        onfocus="(this.type='time')">
                                    </div>
                                    <div class="col-sm-1">
                                        <p>To </p>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" name="end_time[{{ $v_event->id }}]" id="end_time" placeholder="DD/MM/YY"
                                            class="form-control" value="{{ $end_time}}" onfocus="(this.type='time')">
                                    </div>
                                </div>
                                <div class="form-group row pb-3">
                                   
                                </div>
                                <div class="form-group row pb-3">
                                    <label class="col-sm-2">Package</label>
                                    <label class="col-sm-1">:</label>
                                    <div class="col-sm-3">
                                        <select name="category[{{ $v_event->id }}]" id="category_id_{{ $v_event->id }}" class="form-control" onchange="filterPackage(this)">
                                            @foreach($package_category as $category)
                                            <option value="{{$category->id }}" @if($category->id ==  $v_event->category_id) selected @endif >{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        <label class="col-sm-2">Package Details</label>
                                        <label class="col-sm-1">:</label>
                                        <div class="col-sm-3">
                                            <select name="package[{{ $v_event->id }}]" id="package_id_{{ $v_event->id }}" class="form-control" onchange="letAmount(this),calculatePrice({{ $v_event->id }})">
                                                @foreach($packages as $package)
                                                <option value="{{$package->id }}" @if($package->id ==  $v_event->package_id) selected @endif >{{ $package->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="form-group row pb-3">
                                   
                                </div>
                                <div class="form-group row pb-3">
                                    <label class="col-sm-2">Transportaion Cost</label>
                                    <label class="col-sm-1">:</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="transportation[{{ $v_event->id }}]" id="transportationCost_{{ $v_event->id }}" class="form-control"
                                            value="{{$v_event->transportation}}" onkeyup="updatePrice(this,{{ $v_event->id }})">
                                    </div>
                                    <label class="col-sm-2">Accomodation Cost</label>
                                    <label class="col-sm-1">:</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="accommodation[{{ $v_event->id }}]" id="accommodationCost_{{ $v_event->id }}" class="form-control"
                                            value="{{$v_event->accomodation}}"  onkeyup="updatePrice(this,{{ $v_event->id }})">
                                    </div>
                                </div>

                                <div class="form-group row pb-3" >
                                    <label class="col-sm-2">Shift Charge</label>
                                    <label class="col-sm-1">:</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="shiftcharge[{{ $v_event->id }}]" id="shiftCharge_{{ $v_event->id }}" class="form-control" 
                                        value="{{$v_event->shift_charge}}" onkeyup="updatePrice(this,{{ $v_event->id }})">
                                    </div>
                                     <label class="col-sm-2">Package Price</label>
                                    <label class="col-sm-1">:</label>
                                    <div class="col-sm-3">
                                        
                                        <input type="text" name="packageprice[{{ $v_event->id }}]"  id="packagePrice_{{ $v_event->id }}" class="form-control" 
                                        value="{{ $v_event->package->discount == $v_event->package_price  ?$v_event->package->discount : $v_event->package_price}}" data-package-price="{{ $v_event->package->discount }}" >
                                        <input type="hidden" class="hidden" id="hiddenpackagePrice_{{ $v_event->id }}" value="{{$v_event->package->discount}}">
                                    </div>
                                </div>
                                <div class="form-group row pb-3" >
                                    @php 
                                    $old_backups  = App\Models\BackEnd\FootageBackup::where('event_details_id',$v_event->id)->get();
                                     @endphp
                                    @if($old_backups->isNotEmpty())
                                        <label class="col-sm-2">Previous Footage Backup</label>
                                        <label class="col-sm-1">:</label>
                                        <div class="col-sm-4">
                                            <div class="row">
                                                @foreach($old_backups as $backup)
                                                <div class="col-sm-11">
                                                <input type="text" id="" name="old_backup[{{ $v_event->id }}]" class="form-control mb-3"
                                                value="{{$backup->footage_backup}}"> 
                                            </div>
                                                <div class="col-sm-1">
                                                    <a href="{{route('delete.footage',$backup->id)}}" class="btn btn-danger" onclick="addMore(this)"><i class="fa fa-minus"></i></a>
                                                </div>
                                            @endforeach
                                            </div>
                                        </div>
                                     <div class="col-sm-1"></div>
                                    @else
                                    <label class="col-sm-2">Footage Backup</label>
                                    <label class="col-sm-1">:</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="" name="backup[{{ $v_event->id }}][1]" class="form-control previous-field"
                                            value="">
                                        
                                    </div>
                                    @endif
                                    <button type="button" class="col-sm-1 custom-btn" id="add-{{ $v_event->id }}" onclick="addMore(this)"> <i class="fa fa-plus"></i> </button>
                                    
                                    <div id="footage-{{ $v_event->id }}">
                                    </div>
                                    
                                </div>
                                 <div class="form-group row pb-3" >
                                    <label class="col-sm-2">Add Ons</label>
                                    <label class="col-sm-1">:</label>
                                    <div class="col-sm-9">
                                       <textarea name="add_ons[{{ $v_event->id }}]" class="form-control " id="" cols="30" rows="4">@if($v_event->add_ons){{$v_event->add_ons}}@endif</textarea>
                                    </div>
                                    
                                </div>
                            </div>
                        @endforeach
                       
                        <div class="row mt-5" style="border: 1px solid rgba(184, 182, 182, 0.955)">
                            <div class="form-group row pb-3 pt-3">
                                <div class="col-md-12">
                                    <h3 class="text-center text-bold">Payment Information</h3>
                                    <hr>
                                </div>
                                
                            </div>
                            <div class="form-group row pb-3 pt-3 ">
                                <div class="col-md-12 text-end ">
                                    <button type="button" class="btn btn-primary text-white" id="add-payment" onclick="addNewPayment(this)"> + Add New Payment</button>
                                </div>
                                
                            </div>
                            <div id="payment-wrapper">

                            </div>
                             <div class="form-group row pb-3">
                                <label class="col-sm-3">Delivery Date</label>
                                <label class="col-sm-1">:</label>
                                <div class="col-sm-8">
                                    <input type="date" name="delivery_date"  id="" class="form-control" placeholder="Enter Delivery Date" value="{{$event->delivery_date}}">
                                </div>
                            </div>
                            <div class="form-group row pb-3">
                                <label class="col-sm-3">Total Price</label>
                                <label class="col-sm-1">:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="totalPrice"  id="totalPrice" class="form-control"
                                        value="{{ $payment !== null ? $payment->payment_amount : 0  }}" data-package-price="{{$payment !== null ? $payment->payment_amount : 0 }}"
                                        onkeyup="dueCalculate()" >
                                        <input type="hidden" id="hiddentotalPrice" value="{{ $payment !== null  ? $payment->payment_amount : 0 }}">
                                </div>
                            </div>
                            <div class="form-group row pb-3">
                                <label class="col-sm-3">Paid</label>
                                <label class="col-sm-1">:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="advance" id="advance" class="form-control" data-package-advance="{{ $payment !== null ? $payment->advance:0 }}"
                                        value="{{ $payment !== null ? $payment->advance:0  }}">
                                </div>
                            </div>
                            <div class="form-group row pb-3">
                                <label class="col-sm-3">Due</label>
                                <label class="col-sm-1">:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="due" id="totalDue" class="form-control" data-package-due="{{$payment !== null ? $payment->due_amount : 0 }}"
                                        value="{{ $payment !== null ?  $payment->due_amount : 0 }}">
                                        <input type="hidden" id="hiddentotalDue" value="{{ $payment !== null ? $payment->due_amount : 0  }}">
                                </div>
                            </div>
                        </div>
                            <div class="form-group text-end  pb-3 mt-3">
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
    <script src="http://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>
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


function letAmount(e) {
    const text = e.id;
        const id = text.replace('package_id_', '');
        const package_id = document.getElementById('package_id_' + id).value;
        $.ajax({
            url: '{{ route('package.details') }}',
            data: { package_id: package_id }, // Sending data in key-value format
            type: 'GET',
            success: function(response) {
                let selectedPackagePrice = parseInt(response.discount);
                if (!isNaN(selectedPackagePrice)) {
                   $('#packagePrice_' + id).val(selectedPackagePrice);
                   $('#hiddenpackagePrice_' + id).val(selectedPackagePrice);
                   $('#packagePrice_' + id).data('data-package-price', selectedPackagePrice);

                } else {
                    console.error('Invalid package amount:', packageData.discount);
                }
                
            },
                error: function(err) {
                alert('No data );');
                }
            });

}

function dueCalculate(){
    var totalPrice = document.getElementById('totalPrice').value;
    var advance = document.getElementById('advance').value;
    var totalDue = totalPrice - advance;
    document.getElementById('totalDue').value = totalDue;
}

    </script>
    <script>
        // $('.chosen').chosen();
        $(document).ready(function() {
            $('.chosen').chosen({
                search_contains: true,
            });
        });
        var t = 1;

        function addMore(e) {
            const text = e.id;
            // console.log(text);
            const id = text.replace('add-', '');
            ++t;

            $('#footage-'+id).append(`
                <div class="col-md-12">
                    <div class="form-group row pb-3 mt-3" >
                        <label class="col-sm-2">More Backup</label>
                        <label class="col-sm-1">:</label>
                        <div class="col-sm-3">
                            <input type="text"id="" name="backup[`+id+`][`+t+`]" class="form-control"
                                value="">
                        </div>
                        <span class="col-sm-1 remove btn btn-danger text-end" style="width: fit-content; margin-bottom:12px"><i class="fa fa-times"></i></span>
                    </div>
                    
                </div>
            `);

            $('#footage-'+id).on('click', '.remove', function() {
                $(this).parent().remove();
            });
        }

        let p = 0;
        function addNewPayment(){
            ++p;
            $('#payment-wrapper').append(`
                <div class="col-md-12">
                    <div class="form-group row pb-3">
                                <label class="col-sm-3">Payment Amount</label>
                                <label class="col-sm-1">:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="payment_amount[`+p+`]" id="payment_amount`+ p +`" class="form-control payment_amount"
                                        value="" onkeyup=" updatePrice(this)">
                                </div>
                            </div>
                            <div class="form-group row pb-3">
                                <label class="col-sm-3">Select Payment System</label>
                                <label class="col-sm-1">:</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="payment_method[`+p+`]"
                                        id="payment_method" placeholder="Package Type">
                                        <option selected disabled>Payment System</option>
                                        <option value="cash">Cash</option>
                                        <option value="bKash">bKash</option>
                                        <option value="bank">Bank</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row pb-3">
                                <label class="col-sm-3">Transection ID/Bank Acc. No.</label>
                                <label class="col-sm-1">:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="" name="transaction_id[`+p+`]" class="form-control"
                                        value="">
                                </div>
                            </div>
                            <div class="form-group row pb-3">
                                <label class="col-sm-3">Payment Date</label>
                                <label class="col-sm-1">:</label>
                                <div class="col-sm-8">
                                    <input type="date" id="" name="payment_date[`+p+`]" class="form-control"
                                        value="">
                                </div>
                            </div>
                    <span class="remove-btn btn btn-danger text-center" id="remove" style="width: fit-content; margin-bottom:12px"><i class="fa fa-times"></i></span>
                </div>
            `);

            $('#payment-wrapper').on('click', '.remove-btn', function() {
                $(this).parent().remove();
            });
        }

        function calculatePrice(eventId) {
        var selectedPackageId = document.getElementById('package_id_' + eventId).value;
        var packagePriceInput = document.getElementById('packagePrice_' + eventId);
        var hiddenPackagePriceInput = document.getElementById('hiddenpackagePrice_' + eventId);

        // Assuming you have an array or object containing package information
        var packages = {!! json_encode($packages) !!};
        
        var selectedPackage = packages.find(package => package.id == selectedPackageId);
     

        if (selectedPackage) {
            // Update the visible input field
        packagePriceInput.value = selectedPackage.discount;

        // Update the hidden input field
        hiddenPackagePriceInput.value = selectedPackage.discount;

        // Recalculate the total price
        calculateTotal();
    }
}
        function calculateTotal(id) {
            var total = 0;
        // Assuming you have an array or object containing event details
            @foreach ($eventDetails as $t_event)
                var eventId = '{{$t_event->id}}';
                var afterPrice = parseInt($('#hiddenpackagePrice_' + eventId).val());
                var beforePrice = parseInt($('#packagePrice_' + eventId).val());
                var price = !isNaN(afterPrice) && afterPrice > 0 ? afterPrice : (beforePrice || 0);
                total += price;
            @endforeach
            document.getElementById('totalPrice').value = total;
            document.getElementById('hiddentotalPrice').value = total;
            var advance = parseInt(document.getElementById('advance').getAttribute('data-package-advance')) || 0;
            var due = total - advance;
            document.getElementById('totalDue').value = due;
            document.getElementById('hiddentotalDue').value = due;
            // Update the total field
            
        }


        function updatePrice(element) {
                var totalEventCost = 0;
                const text = element.id;
                let payments = document.getElementsByClassName('payment_amount');
                let total = Array.from(payments).map(payment => payment.innerHTML);
                // console.log(total);
                let total_payment_amount = 0;
                let totalPackagePrice = 0;

            // Loop through each event
            @foreach ($eventDetails as $p_event) 
                var eventId = '{{$p_event->id}}';
                var transportationCost = parseInt(document.getElementById('transportationCost_' + eventId).value) || 0;
                var accommodationCost = parseInt(document.getElementById('accommodationCost_' + eventId).value) || 0;
                var shiftCharge = parseInt(document.getElementById('shiftCharge_' + eventId).value) || 0;
                var hiddenPrice = parseInt($('#hiddenpackagePrice_' + eventId).val());
                var mainPrice = parseInt($('#packagePrice_' + eventId).val());
                var packagePrice = !isNaN(hiddenPrice) && hiddenPrice > 0 ? hiddenPrice : (mainPrice || 0);
                var finalEventCost = transportationCost + accommodationCost + shiftCharge + packagePrice;
                totalPackagePrice += packagePrice;
                document.getElementById('packagePrice_' + eventId).value = finalEventCost;
                var otherCost = transportationCost + accommodationCost + shiftCharge;
                totalEventCost += otherCost;
            @endforeach
            // console.log(totalPackagePrice);
            for(i=1; i<= total.length ; i++){
                let payment_amount =  parseInt(document.getElementById('payment_amount'+i).value);
                
                total_payment_amount += payment_amount;
            }

            var hiddentotalPrice = parseInt($('#hiddentotalPrice').val()) || 0;
            var previousPrice = parseInt(document.getElementById('totalPrice').getAttribute('data-package-price')) || 0;
            var totalPrice = !isNaN(hiddentotalPrice) && hiddentotalPrice > 0 ? hiddentotalPrice : (previousPrice || 0);
            var hiddenDue = parseInt($('#hiddentotalDue').val()) || 0;
            var previousDue = parseInt(document.getElementById('totalDue').getAttribute('data-package-due')) || 0;
            var advance = parseInt(document.getElementById('advance').getAttribute('data-package-advance')) || 0;
            var totalDue =  !isNaN(hiddenDue) && hiddenDue > 0 ? hiddenDue : (previousDue || 0);
            console.log(hiddentotalPrice);
            // Calculate the final total price by adding the existing total price and the total Other cost
            var finalTotalPrice = totalPrice + totalEventCost;
            var finalTotalDue = totalDue + totalEventCost - total_payment_amount;

            // Update the display for the total price
            document.getElementById('totalPrice').value = finalTotalPrice;
            document.getElementById('totalDue').value = finalTotalDue;
        
            if(!isNaN(total_payment_amount)){
                var finalPaid = advance + total_payment_amount;
                var finalDue = finalTotalDue - total_payment_amount;
                document.getElementById('advance').value = finalPaid;
                // document.getElementById('totalDue').value = finalDue;
            }else{
                document.getElementById('advance').value = advance
                // document.getElementById('totalDue').value = finalTotalDue
            }
            if(finalTotalDue == 0){
                var button = document.getElementById('add-payment');
                button.disabled = true;
            }
        }


    </script>
    <script type="text/javascript">
          
    </script>
@endsection
