<div>
    <h2><?php echo $categoryName; ?></h2>
</div>

<form method="post" action="<?=site_url('Manager/login');?>" class="auth-block">
    <div class="box">
        <div class="user-input">
            <label class="caption">Логин</label>
            <input name="login" type="text" placeholder="Логин"/>
        </div>
        <div class="user-input">
            <label class="caption">Пароль</label>
            <input name="pass" type="password" placeholder="Пароль"/>
        </div>
        <?if($authError != 'OK') {?>
            <label class="error"><?=$authError;?></label>
        <? } ?>
        <input class="save" type="submit" value="Войти"/>
    </div>
</form>