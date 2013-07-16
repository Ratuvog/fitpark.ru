<div id="menu-block">
    <div id="menu-block-inner">
        <menu>
            <div id="top-menu">
                <div id="top-menu-inner" class="inline">
                    <ul>
                        <li class="split"><a href="<?=base_url();?>"><img src="<?=site_url(array('image/main_link.png'));?>"/></a></li>
                        <li class="split"><a href="<?=site_url(array('clubs'));?>" class="padded">Фитнес-клубы</a></li>
                        <li class="split"><a href="#" class="padded">Акции</a></li>
                        <li class="split"><a href="#" class="padded">ФитГид</a></li>
                        <li class="split"><a href="#" class="padded">О ФитПарке</a></li>
                    </ul>
                </div><!--#top-menu[END]-->
                <div id="top-search" class="split inline">
                    <div id="top-search-inner">
                        <form method="get" action="<?=site_url(array('clubs','search'));?>">
                            <div id="search-text">
                                <input name="search" type="text" autocomplete="off" placeholder="Поиск по каталогу фитнес клуба"/><br />
                                <input type="submit"/>
                            </div>
                        </form>
                    </div>
                </div><!--#top-search-->
                <div id="city-block" class="split inline">
                    <div id="city-block-inner">
                        <span class="inline">Ваш город: </span>
                        <div id="city-title" class="inline">
                            <h4><?=$currentCity->name;?></h4>
                        </div>
                    </div>
                </div><!--#city-block[END]-->
            </div>
        </menu>
    </div>
</div><!--#menu-block[END]-->
<div id="logo-block">
    <div id="logo-block-inner">
        <div id="logo-wrap">
            <div id="logo-wrap-inner" class="inline">
                <img src="<?=site_url(array('image/logo.png'));?>" class="inline"/>
                <div id="logo-wrap-title" class="inline"><h1>ФитПарк</h1></div>
            </div><!--#logo-wrap[END]-->
            <div id="logo-city-block" class="inline">
                <div id="logo-city-block-inner" >
                    <h2>все фитнес клубы <span><?=lang("city_2");?></span><img id="city-changed" src="<?=site_url(array('image/city_arrow_select_2.png'));?>"/></h2>
                </div>
            </div><!--#logo-city-block[END]-->
            <div id="picture" class="inline">
                <div id="picture-inner" >
                    <img src="<?=site_url(array('image/photo.png'));?>"/>
                </div>
            </div>
        </div>
    </div>
</div><!--#logo-block[END]-->
<?$this->load->view('dialogs/chooseCity', $chooseCity);?>