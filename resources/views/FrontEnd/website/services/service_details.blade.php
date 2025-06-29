@extends('welcome')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
/* ProximaNova-Regular */
.description{
    text-align:justify;
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    margin-top:10px; 
    margin-bottom:10px;
}


@media screen and (max-width: 639px) {
    .img-responsive{
        height:200px !important;
        margin-bottom: 10px !important;
    }
}

</style>
@section('content')
            <!--yyyyy-->
            <div class="container">
                <div class="row">
                    <div class="col-md-12" style="text-align:center">
                        <h3 class="heading animated fadeInDownShort go">{{$service->title}}</h3>
                    </div>
                    <div class="col-md-12" style="text-align:center;">

                        <img class="img-fluid"
                            src="{{asset('backend/service/'.$service->image_video)}}"
                         alt="{{$service->title}}">
                         
                    </div>
                    <div class="col-md-12 description">
                        <p>
                            <span font-size:="" segoe="">
                                {!! $service->description !!}
                            </span>
                               
                        </p>
                    </div>

                    <!--yyyyy-->
                </div>
            </div>
    
    @endsection