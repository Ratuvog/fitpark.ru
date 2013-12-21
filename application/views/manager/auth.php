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
                            <div class="inline" style="float:left;">
                                <form method="post" action="<?=site_url('manager/login');?>" class="auth-block">
                                    <div class="box">
                                        <div class = "input-block">
                                            <div class="user-input">
                                                <p class="caption">Логин</p>
                                                <input class="input-field" name="login" type="text" text="Логин" placeholder="Логин" validator="blank"/>
                                            </div>
                                        </div>

                                        <div class = "input-block">
                                            <div class="user-input">
                                                <p class="caption">Пароль</p>
                                                <input class="input-field" name="pass" type="password" text="Пароль" placeholder="Пароль" validator="blank"/>
                                            </div>
                                        </div>


                                    <?if(isset($authError) && $authError != 'OK') {?>
                                        <div class = "input-block">
                                            <label class="error"><?=$authError;?></label>
                                        </div>
                                    <? } ?>

                                        <div class = "input-block">
                                            <div id="auth-button" class="blue-long-button inline">
                                                <a class="inline">Войти</a>
                                                <script> $(function(){ $("#auth-button").on('click', checkForm); }); </script>
                                            </div>
                                        </div>

                                        <div class = "input-block">
                                            <a href="<?= site_url('manager/singup');?>" class="blue-long-button inline">Зарегистрироваться</a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class = "input-block">
                                <div class="box">
                                    <h2>Панель менеджера фитнес-клуба</h2>
                                    <p>
                                        Раздел предназачен для управления услугами и редактирования информации о фитнес-клубе.
                                    <p>
                                        Менеджер может изменить всю видимую посетителями информацию о клубе - логотип, название, адрес, время работы, фотографии, перечень предоставляемых услуг, и пр.
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



