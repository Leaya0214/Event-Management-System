@extends('welcome')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/style.min.css" />
<link href="https://fonts.cdnfonts.com/css/playfair-display" rel="stylesheet">

<style>
    .container{
        width: 82% !important;
    }
    .page-section {
        margin-top: 9.5%;
    }

    .page-content {
        margin-top: 0;
    }
    .page-section .container h1{
        text-align: center;
        font-size: 3.5rem;
        margin-bottom: 30px;
        font-weight: bold;
    }

    .wide-post-list-item img {
        width: 80px;
    }

    .post-list-item {
        /* width: 100%; */
        height: 230px;
        background-size: cover;
    }
    .list-item{
        margin-bottom: 20px;
    }
    .list-item p{
        font-size: 16px;
        color: rgba(104, 92, 3, 0.865);
        
    }
    h1{
        font-size: 4rem;
        font-family:'Playfair Display', sans-serif;
        }
        
  @media (min-width: 992px)
    .col-xlarge-4 {
        height:326px !important;
    }
}
</style>
@section('content')

    <div class="page-section">
        <div class="container">
            <h1>Cinematography</h1>
            <div class="row">
                <!-- page content -->
                <div class="col-xlarge-12 col-medium-12 ">

                    <ul class="blog-post-list post-list row ">
                        <!-- Wide post item -->
                        @foreach ($cinematographies as $cine)
                            <li class="col-xlarge-4 mb-4 list-item" style="height:326px ">
                                <div class="post-list-item wide-post-list-item blog-list-item post-item-center"
                                    style="background-image: url({{ asset('backend/portfolio/' . $cine->image) }});">
                                    @if ($cine->video)
                                        <a href="#"
                                            data-url="{{ getYoutubeEmbedUrl($cine->video) }}"class="play-icon-container">
                                            <img src="{{ asset('frontend/images/play-icon.png') }}" alt="play icon">
                                        </a>
                                    @endif
                                </div>
                                <p>{{$cine->title}}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.post-list-item a').on('click', function(e) {
            e.preventDefault();
            var videoURL = $(this).data('url');
            $(this).hide();
            var iframeElement = $('<iframe>', {
                width: '100%',
                height: '230px', // Set the height to 100% to fit the container
                id: 'recentWorkFrame',
                src: videoURL,
                frameborder: 0,
                webkitallowfullscreen: true,
                mozallowfullscreen: true,
                allowfullscreen: true
            });
            $(this).parent().append(iframeElement);
            // $(this).parent().append('<iframe width="100%" id="recentWorkFrame"  src="'+ videoURL +'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe>');
            // $(this).parent().addClass('full-screen-video');
        });
    </script>
@endsection
