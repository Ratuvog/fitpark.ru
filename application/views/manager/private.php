<link type="text/css" rel="stylesheet" href="<?php echo site_url(array('css','manager-private.css'));?>"/>
<script type="text/javascript" src="<?php echo site_url(array('js','manager-private.js'));?>"></script>
<div>
    <h2><?php echo $categoryName; ?></h2>
</div>

<div class="navbar">
    <div class="navbar-inner">
        <ul class="nav">
            <li><a href=''>О Клубе</a></li>
            <li><a href=''>Описание</a><li>
            <li><a href=''>Фотографии</a></li>
        </ul>
    </div>
</div>

<div class="info-block">
    <div class="title">Общая информация</div>
    <div class="box">
        <div class="user-input">
            <label class="caption">Наименование</label>
            <input type="text" placeholder="Наименование"/>
        </div>
        <div class="user-input">
            <label class="caption">Сайт</label>
            <input type="text" placeholder="Сайт"/>
        </div>
        <div class="user-input">
            <label class="caption">Телефон</label>
            <input type="text" placeholder="Телефон"/>
        </div>
        <div class="user-input">
            <label class="caption">Город</label>
            <select id="city-combobox">
                <option value="">Город...</option>
                <? foreach($cities as $city) : ?>
                    <option value="<?=$city->id?>"><?=$city->name;?></option>
                <? endforeach;?>
            </select>
        </div>
        <div class="user-input">
            <label class="caption">Район</label>
            <select id="district-combobox">
                <option value="">Район...</option>
                <? foreach($districts as $distr) : ?>
                    <option value="<?=$distr->id?>"><?=$distr->name;?></option>
                <? endforeach;?>
            </select>
        </div>
        <div class="user-input">
            <label class="caption">Адрес</label>
            <input type="text" placeholder="Адрес"/>
        </div>
        <input class="save" id="common-save" type="button" value="Сохранить"/>
        <label class="result">Изменения отправлены на проверку.</label>

    </div>
</div>

<div class="info-block">
    <div class="title">Краткое описание</div>
    <div class="box"></div>
</div>

<div class="lclear"></div>
    
<div class="info-block">
    <div class="title">Услуги</div>
    <div class="box"></div>
</div>
   
<div class="info-block">
    <div class="title">Стоимость посещений</div>
    <div class="box"></div>
</div>

<div class="lclear"></div>