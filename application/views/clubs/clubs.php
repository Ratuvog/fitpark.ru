<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>

<script type="text/javascript" src="<?=site_url("js/clubs.js");?>"></script>
<div id="content">
    <div id="content-inner">
        <?$this->load->view('blocks/subtitle-block');?>
        <div id="main">
            <div id="main-inner">
                <?$this->load->view('blocks/fitnesclub_content_menu');?>
                <?$this->load->view('blocks/breadcrumbs', $breadcrumbs);?>
                <div id="page-club-list">
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
                                                        <div class="checkbox inline">
                                                        <input name="<?=$optinonName;?>"
                                                               id="<?=$optinonName;?>"
                                                               type="checkbox"
                                                            <? if($activeFilters[$optinonName] === true) echo 'checked';?>
                                                               class="green-checkbox"/>
                                                        </div>
                                                        <!--                            <div class="sidebar-checkbox inline"></div>-->
                                                        <span><?=$item->name;?></span>
                                                    </li>
                                                <? } ?>
                                            </ul>
                                        </div>
                                    </div>
                                <? } ?>
                                <div class="option" id="abonement">
                                    <h3 class="sidebar-option-title">Ценовой диапазон</h3>
                                    <div class="sidebar-items">
                                        <div class="slider" from="0" to="40000"> </div>
                                        <table class="slider-input-wrapper">
                                            <tr>
                                                <td align="center">
                                                    <div class="slider-input">
                                                        <label for="from">от</label>
                                                        <input type="text" size="7" name="rangeF" class="slider-from"
                                                               value="<?if($activeFilters['rangeF'] > 0) echo $activeFilters['rangeF']; else echo 0;?>"/>
                                                        <label for="">до</label>
                                                        <input type="text" size="7" name="rangeT" class="slider-to"
                                                               value="<?if($activeFilters['rangeT'] > 0) echo $activeFilters['rangeT']; else echo 40000;?>"/>
                                                        <label for="">руб.</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                </div>
                                <section class="option">
                                    <div class="submit-filter">
                                        <a class="button submit">Принять</a>
                                        <a class="clear-filter" href="<?=site_url(array('clubs','clear'));?>" title="Очистить">Очистить</a>
                                    </div>
                                </section>
                            </form>
                        </div>
                    </div><!--#sidebar-options[END]-->
                    <div id="pagination">
                        <div id="pagination-inner">
                            <div id="pagination-title">
                                <h3 class="inline"><?=$list_header;?></h3>
                                <hr class="inline"/>
                            </div>
                            <div id="pagination-sort">
                                <p>
                                    <span>Сортировать: </span>
                                    <a
                                        class="sort <?if($order=='popularity') echo 'active';?>"
                                        href="<?=site_url(array('clubs','sort','popularity'));?>"
                                        >По популярности</a>
                                    <?if($order=='ratingasc') { ?>
                                        <a class="sort-down" href="<?=site_url(array('clubs','sort','ratingdesc'));?>">по рейтингу</a>
                                    <?} else { ?>
                                        <a class="sort" href="<?=site_url(array('clubs','sort','ratingasc'));?>">по рейтингу</a>
                                    <? } ?>

                                    <?if($order=='priceasc') { ?>
                                        <a class="sort-down" href="<?=site_url(array('clubs','sort','pricedesc'));?>">по стоимости</a>
                                    <?} else { ?>
                                        <a class="sort" href="<?=site_url(array('clubs','sort','priceasc'));?>">по стоимости</a>
                                    <? } ?>
                                </p>
                            </div>
                            <div id="pagination-pages" class="inline pagination-bar">
                                <?=$paging;?>
                                <ul class="type-sort" style="float: left;">
                                    <li class="title-type-sort first-element">Выводить по: </li>
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
                            </div>
                        </div><!--#pagination[END]-->
                    </div>
                    <div id="search-results" class="no-border-bottom">
                        <? foreach ($content as $club) { ?>
                            <? $this->load->view('blocks/club-item', $club); ?>
                        <? }?>
                    </div><!--#search-results[END]-->
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div><!--#main[END]-->