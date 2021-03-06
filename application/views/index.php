<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
    <head>
        <title><?=$titleText;?></title>
        <meta name="description" content="<?=$desc;?>"/>
        <meta name="keywords" content="<?=$keywords;?>"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name='yandex-verification' content='781c2dd8ae286aca' />
        <meta name="google-site-verification" content="LPcTvq9lj7flD6_bLTq3HL-vJF9SFxRaLNq0eWIYGLs" />

        <link rel="icon" href="<?=$favicon;?>" type="image/vnd.microsoft.icon"/>
        <link rel="shortcut icon" href="<?=$favicon;?>" type="image/x-icon"/>

        <link rel="stylesheet" type="text/css" href="styles/style.css" media="all"/>   
        <!--[if IE]><link rel="stylesheet" type="text/css" href="styles/ie.css"/><![endif]-->
        <link rel="stylesheet" type="text/css" href="/css/common/fitpark.css"/>
        <link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox.css"/>
        <link rel="stylesheet" type="text/css" href="/js/fancybox/helpers/jquery.fancybox-buttons.css"/>
        <link rel="stylesheet" type="text/css" href="/js/fancybox/helpers/jquery.fancybox-thumbs.css"/>

        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
        <script src="//vk.com/js/api/openapi.js?96"></script>
        <script type="text/javascript" src="/js/header.js"></script>
        <script type="text/javascript" src="/js/common.js"></script>
        <script type="text/javascript" src="/js/cb/jquery.colorbox.js"></script>
        <script type="text/javascript" src="/js/cb/colorbox.jquery.json"></script>
        <script type="text/javascript" src="/js/jquery.form.validation.js"></script>
        <script type="text/javascript" src="/js/fancybox/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="/js/fancybox/helpers/jquery.fancybox-buttons.js"></script>
        <script type="text/javascript" src="/js/fancybox/helpers/jquery.fancybox-media.js"></script>
        <script type="text/javascript" src="/js/fancybox/helpers/jquery.fancybox-thumbs.js"></script>
        <script type="text/javascript" src="/js/fancybox/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="/js/validator_helper.js"></script>
        <script type="text/javascript" src="/js/raty-2.5.2/jquery.raty.js"></script>
        <script type="text/javascript" src="/js/slider/jquery.bxslider.js"></script>
</head>
<body>


        <? $this->load->view("scripts/".$currentCity->english_name."/header");?>
        <div class="main">
        <header id="title">
            <div id="title-menu">
                <ul>
                    <li class="name-section"><a href="#" class="my-link">Главная</a></li>
                    <li class="name-section"><a href="clubs" class="my-link">Фитнес-клубы</a></li>
                </ul>
                <ul class="title-section-right">
                    <li class="name-section">
                        <span></span>
                        <a class="my-link" href="#" id="city-changed"><?=$currentCity->name;?></a>
                    </li>
                </ul>
            </div>
        </header>
            <section id="content">
                <!--            Выбор города-->
                <div class="dnone">
                    <div class="message-dialog" id="change-city-window">
                        <header>
                            Выберите город
                        </header>
                        <table class="center_table">
                            <tr>
                                <td align="center" valign="middle">
                                    <ul class="city-list">
                                        <? foreach($availableCity as $city) {?>
                                            <li>
                                                <div class="active-city">
                                                    <a href="<?=prep_url($city->url);?>">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <img src="<?=$city->symbol_path;?>" alt=""/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="change-city-name">
                                                                    <?=$city->name;?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <!--                                        <img src="dsmnfs" alt=""/>-->

                                                    </a>
                                                </div>
                                            </li>
                                        <? } ?>
                                    </ul>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
