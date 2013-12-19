<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>

<script type="text/javascript" src="<?=site_url("js/ckeditor/ckeditor.js");?>"></script>
<script type="text/javascript" src="<?=site_url("assets/fileupload/js/vendor/jquery.ui.widget.js");?>"></script>
<script type="text/javascript" src="<?=site_url("assets/fileupload/js/jquery.iframe-transport.js");?>"></script>
<script type="text/javascript" src="<?=site_url("assets/fileupload/js/jquery.fileupload.js");?>"></script>
<script type="text/javascript" src="<?=site_url("assets/fileupload/js/jquery.fileupload-ui.js");?>"></script>
<script type="text/javascript" src="<?=site_url("assets/fileupload/js/jquery.iframe-transport.js");?>"></script>
<script type="text/javascript" src="<?=site_url("assets/fileupload/js/jquery.fileupload-process.js");?>"></script>
<script type="text/javascript" src="<?=site_url("assets/fileupload/js/jquery.fileupload-image.js");?>"></script>
<script type="text/javascript" src="<?=site_url("assets/fileupload/js/jquery.fileupload-validate.js");?>"></script>
<script type="text/javascript" src="<?=site_url("js/manager/manager-private.js");?>"></script>
<script type="text/javascript" src="<?=site_url("js/manager/formSaver.js");?>"></script>
<script type="text/javascript" src="<?=site_url("js/bootstrap.js");?>"></script>
<script type="text/javascript" src="<?=site_url("js/club.js");?>"></script>
<link rel="stylesheet" type="text/css" href="<?=site_url('css/manager/manager-private.css')?>"/>

<div id="content">
    <div id="content-inner">
        <div id="main">
            <div id="main-inner" class="base-info-manager">
                <?$this->load->view('blocks/content-manager-menu', $this);?>
                <?$this->load->view('blocks/breadcrumbs', $breadcrumbs);?>
                <input name="" type="hidden" id="clubid" value="<?=$club->id;?>"/>
                <div class="left-block">
                    <div class="info-block option">
                        <h3 class="sidebar-option-title">Логотип</h3>
                        <div class="box">
                             <div style="margin-left: 22px;">
                                <div class="club-logo-input">
                                    <? if($club->head_picture) {?>
                                        <div class="img-placeholder"><img src="<?=$club->head_picture;?>" alt=""/></div>
                                    <?} else { ?>
                                        <div class="img-placeholder">Место для логотипа</div>
                                    <? }?>
                                    <span class="btn btn-success fileinput-button">
                                        <span>Загрузить логотип</span>
                                        <input id="fileupload" type="file" name="files[]" multiple>
                                    </span>
                                    <div id="files" class="files"></div>
                                </div>
                            </div>
                            <input id="logo-save" style="margin-left: 22px;" class="button-save" type="button" value="Сохранить" clubId = "<?=$club->id;?>" />
                        </div>
                    </div>
                    <div class="info-block option">
                        <h3 class="sidebar-option-title">Услуги</h3>
                        <div class="save-form box sidebar-items">
                            <ul style='list-style:none;' class="values-option">
                            <?foreach($services as $serv): ?>
                                <li>
                                    <div class="checkbox inline">
                                    <input name="<?='serv'.$serv->id;?>"
                                           id="<?='serv'.$serv->id;?>"
                                           <?if($serv->active > 0) echo ' checked ';?> 
                                           type="checkbox"
                                           class="green-checkbox"/>
                                    </div>
                                    <label for="<?='serv'.$serv->id;?>" class="green-checkbox-label"><?=$serv->name;?></label>
                                </li>
                            <?endforeach; ?>
                            </ul>
                             <input id="service-save" style="margin-left: 10px;" class="button-save" type="button" value="Сохранить" />
                        </div>
                    </div>
                </div>
    
                <div class="right-block">
                    <div class="info-block">
                        <h3 class="sidebar-option-title">Общая информация</h3>
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
                                    <td><label class="caption">Режим работы</label></td>
                                    <td><input name="work_hours" type="text" placeholder="Режим работы" value="<?=$club->work_hours;?>" validator="empty"/></td>
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
                                        <input id="common-save" class="button-save" type="button" value="Сохранить" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="info-block">
                        <h3 class="sidebar-option-title">Описание</h3>
                        <div class="box save-form">
                            <table class="user-input">
                                <tr>
                                    <td> <textarea name="descript" placeholder="Краткое описание..." validator="empty"><?=$club->description;?></textarea> </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><input id="descript-save" class="button-save" type="button" value="Сохранить" /></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="info-block">
                        <h3 class="sidebar-option-title">Стоимость посещений</h3>
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
                                <td colspan="2"><input id="prices-save" class="button-save" type="button" value="Сохранить" /></td>
                            </tr>
                        </table>
                        </div>
                    </div>
                </div><!--#rightblock[END]-->
            </div> 
        </div><!--#main[END]-->
    </div>
</div><!--#content[END]-->
