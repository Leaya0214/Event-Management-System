@extends('BackEnd.master')

@section('content')

    <div class="container mt-4">
        <div class="row mb-2">
            <div class="col-md-8"></div>
            <div class="col-md-2 text-end">
                <a class="btn btn-md btn-primary" href="{{route('expense.add')}}"> <i class="fa fa-plus"></i> Add Expense</a>
            </div>
            <div class="col-md-2 ">
                <a class="btn btn-md btn-success" href="{{route('income.add')}}"> <i class="fa fa-plus"></i> Add Income</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Filter by Date</h4>
                    </div>
                    <div class="card-body">
                       
                        {{-- <form > --}}
                        <div class="form-group mb-3">
                            <label for="fromDate">Payment Type</label>
                            <select name="payment_type" id="payment_type" class="form-control form-select" required>
                                <option value="Cash">Cash</option>
                                <option value="bKash">bkash</option>
                                <option value="Bank">Bank</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fromDate">From Date</label>
                            <input type="date" class="form-control" id="fromDate" name="fromDate" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="toDate">To Date</label>
                            <input type="date" class="form-control" id="toDate" name="toDate" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3" onclick="filterLedger();">Filter</button>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
            <div id="wrapper">

            </div>
            <div class="row">
                @php $date = date('d/m/Y'); @endphp

            </div>

            <div class="col-md-12 mt-5" id="main-card">
                <div class="card">
                    <div class="card-header text-end">
                        <div class="col-md-12 text-right">
                            <button class="mt-2 col-sm-1 btn btn-warning"
                                onClick="document.title = 'Bridal Harmony-Balance Sheet-{{ $date }}'; printDiv('printableArea'); "
                                style="margin-right:100px"> <i class="fa fa-print"></i> Print </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="printableArea">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h3>Daily Ledger</h3>
                                    <h4 class="mt-3">Bridal Harmony</h4>
                                    <h5 class="mt-3">For {{ date('m/d/Y') }}</h5>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">

                                    <table class="table table-bordered" id="main_table">
                                        <thead>
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
                                            @if ($prev_balance)
                                                <tr>
                                                    <td>{{ date('d/m/Y', strtotime(date('Y-m-d'))) }}</td>
                                                    <td>Cash From {{date('d/m/Y',strtotime($formattedPreviousDate))}}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{ $prev_balance }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    
                                                    @php $total_income += $prev_balance @endphp
                                                    @php $total += $prev_balance @endphp
                                                </tr>
                                            @endif
                                            @if ($incomes)
                                                @foreach ($incomes as $v_income)
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
                                            @if ($expenses)
                                                @foreach ($expenses as $v_expense)
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
                                    <table class="table table-bordered mt-3">
                                        <thead>
                                            <tr>
                                                <th colspan="3" class="text-end text-black">Total Income</th>
                                                <th class="text-end text-black">{{ $total_income }}</th>
                                            </tr>
                                            <tr>
                                                <th colspan="3" class="text-end text-black">Total Expense</th>
                                                <th class="text-end text-black">{{ $total_expense }}</th>
                                            </tr>
                                            <tr>
                                                <th colspan="3" class="text-end text-black">Total Profit</th>
                                                <th class="text-end text-black">{{ $total }}</th>
                                            </tr>
                                        </thead>
                                    </table>

                                </div>
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
        function filterLedger() {
            $('#main-card').hide();
            $('.btn-warning').hide();
            var payment_type = document.getElementById('payment_type').value;
            var start_date = document.getElementById('fromDate').value;
            var end_date = document.getElementById('toDate').value;
            var url = "{{ route('report.filter.daily.ledger') }}"

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    payment_type,
                    start_date,
                    end_date
                },
                success: function(data) {
                    $('#wrapper').html(data);
                }
            });
        }
    </script>

    <script>
        function printDiv(divId) {
            var printContents = document.getElementById(divId).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
