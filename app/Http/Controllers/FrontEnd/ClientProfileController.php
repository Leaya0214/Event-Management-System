<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Models\BackEnd\Client;
use App\Mail\ClientSelectionMail;
use Yoeunes\Toastr\Facades\Toastr;
use App\Models\BackEnd\EventMaster;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\EventDetails;
use App\Models\BackEnd\PayMentModel;
use Illuminate\Support\Facades\Mail;
use App\Models\CustomerExperience;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class ClientProfileController extends Controller
{
    public function profile(){
        $clientInfo   = Client::where('id',auth()->guard('client')->user()->id)->first(); 
        $events       = EventMaster::with('details')->where('client_id',auth()->guard('client')->user()->id)->get();
        $payments     = PayMentModel::where('client_id',auth()->guard('client')->user()->id)->paginate(5);
        $event        = EventMaster::select('m.id as event_id','m.client_id','d.id as details_id','d.master_id','d.status','p.*')
                        ->from('event_masters as m')
                        ->where('m.client_id',auth()->guard('client')->user()->id)
                        ->join('event_details as d','d.master_id','=','m.id')
                        ->join('event_details_pivot as p','p.event_details_id','=','d.id')
                        ->whereNotIn('d.status',[0,2])
                        ->get();
        $uniqueDetailsIds = $event->pluck('details_id')->unique();
        return view('FrontEnd.profile.profile',compact('clientInfo','events','payments','uniqueDetailsIds'));
    }

    public function info(){
        $clientInfo = Client::where('id',auth()->guard('client')->user()->id)->first();
        $events = EventMaster::with('details')->where('client_id',auth()->guard('client')->user()->id)->get();
        $total_payment = PayMentModel::where('client_id',auth()->guard('client')->user()->id)->sum('payment_amount');
        return view('FrontEnd.profile.client_info',compact('clientInfo','events','total_payment'));
    }

    public function eventModalforPhoto($id){
        $detail = EventDetails::where('id',$id)->first();
        // dd($detail);
        return view('FrontEnd.profile.event_details',compact('detail'));
    }

    public function storeNotes(Request $requset){
        $detail = $requset->event_id;
        $eventDetail = EventDetails::where('id',$detail)->first();

        if($requset->photo_selection || $requset->video_selection){
            $eventDetail->photo_selection = $requset->photo_selection;
            $eventDetail->video_selection = $requset->video_selection;
            if($eventDetail->selection_date == null){
                $eventDetail->selection_date = date('d/m/Y');
            }
            $eventDetail->update();
        }
         $data = [
            'client_name' => $eventDetail->event->client->name,
            'booking_id' =>  $eventDetail->event->booking_id,
            'event_date' =>  $eventDetail->date,
            'event_type' =>  $eventDetail->type->type_name,
            'venue' =>  $eventDetail->venue,
            'package' =>  $eventDetail->category->category_name,
            'photo_selection' =>  $requset->photo_selection,
            'video_selection' =>  $requset->video_selection,
        ];
        $recipientEmail = 'selection.bridalharmony@gmail.com';
       Mail::to($recipientEmail)->send(new ClientSelectionMail($data));
       Toastr::success('Added Suucessfully');
       return redirect()->back();
 
    }

    public function paymentInfo(){
        $payments = PayMentModel::where('client_id',auth()->guard('client')->user()->id)->get();
        return view('FrontEnd.profile.payment_info',compact('payments'));

    }
    public function artistDetails(){
        $events = EventMaster::select('m.id as event_id','m.client_id','d.id as details_id','d.master_id','d.status','p.*')
                    ->from('event_masters as m')
                    ->where('m.client_id',auth()->guard('client')->user()->id)
                    ->join('event_details as d','d.master_id','=','m.id')
                    ->join('event_details_pivot as p','p.event_details_id','=','d.id')
                    ->whereNotIn('d.status',[0,2])
                    ->get();
        $uniqueDetailsIds = $events->pluck('details_id')->unique();
        
        return view('FrontEnd.profile.artist_details',compact('uniqueDetailsIds'));
    }


    public function getAllEvents(){
        $events       = EventMaster::with('details')->where('client_id',auth()->guard('client')->user()->id)->get();
        $eventDetails = collect();
        foreach($events as $v_event){
            $details = EventDetails::where('master_id',$v_event->id)->whereNotIn('status',[0,2])->get();
            $eventDetails =  $eventDetails->merge($details);
        }
        // dd($eventDetails );
       
        return DataTables::of($eventDetails)
        ->addIndexColumn()
        ->setRowAttr([
            'align' => 'center',
        ])
        ->addColumn('event_date',function($event){
            $event_date = $event->date;
            return $event_date;
        })
        ->addColumn('venue',function($event){
            $venue = $event->venue;
            return $venue;
        })
        ->addColumn('event_time',function($event){
            $event_time = date('g:i a',strtotime($event->start_time)).' - '.date('g:i a',strtotime($event->end_time));
            return $event_time;
        })
        ->addColumn('event_type',function($event){
            $event_time = $event->type->type_name;
            return $event_time;
        })
        ->addColumn('category',function($event){
            $event_time = $event->category->category_name;
            return $event_time;
        })
        ->addColumn('package',function($event){
            $event_time = $event->package->name;
            return $event_time;
        })
        ->addColumn('selection',function($event){
            $selection = '<a data-toggle="modal"
             data-target="#exampleModal-'.$event->id.'" class="btn-md" style="color:green"><i class="fa fa-plus"></i></a>';

             $details = '<a data-toggle="modal"
             data-target="#details-'.$event->id.'" class="btn-md pl-2" style="color:blue"><i class="fa fa-eye"></i></a>';

            return $selection.$details;
        })

          ->addColumn('delivery_date',function($event){
            $delivery_date = $event->event->delivery_date;
            return $delivery_date;
        })
        ->addColumn('status',function($event){
            $status = '';
            if($event->status == 1){
               $status = '<button class="btn btn-success btn-sm">Active</button>';
            }elseif($event->status == 3){
                $status = '<button class="btn btn-info btn-sm">Raw Ready for Delivery</button>';
            }elseif($event->status == 4){
                $status ='<button class="btn btn-success btn-sm">Photo Edit</button>';
            }elseif($event->status == 5){
                $status ='<button class="btn btn-info btn-sm">Video Edit</button>';
            }elseif($event->status == 6){
                $status ='<button class="btn btn-success btn-sm">Delivered</button>';
            }elseif($event->status == 7){
                $status ='<button class="btn btn-success btn-sm">Raw Delivered</button>';
            }
            return $status;
        })
        ->rawColumns(['event_date','venue','event_type','event_time','category','package','selection','status','delivery_date'])
        ->make(true);
    }

    public function getAllPayment(){
        $payments = PayMentModel::where('client_id',auth()->guard('client')->user()->id)->where('due_amount','>',0)->get();
        return DataTables::of($payments)
        ->addIndexColumn()
        ->setRowAttr([
            'align' => 'center',
        ])
        ->addColumn('booking_id',function($payment){
            $detail = EventDetails::where('master_id',$payment->event_id)->where('status',1)->first();
             $booking_id = '';
   
            if($payment->event_master){
                $booking_id = $payment->event_master->booking_id;
            
            }
          
            return $booking_id;
        })
        ->addColumn('total_payment',function($payment){
            $total_payment = $payment->payment_amount;
            return $total_payment;
        })
        ->addColumn('total_advance',function($payment){
            $total_advance = $payment->advance;
            return $total_advance;
        })
        ->addColumn('total_due',function($payment){
            $total_due = $payment->due_amount;
            return $total_due;
        })
        ->addColumn('view_details',function($payment){
            $view = '<a data-toggle="modal"
            data-target=".viewModal-'.$payment->id.'" class="btn btn-xs" style="font-size:12px; background-color:#5c91ec; color:white">View Details</a>';
            return $view;
        })
        ->rawColumns(['booking_id','total_payment','total_advance','total_due','view_details'])
        ->make(true);
    }
    
     public function shareExperience(){
        $events       = EventMaster::with('details')->where('client_id',auth()->guard('client')->user()->id)->get();
        $eventDetails = collect();
        foreach($events as $v_event){
            $details = EventDetails::where('master_id',$v_event->id)->whereNotIn('status',[0,2])->get();
            $eventDetails =  $eventDetails->merge($details);
        }
        return DataTables::of($eventDetails)
        ->addIndexColumn()
        ->setRowAttr([
            'align' => 'center',
        ])
        ->addColumn('event_date',function($event){
            $event_date = $event->date;
            return $event_date;
        })
        ->addColumn('venue',function($event){
            $venue = $event->venue;
            return $venue;
        })
        ->addColumn('share',function($event){
            $experience = '<a data-toggle="modal"
            data-target=".experienceModal-'.$event->id.'" class="btn btn-xs" style="font-size:12px; background-color:#5b8b70; color:white">Share Experience</a>';
            
            $view = '<a data-toggle="modal"
            data-target=".viewExperience-'.$event->id.'" class="btn btn-xs" style="font-size:12px; margin-left:4px; background-color:#6977d7; color:white">Your Review</a>';

            // $artistReview = '<a data-toggle="modal"
            // data-target=".artistExperience-'.$event->id.'" class="btn btn-xs" style="font-size:12px; margin-left:4px; background-color:#bf6464; color:white">Artist Review</a>';

            return $experience.$view;
        })
        ->rawColumns(['event_date','venue','share'])
        ->make(true);
    }


    public function clientReviewStore(Request $request){
        $validators = Validator::make($request->all(), [
            'artist_id' => 'required',
            'experience' => 'required',
        ]);

        if ($validators->fails()) {
            Toastr::error("Fill Up Data Properly!");
            return redirect()->back();
        }

        $data = [
            'detail_id' => $request->detail_id,
            'artist_id' => $request->artist_id,
            'experience' => $request->experience,
            'date' => date('d/m/Y'),
        ];

        CustomerExperience::create($data);
        Toastr::success("Thanks for Sharing Experience!");
        return redirect()->back();

    }
}
