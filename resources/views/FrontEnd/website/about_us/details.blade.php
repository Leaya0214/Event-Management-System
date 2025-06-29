@extends('welcome')
<style>
    .social-icon{
        background: black;
    }
    .social-icon i{
        font-size: 20px;
        color:black;
    }
</style>
@section('content')
        <section class="workshop-video-section animatedParent animateOnce">
            <div class="tutorial-wrapper ">
                <div class="tutorial-video animated fadeInLeftShort go">
                        <img src="{{asset('backend/user/'.$crew->image)}}" alt="BH- Play icon">
                </div>
                <div class="workshop-content animated fadeInRightShort go">
                   
                        <div class="heading-wrapper">
                            <h3 class="workshop-heading">{{$crew->name}}</h3>
                            <div class="straight-border"></div>
                            <h3 style="font-size:20px">{{$crew->designation}}</h3>
                        </div>
                        <p class="workshop-description">{!! $crew->details !!}</p>
                        <a href=""><i class="fa-brands fa-facebook"></i></a>
                        <a href=""><i class="fa-brands fa-instagram"></i></a>
                        {{-- <div class="workshop-action">
                            <div class="price-container">
                                
                            </div>
                            <div class="take-class">
                                <a href="" class="class-action"></a>
                            </div>
                        </div> --}}
                       
                </div>  
            </div>
        </section>
    @endsection
