@extends('welcome')

@section('content')
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
h2,h3{
    letter-spacing: 2px;
    line-height: 1.4;
    font-family: 'Playfair display', sans-serif;
    color: #020202;
    font-size: 28px;
    

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
    margin-bottom: 4%;
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

<section class="article-section animatedParent animateOnce">
    <h1 class="animated fadeInDownShort about-us">
        <div class="straight-border"></div> Privacy Policy <div class="straight-border"></div>
    </h1>
    <div class="description">
        @if($data) <p style="font-size:20px;margin-bottom:50px; margin-top:50px"> {!! $data->description !!}</p> @endif
    </div>
</section>
   
@endsection
