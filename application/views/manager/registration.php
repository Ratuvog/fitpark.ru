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
                                <form method="post" action="<?=site_url('manager/signup_submit');?>" class="auth-block">
                                    <div class="box">
                                        <?if(isset($authError) && $authError != 'OK') {?>
                                            <div class = "input-block">
                                                <label class="error"><?= $authError;?></label>
                                            </div>
                                        <? } ?>

                                        <div class = "input-block">
                                            <div class="user-input">
                                                <p class="caption">Логин</p>
                                                <input class="input-field" name="login" type="text" text="Логин" placeholder="Логин" validator="blank"/>
                                            </div>
                                        </div>

                                        <div class = "input-block">
                                            <div class="user-input">
                                                <p class="caption">Пароль</p>
                                                <input class="input-field" name="password" type="password" text="Пароль" placeholder="Пароль" validator="min_length" min-length="6"/>
                                            </div>
                                        </div>

                                        <div class = "input-block">
                                            <div class="user-input">
                                                <p class="caption">Подтверждение пароля</p>
                                                <input class="input-field" name="passconf" type="password" text="Подтверждение пароля" placeholder="Пароль" validator="match" match="password" />
                                            </div>
                                        </div>

                                        <div class = "input-block">
                                            <div class="user-input">
                                                <p class="caption">ФИО</p>
                                                <input class="input-field" name="username" type="text" text="ФИО" validator="empty"/>
                                            </div>
                                        </div>

                                        <div class = "input-block">
                                            <div class="user-input">
                                                <p class="caption">E-mail</p>
                                                <input class="input-field" name="email" type="email" text="E-mail" validator="email" />
                                            </div>
                                        </div>

                                        <div class = "input-block">
                                            <div class="user-input">
                                                <p class="caption">Телефон</p>
                                                <input class="input-field" name="phone" type="text" text="Телефон"/>
                                            </div>
                                        </div>

                                        <div class = "input-block">
                                            <div class="user-input">
                                                <p class="caption">Клубы</p>
                                                <textarea class="input-field" name="comment" isReq="false">
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class = "input-block">
                                            <div id="auth-button" class="blue-long-button inline">
                                                <a class="inline">Отправить</a>
                                                <script> $(function(){ $("#auth-button").on('click', checkForm); }); </script>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class = "input-block">
                                <div class="box">
                                    <h2>Заявка на создание учетной записи менеждера</h2>
                                    <p>
                                        После того, как заявка будет отправлена, наши специалисты свяжутся с вами в ближайшее время.
                                    <p>
                                        В поле "Клубы" желательно перечислить клубы, на управление которыми подается заявка.
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



