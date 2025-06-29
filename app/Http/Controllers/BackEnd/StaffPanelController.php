<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\EventDetailsLog;
use App\Models\BackEnd\StaffPayment;
use App\Models\BackEnd\EventwisePayment;
use Yajra\DataTables\Facades\DataTables;
use App\Models\BackEnd\PhotographerExperience;
use Yoeunes\Toastr\Facades\Toastr;



class StaffPanelController extends Controller
{
    public function events(){
        if(auth()->check()){
            $user_id = auth()->user()->id;
             $events = EventDetailsLog::select('event_details_pivot.*')
                    ->join('event_details', 'event_details_pivot.event_details_id', '=', 'event_details.id')
                    ->join('event_masters', 'event_details.master_id', '=', 'event_masters.id')
                    ->where('event_details_pivot.assigned_user_id', $user_id)
                    ->whereNotNull('event_details_pivot.event_details_id')
                    ->whereNotNull('event_details.id')
                    ->whereNotNull('event_masters.id')
                    ->get();
            return view('BackEnd.stuffPanel.event',compact('events'));
        }else{
            return redirect()->route('admin.login');
        }
       
    }
   public function getStaffEvent(){
        if(auth()->check()){
            $user_id = auth()->user()->id;
            $events = EventDetailsLog::select('event_details_pivot.*')
                    ->join('event_details', 'event_details_pivot.event_details_id', '=', 'event_details.id')
                    ->join('event_masters', 'event_details.master_id', '=', 'event_masters.id')
                    ->where('event_details_pivot.assigned_user_id', $user_id)
                    ->whereNotNull('event_details_pivot.event_details_id')
                    ->whereNotNull('event_details.id')
                    ->whereNotNull('event_masters.id')
                    ->get();
                    
            return DataTables::of($events)
            ->addIndexColumn()
            ->setRowId(function($event){return $event->id;})
            ->setRowAttr([
                'align' => 'center',
            ])
            ->addColumn('booking_id',function($event){
                $booking_id = '';
                $booking_id .= '<b>Booking Id</b> :'. $event->eventDetail->event->booking_id.'<br>';
                $booking_id .= '<b>Bride Name</b> :'. $event->eventDetail->event->bride_name.'<br>';;
                $booking_id .= '<b>Groom Name</b> :'. $event->eventDetail->event->groom_name.'<br>';;
                return $booking_id;
            })
            ->addColumn('date',function($event){
                $info = '';
                $info .= '<b>Date</b> : '. $event->eventDetail->date.'<br>';
                $info .= '<b>Shift</b> :'.$event->eventDetail->shift->shift_name.'<br>';
                $info  .= '<b>Time</b> :' .date('g:i a',strtotime($event->start_time)).' - '.date('g:i a',strtotime($event->end_time)).'<br>';
                return $info;
            })
            ->addColumn('district',function($event){
                $district = $event->eventDetail->district->district;
                return $district;
            })
            ->addColumn('assign_user',function($event){
                $assigned_phototographer = [];
                $html = '';
                $user_info = EventDetailsLog::where('event_details_id',$event->event_details_id)->get();
                foreach($user_info as $info){
                    $assigned_phototographer [] = $info->user->name.'-'. 
                    ($info->status == 1 ? 'Photographer' : 
                    ($info->status == 2 ? 'Cinematographer' :
                    ($info->status == 3 ? 'Photo Editor' :
                    ($info->status == 4 ? 'Cine Editor' : 'Other'))));;
                }
                if($assigned_phototographer){
                    $html = '<div>'.implode('<br>', $assigned_phototographer).'<br><br>'.'</div>';
                }
                return $html;
            })
            ->addColumn('venue',function($event){
                $venue = $event->eventDetail->venue;
                return $venue;
            })
             ->addColumn('action',function($event){
                $view = ' <a href=""  data-bs-toggle="modal" 
                data-bs-target=".view_modal-' . $event->id . '" style="padding:2px; margin-left:3px; color:white"
                class="btn btn-xs btn-info btn-sm mr-1">
                Share Experience
                </a>';
                
                $view2 = ' <a href=""  data-bs-toggle="modal" 
                data-bs-target=".viewExperience-' . $event->id . '" style="padding:2px; margin-left:3px; color:white"
                class="btn btn-xs btn-primary btn-sm mr-1">
                View Experience
                </a>';

                // if(auth()->user()->hasRole('Photo Editor') || auth()->user()->hasRole('Video Editor')){
                    $view3 = '<a href=""  data-bs-toggle="modal" 
                    data-bs-target=".selections-' . $event->id . '" style="padding:2px; margin-left:3px; color:white"
                    class="btn btn-xs btn-info btn-sm mr-1">
                    Client Selections
                    </a>';
                // }

                $view4 = ' <a href=""  data-bs-toggle="modal" 
                    data-bs-target=".viewDetail-' . $event->id . '" style="padding:2px; margin-left:3px; color:white"
                    class="btn btn-xs btn-primary btn-sm mr-1">
                    View Event Info
                </a>';
                return $view.$view2.$view3.$view4;
            })
        
        
            ->rawColumns(['booking_id','date','event_shift','time','district','venue','assign_user','action'])
            ->make(true);
        }else{
            return redirect()->route('admin.login');
        }
       
    }

