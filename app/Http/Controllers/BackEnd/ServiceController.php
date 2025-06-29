<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\BackEnd\Service;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index(){
        if (!check_access("service.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $services = Service::get();
        return view('BackEnd.webcontent.service.service',compact('services'));
    }
    public function addService(){
        if (!check_access("service.create")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        if (!check_access("service.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        return view('BackEnd.webcontent.service.addservice');
    }

    public function storeService(Request $request){
        if (!check_access("service.create")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $validator = Validator::make($request->all(),[
            'image'     => ['required', 'mimes:jpeg,png,jpg,gif,svg,mp4,mp3'],
        ]);

        if($validator->fails()){
            Toastr::error("Invalid Data given!");
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if($request->hasFile('image')){ 
            $file = $request->file('image'); 
            $image_enc_name = rand(0,9999).time().md5($file->getClientOriginalName()); 
            $image_extension = $file->getClientOriginalExtension(); 
            $image_name = $image_enc_name.".".$image_extension; 
             
            $destination_path = "backend/service/"; 
            $file->move($destination_path,$image_name); 
        }else{ 
            $image_name=""; 
        }

        $data = [
            'image_video' => $image_name,
            'title' => $request['title'],
            'description' => $request['description'],
            'status' => 1
        ];

        // dd($data );

        Service::insert($data);

        Toastr::success("New Service Added !");

        return redirect()->route('service');

        
    }

    public function edit($id){
        if (!check_access("service.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $service = Service::where('id',$id)->first();
        return view('BackEnd.webcontent.service.editservice',compact('service'));
    }
   
    public function updateService(Request $request, $id){
        if (!check_access("service.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }

        $service = Service::findOrFail($id);

        $service_image = $service->image_video;

        if($request->hasFile('image')){
            $path = public_path() . "backend/service/" . $service->image;
            if (file_exists($path)) { 
                unlink($path); 
            }  
            $file = $request->file('image'); 
            $image_enc_name = rand(0,9999).time().md5($file->getClientOriginalName()); 
            $image_extension = $file->getClientOriginalExtension(); 
            $service_image = $image_enc_name.".".$image_extension; 
            $destination_path = "backend/service/"; 
            $file->move($destination_path,$service_image); 
        }

        $data = [
            'image_video' => $service_image,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 1
        ];

        // dd($data );

        $service->update($data);

        Toastr::success("Updated Service data !");

        return redirect()->route('service');
 
    }

    public function statusUpdate($id){
        try{
            if (!check_access("service.delete") || !check_access("service.edit")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $status = Service::find($id);
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

    public function delete($id){
        try{
            if (!check_access("service.delete")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $systemData = Service::find($id);
            $systemData -> delete();
            Toastr::success("Deleted Successfully !!");
            return redirect()->back();
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
