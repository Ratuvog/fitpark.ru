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
                        <table>
                            <tr>
                                <td colspan="2" align="center">
                                    <iframe width="560" height="315" src="<?=$exercise->video;?>" frameborder="0" allowfullscreen></iframe>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h1>Описание</h1>
                                    <p><?=$exercise->description;?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h1>Техника выполнения</h1>
                                    <p>
                                        <?=$exercise->technique;?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h1>Нюансы упражнения</h1>
                                    <p>
                                        <?=$exercise->nuances;?>
                                    </p>
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