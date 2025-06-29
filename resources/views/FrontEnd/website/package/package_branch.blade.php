@extends('welcome')
<style>
    /* .slick-track {
        margin-right: 50% !important;
    } */

.latest-work-section h2{
    margin: 10% auto 2% auto !important;
}
.latest-work-section .work-list-latest .work-latest-parent .work .work-description {
  display: block !important;
  background: none !important;
}
.latest-work-section .work-list-latest .work-latest-parent .work .work-description h2 {
  font-family: "Philosopher-Bold", sans-serif;
  font-size: 3rem;
  color: #FFFFFF;
  font-weight: 900;
  margin: 12rem 0 !important;
  padding: 3rem 0;
  background: rgba(36, 34, 34, 0.804);
}
.latest-work-section .work-list-latest .work-latest-parent .work .work-description h2 span{
    font-size: 16px !important;
}

.package{
    border: none !important;
}


/* .latest-work-section .work-list-latest .work-latest-parent{
    margin-left: 16% !important;
} */
.work-latest-parent .slick-slide .slick-current{
    width: 300px !important;
}
.slick-obj{
    display: flex !important;
    justify-items: center;
    margin: 1rem auto;
        
}
.slick-track{
    width: 600px !important;
}

@media screen and (max-width: 639px) {
    .slick-obj{
        flex-direction: column !important;
    }
    .latest-work-section .work-list-latest .work-latest-parent{
        margin: 2rem 5rem !important;
    }
}
    
</style>
@section('content')
    <section class="latest-work-section animatedParent animateOnce" style="width: 100%">
        <h2 class="heading animated fadeInDownShort">Packages</h2>
        <div class="work-list-latest slick-initialized " id="most-popular-work">
            <div aria-live="polite" class="slick-list draggable">
                <div class="slick-track slick-obj" role="listbox"
                    style="opacity: 1; width: 813px; transform: translate3d(0px, 0px, 0px);">
                    @foreach($branches as $branch)
                    <div class="work-latest-parent slick-slide slick-current slick-active" data-id="1"
                        style="width: 271px;" tabindex="-1" role="option" aria-describedby="slick-slide20"
                        data-slick-index="0" aria-hidden="false">
                        <div class="work package"
                            style="background-image: url('{{asset('backend/branch/'.$branch->bg_image)}}')">
                            <a href="{{ url('packages/' . $branch->id . '/' . $branch->branch_name ) }}" tabindex="0">
                                <div class="work-description" >
                                 <h2 style="">{{$branch->branch_name}}<br> <span>Packages</span></h2> 
                                
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
