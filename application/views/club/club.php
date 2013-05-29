                <section class="card-clubs">
                    <section>
                        <section>
                            <div class="main-img-club">
                                <table width="280px" height="100%" class="head-image">
                                    <tr>
                                        <td align="center" valign="middle">
                                            <a href="<?=$base['head_picture'];?>" rel="group" class="fancybox">
                                                <img style="max-width: 280px;" src="<?=$base['head_picture'];?>" alt="<?=$base['name'];?>" />
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="rating club-big"
                                 title="Ваша оценка: <?=round($base['rating'],2);?>"
                                 data-score="<?=$base['rating'];?>"
                                 data-vote-id="<?=$base['id'];?>"
                                 ro="<?if(isset($base['rating']))
                                            echo 'true';
                                       else
                                            echo 'false';?>">
                            </div>
                            <div colspan="2" class="rating-vote-answer"><?if(!isset($base['rating'])) echo 'Оцените клуб'; else echo "Ваша оценка: ".round($base['rating'],2);?></div>
                        </section>
                        <section class="short-description-card">
                            <header class="card-name-club">
                                <h3><?=$base['name'];?></h3>
                            </header>
                            <table>
                                <? if($base['rates']){ ?>
                                <tr>
                                    <td colspan="2">
                                        <h4 class="variation-abonements">Варианты абонементов</h4>
                                    </td>
                                    <td>
                                        <div class="button-guest button-club button-guest-card card-action-button action-button" selector="#get-feedback" href="/club/getFeedback/<?= $base['id']; ?>">
                                                    <ul>
                                                        <li>
                                                            <div class="icon-small-help"></div>
                                                        </li>
                                                        <li>
                                                            <span class="button-text">Заказать звонок из клуба</span>
                                                        </li>
                                                    </ul>
                                                    <div style="clear: both;"></div>
                                                </div>
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
                                    <td>
                                        <div class="button-get-discount button-club card-action-button action-button" selector="#get-abon" href="/club/getAbonement/<?=$base['id'];?>">
                                            <ul>
                                                <li>
                                                    <div class="icon-small-buy"></div>
                                                </li>
                                                <li>
                                                    <span class="button-text">Заявка на карту клуба</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td >
                                        <div class="button-guest button-club button-guest-card card-action-button action-button" selector="#get-guest" href="/club/getGuest/<?=$base['id'];?>">
                                            <ul>
                                                <li>
                                                    <div class="icon-small-calendar"></div>
                                                </li>
                                                <li>
                                                    <span class="button-text">Посетить клуб</span>
                                                </li>
                                            </ul>
                                        </div>

                                    </td>
                                    <td >
                                        <div class="button-guest button-club button-guest-card card-action-button action-button" selector="#get-answer" href="/club/getQuestion/<?=$base['id'];?>">
                                            <ul>
                                                <li>
                                                    <div class="icon-small-help"></div>
                                                </li>
                                                <li>
                                                    <span class="button-text">Вопрос менеджеру клуба</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td >

                                    </td>
                                </tr>
                                <tr class="like-bar">
                                    <td>
                                                                              <div id="vk_like"></div>
<script type="text/javascript">
VK.Widgets.Like("vk_like", {type: "button"},<?=$clubUrl;?>);
</script>
                                    </td>
                                    <td colspan="3">
                                        <div class="fb-like" data-href="<?=$clubUrl;?>" data-send="true" data-width="450" data-show-faces="true"></div>
                                    </td>
                                </tr>
                                <? } ?>
                            </table>
                        </section>
                    </section>
                    <section class="tab-set">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <!--<td class="empty-tab"></td>-->
                                <td class="tab <? if(!$isComment == 1) {?>active-tab<?}?>" selector="#description-club">
                                    <div ><a href="#">Описание</a></div>
                                </td>
                                <td class="spacer"></td>
                                <td class="tab" selector="#image-club">
                                    <div ><a href="#">Фотографии</a></div>
                                </td>
                                <td class="spacer"></td>
                                <td class="tab <? if($isComment == 1) {?>active-tab<?}?>" selector="#review-club">
                                    <div ><a href="#"><a href="#">Отзывы</a></a></div>
                                </td>
                                <td class="spacer"></td>
                                <td class="empty-back-item"></td>
                            </tr>
                        </table>
                        <section id="description-club" class="full-card-description tabs-content <? if($isComment == 1) {?>hideClass<?}?>">

                                    <div class="club-info"><div class="desc-text">
                                        <div class="icon-home card-img-home"></div> <div class="text-card-club"><?= $base['address']; ?></div>
                                            <div style="clear: both;"></div>
                                        </div>
                                        <? if ($base['phone']) { ?>
                                        <div class="desc-text">
                                            <div class="icon-phone card-img-phone"></div> <div><?= $base['phone']; ?></div>
                                            <div style="clear: both;"></div>
                                        </div>
                                        <? } ?>
                                        <? if ($base['site']) { ?>
                                        <div class="desc-text">
                                            <a href=http://<?= $base['site']; ?> target="_blank"><div class="icon-hand-up card-img-hand-up"></div> <div><?= $base['site']; ?></div></a>
                                            <div style="clear: both;"></div>
                                        </div>
                                        <? } ?>

                                    </div>
                            <div style="clear: both;"></div>

                            <p>

