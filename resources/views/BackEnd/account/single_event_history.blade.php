<style>
    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
        padding: 5px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 0px solid #ddd;
        /* text-align: left !important; */
        font-size: 15px;
        color: black;
    }
    .expense {
        text-align: center;
    }
   
</style>


<div class="row">
    @php $date = date('d/m/Y'); @endphp
    <div class="col-md-12 text-right">
        <button class="mt-2 col-sm-1 btn btn-warning"
            onClick="document.title = 'Bridal Harmony-{{ $event_name }}-Reort'; printDiv('printableArea'); "
            style="margin-right:100px"> <i class="fa fa-print"></i> Print </button>
    </div>
</div>

<div id="printableArea">

        <div class="row text-center">
            <div class="col-sm-12">
                <h3><strong>Single Event Report</strong></h3>
                <h4 style="margin-top:10px"><strong> Venue -  {{ $event_name }}</strong></h4>
                <h6 style="margin-top:10px">Event Date - {{ date('d/m/Y', strtotime($event_date)) }}</h6>
            </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-sm-12">
                <table class="table table-bordered">
                    <thead class="text-black">
                        <tr>
                            <th>Event Date</th>
                            <th>Event Venue</th>
                            <th>Event Price</th>
                        </tr>
                        <tr>
                            @php
                            $event_master_count = App\Models\BackEnd\EventDetails::where('master_id', $event->master_id)->count();
                            
                            if ($event_master_count === 1) {
                                $event_price = $event->event->payment->payment_amount ?? 0; // Use paymentAmount if available, otherwise 0
                            } else {
                                $event_price = $event->package_price ? $event->package_price : $event->package->discount;
                            }
                        @endphp
                            <td>{{ date('d/m/Y', strtotime($event_date)) }}</td>
                            <td>{{ $event_name }}</td>
                            <td>{{ $event_price }}</td>
                        </tr>
                        <tr class="text-end">
                            <th colspan="3" class="expense" style="text-align: center">Event Expenses</th>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <th>Particulars</th>
                            <th>Amount </th>
                        </tr>

                    </thead>
                    <tbody>

                        @php
                            $total = 0;
                            $total_income = 0;
                            $total_expense = 0;
                            $total_event_expense = 0;
                            $total_staff_payment = 0;
                        @endphp
                       
                        @if ($expense)
                            @foreach ($expense as $v_expense)
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($v_expense->date)) }}</td>
                                    <td>{{ $v_expense->remarks }}</td>
                                    <td>{{ $v_expense->amount }}</td>
                                </tr>
                                @php $total_event_expense += $v_expense->amount @endphp
                                @php $total_expense += $v_expense->amount @endphp
                            @endforeach
                            <tr>
                                <th  colspan="2" style="text-align:end">Total Event Expense</th>
                                <td>{{$total_event_expense}}</td>
                            </tr>
                        @endif
                        @if (count($staffPayment)>0)
                            <tr>
                                <th colspan="3" class="expense" style="text-align: center">Assigned Staff Payment</th>
                            </tr>
                            @foreach($staffPayment as $v_payment)
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($v_payment->payment_date)) }}</td>
                                    <td> Payment of - {{$v_payment->user->name}}</td>
                                    <td>{{$v_payment->payment_amount}}</td>
                                </tr>
                                @php $total_staff_payment += $v_payment->payment_amount @endphp
                                @php $total_expense += $v_payment->payment_amount @endphp
                                

                            @endforeach
                            <tr>
                                <th  colspan="2" style="text-align:end">Total Staff Payment</th>
                                <td>{{$total_staff_payment}}</td>
                            </tr>
                        @endif
                        
                        

                        @php 
                        
                            $total_expense  += $per_event_expense ;
                            $formatted_total_expense = number_format($total_expense);
                            $total = $event_price - $total_expense
                         @endphp
                    </tbody>
                </table>
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-end text-black">Event Price</th>
                            <th  class="text-end text-black">{{ $event_price }}</th>
                          </tr>
                          <tr>
                            <th colspan="2" class="text-end text-black">Total Expense (Event Expense + Staff Payment + Fixed Expense({{$per_event_expense}}))</th>
                            <th  class="text-end text-black">{{$formatted_total_expense}}</th>
                          </tr>
                          <tr>
                            <th colspan="2" class="text-end text-black">Profit = Event Price - Total Expense</th>
                            <th  class="text-end text-black">{{number_format($total)}}</th>
                          </tr>
                    </thead>
                  </table>
            </div>
        </div>

    </div>

<script>
    function printDiv(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
