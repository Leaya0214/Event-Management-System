@extends('welcome')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/style.min.css" />
    <style>
        .page-section {
            padding-top: 10%;
        }
        .page-content{
            margin-top: 0;
        }
    </style>
    <div class="page-section">
        <div class="container">
            <h1></h1>
            <div class="row">
                <!-- page content -->
                <div class="col-xlarge-12 col-medium-12 ">

                    <ul class="blog-post-list post-list row ">
                        <!-- Wide post item -->
                        @foreach ($blogs as $blog)
                            <li class="col-xlarge-4">
                                <div class="post-list-item wide-post-list-item blog-list-item post-item-center ">

                                    <a href="">
                                        <img src="{{ asset('backend/blog/' . $blog->image) }}"
                                            alt="Bridal Harmony - Bridal Harmony’s New Streaming Service" class="image" style="height: 220px">
                                    </a>

                                    <!-- blog item categories -->
                                    {{-- <ul class="post-categories clearfix">
                                        <li class="blog-item-cat font-opensans-reg"><a
                                                href=""> {{$blog->title}}</a></li>
                                    </ul> --}}
                                    <h3 class="font-crimson-reg">
                                        <a href="">
                                            {{$blog->title}} </a>
                                    </h3>

                                    <div class="post-list-item-meta font-opensans-reg clearfix">

                                        {{-- <span>October 27, 2023</span> --}}

                                    </div>

                                    <div class="page-content">
                                        <p>{{ Str::words(strip_tags($blog->description), 25) }} </p>

                                    </div>

                                    <a href=""
                                        class="primary-button font-lato-reg hov-bk read-more-{{ $blog->id }}">Read more</a>

                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="hide">

        {{-- <div class="close-btn">
    <img src="{{asset('frontend/images/yt_icon.png')}}">
</div> --}}
        @foreach ($blogs as $s_data)
            <div class="modal-box blog-id-{{ $s_data->id }}" id="work-with-us-{{ $s_data->id }}"
                data-ng-controller="careerController">
                <div class="modal-info">
                    <div class="modal-contents">
                        <h1>{{ $s_data->title }}</h1>
                        <img src="{{ asset('backend/blog/' . $s_data->image) }}" alt=""
                            style="width: 100%">
                        <div class="description">
                            {!! $s_data->description !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('js')
     @foreach ($blogs as $blog_id)
     <script>
         $('.read-more-{{ $blog_id->id }}').colorbox({
             inline: true,
             href: '#work-with-us-{{ $blog_id->id }}',
             inline: true,
             width: '95%',
             maxWidth: '800px',
             height: '80%',
             transition: 'none',
         });
     </script>
 @endforeach
@endsection
