<form action="<?=site_url(array('clubs','search'));?>" method="post">
    <div id="search-block">
        <div id="search-block-inner">
            <div id="search-block-logo" class="inline">
                <img src="image/search_logo.png"/>
            </div>
            <div id="search-block-title" class="inline">
                <h2>ФитПоиск</h2>
            </div>
            <div id="search-block-text" class="inline">
                    <input name="search" id="search" type="text" autocomplete="off" placeholder="Клубы, описание, услуги, улица..."/>
                    <input type="submit" id="submit-search" />
            </div>
        </div>
    </div><!--#search-block-->
    <div id="filter-block">
        <div id="filter-block-inner">
            <div id="filter-title" class="inline">
                <h3>быстрый фильтр:</h3>
            </div>
            <div id="select-itmes" class="inline">
                <div class="item inline">
                    <div class="checkbox inline">
                        <input type="checkbox"/>
                    </div>
                    <div class="item-name inline">
                        <img src="image/swim.png" class="inline"/>
                        <span class="inline">бассейн</span>
                    </div>
                </div>

                <div class="item inline">
                    <div class="checkbox inline">
                        <input type="checkbox"/>
                    </div>
                    <div class="item-name inline">
                        <img src="image/sauna.png" class="inline"/>
                        <span class="inline">сауна</span>
                    </div>
                </div>

                <div class="item inline">
                    <div class="checkbox inline">
                        <input type="checkbox"/>
                    </div>
                    <div class="item-name inline">
                        <img src="image/massage.png" class="inline"/>
                        <span class="inline">массаж</span>
                    </div>
                </div>

                <div class="item inline">
                    <div class="checkbox inline">
                        <input type="checkbox"/>
                    </div>
                    <div class="item-name inline">
                        <img src="image/joga.png" class="inline"/>
                        <span class="inline">йога</span>
                    </div>
                </div>
            </div>
        </div>
    </div><!--#filter-block[END]-->
</form>