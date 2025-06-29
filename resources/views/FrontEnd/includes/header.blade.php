<link href="https://fonts.cdnfonts.com/css/muli" rel="stylesheet">

<style>
    .navbar menu{
        display: flex;
        justify-content: space-between;
    }
    header .menu {
        margin-left: 350px;
        background-color: rgb(255, 255, 255);
    }
    header .menu ul {
        list-style: none;
        /* display: flex; */
    }
   header .menu ul a {
        text-decoration: none;
        font-size: 81%;
        font-weight:600;
        font-family: 'Muli', sans-serif;                                      
        color: black !important;
        background: #FFFFFF;
    }
    header .menu ul span {
        text-decoration: none;
        font-size:80%;
        font-weight:600;
        font-family: 'Muli', sans-serif;                                        
        color: black !important;
    }
    header .menu ul img{
        margin-left: 7% ;
    }
    
    header .menu ul li
    .nav-button{
        padding: 1rem 2rem;
        text-decoration: none;
        /*margin: 2rem;*/
        background-color: #d1aa34;
        color: #FFFFFF !important;
        font-size: 13px;
        /* border: 1px solid #505050; */
        border: none;
        border-radius: 4px;
        text-transform:none;
    }

    .navbar {
        box-shadow: 0 0 2px #676a6a
;
    }


    .submenu {
       display: none;
       position: absolute;
       background-color: white;
    }

/* .portfolio:hover .submenu {
    display: flex !important;
    flex-direction: column;
    background:white;
    color: black;
    box-sizing: border-box;
    padding: 8px !important;
    z-index: 9999;
} */

.portfolio:hover .submenu {
    display: flex !important;
    flex-direction: column;
    background: white; /* Change background to solid white */
    color: black;
    box-sizing: border-box;
    padding: 8px !important;
    z-index: 9999;
}
.navigation-menu{
    min-height:90px;
    display: flex;
    justify-content: space-between;
    margin-left: auto;
    margin-right: auto;
    max-width:1121px;

}

@media screen and (min-width: 960px) and (max-width: 1065px) {
    .navigation-menu{
        width: 100%;

    }
}
@media screen and (min-width: 400px){
    .navigation-menu{
        width: 100%;

    }
}
@media screen and (min-width: 820){
    .navigation-menu img{
        padding:11px;

    }
}
/*img.twf-mobile-logo {*/
/*    display: flex;*/
/*    float: left;*/
/*    width: 16%;*/
/*    max-width: 70px;*/
/*    height: auto;*/
/*    padding: 1rem;*/
/*}*/
</style>

<header class="master-header">
    <div>
        @php
            $logo = App\Models\BackEnd\SystemSetting::first();
        @endphp
        <a href="{{ route('home') }}"><img src="{{ asset('backend/system_setting/' . $logo->logo) }}"
                class="mobile twf-mobile-logo clear" alt="Bridal Harmony - Logo"></a>

    </div>
    <div class="mobile-tab hide">
        <div id="nav-icon4">
            <span></span> 
            <span></span>
            <span></span>
        </div>
    </div>
    <nav class="navbar menu">
        <div class="navigation-menu">
            <a href="{{ route('home') }}"><img src="{{ asset('backend/system_setting/' . $logo->logo) }}" alt="logo" style="height: 86px; padding-left:40px"></a>
        <ul class="desk-nav">

            <li id="home-li">
                <ul class="header-left">
                    <li><a href="{{ route('home') }}" class="nav {{ request()->is('/') ? 'active' : '' }}"
                            id="activenav">Home</a></li>
                    <li><a href="{{ route('about_us') }}"
                            class="nav {{ request()->is('about_us') ? 'active' : '' }}">About Us</a></li>
                    <li class="portfolio">
                        <span>Portfolio <i class="fa-solid fa-caret-down"></i></span>
                      <ul class="submenu">
                            <li><a href="{{route('photography')}}">Photography</a></li>
                            <li><a href="{{route('cinematography')}}">Cinematography</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('blogs') }}"
                            class="nav {{ request()->is('blogs') ? 'active' : '' }}">Blog</a></li>
                    <li><a href="{{ route('branchwisepackage') }}"
                            class="nav {{ request()->is('packages','branchwisepackage') ? 'active' : '' }} ">Packages</a></li>
                    <li> <a href="{{ route('book_us') }}" class="nav">Book Us</a></li>
                    <li> <a href="{{ route('contact') }}" class="nav">Contact Us</a></li>
                    <li>
                        <a href="{{ route('login') }}"
                            class="nav-button">Login
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        </div>
        
    </nav>
</header>


<script>
    // if($('#nav > ul').hasClass('submenu')){
    //         if ($(window).width() < 992) {
    //             if ($('.submenu li').length) {
    //                 $('.submenu li').children("ul").siblings('a').attr('href', 'javascript::void()');
    //             }
    //         } 
    //     }
//     $(document).ready(function() {
//     $('.mobile-dropdown-toggle').click(function() {
//         $(this).next('.submenu').toggleClass('active');
//     });

// });

// window.onclick = function(event) { 

//      if (dropdown.classList.contains('active')) {
//     dropdown.classList.remove('active');
//   }
// }
</script>

