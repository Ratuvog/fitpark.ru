<!DOCTYPE html>
<html>
<head>
    <meta charset="cp-1251" />
    <link type="text/css" rel="stylesheet" href="<?php echo site_url(array('css','admin','admin.css'));?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo site_url(array('css','bootstrap','bootstrap.css'));?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo site_url(array("js/fancybox/jquery.fancybox.css"));?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo site_url(array("js/fancybox/helpers/jquery.fancybox-buttons.css"));?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo site_url(array("js/fancybox/helpers/jquery.fancybox-thumbs.css"));?>" />

    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
    <script src="<?php echo site_url(array('js','bootstrap.js'));?>"></script>
    <script src="<?php echo site_url(array("js/fancybox/jquery.fancybox.pack.js"));?>"></script>
    <script src="<?php echo site_url(array("js/fancybox/helpers/jquery.fancybox-buttons.js"));?>"></script>
    <script src="<?php echo site_url(array("js/fancybox/helpers/jquery.fancybox-media.js"));?>"></script>
    <script src="<?php echo site_url(array("js/fancybox/helpers/jquery.fancybox-thumbs.js"));?>"></script>
    <script src="<?php echo site_url(array("js/fancybox/jquery.fancybox.pack.js"));?>"></script>
</head>
<body style="padding: 20px;">
<div>
    <a href="<?php echo site_url('Hfnedjuhfnedju/logout')?>">Выйти</a>
</div>

<div style="text-align: center;">
    <h2><?php echo $categoryName; ?></h2>
</div>

<div class="navbar">
    <div class="navbar-inner">
    <ul class="nav">
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/cities')?>'>Города (<?=$counters->city;?>)</a></li>
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/districts')?>'>Районы (<?=$counters->district;?>)</a></li>
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/clubs')?>'>Фитнес-клубы (<?=$counters->fitnesclub;?>)</a></li>
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/services')?>'>Услуги клубов (<?=$counters->fitnesclub_services;?>)</a></li>
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/orders')?>'>Порядок вывода клубов</a></li>
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/descriptions')?>'>Описания</a></li>
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/filters')?>'>Фильтры</a></li>
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/managers')?>'>Менеджеры</a></li>
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/order_list_active')?>'>Заявки на изменения (<?=$changeOrderCount;?>)</a></li>
        <li><a href='<?php echo site_url('Hfnedjuhfnedju/exercise')?>'>Упражнения</a></li>
        <li><a href="<?php echo site_url('Hfnedjuhfnedju/qa')?>">Вопрос ответ</a></li>
        <li><a href="<?php echo site_url('Hfnedjuhfnedju/sales')?>">Акции</a></li>
        <li><a href="<?php echo site_url('Hfnedjuhfnedju/comments')?>">Коментарии</a></li>
        <li><a href="<?php echo site_url('Hfnedjuhfnedju/feedback')?>">Звонок менеджеру</a></li>
        <li><a href="<?php echo site_url('Hfnedjuhfnedju/abonement')?>">Заявка на абонемент</a></li>
        <li><a href="<?php echo site_url('Hfnedjuhfnedju/guest')?>">Звонок в клуб</a></li>
        <li><a href="<?php echo site_url('Hfnedjuhfnedju/question')?>">Вопрос менеджеру</a></li>
        <li><a href="<?php echo site_url('Hfnedjuhfnedju/paidShows')?>">Платные показы</a></li>
    </ul>
    </div>
</div>