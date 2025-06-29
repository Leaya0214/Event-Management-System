<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\BackEnd\Paymentlog;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\PayMentModel;
use App\Models\BackEnd\StaffPayment;
use App\Models\BackEnd\EventDetailsLog;
use App\Models\BackEnd\EventMaster;
use App\Models\BackEnd\EventwisePayment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use PDF;


class PaymentController extends Controller
{
    public function clientPayment(){
      if (!check_access("clientpayment.list")) {
        Toastr::error("You don't have permission!");
        return redirect()->route('admin.index');
      }
      $payments = PayMentModel::all();

      return view('BackEnd.webcontent.payment.client_payment_list',compact('payments'));
    }
    public function getClientPayment(Request $request){

        if (!check_access("clientpayment.list")) {
          Toastr::error("You don't have permission!");
          return redirect()->route('admin.index');
      }

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $query = PayMentModel::query();

        if ($fromDate && $toDate) {
          $query->whereBetween('created_at', [$fromDate, $toDate]);
        }

        if ($fromDate && $toDate) {
          $query->whereBetween('created_at', [$fromDate, $toDate]);
        }
          $totalPayment = $query->sum('payment_amount');
          $totalAmount  = $query->sum('advance');
          $totalDue     = $query->sum('due_amount');

        $payments = $query->orderByDesc('id')->get();
        
        return DataTables::of($payments)
        ->with([
          'totalPayment' => $totalPayment,
          'totalAmount'  => $totalAmount,
          'totalDue'     => $totalDue,
        ])
        ->addIndexColumn()
        ->setRowId(function($payment){return $payment->id;})
        ->setRowAttr([
            'align' => 'center',
        ])
        ->addColumn('inv',function($payment){
            $invoice = $payment->invoice;
            return $invoice;
        })
        ->addColumn('booking_id',function($payment){
          $booking_id = '';
          $event = EventMaster::where('id',$payment->event_id)->first();
          if($payment->event_id && $event){
            $booking_id = $payment->event_master->booking_id ? $payment->event_master->booking_id : $payment->client->name ;
          }
          return $booking_id;
        })
        ->addColumn('client',function($payment){
          $client_name = $payment->client->name ?$payment->client->name:'' ;
          return $client_name;
        })
        ->addColumn('payment',function($payment){
          $payment = $payment->payment_amount;
          return $payment;
        })
        ->addColumn('advance',function($payment){
          $advance = $payment->advance;
          return $advance;
        })
        ->addColumn('due',function($payment){
          $due = $payment->due_amount;
          return $due;
        })
        ->addColumn('action', function ($payment) {
          $view ='<a href=""  data-bs-toggle="modal" 
              data-bs-target=".view_modal-'.$payment->id.'" style="padding:2px; margin-left:3px; color:white"
              class="btn btn-xs btn-info btn-sm mr-1">
              <svg  width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
              </a>';

            $edit = '<a href="'.route('client.payment.edit',$payment->id).'" style="padding:2px; margin-left:3px"
                    class="btn btn-xs btn-primary btn-sm mr-1">
                    <svg width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </a>';

            $delete = '<a href=""
                onclick="return confirm("Are you sure you want to delete?");"
                style="padding: 2px; margin-left:3px;" class="delete btn btn-xs btn-danger btn-sm mr-1"><svg
                width="16" height="14" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="feather feather-trash-2">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path
                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                </path>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
                </svg></a>';

            return $view .$edit . $delete ;
        })

        ->rawColumns(['inv','booking_id','client','payment','advance','due','action'])
        ->make(true);
    }

    
    public function editClientPayment(Request $request, $id){
      if (!check_access("clientpayment.edit")) {
        Toastr::error("You don't have permission!");
        return redirect()->route('admin.index');
    }
      $payments = Paymentlog::where('payment_id',$id)->get();
      return view('BackEnd.webcontent.payment.edit_client_payment',compact('payments','id'));
      
    }

    public function paymentUpdate(Request $request, $id){
      // return $request->all();
     $paymentMaster = PayMentModel::find($id);
     $payment_log_id = count($request->input('payment_log_id'));
    //  dd($payment_log_id);
     $total_advance = 0;
     for($i=0; $i<$payment_log_id; $i++){
        $payment = Paymentlog::where('id',$request->payment_log_id[$i])->first();
        $data = [
          'payment_date' =>$request->date[$i],
          'amount' =>$request->amount[$i],
          'payment_method' =>$request->method[$i],
          'transaction_id' =>$request->trans_id[$i],
        ];
        $total_advance += $request->amount[$i];
        $payment->update($data);
     }
     $paymentMaster->update([
      'advance' => $total_advance
     ]);
     Toastr::success('Payment Data Updated');
     return redirect()->back();
    }

    //========================== StaffPayment Functions ===============================//
    public function staffPayment(){
      if (!check_access("stuffpayment.list")) {
        Toastr::error("You don't have permission!");
        return redirect()->route('admin.index');
    }
      $events = EventwisePayment::all();
      return view('BackEnd.webcontent.payment.staff_payment_list',compact('events'));
    }



