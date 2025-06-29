

{{-- <style>
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
        font-size:18px;
    }

</style> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expense List</title>
    <link rel="stylesheet" href="{{asset('backend')}}/css/bootstrap.min.css">
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
    }

    table { page-break-inside:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
    thead { display:table-header-group }
    tfoot { display:table-footer-group }
</style>

<style>
    
</style>
</head>
<body>
    <div class="row text-center">
        <div class="col-sm-12">
            <h2 style=""><strong> Bridal Harmony</strong></h2>
            <h3 style="margin-top:10px"><strong> Exdpense List </strong></h3>
            <h6 style="margin-top:10px">@if($from_date && $to_date){{date('d/m/Y',strtotime($from_date))}} - {{date('d/m/Y',strtotime($to_date))}} @endif</h6>
        </div>
    </div>
        <div class="row mt-3">
            <div class="col-sm-12">
                <table class="table table-bordered">
                    <thead class="">
                        <tr>
                                <th>Invoice No</th>
                                <th>Expense Date</th>
                                <th>Amount</th>
                                <th>Category</th>
                                <th>Expense Details</th>
                                <th>Payment Type</th>
                                <th>Transaction ID</th>
                                <th>Account No</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $l = 0 ; $total = 0; @endphp
                     @foreach($expense_data as $v_expense)
                        <tr>
                            {{-- <td>{{++$l}}</td> --}}
                            <td>{{$v_expense->invoice_no}}</td>
                            <td>{{date('d/m/Y',strtotime($v_expense->date))}}</td>
                            <td>{{$v_expense->amount}}</td>
                            <td>{{$v_expense->category->name}}</td>
                            <td>{{$v_expense->remarks}}</td>
                            <td>{{$v_expense->payment_type}}</td>
                            <td>{{$v_expense->transaction_id}}</td>
                            <td>{{$v_expense->account_no}}</td>
                        </tr>
                        @php $total += $v_expense->amount  @endphp
                     @endforeach
                     <tr>
                        <th colspan="2">Total</th>
                        <th>{{$total}}</th>
                     </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    
<script>
    window.addEventListener("load", window.print());
    window.onafterprint = window.close;
  </script>
</body>
</html>



