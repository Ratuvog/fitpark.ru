<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>

<div id="content">
    <div id="content-inner">
        <?$this->load->view('blocks/subtitle-block');?>
        <div id="main">
            <div id="main-inner">
                <?$this->load->view('blocks/breadcrumbs', $breadcrumbs);?>
                <div id="exercise-content" class="content-page">
                    <div id="exercise-content-inner">
                        <table>
                            <? if($exercise->video) { ?>
                            <tr>
                                <td colspan="2" align="center">
                                    <iframe width="560" height="315" src="<?=$exercise->video;?>" frameborder="0" allowfullscreen></iframe>
                                </td>
                            </tr>
                            <? } ?>
                            <tr>
                                <td colspan="2">
                                    <h2>Описание</h2>
                                    <div class="ckeditor-text">
                                        <?=$exercise->description;?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h2>Техника выполнения</h2>
                                    <div class="ckeditor-text">
                                        <?=$exercise->technique;?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h2>Нюансы упражнения</h2>
                                    <div class="ckeditor-text">
                                        <?=$exercise->nuances;?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div><!--#exercise-content[END]-->
            </div>
        </div>
    </div>
</div>
</div><!--#main[END]-->