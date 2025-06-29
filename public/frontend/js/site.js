function newsletter_check_field(field, message) {
    if (!field) return true;
    if (field.type == "checkbox" && !field.checked) {
        alert(message);
        return false;
    }

    if (field.required !== undefined && field.required !== false && field.value == "") {
        alert(message);
        return false;
    }
    return true;
}

function newsletter_check(f) {
    var re = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-]{1,})+\.)+([a-zA-Z0-9]{2,})+$/;
    if (!re.test(f.elements["ne"].value)) {
        alert(newsletter.messages.email_error);
        return false;
    }
    if (!newsletter_check_field(f.elements["nn"], newsletter.messages.name_error)) return false;
    if (!newsletter_check_field(f.elements["ns"], newsletter.messages.surname_error)) return false;

    for (var i=1; i<newsletter.profile_max; i++) {
        if (!newsletter_check_field(f.elements["np" + i], newsletter.messages.profile_error)) return false;
    }

    if (!newsletter_check_field(f.elements["ny"], newsletter.messages.privacy_error)) return false;

    return true;
}

/*Header Add patch color on scroll */
$(document).scroll(function(){
    if(APP.isHome) {
        var fadeTop = $(".fold2-container").offset().top - 50;
        if($(this).scrollTop() > fadeTop){
            $('header').addClass("fade-down");
            if(!APP.isMobile){
                $('.logo-image').removeClass("hide");
                $('.logo-image').css({"width" : '12%', 'margin' : '0'});
                $('.navbar').css('width', '100%');
                // $('.navbar').css('background-color','rgb(205 40 40)');
                const homeLi=$("#home-li");
                for(var i=0; i<=7;i++){
                    homeLi.find('a')[i].style.cssText = 'color: black !important';
                    homeLi.find('.nav-button')[i].style.cssText = 'color: white !important';
                }
            }
        } else{
            $('header').removeClass("fade-down");
            if(!APP.isMobile) {
                $('.logo-image').addClass("hide");
                $('.logo-image').css({"width" : '0'});
                $('.navbar').css('width', '100%');
                $('.navbar').css('background-color','white');
                const homeLi=$("#home-li");
                for(var i=0; i<=7;i++){
                    homeLi.find('a')[i].style.cssText = 'color: black';
                }
            }
        }
    } else{
        $('header').removeClass("fade-down");
    }
});
/*Header Add patch color on scroll */

// Static variables - That do not change while scrolling
var header = $("header"),
    headerHeight = 90,//header.height(), // Get height of header
    logo = $(".twf-logo"), // Get the logo
    header_links = $(".master-header .navbar ul li");
    logoHeight = logo.height(), // Get logo height
    scrollUpTo = 300; // Animation until scrolled to this point
    op = 1;

// Scroll function
$(window).on("scroll", function() {
    if(APP.isHome) {
        // Dynamic variables - That do change while scrolling
        var yPos = $(this).scrollTop(), // Get the scroll Y-position
            yPer = (yPos / scrollUpTo); // Calculate percenage of yscroll
        // console.log("k"+yPer);
        // If percentage is over 100, set to 100
        if (yPer > 1) {
            yPer = 1;
        }
        // Dynamic variables for the elements
        var logoPos =( -1*(yPer*30)+30), // Calculate position of logo (starting from 50%)
            logoSize = ((headerHeight*yPer)-(logoHeight*yPer)+logoHeight), // Calculate new size height for logo
            headerPos = ((yPer * headerHeight) - headerHeight); // Calculate position of header (starting from minus the height of itself)
            op = ((op * yPer)*1.6)+1;
            // console.log(logoPos);
        // Change the top, left, transform and height of the logo

        logo.css({
            position: 'absolute',
            top: logoPos + "vh",
            // left: 'unset',
            transform: "translate3d(-" + 50 + "%,-" + 0 + "%,0)",
            opacity:op,
            height: logoSize,
			left: '50%'
        });
        header_links.css({
            opacity:op
        });

        var logoParentWidth = 0;
        if(yPos < 250){
            logoParentWidth = yPos - 100;
        }else{
            logoParentWidth = 150;
            logo.css({
               // position: 'relative', verticalAlign: 'middle', transform: 'none'
               position: 'relative', transform: 'none', 'left': 'auto'
            });
        }
        $('.logo-image').css({
            width: logoParentWidth + "px",
        })
    }
});


