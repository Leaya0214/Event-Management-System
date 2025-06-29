@extends('welcome')
<link href="https://fonts.cdnfonts.com/css/muli" rel="stylesheet">
<link href="https://fonts.cdnfonts.com/css/playfair-display" rel="stylesheet">

<style>
        /* Add general styles here */

        .faculty-description {
            /* Add styles for desktop view here */
        }

        .text {
            /* Add styles for text container */
            max-width: 800px; /* Adjust as needed */
            margin: 0 auto;
        }
         .text p {
                text-align: justify !important;
                
            }

        @media only screen and (max-width: 768px) {
            /* Add styles for mobile view here */
            .faculty-description {
                text-align: center;
                flex-direction: column;
                width: 100% !important;
            }
        .text {
            /* Add styles for text container */
            width: 100% !important;
            margin: 0 auto;
          padding-left: 0 !important;
         
           
            }
            .faculty-description img {
                width: 100% !important;
               
                height: auto;
            }

            .text p {
                text-align: justify !important;
                display: block; /* Paragraphs will stack on top of each other */
                margin-bottom: 15px; /* Adjust spacing between paragraphs as needed */
            }
            
            .straight-border {
     /*width: 0% !important; */
     /*background-color: #d1aa34; */
     /*height: 1px; */
     /*margin: 1rem 1.5rem; */
     display: none !important; 
    
        }
        }
    </style>
    
<style>
    h2{
        letter-spacing: 3px;
        line-height: 1.4;
        font-family: 'Playfair display', sans-serif;
        color: #a18226;
        

    }
    h4{
        letter-spacing: 5px;
        line-height: 1.2;
        font-family: 'Muli', sans-serif;
        color: #3d3d3d;
        text-transform: uppercase;
    }
    .crew-header-section{
        margin-top: 0;
    }

    .article-section{
        margin-top: 4%;
    }
    .article-section h1{
        padding-bottom: 0;
        letter-spacing: 2px;
    }
    .article-section .description{
        margin: 0 11%;

    }
    .article-section .description p{
        font-family: 'Muli',sans-serif;
        font-weight: 400;
        font-size: 16px;
        line-height: 1.86;
        color: rgba(41, 41, 41, 0.788);
        font-style: normal;
        text-align: left;
    }
    .straight-border {
        width: 33% !important; 
        background-color: #d1aa34;
        height: 1px;
        margin: 1rem 1.5rem;
        display: inline-block;
        position: relative;
        }
</style>
{{-- media query --}}
<style>
    @media only screen and (max-width: 600px) {
        .straight-border {
               margin: 4px;
               width: 24% !important;
            }
            .article-section h1{
                font-size: 22px !important;
                padding: 1.5rem !important;
            }
            .article-section .description{
                margin: 0 8%;
            }
            .article-section .description p{
                font-size: 12.5px;  
            }
    }
    @media only screen and (min-width: 600px) {
        .straight-border {
                width: 20% !important; 
            }
    }
    @media only screen and (min-width: 768px) {
        .straight-border {
                width: 27% !important; 
            }
    }
    @media only screen and (min-width: 992px) {
        
    }
    @media only screen and (min-width: 1200px) {
        .straight-border {
                width: 33% !important; 
            }
    }
