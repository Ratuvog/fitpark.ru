<!DOCTYPE html>
<html>
<head>
	<meta charset="cp-1251" />
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 16px;
}
a:hover
{
    text-decoration: underline;
}

.menu a
{
    
}

</style>
</head>
<body>
        <div>
            <a href="<?php echo site_url('Hfnedjuhfnedju/logout')?>">Выйти</a>
        </div>

        <div style="margin-left:50%;">
            <h2><?php echo $categoryName; ?></h2>
        </div>
    
	<div style="float:left; width: 15%;" class="menu">
            <a href='<?php echo site_url('Hfnedjuhfnedju/filters')?>'>Фильтры</a> </br>
            <a href='<?php echo site_url('Hfnedjuhfnedju/cities')?>'>Города</a> </br>
            <a href='<?php echo site_url('Hfnedjuhfnedju/districts')?>'>Районы</a> </br>
            <a href='<?php echo site_url('Hfnedjuhfnedju/clubs')?>'>Фитнес-клубы</a> </br>
            <a href='<?php echo site_url('Hfnedjuhfnedju/orders')?>'>Порядок вывода клубов</a> </br>
            <a href='<?php echo site_url('Hfnedjuhfnedju/services')?>'>Услуги клубов</a> </br>
            <a href='<?php echo site_url('Hfnedjuhfnedju/subscribes')?>'>Абонементы</a> </br>
            <a href='<?php echo site_url('Hfnedjuhfnedju/reviews')?>'>Отзывы</a> </br>
            <a href='<?php echo site_url('Hfnedjuhfnedju/descriptions')?>'>Описания</a> </br>
            <a href='<?php echo site_url('Hfnedjuhfnedju/photos')?>'>Фото</a> </br>
	</div>
    
        <div>
            <?php echo $output; ?>
        </div>
	<div style='height:20px;'></div>  

    <input type="hidden" id="tbl" name="table" value="<?php echo $currentTable;?>" />
</body>
</html>