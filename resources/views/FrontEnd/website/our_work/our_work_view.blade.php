@extends('welcome')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/bootstrap.css" />
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
     .modal-dialog {
        max-width: 80%;
        background: transparent;
    }

    .modal-content {
        width: 100%;
    }

    .carousel-inner {
        display: flex;
        flex-direction: row;
    }

    .carousel-item {
        flex: 0 0 auto;
        width: 100%;
        transition: transform 0.5s ease;
    }

    .item {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Modal Design */



@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}
/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
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
        <div class="row ">
            @foreach ($first_row as $row1)
            @if ($row1->width > $row1->height)
                <div class="col-sm-6 col-md-5 col-lg-5">
                    <img src="{{ asset('backend/portfolio_gallery/' . $row1->image) }}" class="item img-{{$row1->id}}"
                        alt="" data-bs-toggle="modal" 
                        data-bs-target="#imageModal{{ $row1->id }}">
                </div>
                @else
                <div class="col-sm-6 col-md-2 col-lg-2">
                    <img src="{{ asset('backend/portfolio_gallery/' . $row1->image) }}" class="item img-{{$row1->id}}"
                        alt=""  data-bs-toggle="modal" 
                        data-bs-target="#imageModal{{ $row1->id }}">
                </div>
                @endif
            @endforeach
        </div>
        <div class="row mt-4">
            @foreach ($second_row as $row2)
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <img src="{{ asset('backend/portfolio_gallery/' . $row2->image) }}" class="item  img-{{$row2->id}}"
                        alt="" data-bs-toggle="modal" 
                        data-bs-target="#imageModal{{ $row2->id }}">
                </div>
            @endforeach
        </div>
        <div class="row mt-4">
            @foreach ($galleryImages as $row3)
            @if ($row3->width < $row3->height)
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <img src="{{ asset('backend/portfolio_gallery/' . $row3->image) }}" class="item img-{{$row3->id}}"
                        alt=""  data-bs-toggle="modal" 
                        data-bs-target="#imageModal{{ $row3->id }}">
                </div>
            @else
            <div class="col-sm-6 col-md-6 col-lg-6">
                <img src="{{ asset('backend/portfolio_gallery/' . $row3->image) }}" class="item img-{{$row3->id}}"
                    alt=""  data-bs-toggle="modal" 
                    data-bs-target="#imageModal{{ $row3->id }}">
            </div>
            @endif
            @endforeach
        </div>
        <div class="row mt-4">
            @foreach ($others as $other)
            @if ($other->width > $other->height)
                <div class="col-sm-6 col-md-6 col-lg-6 pt-4">
                    <img src="{{ asset('backend/portfolio_gallery/' . $other->image) }}" class="item img-{{$other->id}}"
                        alt="" data-bs-toggle="modal" 
                        data-bs-target="#imageModal{{ $other->id }}">
                </div>
            @else
            <div class="col-sm-6 col-md-3 col-lg-3">
                <img src="{{ asset('backend/portfolio_gallery/' . $other->image) }}" class="item img-{{$other->id}}"
                    alt=""  data-bs-toggle="modal" 
                    data-bs-target="#imageModal{{ $other->id }}">
            </div>
            @endif
            @endforeach
        </div>
    </div>
    

    </div>

    {{-- Image Modalj --}}
    @foreach($gallery_image as $key=>$image)
      <div class="modal fade" id="imageModal{{ $image->id }}" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                {{-- <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> --}}
                  <div id="carouselExampleControls{{ $image->id }}" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                      <div class="carousel-inner">
                          @foreach($gallery_image as $index=>$gallery)
                              <div class="carousel-item {{ $index == $key ? 'active' : '' }}">
                                  <img class="d-block w-100" src="{{asset('backend/portfolio_gallery/'.$gallery->image)}}" alt="{{$gallery->title}}">
                              </div>
                          @endforeach
                      </div>
                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls{{ $image->id }}" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls{{ $image->id }}" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                      </button>
                  </div>
              </div>
          </div>
      </div>
  @endforeach
      <!-- Modal -->
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
   $('.modal').on('show.bs.modal', function (event) {
        var modal = $(this);
        myCarousel = new bootstrap.Carousel(modal.find('.carousel')[0]);
    });

    // Destroy carousel when the modal is hidden
    $('.modal').on('hidden.bs.modal', function (event) {
        myCarousel.dispose();
    });


</script>

{{-- <script>
    // Get the modal
    var modal = document.getElementById("myModal");
    
    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var modalContent = document.getElementById('myImg');
    var modalImg =  document.querySelector('.img-' + imageId).src;
    var captionText = document.getElementById("caption");
    img.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    }
    
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() { 
      modal.style.display = "none";
    }
    </script> --}}

@endsection

