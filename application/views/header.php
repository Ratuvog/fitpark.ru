<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="/css/fitpark.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
        <script type="text/javascript" src="/js/cb/jquery.colorbox.js"></script>
        <script type="text/javascript" src="/js/common.js"></script>
        <script type="text/javascript" src="/js/jquery.form.validation.js"></script>
    </head>
    <body>

        <header id="title">
            <span class="name-section"><a href="/clubs" class="my-link">Фитнес-клубы</a></span>
        </header>
        <section id="content">
            <header class="header">
                <img src="/image/logo.png" alt="" width="200" height="60" class="logo"/>
                <div class="header-content">
                    <form action="/clubs/search" method="get">
                        <input type="hidden" name="order" value="<?=$order;?>"/>
                        <input type="text" class="search" name="search" id="search" placeholder="что ищем?"/>
                        <div class="button-search" id="submit-search"></div>
                    </form>
                    <div class="telefon-support">
                        <h2 class="telefon-number">8-800-350-12-14</h1>
                            <h5 class="telefon-slogan">Мы рады любым вопросам</h5>
                    </div>

                </div>
            </header>

            <!--окошко-->
            <div class="dnone">
                <div id="window-checkout">
                    <form action="" method="post">
                        <table width="100%" id="window">
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
                                <td><input type="text" class="checkout-input search" name="name"/></td>
                            </tr>
                            <tr>
                                <td class="window-name-options">E-mail</td>
                                <td><input type="text" class="checkout-input search" name="e-mail"/></td>
                            </tr>
                            <tr>
                                <td class="window-name-options">Телефон</td>
                                <td><input type="text" class="checkout-input search" name="tel"/></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <div class="button-send"></div>
                                </td>
                            </tr>

                        </table>
                    </form>
                </div>
            </div>

            <section id="menu">
                <ul>
                    <li><a href="#">Клубы</a></li>
                    <li><a href="#">Подобрать клуб</a></li>
                </ul>
            </section>
