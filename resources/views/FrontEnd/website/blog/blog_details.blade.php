@extends('welcome')

<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/bootstrap.css" />
<style>
    .navbar{
     justify-content: center ;
    }
.color-patch {
    background: hsla(4, 39%, 49%, 0.541);
    clear: both;
}
.master-header {
    background-color: #D3A29E !important;

}
.img-responsive{
    height:500px !important;
}

.latest-work-section h3.heading {
  font-size: 2.8rem;
  font-family: "Philosopher-Bold", sans-serif;
  color: #505050;
  text-align: center;
  text-transform: uppercase;
  margin: 20px;
}


@media screen and (max-width: 639px) {
    .img-responsive{
        height:200px !important;
        margin-bottom: 10px !important;
    }
}


</style>

@section('content')

        <section class="latest-work-section animatedParent animateOnce" style="width: 100%">
            <!--yyyyy-->
            <div class="container ">
                <div class="row">
                    <div class="col-md-12" style="text-align:center">
                        <h3 class="heading animated fadeInDownShort go">{{$blog->title}}</h3>
                    </div>
                    <div class="col-md-12" style="text-align:center">

                        <img style=" margin-left: auto; margin-right: auto; border-radius:5px;"
                            src="{{asset('backend/blog/'.$blog->image)}}"
                            class="img-responsive" alt="{{$blog->title}}">
                    </div>
                    <div class="col-md-12"
                        style="text-align:justify;font-family:ProximaNova-Regular; margin-top:10px; margin-bottom:10px;">
                        <p>
                            <span font-size:="" segoe=""
                                style="color: rgb(38, 38, 38); font-family: -apple-system, BlinkMacSystemFont, ">{!! $blog->description  !!}</span>
                        </p>
                    </div>
                    <!--yyyyy-->
                </div>
            </div>
        </section>
    @endsection
