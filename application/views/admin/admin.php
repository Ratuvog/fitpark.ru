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
<link type="text/css" rel="stylesheet" href="<?php echo site_url(array('css','admin','admin.css'));?>" />
<link type="text/css" rel="stylesheet" href="<?php echo site_url(array('css','bootstrap','bootstrap.css'));?>" />
<script src="<?php echo site_url(array('js','bootstrap.js'));?>"></script>

</head>
<body>
<div>
    <a href="<?php echo site_url('Hfnedjuhfnedju/logout')?>">Выйти</a>
</div>

<div style="margin-left:50%;">
    <h2><?php echo $categoryName; ?></h2>
</div>

<div class="navbar">
    <div class="navbar-inner">
    <ul class="nav">
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/filters')?>'>Фильтры</a></li>
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/cities')?>'>Города</a></li>
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/districts')?>'>Районы</a></li>
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/clubs')?>'>Фитнес-клубы</a></li>
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/orders')?>'>Порядок вывода клубов</a></li>
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/services')?>'>Услуги клубов</a></li>
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/subscribes')?>'>Абонементы</a></li>
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/reviews')?>'>Отзывы</a></li>
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/descriptions')?>'>Описания</a></li>
    </ul>
    </div>
</div>
<div class="output">
   <?php echo $output; ?>
</div>
<input type="hidden" id="tbl" name="table" value="<?php echo $currentTable;?>" />
</body>
</html>