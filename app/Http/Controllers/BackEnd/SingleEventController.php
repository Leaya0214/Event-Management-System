<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\EventDetails;
use App\Models\BackEnd\FootageBackup;
use Yajra\DataTables\Contracts\DataTable;

class SingleEventController extends Controller
{
    public function index(){
        if (!check_access("single.event.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        return view('BackEnd.webcontent.single_event.single_event_list');
    }

    public function getAllSingleEvent(Request $request){
        if (!check_access("single.event.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $query = EventDetails::orderByDesc('date');

        if ($fromDate && $toDate) {
            $query->whereBetween('date', [$fromDate, $toDate]);
        }

        $events = $query->get();

        return DataTables::of($events)
        ->addIndexColumn()
        ->setRowId(function($event){return $event->id;})
        ->setRowAttr([
            'align' => 'center',
        ])
        ->addColumn('date',function($event){
            $date = $event->date;
            return  $date ;
         })
         ->addColumn('venue',function($event){
            $venue = $event->venue;
            return  $venue ;
         })
         ->addColumn('footage',function($event){
            $footage_backups = FootageBackup::where('event_details_id',$event->id)->get();
            $event_info = '' ;

            foreach($footage_backups as $backup){
                $event_info = '<strong>'.$backup->footage_backup. ' </strong> <br>';
            }
            return  $event_info ;
         })
         ->rawColumns(['date','venue','footage'])

        ->make(true);
    }
}
