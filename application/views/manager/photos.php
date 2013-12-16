<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>

<script type="text/javascript" src="<?=site_url("js/ckeditor/ckeditor.js");?>"></script>
<script type="text/javascript" src="<?=site_url("assets/fileupload/js/vendor/jquery.ui.widget.js");?>"></script>
<script type="text/javascript" src="<?=site_url("assets/fileupload/js/jquery.iframe-transport.js");?>"></script>
<script type="text/javascript" src="<?=site_url("assets/fileupload/js/jquery.fileupload.js");?>"></script>
<script type="text/javascript" src="<?=site_url("assets/fileupload/js/jquery.fileupload-ui.js");?>"></script>
<script type="text/javascript" src="<?=site_url("assets/fileupload/js/jquery.iframe-transport.js");?>"></script>
<script type="text/javascript" src="<?=site_url("assets/fileupload/js/jquery.fileupload-process.js");?>"></script>
<script type="text/javascript" src="<?=site_url("assets/fileupload/js/jquery.fileupload-image.js");?>"></script>
<script type="text/javascript" src="<?=site_url("assets/fileupload/js/jquery.fileupload-validate.js");?>"></script>
<script type="text/javascript" src="<?=site_url("js/manager/manager-private.js");?>"></script>
<script type="text/javascript" src="<?=site_url("js/manager/formSaver.js");?>"></script>
<script type="text/javascript" src="<?=site_url("js/bootstrap.js");?>"></script>
<script type="text/javascript" src="<?=site_url("js/club.js");?>"></script>
<?php 
foreach($output->css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($output->js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<link rel="stylesheet" type="text/css" href="<?=site_url('css/manager/manager-private.css')?>"/>

<div id="content">
    <div id="content-inner">
        <div id="main">
            <div id="main-inner">
                <?$this->load->view('blocks/content-manager-menu', $this);?>
                <?$this->load->view('blocks/breadcrumbs', $breadcrumbs);?>
                <div id="page-club">
                    <div id="page-club-inner">
                        <div id="page-club-info-main">
                            <div class="info-block">
                                <div class="save-form box">
                                    <?=$output->output;?>
                                </div>
                            </div>
                        </div><!--#page-club-info-main[END]-->
                    </div>
                </div>
                <div style="clear: both;"></div>
            </div>
        </div><!--#main[END]-->
    </div>
</div><!--#content[END]-->




