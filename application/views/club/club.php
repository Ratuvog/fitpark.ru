<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>

<div id="content">
    <div id="content-inner">
        <?$this->load->view('blocks/subtitle-block');?>
        <div id="main">
            <div id="main-inner">
                <?$this->load->view('blocks/breadcrumbs', $breadcrumbs);?>

                <div id="page-club">
                    <div id="page-club-inner">
                        <div id="page-club-info-main">
                            <div id="page-club-info-title">
                                <h2 class="inline">Фитнес-клуб Imperial Fitness</h2>
                                <img src="<?=site_url("image/swim_2.png");?>" class="inline"/>
                                <img src="<?=site_url("image/bike.png");?>" class="inline"/>
                                <img src="<?=site_url("image/fight.png");?>" class="inline"/>
                            </div>
                            <div id="page-club-info-main-club">
                                <img src="<?=site_url("image/club_logo.png");?>" id="page-club-logo" class="inline"/>
                                <div id="page-club-price" class="inline">
                                    <p>Стоимость посещения</p>
                                    <table>
                                        <tr>
                                            <td>1 месяц</td>
                                            <td>от <span>1 200 рублей</span></td>
                                        </tr>

                                        <tr>
                                            <td>3 месяца</td>
                                            <td>от <span>3 500 рублей</span></td>
                                        </tr>

                                        <tr>
                                            <td>6 месяцев</td>
                                            <td>от <span>7 100 рублей</span></td>
                                        </tr>

                                        <tr>
                                            <td>12 месяцев</td>
                                            <td>от <span>12 500 рублей</span></td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="page-club-map" class="inline">
                                    <img src="<?=site_url("image/club_map.png");?>"/>
                                </div>
                                <div id="page-club-rating">
                                    <img src="<?=site_url("image/club_star_1.png");?>"/>
                                    <img src="<?=site_url("image/club_star_1.png");?>"/>
                                    <img src="<?=site_url("image/club_star_2.png");?>"/>
                                    <img src="<?=site_url("image/club_star_2.png");?>"/>
                                    <img src="<?=site_url("image/club_star_2.png");?>"/>
                                </div>
                                <div id="page-club-menu">
                                    <div class="page-club-menu inline">
                                        <img src="<?=site_url("image/v_card.png");?>" class="inline"/>
                                        <p class="inline">Заявка на карту клуба</p>
                                    </div>

                                    <div class="page-club-menu inline">
                                        <img src="<?=site_url("image/calendar.png");?>" class="inline"/>
                                        <p class="inline">Посетить клуб</p>
                                    </div>

                                    <div class="page-club-menu inline">
                                        <img src="<?=site_url("image/info.png");?>" class="inline"/>
                                        <p class="inline">Вопрос менеджеру клуба</p>
                                    </div>

                                    <div class="page-club-menu inline">
                                        <img src="<?=site_url("image/telephone.png");?>" class="inline"/>
                                        <p class="inline">Заказать звонок из клуба</p>
                                    </div>
                                </div>
                            </div>
                        </div><!--#page-club-info-main[END]-->
                        <div id="page-club-info-additional">
                            <div id="page-club-side-menu">
                                <ul>
                                    <li><img src="<?=site_url("image/file.png");?>" width="29px"/><p>Описание</p></li>
                                    <li><img src="<?=site_url("image/camera_2.png");?>" width="25px"/><p>Фотографии</p></li>
                                    <li><img src="<?=site_url("image/speach.png");?>" width="25px"/><p>Отзывы</p></li>
                                </ul>
                            </div>
                            <div id="slide-pointer" class="inline">
                                <img src="<?=site_url("image/side_menu_pointer.png");?>"/>
                            </div>
                            <div id="page-side-menu-info" class="inline">
                                <div id="page-side-menu-info-tz" class="page-side-menu-info inline">
                                    <p>
                                        <img src="<?=site_url("image/map_pin.png");?>"/>
                                        <span>г. Самара, Московское шоссе, д.145</span>
                                    </p>
                                    <p>
                                        <img src="<?=site_url("image/telephone.png");?>"/>
                                        <span>8 (846) 240 40 40</span>
                                    </p>
                                    <p>
                                        <img src="<?=site_url("image/keyboard.png");?>" />
                                        <span><a href="">www.imperialift.ru</a></span>
                                    </p>
                                    <p>
                                        <img src="<?=site_url("image/clock.png");?>" />
                                        <span>будни - с 7.00 до 24.00, выходные - с 10.00 до 22.00</span>
                                    </p>
                                    <p>Большое красивое описание непосредственно тут. <br />
                                    Дабы  покупатель смог прочитать важную информацию, 
                                    обдумать и после этого тыкнуть в иконку скидки.<br />
                                    После этого мы заработаем денег и будем долго радоваться.</p>
                                </div>
                                <div id="page-side-menu-info-photo" class="page-side-menu-info inline" style="display: none;"></div>
                                <div id="page-side-menu-info-comments" class="page-side-menu-info inline" style="display: none;"></div>
                                <div id="like-the-club" class="inline">
                                    <p>Оцени клуб:</p>
                                    <img src="<?=site_url("image/like_club.png");?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div id="similar-clubs">
                            <h2>Похожие фитнес-клубы</h2>
                            <div id="similar-clubs-list">


                                <div class="item-result inline">
                                    <div class="if-share"></div>
                                    <div class="main-result-block">
                                        <div class="item-result-name">
                                            <h2>Kangaroo</h2>
                                        </div>
                                        <div class="item-result-image">
                                            <img src="<?=site_url("image/kangaroo.png");?>"/>
                                        </div>
                                        <div class="item-result-info">
                                            <p class="street"><img src="<?=site_url("image/map_pin.png");?>" class="inline"/><span class="inline">Запорожская 15</span></p>
                                            <p class="price"><img src="<?=site_url("image/pig.png");?>" class="inline"/><span class="inline">от 3500 руб</span></p>
                                        </div>
                                        <div class="item-result-bottom">
                                            <div class="vote inline">
                                                <div class="star active inline"></div>
                                                <div class="star active inline"></div>
                                                <div class="star inline"></div>
                                                <div class="star inline"></div>
                                                <div class="star inline"></div>
                                            </div>
                                            <div class="go-to-photos inline">
                                                <a href=""><img src="<?=site_url("image/camera.png");?>" class="inline"/></a>
                                            </div>
                                            <div class="go-to-comments inline">
                                                <a href=""><img src="<?=site_url("image/speach.png");?>" class="inline"/></a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--.item-result[END]-->

                                <div class="item-result inline">
                                    <div class="if-share"></div>
                                    <div class="main-result-block">
                                        <div class="item-result-name">
                                            <h2>Kangaroo</h2>
                                        </div>
                                        <div class="item-result-image">
                                            <img src="<?=site_url("image/kangaroo.png");?>"/>
                                        </div>
                                        <div class="item-result-info">
                                            <p class="street"><img src="<?=site_url("image/map_pin.png");?>" class="inline"/><span class="inline">Запорожская 15</span></p>
                                            <p class="price"><img src="<?=site_url("image/pig.png");?>" class="inline"/><span class="inline">от 3500 руб</span></p>
                                        </div>
                                        <div class="item-result-bottom">
                                            <div class="vote inline">
                                                <div class="star active inline"></div>
                                                <div class="star active inline"></div>
                                                <div class="star inline"></div>
                                                <div class="star inline"></div>
                                                <div class="star inline"></div>
                                            </div>
                                            <div class="go-to-photos inline">
                                                <a href=""><img src="<?=site_url("image/camera.png");?>" class="inline"/></a>
                                            </div>
                                            <div class="go-to-comments inline">
                                                <a href=""><img src="<?=site_url("image/speach.png");?>" class="inline"/></a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--.item-result[END]-->

                                <div class="item-result inline">
                                    <div class="if-share"></div>
                                    <div class="main-result-block">
                                        <div class="item-result-name">
                                            <h2>Kangaroo</h2>
                                        </div>
                                        <div class="item-result-image">
                                            <img src="<?=site_url("image/kangaroo.png");?>"/>
                                        </div>
                                        <div class="item-result-info">
                                            <p class="street"><img src="<?=site_url("image/map_pin.png");?>" class="inline"/><span class="inline">Запорожская 15</span></p>
                                            <p class="price"><img src="<?=site_url("image/pig.png");?>" class="inline"/><span class="inline">от 3500 руб</span></p>
                                        </div>
                                        <div class="item-result-bottom">
                                            <div class="vote inline">
                                                <div class="star active inline"></div>
                                                <div class="star active inline"></div>
                                                <div class="star inline"></div>
                                                <div class="star inline"></div>
                                                <div class="star inline"></div>
                                            </div>
                                            <div class="go-to-photos inline">
                                                <a href=""><img src="<?=site_url("image/camera.png");?>" class="inline"/></a>
                                            </div>
                                            <div class="go-to-comments inline">
                                                <a href=""><img src="<?=site_url("image/speach.png");?>" class="inline"/></a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--.item-result[END]-->

                                <div class="item-result inline">
                                    <div class="if-share"></div>
                                    <div class="main-result-block">
                                        <div class="item-result-name">
                                            <h2>Kangaroo</h2>
                                        </div>
                                        <div class="item-result-image">
                                            <img src="<?=site_url("image/kangaroo.png");?>"/>
                                        </div>
                                        <div class="item-result-info">
                                            <p class="street"><img src="<?=site_url("image/map_pin.png");?>" class="inline"/><span class="inline">Запорожская 15</span></p>
                                            <p class="price"><img src="<?=site_url("image/pig.png");?>" class="inline"/><span class="inline">от 3500 руб</span></p>
                                        </div>
                                        <div class="item-result-bottom">
                                            <div class="vote inline">
                                                <div class="star active inline"></div>
                                                <div class="star active inline"></div>
                                                <div class="star inline"></div>
                                                <div class="star inline"></div>
                                                <div class="star inline"></div>
                                            </div>
                                            <div class="go-to-photos inline">
                                                <a href=""><img src="<?=site_url("image/camera.png");?>" class="inline"/></a>
                                            </div>
                                            <div class="go-to-comments inline">
                                                <a href=""><img src="<?=site_url("image/speach.png");?>" class="inline"/></a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--.item-result[END]-->
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div><!--#main[END]-->
    </div>
</div><!--#content[END]-->
