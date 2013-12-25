<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>

<script type="text/javascript" src="<?=site_url("js/bacbone/underscore-min.js");?>"></script>
<script type="text/javascript" src="<?=site_url("js/bacbone/backbone-min.js");?>"></script>
<script type="text/javascript" src="<?=site_url("js/manager/requests.js");?>"></script>
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
<script>
    CURRENT_CLUB_ID = <?=$club->id;?>
</script>

<link rel="stylesheet" type="text/css" href="<?=site_url('css/manager/manager-private.css')?>"/>
<link rel="stylesheet" href="<?=site_url('css/bootstrap/bootstrap.css');?>"/>
<link rel="stylesheet" href="<?=site_url('css/bootstrap/bootstrap-responsive.css');?>"/>
<script type="text/html" id="requestView">
    <td><a class="btn btn-large edit-request" href="#"><i class="icon-pencil"></i></a></td>
    <td><%= id %></td>
    <td><%= date %></td>
    <td><%= name %></td>
    <td><%= surname %></td>
    <td><%= duration %></td>
    <td><%= tel %></td>
    <td><%= e-mail%></td>
</script>
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
                                    <div id="requestList">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>#</th>
                                                <th>Дата</th>
                                                <th>Имя пользователя</th>
                                                <th>Телефон</th>
                                                <th>E-mail</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="editRequest">

                                    </div>
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




