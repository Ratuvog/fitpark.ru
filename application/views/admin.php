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
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>
</head>
<body>
	<div>
            <a href='<?php echo site_url('admin/categories')?>'>Категории</a> </br>
            <a href='<?php echo site_url('admin/options')?>'>Опции фильтрации</a> |
            <a href='<?php echo site_url('admin/values')?>'>Значения опций</a> </br>
            <a href='<?php echo site_url('admin/items')?>'>Элементы категорий(контент)</a> |
            <a href='<?php echo site_url('admin/groups')?>'>Группы</a> </br>
            <a href='<?php echo site_url('admin/descriptions')?>'>Описания элементов</a> |
            <a href='<?php echo site_url('admin/news')?>'>Новости элементов</a> |
            <a href='<?php echo site_url('admin/reviews')?>'>Отзывы элементов</a> |
            <a href='<?php echo site_url('admin/discounts')?>'>Скидки элементов</a> |
            <a href='<?php echo site_url('admin/photos')?>'>Фото элементов</a> |
            <a href='<?php echo site_url('admin/item_ratings')?>'>Рейтинг элементов</a>
	</div>
	<div style='height:20px;'></div>  
<div>
    <h2><?php echo $categoryName; ?></h2>
</div>
    <div>
        <?php echo $output; ?>
    </div>
    <input type="hidden" id="tbl" name="table" value="<?php echo $currentTable;?>" />
</body>
</html>
