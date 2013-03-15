<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="/css/fitpark.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="/js/slider/jquery.bxslider.js"></script>
        <!--<link rel="stylesheet" href="/js/slider/jquery.bxslider.css" />-->
        <script type="text/javascript" src="/js/main.js"> </script>
    </head>
    <body>
        <header id="title">
            <span class="name-section"><a href="#" class="my-link">Фитнес-клубы</a></span>
        </header>
<!--        <section id="content" class="">
            <div class="image-set" id="slider">
                <img src="/image/main-slider1.png" alt="" width="1100" />
                <img src="/image/main-slider2.png" alt="" width="1100" />
                <img src="/image/main-slider3.png" alt="" width="1100" />
            </div>
            <table class="main-control">
                <tr>
                    <td align="center" valign="bottom">
                        <table >
                            <tr>
                                <td align="center">
                                    <div class="switch-slide">
                                        <div class="non-active-point"></div>
                                        <div class="non-active-point"></div>
                                        <div class="non-active-point"></div>
                                        <div style="clear: both;"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <div class="main-button"></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </section>-->
        <section id="content">
            <ul class="bxslider">
                <li><img src="/image/main-slider1.jpg" title="Funky roots" /></li>
                <li><img src="/image/main-slider2.jpg" title="The long and winding road" /></li>
                <li><img src="/image/main-slider3.jpg" title="Happy trees" /></li>
            </ul>
            <table width="100%" class="main-controls-slide">
                <tr>
                    <td align="center">
<!--                        <div class="switch-slide">-->
                       <div class="control-slide">
                            <div class="active-point" index="0"></div>
                            <div class="non-active-point" index="1"></div>
                            <div class="non-active-point" index="2"></div>
                            <div style="clear: both;"></div>
                        </div>
<!--                        </div>-->
                        <div style="clear: both;"></div>
                        <div class="main-button"></div>
                    </td>
                </tr>
            </table>
        </section>
    </body>
</html>

