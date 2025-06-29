<?php

namespace App\Http\Controllers\FrontEnd;

use PDF;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BackEnd\Client;
use App\Models\BackEnd\Package;
use App\Models\BackEnd\Paymentlog;
use Yoeunes\Toastr\Facades\Toastr;
use App\Models\BackEnd\EventMaster;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\EventDetails;
use App\Models\BackEnd\PayMentModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function booking_data_store(Request $request)
    {
        try {
            // return $request->all()
            $password = Str::substr($request->primary_no, -6);

            $client_data = [
                'name' => $request->client_name,
                'email' => $request->email,
                'address' => $request->address,
                'primary_no' => $request->primary_no,
                'alternate_no' => $request->alternate_no,
                'password' => $password,
                'status' => 1,
            ];

            $old_client = Client::where('email', $request->email)->first();
            if($old_client){
                $client_id = $old_client->id;
            }else{
                $client = Client::create($client_data);
                $client_id = $client->id;
            }


            $date =  date("Y");
            $lastBooking = EventMaster::orderByDesc('id')->first();
            $booking_id = "BRHE-". $date.'1';
            if($lastBooking){
                $booking_id = "BRHE-". $date. ($lastBooking->id + 1);
            }
            
            $event_data = [
                'client_id' => $client_id,
                'booking_id' =>$booking_id ,
                'total_event' => $request->total_event,
                'bride_name' => $request->bride_name,
                'groom_name' => $request->groom_name,
                'instructions' => $request->instructions,
            ];

            $event = EventMaster::create($event_data);

            $totalEvents = $request->input('total_event');
            $detail_array = [];

            for ($i = 0; $i < $totalEvents; $i++) {
                $event_detail = new EventDetails;
                $event_detail->master_id = $event->id;
                $event_detail->date = $request->input('date')[$i];
                $event_detail->shift_id = $request->input('shift_id')[$i];
                $event_detail->start_time = $request->input('start_time')[$i];
                $event_detail->end_time = $request->input('end_time')[$i];
                $event_detail->type_id = $request->input('type_id')[$i];
                $event_detail->district_id = $request->input('district_id')[$i];
                $event_detail->venue = $request->input('venue')[$i];
                $event_detail->category_id = $request->input('category_id')[$i];
                $event_detail->package_id = $request->input('package_id')[$i];
                $package_m = Package::find($request->input('package_id')[$i]);
                $event_detail->package_price = $package_m->discount;
                $detail_array[] = $event_detail;
                $event_detail->save();
            }
            $payment_data = [
                'event_id' => $event->id,
                'client_id' => $client_id,
                'payment_amount' => $request->payment_amount,
                'advance' => $request->advance,
                'due_amount' => $request->due_amount,
                'invoice' => 'INV 2024' . $event->id,
                'currency' => 'Tk'
            ];
            
             $message_body = "Dear Sir, Your Booking is confirmed. Booking ID - " . $event->booking_id . ". You have booked the following events:\n";

                foreach($detail_array as $detail) {
                    $message_body .= "- " . $detail->type->type_name . ", Event Date: " . date('d/m/Y', strtotime($detail->date)) . "\n";
                }
            $message_body .= "Thank you!";
            send_sms($request->primary_no,$message_body);  


            $payment = PayMentModel::create($payment_data);

            $payment_log = [
                'payment_id' => $payment->id,
                'payment_date' =>$request->payment_date,
                'amount' => $request->advance,
                'payment_method' =>  $request->payment_method,
                'transaction_id' =>$request->transaction_id ? $request->transaction_id : $request->account_number,
            ];
            
            $log = Paymentlog::create($payment_log);

            $data['email'] = $request->email;
            $data['booking_id'] = $event->booking_id;
            $data['event'] = $event;
            $data['paymnetlog'] = $log;
            $data['randomNumber'] = rand(0, 999999);
            $data['paymnent'] = $payment;
            $data['title'] = 'Payment Slip';
            $pdf = PDF::loadView('BackEnd.webcontent.event.payment_slip', $data);

            Mail::send('payment_slip', $data, function($message)use($data, $pdf) {
                $message->to($data["email"], $data["email"])
                        ->subject($data["title"])
                        ->attachData($pdf->output(),"payslip.pdf");
            });        
            Toastr::success('Successfully Added');
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        } // return $request->all();

    }

    public function filterPackage(Request $request)
    {   
        $district_id = $request->district;
        $category_id = $request->category_id;
        if($district_id == 2){
            $packages = Package::where('package_category_id', $category_id)->where('package_branch_id',3)->get();
        }else{
            $packages = Package::where('package_category_id', $category_id)->where('package_branch_id',2)->get();
        }
        if (count($packages) > 0) {
            return response()->json($packages);
        }
    }

    public function packageDetails(Request $request)
    {
        $package_id = $request->package_id;
        $package = Package::where('id', $package_id)->first();
        // dd($package);
        return response()->json($package);

    }
}
