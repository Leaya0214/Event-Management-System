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
        text-align: left !important;
        font-size: 15px;
    }
</style>


<div class="row">
    @php $date = date('d/m/Y'); @endphp
    <div class="col-md-12 text-right">
        <button class="mt-2 col-sm-1 btn btn-warning"
            onClick="document.title = 'Bridal Harmony-Balance Sheet-{{ $date }}'; printDiv('printableArea'); "
            style="margin-right:100px"> <i class="fa fa-print"></i> Print </button>
    </div>
</div>

<div id="printableArea">

    <div class="container" style="margin-top: 50px">
        <div class="row text-center">
            <div class="col-sm-12">
                <h2><strong> Bridal Harmony</strong></h2>
                <h3 style="margin-top:10px"><strong> Balance Sheet </strong></h3>
                <h6 style="margin-top:10px">{{ date('d/m/Y', strtotime($from_date)) }} -
                    {{ date('d/m/Y', strtotime($end_date)) }}</h6>
            </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-sm-12">
                <table class="table table-bordered">
                    <thead class="">
                        <tr>
                            <th>Date</th>
                            <th>Particulars</th>
                            <th>Credit</th>
                            <th>Invoice No</th>
                            <th>Debit</th>
                            <th>Invoice No</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                            $total_income = 0;
                            $total_expense = 0;
                        @endphp
                        @if ($previousMonthClosingBalance > 0)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($first_date)) }}</td>
                                <td>Opening Balance</td>
                                <td></td>
                                <td></td>
                                <td>{{ $previousMonthClosingBalance }}</td>
                                @php $total_income += $previousMonthClosingBalance @endphp
                                @php $total += $previousMonthClosingBalance @endphp
                            </tr>
                        @endif
                        @if ($income)
                            @foreach ($income as $v_income)
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($v_income->date)) }}</td>
                                    <td> {{$v_income->remarks}} </td>
                                    <td>{{ $v_income->amount }}</td>
                                    @php $total_income += $v_income->amount @endphp
                                    @php $total += $v_income->amount @endphp
                                    <td>{{$v_income->invoice_no}}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $total_income }}</td>
                                </tr>
                            
                            @endforeach
                        @endif
                        @if ($expense)
                            @foreach ($expense as $v_expense)
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($v_expense->date)) }}</td>
                                    <td>{{ $v_expense->remarks }}</td>
                                    <td></td>
                                    <td></td>
                                    @php $total_expense += $v_expense->amount @endphp
                                    @php $total -= $v_expense->amount @endphp
                                    <td>{{ $v_expense->amount }}</td>
                                    <td>{{ $v_expense->invoice_no }}</td>
                                    <td>{{ $total }}</td>
                                </tr>
                            @endforeach
                        @endif
                        
                        @php $total = $total_income -  $total_expense; @endphp

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-sm-8">
                <table class="table table-bordered mt-5">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-end text-black" style="text-align: end">Total Income</th>
                            <th class="text-end text-black" style="text-align: end">{{ $total_income }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end text-black" style="text-align: end">Total Expense</th>
                            <th class="text-end text-black" style="text-align: end">{{ $total_expense }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end text-black" style="text-align: end">Total Profit</th>
                            <th class="text-end text-black" style="text-align: end">{{ $total }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
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
