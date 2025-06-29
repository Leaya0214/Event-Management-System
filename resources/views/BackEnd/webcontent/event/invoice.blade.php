<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>
<style>
  h4 {
    margin: 0;
}
.w-full {
    width: 100%;
}
.w-half {
    width: 50%;
}
.line{
  width: 100%;
  margin-top: 15px;
  border-bottom: 10px;
  background: #000000;
  color: black;
}
.margin-top {
    margin-top: 1.25rem;
}
.footer {
    font-size: 0.875rem;
    padding: 1rem;
    background-color: rgb(241 245 249);
}
table {
    width: 100%;
    border-spacing: 0;
}
table.products {
    font-size: 0.875rem;
}
table.products tr {
    /* background-color: rgb(96 165 250); */
}
table.products th {
    color: #ffffff;
    padding: 0.5rem;
}
table tr.items {
    background-color: rgb(241 245 249);
}
table tr.items td {
    padding: 0.5rem;
}
.invoice-items {
      border-collapse: collapse;
      width: 100%;
    }
    
    .invoice-items th, .invoice-items td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    
    .invoice-items th {
      background-color: #f2f2f2;
    }
.total {
    text-align: right;
    margin-top: 1rem;
    font-size: 0.875rem;
}
</style>
<body>
  @php $payment =  App\Models\BackEnd\PayMentModel::where('event_id',$event->id)->first(); @endphp
  @php $system =  App\Models\BackEnd\SystemSetting::first(); @endphp
    <table class="w-full">
        <tr>
          <td style="padding-right:8px;"> <img src="{{ asset('backend/system_setting/' . $system->logo) }}" alt="logo" width="60"></td>
            <td class="w-half" style="padding-right:30px; paddint-top:10px;">
              <strong style="font-size:13px">Address: {{$system->office_address}}</strong><br>
              <strong style="font-size:13px">Mobile: {{$system->phone}}</strong>
            </td>

            <td class="w-half" style="padding-left:50px" >
              <br>
                <strong style="font-size:13px">Booking ID: {{$event->booking_id}}</strong><br>
                <strong style="font-size:13px">Invoice ID: {{$payment->invoice}}</strong><br>
                <strong style="font-size:13px">Invoice Issue Date: {{date('d/m/Y')}}</strong>
            </td>
        </tr>
    </table>
    <div class="line"></div>
    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half" style="width: 40%">
                    <div><strong>Bill To:</strong></div>
                    <div><p style="font-size:15px">Name  : {{$event->client->name}}</p>
                    <p style="font-size:15px">Email : {{$event->client->email}}</p>
                    <p style="font-size:15px">Mobile :{{$event->client->primary_no}}</p>
                    <p style="font-size:15px">Address :{{$event->client->address}}</p></div>
                </td>
                <td style="width: 25%">
                 
                </td>
                <td class="w-half" style="width: 35%">
                    <div><strong>Bill From:</strong></div>
                    <div><p style="font-size:15px">Name  : Bridal Harmony</p>
                    <p style="font-size:15px">Email :{{$system->email}}</p>
                    <p style="font-size:15px">Mobile :{{$system->phone}}</p>
                    <p style="font-size:15px">Address :{{$system->office_address}}</p></div>
                </td>
            </tr>
        </table>
    </div>
 
    <div class="margin-top">
        <table class="invoice-items">
          <thead>
            <tr>
              <th>Event Date</th>
              <th>Event Venue</th>
              <th>Event Time</th>
              <th>Package</th>
              <th>Package Details</th>
              <th>Package Price</th>
            </tr>
          </thead>
          <tbody>
              @php $details = App\Models\BackEnd\EventDetails::where('master_id', $event->id)->get(); @endphp
              @if($details)
                  @foreach($details as $detail)
                      <tr style="font-size: 13px">
                          <td>{{date('d/m/Y',strtotime($detail->date))}}</td>
                          <td>{{$detail->venue}}</td>
                          <td>{{date('g:i a',strtotime($detail->start_time)).' - '.date('g:i a',strtotime($detail->end_time))}}</td>
                          <td>{{$detail->category->category_name}}</td>
                          <td>{{$detail->package->name}}</td>
                          <td>{{$detail->package_price ? $detail->package_price : $detail->package->discount}}</td>
                      </tr>
                  @endforeach
              @endif
          </tbody>
         
           
        </table>
    </div>
 
    <div class="total">
      <p><strong>Total:</strong> {{$payment->payment_amount}}TK</p>
      <p><strong>Paid:</strong> {{$payment->advance}}TK</p>
      <p><strong>Total Due:</strong> {{$payment->due_amount}}TK</p>
    </div>
 
    <div class="footer margin-top">
        <div>Thank you</div>
        <div>&copy; Bridal Harmony</div>
    </div>
</body>
</html>