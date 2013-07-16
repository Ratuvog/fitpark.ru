<div id="search-block">
    <div id="search-block-inner">
        <div id="search-block-logo" class="inline">
            <img src="<?=site_url('image/search_logo.png');?>"/>
        </div>
        <div id="search-block-title" class="inline">
            <h2>ФитПоиск</h2>
        </div>
        <div id="search-block-text" class="inline">
        <form id="search-form" action="<?=site_url(array('clubs','search'));?>" method="get">
                <input name="search" id="search" type="text" autocomplete="off" placeholder="Клубы, описание, услуги, улица..."/>
                <input type="submit" id="submit-search" />
        </form>
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
                    <a href="<?=site_url(array("clubs","getByService",1));?>">
                        <img src="<?=site_url('image/swim.png');?>" class="inline"/>
                        <span class="inline">бассейн</span>
                    </a>
                </div>
            </div>

            <div class="item inline">
                <div class="checkbox inline">
                    <input type="checkbox"/>
                </div>
                <div class="item-name inline">
                    <a href="<?=site_url(array("clubs","getByService",12));?>">
                        <img src="<?=site_url('image/sauna.png');?>" class="inline"/>
                        <span class="inline">сауна</span>
                    </a>
                </div>
            </div>

            <div class="item inline">
                <div class="checkbox inline">
                    <input type="checkbox"/>
                </div>
                <div class="item-name inline">
                    <a href="<?=site_url(array("clubs","getByService",14));?>">
                        <img src="<?=site_url('image/massage.png');?>" class="inline"/>
                        <span class="inline">массаж</span>
                    </a>
                </div>
            </div>

            <div class="item inline">
                <div class="checkbox inline">
                    <input type="checkbox"/>
                </div>
                <div class="item-name inline">
                    <a href="<?=site_url(array("clubs","getByService",3));?>">
                        <img src="<?=site_url('image/joga.png');?>" class="inline"/>
                        <span class="inline">йога</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div><!--#filter-block[END]-->