@extends('welcome')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alice&family=Philosopher:wght@400;700&display=swap" rel="stylesheet">
<style>
    .work-video-section{
        margin-top: 10% !important;
    }
    .work-video-section{
        font-family:'Courier New', Courier, monospace;
    }
    .work-description-section h2{
        font-size: 20px;
        font-weight: 400;
    }
    .work-description-section h3{
        padding-top: 10px;
        font-size: 16px;
        font-weight: 400;
    }

    @media screen and (max-width:639px){
        .work-description-section h2{
            font-size: 16px;
            font-weight: 400; 
        }
        .work-description-section h3{
            padding-top: 7px;
            font-size: 15px;
            font-weight: 400;
    }
    }
   
</style>
@section('content')
    <div class="work-description-section animatedParent animateOnce" data-sequence="500">
            <img src="{{asset('backend/package/'.$package->pkg_image)}}" alt="{{$package->name}}" height="400px">
        <h1 class="work-heading animated fadeInDownShort go" data-id="1">
            {{$package->category->category_name}} - {{$package->type->package_type_name}}
        </h1>
        <h2>{{$package->name}}</h2>
        <hr>
        <h3>{{$package->short_details}}</h3>
        <div class="work-description animated fadeIn go" data-id="3">
            {!! $package->long_details !!}
            <hr>
            @if($package->discount && $package->amount)
            <h2 style="font-weight: bold  ">Current Price :{{$package->discount}}Tk</h2>
            <h3>Previous Price : {{$package->amount}}Tk</h3>
            @elseif($package->discount)
            <h2>Package Price : {{$package->discount}}Tk</h2>
            @else{{$package->amount}}
            <h2>Package Price : {{$package->amount}} Tk</h2>
            @endif 
        </div>
    </div>
    </div>


   @endsection