    public function paymentHistory(){
        if(auth()->check()){
            $payments      = EventwisePayment::select('event_wise_payments.*')
                            ->join('event_details', 'event_wise_payments.event_details_id', '=', 'event_details.id')
                            ->join('event_masters', 'event_details.master_id', '=', 'event_masters.id')
                            ->where('event_wise_payments.user_id', auth()->user()->id)
                            ->whereNotNull('event_wise_payments.event_details_id')
                            ->whereNotNull('event_masters.id')
                            ->get();
            $total_payment = StaffPayment::where('user_id',auth()->user()->id)->first();
            return view('BackEnd.stuffPanel.payment',compact('payments','total_payment'));
        }else{
            return redirect()->route('admin.login');
        }
    }
    
   public function getPaymentInfo(){
        $payments = EventwisePayment::select('event_wise_payments.*')
                    ->join('event_details', 'event_wise_payments.event_details_id', '=', 'event_details.id')
                    ->join('event_masters', 'event_details.master_id', '=', 'event_masters.id')
                    ->where('event_wise_payments.user_id', auth()->user()->id)
                    ->whereNotNull('event_wise_payments.event_details_id')
                    ->whereNotNull('event_masters.id')
                    ->get();
        return DataTables::of($payments)
        ->addIndexColumn()
        ->setRowId(function($payment){return $payment->id;})
        ->setRowAttr([
            'align' => 'center',
        ])
        ->addColumn('booking_id',function($payment){
            $booking_id = $payment->event_details->event->booking_id;
            return $booking_id;
        })
        ->addColumn('date',function($payment){
            $date = $payment->event_details->date;
            return $date;
        })
        ->addColumn('shift',function($payment){
            $shift =  $payment->event_details->shift->shift_name;
            return $shift;
        })
        ->addColumn('payment_amount',function($payment){
            $amount = $payment->payment_amount;
            return $amount;
        })
        ->rawColumns(['booking_id','date','shift','payment_amount'])
        ->make(true);
    }
      public function getPaymentHistory(){
        $payments = StaffPayment::where('user_id',auth()->user()->id)->get();
        return DataTables::of($payments)
        ->addIndexColumn()
        ->setRowId(function($payment){return $payment->id;})
        ->setRowAttr([
            'align' => 'center',
        ])
        ->addColumn('payment_date',function($payment){
            $payment_date = $payment->payment_date;
            return $payment_date;
        })
        ->addColumn('paid',function($payment){
            $paid = $payment->paid;
            return $paid;
        })
        ->addColumn('payment_system',function($payment){
            $system =  $payment->payment_system;
            return $system;
        })
        ->addColumn('trans_id',function($payment){
            $trans_id = $payment->trans_id;
            return $trans_id;
        })
        ->rawColumns(['payment_date','paid','payment_system','trans_id'])
        ->make(true);
    }
    
    public function shareExperience(Request $request){
        $data = new PhotographerExperience;
        $data->event_detail_id = $request->event_detail_id;
        $data->user_id = auth()->user()->id ;
        $data->experience = $request->experience;
        $data->date = date('d/m/Y');
        $data->save();
        Toastr::success("Experience Shared Successfully.");
        return redirect()->back();
    }

}
