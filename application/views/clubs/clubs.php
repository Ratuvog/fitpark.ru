                <table style="width: 100%">
                    <tr>
                        <td class="options" valign="top">
                            <form action="<?=site_url('clubs/filter');?>" method="POST" id="filter">
                                <?  foreach ($filters as $filter) {?>
                                <section class="option">
                                    <header class="name-option">
                                        <h3><?=$filter[0]->filterName;?>: </h3>
                                        <div class="arrow"></div>
                                        <div style="clear: both;"></div>
                                    </header>
                                    <ul class="values-option">
                                        <?  foreach ($filter as $item){
                                            $optinonName = "option".$item->filterid."-".$item->id;?>
                                        <li><input name="<?=$optinonName;?>"
                                                   type="checkbox" <?if($activeFilters[$optinonName] === true) echo 'checked';?>/>
                                             <?=$item->name;?>
                                        </li>
                                        <?}?>
                                    </ul>
                                </section>
                                <?}?>
                                <section class="option">
                                    <header class="name-option">
                                        <h3>Ценовой диапазон </h3>
                                        <div class="arrow"></div>
                                        <div style="clear: both;"></div>
                                    </header>
                                    <div class="slider" from="10" to="100"></div>
                                    <div class="slider-input">
                                        <label for="from">от</label>
                                        <input type="text" size="4" name="rangeF" class="slider-from"
                                               value="<?if(key_exists('rangeF',$activeFilters)) echo $activeFilters['rangeF'];?>"/>
                                        <label for="">до</label>
                                        <input type="text" size="4" name="rangeT" class="slider-to"
                                               value="<?if(key_exists('rangeT',$activeFilters)) echo $activeFilters['rangeT'];?>"/>
                                        <label for="">руб.</label>
                                    </div>
                                </section>
                                <input type="submit" value="Принять" id="submit-filter" />
                            </form>
                        </td>
                        <td valign="top">
                            <header>
                                <h1 class="title-section-fitnes">Фитнес клубы</h1>
                                <div class="type-sort">
                                    <ul>
                                        <li class="title-type-sort">Сортировать по: </li>
                                        <li class="item-type-sort <?if($order=='Popularity') echo 'active';?>">
                                            <span class="sorter" href="<?=site_url('clubs/sort/Popularity');?>">популярности</span>
                                        </li>
                                        <li class="item-type-sort <?if($order=='PriceDesc') echo 'active';?>">
                                            <span class="sorter" href="<?=site_url('clubs/sort/PriceDesc');?>">цене (сначала дорогие)</span>
                                        </li>
                                        <li class="item-type-sort <?if($order=='PriceAsc') echo 'active';?>">
                                            <span class="sorter" href="<?=site_url('clubs/sort/PriceAsc');?>">цене (сначала недорогие)</span>
                                        </li>
                                    </ul>
                                </div>
                            </header>
                            <section id="list">
                                <? foreach ($content as $row) {
                                ?>
                                <article class="mini-card-club">
                                    <table>
                                        <tr>
                                            <td class="mini-card-club-part image-mini-card" valign="top">
                                                <section class="img-club">
                                                    <img style="max-width: 160px" src="<?=$row->head_picture;?>" alt="" />
                                                </section>
                                            </td>
                                            <td class="mini-card-club-part">
                                                <section class="decription-club">
                                                    <header class="name-club">
                                                        <h3>
                                                            <a href="<?=$baseUrlClub.$row->id;?>"><?=$row->name;?></a>
                                                        </h3>
                                                        <h3>
                                                            <?=$row->address;?>
                                                        </h3>
                                                    </header>
                                                    <section class="level-club">
                                                        Фитнес-клуб <?=$row->segment;?>
                                                    </section>
                                                    <section class="services-club">
                                                        <ul class="icons-services">
                                                            <?if(key_exists($row->id, $services)) {
                                                                foreach ($services[$row->id] as $opt) {
                                                                    if(!empty($opt['class'])) {?>
                                                                <li>
                                                                    <div class="<?=$opt['class'];?>"></div>
                                                                </li>
                                                                  <?}
                                                                }
                                                            }?>
                                                        </ul>
                                                        <div style="clear: both;"></div>
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
                                                        <tr>
                                                            <td colspan="2">
                                                                <div class="button-get-discount action-button" href="/club/getDiscount/<?=$row->id;?>"></div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <a href="<?=$baseUrlClub.$row->id;?>"><div class="button-more"></div></a>
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
                        </td>
                    </tr>
                </table>

                <div style="clear: both;"></div>
            </div>
<script type="text/javascript" src="/js/clubs.js"></script>
