<!DOCTYPE html>
<html>
    <head>
        <title><?=$titleText;?></title>
        <meta name="description" content="<?=$desc;?>">
        <meta name="keywords" content="<?=$keywords;?>">
        <link rel="stylesheet" href="/css/fitpark.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
        <link rel="stylesheet" href="/js/fancybox/jquery.fancybox.css" />
        <link rel="stylesheet" href="/js/fancybox/helpers/jquery.fancybox-buttons.css" />
        <link rel="stylesheet" href="/js/fancybox/helpers/jquery.fancybox-thumbs.css" />

        <link rel="icon" href="/image/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="/image/favicon.ico" type="image/x-icon">

        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
        <script type="text/javascript" src="/js/cb/jquery.colorbox.js"></script>
        <script type="text/javascript" src="/js/common.js"></script>
        <script type="text/javascript" src="/js/jquery.form.validation.js"></script>
        <script type="text/javascript" src="/js/fancybox/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="/js/fancybox/helpers/jquery.fancybox-buttons.js"></script>
        <script type="text/javascript" src="/js/fancybox/helpers/jquery.fancybox-media.js"></script>
        <script type="text/javascript" src="/js/fancybox/helpers/jquery.fancybox-thumbs.js"></script>
        <script type="text/javascript" src="/js/fancybox/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="/js/validator_helper.js"></script>
        <script type="text/javascript" src="/js/raty-2.5.2/jquery.raty.js"></script>
        <script type="text/javascript" src="//vk.com/js/api/openapi.js?96"></script>
        <script type="text/javascript" src="/js/header.js"></script>

<!--<script type="text/javascript">
  VK.init({apiId: 3689827, onlyWidgets: true});
</script>-->
        <link rel="shortcut icon" href="/image/favicon.ico" type="image/x-icon">
    </head>
    <body>

<!--    facebook.com-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>
dataLayer = [];
</script>
<!--    end facebook.com-->

<!--    vk.com    -->
<script type="text/javascript">
  VK.init({apiId: 3677727, onlyWidgets: true});
</script>
<!--    end vk.com-->

<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-3WQD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-3WQD');</script>
<!-- End Google Tag Manager -->
<?=$currentCity->header_scripts;?>

        <div class="main">
        <header id="title">
            <div id="title-menu">
                <ul>
                    <li class="name-section"><a href="<?=base_url();?>" class="my-link">Главная</a></li>
                    <li class="name-section"><a href="<?=site_url(array('clubs'));?>" class="my-link">Фитнес-клубы</li>
                    <li class="name-section"><a href="<?=site_url(array('ManagerPrivate'));?>" class="my-link">Менеджерам</li>
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
            <header class="header">
                <div class="logo">
                    <a href="<?=base_url();?>">
                        <img src="<?=site_url(array('image','new_logo.png'))?>"></img>
                    </a>
                </div>

                <div class="header-content">
                    <div class="search-header-wrapper">
                        <? include_once("search_form.php"); ?>
                    </div>


                </div>
            </header>

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


            <!--окошко-->

            <div class="dnone">
                <div id="get-guest" class="message-dialog">
                    <form action="" method="post">
                        <table width="100%" class="window">
                            <tr>
                                <td colspan="2" class="hide-text">
                                    Все поля обязательны для заполнения
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="error-text">

                                </td>
                            </tr>
                            <tr>
                                <td class="window-name-options">Имя</td>
                                <td><input type="text" class="checkout-input search" text="Имя" validator="blank" name="name"/></td>
                            </tr>
                            <tr>
                                <td class="window-name-options">Телефон</td>
                                <td><input type="text" class="checkout-input search" text="Телефон" validator="blank" name="tel"/></td>
                            </tr>
                            <tr>
                                <td class="window-name-options">E-mail</td>
                                <td><input type="text" class="checkout-input search" text="E-mail" validator="email" name="e-mail"/></td>
                            </tr>
                            <tr>
                                <td class="window-name-options">Дата посещения</td>
                                <td><input type="text" class="checkout-input search" text="Дата посещения" validator="date" name="date"/></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <div class="button-send button">Отправить</div>
                                </td>
                            </tr>

                        </table>
                    </form>
                </div>
            </div>

            <div class="dnone">
                <div id="get-answer" class="message-dialog">
                    <form action="" method="post">
                        <table width="100%" class="window">
                            <tr>
                                <td colspan="2" class="hide-text">
                                    Все поля обязательны для заполнения
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="error-text">

                                </td>
                            </tr>
                            <tr>
                                <td class="window-name-options">Имя</td>
                                <td><input type="text" class="checkout-input search" text="Имя" validator="blank" name="name"/></td>
                            </tr>
                            <tr>
                                <td class="window-name-options">E-mail</td>
                                <td><input type="text" class="checkout-input search" text="E-mail" validator="email" name="e-mail"/></td>
                            </tr>
                            <tr>
                                <td class="window-name-options">Вопрос</td>
                                <td>
                                    <textarea class="checkout-input search" style="height: 60px;" name="desc" cols="30" rows="10" validator="blank" text="Вопрос"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <div class="button-send button">Отправить</div>
                                </td>
                            </tr>

                        </table>
                    </form>
                </div>
            </div>

            <div class="dnone">
                <div id="get-feedback" class="message-dialog">
                    <form action="" method="post">
                        <table width="100%" class="window">
                            <tr>
                                <td colspan="2" class="hide-text">
                                    Все поля обязательны для заполнения
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="error-text">

                                </td>
                            </tr>
                            <tr>
                                <td class="window-name-options">Имя</td>
                                <td><input type="text" class="checkout-input search" text="Имя" validator="blank" name="name"/></td>
                            </tr>
                            <tr>
                                <td class="window-name-options">Телефон</td>
                                <td><input type="text" class="checkout-input search" text="Телефон" validator="blank" name="tel"/></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <div class="button-send button">Отправить</div>
                                </td>
                            </tr>

                        </table>
                    </form>
                </div>
            </div>

            <div class="dnone">
                <div id="get-abon" class="message-dialog">
                    <form action="" method="post">
                        <table width="100%" class="window">
                            <tr>
                                <td colspan="2" class="hide-text">
                                    Все поля обязательны для заполнения
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="error-text">

                                </td>
                            </tr>
                            <tr>
                                <td class="window-name-options">Имя</td>
                                <td><input type="text" class="checkout-input search" text="Имя" validator="blank" name="name"/></td>
                            </tr>
                            <tr>
                                <td class="window-name-options">Фамилия</td>
                                <td><input type="text" class="checkout-input search" text="Фамилия" validator="blank" name="surname"/></td>
                            </tr>
                            <tr>
                                <td class="window-name-options">Телефон</td>
                                <td><input type="text" class="checkout-input search" text="Телефон" validator="blank" name="tel"/></td>
                            </tr>
                            <tr>
                                <td class="window-name-options">E-mail</td>
                                <td><input type="text" class="checkout-input search" text="E-mail" validator="email" name="e-mail"/></td>
                            </tr>
                            <tr>
                                <td class="window-name-options">Срок абонемента</td>
                                <td>
                                    <select name="date">
                                        <option value="1 месяц">1 месяц</option>
                                        <option value="3 месяца">3 месяца</option>
                                        <option value="6 месяцев">6 месяцев</option>
                                        <option value="12 месяцев">12 месяцев</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <div class="button-send button">Отправить</div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>

            <section id="menu">
                <ul>
                    <li><a href="/clubs">Клубы</a></li>
                </ul>
            </section>
