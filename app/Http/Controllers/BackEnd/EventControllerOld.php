<?php

namespace App\Http\Controllers\BackEnd;
use PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\BackEnd\Client;
use App\Models\BackEnd\Package;
use App\Models\BackEnd\District;
use Yajra\DataTables\DataTables;
use App\Models\BackEnd\EventType;
use App\Models\BackEnd\EventShift;
use App\Models\BackEnd\Paymentlog;
use Yoeunes\Toastr\Facades\Toastr;
use App\Models\BackEnd\EventMaster;
use App\Models\BackEnd\PackageType;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\EventDetails;
use App\Models\BackEnd\PayMentModel;
use App\Models\BackEnd\StaffPayment;
use App\Models\BackEnd\FootageBackup;
use App\Models\BackEnd\EventDetailsLog;
use App\Models\BackEnd\PackageCategory;
use App\Models\BackEnd\EventwisePayment;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\OfficeExperience;
use Illuminate\Support\Facades\DB;




class EventController extends Controller
{
    public function shiftIndex(){
        if (!check_access("shift.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $shifts = EventShift::all();
        return view('BackEnd.webcontent.event.manageShift',['shifts' => $shifts]);
        
    }
    public function shiftStore(Request $request){
        if (!check_access("shift.create")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $validator = Validator::make($request->all(),[
            'shift_name' => 'required',
        
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        EventShift::create([
            'shift_name' => $request['shift_name'],
            'start_time' => $request['start_time'],
            'end_time' => $request['end_time'],
            'status' =>1
        ]);
        Toastr::success("New Shift Added !");

        return redirect()->route('shift');
    }
    public function shiftUpdate(Request $request,$id){
        if (!check_access("shift.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $validator = Validator::make($request->all(),[
            'shift_name' => 'required',
        
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $event = EventShift::find($id);

        $event->update([
            'shift_name' => $request['shift_name'],
            'start_time' => $request['start_time'],
            'end_time' => $request['end_time'],
        ]);
        Toastr::success("Shift Updated Successfully !");

        return redirect()->route('shift');
    }
    public function shiftStatus($id){
        try{
            if (!check_access("shift.edit")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $status = EventShift::find($id);
            if($status->status == 1){
                $status->status = 0;
                Toastr::warning("Status Inactive !");
            }
            else{
                $status->status = 1;
                Toastr::success("Status Activated !");
            }
            $status->save();
            return redirect()->back();
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function shiftDelete($id){
        if (!check_access("shift.delete")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $content = EventShift::find($id);
        $content -> delete();
        Toastr::success("Deleted Successfully !");
        return redirect()->back();

    }
    public function typeIndex(){
        if (!check_access("eventType.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $types  =EventType::all();
        return view('BackEnd.webcontent.event.manageType',compact('types'));

    }

    public function typeStore(Request $request){
        if (!check_access("eventType.create")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $validator = Validator::make($request->all(),[
            'type_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        EventType::create([
            'type_name' => $request['type_name'],
            'status' =>1
        ]);
        Toastr::success("Event Type Added Successfully !");

        return redirect()->route('event_type');
    }

    public function typeUpdate(Request $request,$id){
        if (!check_access("eventType.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $validator = Validator::make($request->all(),[
                'type_name' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $event = EventType::find($id);
            $event->update([
                'type_name' => $request['type_name'],
                'status' =>1
            ]);
            Toastr::success("Event Type Updated Successfully !");

        return redirect()->route('event_type');
    }
    public function typeStatus($id){
        try{
            if (!check_access("eventType.edit")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $status = EventType::find($id);
            if($status->status == 1){
                $status->status = 0;
                Toastr::warning("Status Inactive !");
            }
            else{
                $status->status = 1;
                Toastr::success("Status Activated !");
            }
            $status->save();
            return redirect()->back();
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function typeDelete($id){
        if (!check_access("eventType.delete")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $content = EventType::find($id);
        $content -> delete();
        Toastr::success("Deleted Successfully !");
        return redirect()->back();
    }
    public function district(){
        if (!check_access("district.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $districts  =District::all();
        // 
        return view('BackEnd.webcontent.event.district',compact('districts'));
    }
    public function storeDistrict(Request $request){
     
        $validator = Validator::make($request->all(),[
            'district' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        District::create([
            'district' => $request['district'],
            'status' =>1
        ]);
        Toastr::success("District Added Successfully !");

        return redirect()->route('district');
    }

    public function updateDistrict(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'district' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $district = District::find($id);

        $district->update([
            'district' => $request['district'],
            'status' =>1
        ]);
        Toastr::success("Updated Successfully !");

        return redirect()->route('district');

    }
    public function districtStatus($id){
        try{
            if (!check_access("district.edit")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $status = District::find($id);
            if($status->status == 1){
                $status->status = 0;
                Toastr::warning("Status Inactive !");
            }
            else{
                $status->status = 1;
                Toastr::success("Status Activated !");
            }
            $status->save();
            return redirect()->back();
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function deleteDistrict($id){
        if (!check_access("district.delete")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $content = District::find($id);
        $content -> delete();
        Toastr::success("Deleted Successfully !");
        return redirect()->back();
    }

    public function Events(){
        if (!check_access("event.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $events = EventMaster::with('client')->get();
        $users = User::all();
        $districts = District::all();
        $types = EventType::all();
        $shifts = EventShift::all();
        $categories = PackageCategory::all();
        $packages = Package::all();
        return view('BackEnd.webcontent.event.manageEvent',compact('events','users','districts',
        'types','shifts','categories','packages'));
    }

     public function getAllEvents(Request $request){
        if (!check_access("event.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        if($request->ajax())
            {
            $status = $request->status;
            $payment_status = $request->payment_status;
            $event = $request->event;
            $district = $request->district;
            $type = $request->type;
            $shift = $request->shift;
            $category = $request->category;
            $package = $request->package;
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            if($status != "" ||  $event != ""  || $district != ""  || $type != ""  ||  $shift != "" || $category != ""  || $package != ""  || $from_date != ""  || $to_date != "" ){

              $event_info = EventMaster::select('e.*', 'd.id as d_id', 'd.master_id', 'd.shift_id', 'd.district_id', 'd.type_id', 'd.category_id', 'd.package_id', 'd.status', 'd.date', 'd.start_time', 'd.end_time',
                                's.shift_id', 's.shift_name', 'dst.district_id', 'dst.district', 't.type_id', 't.type_name', 'c.id as c_id', 'pkg.id as p_id', 'pt.id as pt_id', 'pt.due_amount', 'pt.payment_amount')
                                ->from('event_masters as e')
                                ->leftJoin('event_details as d', 'd.master_id', '=', 'e.id')
                                ->leftJoin('districts as dst', 'dst.district_id', '=', 'd.district_id')
                                ->leftJoin('event_types as t', 't.type_id', '=', 'd.type_id')
                                ->leftJoin('event_shifts as s', 's.shift_id', '=', 'd.shift_id')
                                ->leftJoin('package_category as c', 'c.id', '=', 'd.category_id')
                                ->leftJoin('packages as pkg', 'pkg.id', '=', 'd.package_id')
                                ->leftJoin('payments as pt', 'pt.event_id', '=', 'e.id');
                        
            if($status && $status != "all" || $status == 0 ){
                $event_info->where('d.status',$status)->orderByDesc('selection_date')->get();
            }
            if ($payment_status && $payment_status != "all") {
                if ($payment_status == 'full') {
                    $event_info->where('pt.advance', '=', 'pt.payment_amount');
                } else if ($payment_status == 'partial') {
                    $event_info->where('pt.advance', '>', '0');
                } else {
                    $event_info->whereColumn('pt.due_amount', '=', 'pt.payment_amount');
                }
            }
            if($event && $event != "all"){
                $event_info->where('e.id',$event)->get();
            }
            if($district && $district != "all"){
                $event_info->where('d.district_id',$district)->get();
            }
            if($type && $type != "all"){
                $event_info->where('d.type_id',$type)->get();
            }
            if($shift && $shift != "all"){
                $event_info->where('d.shift_id',$shift)->get();
            }
            if($category && $category != "all"){
                $event_info->where('d.category_id',$category)->get();
            }
            if($package && $package != "all"){
                $event_info->where('d.package_id',$package)->get();
            }
            if($from_date && $from_date != null){
                $event_info->where('d.date','>=',$from_date)->get();
            }
            if($to_date && $to_date != null){
                $event_info->where('d.date','<=',$to_date)->get();
            }
            $events = $event_info->orderByDesc('id')->get();
                
                $count = 0; 

                return DataTables::of($events)
                ->addIndexColumn()
                ->setRowId(function($event){return $event->id;})
                ->setRowAttr([
                    'align' => 'center',
                ])
                ->addColumn('booking_id',function($event){
                    $booking_id = $event->booking_id;
                    return $booking_id;
                })
                ->addColumn('booking_info',function($event){
                     $details = EventDetails::where('id',$event->d_id)->first();
                     $venue  = $details->venue;
                     $venue = $details->venue;
                     $venueFormatted = wordwrap($venue, 50, "<br>");
                    $booking_html = '
                        <strong>Client Name:</strong>' . $event->client->name . ' <br>
                        <strong>Phone Number:</strong> ' . $event->client->primary_no . ' <br>
                        <strong>Venue:</strong>' .$venueFormatted . '<br>';
                    
                    return $booking_html;
                })
                ->addColumn('event_type', function ($event) {
                    $details = EventDetails::where('id',$event->d_id)->first();
                    
                    // Render the nested table
                    $type_html = '<table class="table child-table">';
                    $type_html .= '<tbody>';
                        $type_html .= '<tr>';
                        $type_html .= '<td style="padding-top:0px">' . $details->type->type_name . '</td>';
                        $type_html .= '</tr>';
                        $type_html .= '</tbody>';
                        $type_html .= '</table>';
        
            
                    return $type_html;
                })
                ->addColumn('event_date',function($event){
                    $details = EventDetails::where('id',$event->d_id)->first();
                    // Render the nested table
                    $event_date = '<table class="table  child-table">';
                    $event_date .= '<tbody>';
                        $event_date .= '<tr>';
                        $event_date .= '<td>' . $details->date . '</td>';
                        $event_date .= '</tr>';
                        $event_date .= '</tbody>';
                        $event_date .= '</table>';
            
                    return $event_date;
                })->addColumn('expense',function($event){
                $addexpense = '';
                // if (check_access("event.list")) {
                $details = EventDetails::where('id',$event->d_id)->first();
                $view = '<table class="table  child-table">';
                $view .= '<tbody>';
                // foreach($details as $s_detail){
                    $view .= '<tr>';
                    $view .='<td>'.'<a href="'.route('event-expense',$details->id).'" style="padding:2px; margin-left:3px; margin-top:6px; color:white; background-color:#237af7"
                        class="btn btn-xs btn-sm mr-1">
                         Add Expenses
                        </a>'.'</td>';
                    $view .= '</tr>';
                // }
                $view .= '</tbody>';  
                $view .= '</table>';  
                // }
                return $view;
    
                })->addColumn('selection_date',function($event){
                    $detail = EventDetails::where('master_id',$event->id)->first();
                    // Render the nested table
                    $selection_date =  $detail->selection_date ;
                    return $selection_date;
                })
                ->addColumn('event_shift', function ($event) {
                    $details = EventDetails::where('id',$event->d_id)->first();
                    // Render the nested table
                    $event_shift = '<table class="table  child-table">';
                    $event_shift .= '<tbody>';
                        $event_shift .= '<tr>';
                        $event_shift .= '<td>' . $details->shift->shift_name . '</td>';
                        $event_shift .= '</tr>';
                        $event_shift .= '</tbody>';
                        $event_shift .= '</table>';
            
                    return $event_shift;
                })
                ->addColumn('event_time', function ($event) {
                    $details = EventDetails::where('id',$event->d_id)->first();
                    // Render the nested table
                    $event_time = '<table class="table child-table">';
                    $event_time .= '<tbody>';
                        $time  =  date('g:i a',strtotime($details->start_time)).' - '.date('g:i a',strtotime($details->end_time));
                        $event_time .= '<tr>';
                        $event_time .= '<td>' . $time . '</td>';
                        $event_time .= '</tr>';
                    
                        $event_time .= '</tbody>';
                        $event_time .= '</table>';
            
                    return $event_time;
                })
                ->addColumn('package', function ($event) {
                    $details = EventDetails::where('id',$event->d_id)->where('category_id',$event->category_id)->first();
                    // Render the nested table
                    $event_location = '<table class="table child-table">';
                    $event_location .= '<tbody>';
                        $event_location .= '<tr>';
                        $event_location .= '<td>' . $details->category->category_name . '</td>';
                        $event_location .= '</tr>';
                    
                        $event_location .= '</tbody>';
                        $event_location .= '</table>';
            
                    return $event_location;
                })
                ->addColumn('package_name', function ($event) {
                    $details = EventDetails::where('id',$event->d_id)->where('package_id',$event->package_id)->first();
                        // Render the nested table
                    $event_location = '<table class="table child-table">';
                    $event_location .= '<tbody>';
                        $event_location .= '<tr>';
                        $event_location .= '<td>' .$details->package->name .'</td>';
                        $event_location .= '</tr>';
                        $event_location .= '</tbody>';
                        $event_location .= '</table>';
            
                    return $event_location;
                })
                ->addColumn('status', function($event){
                    $status= '';
                    if (check_access("event.status")) {
                    $details = EventDetails::where('id',$event->d_id)->where('status',$event->status)->first();
                    $status = '<table class="table btn-table">';
                    $status .= '<tbody>';
                        $status .= '<tr>';
                        if($details->status == 0){
                            $status .= '<td>' . '<a data-bs-toggle="modal" 
                            data-bs-target=".status_modal-'.$details->id.'"
                            style="background-color: rgb(189 163 35); color:white; border-radius:5px;"
                            class="btn btn-xs mr-1">Pending</a>' . '</td>';
                           
                        }
                        else if($details->status == 1){
                            $status .= '<td>' . '<a data-bs-toggle="modal" 
                            data-bs-target=".status_modal-'.$details->id.'"
                            style="background-color:#23bd5f; color:white; border-radius:5px;"
                            class="btn btn-xs mr-1">Active</a>'. '</td>';
                        }
                        else if($details->status == 2){
                            $status .= '<td>' . '<a data-bs-toggle="modal" 
                            data-bs-target=".status_modal-'.$details->id.'"
                            style="background-color:#bd2823; color:white; border-radius:5px;"
                            class="btn btn-xs btn-sm mr-1">Deactive</a>'. '</td>';
                        }
                        else if($details->status == 3){
                            $status .= '<td>' . '<a data-bs-toggle="modal" 
                            data-bs-target=".status_modal-'.$details->id.'"
                            style="background-color:#23b8bd; color:white; border-radius:5px;"
                            class="btn btn-xs  mr-1">Raw Ready For Delivery</a>'. '</td>';
                        }
                        else if($details->status == 4){
                            $status .= '<td>' . '<a data-bs-toggle="modal" 
                            data-bs-target=".status_modal-'.$details->id.'"
                            style="background-color: #235bbd; color:white; border-radius:5px;"
                            class="btn btn-xs  mr-1">Selection Given</a>'. '</td>';
                        }
                        else if($details->status == 5){
                            $status .= '<td>' . '<a data-bs-toggle="modal" 
                            data-bs-target=".status_modal-'.$details->id.'"
                            style="background-color: #5c23bd; color:white; border-radius:5px;"
                            class="btn btn-xs  mr-1">Final Ready</a>'. '</td>';
                        }
                        else if($details->status == 6){
                            $status .= '<td>' . '<a data-bs-toggle="modal" 
                            data-bs-target=".status_modal-'.$details->id.'"
                            style="background-color:#377c00; color:white; border-radius:5px;"
                            class="btn btn-xs  mr-1">Delivered</a>'. '</td>';
        
                        }else if($details->status == 7){
                            $status .= '<td>' . '<a data-bs-toggle="modal" 
                            data-bs-target=".status_modal-'.$details->id.'"
                            style="background-color:#377c00; color:white; border-radius:5px;"
                            class="btn btn-xs  mr-1">Raw Delivered</a>'. '</td>';
        
                        }else{
                            $status = '';
                        }
                        $status .= '</tr>';
                    
                    $status .= '</tbody>';
                    $status .= '</table>';
                    }
                    return $status;
                   
                })
                ->addColumn('payment_info', function($event){
                    $payment = PayMentModel::where('event_id',$event->id)->first();
                    if($payment){
                        $payment_html = '
                        <strong>Total Amount:</strong>' . $payment->payment_amount. ' <br>
                        <strong>Total Advance:</strong> '.$payment->advance .' <br>
                        <strong>Total Due:</strong>'. $payment->due_amount .'<br>
                    ';
                    }else{
                        $payment_html ='';
                    }
                    return $payment_html;
                })
                ->addColumn('assign', function($event){
                    $buttons = '';
                    if (check_access("assign.photographer.other")) {
                   
                    $buttons = '<a data-bs-toggle="modal" 
                                data-bs-target=".photographer-'.$event->id.'"
                                style="background-color:#cd4715; color:white; border-radius:5px; margin-bottom:4px"
                                class="btn btn-xs btn-sm mr-1">Photographer</a> 
                                <br>
                                <a  data-bs-toggle="modal" 
                                data-bs-target=".cinematographer-'.$event->id.'" style="background-color: #068b58; color:white; border-radius:5px;  margin-bottom:4px"
                                class="btn btn-xs btn-sm mr-1">Cinematographer</a>
                                <br>
                                <a  data-bs-toggle="modal" 
                                data-bs-target=".photoeditor-'.$event->id.'" style="background-color: #0c4aa3; color:white; border-radius:5px;  margin-bottom:4px"
                                class="btn btn-xs btn-sm mr-1">Photo Editor</a>
                                <br>
                                <a  data-bs-toggle="modal" 
                                data-bs-target=".cineeditor-'.$event->id.'" style="background-color: #830ca3; color:white; border-radius:5px;  margin-bottom:4px"
                                class="btn btn-xs btn-sm mr-1">Cine Editor</a>';
                    
                }
                    return $buttons;
                })
                ->addColumn('add_new', function($event){
                    $buttons = '';
                    if (check_access("event.create")) {
                    $buttons = '<a href="'.route('event.add',$event->id).'" style="background-color:#26a90c; color:white; border-radius:10px; margin-bottom:4px;"
                                class="btn btn-xs btn-sm mr-1"><i class="fa fa-plus"></i></a>';
                    }
                    return $buttons;
                })
                ->addColumn('action',function($event){
                    $view = '';
                    $edit = '';
                    $delete = '';
                    if (check_access("event.list")) {
                    $view ='<a href=""  data-bs-toggle="modal" 
                                data-bs-target=".view_modal-'.$event->id.'" style="padding:2px; margin-left:3px; color:white"
                                class="btn btn-xs btn-info btn-sm mr-1">
                                <svg  width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </a>';
                    }
                    if (check_access("event.edit")) {
        
                    $edit = '<a href="'.route('event.edit',$event->id).'" style="padding:2px;  margin-left:3px; "
                                    class="btn btn-xs btn-primary btn-sm mr-1">
                                    <svg width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>';
                    }
                    
                
                    // if (check_access("event.delete")) {
        
                    // $delete = '<a href="'.route('delete.event',$event->id).'"
                    //             onclick="return confirm("Are you sure you want to delete?");"
                    //             style="padding: 2px; margin-left:3px;" class="delete btn btn-xs btn-danger btn-sm mr-1"><svg
                    //             width="16" height="14" viewBox="0 0 24 24" fill="none"
                    //             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    //             stroke-linejoin="round" class="feather feather-trash-2">
                    //             <polyline points="3 6 5 6 21 6"></polyline>
                    //             <path
                    //                 d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                    //             </path>
                    //             <line x1="10" y1="11" x2="10" y2="17"></line>
                    //             <line x1="14" y1="11" x2="14" y2="17"></line>
                    //         </svg></a>
                    //             ';
                    // }
                    
                    if (check_access("event.delete")) {
        
                    $delete = '<a onclick="deleteEvent(' .$event->id .')" data-id="' .$event->id .'"
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
                            </svg></a>
                                ';
                    }
        
                    return $view.$edit.$delete;
        
                }) ->addColumn('experience',function($event){
                    $view = '';
                    $officeExperience = '';
         
                    if (check_access("event.list")) {
                        $details = EventDetails::where('master_id',$event->id)->get();
                        $view = '<table class="table  child-table">';
                        $view .= '<tbody>';
                        foreach($details as $s_detail){
                            $view .= '<tr>';
                            $view .='<td>'.'<a href=""  data-bs-toggle="modal" 
                                data-bs-target=".officeExperience-'.$s_detail->id.'" style="padding:2px; margin-left:3px; margin-top:6px; color:white"
                                class="btn btn-xs btn-primary btn-sm mr-1">
                                Share Experience
                                </a>'.'</td>';
        
                            $view .='<td>'.'<a href=""  data-bs-toggle="modal" 
                                data-bs-target=".viewExperience-'.$s_detail->id.'" style="padding:2px; margin-left:3px; margin-top:6px; color:white"
                                class="btn btn-xs btn-info btn-sm mr-1">
                                View Experience
                                </a>'.'</td>';
        
                        $view .= '</tr>';
                        }
                        $view .= '</tbody>';  
                        $view .= '</table>';  
                    }
                    return $view;
        
                })
                ->rawColumns(['booking_id','expense','selection_date','booking_info','payment_info','event_type','event_date','event_shift','event_time','package','package_name','assign','status','add_new','action','experience'])
                ->make(true);
            }
            else{
                $events = EventMaster::with('client')->orderByDesc('id')->select('*')->get();
    
                $count = 0; 
            return DataTables::of($events)
            ->addIndexColumn()
            ->setRowId(function($event){return $event->id;})
            ->setRowAttr([
                'align' => 'center',
            ])
            ->addColumn('booking_id',function($event){
                $booking_id = $event->booking_id;
                return $booking_id;
            })
            ->addColumn('booking_info',function($event){
                $booking_html = '
                    <strong>Client Name:</strong>' . $event->client->name . ' <br>
                    <strong>Client Email:</strong>' . $event->client->email . ' <br>
                    <strong>Phone Number:</strong> '. $event->client->primary_no .' <br>
                    <strong>Bride Name:</strong>'. $event->bride_name .'<br>
                    <strong>Groom Name:</strong> '. $event->groom_name .'<br>
                    <!-- Add more details as needed -->
                ';
                return $booking_html;
            })
            ->addColumn('expense',function($event){
                $addexpense = '';
                // if (check_access("event.list")) {
                $details = EventDetails::where('master_id',$event->id)->get();
                $view = '<table class="table  child-table">';
                $view .= '<tbody>';
                foreach($details as $s_detail){
                    $view .= '<tr>';
                    $view .='<td>'.'<a href="'.route('event-expense',$s_detail->id).'" style="padding:2px; margin-left:3px; margin-top:6px; color:white; background-color:#237af7"
                        class="btn btn-xs btn-sm mr-1">
                         Add Expenses
                        </a>'.'</td>';
                    $view .= '</tr>';
                }
                $view .= '</tbody>';  
                $view .= '</table>';  
                // }
                return $view;
    
            })
            ->addColumn('event_type', function ($event) {
                $details = EventDetails::where('master_id',$event->id)->get();
                
                // Render the nested table
                $type_html = '<table class="table child-table">';
                $type_html .= '<tbody>';
                foreach ($details as $detail) {
                    $type_html .= '<tr>';
                    $type_html .= '<td style="padding-top:0px">' . $detail->type->type_name . '</td>';
                    $type_html .= '</tr>';
                }
                    $type_html .= '</tbody>';
                    $type_html .= '</table>';
    
        
                return $type_html;
            })
            ->addColumn('event_date',function($event){
                $details = EventDetails::where('master_id',$event->id)->get();
                // Render the nested table
                $event_date = '<table class="table  child-table">';
                $event_date .= '<tbody>';
                foreach ($details as $detail) {
                    $event_date .= '<tr>';
                    $event_date .= '<td>' . $detail->date . '</td>';
                    $event_date .= '</tr>';
                }
                    $event_date .= '</tbody>';
                    $event_date .= '</table>';
        
                return $event_date;
            })
            ->addColumn('selection_date',function($event){
                $details = EventDetails::where('master_id',$event->id)->get();
                // Render the nested table
                $selection_date = '<table class="table  child-table">';
                $selection_date .= '<tbody>';
                foreach ($details as $detail) {
                    $selection_date .= '<tr>';
                    $selection_date .= '<td>' . $detail->selection_date . '</td>';
                    $selection_date .= '</tr>';
                }
                    $selection_date .= '</tbody>';
                    $selection_date .= '</table>';
        
                return $selection_date;
            })
            ->addColumn('event_shift', function ($event) {
                $details = EventDetails::where('master_id',$event->id)->get();
                // Render the nested table
                $event_shift = '<table class="table  child-table">';
                $event_shift .= '<tbody>';
                foreach ($details as $detail) {
                    $event_shift .= '<tr>';
                    $event_shift .= '<td>' . $detail->shift->shift_name . '</td>';
                    $event_shift .= '</tr>';
                }
                    $event_shift .= '</tbody>';
                    $event_shift .= '</table>';
        
                return $event_shift;
            })
            ->addColumn('event_time', function ($event) {
                $details = EventDetails::where('master_id',$event->id)->get();
                // Render the nested table
                $event_time = '<table class="table child-table">';
                $event_time .= '<tbody>';
                foreach ($details as $detail) {
                    $time  =  date('g:i a',strtotime($detail->start_time)).' - '.date('g:i a',strtotime($detail->end_time));
                    $event_time .= '<tr>';
                    $event_time .= '<td>' . $time . '</td>';
                    $event_time .= '</tr>';
                }
                    $event_time .= '</tbody>';
                    $event_time .= '</table>';
        
                return $event_time;
            })
            ->addColumn('package', function ($event) {
                $details = EventDetails::where('master_id',$event->id)->get();
                // Render the nested table
                $event_location = '<table class="table child-table">';
                $event_location .= '<tbody>';
                foreach ($details as $detail) {
                    $event_location .= '<tr>';
                    $event_location .= '<td>' . $detail->category->category_name . '</td>';
                    $event_location .= '</tr>';
                }
                    $event_location .= '</tbody>';
                    $event_location .= '</table>';
        
                return $event_location;
            })
            ->addColumn('package_name', function ($event) {
                $details = EventDetails::where('master_id',$event->id)->get();
                    // Render the nested table
                $event_location = '<table class="table child-table">';
                $event_location .= '<tbody>';
                foreach ($details as $detail) {
                    $event_location .= '<tr>';
                    $event_location .= '<td>' .$detail->package->name .'</td>';
                    $event_location .= '</tr>';
                }
                    $event_location .= '</tbody>';
                    $event_location .= '</table>';
        
                return $event_location;
            })
            ->addColumn('status', function($event) {
                    if (!check_access("event.status")) return '';
                
                    $statusConfig = [
                        0 => ['color' => 'rgb(189 163 35)', 'label' => 'Pending'],
                        1 => ['color' => '#23bd5f', 'label' => 'Active'],
                        2 => ['color' => '#bd2823', 'label' => 'Deactive'],
                        3 => ['color' => '#23b8bd', 'label' => 'Raw Ready For Delivery'],
                        4 => ['color' => '#235bbd', 'label' => 'Selection Given'],
                        5 => ['color' => '#5c23bd', 'label' => 'Final Ready'],
                        6 => ['color' => '#377c00', 'label' => 'Delivered'],
                        7 => ['color' => '#377c00', 'label' => 'Raw Delivered'],
                    ];
                
                    $details = EventDetails::where('master_id', $event->id)->get();
                    
                    $statusHtml = '<table class="table btn-table"><tbody>';
                    
                    foreach ($details as $detail) {
                        if (!isset($statusConfig[$detail->status])) continue;
                
                        $config = $statusConfig[$detail->status];
                        $statusHtml .= sprintf('
                            <tr>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target=".status_modal-%s"
                                       style="background-color: %s; color: white; border-radius: 5px;"
                                       class="btn btn-xs mr-1">%s</a>
                                </td>
                            </tr>',
                            $detail->id,
                            $config['color'],
                            $config['label']
                        );
                    }
                    
                    $statusHtml .= '</tbody></table>';
                    
                    return $statusHtml;
                })
            ->addColumn('payment_info', function($event){
                $payment = PayMentModel::where('event_id',$event->id)->first();
                if($payment){
                    $payment_html = '
                    <strong>Total Amount:</strong>' . $payment->payment_amount. ' <br>
                    <strong>Total Advance:</strong> '.$payment->advance .' <br>
                    <strong>Total Due:</strong>'. $payment->due_amount .'<br>
                ';
                }else{
                    $payment_html ='';
                }
                return $payment_html;
            })
            ->addColumn('assign', function($event){
                $buttons = '';
                if (check_access("assign.photographer.other")) {
                $buttons = '<a data-bs-toggle="modal" 
                            data-bs-target=".photographer-'.$event->id.'"
                            style="background-color:#cd4715; color:white; border-radius:5px; margin-bottom:4px"
                            class="btn btn-xs btn-sm mr-1">Photographer</a> 
                            <br>
                            <a  data-bs-toggle="modal" 
                            data-bs-target=".cinematographer-'.$event->id.'" style="background-color: #068b58; color:white; border-radius:5px;  margin-bottom:4px"
                            class="btn btn-xs btn-sm mr-1">Cinematographer</a>
                            <br>
                            <a  data-bs-toggle="modal" 
                            data-bs-target=".photoeditor-'.$event->id.'" style="background-color: #0c4aa3; color:white; border-radius:5px;  margin-bottom:4px"
                            class="btn btn-xs btn-sm mr-1">Photo Editor</a>
                            <br>
                            <a  data-bs-toggle="modal" 
                            data-bs-target=".cineeditor-'.$event->id.'" style="background-color: #830ca3; color:white; border-radius:5px;  margin-bottom:4px"
                            class="btn btn-xs btn-sm mr-1">Cine Editor</a>';
                }
                return $buttons;
            })
            ->addColumn('add_new', function($event){
                $buttons = '';
                if (check_access("event.create")) {
                $buttons = '<a href="'.route('event.add',$event->id).'" style="background-color:#26a90c; color:white; border-radius:10px; margin-bottom:4px;"
                            class="btn btn-xs btn-sm mr-1"><i class="fa fa-plus"></i></a>';
                }
                return $buttons;
            })
            ->addColumn('action',function($event){
                $view = '';
                $edit = '';
                $delete = '';
                $invoice  = '';
                $log = '';
                if (check_access("event.list")) {
                $view ='<a href=""  data-bs-toggle="modal" 
                            data-bs-target=".view_modal-'.$event->id.'" style="padding:2px; margin-left:3px; color:white"
                            class="btn btn-xs btn-info btn-sm mr-1">
                            <svg  width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </a>';
                }
                if (check_access("event.edit")) {
    
                $edit = '<a href="'.route('event.edit',$event->id).'" style="padding:2px;  margin-left:3px; "
                                class="btn btn-xs btn-primary btn-sm mr-1">
                                <svg width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            </a>';
                }
                 if(auth()->user()->type == 'super_admin'||auth()->user()->type == 'admin'){
                        $log = '<a   data-bs-toggle="modal" 
                        data-bs-target=".activity_log-'.$event->id.'"  style="padding:2px;  margin-left:3px; color:white "
                        class="btn btn-xs btn-info btn-sm mr-1">
                        <i class="fa fa-file-medical"></i>
                        </a>';
                    }
                // if (check_access("event.delete")) {
    
                // $delete = '<a href="'.route('delete.event',$event->id).'"
                //             onclick="return confirm("Are you sure you want to delete?");"
                //             style="padding: 2px; margin-left:3px;" class="delete btn btn-xs btn-danger btn-sm mr-1"><svg
                //             width="16" height="14" viewBox="0 0 24 24" fill="none"
                //             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                //             stroke-linejoin="round" class="feather feather-trash-2">
                //             <polyline points="3 6 5 6 21 6"></polyline>
                //             <path
                //                 d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                //             </path>
                //             <line x1="10" y1="11" x2="10" y2="17"></line>
                //             <line x1="14" y1="11" x2="14" y2="17"></line>
                //         </svg></a><br>
                //             ';
                // }
                
                if (check_access("event.delete")) {
    
                $delete = '<a onclick="deleteData(' .$event->id .')" data-id="' .$event->id .'"
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
                        </svg></a><br>
                        ';
                }
                
                 if(auth()->user()->type == 'super_admin'||auth()->user()->type == 'admin'){
                    //  if($event->master_status == 1){ 
                        $invoice ='<a href="'.route('invoice',$event->id).'" style="padding:2px;  margin-left:3px; margin-top:10px; color:white"
                        class="btn btn-md btn-info btn-sm mr-1">
                        Send Invoice
                        </a>';  
                    //  }
                    
                }
    
                return $view.$edit.$log.$delete.$invoice ;
    
            })
            ->addColumn('experience',function($event){
                $view = '';
                $officeExperience = '';
     
                if (check_access("event.list")) {
                    $details = EventDetails::where('master_id',$event->id)->get();
                    $view = '<table class="table  child-table">';
                    $view .= '<tbody>';
                    foreach($details as $s_detail){
                        $view .= '<tr>';
                        $view .='<td>'.'<a href=""  data-bs-toggle="modal" 
                            data-bs-target=".officeExperience-'.$s_detail->id.'" style="padding:2px; margin-left:3px; margin-top:6px; color:white"
                            class="btn btn-xs btn-primary btn-sm mr-1">
                            Share Experience
                            </a>'.'</td>';
    
                        $view .='<td>'.'<a href=""  data-bs-toggle="modal" 
                            data-bs-target=".viewExperience-'.$s_detail->id.'" style="padding:2px; margin-left:3px; margin-top:6px; color:white"
                            class="btn btn-xs btn-info btn-sm mr-1">
                            View Experience
                            </a>'.'</td>';
    
                    $view .= '</tr>';
                    }
                    $view .= '</tbody>';  
                    $view .= '</table>';  
                }
                return $view;
    
            })
            ->rawColumns(['booking_id','booking_info','expense','payment_info','event_type','event_date','event_shift','event_time','package','package_name','assign','status','add_new','action','selection_date','experience'])
            ->make(true);
            }
        }
        
    }
    
     public function experinceStore(Request $request){
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
            'user_id' => $request->artist_id,
            'experience' => $request->experience,
            'date' => date('d/m/Y'),
        ];

        OfficeExperience::create($data);
        // Toastr::success("Review Stored Successfully!");
        // return redirect()->back();
        
        return response()->json(['message' => 'Data Stored successfully']); 

    }

    public function filterEvent(Request $request){
        if (!check_access("event.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        // $total_event = $request->total_event;
        $status = $request->status;
        $event = $request->event;
        $district = $request->district;
        $type = $request->type;
        $shift = $request->shift;
        $category = $request->category;
        $package = $request->package;
        // $amount = $request->amount;
        // $advance = $request->advance;
        // $due = $request->due;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $event_info = EventDetails::select('d.*','e.*','s.shift_id','s.shift_name','dst.district_id','dst.district','t.type_id',
        't.type_name','c.id','c.category_name','pkg.id','pkg.name','pt.payment_amount','pt.advance','pt.due_amount')
        ->from('event_details as d')
        ->leftjoin('event_masters as e','e.id','=','d.master_id')
        ->leftjoin('districts as dst','dst.district_id','=','d.district_id')
        ->leftjoin('event_types as t','t.type_id','=','d.type_id')
        ->leftjoin('event_shifts as s','s.shift_id','=','d.shift_id')
        ->leftjoin('package_category as c','c.id','=','d.category_id')
        ->leftjoin('packages as pkg','pkg.id','=','d.package_id')
        ->leftjoin('payments as pt','pt.event_id','=','e.id');

        if($status && $status != "all" || $status == 0 ){
            $event_info->where('d.status',$status)->get();
        }
        if($event && $event != "all"){
            $event_info->where('e.id',$event)->get();
        }
        if($district && $district != "all"){
            $event_info->where('d.district_id',$district)->get();
        }
        if($type && $type != "all"){
            $event_info->where('d.type_id',$type)->get();
        }
        if($shift && $shift != "all"){
            $event_info->where('d.shift_id',$shift)->get();
        }
        if($category && $category != "all"){
            $event_info->where('d.category_id',$category)->get();
        }
        if($package && $package != "all"){
            $event_info->where('d.package_id',$package)->get();
        }
        // if($amount && $amount != null){
        //     $event_info->where('pt.payment_amount','>=',$amount)->get();
        // }
        // if($advance && $advance != null){
        //     $event_info->where('pt.advance','>=',$advance)->get();
        // }
        // if($due && $due != null){
        //     $event_info->where('pt.due_amount','>=',$due)->get();
        // }
        if($from_date && $from_date != null){
            $event_info->where('d.date','>=',$from_date)->get();
        }
        if($to_date && $to_date != null){
            $event_info->where('d.date','<=',$to_date)->get();
        }
        $result = $event_info->orderBy('d.date','asc')->get();
        // dd( $result);
        if (count($result) > 0) {
            return view('BackEnd.webcontent.event.filter_event_data',['result' => $result]);
        }

    }
   
    public function addNewEvent($id){
        if (!check_access("event.create")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $eventMaster = EventMaster::where('id',$id)->first();
        $package_type=PackageType::all();
        $package_category=PackageCategory::where('status',1)->get();
        $package = Package::where('status',1)->get();
        $shifts = EventShift::where('status',1)->get();
        $types = EventType::where('status',1)->get();
        $districts = District::where('status',1)->get();
        return view('BackEnd.webcontent.event.addNewEvent',compact('eventMaster','package_type','package_category','package','shifts',
        'types','districts'));
    }

    public function storeEvents(Request $request){
        // return $requset->all();
        $validators = Validator::make($request->all(), [
            'date' => 'required',
            'shift_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'type_id' => 'required',
            'district_id' => 'required',
            'venue' => 'required',
            'category_id' => 'required',
            'package_id' => 'required',
        ]);

        if ($validators->fails()) {
            Toastr::error("Fill Up Data Properly!");
            return redirect()->back();
        }
        $totalAmount = 0;
        $totalDue = 0;
        $event = EventMaster::where('id',$request->master_id)->first();
        $totalNewEvent = count($request->shift_id);
        $totalEvent = $event->total_event +  $totalNewEvent;

        $event->update([
            'total_event'  => $totalEvent
        ]);
       
        $previousPayment = PayMentModel::where('event_id',$event->id)->first();
        // dd($request->input('package_id'));

        for ($i = 0; $i < $totalNewEvent; $i++) {
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
            // dd($event_detail);

            $event_detail->save();

            $packageDetail = Package::where('id',$request->input('package_id')[$i])->first();
            $totalAmount += $packageDetail->discount;
            $totalDue  += $packageDetail->discount;
        }

        $updateAmount =  $previousPayment->payment_amount + $totalAmount;
        $updateDue =  $previousPayment->due + $totalDue;

        $previousPayment->update([
            'payment_amount' =>  $updateAmount,
            'due_amount'     =>  $updateDue
        ]);
        
       

        Toastr::success('New Event Added Successfully');
        return redirect()->route('event_info');
        
    }
    
    public function assignEvent(Request $request){
        // return $request->all();
        if (!check_access("assign.photographer.other")) {
            Toastr::error("You don't have permission!");
            return redirect()->back();
        }
        $assignData = [];
        $userStatus = $request->input('status'); 
        $userData = $request->input('user'); 
        $paymentData = $request->input('payment'); 
        // dd( $paymentData);
       // Initialize an array to store total payment amounts for each user
        $totalPayment = [];

        foreach ($userData as $eventId => $photographers) {
            foreach ($photographers as $photographerId => $selectedPhotographer) {
                preg_match_all('/\d+/', $selectedPhotographer, $matches);
                // dd($patterns);
                $userId = $matches[0][0];
                $assignData[] = [
                    'event_details_id' => $eventId,
                    'assigned_user_id' => $userId,
                    'status' => $userStatus,
                ];
                if (
                    isset($paymentData[$eventId]) &&
                    isset($paymentData[$eventId][$photographerId]) &&
                    $paymentData[$eventId][$photographerId] !== null
                ) {
                    // dd($paymentData[$eventId]);
                    $paymentInsertData = [
                        'user_id' => $userId,
                        'event_details_id' => $eventId ,
                        'payment_amount' => $paymentData[$eventId][$photographerId],
                        'payment_date' => today()
                    ];
                    $payment = EventwisePayment::create($paymentInsertData);
                    $totalPayment[$userId] = ($totalPayment[$userId] ?? 0) + $paymentData[$eventId][$photographerId];
                  
                }

            }
        }
       
       EventDetailsLog::insert($assignData);

               return response()->json(['message' => 'Data Stored Successfully']);

    
    }
    public function assignEventList(){
        if (!check_access("assignevent.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        return view('BackEnd.webcontent.event.assigned_event_list');
    }
    public function assignEventEdit(Request $request,$id){
         if (!check_access("event.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $assignedPhotographer = EventDetailsLog::where('event_details_id',$id)->where('status',1)->get();
        $assignedCinematographer = EventDetailsLog::where('event_details_id',$id)->where('status',2)->get();
        $assignedPhotoEditor = EventDetailsLog::where('event_details_id',$id)->where('status',3)->get();
        $assignedCineEditor = EventDetailsLog::where('event_details_id',$id)->where('status',4)->get();
        $users = User::whereNotIn('type',['super_admin'])->get();
        return view('BackEnd.webcontent.event.assign_event_edit',
        compact('assignedPhotographer','assignedCinematographer',
        'assignedPhotoEditor','assignedCineEditor','users','id'));
    }
    
    //  public function updateAssignEventData(Request $request, $id){
    //     $newPhotographer = $request->photographer?array_values($request->photographer):'';
    //     $oldPhotographer = $request->old_photographer?array_values($request->old_photographer):'';
    //     $photographerNewPayment =  $request->new_payment?array_values($request->new_payment):'';
    //     $photographerOldPayment = $request->old_payment ? array_values($request->old_payment):'';
    //     //  dd($photographerOldPayment);
    //     if($oldPhotographer){
    //       for ($i = 0; $i < count($oldPhotographer); $i++) {
    //         // Check if the old and new photographers are the same
    //         if ($oldPhotographer[$i] == $newPhotographer[$i]) {
    //             // dd('true');
    //             // Update the EventDetailsLog
    //             EventDetailsLog::where('assigned_user_id', $oldPhotographer[$i])
    //                 ->where('event_details_id', $id)
    //                 ->update([
    //                     'assigned_user_id' => $oldPhotographer[$i],
    //                     'event_details_id' => $id,
    //                 ]);
        
    //             // Check if there's a new payment amount
    //             // dd(isset($photographerNewPayment[$i]));
    //                 if (isset($photographerNewPayment[$i])) {
                        
    //                     // dd($photographerNewPayment[$i]);
    //                     EventwisePayment::where('user_id', $oldPhotographer[$i])
    //                         ->where('event_details_id', $id)
    //                         ->update([
    //                             'payment_amount' => $photographerNewPayment[$i]
    //                         ]);
    //                 } else {
    //                     // If there's no new payment amount, consider updating with the old payment amount
    //                     // dd( $photographerOldPayment[$i]);
    //                     if(isset($photographerOldPayment[$i])){
    //                         $t = EventwisePayment::where('user_id', $oldPhotographer[$i])
    //                             ->where('event_details_id', $id)
    //                             ->update([
    //                                 'payment_amount' => $photographerOldPayment[$i]
    //                             ]);  
    //                     }
                          
                        
    //                 }
    //             }
    //         } 
    //     }
        
    //     Toastr::success("Data Updated Successfully");
    //     return redirect()->back();
        
    // }
      public function updateAssignEventData(Request $request, $id){
        $newPhotographer = $request->photographer?array_values($request->photographer):'';
        $oldPhotographer = $request->old_photographer?array_values($request->old_photographer):'';
        $photographerNewPayment =  $request->new_payment?array_values($request->new_payment):'';
        $photographerOldPayment = $request->old_payment ? array_values($request->old_payment):'';
        //  dd($photographerOldPayment);
        if($oldPhotographer){
           for ($i = 0; $i < count($oldPhotographer); $i++) {
            // Check if the old and new photographers are the same
            // if ($oldPhotographer[$i] == $newPhotographer[$i]) {
                // dd('true');
                // Update the EventDetailsLog
                EventDetailsLog::where('assigned_user_id', $oldPhotographer[$i])
                    ->where('event_details_id', $id)
                    ->update([
                        'assigned_user_id' => $oldPhotographer[$i],
                        'event_details_id' => $id,
                    ]);
        
                // Check if there's a new payment amount
                // dd(isset($photographerNewPayment[$i]));
                    if (isset($photographerNewPayment[$i])) {
                        
                        // dd($photographerNewPayment[$i]);
                        EventwisePayment::where('user_id', $oldPhotographer[$i])
                            ->where('event_details_id', $id)
                            ->update([
                                'payment_amount' => $photographerNewPayment[$i]
                            ]);
                    } else {
                        // If there's no new payment amount, consider updating with the old payment amount
                        // dd( $photographerOldPayment[$i]);
                        if(isset($photographerOldPayment[$i])){
                            $t = EventwisePayment::where('user_id', $oldPhotographer[$i])
                                ->where('event_details_id', $id)
                                ->update([
                                    'payment_amount' => $photographerOldPayment[$i]
                                ]);  
                        }
                          
                        
                    }
                // }
            } 
        }
        
        Toastr::success("Data Updated Successfully");
        return redirect()->back();
        
    }

    public function userType(Request $request){
        $user_id = $request->user_id;
        $user = User::where('id',$user_id)->first();
        $category = $user->category;
        return response()->json($category);
    }

     public function deleteAssignUser($id){
        try{
            if (!check_access("assign.user.delete")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $details_data = EventDetailsLog::where('id',$id)->first();
            // dd($details_data);
            $payment_data = EventwisePayment::where(['event_details_id'=>$details_data->event_details_id,'user_id'=>$details_data->assigned_user_id])->first();
     
            if($payment_data){
                $payment_data -> delete(); 
            }
            $details_data->delete();
            // Toastr::success("Deleted Successfully!");
            return response()->json(['message' => 'Data deleted successfully']);
            // return redirect()->back();
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
  
    public function editEvent(Request $requset, $id){
        if (!check_access("event.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $event = EventMaster::where('id',$id)->first();
        $eventDetails = EventDetails::where('master_id',$id)->get();
        $payment = PayMentModel::where('event_id',$id)->first();
        $users = User::whereNot('type','super_admin')->get();
        $package_type=PackageType::all();
        $package_category=PackageCategory::where('status',1)->get();
        $packages = Package::where('status',1)->get();
        $shifts = EventShift::where('status',1)->get();
        $types = EventType::where('status',1)->get();
        $districts = District::where('status',1)->get();
        return view('BackEnd.webcontent.event.editEvent',compact('event','eventDetails','payment','users','package_type'
        ,'package_category','packages','shifts','types','districts'));
    }
 
     public function updateEvent(Request $request, $id){
        // return $request->all();
        $eventMaster = EventMaster::find($id);
        $bride_name = $request->bride_name;
        $groom_name = $request->groom_name;
        $eventDetailsData =[] ;
        $eventTypes = $request->type;
        $log = '';
        if( $eventMaster->bride_name !=  $bride_name){
            $log .= 'Bride Name :'.$bride_name.'<br>';
        }
        if( $eventMaster->groom_name !=  $groom_name){
            $log .= "Groom Name :".$bride_name.'<br>';
        }
        if( $eventMaster->delivery_date !=  $request->delivery_date){
            $log .= "Previous Delivery Date :".$eventMaster->delivery_date."---- Updated Delivery Date :".$request->delivery_date .'<br>';
        }
        if( $eventMaster->instructions !=  $request->instructions){
            $log .= "Previous Instructions :".$eventMaster->instructions."---- Updated Instructions :".$request->instructions .'<br>';
        }
        foreach($eventTypes as $eventId => $value){
            if ($request->has('backup') && isset($request->backup[$eventId])) {
                $backupData = $request->backup[$eventId];
                foreach ($backupData as $value) {
                    if($value !== null)
                    FootageBackup::create([
                        'event_details_id' => $eventId,
                        'footage_backup' => $value
                    ]);
                }
            }
            $startTime =$request->start_time[$eventId];
            $carbonStTime = Carbon::parse($startTime);
            $formattedStartTime = $carbonStTime->format('H:i:s');
            $endTime =$request->end_time[$eventId];
            $carbonenTime = Carbon::parse($endTime);
            $formattedEndTime = $carbonenTime->format('H:i:s');
            $eventDetail = EventDetails::where('master_id',$id)->where('id',$eventId)->first();
            if($eventDetail->shift_id != $request->shift[$eventId] ||$eventDetail->district_id != $request->district[$eventId] ||$eventDetail->category_id != $request->category[$eventId]
            || $eventDetail->package_id != $request->package[$eventId] || $eventDetail->transportation != $request->transportation[$eventId] || $eventDetail->accomodation != $request->accommodation[$eventId]
            || $request->packageprice[$eventId] && $eventDetail->package_price != $request->packageprice[$eventId] || $eventDetail->date != $request->date[$eventId]||$eventDetail->venue != $request->venue[$eventId]
            ||$eventDetail->start_time !=  $formattedStartTime || $eventDetail->end_time !=  $formattedEndTime ||$eventDetail->add_ons !=  $request->add_ons[$eventId] ){
                $log .= "Event Previous details for ".$eventId." No.event-".'<br>';
            }
            if($eventDetail->shift_id != $request->shift[$eventId]){
                $shift = EventShift::where('id',$request->shift[$eventId])->first();
                $log .= "Previous Event Shift:". $eventDetail->shift->shift_name." <br> Updated Event Shift:".$shift->shift_name .'<br><br>';
            }
            if($eventDetail->district_id != $request->district[$eventId]){
                $district  = District::where('id',$request->district[$eventId])->first();
                $log .= "Previous Event District:". $eventDetail->dictrict->dictrict." <br>  Updated Event District:".$district->district .'<br>';
            }
            if($eventDetail->category_id != $request->category[$eventId]){
                $category  = PackageCategory::where('id',$request->category[$eventId])->first();
                $log .= "Previous Package :". $eventDetail->category->category_name."<br> Updated Package :".$category->category_name .'<br>';
            }
            if($eventDetail->package_id != $request->package[$eventId]){
                $package  = Package::where('id',$request->package[$eventId])->first();
                $log .= "Previous Package Details :". $eventDetail->package->name."<br> Updated Package Details:".$package->name.'<br>';
            }
            if( $request->transportation[$eventId] && $eventDetail->transportation != $request->transportation[$eventId]){
                $log .= "Previous Transportation:". $eventDetail->transportation." <br>Updated Transportation:".$request->transportation[$eventId].'<br>';
            }
            if($eventDetail->accomodation != $request->accommodation[$eventId]){
                $log .= "Previous Accomodation Charge:". $eventDetail->accomodation." <br>Updated Accomodation Charge:".$request->accommodation[$eventId].'<br>';
            }
            if($request->shiftcharge[$eventId] && $eventDetail->shift_charge != $request->shiftcharge[$eventId]){
                $log .= "Previous Shift Charge:". $eventDetail->shift_charge."<br>Updated Shift Charge:".$request->shiftcharge[$eventId].'<br>';
            }
            if( $request->packageprice[$eventId] && $eventDetail->package_price != $request->packageprice[$eventId]){
                $log .= "Previous Package Price:". $eventDetail->package_price."<br>Updated Package Price:".$request->packageprice[$eventId].'<br>';
            }
            if($eventDetail->date != $request->date[$eventId]){
                $log .= "Previous Event Date:". $eventDetail->date."<br>Updated Event Date:".$request->date[$eventId].'<br>';

            }
            if($eventDetail->venue != $request->venue[$eventId]){
                $log .= "Previous Event Venue:". $eventDetail->venue."<br>Updated Event Venue:".$request->venue[$eventId].'<br>';
            }
            if($eventDetail->start_time !=  $formattedStartTime || $eventDetail->end_time !=  $formattedEndTime){
                $log .= "Previous Event Time:". $eventDetail->start_time.'-'. $eventDetail->end_time ." <br>Updated Event Time:". $formattedStartTime.'-'.$formattedEndTime.'<br>';
            }
            if($eventDetail->add_ons !=  $request->add_ons[$eventId]){
                $log .= "Previous Add Ons:". $eventDetail->add_ons."<br>Updated Add Ons:". $request->add_ons[$eventId].'<br>';
            }
            
            EventDetails::where('master_id',$id)->where('id',$eventId)->update([
                'type_id'        => $request->type[$eventId],
                'shift_id'       => $request->shift[$eventId],
                'district_id'    => $request->district[$eventId],
                'category_id'    => $request->category[$eventId],
                'package_id'     => $request->package[$eventId],
                'transportation' => $request->transportation[$eventId],
                'accomodation'   => $request->accommodation[$eventId],
                'shift_charge'   => $request->shiftcharge[$eventId],
                'package_price'  => $request->packageprice[$eventId],
                'date'           => $request->date[$eventId],
                'venue'          => $request->venue[$eventId],
                'add_ons'        => $request->add_ons[$eventId],
                'start_time'     =>  $formattedStartTime,
                'end_time'       => $formattedEndTime,
            ]);
        }

        $eventMaster->update([
            'bride_name'  => $bride_name,
            'groom_name'  => $groom_name,
            'delivery_date' => $request->delivery_date,
            'instructions' => $request->instructions,
            'office_instructions' => $request->office_instructions
        ]);

        $payment = PayMentModel::where('event_id',$id)->first();

        if( $payment->payment_amount != $request->totalPrice){
            $log .= "Previous Payment : ".$payment->payment_amount."<br>Updated Payment: ".$request->totalPrice.'<br>';
        }
        if($payment->advance != $request->advance){
            $log .= "Previous Paid Amount: ".$payment->advance."<br>Updated Paid Amount: ".$request->advance.'<br>';
        }
        if($payment->due_amount != $request->due){
            $log .= "Previous Due : ".$payment->due_amount."<br>Updated Due: ".$request->due.'<br>';
        }

        $payment->update([
                'payment_amount' => $request->totalPrice,
                'advance'        => $request->advance,
                'due_amount'     =>  $request->due,
            ]);
            // $paymentHistory = [];
            // dd($request->payment_date);
        if(isset($request->payment_amount) && isset($request->payment_date) && isset($request->payment_method) != null ){
            for($i = 1; $i<= count($request->payment_amount); $i++){
                $paymnetlog = Paymentlog::create([
                    'payment_id'      => $payment->id,
                    'amount'          => $request->payment_amount[$i],
                    'payment_date'    => $request->payment_date[$i],
                    'payment_method'  => $request->payment_method[$i],
                    'transaction_id'  => $request->transaction_id[$i],
                ]);
                
                $data['email'] = $eventMaster->client->email;
                $data['booking_id'] = $eventMaster->booking_id;
                $data['event'] = $eventMaster;
                $data['paymnetlog'] = $paymnetlog;
                $data['randomNumber'] = rand(0, 999999);
                 $data['paymnent'] = $payment;
                $data['title'] = 'Payment Slip';
                $pdf = PDF::loadView('BackEnd.webcontent.event.payment_slip', $data);

                Mail::send('payment_slip', $data, function($message)use($data, $pdf) {
                    $message->to($data["email"], $data["email"])
                            ->subject($data["title"])
                            ->attachData($pdf->output(),"payslip.pdf");
                });

                if($paymnetlog){
                    $log .= "Payment History ".$i.": '<br>'Amount : ".$paymnetlog->amount."'<br>'Date:".$paymnetlog->payment_date."'<br>'Method:".$paymnetlog->payment_method."'<br>'Transaction No /Bank :".$paymnetlog->transaction_id;
                }  
            }
        }

        if($log != ''){
            ActivityLog::create([
                'master_id' => $id,
                'log' => $log,
                'created_by' => auth()->user()->id,
            ]);
        }
        

        Toastr::success('Event data Upadted Successfully');
        return redirect()->back();
        

        // for ($i = 0; $i < $totalEvent; $i++) {
        //     $eventInfo = EventDetails::where('master_id',$id)->first();
        // }
    }
    
    public function invoice($id){
        $data['event'] = EventMaster::find($id);
        $data["email"] = $data['event']->client->email;
        $data["title"] = "Client Invoice";
        $data['booking_id'] = $data['event']->booking_id;
  
        $pdf = PDF::loadView('BackEnd.webcontent.event.invoice', $data);
  
        Mail::send('invoice_message', $data, function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "invoice.pdf");
        });
        Toastr::success('Invoice Sent Successfully');

        return redirect()->back();

        // return view('BackEnd.webcontent.event.invoice',compact('event'));
    }

    public function deleteFootage($id){
        try{
            if (!check_access("event.delete")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $data = FootageBackup::find($id);
            $data -> delete();
            Toastr::success("Deleted Footage Backup link!");
            return redirect()->back();
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

           public function eventstatusUpdate(Request $request, $id){
        // dd($id);
        // try{
            if (!check_access("event.status")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $event = EventDetails::find($id);
            $client_phone_number = $event->event->client->primary_no;
            $message = 'This is a demo';
            $status = [
                'status' => $request->status
            ];

            if($request->status == 1){
                $message = "Dear Sir Your Booking is confirmed Booking ID-". $event->event->booking_id .". You Book for ".$event->type->type_name.". Your Event Date is ".date('d/m/Y',strtotime($event->date)).".";
                send_sms($client_phone_number,$message);
                $master = EventMaster::where('id',$event->master_id)->update([
                "master_status" => 1
                ]);
            }
            if($request->status == 3){
                $to = $event->event->client->email;
                $subject = 'Raw Ready For Delivery';
                $data = [ 
                    'booking_id' => $event->event->booking_id,
                    'event_date' => $event->date,
                    'venue'      => $event->venue,
                ];

                Mail::send('raw_ready',$data, function ($message) use ($to, $subject) {
                    $message->to($to)->subject($subject);
                });
                $message_body = "Your Booking ID-".$event->event->booking_id." And Event Date-".date('d/m/Y',strtotime($event->date))." Photos & Video is ready for delivery. Please Collect it from our office. ".
                            "Please bring Pendrive/Hard Drive. After getting all Raw Photos please select photos for Editing. ".
                            "For any other query Contact with us : +88 0177171 1590 or +88 0174222 5584";
                send_sms($client_phone_number,$message_body);  
            }
            if($request->status== 4){
                $event->selection_date = date('d/m/Y');
                $event->update();
                $to = $event->event->client->email;
                $subject = 'Selection Given';
                $data = [ 
                    'booking_id' => $event->event->booking_id,
                    'event_date' => $event->date,
                    'venue'      => $event->venue,
                    'delivery_date' =>$event->event->delivery_date
                ];

                Mail::send('selection_given',$data, function ($message) use ($to, $subject) {
                    $message->to($to)->subject($subject);
                });
            }

            if($request->status== 5){
                $to = $event->event->client->email;
                $subject = 'Final Delivery';
                $data = [ 
                    'booking_id' => $event->event->booking_id,
                    'event_date' => $event->date,
                    'venue'      => $event->venue,
                ];

                Mail::send('ready_for_delivery_mail',$data, function ($message) use ($to, $subject) {
                    $message->to($to)->subject($subject);
                });
                
                $message_body ="Dear Sir,".
                            " Your Booking Id-".$event->event->booking_id." Event Date ". $event->date .", Event Venue  ".$event->venue ." Products are ready for delivery. Please Collect it from our office. For any other query Contact with us : +88 0177171 1590 or +88 0174222 5584";
                send_sms($client_phone_number,$message_body); 
            }
            
            if($request->status== 6){
                 $to = $event->event->client->email;
                 $subject = 'Delivered';
                $data = [ 
                    'booking_id' => $event->event->booking_id,
                    'event_date' => $event->date,
                    'venue'      => $event->venue,
                ];

                Mail::send('delivered',$data, function ($message) use ($to, $subject) {
                    $message->to($to)->subject($subject);
                });
                
                $master = EventMaster::where('id',$event->master_id)->update([
                    "master_status" => 2
                    ]);
            
                
            }
            
                if($request->status == 7){
                 $to = $event->event->client->email;
                 $subject = 'Raw Delivered';
                $data = [ 
                    'booking_id' => $event->event->booking_id,
                    'event_date' => $event->date,
                    'venue'      => $event->venue,
                ];

                Mail::send('raw_delivered',$data, function ($message) use ($to, $subject) {
                    $message->to($to)->subject($subject);
                });
                
            }
            $event->update($status);
            // send_sms($client_phone_number,$message);
            // Toastr::success('Status Upadted Successfully');
            // Session::flash('success_message', 'Status Updated Successfully');

            return response()->json(['message' => 'Status updated successfully']);
        // }catch (\Exception $e) {
        //     return $e->getMessage();
        // }
    }

    // public function deleteMaster($id){
    //     try{
    //         if (!check_access("event.delete")) {
    //             Toastr::error("You don't have permission!");
    //             return redirect()->route('admin.index');
    //         }
    //         $data = EventMaster::find($id);
    //         $data -> delete();
    //         Toastr::success("Deleted Successfully!");
    //         return redirect()->back();
    //     }catch (\Exception $e) {
    //         return $e->getMessage();
    //     }
    // }
    
      public function deleteMaster($id){
        try{
            if (!check_access("event.delete")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $data = EventMaster::find($id);
            $details = EventDetails::where('master_id',$id)->get();
            foreach($details as $detail){
                $detail->delete();
            }
            $data -> delete();
            // Toastr::success("Deleted Successfully!");
            return response()->json(['message' => 'Data deleted successfully']);
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function filterPackage(Request $request)
    {
        $category_id = $request->category_id;
        // dd($category_id);
        $packages = Package::where('package_category_id', $category_id)->get();
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


    public function clientIndex(){
        if (!check_access("client.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        return view('BackEnd.webcontent.event.manageClient');
    }

    public function getAllClient(){
        if (!check_access("client.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $clients = Client::all();
        return DataTables::of($clients)
        ->addIndexColumn()
        ->setRowId(function($client){return $client->id;})
        ->setRowAttr([
            'align' => 'center',
        ])
        ->addColumn('name',function($client){
           $name = $client->name;
           return  $name ;
        })
        ->addColumn('email',function($client){
           $email = $client->email;
           return  $email ;
        })
        ->addColumn('address',function($client){
           $address = $client->address;
           return  $address ;
        })
        ->addColumn('phone',function($client){
           $phone = '
                <strong>Phone :</strong>' . $client->primary_no. ' <br>
                <strong>Alternate No:</strong> '.$client->alternate_no.' <br>'; 

           return  $phone ;
        })
        ->addColumn('action', function ($list) {

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

            return  $delete ;
        })

        ->rawColumns(['name','email','address','phone','action'])
        ->make(true);
        
    }

   

    // public function getAssignedList(Request $request){
    //     if (!check_access("assignevent.list")) {
    //         Toastr::error("You don't have permission!");
    //         return redirect()->route('admin.index');
    //     }
    //      $fromDate = $request->input('from_date');
    //     $toDate = $request->input('to_date');
    
        
    // $query = EventDetailslog::query();
    // $query->join('event_details', 'event_details.id', '=', 'event_details_pivot.event_details_id');
    // if ($fromDate && $toDate) {
    //     $query->whereBetween('created_at', [$fromDate, $toDate]);
    // }
    // $query->whereNotNull('event_details_pivot.event_details_id');
    // $query->whereNotNull('event_details.id');

    // $assignedEventList = $query->get()->groupBy('event_details_id');

    // $assignedEventList = $query->get()->groupBy('event_details_id');
    // dd($assignedEventList);
        
    //     return DataTables::of($assignedEventList)
    //     ->addIndexColumn()
    //     ->setRowAttr([
    //         'align' => 'center',
    //     ])
    //     ->addColumn('event_info',function($list){
    //         foreach($list as $ev_list){
    //             $event_info = '
    //             <strong>Event :</strong>' . $ev_list->eventDetail->type->type_name. ' <br>
    //             <strong>Event Date:</strong> '.$ev_list->eventDetail->date.' <br>
    //             <strong>Event Shift:</strong>'. $ev_list->eventDetail->shift->shift_name .'<br>
    //             <strong>Package :</strong>'. $ev_list->eventDetail->category->category_name .'<br>
    //             <strong>Package Details:</strong>'. $ev_list->eventDetail->package->name .'<br>
    //         ';
    //         }
           
    //         return  $event_info ;
    //     })
    //     ->addColumn('assigned_photographer',function($list){
    //         $assigned_photographer = [];
    //         foreach($list as $ev_list){
    //             if($ev_list->status == 1){
    //                 $assigned_photographer[] = $ev_list->user->name  ;
    //                 // echo "\n";
                    
    //             }
               
    //         }
    //         $html = '<div>' . implode('<br>', $assigned_photographer) . '</div>';
    //         return  $html;
    //     })
    //     ->addColumn('assigned_cinematographer',function($list){
    //         $assigned_cinematographer = [];
    //         foreach($list as $ev_list){
    //             if($ev_list->status == 2){
    //                 $assigned_cinematographer[]  = $ev_list->user->name;
    //             }
    //         }
    //         $html = '<div>' . implode('<br>', $assigned_cinematographer) . '</div>';
    //       return  $html ;
    //     })
    //     ->addColumn('assigned_photoeditor',function($list){
    //         $assigned_photoeditor = [];
    //         foreach($list as $ev_list){
    //             if($ev_list->status == 3){
    //                 $assigned_photoeditor[]  = $ev_list->user->name ;
    //             }
    //         }
    //         $html = '<div>' . implode('<br>', $assigned_photoeditor) . '</div>';
    //       return  $html ;
          
    //     })
    //     ->addColumn('assigned_cineeditor',function($list){
    //         $assigned_cineeditor = [];
    //         foreach($list as $ev_list){
    //             if($ev_list->status == 4){
    //                 $assigned_cineeditor[]  = $ev_list->user->name;

    //             }
    //         }

    //         $html = '<div>' . implode('<br>', $assigned_cineeditor) . '</div>';
    //       return  $html ;
          
    //     })
    //     ->addColumn('action', function ($list) {
    //         foreach($list as $n_list){
    //             $edit = '<a href="'.route('assign.edit',$n_list->event_details_id).'" style="padding:2px; margin-left:3px"
    //                 class="btn btn-xs btn-primary btn-sm mr-1">
    //                 <svg width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
    //             </a>';

    //             $delete = '<a href=""
    //             onclick="return confirm("Are you sure you want to delete?");"
    //             style="padding: 2px; margin-left:3px;" class="delete btn btn-xs btn-danger btn-sm mr-1"><svg
    //             width="16" height="14" viewBox="0 0 24 24" fill="none"
    //             stroke="currentColor" stroke-width="2" stroke-linecap="round"
    //             stroke-linejoin="round" class="feather feather-trash-2">
    //             <polyline points="3 6 5 6 21 6"></polyline>
    //             <path
    //                 d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
    //             </path>
    //             <line x1="10" y1="11" x2="10" y2="17"></line>
    //             <line x1="14" y1="11" x2="14" y2="17"></line>
    //         </svg></a>';
    //         }
            
           

    //         return  $edit.$delete ;
    //     })

    //     ->rawColumns(['event_info','assigned_photographer','assigned_cinematographer','assigned_photoeditor','assigned_cineeditor','action'])
    //     ->make(true);
    // }
    
    
    public function getAssignedList(Request $request){
        if (!check_access("assignevent.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
    
        
    $query = EventDetailslog::query();
    $query->join('event_details', 'event_details.id', '=', 'event_details_pivot.event_details_id');
    $query->join('event_masters', 'event_details.master_id', '=', 'event_masters.id');

    if ($fromDate && $toDate) {
        $query->whereBetween('event_details.date', [$fromDate, $toDate]);
    }
    $query->whereNotNull('event_details_pivot.event_details_id');
    $query->whereNotNull('event_details.id');
    $query->whereNotNull('event_masters.id');

    $query->select('event_details_pivot.*');
    $assignedEventList = $query->orderBy('id','desc')->get()->groupBy('event_details_id');

        return DataTables::of($assignedEventList)
        ->addIndexColumn()
        ->setRowAttr([
            'align' => 'center',
        ])
        ->addColumn('event_info',function($list){
            foreach($list as $ev_list){
                $event_info = '
                <strong>Event :</strong>' . $ev_list->eventDetail->type->type_name. ' <br>
                <strong>Venue:</strong>' . $ev_list->eventDetail->venue. ' <br>
                <strong>Event Date:</strong> '.$ev_list->eventDetail->date.' <br>
                <strong>Event Shift:</strong>'. $ev_list->eventDetail->shift->shift_name .'<br>
                <strong>Package :</strong>'. $ev_list->eventDetail->category->category_name .'<br>
                <strong>Package Details:</strong>'. $ev_list->eventDetail->package->name .'<br>
            ';
            }
           
            return  $event_info ;
        })
        ->addColumn('assigned_photographer',function($list){
            $assigned_photographer = [];
            foreach($list as $ev_list){
                if($ev_list->status == 1){
                    $assigned_photographer[] = $ev_list->user->name  ;
                    // echo "\n";
                }
            }
            $html = '<div>' . implode('<br>', $assigned_photographer) . '</div>';
            return  $html;
        })
        ->addColumn('assigned_cinematographer',function($list){
            $assigned_cinematographer = [];
            foreach($list as $ev_list){
                if($ev_list->status == 2){
                    $assigned_cinematographer[]  = $ev_list->user->name;
                }
            }
            $html = '<div>' . implode('<br>', $assigned_cinematographer) . '</div>';
          return  $html ;
        })
        ->addColumn('assigned_photoeditor',function($list){
            $assigned_photoeditor = [];
            foreach($list as $ev_list){
                if($ev_list->status == 3){
                    $assigned_photoeditor[]  = $ev_list->user->name ;
                }
            }
            $html = '<div>' . implode('<br>', $assigned_photoeditor) . '</div>';
          return  $html ;
          
        })
        ->addColumn('assigned_cineeditor',function($list){
            $assigned_cineeditor = [];
            foreach($list as $ev_list){
                if($ev_list->status == 4){
                    $assigned_cineeditor[]  = $ev_list->user->name;

                }
            }

            $html = '<div>' . implode('<br>', $assigned_cineeditor) . '</div>';
          return  $html ;
          
        })
        ->addColumn('action', function ($list) {
            foreach($list as $n_list){
                $edit = '<a href="'.route('assign.edit',$n_list->event_details_id).'" style="padding:2px; margin-left:3px"
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
            }
            
           

            return  $edit.$delete ;
        })

        ->rawColumns(['event_info','assigned_photographer','assigned_cinematographer','assigned_photoeditor','assigned_cineeditor','action'])
        ->make(true);
    }

   
}