$(document).ready(function(){

    var nav = $('.desk-nav');
        if (nav.length) {
            var contentNav = nav.offset().top;
    }
    //Bouncing arrow
    window.setInterval(function () {
        $("#down_arrow").addClass("bounce");
        setTimeout(function () {
            $("#down_arrow").removeClass("bounce");
        }, 1000);
    }, 2000);

    $('#down_arrow').click(function () {
        $('html, body').animate({
            scrollTop: $('.fold2-container').offset().top
        },1500);
    });


    var responsiveBreaks = [
        {breakpoint: 480, settings: { slidesToShow: 1}},
        {breakpoint: 770, settings: {slidesToShow: 2}},
        {breakpoint: 1024, settings: {slidesToShow: 3}},
        {breakpoint: 1365, settings: {slidesToShow: 3}}
    ];

    /*  Home page article slider    */

    $('.articles').slick({
        infinite: true,
        autoplay: false, autoplaySpeed: 5000, dots: true, speed: 800, adaptiveHeight: false, arrows: true,
		slidesToShow: 3,
		slidesToScroll: 3,
        //slidesToScroll: APP.isMobile == true && APP.isIpad === '' ? 1 : 3,
        lazyLoad: 'progressive',
		responsive: [
            {
                breakpoint: 770,
				settings: {
                    slidesToShow: 2,
					slidesToScroll: 2
                }
			},
			{
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
			}
		]
    });
    /*  Home page article slider    */

    /*  Home page Story video slider    */
    var $videoContainer = $('.videos-container');
    var $serviceContainer = $('.service-container');
    var padding = '23%';
    if( APP.isMobile && !APP.isIpad){
        padding = "0";
    }
        $videoContainer.slick({
            autoplay: true, autoplaySpeed: 5000, centerMode: true, centerPadding: padding, slidesToShow: 1, arrows: true, adaptiveHeight: false, pauseOnHover: true, pauseOnFocus: true
        });

        $serviceContainer.slick({
            autoplay: true, autoplaySpeed: 5000, centerMode: true, centerPadding: padding, slidesToShow: 1, arrows: true, adaptiveHeight: false, pauseOnHover: true, pauseOnFocus: true
        });

    /*  Home page Story video slider    */


    /* Home page load more blogs redirect*/

    // $('#load-more').click(function (e) {
    //    e.preventDefault();
    //    window.location.href = APP.baseUrl + 'blog';
    // });
    /* Home page load more blogs redirect*/

    /*  Story slider change event    */
    $videoContainer.on('afterChange', function(event, slick, currentSlide, nextSlide){
        $('iframe#recentWorkFrame').remove();
        $('.video-wrapper a').show();
        $videoContainer.slick('slickPlay');
    });
    $videoContainer.on('afterChange', function(event, slick, currentSlide, nextSlide){
        $('iframe#recentWorkFrame').remove();
        $('.video-wrapper a').show();
        $videoContainer.slick('slickPlay');
    });

    // $serviceContainer.on('afterChange', function(event, slick, currentSlide, nextSlide){
    //     $('.video-wrapper a').show();
    //     $serviceContainer.slick('slickPlay');
    // });
    // $serviceContainer.on('afterChange', function(event, slick, currentSlide, nextSlide){
    //     $('.video-wrapper a').show();
    //     $serviceContainer.slick('slickPlay');
    // });

    /*  Story slider change event    */

    /*  Play home page video   */
    if($("#twf-bg-video").length) {
        setTimeout(function () {
            $('#twf-bg-video').get(0).play();
            $('#twf-bg-video').attr('loop', 'loop');
        }, 1500);
    }

    /*  Play home page video   */

    /* Play story video  */
    $('.video-wrapper a').on('click', function (e) {
        e.preventDefault();
        var videoURL = $(this).data('url');
        var ht = $(this).find('> img').height();
        $videoContainer.slick('slickPause');
        $(this).hide();
        $(this).parent().append('<iframe width="100%" id="recentWorkFrame" height="' + ht + '" src="'+ videoURL +'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe>');
        $(this).parent().removeClass('animated fadeInDown go');
        $(this).parent().addClass('full-screen-video');
    });
    $('.service-wrapper a').on('click', function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        var ht = $(this).find('> img').height();
        $serviceContainer.slick('slickPause');
        $(this).hide();
        $(this).parent().append('<img width="100%" id="recentWorkFrame" height="' + ht + '" src="'+ url +'" webkitallowfullscreen mozallowfullscreen allowfullscreen >');
        $(this).parent().removeClass('animated fadeInDown go');
        $(this).parent().addClass('full-screen-video');
    });
    /* Play story video  */

    /*  Mobile navbar button    */
    $('#nav-icon4').click(function(){
        $(this).toggleClass('open');
        $(".navbar").toggleClass('visible');
        $("header").toggleClass('mobile-bar');
    });

    $('.navbar ul li a').click(function () {
        if ($('#nav-icon4').hasClass('open')) {
            $(".navbar").toggleClass('visible');
            $("header").toggleClass('mobile-bar');
            $('#nav-icon4').removeClass('open');
            event.stopPropagation();
        }
    });
    /*  Mobile navbar button    */

    /*  Other pages static header  */

    if(!APP.isHome) {
        var color = '#ae534c8a';
        $('header').addClass("color-patch clear");
        $('li.logo-image').removeClass('hide');
        $('.logo-image').css({"width" : '150px', 'margin' : '0'});
        $('.master-header .navbar ul li img').css({'opacity':1,'height':'90px','width':'auto'});
        $('.navbar').css('width', '100%');
        $('img.twf-logo').addClass('normalize');
        var header_height = $('header').height();
        $('.main-container').css('margin-top',header_height);
        $('.master-header .navbar ul li').css('opacity',1);


    }
    /*  Other pages static header  */

    /* Work page featured video slider */
    var sliderPadding = '20%';
    if( APP.isMobile && !APP.isIpad){
        sliderPadding = "0%";
    }
    $('.video-slider').slick({
        dots: false, slidesToShow: 1, slidesToScroll: 1, centerPadding: sliderPadding, infinite: true,centerMode: true, autoplay: false, autoplaySpeed: 2000
    });
    /* Work page featured video slider */

    /* Work page video sliders */

    var responsiveArray = [
        {breakpoint: 480, settings: { slidesToShow: 1}},
        {breakpoint: 770, settings: {slidesToShow: 2}},
        {breakpoint: 1025, settings: {slidesToShow: 4}},
        {breakpoint: 1365, settings: {slidesToShow: 4}},
        {breakpoint: 1500, settings: {slidesToShow: 4}},
        {breakpoint: 2000, settings: {slidesToShow: 5}},
        {breakpoint: 3000, settings: {slidesToShow: 7}}
    ];

    $('#latest-work').slick({
        autoplay: true, autoplaySpeed: 5000,  dots: false, slidesToShow: 6, slidesToScroll: 1, arrows: true, infinite: true, responsive: responsiveArray, /*centerMode: true, centerPadding: '13%'*/
    });
    $('#most-popular-work').slick({
        // dots: false,  swipeToSlide: true, autoplay: false, infinite: false, variableWidth: true, centerMode: true, initialSlide: 1, slidesToShow: 4, slidesToScroll: 1,
        autoplay: true, autoplaySpeed: 5000,  dots: false, slidesToShow: 6, slidesToScroll: 1, arrows: true, infinite: true, responsive: responsiveArray, /*centerMode: true, centerPadding: '13%'*/
    });
    $('#favourite-work').slick({
        autoplay: true, autoplaySpeed: 5000,  dots: false, slidesToShow: 6, slidesToScroll: 1, arrows: true, infinite: true, responsive: responsiveArray, /*centerMode: true, centerPadding: '13%'*/
    });
    $('#related-work').slick({
        autoplay: true, autoplaySpeed: 5000,  dots: false, slidesToShow: 6, slidesToScroll: 1, arrows: true, infinite: true, responsive: responsiveArray, /*centerMode: true, centerPadding: '13%'*/
    });
    $('#behind-the-scene').slick({
        autoplay: true, autoplaySpeed: 5000,  dots: false, slidesToShow: 6, slidesToScroll: 1, arrows: true, infinite: true, responsive: responsiveArray, /*centerMode: true, centerPadding: '13%'*/
    });
    /* Work page video sliders */

    /* Work page slider youtube videos  */
    $('.video-play-icon a').on('click', function (e) {
        e.preventDefault();
        var videoID = $(this).data('video');
        var videoType = $(this).data('video-type');
        var $parent = $(this).parent().parent();
        var ht = $parent.find('> img').height();
        $('.video-slider').slick('slickPause');

        //[FIX] To open video in full screen animate.css has a bug.. Below is solution
        $parent.parent().removeClass('animated fadeIn go');
        $parent.parent().addClass('full-screen-video');

        $(this).hide();
        $parent.find('> img, p').hide();
        if(videoType === 'YouTube'){
            $parent.append('<iframe width="100%" height="' + ht + '" src="' + videoID + '?autoplay=1&amp;rel=0&amp;showinfo=0&amp;wmode=transparent" frameborder="0" allowfullscreen ></iframe>');
        } else if(videoType === 'Vimeo') {
            $parent.append('<iframe width="100%" height="' + ht + '" src="' + videoID + '?autoplay=1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe>');
        }
    });

    /*  slider change event    */
    $('.fetured-video-section').on('afterChange', function (event, slick, currentSlide, nextSlide) {
        $('.video-slider').slick('slickPlay');
        $('iframe').remove();
        $('.video-play-icon a').show();
        $('.video-play-icon a').parent().parent().find('> img, p').show();
    });

    /* Work page slider youtube videos  */
    $('.work-wrapper a').on('click', function (e) {
        e.preventDefault();
        var videoURl = $(this).data('url');
        var ht = $('#work-show').height();
        // console.log("dfd"+ht);
        $(this).hide();
        $(this).parent().find('> img').hide();
        $(this).parent().find('> .video-bg').hide();
        $(this).parent().append('<iframe width="100%" height="' + ht + '" src="' +  videoURl + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe>');

        //[FIX] To open video in full screen animate.css has a bug.. Below is solution
        $(this).parent().removeClass('animated fadeIn go');
        $(this).parent().addClass('full-screen-video');
    });


    /*  Workshop info page feedback video slider    */
    var $feedbackVideoContainer = $('.feedback-videos-container');
    var padding2 = '20%';
    if (APP.isMobile && !APP.isIpad) {
        padding2 = "0";
    }
    $feedbackVideoContainer.slick({
        centerMode: true, centerPadding: padding2, slidesToShow: 1, arrows: true, autoplay: false, autoplaySpeed: 5000
    });

    /*  slider change event    */
    $feedbackVideoContainer.on('afterChange', function (event, slick, currentSlide, nextSlide) {
        $("iframe.iframe-"+currentSlide).attr('src', function ( i, val ) { return val; });
    });

    /*  slider change event    */
    /*  Workshop info page feedback video slider    */

    /*  Workshop types slider animation    */

    $('.types').click(function (e) {
        e.preventDefault();
        var index = $(this).data('index');
        var mobile = '';
        var array = [1, 2, 5, 6];
        if(APP.isMobile && !APP.isIpad && array.includes(index)  ) {
            mobile = '-mobile';
        }

        $('.workshop-chapter-detail').not('.chapter-detail' + index + mobile).slideUp();
        $('.workshop-chapter-detail').not('.chapter-detail' + index + mobile).removeClass('mobile');
        if(mobile.length > 0) {
            $('.chapter-detail' + index + mobile).slideToggle('fast', function () {
                $(this).toggleClass('mobile');
            });
        } else {
            $('.chapter-detail' + index ).slideToggle();
        }
        $('.types').not('.type' + index).removeClass('active');
        $('.type' + index).toggleClass('active');
    });

    /*  Workshop types slider animation    */

    /*  Workshop Info slide toggle    */

    $('.location-wrapper').click(function (e) {
        // e.preventDefault();
        var index = $(this).data('index');
        $('.workshop-instruction-section').not('.instruction-section' + index).slideUp();
        $('.instruction-section' + index).slideToggle();
    });

    /*  Workshop Info slide toggle    */

    /*  FAQ section answers toggle   */

    $('.question, .question-logo').click(function (e) {
        e.preventDefault();
        var index = $(this).data('index');

        $('.question').not('.question' + index).removeClass('active');
        $('.question' + index).toggleClass('active');

        $('.answers').not('.answer' + index).slideUp();
        $('.answer' + index).slideToggle();

    });

    /*  FAQ section answers toggle    */

    //Workshop full screen video close button
    $('.close-btn').click(function () {
        $.colorbox.close();
        // $("#workshop-video").find('iframe').show()[0].src = '';
    });
    /* Workshop tutorial video pop up */

    /*  Press page article slider    */
    $('.press-articles').slick({
        infinite: true,
        autoplay: true, autoplaySpeed: 5000,
        dots: true, speed: 800, adaptiveHeight: false, arrows: true, responsive: responsiveBreaks, slidesToShow: 3,
        slidesToScroll: APP.isMobile == true && APP.isIpad === '' ? 1 : 3,
        lazyLoad: 'progressive',
    });
    /*  Press page article slider    */

    /* contact form date pickers */
    $('#start_date').datepicker({
        dateFormat: 'dd/mm/yy'
    });

    $('#end_date').datepicker({
        dateFormat: 'dd/mm/yy'
    });
    /* contact form date pickers */

    /* enroll form date pickers */
    $('#dob').datepicker({
        dateFormat: 'dd/mm/yy'
    });
    /* enroll form date pickers */


    $('#workshop-insta-imgs').slick({
        infinite: true, autoplay: true, dots: false, arrows: false, autoplaySpeed: 5000, slidesToShow: 6, slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 2000,
                settings: { slidesToShow: 5, slidesToScroll: 1, infinite: true}
            },
            {
                breakpoint: 1550,
                settings: { slidesToShow: 4, slidesToScroll: 1, infinite: true}
            },
            {
                breakpoint: 1024,
                settings: { slidesToShow: 3, slidesToScroll: 1, infinite: true}
            },
            {   breakpoint: 600,
                settings: {slidesToShow: 2, slidesToScroll: 1, infinite: true }
            },
            {   breakpoint: 480,
                settings: { slidesToShow: 1, slidesToScroll: 1, infinite: true }
            }
        ]
    });

    // $('.magazine-wrapper').colorbox({
    //    rel: 'grp1', height: "auto", transition:"fade",width:"90%"
    // });
    if (APP.isMobile || APP.isIpad) {
        $('.magazine-wrapper').colorbox({
            rel: 'grp1', height: "auto", transition:"fade",width:"90%"
        });
    }else {
        $('.magazine-wrapper').colorbox({
            rel: 'grp1', height: "90%", transition:"fade",width:"auto"
        });
    }
    
    $('.open-work-with-us-popup').colorbox({
        inline:true,
        href: '#work-with-us',
        inline: true,
        width: '95%',
        maxWidth: '800px',
        height:'80%',
        transition:'none',
    });

    $('#resume_upload').on('change', function() {
        setTimeout(function(){
            truncatefile();
        }, 50);

    });
    // $('.magazine-wrapper').click(function(e){
    //     e.preventDefault();
    //     var url = $(this).data('img-url');
    //     $('#magazine-popup').find('img.magazine').attr('src', url );
    //
    //     $(this).colorbox({
    //         href: '#magazine-popup', inline: true, width: '100%', height: '100%', opacity: 0.6, closeButton: false,
    //         onLoad:function() {
    //             $('html, body').css('overflow', 'hidden'); // page scrollbars off
    //         },
    //         onClosed:function() {
    //             $('html, body').css('overflow', ''); // page scrollbars on
    //         }
    //     });
    // });

    $('.close-button').click(function () {
        $.colorbox.close();
    });

    // set height to home page video iframe


    //Press page background audio control
    $('#volume-control').click(function (e) {
        $(this).toggleClass('mute');
        if($(this).hasClass('mute')) {
            setVolume(0);
            $(this).find('> img').attr('src', 'images/press/BTN__Mute.png');
        } else{
            setVolume(1);

            $(this).find('> img').attr('src', 'images/press/BTN__Sound.gif');
        }
    });

	$('.crew-bg-slider').slick({ autoplay: true, autoplaySpeed: 5000, dots: true, arrows: false });

    $('.story-carousel').slick({ autoplay: true, autoplaySpeed: 5000, dots: true, arrows: true, lazyLoad: 'progressive' });

	//centered text in page
	$('.story').height($(window).height() - $('footer').innerHeight() - $('header').innerHeight() - 2);
	$('.sitemap-div').height($(window).height() - $('footer').innerHeight() - $('header').innerHeight() - 2);
	$('.error-title').parent().height($(window).height() - $('footer').innerHeight() - $('header').innerHeight() -2);
});


