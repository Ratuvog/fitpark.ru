<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>

<div id="content">
    <div id="content-inner">
        <?$this->load->view('blocks/subtitle-block');?>
        <div id="main">
            <div id="main-inner">
                <?$this->load->view('blocks/exercise-content-menu');?>
                <?$this->load->view('blocks/breadcrumbs', $breadcrumbs);?>
                <div id="exercise-content" class="content-page">
                    <div id="map-content">
                        <div id="sidebar-map">
                            <div id="sidebar-map-inner">
                                <div id="sidebar-map-options">
                                    <nav>
                                        <ul>
                                            <li><a href="">Все районы</a></li>
                                            <? foreach($districts as $district) { ?>
                                                <li><a href="<?=$district->id;?>"  class="sidebar-map-menu-active"><?=$district->name;?></a></li>
                                            <? } ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div><!--#sidebar-map[END]-->
                        <div id="map-wrap">
                            <div id="map-title">
                                <h2>Выбери удобный для себя вариант</h2>
                            </div>
                            <div id="map-location">
                                <!--<script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=wvCVP9CG4VEyMvWbxdE7YRTkbMBWt7TQ&width=600&height=450"></script>-->
                                <img src="images/map.png" style="position: relative; width: 100%;"/>
                            </div>
                        </div>
                    </div><!--#map-content-->
                    <div style="clear: both;"></div>
                </div><!--#exercise-content[END]-->
            </div>
        </div>
    </div>
</div>
</div><!--#main[END]-->