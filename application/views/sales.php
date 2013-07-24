<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>

<div id="content">
    <div id="content-inner">
        <?$this->load->view('blocks/subtitle-block');?>
        <div id="main">
            <div id="main-inner">
                <?$this->load->view('blocks/breadcrumbs', $breadcrumbs);?>
                <div id="exercise-content">
                    <div id="exercise-content-inner">
                        <? foreach($sales as $sale){ ?>
                        <div class="sale-club">
                            <table class="banner">
                                <tr>
                                    <td valign="middle">
                                        <?=$sale->content;?>
                                    </td>
                                </tr>
                            </table>
                            <div class="item-result-wrap">
                                <? $this->load->view('blocks/club-item', $sale->club); ?>
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