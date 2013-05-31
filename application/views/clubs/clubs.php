<table style="width: 100%">
    <tr>
        <td class="options" valign="top">
            <form action="<?=site_url(array('clubs','filter'));?>" method="post" id="filter">
            <? foreach ($filters as $filter) { ?>
                <section class="option">
                    <header class="name-option">
                        <h3><?=$filter[0]->filterName;?>: </h3>
                        <div class="state-option arrow"></div>
                        <div style="clear: both;"></div>
                    </header>
                    <ul class="values-option">
                        <?  foreach ($filter as $item) {
                            $optinonName = "option".$item->filterid."-".$item->id;?>
                        <li>
                             <input name="<?=$optinonName;?>"
                                    id="<?=$optinonName;?>"
                                    type="checkbox"
                                    <? if($activeFilters[$optinonName] === true) echo 'checked';?>
                                    class="green-checkbox"/>
                             <label for="<?=$optinonName;?>" class="green-checkbox-label"><?=$item->name;?></label>
                        </li>
                        <?}?>
                    </ul>
                </section>
            <? } ?>
                <section class="option">
                    <header class="name-option">
                        <h3>Ценовой диапазон </h3>
                        <div class="state-option arrow"></div>
                        <div style="clear: both;"></div>
                    </header>
                    <div>
                        <div class="slider" from="1" to="10000"> </div>
                        <div class="slider-input">
                            <label for="from">от</label>
                            <input type="text" size="4" name="rangeF" class="slider-from"
                                   value="<?if($activeFilters['rangeF'] > 0) echo $activeFilters['rangeF']; else echo 0;?>"/>
                            <label for="">до</label>
                            <input type="text" size="4" name="rangeT" class="slider-to"
                                   value="<?if($activeFilters['rangeT'] > 0) echo $activeFilters['rangeT']; else echo 10000;?>"/>
                            <label for="">руб.</label>
                        </div>
                    </div>
                </section>
                <section class="option">
                    <div class="button submit">Принять</div>
                </section>
            </form>
        </td>
        <td valign="top">
            <header class="list-header">
                <h1 class="title-section-fitnes"><?=$list_header;?></h1>
                <ul class="type-sort">
                    <li class="title-type-sort">Сортировать: </li>
                    <li class="item-type-sort <?if($order=='popularity') echo 'active';?>">
                        <a class="sorter" href="<?=site_url(array('clubs','sort','popularity'));?>">по популярности</a>
                    </li>

                    <?if($order=='ratingdesc') { ?>
                        <li class="item-type-sort active">
                            <a class="sorter" href="<?=site_url(array('clubs','sort','ratingasc'));?>">по рейтингу
                                <img src="<?=site_url(array('image','arrow_down.png'));?>"></img>
                            </a>
                        </li>
                    <?} else { ?>
                        <li class="item-type-sort <?if($order=='ratingdesc') echo 'active';?>">
                            <a class="sorter" href="<?=site_url(array('clubs','sort','ratingdesc'));?>">по рейтингу</a>
                                <img src="<?=site_url(array('image','arrow_up.png'));?>"></img>
                            </a>
                        </li>
                    <? } ?>

                    <?if($order=='pricedesc') { ?>
                        <li class="item-type-sort active">
                            <a class="sorter" href="<?=site_url(array('clubs','sort','priceasc'));?>">по стоимости
                                <img src="<?=site_url(array('image','arrow_down.png'));?>"></img>
                            </a>
                        </li>
                    <?} else { ?>
                        <li class="item-type-sort <?if($order=='priceasc') echo 'active';?>">
                            <a class="sorter" href="<?=site_url(array('clubs','sort','pricedesc'));?>">по стоимости
                                <img src="<?=site_url(array('image','arrow_up.png'));?>"></img>
                            </a>
                        </li>
                    <? } ?>
                </ul>
                <div style="clear: both;"></div>
                <ul class="type-sort">
                    <li class="title-type-sort">Выводить по: </li>
                    <li class="item-type-sort">
                        <a class="sorter" href="<?=site_url(array('clubs','row',10));?>">10</a>
                    </li>
                    <li class="item-type-sort">
                        <a class="sorter" href="<?=site_url(array('clubs','row',25));?>">25</a>
                    </li>
                    <li class="item-type-sort">
                        <a class="sorter" href="<?=site_url(array('clubs','row',50));?>">50</a>
                    </li>
                </ul>
                <?=$paging;?>
            </header>
            <section id="list">
                <? foreach ($content as $row) {
                ?>
                <article class="mini-card-club">
                    <table>
                        <tr>
                            <td class="mini-card-club-part image-mini-card" valign="top">
                                <section class="img-club">
                                    <table class="image-wrapper">
                                        <tr>
                                            <td align="center" valign="middle" >
                                                <img style="max-width: 160px" src="<?=$row->head_picture;?>" alt=""/>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="rating clubs-mini"
                                         title="Средняя оценка клуба: <?=round($row->rating,2);?>. Оценок: <?=round($row->votes,2);?>"
                                         data-score="<?=$row->rating;?>">
                                    </div>
                                </section>
                            </td>
                            <td class="mini-card-club-part">
                                <section class="decription-club">
                                    <header class="name-club">
                                        <h3>
                                            <a href="<?=$baseUrlClub.$row->id;?>" target="_blank"><?=$row->name;?></a>
                                        </h3>
                                        <div style="color: #aaa;">
                                            <?=$row->address;?>
                                        </div>
                                    </header>
                                    <section class="services-club">
                                        <ul class="icons-services">
                                            <?if(key_exists($row->id, $services)) {
                                                foreach ($services[$row->id] as $opt) {
                                                    if(!empty($opt['icon'])) {?>
                                                <li>
                                                    <img src="<?=$opt['icon'];?>" title="<?=$opt['name'];?>"></img>
                                                </li>
                                                  <?}
                                                }
                                            }?>
                                        </ul>
                                        <div style="clear: both;"></div>
                                    </section>
                                    <section class="level-club">
                                        <?=$row->segment;?>
                                    </section>
                                    <section class="text-description-club">
                                        <p>
                                            <?=$row->description;?>
                                        </p>
                                    </section>
                                </section>
                            </td>
                            <td valign="top" class="mini-card-club-part mini-card-club-price">
                                <section class="price-club">
                                    <table>
                                        <?if($row->sub1 > 0){?>
                                        <tr>
                                            <td class="price-club-date">1 месяц</td>
                                            <td class="price-club-price"><h4>от <?=$row->sub1;?> рублей</h4></td>
                                        </tr>
                                        <?}?>
                                        <?if($row->sub3 > 0){?>
                                        <tr>
                                            <td class="price-club-date">3 месяца</td>
                                            <td class="price-club-price"><h4>от <?=$row->sub3;?> рублей</h4></td>
                                        </tr>
                                        <?}?>
                                        <?if($row->sub6 > 0){?>
                                        <tr>
                                            <td class="price-club-date">6 месяцев</td>
                                            <td class="price-club-price"><h4>от <?=$row->sub6;?> рублей</h4></td>
                                        </tr>
                                        <?}?>
                                        <?if($row->sub12 > 0){?>
                                        <tr>
                                            <td class="price-club-date">1 год</td>
                                            <td class="price-club-price"><h4>от <?=$row->sub12;?> рублей</h4></td>
                                        </tr>
                                        <?}?>
                                        <tr>
                                            <td colspan="2">
                                                <div class="button-get-discount button-club action-button" selector="#get-answer" href="/club/getQuestion/<?=$row->id;?>">
                                                    <ul>
                                                        <li>
                                                            <div class="icon-small-help"></div>
                                                        </li>
                                                        <li>
                                                            <span class="button-text">Задать вопрос менеджеру</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <a href="<?=$baseUrlClub.$row->id;?>" target="_blank" class="no-decoration"><div class="button-more button">Подробнее о клубе</div></a>
                                            </td>
                                        </tr>
                                    </table>
                                </section>
                            </td>
                        </tr>
                    </table>
                </article>
                <?}//foreach?>
            </section>
            <?=$paging;?>
        </td>
    </tr>
</table>
<div style="clear: both;"></div>
</div>
<script type="text/javascript" src="<?=site_url(array('js','clubs.js'))?>"></script>
