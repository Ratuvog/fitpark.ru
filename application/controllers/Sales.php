<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>

<div id="content">
    <div id="content-inner">
        <?$this->load->view('blocks/subtitle-block');?>
        <div id="main">
            <div id="main-inner">
                <?$this->load->view('blocks/content-menu');?>
                <?$this->load->view('blocks/breadcrumbs', $breadcrumbs);?>
                <div id="exercise-content">
                    <div id="exercise-content-inner">
                        <? foreach($sales as $sale){ ?>
                        <div class="sale-club">
                            <div class="banner">
                                <img src=<?=$sale->image;?>"/>
                            </div>
                            <div class="item-result-wrap">
                                <div class="item-result inline">
                                    <div class="if-share do"></div>
                                    <div class="main-result-block">
                                        <? $this->load->view('blocks/club-item', $sale->club); ?>
                                    </div>
                                </div><!--.item-result[END]-->
                            </div>
                            <div class="clear"></div>
                        </div><!--.sale-club[END]-->
                        <? } ?>
                    </div>
                </div><!--#exercise-content[END]-->
            </div>
        </div>
    </div>
</div>
</div><!--#main[END]-->