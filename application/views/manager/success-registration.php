<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>

<link rel="stylesheet" type="text/css" href="<?=site_url('css/manager/manager-private.css')?>"/>
<div id="content">
    <div id="content-inner">
        <div id="main">
            <div id="main-inner">
                <?$this->load->view('blocks/breadcrumbs', $breadcrumbs);?>
                <div id="page-club">
                    <div id="page-club-inner">
                        <div id="page-club-info-main">
                            <div class = "input-block">
                                <div class="box">
                                    <h2>Заявка на создание учетной записи успешно отправлена</h2>
                                    <p>
                                        Наши специалисты свяжутся с вами в ближайшее время.
                                </div>
                            </div>
                            <div style="clear: both;"> </div>
                        </div><!--#page-club-info-main[END]-->
                    </div>
                </div>
            </div>
        </div><!--#main[END]-->
    </div>
</div><!--#content[END]-->



