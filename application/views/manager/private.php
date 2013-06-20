<div>
    <h2><?php echo $categoryName;?></h2><div class="font-hint"> последнее изменение <span id="last-update"><?=$club->last_update;?></span></div>
    <input id="clubid" value="<?=$club->id;?>" type="hidden" />
</div>

<div class="navbar">
    <div class="navbar-inner">
        <ul class="nav">
            <li><a href=''>Общая информация</a></li>
            <li><a href=''>Описание</a><li>
            <li><a href=''>Фотографии</a></li>
        </ul>
    </div>
</div>

<div class="info-block">
    <div class="title">Общая информация</div>
    <div class="save-form box">
        <div class="user-input">
            <label class="caption">Наименование</label>
            <input name="name" type="text" placeholder="Наименование" value="<?=$club->name;?>" validator="blank"/>
        </div>
        <div class="user-input">
            <label class="caption">Сайт</label>
            <input name="site" type="text" placeholder="Сайт" value="<?=$club->site;?> " validator="empty"/>
        </div>
        <div class="user-input">
            <label class="caption">Телефон</label>
            <input name="phone" type="text" placeholder="Телефон" value="<?=$club->phone;?>" validator="empty"/>
        </div>
        <div class="user-input">
            <label class="caption">Город</label>
            <select name="cityid" id="city-combobox">
                <option value="">Город...</option>
                <? foreach($cities as $city) : ?>
                    <option value="<?=$city->id?>" <?if($club->cityid == $city->id) echo "selected";?> ><?=$city->name;?></option>
                <? endforeach;?>
            </select>
        </div>
        <div class="user-input">
            <label class="caption">Район</label>
            <select name="districtId" id="district-combobox">
                <option value="">Район...</option>
                <? foreach($districts as $distr) : ?>
                    <option value="<?=$distr->id?>" <?if($club->districtId == $distr->id) echo "selected";?>><?=$distr->name;?></option>
                <? endforeach;?>
            </select>
        </div>
        <div class="user-input">
            <label class="caption">Адрес</label>
            <input name="address" type="text" placeholder="Адрес" value="<?=$club->address;?>" validator="empty"/>
        </div>
        <input id="common-save" class="save" type="button" value="Сохранить" />
    </div>
</div>

<div class="info-block">
    <div class="title">Краткое описание</div>
    <div class="box">
        <div class="user-input">
            <div class="club-logo-input">
                <span class="btn btn-success fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span>Add files...</span>
                    <input id="fileupload" type="file" name="files[]" multiple>
                </span>
                <div id="files" class="files"></div>
            </div>
        </div>
        <div class="user-input">
            <textarea name="descript" placeholder="Краткое описание..."><?=$club->description;?></textarea>
        </div>
        <input id="descript-save" class="save" type="button" value="Сохранить" />
    </div>
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