<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>

<div id="content">
    <div id="content-inner">
        <?$this->load->view('blocks/subtitle-block');?>
        <div id="main">
            <div id="main-inner">
                <?$this->load->view('blocks/breadcrumbs', $breadcrumbs);?>
                <div id="exercise-content" class="content-page manager-in-content">
                    <div id="exercise-content-inner">
                        <table class="manager-in-table">
                            <tr>
                                <td align="center" valign="middle">
                                    <form class="dialog-ajax-form" id="manager-in" action="<?=site_url('Manager/login');?>" method="post">
                                        <table width="100%" class="window manager-forms">
                                            <tr>
                                                <td class="window-name-options">Логин</td>
                                                <td><input type="text" class="checkout-input search" text="Имя" validator="blank" name="login"/></td>
                                            </tr>
                                            <tr>
                                                <td class="window-name-options">Пароль</td>
                                                <td><input type="password" class="checkout-input search" text="E-mail" validator="email" name="pass"/></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" align="center" id="form-comment-wrap">
                                                    <a href="#" id="submit">Войти</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
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