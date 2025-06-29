@extends('welcome')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/bootstrap.css" />
<link href="https://fonts.cdnfonts.com/css/muli" rel="stylesheet">
<link href="https://fonts.cdnfonts.com/css/playfair-display" rel="stylesheet">


<style>
    .container {
        margin-top: 7%;
        margin-bottom: 4%;
        width: 86% !important;
        max-width: 1400px;
    }

    h2 {
        font-family: 'Playfair Display', sans-serif;
        font-size: 4rem;
        font-weight: bold;
    }

    .info {
        font-size: 16px;
        font-weight: bold;
    }

    .info i {
        padding: 12px;
    }
    .feedback-form{
        padding: 10px 45px 10px ;
        background:rgb(230, 229, 229);
    }
    .feedback-form h3{
        font-size: 22px;
        font-family: 'Muli',sans-serif;
        margin: 0.5em;
    }
    .feedback-form label{
        font-size: 13px;
        padding: 13px 0;
    }
    .feedback-form input,.feedback-form textarea{
        padding: 8px;
        font-size: 15px;
    } 
    .feedback-form button{
        margin-top: 20px;
        font-size: 13px;
        background:darkgoldenrod;
    }



    /* .contact-info i{
            padding-right: 10px;
        } */
</style>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="text-align:center; padding-top:13px; padding-bottom:50px">
                <h2 class="heading animated fadeInDownShort go">CONTACT US</h2>
            </div>
            <div class="col-md-12 overflow-hidden">
                <div class="row">
                    <div class="col-md-6">
                        <div class="feedback-form">
                            <h3>Give Us Your Feedback</h3>
                            <form id="feedbackForm" method="post">
                                <!-- Add your feedback form fields here -->
                                <label for="name">Your Name:</label>
                                <input type="text" class="form-control" id="name" name="name" >
                    
                                <label for="email">Your Email:</label>
                                <input type="email" class="form-control" id="email" name="email" >
                    
                                <label for="message">Your Feedback:</label>
                                <textarea id="message" class="form-control" name="message" rows="4" ></textarea>
                    
                                <button type="submit" id="submit" class="btn btn-md text-white">Submit Feedback</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-6">
                         <div class="info mb-3">
                            <i class="fa-solid fa-location-dot " style="color: darkgoldenrod"></i>
                            {{ $info->office_address }} <br>
                            <i class="fa-solid fa-envelope" style="color: darkgoldenrod"></i> <a
                                href="{{ $info->email }}">{{ $info->email }}</a><br>
                            <i class="fa-solid fa-phone " style="color: darkgoldenrod"></i>
                            <a href="{{ $info->phone }}">{{ $info->phone }}</a><br>
                        </div>
                       
                            <iframe style="height: 299; width: 80%;" frameborder="0" scrolling="no" marginheight="0"
                            marginwidth="0" src="{{$info->map_link}} "></iframe>
                    </div>
                    <div class="col-md-12 text-center" style="margin-top:7%">
                        <img src="{{asset('backend/system_setting/'.$info->logo)}}" alt="" height="100" width="100"> <br>
                        <a href="{{$info->fb_link}}" style="color:black; font-size:18px; "><i class="fa-brands fa-facebook" style="padding-top:18px; padding-right:10px"></i></a>
                        <a href="{{$info->you_tube_link}}}" style="color:black; font-size:18px; "><i class="fa-brands fa-youtube" style="padding-top:18px;padding-right:10px"></i></a>
                        <a href="{{$info->instagram_link}}" style="color:black; font-size:18px; "><i class="fa-brands fa-instagram" style="padding-top:18px;"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('#submit').on('click',function(){
            alert('Thank You For Your Feedback')
        })
    });
</script>

@endsection
