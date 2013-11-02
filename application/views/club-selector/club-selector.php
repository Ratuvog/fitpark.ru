<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>

<div id="content">
    <div id="content-inner">
        <?$this->load->view('blocks/subtitle-block');?>
        <div id="main">
            <div id="main-inner">
                <?$this->load->view('blocks/fitnesclub_content_menu');?>
                <?$this->load->view('blocks/breadcrumbs', $breadcrumbs);?>
                <div id="exercise-content" class="content-page">
                    <div class="loader">
                        <table>
                            <tr>
                                <td align="center" valign="middle">
                                    <div id="facebookG">
                                        <div id="blockG_1" class="facebook_blockG">
                                        </div>
                                        <div id="blockG_2" class="facebook_blockG">
                                        </div>
                                        <div id="blockG_3" class="facebook_blockG">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="map-content">
                        <div id="sidebar-map">
                            <div id="sidebar-map-inner">
                                <div id="sidebar-map-options">
                                    <nav>
                                        <ul>
                                            <li><a href="-1" class="sidebar-map-menu-active">Все районы</a></li>
                                            <? foreach($districts as $district) { ?>
                                                <li><a href="<?=$district->id;?>" ><?=$district->name;?></a></li>
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
                            <div id="YMapsID" style="width: 710px; height: 500px;">
                            </div>
                            <script type="text/html" id="baloonTemplate">
                                <div><a class="balloonHref" href="$[properties.url]"><h3>$[properties.name]</h3></a></div>
                                <div class="description">$[properties.address]</div>
                            </script>
                        </div>
                    </div><!--#map-content-->

                    <div style="clear: both;"></div>
                </div><!--#exercise-content[END]-->
            </div>
        </div>
    </div>
</div>
</div><!--#main[END]-->