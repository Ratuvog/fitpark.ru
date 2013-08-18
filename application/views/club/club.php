<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>

<script type="text/javascript" src="<?=site_url("js/club.js");?>"></script>
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
                                <?$this->load->view('blocks/services-row', $club->services_row);?>
                            </div>
                            <div id="page-club-info-main-inner">
                                <div id="page-club-info-main-club">
                                    <table id="logo-table">
                                        <tr>
                                            <td align="center">
                                                <img src="<?=$club->head_picture;?>" id="page-club-logo" class="inline"/>
                                            </td>
                                        </tr>
                                    </table>
                                    <div id="rating-club-big"
                                        title="Средняя оценка клуба: <?=round($club->rating, 2);?>"
                                        data-score="<?=$club->rating;?>">
                                    </div>
                                    <div id="page-club-price" class="inline">
                                        <p>Стоимость посещения</p>
                                        <table>
                                            <tr>
                                                <td>1 месяц</td>
                                                <td>
                                                    <?if($club->sub1 !== '0.00') {?>
                                                    от <span><?=$club->sub1;?></span> рублей
                                                    <?} else {?>
                                                    цена не указана
                                                    <?}?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>3 месяца</td>
                                                <td>
                                                    <?if($club->sub3 !== '0.00') {?>
                                                    от <span><?=$club->sub3;?></span> рублей
                                                    <?} else {?>
                                                    цена не указана
                                                    <?}?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>6 месяцев</td>
                                                <td>
                                                    <?if($club->sub6 !== '0.00') {?>
                                                    от <span><?=$club->sub6;?></span> рублей
                                                    <?} else {?>
                                                    цена не указана
                                                    <?}?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>12 месяцев</td>
                                                <td>
                                                    <?if($club->sub12 !== '0.00') {?>
                                                    от <span><?=$club->sub12;?></span> рублей
                                                    <?} else {?>
                                                    цена не указана
                                                    <?}?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                
                                <div id="page-club-map" class="inline"
                                     currentCity = "<?=$club->city->full_name;?>"
                                     geo="г. <?=$club->city->full_name;?>, <?=$club->address;?>"
                                     city-geo="<?=$club->city_geo;?>"
                                     balloon-title="<?=$club->name;?>"></div>
                                
                                <div id="buttons-row">
                                    <div class="page-club-menu inline action-button" for="get-club-card" href="<?=site_url("dialog/getClubCard/$club->id");?>">
                                        <?$this->load->view('dialogs/getClubCard');?>
                                        <img src="<?=site_url("image/v_card.png");?>" class="inline"/>
                                        <p class="inline">Заявка на карту клуба</p>
                                    </div>
                                    <div class="page-club-menu inline action-button" for="visit-club" href="<?=site_url("/dialog/visitClub/$club->id");?>">
                                        <?$this->load->view('dialogs/visitClub');?>
                                        <img src="<?=site_url("image/calendar.png");?>" class="inline"/>
                                        <p class="inline">Посетить клуб</p>
                                    </div>
                                    <div class="page-club-menu inline action-button" for="ask-question" href="<?=site_url("/dialog/askQuestion/$club->id");?>">
                                        <?$this->load->view('dialogs/askQuestion');?>
                                        <img src="<?=site_url("image/info.png");?>" class="inline"/>
                                        <p class="inline">Вопрос менеджеру клуба</p>
                                    </div>
                                    <div class="page-club-menu inline action-button" for="get-call" href="<?=site_url("/dialog/getCall/$club->id");?>">
                                        <?$this->load->view('dialogs/getCall');?>
                                        <img src="<?=site_url("image/telephone.png");?>" class="inline"/>
                                        <p class="inline">Заказать звонок из клуба</p>
                                    </div>
                                </div>
                            </div>
                        </div><!--#page-club-info-main[END]-->
                        
                        <div id="page-club-info-additional">
                            <div id="page-club-side-menu" active-page="<?=$page;?>">
                                <ul>
                                    <li class="page-side-menu-info-tab" for="page-side-menu-info-tz" pointer="35">
                                        <img src="<?=site_url("image/file.png");?>" width="29px"/><h2>Описание</h2>
                                    </li>
                                    <li class="page-side-menu-info-tab" for="page-side-menu-info-photo" pointer="105">
                                        <img src="<?=site_url("image/camera_2.png");?>" width="25px"/><h2>Фотографии</h2>
                                    </li>
                                    <li id="page-side-menu-info-comment-tab" class="page-side-menu-info-tab" for="page-side-menu-info-comments" pointer="165">
                                        <img src="<?=site_url("image/speach.png");?>" width="25px"/><h2>Отзывы</h2>
                                    </li>
                                </ul>
                            </div>
                            <div id="slide-pointer" class="inline">
                                <img src="<?=site_url("image/side_menu_pointer.png");?>"/>
                            </div>
                            <div id="page-side-menu-info" class="inline">
                                <div id="page-side-menu-info-tz" class="page-side-menu-info inline">
                                    <p>
                                        <img src="<?=site_url("image/map_pin.png");?>"/>
                                        <span>г. <?=$club->city->full_name;?>, <?=$club->address;?></span>
                                    </p>
                                    <p>
                                        <img src="<?=site_url("image/telephone.png");?>"/>
                                        <span><? if($club->phone) echo $club->phone; else echo "Телефон не указан";?></span>
                                    </p>
                                    <p>
                                        <img src="<?=site_url("image/keyboard.png");?>" />
                                        <span><a href="http://<?=$club->site;?>" target="_blank" rel=”nofollow”><? if($club->site) echo $club->site; else echo "Сайт не указан";?></a></span>
                                    </p>
                                    <p>
                                        <img src="<?=site_url("image/clock.png");?>" />
                                        <span><? if($club->work_hours) echo $club->work_hours; else echo "Часы работы не указаны";?></span>
                                    </p>
                                    <div class="club-description-text ckeditor-text">
                                        <p><?=$club->description;?></p>
                                    </div>
                                </div>
                                <div id="page-side-menu-info-photo" class="page-side-menu-info inline" style="display: none;">
                                    <?$this->load->view('blocks/club-photos', $club->photos);?>
                                </div>
                                <div id="page-side-menu-info-comments" class="page-side-menu-info inline" style="display: none;">
                                    <?$this->load->view('blocks/comments', $club->comments);?>
                                </div>
                                <div id="like-the-club" class="inline">
                                    <p>Оцени клуб:</p>
                                    <?
                                       $this->load->view('likes/vk-club', $this);
                                       $this->load->view('likes/fb-club', $this);
                                       $this->load->view('likes/fitrating-club', $this);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <? if(count($club->analogs)) {?>
                        <div id="similar-clubs">
                            <h2>Похожие фитнес-клубы</h2>
                            <div id="similar-clubs-list">
                                <?  foreach ($club->analogs as $similar_club):
                                        $this->load->view('blocks/club-item', $similar_club);
                                    endforeach;
                                ?>
                            </div>
                        </div>
                        <? } ?>
                    </div>
                </div>
            </div> 
        </div><!--#main[END]-->
    </div>
</div><!--#content[END]-->
