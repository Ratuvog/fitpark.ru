<!DOCTYPE html>
<html>
    <head>
        <title><?=$titleText;?></title>
        <meta name="description" content="ФитПарк – твой проводник в фитнес мир. У нас собраны отзывы, цены абонементов, стоимость услуг, расписания, контакты клубов. Весь фитнес Самара.">
        <meta name="keywords" content="Фитнес, Самара, Клуб, Ботек, Империал, Алекс-фитнес, Кинап, Зебра, Территория фитнеса, Отзывы, Абонементы, Уран, Планета, Гейзер, Бассейн, Сок, Стоимость, Цены, Грация, Вива Лэнд, Лакшери, Акции, Самарский, Скидки, Купить, Матрешка, Тренажерный зал, Мтл арена">
        <link rel="stylesheet" href="/css/fitpark.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
        <link rel="stylesheet" href="/js/fancybox/jquery.fancybox.css" />
        <link rel="stylesheet" href="/js/fancybox/helpers/jquery.fancybox-buttons.css" />
        <link rel="stylesheet" href="/js/fancybox/helpers/jquery.fancybox-thumbs.css" />

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

<script type="text/javascript">
  VK.init({apiId: 3677727, onlyWidgets: true});
</script>
        <link rel="shortcut icon" href="/image/favicon.ico" type="image/x-icon">
    </head>
    <body><div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

        <div class="main">
        <header id="title">
            <div id="title-menu">
                <ul>
                    <li class="name-section"><a href="<?=base_url();?>" class="my-link">Главная</a></li>
                    <li class="name-section"><a href="<?=site_url(array('clubs'));?>" class="my-link">Фитнес-клубы</li>
                    <li class="name-section"><a href="<?=site_url(array('#'));?>" class="my-link">О ФитПарке</a></li>
                </ul>
            </div>
        </header>
        <section id="content">
            <header class="header">
                <div class="logo">
                    <a href="<?=base_url();?>">
                        <img src="<?=site_url(array('image','logo.png'))?>"></img>
                    </a>
                </div>

                <div class="header-content">
                    <form action="<?=site_url(array('clubs','search'))?>" method="post">
                        <input type="text" class="search not-empty" name="search" id="search" place="Что ищем?"/>
                        <div class="button-search" id="submit-search"></div>
                    </form>


                </div>
            </header>

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
