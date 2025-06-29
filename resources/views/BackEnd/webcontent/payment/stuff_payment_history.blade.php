@extends('BackEnd.master')

@section('content')
    <style>
        .child-table {
            width: 100%;
            border-collapse: collapse;
        }

        .child-table tbody tr td {
            padding-top: 0px !important;
            padding-bottom: 5px;
            padding-left: 20px;
            border-bottom: 1px solid #d9d6d6;
        }
        .btn-table tbody tr td {
            padding-top: 3px !important;
            padding-bottom: 0 !important;
            padding-left: 10px;
            border: none !important;
            /* border-bottom: 1px solid #d9d6d6; */
        }

        .main-table tbody tr td,
        .main-table thead tr th {
            padding: 0.85rem 0.85rem;
            text-align: left;
        }

        @media (min-width:1400px) {
            table td {
                /* padding-left: 0px ; */

            }

            .table> :not(caption)>*>*,
            .datepicker table> :not(caption)>*>* {
                padding: 0px;
            }
        }

        .hide {
            display: none;
        }
        ::placeholder {
            color: red;
            opacity: 1; /* Firefox */
        }

        ::-ms-input-placeholder { /* Edge 12-18 */
        color: red;
        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

    <div class="container">
        <h4 class="mb-4">Filter Staff Payment Data</h4>
        <div class="row">
            <label for="" class="col-sm-2 form-label">From Date</label>
            <label for="" class="col-sm-1 form-label">:</label>
            <div class="col-md-3">
                <input type="date"  class="form-control" id="from_date" placeholder="Enter From Date" value="{{date('Y-m-d')}}">
            </div>
            <label for="" class="col-sm-2 form-label">To Date</label>
            <label for="" class="col-sm-1 form-label">:</label>
            <div class="col-md-3">
                <input type="date" class="form-control" id="to_date" placeholder="Enter From Date" value="{{date('Y-m-d')}}">
            </div>
            <label for="" class="col-sm-2 mt-3 form-label">Staff</label>
            <label for="" class="col-sm-1 mt-3  orm-label">:</label>
            <div class="col-md-3 mt-3">
                <select name="" id="user_id" class="form-select">
                    <option value="all">Select User</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 mt-3">
                <button type="button" class="btn btn-success" onclick="filterPayment();"><i class="fa-solid fa-magnifying-glass-plus"></i></button>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12" id="show">
                <table class="table table-bordered main-table" data-table="true" id="eventTable">
                    <thead>
                        <tr>
                            <th>Stuff Name</th>
                            <th>Paid</th>
                            <th>Payment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{$payment->user->name}}</td>
                                <td>{{$payment->paid}}</td>
                                <td>{{$payment->payment_date}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection

    @section('js')
        <script>
            function filterPayment(){
                var from_date = document.getElementById('from_date').value;
                var to_date = document.getElementById('to_date').value;
                var user = document.getElementById('user_id').value;
                var loading = "<img src='{{asset('frontend/images/loading.gif')}}'>";
		        $("#show").html();
                var urldata = "{{route('payment.filter')}}";
                $.ajax({
                    type: "GET",
                    url: urldata,
                    data: {from_date,to_date,user},
                    success: function (data) {
                        console.log(data);
                        $("#show").html(data);
                    }
                });
            }
        </script>
    @endsection