<footer>
    @php 
        $link = App\Models\BackEnd\SystemSetting::first();
    @endphp
    <div class="footer-section animatedParent animateOnce" data-sequence="500">
        <p class="left animated fadeInLeftShort" data-id="1">&copy; 2023 | Bridal Harmony</p>
        <p style="padding-left:10px"  class="left animated fadeInLeftShort" data-id="1"> <a href="{{route('terms_condition')}}">Terms & Condition</a> </p>
        <p style="padding-left:10px" class="left animated fadeInLeftShort" data-id="1"> <a href="{{route('privacy_policy')}}"> Privacy Policy</a></p>
        <p class="right animated fadeInRightShort" data-id="1">Develop By <a
            href="https://www.stitbd.com">STITBD</a></p>
        <div class="social-media">
            <div class="wrapper">
                <span class="animated flipInY" data-id="2"><a
                        href="{{$link->fb_link}}" target="_blank">
                        <img src="{{asset('frontend/images/fb_icon.png')}}"
                            alt="Bridal Harmony - Bridal Harmony FB"></a></span>
                {{-- <span class="animated flipInY" data-id="2"><a href=""
                        target="_blank">
                        <img src=""
                            alt="Bridal Harmony - Bridal Harmony Twitter"></a></span> --}}
                {{-- <span class="animated flipInY" data-id="2"><a
                        href="" target="_blank">
                        <img src="{{asset('frontend/images/fb_icon.png')}}"
                            alt="Bridal Harmony - Bridal Harmony LinkedIn"></a></span> --}}
                <span class="animated flipInY" data-id="2"><a
                        href="{{$link->instagram_link}}" target="_blank">
                        <img src="{{asset('frontend/images/insta_icon.png')}}"
                            alt="Bridal Harmony - Bridal Harmony instagram"></a></span>
                <span class="animated flipInY" data-id="2"><a
                        href="{{$link->you_tube_link}}" target="_blank">
                        <img src="{{asset('frontend/images/yt_icon.png')}}"
                            alt="Bridal Harmony - Bridal Harmony youtube"></a></span>
                {{-- <span class="animated flipInY" data-id="2"><a href=""
                        target="_blank">
                        <img src=""
                            alt="Bridal Harmony - Bridal Harmony vimoe"></a></span> --}}

            </div>
        </div>
    </div>
</footer>