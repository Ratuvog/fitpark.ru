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
                            <div class="inline">
                                <form method="post" action="<?=site_url('Manager/login');?>" class="auth-block">
                                    <div class="box">
                                        <div class="user-input">
                                            <p class="caption">Логин</p>
                                            <input name="login" type="text" text="Логин" placeholder="Логин" validator="blank"/>
                                        </div>
                                        <div class="user-input">
                                            <p class="caption">Пароль</p>
                                            <input name="pass" type="password" text="Пароль" placeholder="Пароль" validator="blank"/>
                                        </div>
                                        <?if($authError != 'OK') {?>
                                            <label class="error"><?=$authError;?></label>
                                        <? } ?>
                                        <div id="auth-button" class="page-club-menu inline">
                                            <img src="<?=site_url("image/v_card.png");?>" class="inline"/>
                                            <p class="inline">Войти</p>
                                            <script>
                                                $(function(){
                                                    $("#auth-button").on('click', checkForm);
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="inline auth-info-block">
                                <p>Информация для менеджера</p>
                            </div>
                        </div><!--#page-club-info-main[END]-->
                    </div>
                </div>
            </div> 
        </div><!--#main[END]-->
    </div>
</div><!--#content[END]-->


