<!DOCTYPE html>
<html lang="vi">



<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="language" content="vi">
    <meta http-equiv="Refresh" content="1800">
    <link rel="icon" href="/img/favicon.png">
    <title>Nemoviz VR3D for Real Estate</title>
    <base href="{{ asset('') }}">
    <!-- CSS !-->
    <link rel="stylesheet" href="fontawesome-free-5.15.4-web/fontawesome-free-5.15.4-web/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=vietnamese" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="css/slick/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- <link rel="stylesheet" href="./use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> -->
    <link rel='stylesheet' href='cdn.jsdelivr.net/gh/rstacruz/nprogress%40master/nprogress.css'>
    <link rel="preload" as="style" onload="this.rel='stylesheet'" href="css/stylesheet.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/responsive/responsive.css" type="text/css" media="all">
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"
  />

    <link rel='stylesheet' href='cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/assets/owl.carousel.min.css'>
    <link rel="stylesheet" href="WOW-master/css/libs/animate.css">


    <link rel="stylesheet" href="css/menu_drop.css">

    <!-- Resource style -->
    <script src="js/modernizr.js"></script>
    <!-- Modernizr -->
    <script type="text/javascript" src="js/jquery_3.2.1.js"></script>
    <script type="text/javascript" src="js/init.js"></script>
    <script src="js/lazysizes.min.js" async></script>
    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            '//connect.facebook.net/en_US/fbevents.js');
        fbq('init', '748648746482410');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=748648746482410&amp;ev=PageView&amp;noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->
</head>
<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<body>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112271268-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-112271268-2');
    </script>

    <div id="wrapper">
        <div id="nav">
            <header>
                <div id="header" class="bg_header_page">
                    <div class="logo">
                        <a href="index"><img class="logo-nemoviz " style="" src="img/logo21.png"></a>
                    </div>
                    <div class="nav_header">
                        <div id="nav_sticky" class="menu-content overlay">
                            <nav class="menu">
                                <ul>
                                    @foreach ($pages as $page)
                                        @if ($page->title =="home")
                                            <li class="menu__item">
                                                <!-- home -->
                                                <a href="/index"  class="menu__link  menu_news {{ Request::segment(1) === 'index' ? 'active' : '' }} ">{{__($page->title)}}</a>
                                            </li>
                                        @elseif($page->title !=="header")
                                            <li class="menu__item to-left">

                                                <a href="/{{$page->title}}" class="menu__link  menu_news {{ Request::segment(1) === $page->title ? 'active' : '' }} ">{{__($page->title)}}</a>

                                            </li>
                                        @endif
                                    @endforeach
                                    <li class="menu__item to-left">
                                        <a href="/language/en" class="menu__link   "><img class="icon_language" src="img/en.png" alt=""> </a>
                                    </li>
                                    <li class="menu__item to-left">
                                        <a href="/language/vn" class="menu__link  "><img class="icon_language" src="img/vn.png" alt=""> </a>
                                    </li>
                                </ul>
                                <div class="mobile_icon">
                                    <ul style="margin-top:2rem">
                                        <li style="text-align:center">
                                            <a href="{{__('nemoviz_facebook')}}">
                                                <img src="img/logo_fb1.png" style="width:30px" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="icon_logo">
                                        <li class="link_icon_mobile">
                                            <a href="{{__('nemoviz_instagram')}}">
                                                <img src="img/logo-instagram-5.png" style="width:40px" alt="">
                                            </a>
                                        </li>

                                        <li class="link_icon_mobile">
                                            <a href="{{__('nemoviz_twitter')}}">
                                                <img src="img/logo_linkin.png" style="width:38px" alt="">
                                            </a>
                                        </li>
                                        <li class="link_icon_mobile">
                                            <a href="{{__('nemoviz_youtube')}}">
                                                <img src="img/ytb.png" style="width:40px" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </nav>
                        </div>

                        <div id="nav-icon" class="menu-button visible-xs">
                            <span class="burger-icon"></span>
                        </div>
                    </div>
                </div>
            </header>
        </div>

             {{--  <section id="new1" class="back_all" style="position: relative;">  --}}
                <section class="back_all" style="position: relative;">
            @yield('content')
            @include('template.footer')
             </section>

            <!-- /WhatsHelp.io widget -->
            <script type='text/javascript' src='js/map_3d_2.js'></script>
            <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2Zb2vY8-t_9BUYqFFjc9LQiNWUZPLft4&callback=initialize" async="" defer="defer" type="text/javascript"></script>-->

            <script type="text/javascript">

                var map;

                $(document).ready(function() {

                });
                    $(document).ready(function(){
                    $("#load-iframe").click(function(){
                        $(".background-tour").hide();
                        $(".show-iframe").show();
                    });
                });
            </script>
            @if(Request::segment(1) !== 'news')
            <script async src="/js/youtube_2.js"></script>
            <script async custom-element="amp-youtube" src="js/youtube_1.js"></script>
            @endif
            <script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
            <script type="text/javascript" src="js/menu_header.js"></script>
            <script src="js/slick.min.js"></script>
            <script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
            <script src="js/jquery.menu-aim.js"></script>
            <!-- menu aim -->
            <script src="js/main.js"></script>
            <!-- Resource jQuery -->
            <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
            <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
            <script type="text/javascript" src="js/fancy2.js"></script>
            <script type="text/javascript" src="js/fancy1.js"></script>
            <script type="text/javascript" src="js/edit_js.js"></script>
            <script type="text/javascript" src="js/edit_slick.js"></script>
            <script type="text/javascript" src="js/jquery.boxes.js"></script>
            <script type="text/javascript" src="js/jquery.boxes.repopup.js"></script>
            <script src="js/main.js"></script>
    </div>


</body>
<!-- <script>
    ! function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
            p = /^http:/.test(d.location) ? 'http' : 'https';
        if (!d.getElementById(id)) {
            js = d.createElement(s);
            js.id = id;
            js.src = p + '://platform.twitter.com/widgets.js';
            fjs.parentNode.insertBefore(js, fjs);
        }
    }(document, 'script', 'twitter-wjs');
</script>
<script src="../apis.google.com/js/platform.js" async defer>
    {
        lang: 'vi'
    }
</script> -->


<!-- Mirrored from vr360.com.vn/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 May 2022 07:32:18 GMT -->

</html>
