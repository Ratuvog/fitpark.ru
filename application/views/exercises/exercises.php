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
                    <div id="exercise-content-inner">
                        <div id="exercise-menu">
                            <nav>
                                <div id="exercise-show">
                                    <p>
                                        <span>Показать:</span>
                                    </p>
                                    <? foreach ($types as $type) {
                                        if ($type->Id == $activeType) {?>
                                            <span class="item"><h2><?=$type->name?></h2></span>
                                        <? } else { ?>
                                            <a href="<?=$type->url;?>"><h2><?=$type->name;?></h2></a>
                                        <? } ?>
                                    <? } ?>
                                </div>
                            </nav>
                        </div>
                        <div id="exercise-items">
                            <div id="exercise-items-inner">
                                <? foreach ($exercises as $exercise) { ?>
                                    <div class="exercise-item exercise-inline">
                                        <table>
                                            <tr>
                                                <td valign="middle" align="center">
                                                    <img src="<?=$exercise->image;?>"/>
                                                </td>
                                            </tr>
                                        </table>
                                        <div></div>
                                        <p><h3><a href="<?=$exercise->url;?>"><?=$exercise->name;?></a></h3></p>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                </div><!--#exercise-content[END]-->
            </div>
        </div>
        </div>
    </div>
</div><!--#main[END]-->