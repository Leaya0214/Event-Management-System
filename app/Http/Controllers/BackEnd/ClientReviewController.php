<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\ClientReview;
use Illuminate\Support\Facades\Validator;

class ClientReviewController extends Controller
{
    public function index(){
        if (!check_access("clientReview.list")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $clientReviews = ClientReview::get();
        return view('BackEnd.webcontent.client_review.client_review',compact('clientReviews'));
    }
    public function addClientReview(){
        if (!check_access("clientReview.create")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        return view('BackEnd.webcontent.client_review.add');
    }

    public function storeClientReview(Request $request){
        $validator = Validator::make($request->all(),[
            'name'     => 'required',
            'comment'     => 'required',
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
             
            $destination_path = "backend/client_review/"; 
            $file->move($destination_path,$image_name); 
        }else{ 
            $image_name=""; 
        }

        $data = [
            'client_name' => $request['name'],
            'comment' =>$request['comment'],
            'rating' =>$request['rating'],
            'date' =>$request['date'],
            'bg_image' => $image_name,
            'status' => 1
        ];

        // dd($data );

        ClientReview::insert($data);

        Toastr::success("Review Added Successfully!");

        return redirect()->route('client_review');

        
    }

    public function edit($id){
        if (!check_access("clientReview.edit")) {
            Toastr::error("You don't have permission!");
            return redirect()->route('admin.index');
        }
        $client_review = ClientReview::where('id',$id)->first();
        return view('BackEnd.webcontent.client_review.edit',compact('client_review'));
    }
   
    public function updateClientReview(Request $request, $id){
        $clientReview = ClientReview::findOrFail($id);

        $image_name = $clientReview->bg_image;

        if($request->hasFile('image')){
            $path = public_path() . "backend/client_review/" . $clientReview->bg_image;
            if (file_exists($path)) { 
                unlink($path); 
            }  
            $file = $request->file('image'); 
            $image_enc_name = rand(0,9999).time().md5($file->getClientOriginalName()); 
            $image_extension = $file->getClientOriginalExtension(); 
            $image_name = $image_enc_name.".".$image_extension; 
            $destination_path = "backend/client_review/"; 
            $file->move($destination_path,$image_name); 
        }

        $data = [
            'client_name' => $request['name'],
            'comment' =>$request['comment'],
            'rating' =>$request['rating'],
            'date' =>$request['date'],
            'bg_image' => $image_name,
            'status' => 1
        ];

        // dd($data );

        $clientReview->update($data);

        Toastr::success("Updated Data Successfully!");

        return redirect()->route('client_review');
 
    }

    public function statusUpdate($id){
        try{
            if (!check_access("clientReview.edit")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $status = ClientReview::find($id);
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
            if (!check_access("clientReview.delete")) {
                Toastr::error("You don't have permission!");
                return redirect()->route('admin.index');
            }
            $systemData = ClientReview::find($id);
            $systemData -> delete();
            Toastr::success("Deleted Successfully !!");
            return redirect()->back();
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