<!--                конец Выбор города-->

                <section id="main-banner">
                    <table class="main-banner-header" cellspacing="0">
                        <tr>
                            <td class="main-banner-image" >
                                <img src="/image/banner-left-image.png" height="99%"/>
                            </td>
                            <td class="main-banner-content">
                                <table>
                                    <tr>
                                        <td colspan="2"><img src="/image/new_logo.png" alt="" valign="middle" class="main-banner-logo" /></td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top" class="main-baner-content-img">
                                            <img src="/image/review-book.png" alt="" valign="top" />
                                        </td>
                                        <td class="main-banner-content-item" valign="top">
                                            <header>
                                                <a href="/clubs" class="invert-href">
                                                    <h1 class="main-baner-h1">
                                                        Отзывы клиентов фитнес-клубов
                                                    </h1>
                                                </a>
                                            </header>
                                            <div>
                                                Читай чужие и пиши свои. Оцени свой клуб
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top" class="main-baner-content-img">
                                            <img src="/image/fotos.png" alt="" valign="top"/>
                                        </td>
                                        <td class="main-banner-content-item" valign="top">
                                            <header>
                                                <a href="/clubs" class="invert-href">
                                                    <h1 class="main-baner-h1">
                                                        Фотографии фитнес-центров
                                                    </h1>
                                                </a>
                                            </header>
                                            <div>
                                                Изучи любой фитнес-клуб по подробным фотографиям
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top" class="main-baner-content-img">
                                            <img src="/image/parametrs.png" alt="" valign="top" />
                                        </td>
                                        <td class="main-banner-content-item main-banner-content-item-last" valign="top">
                                            <header>
                                                <a href="/clubs" class="invert-href">
                                                    <h1 class="main-baner-h1">
                                                        Подбор по параметрам
                                                    </h1>
                                                </a>
                                            </header>
                                            <div>
                                                Используй фильтр для сортировки по интересующим услугам
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="main-banner-image">
                                <img src="/image/banner-right-image.png" alt="" height="99%" />
                            </td>
                        </tr>
                    </table>
                    <table class="main-banner-toolbar">
                        <tr>
                            <td colspan="3">
                                <h1 class="main-baner-h1">
                                    <?=lang("header_main");?>
                                </h1>
                            </td>
                        </tr>
                        <tr>
                            <td class="main-banner-toolbar-content">
                                <?if(!empty($services)) {?>
                                    <h3 class="main-banner-toolbar-h3">Показать фитнес-клубы:</h3>
                                <? } else { ?>
                                    <h3 class="main-banner-toolbar-h3">Воспользуйтесь поиском:</h3>
                                <? }?>
                                <ul class="main-baner-tb-service">
                                <? foreach ($services as $service) {?>
                                    <li>
                                        <img src="<?=$service->icon;?>" alt="" class="main-banner-services-icons" />
                                        <a href="<?=site_url(array("clubs","getByService",$service->id));?>">
                                            <span class="main-baner-tb-service-item"><?=$service->other_form;?></span>
                                        </a>
                                    </li>
                                <? } ?>
                                </ul>
                            </td>
                            <td align="center" valign="top" class="main-banner-tb-fulllist-wrap" align="center">
                                <a href="/clubs">
                                    <div class="button-club main-banner-tb-full-list">
                                        <ul>
                                            <li>
                                                <div class="icon-small-clublist"></div>
                                            </li>
                                            <li class="full-list-text">
                                                <span class="button-text">Перейти к полному списку фитнес-клубов</span>
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                                <div class="search-home-page-wrap">
                                    <? $this->load->view("search_form"); ?>
                                </div>
                            </td>
                            <td class="main-banner-toolbar-content">
                                <h3 class="main-banner-toolbar-h3 ">Популярные клубы города:</h3>
                                <ul class="main-baner-tb-service main-baner-tb-clubs">
                                    <table>
                                        <? foreach ($clubs as $club) { ?>
                                        <tr>
                                            <td valign="middle">
                                                <a href="<?=site_url(array("club",$club->id));?>">
                                                    <img src="<?=$club->head_picture;?>" alt="" />
                                                </a>
                                            </td>
                                            <td valign="middle" style="padding-left: 10px;">
                                                <a href="<?=site_url(array("club",$club->id));?>">
                                                    <?=$club->name;?>
<!--                                                    <span class="main-baner-tb-service-item"></span>-->
                                                </a>
                                            </td>
                                        </tr>
                                        <? } ?>
                                    </table>
                                </ul>
                            </td>
                        </tr>
                    </table>
                </section>
                <section id="main-content">
                    <h2><?=lang("header_description");?></h2>
            <p>С каждым годом все актуальнее становится держать себя в хорошей форме. И легче всего это сделать с помощью фитнес центров или тренажерных залов.</p>
            <p>Но предложений огромное количество и выбрать наиболее подходящий клуб не так просто. Ведь необходимо посетить значительное количество сайтов, позвонить для уточнения цены на фитнес, сравнить предложения сетей и местных организаций, изучить акции и скидки.</p>
            <p>С ФитПарком это легко. У нас есть информация по всем фитнес организациям города.</p>
            <p>Сравнивайте, выбирайте и вперед, навстречу прекрасной фигуре.</p>

            <h2>Оценивайте фитнес клубы города</h2>
            <p>На ФитПарке для каждого клуба можно поставить оценку и оставить отзыв.</p>
            <p>Ведь именно мы, клиенты, должны влиять на качество оказываемых услуг.</p>
            <p>Ко всем прочему, комментарии и оценки помогут другим людям определиться с выбором фитнес центра или тренажерного зала.</p>

            <h2>Подбор организации по требуемым параметрам</h2>
            <p>Благодаря нашему фильтру, можно быстрой найти клуб с необходимым набором услуг.</p>
            <p>Для кого-то важно именно наличие бассейна, для кого-то наличие персонального инструктора по фитнесу.</p>
            <p>Просто выбирайте параметры, и ФитПарк найдет подходящие спортивные центры.</p>

            <h2>Актуальные фото фитнес клубов</h2>
            <p>Прежде, чем принять решение о звонке или покупке абонемента, каждый из нас хочет увидеть товар лицом.</p>
            <p>Именно для этого мы собираем фотографии центров и тренажерных залов.</p>
            <p>По ним вы сможете определить качество залов, оборудования, раздевалок.</p>
            <p>И после этого вам будет гораздо легче принять решение в пользу того или иного спортивного заведения.</p>

            <h2>Быстрая связь с фитнес клубом</h2>
            <p>Специально для наших пользователей мы предоставляем возможность быстрой связи с понравившимся фитнес клубом. Вы можете заказать звонок от менеджера спортивной организации, задать вопрос, записаться на гостевое посещение или оставить заявку на приобретение абонемента в фитнес центр.</p>

            <h2>Удобная подача информации</h2>
            <p>Для нас важно удобство пользователей. Поэтому у нас нельзя найти мигающих баннеров и рекламных картинок на каждом шагу.</p>
            <p>А четкое структурирование информации позволит комфортно подобрать и оценить фитнес клуб.</p>

            <h2>Информация о вариантах абонементов и цены на фитнес услуги</h2>
            <p>Нас всегда интересует стоимость на фитнес услуги, и на какой срок можно приобрести карту посещения.</p>
            <p>Мы ежедневно прикладываем усилия, чтобы вы имели возможность видеть актуальные данные по расценкам и длительности абонементов.</p>
            <p>Если у какого-то клуба вы не увидите расценок, это значит, что мы именно сейчас делаем все, чтобы их предоставить нашим посетителям.</p>

            <h2>Составление программ тренировок от профессиональных фитнес инструкторов</h2>
            <p>Совсем скоро мы дадим возможность любому пользователю заказать программу у профессиональных фитнес инструкторов ведущих клубов.</p>
            <p>Это позволит вам быстрее достичь результата без лишнего риска.</p>
            <p>Мы планируем запустить данный сервис уже в конце июня.</p>


                </section>
                <div style="clear: both;"></div>
            </section>
            <div class="spacer">
            </div>
        </div>
        <footer>
            <div class="centerSpan">
                <div class="share42init"></div>
                <script type="text/javascript" src="/js/share42/share42.js"></script>
                <script type="text/javascript">share42('http://фитпарк.рф/js/share42/')</script>
                <hr/>
            </div>
            <div class="centerSpan">
                <p>Проводник в мир фитнеса «ФитПарк». Фитнес клубы, расписание тренировок, цены абонементов, отзывы.</p>
                <p>Информация на сайте не является публичной офертой</p>
                <p>
                   «ФитПарк» 2012-2013. Все права защищены.
                </p>
            </div>
        </footer>
        <!--footer-->
 

<!--<!-- Rating@Mail.ru counter -->
<!--<script type="text/javascript">//<![CDATA[-->
<!--var _tmr = _tmr || [];-->
<!--_tmr.push({id: '2360902', type: 'pageView', start: (new Date()).getTime()});-->
<!--(function (d, w) {-->
<!--var ts = d.createElement('script'); ts.type = 'text/javascript'; ts.async = true;-->
<!--ts.src = (d.location.protocol == 'https:' ? 'https:' : 'http:') + '//top-fwz1.mail.ru/js/code.js';-->
<!--var f = function () {var s = d.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ts, s);};-->
<!--if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }-->
<!--})(document, window);-->
<!--//]]></script><noscript><div style="position:absolute;left:-10000px;">-->
<!--<img src="//top-fwz1.mail.ru/counter?id=2360902;js=na" style="border:0;" height="1" width="1" alt="Рейтинг@Mail.ru" />-->
<!--</div></noscript>-->
<!--<!-- //Rating@Mail.ru counter —>-->
    </body>
</html>
