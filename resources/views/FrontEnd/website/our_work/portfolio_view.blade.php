@extends('welcome')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/style.min.css" />
<style>
    .work-video-section {
        margin-top: 10% !important;
    }

    .work-video-section {
        font-family: 'Courier New', Courier, monospace;
    }
    .description{
        margin:4% auto !important;
    }

    .work-description-section h2 {
        font-size: 20px;
        font-weight: 400;
    }

    .work-description-section h3 {
        padding-top: 10px;
        font-size: 16px;
        font-weight: 400;
    }
.container{
    margin-bottom: 10%;
    width: 86% !important;
}
</style>
<style>
    .first-row {
        display: grid;
        grid-gap: 10px;
        grid-template-columns: repeat(auto-fill, minmax(159px, 1fr));
    }

    .second-row,.others {
        margin-top: 10px;
        display: grid;
        grid-gap: 10px;
        grid-template-columns: repeat(auto-fill, minmax(188px, 1fr));
    }

    .third-row {
        margin-top: 10px;
        display: grid;
        grid-gap: 10px;
        grid-template-columns: repeat(auto-fill, minmax(227px, 1fr));
    }

    .item {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .landscape {
        grid-column: span 3;
    }

    .row-2 {
        grid-column: span 3;
    }


    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Maintain the aspect ratio while covering the container */
        display: block;
    }

    
    @media screen and (min-width: 1723px) {
    .container {
        width: 1870px;
    }
    .first-row {grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)) !important ;}
    .second-row,.others
         {
            grid-template-columns: repeat(auto-fill, minmax(254px, 1fr)) !important;
        }
        .third-row{grid-template-columns: repeat(auto-fill, minmax(257px, 1fr)) !important;} 
}


    @media screen and (min-width: 2000px) {
        .container {
            width: 1570px;
        }
        .first-row {grid-template-columns: repeat(auto-fill, minmax(165px, 1fr)) !important ;}
        .second-row,.others
         {
            grid-template-columns: repeat(auto-fill, minmax(182px, 1fr)) !important;
        }
        .third-row{grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)) !important;} 

    } 

    
    @media (min-width: 1281px) and (max-width: 1400px) {
        .container{
            width: 86% !important;
        }
        .first-row {grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)) !important ;}
        .second-row,.others
         {
            grid-template-columns: repeat(auto-fill, minmax(165px, 1fr)) !important;
        }
        .third-row{grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)) !important;} 
         /*
          
        .others {
            grid-template-columns: repeat(auto-fill, minmax(165px, 1fr));
        }
        .first-row .landscape{
            grid-column: span 3;
        }
        .third-row .landscape{
            grid-column: span 3;
        }
        .row-2{
            grid-column: span 2;
        } */

        
        
    }

    
    @media (max-width: 1280px) {
        .container {
            margin-bottom: 5%;
        }
        .first-row{grid-template-columns: repeat(auto-fill, minmax(170px, 1fr))  ;}
        .third-row{grid-template-columns: repeat(auto-fill, minmax(167px, 1fr)) ;}
        .second-row
         {
            grid-template-columns: repeat(auto-fill, minmax(218px, 1fr));
        }
        .others {
            grid-template-columns: repeat(auto-fill, minmax(165px, 1fr));
        }
        .first-row .landscape{
            grid-column: span 2;
        }
        .third-row .landscape{
            grid-column: span 3;
        }
        .row-2{
            grid-column: span 2;
        }
        /* ,
        .third-row,
        .others {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        } */
    }
   

    @media (max-width: 1024px) {
        .first-row {
            grid-template-columns: repeat(auto-fill, minmax(156px, 1fr));
        }

        .second-row,.others{
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)) ;
        }

        .third-row {
            grid-template-columns: repeat(auto-fill, minmax(156px, 1fr)) ;
        }

        .third-row .landscape{
            grid-column: span 3;
        }

        .landscape {
            grid-column: span 2;
        }
        .row-2 {
            grid-column: span 2;
        }

        /* .first-row .landscape{
            width: 200px;
        } */
        
        .gallery-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Maintain the aspect ratio while covering the container */
            display: block;
        }
    }
 

    @media (min-width: 992px) and (max-width: 1099px) {

        .container{
            width: 100% !important;
        }
    .first-row {
            grid-template-columns: repeat(auto-fill, minmax(165px, 1fr)) ;
        }
        .second-row,.others{
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)) ;
        } 
    }


   @media screen and (min-width: 768px) and (max-width: 991px){
    .container{
            width: 100% !important;
        }
    .first-row {
            grid-template-columns: repeat(auto-fill, minmax(129px, 1fr)) ;
        }
    .third-row {
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)) ;
        }
        .second-row,.others{
            grid-template-columns: repeat(auto-fill, minmax(171px, 1fr)) ;
        }
   }
   @media screen and (max-width: 768px){
        .container{
            width: 100% !important;
        }
        .first-row {
            grid-template-columns: repeat(auto-fill, minmax(133px, 1fr)) ;
        }
       
        .second-row,.others{
            grid-template-columns: repeat(auto-fill, minmax(156px, 1fr)) ;
        }

        .third-row {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)) ;
        }

        .third-row .landscape{
            grid-column: span 2;
        }

        .landscape {
            grid-column: span 2 ;
        }
    }

    @media (max-width: 439px){
        .container{
            width: 100% !important;
            padding: 0 !important;
        }

        .first-row {
         grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
        .third-row {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
    }

   
</style>

<style>
    /* Modal Design */

    .modal {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 70%; /* Adjust the width as needed */
        max-width: 600px; /* Set a maximum width if desired */
        height: auto; /* Let the height adjust based on content */
        background-color: rgba(0, 0, 0, 0.9);
}

.modal-content {
    margin: auto;
    display: block;
    max-height: 50vh;
    width: auto;
    max-width: 100%
    /* max-width: 40%;
    max-height: 40%; */
}

.modal-content img{
    height: 40%;
    width: 100%;
    object-fit: cover;
}


.close {
    color: #fff;
    font-size: 2em;
    position: absolute;
    top: 15px;
    right: 15px;
    cursor: pointer;
}
</style>

@section('content')
    <section class="work-video-section animatedParent animateOnce">
        <div class="work-wrapper animated fadeIn  go" id="work-show">
            <div class="video-bg" style="background-image: url({{ asset('backend/portfolio/' . $our_work_view->image) }});">
            </div>
            @if ($our_work_view->video)
                <a href="#" class="work-featured-video" data-url="{{ getYoutubeEmbedUrl($our_work_view->video) }}">
                    <img src="{{ asset('frontend/images/play-icon.png') }}" alt="play icon" class="">
                </a>
            @endif
        </div>
    </section>
    <div class="work-description-section description animatedParent animateOnce" data-sequence="500">
        <h1 class="work-heading animated fadeInDownShort go" data-id="1">
            {{ $our_work_view->title }}
        </h1>
        <div class="work-description animated fadeIn go" data-id="3">
            {!! $our_work_view->description !!}
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xlarge-12 col-medium-12">
                <div class="first-row">
                    @foreach ($first_row as $row1)
                        @if ($row1->width > $row1->height)
                            <img src="{{ asset('backend/portfolio_gallery/' . $row1->image) }}" class="item landscape img-{{$row1->id}}"
                                alt="" onclick="openModal({{ $row1->id }})">
                        @else
                            <img src="{{ asset('backend/portfolio_gallery/' . $row1->image) }}" class="item img-{{$row1->id}}"
                                alt="" onclick="openModal({{ $row1->id }})">
                        @endif
                    @endforeach
                </div>
                <div class="second-row">
                    @foreach ($second_row as $row2)
                        <img src="{{ asset('backend/portfolio_gallery/' . $row2->image) }}" class="item row-2 img-{{$row2->id}}"
                            alt="" onclick="openModal({{ $row2->id }})">
                    @endforeach
                </div>
                <div class="third-row">
                    @foreach ($galleryImages as $row3)
                        @if ($row3->width < $row3->height)
                            <img src="{{ asset('backend/portfolio_gallery/' . $row3->image) }}" class="item img-{{$row3->id}}"
                                alt=""onclick="openModal({{ $row3->id }})">
                        @else
                            <img src="{{ asset('backend/portfolio_gallery/' . $row3->image) }}" class="item landscape img-{{$row3->id}}"
                                        alt="" onclick="openModal({{ $row3->id }})" >
                        @endif
                    @endforeach
                </div>
                <div class="others">
                    @foreach ($others as $other)
                        @if ($other->width > $other->height)
                            <img src="{{ asset('backend/portfolio_gallery/' . $other->image) }}" class="item landscape img-{{$other->id}}"
                                alt="" onclick="openModal({{ $other->id }})">
                        @else
                            <img src="{{ asset('backend/portfolio_gallery/' . $other->image) }}" class="item img-{{$other->id}}"
                                alt="" onclick="openModal({{ $other->id }})">
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    </div>
      <!-- Modal -->

      <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="modalContent" class="modal-content"></div>
    </div>
@endsection

@section('js')

<script>
    function openModal(imageId) {
    var modal = document.getElementById('imageModal');
    var modalContent = document.getElementById('modalContent');

    // Get the image source based on the clicked image's ID
    var imageSrc = document.querySelector('.img-' + imageId).src;
    console.log(imageSrc);

    // Set the modal content with the clicked image
    modalContent.innerHTML = '<img src="' + imageSrc + '" alt="Popup Image">';

    modal.style.display = 'block';
}

function closeModal() {
    var modal = document.getElementById('imageModal');
    modal.style.display = 'none';
}


</script>

@endsection

