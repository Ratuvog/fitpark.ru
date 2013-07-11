<div id="content">
    <div id="content-title-inner">
        <h1>Результаты поиска</h1>
    </div>
    <div class="clear"></div>
    <img src="images/corner_left.png" style="float: left;"/>
    <img src="images/corner_right.png" style="float: right;"/>
    <div class="clear"></div>
</div><!--#results-title[END]-->
<div id="content">
<div id="content-inner">
<div id="make-better" style="display: none;">
    <div id="help-links">
        <ul>
            <li><a></a></li>
        </ul>
    </div><!--#make-better[END]-->
    <div id="make-better-button">
        <p>Сделать ФитПарк лучше</p>
    </div>
</div>
<div id="main">
<div id="main-inner">

</div>
<div id="sidebar-options">
    <div id="sidebar-options-inner">
        <form action="<?=site_url(array('clubs','filter'));?>" method="post" id="filter">
            <? foreach ($filters as $filter) { ?>
                <div class="option">
                    <h3 class="sidebar-option-title"><?=$filter[0]->filterName;?>:</h3>
                    <div class="sidebar-items">
                        <ul>
                            <?  foreach ($filter as $item) {
                                $optinonName = "option".$item->filterid."-".$item->id;?>
                                <li>
                                    <input name="<?=$optinonName;?>"
                                           id="<?=$optinonName;?>"
                                           type="checkbox"
                                        <? if($activeFilters[$optinonName] === true) echo 'checked';?>
                                           class="green-checkbox"/>
                                    <!--                            <div class="sidebar-checkbox inline"></div>-->
                                    <span>мужские групповые программы </span>
                                </li>
                            <? } ?>
                        </ul>
                    </div>
                </div>
            <? } ?>
            <div class="option" id="abonement">
                <h3 class="sidebar-option-title">Ценовой диапазон</h3>
                <div class="sidebar-items">
                    <div class="slider" from="1" to="10000"> </div>
                    <div class="slider-input">
                        <label for="from">от</label>
                        <input type="text" size="4" name="rangeF" class="slider-from"
                               value="<?if($activeFilters['rangeF'] > 0) echo $activeFilters['rangeF']; else echo 0;?>"/>
                        <label for="">до</label>
                        <input type="text" size="4" name="rangeT" class="slider-to"
                               value="<?if($activeFilters['rangeT'] > 0) echo $activeFilters['rangeT']; else echo 40000;?>"/>
                        <label for="">руб.</label>
                    </div>
                </div>
            </div>
            <div class="option">
                <section class="option">
                    <div class="submit-filter">
                        <a class="button submit">Принять</a>
                        <a class="clear-filter" href="<?=site_url(array('clubs','clear'));?>" title="Очистить"></a>
                    </div>
                </section>
            </div>
        </form>
    </div>
</div><!--#sidebar-options[END]-->
<div id="pagination">
    <div id="pagination-inner">
        <div id="pagination-title">
            <h3 class="inline"><?=$list_header;?></h3>
            <hr class="inline"/>
        </div>
        <div id="pagination-sort" class="inline">
            <p>
                <span>Сортировать: </span>
                <a
                    class="sort <?if($order=='popularity') echo 'active';?>"
                    href="<?=site_url(array('clubs','sort','popularity'));?>"
                    >По популярности</a>
                <?if($order=='ratingdesc') { ?>
                    <a class="sort" href="<?=site_url(array('clubs','sort','ratingasc'));?>">по рейтингу</a>
                <?} else { ?>
                    <a class="sort-down" href="<?=site_url(array('clubs','sort','ratingdesc'));?>">по рейтингу</a>
                <? } ?>

                <?if($order=='pricedesc') { ?>
                    <a class="sort" href="<?=site_url(array('clubs','sort','priceasc'));?>">по стоимости</a>
                <?} else { ?>
                    <a class="sort-down" href="<?=site_url(array('clubs','sort','pricedesc'));?>">по стоимости</a>
                <? } ?>
            </p>
        </div>
<!--        TODO: Вставить  код для выбора количества выводимых записей-->
        <div id="pagination-pages" class="inline">
            <?=$paging;?>
        </div>
    </div><!--#pagination[END]-->
</div>
<div id="search-results" class="no-border-bottom">
<? foreach ($content as $row) { ?>

<div class="item-result inline">
    <div class="if-share"></div>
    <div class="main-result-block">
        <div class="item-result-name">
            <a href="<?=site_url(array("club",$row->id));?>"></a><h2>Kangaroo</h2>
        </div>
        <div class="item-result-image">
            <img src="<?=$row->head_picture;?>"/>
        </div>
        <div class="item-result-info">
            <p class="street"><img src="images/map_pin.png" class="inline"/><span class="inline"><?=$row->address;?></span></p>
            <p class="price"><img src="images/pig.png" class="inline"/><span class="inline">от 3500 руб</span></p>
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
                <a href=""><img src="images/camera.png" class="inline"/></a>
            </div>
            <div class="go-to-comments inline">
                <a href=""><img src="images/speach.png" class="inline"/></a>
            </div>
        </div>
    </div>
</div><!--.item-result[END]-->

<? }?>
</div><!--#search-results[END]-->
<div class="clear"></div>
</div>
</div><!--#main[END]-->
</div>
</div><!--#content[END]-->