<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\SystemSetting;
use Illuminate\Support\Facades\Validator;

class SystemSettingController extends Controller
{
    public function index(){
        $system  = SystemSetting::orderBy('id','DESC')->first();
        return view('BackEnd.webcontent.system_setting',compact('system'));
    }

    // public function addSystemInfo(){
    //     return view('BackEnd.pages.systemsetting.add_system_info');
    // }

    public function storeSystemInfo(Request $request){
        // try{
        
            if($request->hasFile('logo')){ 
                $file = $request->file('logo'); 
                $image_enc_name = rand(0,9999).time().md5($file->getClientOriginalName()); 
                $image_extension = $file->getClientOriginalExtension(); 
                $logo_name = $image_enc_name.".".$image_extension; 
                $destination_path = "backend/system_setting/"; 
                $file->move($destination_path,$logo_name); 
            }else{ 
                $logo_name=""; 
            }

            if($request->hasFile('favicon')){ 
                $file = $request->file('favicon'); 
                $image_enc_name = rand(0,9999).time().md5($file->getClientOriginalName()); 
                $image_extension = $file->getClientOriginalExtension(); 
                $favicon = $image_enc_name.".".$image_extension; 
                $destination_path = "backend/system_setting/"; 
                $file->move($destination_path, $favicon); 

            }else{ 
                $favicon=""; 
            }

            if($request->hasFile('website_banner')){ 
                $file = $request->file('website_banner'); 
                $image_enc_name = rand(0,9999).time().md5($file->getClientOriginalName()); 
                $image_extension = $file->getClientOriginalExtension(); 
                $banner = $image_enc_name.".".$image_extension; 
                 
                $destination_path = "backend/system_setting/"; 
                $file->move($destination_path, $banner); 
            }else{ 
                $banner=""; 
            }

            $inputs = [
                'name' => $request->input('name'),
                'title' => $request->input('title'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'logo' => $logo_name,
                'favicon' => $favicon,
                'office_address' => $request->input('office_address'),
                'website_link' => $request->input('website_link'),
                'map_link' => $request->input('map_link'),
                'copy_right' => $request->input('copyright'),
                'website_banner' => $banner,
                'fb_link' => $request->input('facebook_link'),
                'instagram_link' => $request->input('instagram_link'),
                'twitter_link' => $request->input('twitter_link'),
                'you_tube_link' => $request->input('you_tube_link'),
                'meta_tag_author' => $request->input('meta_author'),
                'meta_tag_name' => $request->input('meta_tag_name'),
                'meta_tag_description' => $request->input('meta_description'),
                'status' =>1
            ];

            // dd($inputs);

            SystemSetting::create($inputs);

            toastr()->info('notification message?');
            return redirect()->route('system.setting');

        // }catch(\Exception $e){
        //     return $e->getMessage();
        // }
        
    }

    public function updateInfo(Request $request, $id){

        $infoData = SystemSetting::findOrFail($id);

        $logo_name = $infoData->logo;
        $favicon = $infoData->favicon;
        $banner = $infoData->website_banner;

        // dd($request->hasFile('logo'));

        if($request->hasFile('logo')){ 
            $path = public_path() . "backend/system_setting/" . $infoData->logo;
            if (file_exists($path)) { 
                unlink($path); 
            } 
            $file = $request->file('logo'); 
            $imageEncName = rand(0,9999).time().md5($file->getClientOriginalName()); 
            $imageExtension = $file->getClientOriginalExtension(); 
            $logo_name = $imageEncName.".".$imageExtension; 
            $destinationPath = "backend/system_setting/";
            $file->move($destinationPath, $logo_name); 
        }


        if($request->hasFile('favicon')){ 
            $path = public_path() . "backend/system_setting/" . $infoData->favicon;
            if (file_exists($path)) { 
                unlink($path); 
            } 
            $file = $request->file('favicon'); 
            $imageEncName = rand(0,9999).time().md5($file->getClientOriginalName()); 
            $imageExtension = $file->getClientOriginalExtension(); 
            $favicon = $imageEncName.".".$imageExtension; 
            $destinationPath = "backend/system_setting/";
            $file->move($destinationPath, $favicon); 
        }

        if($request->hasFile('website_banner')){ 
            $path = public_path() . "backend/system_setting/" . $infoData->website_banner;
            if (file_exists($path)) { 
                unlink($path); 
            } 
            $file = $request->file('website_banner'); 
            $imageEncName = rand(0,9999).time().md5($file->getClientOriginalName()); 
            $imageExtension = $file->getClientOriginalExtension(); 
            $banner = $imageEncName.".".$imageExtension; 
            $destinationPath = "backend/system_setting/";
            $file->move($destinationPath, $banner); 
        }

        $inputs = [
            'name' => $request->input('name'),
            'title' => $request->input('title'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'logo' => $logo_name,
            'favicon' => $favicon,
            'office_address' => $request->input('office_address'),
            'website_link' => $request->input('website_link'),
            'map_link' => $request->input('map_link'),
            'copy_right' => $request->input('copyright'),
            'website_banner' => $banner,
            'fb_link' => $request->input('facebook_link'),
            'instagram_link' => $request->input('instagram_link'),
            'twitter_link' => $request->input('twitter_link'),
            'you_tube_link' => $request->input('you_tube_link'),
            'meta_tag_author' => $request->input('meta_author'),
            'meta_tag_name' => $request->input('meta_tag_name'),
            'meta_tag_description' => $request->input('meta_description'),
            'status' =>1
        ];


        $infoData->update($inputs);

        Toastr::success("Data Added Successfully !");

        return redirect()->back()->with('message','Data updated Successfully!');

    }

}
