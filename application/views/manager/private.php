<div>
    <h2 class="MainHeader"><?php echo $categoryName;?></h2><div class="font-hint">последние изменения <span id="last-update"><?=$club->last_update;?></span></div>
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

<div style='clear:both;'></div>

<div class="left-block">
    <div class="info-block">
        <div class="title">Логотип</div>
        <div class="box">
             <div class="">
                <div class="club-logo-input">
                    <div class="img-placeholder">Место для логотипа</div>
                    <span class="btn btn-success fileinput-button">
                        <span>Add files...</span>
                        <input id="fileupload" type="file" name="files[]" multiple>
                    </span>
                    <div id="files" class="files"></div>
                </div>
            </div>
            <input id="logo-save" class="save" type="button" value="Сохранить" />
        </div>
    </div>
    <div class="info-block">
        <div class="title">Услуги</div>
        <div class="save-form box">
            <ul style='list-style:none;' class="values-option">
            <?foreach($services as $serv): ?>
                <li>
                    <input name="<?='serv'.$serv->id;?>"
                           id="<?='serv'.$serv->id;?>"
                           <?if($serv->active > 0) echo ' checked ';?> 
                           type="checkbox"
                           class="green-checkbox"/>
                    <label for="<?='serv'.$serv->id;?>" class="green-checkbox-label"><?=$serv->name;?></label>
                </li>
            <?endforeach; ?>
            </ul>
             <input id="service-save" class="save" type="button" value="Сохранить" />
        </div>
    </div>
</div>
    
<div class="right-block">
<div class="info-block">
    <div class="title">Общая информация</div>
    <div class="save-form box">
        <table class="user-input">
            <tr>
                <td><label class="caption">Наименование</label></td>
                <td><input name="name" type="text" placeholder="Наименование" value="<?=$club->name;?>" validator="blank"/></td>
            </tr>
            <tr>
                <td><label class="caption">Сайт</label></td>
                <td><input name="site" type="text" placeholder="Сайт" value="<?=$club->site;?> " validator="empty"/></td>
            </tr>
            <tr>
                <td><label class="caption">Телефон</label></td>
                <td><input name="phone" type="text" placeholder="Телефон" value="<?=$club->phone;?>" validator="empty"/></td>
            </tr>
            <tr>
                <td><label class="caption">Город</label></td>
                <td>
                    <select name="cityid" id="city-combobox">
                    <option value="">Город...</option>
                    <? foreach($cities as $city) : ?>
                        <option value="<?=$city->id?>" <?if($club->cityid == $city->id) echo "selected";?> ><?=$city->name;?></option>
                    <? endforeach;?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label class="caption">Район</label></td>
                <td><select name="districtId" id="district-combobox">
                    <option value="">Район...</option>
                    <? foreach($districts as $distr) : ?>
                        <option value="<?=$distr->id?>" <?if($club->districtId == $distr->id) echo "selected";?>><?=$distr->name;?></option>
                    <? endforeach;?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label class="caption">Адрес</label></td>
                <td><input name="address" type="text" placeholder="Адрес" value="<?=$club->address;?>" validator="empty"/></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input id="common-save" class="save" type="button" value="Сохранить" />
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="info-block">
    <div class="title">Краткое описание</div>
    <div class="box save-form">
        <table class="user-input">
            <tr>
                <td> <textarea name="descript" placeholder="Краткое описание..." validator="empty"><?=$club->description;?></textarea> </td>
            </tr>
            <tr>
                <td colspan="2"><input id="descript-save" class="save" type="button" value="Сохранить" /></td>
            </tr>
        </table>
    </div>
</div>

<div class="info-block">
    <div class="title">Стоимость посещений</div>
    <div class="box save-form">
    <table class="user-input">
        <tr>
            <td> <label class="caption">Разовое посещение</label> </td>
            <td> <input name="singlePrice" type="text" placeholder="Разовое посещение" value="<?=$club->singlePrice;?>" validator="number"/> </td>
        </tr>
        <tr>
            <td> <label class="caption">1 месяц</label> </td>
            <td> <input name="sub1" type="text" placeholder="1 месяц" value="<?=$club->sub1;?>" validator="number"/> </td>
        </tr>
        <tr>
            <td> <label class="caption">3 месяца</label> </td>
            <td> <input name="sub3" type="text" placeholder="3 месяца" value="<?=$club->sub3;?>" validator="number"/> </td> 
        </tr>
        <tr>
            <td> <label class="caption">6 месяцев</label> </td>
            <td> <input name="sub6" type="text" placeholder="6 месяцев" value="<?=$club->sub6;?>" validator="number"/> </td> 
        </tr>
        <tr>
            <td> <label class="caption">1 год</label> </td>
            <td> <input name="sub12" type="text" placeholder="1 год" value="<?=$club->sub12;?>" validator="number"/> </td>
        </tr>
        <tr>
            <td colspan="2"><input id="prices-save" class="save" type="button" value="Сохранить" /></td>
        </tr>
    </table>
    </div>
</div>
   
</div>
