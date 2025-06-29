@extends('welcome')
@section('header')
    @include('FrontEnd.includes.header')
@endsection
<link href="https://fonts.googleapis.com/css2?family=Carme&family=Dongle:wght@300&family=Poppins:wght@300&display=swap" rel="stylesheet">@section('content')
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link href="https://fonts.cdnfonts.com/css/playfair-display" rel="stylesheet">
<link href="https://fonts.cdnfonts.com/css/muli" rel="stylesheet">
<link href="https://fonts.cdnfonts.com/css/google-sans" rel="stylesheet">
<link href="https://fonts.cdnfonts.com/css/cormorant-garamond" rel="stylesheet">

@section('content')
    <style>
    
        .crew-profile {
            margin-top: 8% !important;
        }

        .straight-border {
            width: 35% !important; 
            background-color: #d1aa34;
            height: 1px;
            margin: 1rem 1.5rem;
            display: inline-block;
            position: relative;
        }

        .border-1 {
            width: 35% !important; /* Adjust width as needed */
            height: 3px; /* Adjust height of the line */
            background-color: #d1aa34; /* Adjust line color */
            position: absolute; /* Changed to relative */
            display: inline-block;
            margin: 1rem 2rem;
            top: 23%;
            /* right: 12%; */
        }

        .vertical {
            border-right: 3px solid rgba(61, 53, 53, 0.321);
            height: 50px;
            position: relative;
            /* left: 50%; */
        }
        
        .article-section h2{
            text-align: center;
            font-size: 40px;
            font-weight: 600;
            color:#bb993e;
            font-family: 'Cormorant Garamond', sans-serif;
         }
        .article-section h3{
            text-align: center;
            font-size: 18px;
            font-weight: 500;
            margin-top: 25px;
            padding: 16px 0;
            color: black;
            font-family: 'Muli', sans-serif;
            

        }
        
        .overlay{
            background: #d1c6b691;
            height: 200px;
            width: 100%;
            /*opacity: .3; */
            margin-top:90px;
        }

        .custom-article{
            margin-top: -305px;
        }
          .article-section .custom-article{
            margin-top: -305px;
        }
      
        
      
    </style>
     <style>
         .section-content{
            text-align: center;
            font-size: 14px;
            line-height: 1.86;
            padding: 1.3rem 25%;
            font-family: 'Muli';
        }
         .custom-img {
            height: 60vh !important;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            margin-top:0 !important;
        }
        .grid-item p{
           color: #d1aa34; 
        }
    </style>
    
    <style>
        /* Default height for mobile */
        .responsive-image {
            height: 100px;
        }

        /* Media query for PC */
        @media screen and (max-width: 768px) {
            .border-1 {
                    width: 25% !important; 
            } 
            .straight-border {
                width: 27% !important; 
            }
             .section-content{
                font-size: 14px;
                padding: 1.3rem 17rem ;
            }
              .overlay{
                height: 170px;
                width: 100%;
                /* opacity: .3;  */
                margin-top:43px;
            }

            .article-section .custom-article{
                margin-top: -223px;
            }
            

        }
        @media screen and (min-width: 768px) {

            .responsive-image {
                height: 239px;
            }
            
            .crew-profile {
                margin-top:0 !important;
            }
            .border-1 {
                    width: 25% !important; /* Adjust width as needed */
            }
              
            .straight-border {
                width: 27% !important;
            }
           

        }
        @media screen and (min-width: 959px) {

            .crew-profile {
                min-height: 60vh;
            }
            .responsive-image {
                height: 400px;
            }
        }
        /*@media screen and (max-width: 1024px) {*/
        /*     .border-1 {*/
        /*        width: 30% !important;*/
        /*    }*/
        /*}*/
        @media screen and (min-width: 1024px) {
          
        .crew-profile {
                min-height: 55vh;
        }
        .straight-border {
                width: 29% !important;
            }

            .border-1 {
                    width: 30% !important; /* Adjust width as needed */
            }
            .section-content{
                font-size: 14px;
                padding: 1.3rem 28% ;
            }
            .responsive-image{
                height: 336px;
            }
            .overlay{
                height: 141px;
                width: 100%;
                /* opacity: .3;  */
                margin-top:16px;
            }

            .article-section .custom-article{
                margin-top: -225px;
            }
             
        }
       

        @media screen and (max-width: 820px) { 
            .crew-profile{
                margin-top:0 !important;
            }
            .vertical {
                position: relative;
                border: none;
                height: auto;
                /* left: 50%; */
            }
            .fold2-container .grid-item p {
                font-size:20px;
            }
            .fold2-container .grid-item span{
                font-size:40px;
                font-weight:900;
            }
            .fold2-container .grid-item {
                padding:10px 20px;
            }
            
            .straight-border {
                width:21% !important;
            }
            .article-section h1{
                font-size:27px;
                padding-bottom:1.3rem;
            }
            .section-content {
                font-size:12.5px;
            }
            .article-section .articles .article .description {
                font-size:1.3rem;
            }
            .article-section .press-page-link p .press-page-button{
                font-size:13px;
            }
            .crew-profile .profile-details .personal-info h1.name {
                font-size:32px;
                font-weight:bold;
            }
            .custom-img {
                height:40vh !important;
            }
            
            .article-section .articles .article .figcaption{
                font-size:17px;
            }
            .slick-prev, .slick-next{
                height:30px;
            }
        }
            
            
            @media screen and (max-width: 639px) {
                .responsive-image {
                    height: 144px;
                }

                .story-section .videos-container .video .container .description{
                    padding: 1rem 0;
                }

            header .menu ul img{
                margin-left:38px !important;
            }
            
            .crew-profile {
            margin-top: 0 !important;
            min-height: 50vh;
            }
            .straight-border {
                display: none;
            }

            .border-1 {
                display: none;
            }

            .vertical {
                position: relative;
                border: none;
                height: auto;
                /* left: 50%; */
            }
            .article-section h2{
                font-size:22px;
                padding-bottom: 7px;
            }
            .article-section h3{
                font-size:20px;
                margin-top: 12px;
                padding: 12px 0;
            }
            
            .section-content{
                padding: 11px 14px 16px 14px;
        }
        
           .overlay{
                display:none;
            }

            .article-section .custom-article{
                margin-top: 8px;
            }
        }
        
         @media only screen and (min-width: 1200px) {
             .section-content{
                .section-content{
                text-align: center;
                font-size: 14px;
                line-height: 1.86;
                padding: 1.3rem 25%;
                font-family: 'Muli';
        }
            }
            
            .responsive-image{
                height:400px;
            }
             
         }
         
         @media only screen and (min-width: 1600px) {
            .responsive-image {
            height: 550px;
        }
        .overlay{
                height: 200px;
                width: 100%;
                /* opacity: .3;  */
                margin-top:50px;
            }

            .article-section .custom-article{
                margin-top: -280px;
            }
             
         }
      
        
    </style>
    <style>
        .read-more {
            font-size: 14px;
            text-align: center;
        }
        .read-more span{
            color: #9d7c1b;
            outline: none;
        }

        .custom-btn {
            padding: 1rem 1.5rem;
            text-decoration: none;
            /* margin: 2rem; */
            background-color: #d1aa34;
            color: #FFFFFF;
            font-size: 1.4rem;
            border: 1px solid #d1aa34;
            border-radius: 4px;

        }


        blockquote p span {
            color: white !important;
        }

        .rating {
            display: flex;
            align-items: center;
            font-size: 24px;
            /* margin-left: 50%; */
            margin-top: 2%;
            margin-bottom: 2%;
        }

        .stars::before {
            content: '★★★★★';
            letter-spacing: 3px;
            background: linear-gradient(90deg, gold var(--rating), #ddd var(--rating));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
     
    </style>

    <style>
        /* Default styling for grid items */
        .fold2-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 10px;
            text-align: center;
        }

        .grid-item {
            background-color: #f0f0f0;
            padding: 10px;
            /* border-radius: 5px; */
        }

        /* Media query for mobile devices */
        @media screen and (max-width: 767px) {
            .fold2-container {
                grid-template-columns: 1fr;
            }
        }

        /* Media query for larger screens (PC) */
        @media screen and (min-width: 768px) {
            .fold2-container {
                grid-template-columns: repeat(4, 1fr);
                padding: 6rem 5rem;
                /* Adjust the number of columns as needed */
            }
        }
    </style>
   
    <section class="crew-profile animatedParent animateOnce">
        <div class="crew-bg animated fadeIn">
            <div class="crew-bg-slider">
                @foreach ($sliders as $slider)
                    <div class="slide">
                        <div class="slide-img" style="background-image:url('{{ asset('backend/slider/' . $slider->image) }}')">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
     <div class="article-section">
        <h3>Bridal Harmony</h3>

        <h2>Premium Class Photography & Cinematography Services</h2>
        <p class="section-content">Bridal Harmony is a team of experienced professional photographers, cinematographers and photo-book experts who are dedicated to creating stunning, authentic stories of people's live.</p>
    </div>
    <section class="fold2-container animatedParent animated" data-sequence="500">
        <div class="grid-item" id="eventsItem">
            <p>Since</p> <span>2013</span>
        </div>
        <div class="grid-item vertical" id="packagesItem">
            <p>Events</p> <span>0</span><span>+</span>

        </div>
        <div class="grid-item" id="photosItem">
            <p>Photos</p> <span>0</span><span>k+</span>
        </div>
        <div class="grid-item" id="clientsItem">
            <p>Clients</p><span> 0</span><span>k+</span>
        </div>

        <script>
            function startCountdown() {
                // Set the fixed target values for the countdown
                const targetValues = {
                    events: 600,
                    packages: 6000,
                    photos: 800,
                    clients: 40
                };

                // Set the interval for updating the values (in milliseconds)
                const interval = 10; // 1 second

                const timers = Object.create(null);

                // Update the values at regular intervals
                function updateValues() {
                    for (const itemId in targetValues) {
                        const item = document.getElementById(`${itemId}Item`);
                        const currentValue = parseInt(item.querySelector('span').textContent, 10);
                        const targetValue = targetValues[itemId];

                        if (currentValue < targetValue) {
                            // Increment the value by 1
                            item.querySelector('span').textContent = currentValue + 1;
                        } else {
                            // Stop the timer when the target value is reached
                            clearInterval(timers[itemId]);
                        }
                    }
                }

                // Start the countdown when the page loads
                document.addEventListener('DOMContentLoaded', () => {
                    for (const itemId in targetValues) {
                        timers[itemId] = setInterval(updateValues, interval);
                    }
                });
            }

            startCountdown();
        </script>


    </section>

    <section class="article-section animatedParent animateOnce">
        <h1 class="animated fadeInDownShort">
            <div class="straight-border"></div> Our Services <div class="straight-border"></div>
        </h1>
      <!--  @if($content->description)-->
      <!--<p class="section-content" >{{ Str::words(strip_tags($content->description), 100) }}</p>-->
      <!--@endif-->
      <div class="overlay"></div>
        <div class="articles custom-article" >
            @foreach ($services as $service)
                <div class="article figure">

                    <div class="article-image article1">
                        <a href="">
                            <img data-lazy="{{ asset('backend/service/' . $service->image_video) }}" type="image"
                                alt="Bridal Harmony - Bridal Harmony’s New Streaming Service" src="#">
                        </a>
                    </div>
                    <div class="figcaption">
                        <a href="">
                            {{ $service->title }}</a>
                    </div>
                    <div class="description">
                        <p>{{ Str::words(strip_tags($service->description), 25) }} </p>

                    </div>
                    <div class="read-more">
                        {{-- <a href="" class="animated fadeInDown open-work-with-us-popup-{{ $service->id }}"
                            data-id="2">Read More</a> --}}

                    </div>
                    {{-- <p class="publisher"> -Bridal Harmony</p> --}}

                </div>
            @endforeach

        </div>

        <div class="press-page-link animated fadeInDownShort">
            <p><a href="{{ route('allservices') }}" class="press-page-button">SEE ALL SERVICES</a></p>
        </div>
    </section>

    <section class="crew-profile animatedParent animateOnce" style="margin: 2% 0 !important;">
        <div class="crew-bg animated fadeIn">
            <div class="crew-bg-slider">
                @foreach ($client_reviews as $review)
                    <div class="slide">
                        <div class="profile-details animated fadeInUp">
                            {{-- <div class="breadcrumb">
                            <a href="">< Client Review </a>/ 
                        </div> --}}
                            <div class="personal-info">
                                <h1 class="name">CLIENT REVIEWS</h1>
                                <div class="copy">
                                    <div class="copy-data">
                                        <p class="text-center">" {{ $review->comment }} "</p>
                                        <div class="rating">
                                            <p class="stars text-center"
                                                style="--rating: {{ ($review->rating / 5) * 100 }}%;"></p>
                                        </div>
                                        <p class="text-center">-{{ $review->client_name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="crew-bg-overlay"></div>
                        <div class="slide-img custom-img"
                            style="background-image:url('{{ asset('backend/client_review/' . $review->bg_image) }}')"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

   <section class="article-section animatedParent animateOnce">
         <h1 class="animated fadeInDownShort" style="padding-top:20px"> <div class="straight-border"></div> RECENT WORK <div class="straight-border"></div>
        </h1>
        <p class="section-content">Take a peek at our recent stunning wedding photography album, which is loaded with wonderful moments and memories.</p>

        <div class="articles">
            @foreach ($portfolios as $portfolio)
                @php
                    $portrait = App\Models\BackEnd\PortfolioGallery::Where('portfolio_id',$portfolio->id)->where('height','>=',1400)->first();
                    
                    // dd($portrait);
                @endphp
                <div class="article figure">
                     @if($portrait)
                    <div class="article-image article1">
                        <a href="{{ url('our_work_view/' . $portfolio->id . '/' . $portfolio->title )}}">
                            <img data-lazy="{{ asset('backend/portfolio_gallery/' . $portrait->image) }}" type="image"
                                alt="Bridal Harmony - Bridal Harmony’s New Streaming Service" src="#" height="auto" width="auto">
                        </a>
                    </div>
                    @else
                     <div class="article-image article1">
                        <a href="{{ url('our_work_view/' . $portfolio->id . '/' . $portfolio->title )}}">
                            <img data-lazy="{{ asset('backend/portfolio/' . $portfolio->image) }}" type="image"
                                alt="Bridal Harmony - Bridal Harmony’s New Streaming Service" src="#" height="auto" width="auto">
                        </a>
                    </div>
                    @endif
                    
                    <div class="figcaption" style="text-align: center;">
                        <a href="{{ url('our_work_view/' . $portfolio->id . '/' . $portfolio->title )}}" style="color:#d1aa34;" >
                            {{ $portfolio->title }}</a>
                    </div>
                    {{-- <div class="description">
                        <p>{{ Str::words(strip_tags($portfolio->description), 25) }}</p>
                    </div> --}}
                    {{-- <div class="read-more">
                        <a style="font-size:20px;" href="" class="animated fadeInDown open-work-with-us-popup-{{ $blog->id }}"
                            data-id="2">Read More</a>

                    </div> --}}
                </div>
            @endforeach

        </div>
    
        <div class="press-page-link animated fadeInDownShort">
            <p><a href="/" class="press-page-button">Show All</a></p>
        </div> 


    </section>
    
     <section class="story-section animatedParent animateOnce">
        <h1 class="animated fadeInDownShort"> <div class="straight-border"></div>Cinematography <div class="straight-border"></div>
        </h1>
        <p class="section-content">Take a peek at our recent stunning wedding photography album, which is loaded with wonderful moments and memories.</p>
        <div class="videos-container">
           @foreach ($cinematography as $video)
                <div class="video">
                    <div class="container">
                        <div class="video-wrapper">
                            <a href="" data-url="{{ getYoutubeEmbedUrl($video->video) }}" tabindex="-1">
                                <img class="responsive-image" src="{{ asset('backend/portfolio/' . $video->image) }}"
                                    alt="Bridal Harmony">
                                <div class="play-icon"><img src="{{ asset('frontend/images/play-icon.png') }}"
                                        alt="Bridal Harmony - video play icon"></div>
                            </a>
                        </div>
                        <div class="description" style="text-align:center">
                            <h2 class="animated fadeInUpShort">{{ $video->title }} </h2>
                            <div class="description-text animated fadeInUpShort">
                                {{-- <p> Str::words(strip_tags($portfolio->description), 50) </p> --}}
                        <p>Film Credits: Bridal Harmony</p> 
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section> 
    <section class="article-section animatedParent animateOnce">
        <h1 class="animated fadeInDownShort">
            <div class="straight-border"></div> Our Blog <div class="straight-border"></div>
        </h1>
        <div class="articles">
            @foreach ($blogs as $blog)
                <div class="article figure">

                    <div class="article-image article1">
                        <a href="" target="_blank">
                            <img data-lazy="{{ asset('backend/blog/' . $blog->image) }}" type="image"
                                alt="Bridal Harmony - Bridal Harmony’s New Streaming Service" src="#">
                        </a>
                    </div>
                    <div class="figcaption">
                        <a style="font-size:20px" href="" target="_blank">
                            {{ $blog->title }}</a>
                    </div>
                    <div class="description">
                        <p>{{ Str::words(strip_tags($blog->description), 25) }}</p>
                    </div>
                    <div class="read-more">
                        <span class="animated fadeInDown open-work-with-us-popup-{{ $blog->id }}"
                            data-id="2">Read More</span>

                    </div>

                </div>
            @endforeach

        </div>

        <div class="press-page-link animated fadeInDownShort">
            <p><a href="{{ route('blogs') }}" class="press-page-button">Show All</a></p>
        </div>


    </section>

    <div class="hide">

        {{-- <div class="close-btn">
    <img src="{{asset('frontend/images/yt_icon.png')}}">
</div> --}}
        @foreach ($services as $s_data)
            <div class="modal-box blog-id-{{ $s_data->id }}" id="work-with-us-{{ $s_data->id }}"
                data-ng-controller="careerController">
                <div class="modal-info">
                    <div class="modal-contents">
                        <h1>{{ $s_data->title }}</h1>
                        <img src="{{ asset('backend/service/' . $s_data->image_video) }}" alt=""
                            style="width: 100%">
                        <div class="description">
                            {!! $s_data->description !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


        @foreach ($blogs as $b_data)
            @php
                $images = DB::table('blog_images')
                    ->where('blog_id', $b_data->id)
                    ->get();
            @endphp
            <div class="modal-box blog-id-{{ $b_data->id }}" id="work-with-us-{{ $b_data->id }}"
                data-ng-controller="careerController">
                <div class="modal-info">
                    <div class="modal-contents">
                        <h1>{{ $b_data->title }}</h1>
                        <img src="{{ asset('backend/blog/' . $b_data->image) }}" alt="" style="width: 100%">
                        <div class="description">
                            {!! $b_data->description !!}
                        </div>
                        <div class="gallery" style="padding-left: 11rem">
                            @foreach ($images as $image)
                                <img src="{{ asset('backend/blog_gallery/' . $image->image) }}" alt=""
                                    height="250" style="padding:3% 4% 3% 1%">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection


@section('js')
    @foreach ($blogs as $sid)
        <script>
            $('.open-work-with-us-popup-{{ $sid->id }}').colorbox({
                inline: true,
                href: '#work-with-us-{{ $sid->id }}',
                inline: true,
                width: '95%',
                maxWidth: '800px',
                height: '80%',
                transition: 'none',
            });
        </script>
    @endforeach
    @foreach ($services as $service_id)
        <script>
            $('.open-work-with-us-popup-{{ $service_id->id }}').colorbox({
                inline: true,
                href: '#work-with-us-{{ $service_id->id }}',
                inline: true,
                width: '95%',
                maxWidth: '800px',
                height: '80%',
                transition: 'none',
            });
        </script>
    @endforeach
@endsection
