<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PaySlip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            width: 150px;
        }

        .details {
            margin-bottom: 20px;
        }
        .details table {
            width: 100%;
            border-collapse: collapse;
        }
        .details th, .details td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        .total {
            text-align: right;
        }
        .info table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info td {
            padding: 8px;
            font-size: 14px;
            /* border-bottom: 1px solid #ddd; */
        }
        .info td:first-child {
            width: 15%;
        }
        .info td:nth-child(1) {
            width: 30%;
        }
        .info td:nth-child(2) {
            width: 20%;
        }
        .info td:last-child {
            width: 20%;
        }
    </style>
</head>
<body>
    @php $payment =  App\Models\BackEnd\PayMentModel::where('event_id',$event->id)->first(); @endphp
    @php $system =  App\Models\BackEnd\SystemSetting::first(); @endphp
    <div class="container">
        <div class="header">
            <img src="{{ asset('backend/system_setting/' . $system->logo) }}" alt="Company Logo"  width="100">
            <h3>PaySlip</h3>
            <strong class="font-size:15px">Bridal Harmony</strong><br>
            {{$system->phone}}<br>
            {{$system->email}}<br>
            {{$system->office_address}}
        </div>
        ****************************************************************************************************
        <div class="info">
            <table>
                <tr>
                    <td>Date of Payment:</td>
                    <td>{{$paymnetlog->payment_date}}</td>
                    <td>Client Name:</td>
                    <td>{{$event->client->name}}</td>
                </tr>

                <tr>
                    <td>Booking ID:</td>
                    <td>{{$event->booking_id}}</td>
                    <td>Invoice No:</td>
                    <td>{{$paymnent->invoice}}</td>
                </tr>

            </table>
        </div>
        ****************************************************************************************************
        <div class="details">
            <table>
                <tr>
                    <th>Payment Date</th>
                    <th>Amount</th>
                    <th>Payment System</th>
                    <th>Transaction ID</th>
                </tr>
                <tr style="font-size:13px">
                    <td>{{$paymnetlog->payment_date}}</td>
                    <td>{{$paymnetlog->amount}}</td>
                    <td>{{$paymnetlog->payment_method}}</td>
                    <td>{{$paymnetlog->transaction_id}}</td>
                </tr>
            </table>
        </div>
        <div class="total">
            <p><strong>Total Payment:</strong> {{$paymnent->payment_amount}}TK</p>
            <p><strong>Today Paid:</strong> {{$paymnetlog->amount}}TK</p>
            <p><strong>Total Paid:</strong> {{$paymnent->advance}}TK</p>
            <p><strong>Total Due:</strong> {{$paymnent->due_amount}}TK</p>
        </div>
    </div>
</body>
</html>
