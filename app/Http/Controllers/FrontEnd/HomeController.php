<?php 

namespace App\Http\Controllers\FrontEnd;

use App\Models\BackEnd\Blog;
use Illuminate\Http\Request;
use App\Models\BackEnd\Slider;
use App\Models\BackEnd\Service;
use App\Models\BackEnd\Portfolio;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\ClientReview;
use App\Models\BackEnd\SystemSetting;
use App\Models\BackEnd\Overview;


class HomeController extends Controller{
    public function index(){
        $sliders = Slider::where('status',1)->orderBy('position','asc')->get();
        $services = Service::where('status',1)->get();
        $logo = SystemSetting::first();
        $blogs = Blog::where('status',1)->limit(3)->get();
        $portfolios = Portfolio::where('type','photography')->where('status',1)->orderBy('id','desc')->limit(3)->get();
        $client_reviews = ClientReview::where('status',1)->get();
        $content = Overview::where('type','Our Services')->where('status',1)->first();
        $cinematography = Portfolio::where('status',1)->where('type','cinematography')->orderBy('id','desc')->limit(5)->get();


        // dd($portfolios);
        return view('FrontEnd.includes.home',compact('sliders','services','logo','blogs','portfolios','client_reviews','content','cinematography'));
    }

    public function test(){
        return view('FrontEnd.includes.test');
    }
}