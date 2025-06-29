<?php

namespace App\Http\Controllers;

use App\Models\SendSms;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yoeunes\Toastr\Facades\Toastr;

class SendsmsController extends Controller
{
    public function sendSms(){
        return view('BackEnd.sms');
    }

    public function storeSms(Request $request){
        // return $request->all();
        $mobile_no = $request->mobile_no;
        $message = $request->message;
        SendSms::create([
            'mobile_no' => $mobile_no,
            'message' => $message,
        ]);

        // send_sms($mobile_no,$message);
        Toastr::success('Message Send Successfully');
        return redirect()->back();
    }
     public function getAllsms(){
        $messages = SendSms::orderByDesc('id')->get();
        return DataTables::of( $messages)
        ->addIndexColumn()
        ->setRowId(function ($message) {
                return $message->id; })
        ->setRowAttr([
                'align' => 'center',
            ])
         ->addColumn('phone', function ($message) {
                $phone = $message->mobile_no;
                return $phone;
        })
        ->addColumn('message', function ($message) {
                $message = $message->message;
                return $message;
        })
        ->addColumn('action', function ($message) {
            $delete = '<a href="' . route('sms-delete', $message->id) . '"
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
        return $delete;
        })
        ->rawColumns(['phone', 'message','action'])
        ->make(true);

    }

    public function delete($id){
        $sms = SendSms::find($id);
        $sms->delete();
        Toastr::success('Sms Deleted Successfully');
        return redirect()->back();
    }
}
