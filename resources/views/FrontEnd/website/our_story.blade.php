@extends('welcome')
@section('content')
<div class="main-container">
    @foreach($our_story as $our_s)
    <section class="work-video-section animatedParent animateOnce">
        <div class="work-wrapper animated fadeIn " id="work-show">

            <div class="video-bg"
                style="background-image: url({{ asset('backend/content/' . $our_s->image) }});">
            </div>
            {{-- <a href="#" class="work-featured-video" data-url="https://player.vimeo.com/video/760342511?autoplay=1">
                <img src="https://www.theweddingfilmer.com/images/home/play_icon.png" alt="play icon" class="">
            </a> --}}
        </div>
    </section>
    <div class="work-description-section animatedParent animateOnce" data-sequence="500">
       {!!$our_s->description!!}
    </div>
    @endforeach
</div>
@endsection