<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\BackEnd\Package;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\Client;
use App\Models\BackEnd\EventDetails;
use App\Models\BackEnd\EventDetailsLog;
use App\Models\BackEnd\EventMaster;
use App\Models\BackEnd\StaffPayment;

class DashboardController extends Controller
{
    public function index(){
        $event    = EventDetails::count();
        $activeevent    = EventDetails::where('status',1)->count();
        $pendingevent    = EventDetails::where('status',0)->count();
        $deliverevent    = EventDetails::where('status',6)->count();
        $client   = Client::count();
        $package  = Package::count();

        return view('BackEnd.dashboard',compact('event','client','package','activeevent','pendingevent','deliverevent'));
    }
    public function stuffDashboard(){
        $user = User::where('id',auth()->user()->id)->first();
        $payment = StaffPayment::where('user_id',auth()->user()->id)->first();
        $events = EventDetailsLog::where('assigned_user_id',$user->id)->get();
        $total_event = count($events);
        return view('BackEnd.stuff_dashboard', compact('user','payment','total_event'));
    }
}
