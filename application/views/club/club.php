<div id="work-area">
                <header id="breadcrumbs">
                    <ul>
                        <li><a href="#">Главная</a></li>
                        <li>→</li>
                        <li><a href="#">Фитнес-клубы</a></li>
                    </ul>
                    <div style="clear: both;"></div>
                </header>

                <section class="card-clubs">
                    <header>
                        <section class="main-img-club">
                            <table width="100%" height="100%">
                                <tr>
                                    <td align="center"><img src="<?=$base['src'];?>" alt="" /></td>
                                </tr>
                            </table>

                        </section>
                        <section class="short-description-card">
                            <header class="card-name-club">
                                <h3><?=$base['name'];?></h3>
                            </header>

                            <table>
                                <? if($base['rates']){ ?>
                                <tr>
                                    <td colspan="3">
                                        <h4 class="variation-abonements">Варианты абонементов</h4>
                                    </td>
                                </tr>
                                <? foreach ($base['rates'] as $currentRate){ ?>
                                <tr>
                                    <td><?=$currentRate['period'];?></td>
                                    <td class="price-club-price"><h4><?=$currentRate['price'];?></h4></td>
                                    <td></td>
                                </tr>
                                <? } ?>
                                <tr>
                                    <td colspan="2">
                                        <div class="button-get-discount card-action-button"></div>
                                    </td>
                                    <td >
                                        <div class="button-guest button-guest-card card-action-button"></div>
                                    </td>
                                </tr>
                                <? } ?>
                                <tr>
                                    <td colspan="3" class="card-home card-icons"><div class="icon-home card-img-home"></div> <?=$base['address'];?></td>
                                </tr>
                                <? if($base['site']) {?>
                                <tr>
                                    <td colspan="3" class="card-icons"><a href="<?=$base['site'];?>"><div class="icon-hand-up card-img-hand-up"></div> <?=$base['site'];?></a></td>
                                </tr>
                                <? } ?>
                                <? if($base['phone']) {?>
                                <tr>
                                    <td colspan="3" class="card-icons"><div class="icon-phone card-img-phone"></div> <?=$base['phone'];?></td>
                                </tr>
                                <? } ?>
                            </table>
                        </section>
                    </header>
                    <section class="tab-set">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <!--<td class="empty-tab"></td>-->
                                <td class="tab active-tab" selector="#description-club">
                                    <div ><a href="#">Описание</a></div>
                                </td>
                                <td class="spacer"></td>
                                <td class="tab" selector="#foto-club">
                                    <div ><a href="#">Фотографии</a></div>
                                </td>
                                <td class="spacer"></td>
                                <td class="tab" selector="#review-club">
                                    <div ><a href="#"><a href="#">Отзывы</a></a></div>
                                </td>
                                <td class="spacer"></td>
                                <td class="empty-back-item"></td>
                            </tr>
                        </table>
                        <section id="description-club" class="full-card-description tabs-content">
                            <p>
                                <?=$base['description'];?>
                            </p>
                        </section>
                        <div id="review-club" class="full-card-description tabs-content hideClass">
                            <? if($reviews) { ?>
                            <div class="review">
                                <section class="description-review">
                                    <h4><?=$reviews['user'];?></h4>
                                    <span><?=$reviews['date'];?></span>
                                </section>
                                <section class="content-review">
                                    <p>
                                        <?=$reviews['text'];?>
                                    </p>
                                </section>
                                <div style="clear: both"></div>
                            </div>
                            <? } else {?>
                            <div class="review">
                                <h2>Нет отзывов. Ваш отзыв будет первым.</h2>
                            </div>
                            <? } ?>
                            <section class="add-review">
                                <header><h3>Оставить отзыв: </h3></header>
                                <table>
                                    <tr>
                                        <td>
                                            Имя
                                        </td>
                                        <td><input type="text" /></td>
                                    </tr>
                                    <tr>
                                        <td>Отзыв</td>
                                        <td>
                                            <textarea name="" id="" cols="30" rows="10"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Плюсы
                                        </td>
                                        <td><textarea name="" id="" cols="30" rows="10"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Минусы</td>
                                        <td>
                                            <textarea name="" id="" cols="30" rows="10"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                            <div class="button-send"></div>
                                        </td>
                                    </tr>
                                </table>
                            </section>
                        </div>
                        <section id="image-club">
                            <? if($image) {?>
                            <table>
                                <? $countImages = 0;?>
                                <? foreach ($images as $currentImage) {?>
                                    <? if($countImages%$countImagesOnRow) { ?>
                                    <tr>
                                    <? } ?>
                                    <td><img src="<?=$currentImage['src'];?>" alt="" /></td>
                                    <? if($countImages%($countImagesOnRow-1)) {?>
                                    </tr>
                                    <? } ?>
                                    <? $countImages++; ?>
                                <? } ?>
                            </table>
                            <? } else{ ?>
                                <h4>Фотографий нет</h4>
                            <? } ?>
                        </section>
                    </section>
                </section>
                <section class="analogs">
                    <? if($analogs) {?>
                    <header class="title-analogs-section">
                        <h2>
                            Похожие фитнес-клубы
                        </h2>
                    </header>
                    <section>
                        <table class="analogs-list">
                            <? $countClubs = 0; ?>
                            <? foreach ($analogs as $currentClub) { ?>
                                <? if($countClubs%$countAnalogsOnRow==0) { ?>
                                <tr>
                                <? } ?>
                                <td align="center">
                                    <img src="<?=$currentClub['img'];?>" alt="<?=$currentClub['name'];?>" />
                                    <div class="analog-name"><a href="<?=$currentClub['href'];?>"><?=$currentClub['name'];?></a></div>
                                    <div class="button-get-discount"></div>
                                    <div class="button-more"></div>
                                </td>
                                <? if($countClubs%($countAnalogsOnRow-1)==0) {?>
                                </tr>
                                <? } ?>
                                <? $countClubs++;?>
                            <? } ?>
                        </table>
                    </section>
                    <? } ?>
                </section>

                <div style="clear: both;"></div>
            </div>
<script type="text/javascript" src="/js/club.js"></script>