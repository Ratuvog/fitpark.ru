                <section class="card-clubs">
                    <header>
                        <section class="main-img-club">
                            <table width="100%" height="100%">
                                <tr>
                                    <td align="center"><img style="max-width: 310px;" src="<?=$base['head_picture'];?>" alt="<?=$base['name'];?>" /></td>
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
                                        <div class="button-get-discount button card-action-button action-button" href="/club/getDiscount/<?=$base['id'];?>">Получить скидку 5%</div>
                                    </td>
                                    <td >
                                        <div class="button-guest button button-guest-card card-action-button action-button" href="/club/getGuest/<?=$base['id'];?>">Гостевое посещение</div>
                                    </td>
                                </tr>
                                <? } ?>
                                <tr>
                                    <td colspan="3">
                                        <ul class="clubs-contacts">
                                            <li>
                                               <div class="icon-home card-img-home"></div> <?=$base['address'];?>
                                            </li>
                                            <? if($base['site']) {?>
                                            <li>
                                                <a href="<?=$base['site'];?>"><div class="icon-hand-up card-img-hand-up"></div> <?=$base['site'];?></a>
                                            </li>
                                            <? } ?>
                                            <? if($base['phone']) {?>
                                            <li>
                                                <div class="icon-phone card-img-phone"></div> <?=$base['phone'];?>
                                            </li>
                                            <? } ?>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </section>
                    </header>
                    <section class="tab-set">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <!--<td class="empty-tab"></td>-->
                                <td class="tab <? if(!$isComment) {?>active-tab<?}?>" selector="#description-club">
                                    <div ><a href="#">Описание</a></div>
                                </td>
                                <td class="spacer"></td>
                                <td class="tab" selector="#image-club">
                                    <div ><a href="#">Фотографии</a></div>
                                </td>
                                <td class="spacer"></td>
                                <td class="tab <? if($isComment) {?>active-tab<?}?>" selector="#review-club">
                                    <div ><a href="#"><a href="#">Отзывы</a></a></div>
                                </td>
                                <td class="spacer"></td>
                                <td class="empty-back-item"></td>
                            </tr>
                        </table>
                        <section id="description-club" class="full-card-description tabs-content <? if($isComment) {?>hideClass<?}?>">
                            <p>
                                <?=$base['description'];?>
                            </p>
                        </section>
                        <div id="review-club" class="full-card-description tabs-content <? if(!$isComment) {?>hideClass<?}?> ">
                            <? if($reviews) { ?>
                            <? foreach ($reviews as $review){?>
                            <div class="review">
                                <table>
                                    <tr>
                                        <td class="description-review">
                                            <h4><?= $review['sender']; ?></h4>
                                            <span><?= $review['outdate']; ?></span>
                                        </td>
                                        <td class="content-review">
                                                    <? if ($review['text']) { ?>
                                                        <p>
                                                            <?= $review['text']; ?>
                                                        </p>
                                                    <? } ?>
                                                    <? if ($review['positive']) { ?>
                                                        <h4>
                                                            Плюсы
                                                        </h4>
                                                        <p>
                                                            <?= $review['positive']; ?>
                                                        </p>
                                                    <? } ?>
                                                    <? if ($review['negative']) { ?>
                                                        <h4>
                                                            Минусы
                                                        </h4>
                                                        <p>
                                                            <?= $review['negative']; ?>
                                                        </p>
                                                    <? } ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <? }?>
                            <? } else {?>
                            <div class="review">
                                <h2 class="no-reviews">Нет отзывов. Ваш отзыв будет первым.</h2>
                            </div>
                            <? } ?>
                            <section class="add-review">
                                <header><h3>Оставить отзыв: </h3></header>
                                <form action="/club/addReview/<?=$base['id'];?>" method="POST">
                                    <table>
                                        <tr>
                                            <td>
                                                Имя
                                            </td>
                                            <td><input type="text" name="name"/></td>
                                        </tr>
                                        <tr>
                                            <td>Отзыв</td>
                                            <td>
                                                <textarea name="text" id="" cols="30" rows="10"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Плюсы
                                            </td>
                                            <td><textarea name="plus" id="" cols="30" rows="10"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Минусы</td>
                                            <td>
                                                <textarea name="minus" id="" cols="30" rows="10"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="center">
                                                <div class="button-send button submit-review">Отправить</div>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </section>
                        </div>
                        <section id="image-club">
                            <? if($images) {?>
                            <table>
                                <? $countImages = 0;?>
                                <? foreach ($images as $currentImage) {?>
                                    <? if($countImages%$countImagesOnRow) { ?>
                                    <tr>
                                    <? } ?>
                                        <td><img src="<?=site_url(array('image', 'club', $currentImage['photo']));?>" alt="" /></td>
                                    <? if($countImages%($countImagesOnRow-1)) {?>
                                    </tr>
                                    <? } ?>
                                    <? $countImages++; ?>
                                <? } ?>
                            </table>
                            <? } else{ ?>
                                <h2 class="no-foto">Фотографий нет</h2>
                            <? } ?>
                        </section>
                    </section>
                </section>
                <section class="analogs">
                    <? if($analogs && !$base['isHideAnalogs']) {?>
                    <header class="title-analogs-section">
                        <h2>
                            Похожие фитнес-клубы
                        </h2>
                    </header>
                    <section>
                        <table class="analogs-list">
                            <? $countClubs = 1; ?>
                            <? foreach ($analogs as $currentClub) { ?>
                                <? if($countClubs%$countAnalogsOnRow==0) { ?>
                                <tr>
                                <? } ?>
                                <td align="center">
                                    <img src="<?=$currentClub['head_picture'];?>" alt="<?=$currentClub['name'];?>" height="134" />
                                    <div class="analog-name"><a href="/club/<?=$currentClub['id'];?>"><?=$currentClub['name'];?></a></div>
                                    <div class="button-get-discount button action-button"  href="/club/getDiscount/<?=$currentClub['id'];?>">Получить скидку 5%</div>
                                    <a href="/club/<?=$currentClub['id'];?>"><div class="button-more button">Подробнее о клубе</div></a>
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