    public function getStaffPayment(Request $request){
      if (!check_access("stuffpayment.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        
        $query = EventwisePayment::query()->with('user');

        $query_2 = StaffPayment::query();
        
        $query_3 = EventwisePayment::query();
        
        if ($fromDate && $toDate) {
            $query->whereBetween('payment_date', [$fromDate, $toDate]);
            $query_2->whereBetween('payment_date', [$fromDate, $toDate]);
            // $query_3->whereBetween('payment_date', [$fromDate, $toDate]);
        }
        
        $payments = $query_3->select('event_wise_payments.*', 'event_details.id as e_id')
                            ->join('event_details', 'event_details.id', '=', 'event_wise_payments.event_details_id')
                            ->whereNotNull('event_wise_payments.event_details_id')
                            ->whereBetween('event_details.date', [$fromDate, $toDate])
                            ->whereNotNull('event_details.id')
                            ->get();
        
        $total_payment = $query->sum('payment_amount');
        $total_paid = $query_2->sum('paid');
        $total_amount = $payments->sum('payment_amount');
        $total_due = ($total_amount - $total_paid);
        
        
        
       if ($fromDate != null && $toDate != null) {
            $details = EventwisePayment::select('event_wise_payments.*', 'event_details.id as e_id')
                        ->join('event_details', 'event_wise_payments.event_details_id', '=', 'event_details.id')
                        ->join('event_masters', 'event_details.master_id', '=', 'event_masters.id')
                        ->whereNotNull('event_wise_payments.event_details_id')
                        ->whereNotNull('event_details.id')
                        ->whereNotNull('event_masters.id')
                        ->whereBetween('event_details.date', [$fromDate, $toDate])
                        ->get()
                        ->groupBy('user_id');
        } else {
            $details = EventwisePayment::select('event_wise_payments.*', 'event_details.id as e_id')
                ->join('event_details', 'event_wise_payments.event_details_id', '=', 'event_details.id')
                ->join('event_masters', 'event_details.master_id', '=', 'event_masters.id')
                ->whereNotNull('event_wise_payments.event_details_id')
                ->whereNotNull('event_details.id')
                ->whereNotNull('event_masters.id')
                ->get()
                ->groupBy('user_id');
        }
       
    //   dd($details);

        
        $total_payment = $query->sum('payment_amount');
        $total_paid = $query_2->sum('paid');
        $total_amount = $payments->sum('payment_amount');
        $total_due = ($total_amount - $total_paid);

    return DataTables::of($details)
        ->with([
            'totalPayment' => $total_payment,
            'totalAmount' => $total_paid,
            'totalDue' => $total_due,
        ])
        ->addIndexColumn()
        ->setRowAttr([
            'align' => 'center',
        ])
        ->addColumn('staff', function ($detail) {
            return $detail->first()->user->name ?? ''; // Assuming each detail will have the same user.
        })
        ->addColumn('total_event', function ($detail) use ($fromDate, $toDate) {
          if ($fromDate != null && $toDate != null) {
            $uniqueEvents = $detail->unique('event_details_id');
            $total_event = $uniqueEvents->count();
         } else{
            $total_event = count($detail);
          }
           return $total_event;
        })
       ->addColumn('total_payment', function ($detail) use ($fromDate, $toDate) {
            if ($fromDate != null && $toDate != null) {
                $total_payment = EventwisePayment::join('event_details', 'event_wise_payments.event_details_id', '=', 'event_details.id')
                    ->where('event_wise_payments.user_id', $detail->first()->user_id)
                    ->whereBetween('event_details.date', [$fromDate, $toDate])
                    ->sum('event_wise_payments.payment_amount');
            } else {
                $total_payment = $detail->sum('payment_amount');
            }
            return $total_payment;
        })
        
        ->addColumn('total_paid', function ($detail) use ($fromDate, $toDate) {
            if ($fromDate != null && $toDate != null) {
                $total_paid = StaffPayment::where('user_id', $detail->first()->user_id)->whereBetween('payment_date', [$fromDate, $toDate])
                    ->sum('paid');
            } else {
                $total_paid = StaffPayment::where('user_id', $detail->first()->user_id)->sum('paid');
            }
            return $total_paid;
        })
        
        ->addColumn('total_due', function ($detail) use ($fromDate, $toDate) {
            if ($fromDate != null && $toDate != null) {
                $total_payment = EventwisePayment::join('event_details', 'event_wise_payments.event_details_id', '=', 'event_details.id')
                    ->where('event_wise_payments.user_id', $detail->first()->user_id)
                    ->whereBetween('event_details.date', [$fromDate, $toDate])
                    ->sum('event_wise_payments.payment_amount');
        
                $total_paid = StaffPayment::where('user_id', $detail->first()->user_id)
                    ->whereBetween('payment_date', [$fromDate, $toDate])
                    ->sum('paid');
            } else {
                $total_payment = $detail->sum('payment_amount');
                $total_paid = StaffPayment::where('user_id', $detail->first()->user_id)->sum('paid');
            }
        
            $total_due = $total_payment - $total_paid;
            return $total_due;
        })
        ->addColumn('action',function ($detail) {
            foreach($detail as $v_detail){
              $view = ' <a href="" data-bs-toggle="modal" 
                data-bs-target=".view_modal-'.$v_detail->user_id.'" style="padding:2px; margin-left:3px; color:white"
                class="btn btn-xs btn-info  mr-1">
                <svg  width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </a>';
              $edit = '<a href="'.route('staff.payment.create',$v_detail->user_id).'" style="padding:3px; margin-left:3px"
                class="btn btn-xs btn-primary  mr-1">
                <i class="fa fa-plus"></i>              
                </a>';
            }
            return $view.$edit ;
        })
        ->rawColumns(['staff','total_event','total_payment','total_paid','total_due','action'])
        ->make(true);
    }



    public function createStaffPayment($id){
      if (!check_access("stuffpayment.edit")) {
        Toastr::error("You don't have permission!");
        return redirect()->route('admin.index');
      }
      $total_due = 0;
      $final_total = 0;
      $eventwisePayments = EventwisePayment::select('event_wise_payments.*','event_details.id as e_id')->join('event_details','event_details.id','=','event_wise_payments.event_details_id')->whereNotNull('event_wise_payments.event_details_id')->whereNotNull('event_details.id')->where('user_id',$id)->get();
      // $eventwisePayments = EventwisePayment::where('user_id',$id)->get();
      foreach ($eventwisePayments as $event_payment) {
        $total_due += $event_payment->payment_amount;
      }
      $payments = StaffPayment::where('user_id', $id)->get();
      $total_paid = $payments->sum('paid');

      $total_due -= $total_paid;
      return view('BackEnd.webcontent.payment.create_staff_payment',compact('total_due','id'));
    }


    public function storestaffPayment(Request $request){
      // return $request->all();
       $validators = Validator::make($request->all(), [
        'payment_date' => 'required',
        'paid'         => 'required',
        'method' => 'required'
      ]);

    if ($validators->fails()) {
        Toastr::error("Invalid Data given!");
        return redirect()->back()->withErrors($validators)->withInput();
    }
      $total_due = $request->amount - $request->paid;
      // dd($total_due);
      $data = [
        'user_id' => $request->user_id,
        'total_due' => $total_due,
        'paid' =>$request->paid,
        'payment_date' =>$request->payment_date,
        'payment_system' =>$request->method,
        'trans_id' =>$request->trans_id,
      ];
       $user = User::where('id',$request->user_id)->first();
        $pdata['user'] = $user;
        $pdata['email'] = $user->email;
        $pdata['paymnetlog'] =$data;
        $pdata['randomNumber'] = rand(0, 999999);
        $pdata['title'] = 'Payment Slip';
        $pdf = PDF::loadView('BackEnd.webcontent.payment.staff_payment_slip', $pdata);
        Mail::send('staff_payment_slip', $pdata, function($message)use($pdata, $pdf) {
            $message->to($pdata["email"], $pdata["email"])
                    ->subject($pdata["title"])
                    ->attachData($pdf->output(),"payslip.pdf");
        });
      StaffPayment::create($data);
      Toastr::success('Payment Inserted Successfully');
      return redirect()->back();
    }



    public function paymentHistory(){
      if (!check_access("stuffpayment.list")) {
        Toastr::error("You don't have permission!");
        return redirect()->route('admin.index');
      }
      $payments = StaffPayment::all();
      $users = User::where('category','Freelancer')->get();
      return view('BackEnd.webcontent.payment.stuff_payment_history',compact('payments','users'));

  }

  
    public function filterPayment(Request $request){
      if (!check_access("stuffpayment.list")) {
        Toastr::error("You don't have permission!");
        return redirect()->route('admin.index');
      }
      $from_date = $request->from_date;
      $to_date = $request->to_date;
      $user = $request->user;
      $user_info  = User::where('id',$user)->first();
      
      $query      = StaffPayment::where('payment_date','>=',$from_date)->where('payment_date','<=',$to_date)->where('user_id',$user)->get();
      
      $eventInfo  = EventwisePayment::select('event_wise_payments.*', 'event_details.id as e_id')
                        ->join('event_details', 'event_wise_payments.event_details_id', '=', 'event_details.id')
                        ->join('event_masters', 'event_details.master_id', '=', 'event_masters.id')
                        ->whereNotNull('event_wise_payments.event_details_id')
                        ->whereNotNull('event_details.id')
                        ->whereNotNull('event_masters.id')
                        ->whereBetween('event_details.date', [$from_date, $to_date])
                        ->where('user_id',$user)->get();
                        
      return view('BackEnd.webcontent.payment.filter_stuff_payment',compact('query','to_date','eventInfo','user_info','from_date','to_date'));
  }

}
