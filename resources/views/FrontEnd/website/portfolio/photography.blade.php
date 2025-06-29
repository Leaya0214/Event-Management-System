@extends('welcome')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/bootstrap.css" />
<link href="https://fonts.cdnfonts.com/css/cormorant-garamond" rel="stylesheet">
<link href="https://fonts.cdnfonts.com/css/playfair-display" rel="stylesheet">
<link href="https://fonts.cdnfonts.com/css/muli" rel="stylesheet">

<style>
    .container {
        padding-top: 8%;
        width: 100% !important;
    }

    .page-content {
        margin-top: 0;
    }
    .page-section .container h1{
        text-align: center;
        font-size: 3rem;
        margin-bottom: 30px;
    }

    .wide-post-list-item img {
        width: 90px;
    }

    .post-list-item {
        /* width: 100%; */
        height: 210px;
        background-size: cover;
    }
    .h1{
        font-size: 4rem;
        font-family:'Playfair Display', sans-serif;
        }
    .h2{
        font-size:20px;
        font-family: 'Muli', sans-serif;
        font-weight: 500;
        color: rgba(9, 8, 8, 0.859);
  }
    p{
        text-align: center;
        margin-bottom: 5px;
        font-family: 'Muli', sans-serif;
    }
    a:hover{
        color:inherit;
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
    .modal-header {
    background-color: #50505018; /* Set the background color to transparent */
    border-bottom: none; /* Remove the default bottom border */
}

/* Optional: If you want to remove the close button background as well */
.modal-header .btn-close {
    top: 18px;
    right: 170px;
    width: 35px;
    height: 35px;
    line-height: 35px;
    background: rgba(0,0,0,.6);
    position: fixed;
    text-align: center;
    padding: 0;/* Set the color to your desired text color */
}
</style>
<style>
     .type-button{
            background: none; 
            border: none; 
            color: #505050; 
            font-size: 16px; 
            text-decoration: none;
            margin-right: 10px;
        }
    
        .type-button.selected,.category-button.selected {
            text-decoration: underline;
            background: none; 
            border: none; 
            color: black;
            font-size: 18px;
        }
        .type-button.active,.category-button.active {
            text-decoration: underline;
            background: none; 
            border: none; 
            color: black; 
            font-size: 16px;
        }
        
        @media screen and(max-width:639px){
             .h2{
                font-size:18px;
          }
        }
    
</style>
@section('content')

    <div class="container mb-5">

        <h1 class="h1 text-center fw-bold mt-4 mb-5 ">Photography</h1>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-2 ">
                <div class="mb-5 text-center">
                    <a href="#" class="h-10 px-4 py-2 selected type-button active" data-group="type"
                        data-type="all" value="500"  id="category_id" onclick="filterPhotography('all')">
                        ALL
                    </a>
                    @if($categories)
                        @foreach ($categories as $category)
                            <a href="#" data-group="type" class="h-10 px-4 py-2 type-button"
                                data-type="{{ $category->id}}" id="category_id" onclick="filterPhotography({{$category->id}})">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
      
        {{-- <hr class=""> --}}
        <style>
   
        </style>
      
        <div class="row text-center">
            @foreach($photographies as $key=>$photography)
                <div class="photography col-lg-4 col-md-4 col-sm-6 mb-3 pr-2 border-0"  data-category-ids="{{ json_encode($photography->category_id) }}">
                    <a href="" class="d-flex mb-2 w-100"
                    data-bs-toggle="modal" 
                    data-bs-target="#imageModal{{ $photography->id }}">
                    <img class="img-fluid img-thumbnail" src="{{asset('backend/portfolio/'.$photography->image)}}" alt="">
                    </a>
                    <a href=""></a>
                    <a href="{{url('our_work_view/' . $photography->id . '/' . $photography->title )}}" class="mb-2 w-100">
                       <p class="h2 text-center">{{$photography->title}}</p>
                    </a>
                    <p style="font-size:12.5px" class="text-center mb-4">
                        @php 
                            $category_check = App\Models\BackEnd\Portfolio::where('id',$photography->id)->where('category_id', '!=',null)->first();
                            if($category_check){
                            $categorie_ids = json_decode($category_check->category_id);
                                $categories = App\Models\BackEnd\PortfolioCategory::whereIn('id',$categorie_ids)->get();                        
                                if(count($categories)>0){
                                    foreach($categories as $index =>$category){
                                        echo $category->name ;
                                        if ($index < count($categories)-1) {
                                            echo ',';
                                        } else {
                                            echo rtrim(',', ',');
                                        }
                                    }
                                }
                            }
                        @endphp
                    </p>
                </div>
          @endforeach
        </div>
      
      </div>
      <!-- Image Modal -->
      @foreach($photographies as $key=>$photo)
      <div class="modal fade" id="imageModal{{ $photo->id }}" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div id="carouselExampleControls{{ $photo->id }}" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                      <div class="carousel-inner">
                          @foreach($photographies as $index=>$photography)
                              <div class="carousel-item {{ $index == $key ? 'active' : '' }}">
                                  <img class="d-block w-100" src="{{asset('backend/portfolio/'.$photography->image)}}" alt="{{$photography->title}}">
                              </div>
                          @endforeach
                      </div>
                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls{{ $photo->id }}" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls{{ $photo->id }}" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                      </button>
                  </div>
              </div>
          </div>
      </div>
  @endforeach
@endsection
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
@section('js')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    var myCarousel;

    // Initialize carousel when the modal is shown
    $('.modal').on('show.bs.modal', function (event) {
        var modal = $(this);
        myCarousel = new bootstrap.Carousel(modal.find('.carousel')[0]);
    });

    // Destroy carousel when the modal is hidden
    $('.modal').on('hidden.bs.modal', function (event) {
        myCarousel.dispose();
    });
</script>
<script>
     $(document).ready(function () {
        // Handle button click
        $(".type-button").click(function () {
            $(".type-button").removeClass("selected");
            $(".type-button").removeClass("active");
            $(this).addClass("active");
        });
    });
</script>
<script>
    function filterPhotography(selectedCategoryId) {
        if (selectedCategoryId === 'all') {
        location.reload();
        return;
        }

    var photographyElements = document.querySelectorAll('.photography');
    
    photographyElements.forEach(function(photographyElement) {
        var categoryIds = JSON.parse(photographyElement.getAttribute('data-category-ids'));
        if (categoryIds && categoryIds.length > 0) {
            if (categoryIds.includes(selectedCategoryId)) {
                photographyElement.style.display = 'block';
            } else {
                photographyElement.style.display = 'none';
            }
        } else {
            photographyElement.style.display = 'none';
        }
    });
}



</script>
@endsection