<!--                                <ul class="clubs-contacts">
                                    <li>

                                    </li>
                                    <? if ($base['site']) { ?>
                                        <li>
                                            <a href="<?= $base['site']; ?>"><div class="icon-hand-up card-img-hand-up"></div> <?= $base['site']; ?></a>
                                        </li>
                                    <? } ?>
                                    <? if ($base['phone']) { ?>
                                        <li>
                                            <div class="icon-phone card-img-phone"></div> <?= $base['phone']; ?>
                                        </li>
                                    <? } ?>
                                </ul>-->
                                <?=$base['description'];?>
                            </p>
                        </section>
                        <div id="review-club" class="full-card-description tabs-content <? if(!$isComment) {?>hideClass<?}?> ">
                            <section class="add-review">
                                <div class="button-guest button-club action-button add-review-button" selector="#get-review" href="/club/addReview/<?=$base['id']?>">
                                    <ul>
                                        <li>
                                            <div class="icon-small-help"></div>
                                        </li>
                                        <li>
                                            <span class="button-text">Оставить отзыв</span>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                            <? if($reviews) { ?>
                            <? foreach ($reviews as $review){?>
                            <div class="review">
                                <table>
                                    <tr>
                                        <td class="description-review">
                                            <h4><?= $review['sender']; ?></h4>
                                            <span><?= $review['outdate']; ?></span>
                                            <? if(isset($review['rating'])) { ?>
                                                <div class="rating club-mini"
                                                    title="Оценил клуб на: <?=round($review['rating'],2);?>"
                                                    data-score="<?=round($review['rating'],2);?>">
                                                </div>
                                            <? } ?>
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
                        </div>
                        <section id="image-club">
                            <? if($images) {?>
                            <table class="images-galery">
                                <? $countImages = 0;?>
                                <? foreach ($images as $currentImage) {?>
                                    <? if($countImages%3==0) { ?>
                                    <tr>
                                    <? } ?>
                                        <td align="center" valign="middle">
                                            <a href="<?=$currentImage['photo'];?>" class="fancybox gallery" rel="gallery1"><img src="<?=$currentImage['min_photo'];?>" alt="" /></a>
                                        </td>
                                    <? if(($countImages+1)%(3)==0) {?>
                                    </tr>
                                    <? } ?>
                                    <? $countImages++; ?>
                                <? } ?>
                            </table>
                            <? } else{ ?>
                                <h2 class="no-info">Фотографий нет</h2>
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
                                    <img src="<?=$currentClub['head_picture'];?>" class="analog-foto" alt="<?=$currentClub['name'];?>" style="max-width: 160px;" />
                                    <div class="analog-name"><a  target="_blank" href="/club/<?=$currentClub['id'];?>"><?=$currentClub['name'];?></a></div>
                                    <div class="button-get-discount button-club action-button" selector="#get-answer"  href="/club/getQuestion/<?=$currentClub['id'];?>">
                                        <ul>
                                            <li>
                                                <div class="icon-small-help"></div>
                                            </li>
                                            <li>
                                                <span class="button-text">Вопрос менеджеру клуба</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="/club/<?=$currentClub['id'];?>"  target="_blank" class="no-decoration"><div class="button-more button">Подробнее о клубе</div></a>
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

<div class="dnone">
    <div id="get-review" class="message-dialog">
        <form action="" method="post">
            <h4> Мой отзыв о <?=$base['name'];?> </h4>
            <table width="100%" class="window">
                <tr>
                    <td colspan="2" class="error-text">
                    </td>
                </tr>
                <tr>
                    <td>
                        Имя
                    </td>
                    <td><input class="checkout-input search" type="text" name="name" isReq="false" text="Имя" validator="blank"/></td>
                </tr>
                <tr>
                    <td>Отзыв</td>
                    <td>
                        <textarea class="search review-text" name="text" cols="30"  rows="10"  text="Отзыв" validator="blank"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        Плюсы
                    </td>
                    <td><textarea class="search review-text" name="plus" isReq="false" id="" cols="30" rows="10"  text="Плюсы" validator="blank"></textarea></td>
                </tr>
                <tr>
                    <td>Минусы</td>
                    <td>
                        <textarea class="search review-text" name="minus" isReq="false" id="" cols="30" rows="10"  text="минусы" validator="blank"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <div class="button-send button submit-review">Отправить</div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
