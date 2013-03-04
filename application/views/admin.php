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
            <a href="<?php echo site_url('admin/logout')?>">Выйти</a>
        </div>

        <div style="margin-left:50%;">
            <h2><?php echo $categoryName; ?></h2>
        </div>
    
	<div style="float:left; width: 15%;" class="menu">
            <a href='<?php echo site_url('admin/categories')?>'>Категории</a> </br>
            <a href='<?php echo site_url('admin/options')?>'>Опции фильтрации</a> </br>
            <a href='<?php echo site_url('admin/values')?>'>Значения опций</a> </br>
            <a href='<?php echo site_url('admin/items')?>'>Контент(Фитнес-клубы)</a> </br>
            <a href='<?php echo site_url('admin/groups')?>'>Группы (Районы, Города)</a> </br>
            <a href='<?php echo site_url('admin/descriptions')?>'>Описания</a> </br>
            <a href='<?php echo site_url('admin/news')?>'>Новости</a> </br>
            <a href='<?php echo site_url('admin/reviews')?>'>Отзывы</a> </br>
            <a href='<?php echo site_url('admin/discounts')?>'>Скидки</a> </br>
            <a href='<?php echo site_url('admin/photos')?>'>Фото</a> </br>
            <a href='<?php echo site_url('admin/item_ratings')?>'>Рейтинги</a>
	</div>
    
        <div>
            <?php echo $output; ?>
        </div>
	<div style='height:20px;'></div>  

    <input type="hidden" id="tbl" name="table" value="<?php echo $currentTable;?>" />
</body>
</html>
