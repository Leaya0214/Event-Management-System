@extends('welcome')
@section('content')
        <section class="fetured-video-section">
            <div class="video-slider animatedParent animateOnce">
                @foreach($cinematographies as $c_data)
                
                <div class="video-cover animated fadeIn">
                    <div class="video-slider-content">
                        <img class="responsive-image" src="{{ asset('backend/portfolio/' . $c_data->image) }}"
                            alt="Bridal Harmony-cinematography">
                        <p class="video-caption">
                            {{$c_data->title}}
                        </p>
                        <div class="video-play-icon">
                            <a href="" class=""
                                data-video="{{ getYoutubeEmbedUrl($c_data->video) }}" data-video-type="YouTube">
                                <img src="{{asset('frontend/images/play-icon.png')}}"
                                    alt="Bridal Harmony - Play icon" class="work-video-play-icon">
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        <section class="latest-work-section animatedParent animateOnce" style="width: 100%">
            <h2 class="heading animated fadeInDownShort">Photography</h2>
            
            <div class="work-list-latest  " id="most-popular-work">
                @foreach($photographies as $p_data)
                <div class="work-latest-parent  " data-id="1">
                    <div class="work"
                        style="background-image: url('{{ asset('backend/portfolio/' . $p_data->image) }}')">

                        <a href="{{ url('our_work_view/' . $p_data->id . '/' . $p_data->title )}}">
                            <div class="work-description">
                                <h3> {{$p_data->title}} </h3>
                                <hr />
                                <p class="date"> 18 July 2022</p>
                                <p class="description">
                                    {{ Str::words(strip_tags($p_data->description), 100) }}
                                </p>
                                <span class="view-btn">VIEW</span>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
                
                </div>
             
            </div>
        </section>
    <section class="latest-work-section animatedParent animateOnce">
            <h2 class="heading animated fadeInDownShort">Cinematography</h2>

            <div class="work-list-latest " id="latest-work">
                @foreach($cinematographies as $cine)
                <div class="work-latest-parent  " data-id="1">
                    <div class="work"
                        style=" background-image: url('{{ asset('backend/portfolio/' . $cine->image) }}')">

                        <a
                            href="{{ url('our_work_view/' . $cine->id . '/' . $cine->title )}}">
                            <div class="work-description">
                                <h3>{{$cine->title}}</h3>
                                <hr />
                                <p class="date">12 January 2023</p>
                                <p class="description">
                                    {{ Str::words(strip_tags($cine->description), 100) }}
                                </p>
                                <span class="view-btn">VIEW</span>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
    </section> 
    @endsection