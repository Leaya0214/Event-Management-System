<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackEnd\Client;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Yoeunes\Toastr\Facades\Toastr;



class ClientController extends Controller
{
    
    public function clientIndex(){
        if (!check_access("client.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        return view('BackEnd.webcontent.client.manageClient');
    }

    public function getAllClient(){
        if (!check_access("client.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $clients = Client::where('status',1)->orderByDesc('id')->get();
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
            $edit = '';
            $delete = '';
            if (check_access("client.edit")) {
                $edit = '<a href="'.route('client-edit',$list->id).'" style="padding:2px;  margin-left:3px; "
                                class="btn btn-xs btn-primary btn-sm mr-1">
                                <svg width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </a>';
            }
         if (check_access("client.delete")) {
            $delete = '<a href="'.route('client-inactive',$list->id).'"
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
            return  $edit.$delete;
        })

        ->rawColumns(['name','email','address','phone','action'])
        ->make(true);
        
    }
    
    public function editClient($id){
        if (!check_access("client.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $client = Client::find($id);
        return view('BackEnd.webcontent.client.edit',compact('client'));
    }
    
    public function updateClient(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'primary_no' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        
        $client  = Client::find($id);
        
         $client->update([
            'name' => $request['name'],
            'address' => $request['address'],
            'email' => $request['email'],
            'password' => $request['password'],
            'primary_no' => $request['primary_no'],
            'alternate_no' => $request['alternate_no'],
        ]);
        Toastr::success("Client Data Updated Successfully !");

        return redirect()->back();
    }
    
    public function clientstatusInactive($id){
        try{
            if (!check_access("client.delete")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $status = Client::find($id);
            if($status->status == 1){
                $status->status = 2;
                Toastr::success("Data Removed!");
            }
            
            $status->update();
            return redirect()->back();
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
}
