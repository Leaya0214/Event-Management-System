<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\BackEnd\Slider;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function index(){
        if (!check_access("slider.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $sliders = Slider::get();
        return view('BackEnd.webcontent.slider',compact('sliders'));
    }

    public function storeSlider(Request $request){
        if (!check_access("slider.create")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
    $validator = Validator::make($request->all(),[
            'image' =>'required',
            'position'  => 'required'
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
             
            $destination_path = "backend/slider/"; 
            $file->move($destination_path,$image_name); 
        }else{ 
            $image_name=""; 
        }

        $data = [
            'image' => $image_name,
            'position' => $request['position'],
            'status' => 1
        ];

        // dd($data );

        Slider::insert($data);

        Toastr::success("New Slider Added !");

        return redirect()->route('slider');

        
    }

    public function updateSlider(Request $request, $id){
        if (!check_access("slider.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $slider = Slider::findOrFail($id);

        
        if($request->hasFile('image')){
            $path = public_path() . "backend/slider/" . $slider->image;
            if (file_exists($path)) { 
                unlink($path); 
            }  
            $file = $request->file('image'); 
            $image_enc_name = rand(0,9999).time().md5($file->getClientOriginalName()); 
            $image_extension = $file->getClientOriginalExtension(); 
            $slider_image = $image_enc_name.".".$image_extension; 
             
            $destination_path = "backend/slider/"; 
            $file->move($destination_path,$slider_image); 
        }else{
          $slider_image = $slider->image;
        }

        $data = [
            'image' => $slider_image,
            'position' => $request['position'],
            'status' => 1
        ];

        // dd($data );

        $slider->update($data);

        Toastr::success("Updated Slider data !");

        return redirect()->route('slider');
 
    }

    public function statusUpdate($id){
        try{
            if (!check_access("slider.delete")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $status = Slider::find($id);
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

    public function deleteSlider($id){
        try{
            if (!check_access("slider.delete")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $slider = Slider::find($id);
            $slider -> delete();
            Toastr::success("Deleted Successfully!");
            return redirect()->back();
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