</style>
@section('content')
        <section class="crew-header-section animatedParent animateOnce">
            <figure class="animated fadeInDownShort go">
                <img class="" src="{{ asset('backend/content/' . $content->image) }}" alt="Bridal Harmony Cover Photo">
                <figcaption>{{ $content->title }}</figcaption>
            </figure>
        </section>
        <section class="article-section animatedParent animateOnce">
            <h1 class="animated fadeInDownShort about-us">
                <div class="straight-border"></div> About Us <div class="straight-border"></div>
            </h1>
            <div class="description">
                <p>{{ Str::words(strip_tags($content->description), 700) }}</p>
            </div>
        </section>
        <section class="workshop-faculty-section">
            <div class="faculty-head animatedParent animateOnce" data-sequece="500">
                {{-- <div class="faculty-title animated fadeInDownShort" data-id="1">
                    <h1><div class="straight-border"></div> The CEO<div class="straight-border"></div> </h1>
                     <div class="faculty-border"></div> 
                </div> --}}
                
                <div class="faculty-description animated fadeInDownShort delay-250" data-id="2">
                    <img src="{{asset('frontend/images/reazul-islam-shawon.jpg')}}" alt="">
                    <div class="text">
                        <h4>Founder & CEO</h4>
                        <h2>RIAZUL ISLAM SHAWON</h2>
                        <p>
                            Bridal Harmony is a premium wedding photography and cinematography company based in Bangladesh, specializing in capturing the unforgettable moments of your big day. Established in 2013, our team of experienced photographers and cinematographers have been capturing the essence of love, joy, and celebration through our lens. At Bridal Harmony, we understand that every couple is unique, and so are their wedding stories. Our mission is to immortalize your special day with our artistic flair and expertise. We strive to capture the authenticity of your love, the beauty of the event, and the emotions that make your day unforgettable.
                        </p>
                        <p>
                            Bridal Harmony is a premium wedding photography and cinematography company based in Bangladesh, specializing in capturing the unforgettable moments of your big day. Established in 2013, our team of experienced photographers and cinematographers have been capturing the essence of love, joy, and celebration through our lens. At Bridal Harmony, we understand that every couple is unique, and so are their wedding stories. Our mission is to immortalize your special day with our artistic flair and expertise. We strive to capture the authenticity of your love, the beauty of the event, and the emotions that make your day unforgettable.
                        </p>
                        <p>
                            Bridal Harmony is a premium wedding photography and cinematography company based in Bangladesh, specializing in capturing the unforgettable moments of your big day. Established in 2013, our team of experienced photographers and cinematographers have been capturing the essence of love, joy, and celebration through our lens. At Bridal Harmony, we understand that every couple is unique, and so are their wedding stories. Our mission is to immortalize your special day with our artistic flair and expertise. We strive to capture the authenticity of your love, the beauty of the event, and the emotions that make your day unforgettable.
                        </p>
                    </div>
                   
                </div>
            </div>

            <div class="faculty-head animatedParent animateOnce" data-sequece="500">
                <div class="faculty-title animated fadeInDownShort" data-id="1">
                    <h1><div class="straight-border"></div>Team Member<div class="straight-border"></div></h1>
                   
                </div>
                <div class="faculty-description animated fadeInDownShort delay-250" data-id="2">
                    <p style="text-align: center; font-size:14px; width:100%">Meet with our company CEO and legendary team members who will guide you to create memories  .</p>
                </div>
            </div>
        
            <div class="faculty-logos">
                <div class="row animatedParent animateOnce" >
                    @foreach($users as $user)
                    <div class="col s12 m6 l4 animated fadeIn">
                        <div class="faculty-wrapper">
                            <div class="faculty">
                                <img src="{{asset('backend/team_member/'.$user->image)}}" alt="Bridal-Harmony-{{$user->name}} ">
                                <div class="faculty-info hide">
                                    <p style="padding-top: 50%;">{{ $user->designation }}</p>
                                </div>
                            </div>
                            <div class="faculty-name">
                                <h2>{{$user->name}}</h2>
                                
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
         <section class="colab-section animatedParent animateOnce" data-sequence="500">
            <div class="work-with-us" >
                <h1 class="work-heading animated fadeInDownShort" data-id="1"><div class="straight-border"></div>Our Memberships<div class="straight-border"></div></h1>
            </div>
            <div class="collaborators-div clear">
                <div class="collaborators ">
                    <div class="row " >
                        <div class="col s4 m4 l4 client-logo animated pulse" >
                            <img src="{{asset('frontend/images/PPAC.png')}}" alt="Bridal  Harmony - PPAC.png" height="100">
                        </div>
                        <div class="col s4 m4 l4 client-logo animated pulse delay-250">
                            <img src="{{asset('frontend/images/AsiaWPA.png')}}" alt="The Wedding Filmer - Sony Logo" height="100">
                        </div>
                        <div class="col s4 m4 l4 client-logo animated pulse delay-250" >
                            <img src="{{asset('frontend/images/WPPB.png')}}" alt="The Wedding Filmer - Lacie Logo" height="100">
                        </div>
                        <div class="col s4 m4 l4 client-logo animated pulse delay-250" >
                            <img src="{{asset('frontend/images/my wed.png')}}" alt="The Wedding Filmer - Lacie Logo" height="100">
                        </div>
                    </div>
                </div>
            </div>
        </section> 

        <!--<section class="article-section animatedParent animateOnce">-->
        <!--    <h1 class="animated fadeInDownShort about-us">-->
        <!--        <div class="straight-border"></div> Awards & Achivement <div class="straight-border"></div>-->
        <!--    </h1>-->
        <!--</section>-->
   @endsection