function setVolume(myVolume) {
    var myMedia = document.getElementById('audioClip');
    myMedia.volume = myVolume;
}


function showPopup() {
    alert('saas');
    var $popup = $("#small-popup");
    $popup.toggleClass("show");
    if ($popup.hasClass('show')) {
        setTimeout(function () {
            $popup.removeClass("show");
        }, 10000);
    }
}

function truncatefile() // calling a function on change or select
{
    var fup = document.getElementById('resume_upload'); //store file by ID
    var file = fup.files[0]; // store value of file
    var filePath = fup.value;
    var name;
    if (filePath == "") {
        document.getElementById('upload-resume-txt').innerHTML = 'Upload Resume';
    }
    else {
        name = filePath.replace(/^.*[\\\/]/, '');

        var ext = filePath.substring(filePath.lastIndexOf('.') + 1);//getting file extension

        var fileName = name.substring(0, name.length - 4); // storing 0th position till extension begining

        var fileNameNew = "";
        if (fileName.length > 15) {
            if( APP.isMobile ){
                var fileNameFst = fileName.substring(0, 5); //firstpart of file
            }else {
                var fileNameFst = fileName.substring(0, 10); //firstpart of file
            }


            var fileNameLst = fileName.substring(fileName.length - 6, fileName.length); //last part of file
            fileNameNew = fileNameFst + "...." + fileNameLst + "." + ext; //combine all parts
        }
        else {
            fileNameNew = fileName + "." + ext; //if length less than 30
        }
        document.getElementById('upload-resume-txt').innerHTML = fileNameNew;
    }
}
