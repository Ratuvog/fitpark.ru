<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>
<script type="text/javascript" src="<?=site_url(array('js/programs/programs.js'));?>"></script>
<div id="content">
    <div id="content-inner">
        <?$this->load->view('blocks/subtitle-block');?>
        <div id="main">
            <div id="main-inner">
                <?$this->load->view('blocks/content-menu');?>
                <?$this->load->view('blocks/breadcrumbs', $breadcrumbs);?>
                <div id="brief-info">
                    <p>Программа тренировок, составленная профессионалом сделает занятия
                        эффективнее, сэкономит время, даст лучший результат, убережет от разочарований,
                        сделает твое тело прекрасным.<br />
                        Программы составляет профессиональный фитнес-тренер Вася, чемпиона мира по
                        фитнесу 2005. Стоимость программы составит всего 750 рублей.</p>
                </div>
                <div id="select-form">
                    <form method="post" action="<?=site_url('training_program/add');?>" enctype="multipart/form-data">
                    <div id="select-form-inner">
                        <div id="select-form-options">
                            <h2 class="inline">Заполните форму для тренера</h2>
                        </div>
                        <div id="select-form-main">
                            <div id="select-form-main-inner">
                                <table class="inline">
                                    <tr>
                                        <td>
                                            <p class="inline first">где тренироваться:</p>
                                            <div class="inline">
                                                <select name="where" id="">
                                                    <? foreach($where as $key=>$value) {?>
                                                        <option value="<?=$key;?>"><?=$value;?></option>
                                                    <? } ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="inline second">пол:</p>
                                            <div class="inline">
                                                <select name="gender" id="">
                                                    <? foreach ($gender as $key=>$val) {?>
                                                        <option value="<?=$key;?>"><?=$val;?></option>
                                                    <? } ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <p class="inline first">цель тренировок:</p>
                                            <div class="inline">
                                                <select name="target" id="">
                                                <? foreach ($target as $key=>$val) { ?>
                                                    <option value="<?=$key;?>"><?=$val;?></option>
                                                <? } ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="inline second">возраст:</p>
                                            <div class="inline">
                                                <select name="years" id="">
                                                <? foreach ($years as $key=>$val){ ?>
                                                    <option value="<?=$key;?>"><?=$val;?></option>
                                                <? } ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <p class="inline first">опыт занятий:</p>
                                            <div class="inline">
                                                <select name="experience" id="">
                                                    <? foreach ($experience as $key=>$val) { ?>
                                                        <option value="<?=$key;?>"><?=$val;?></option>
                                                    <? } ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="inline second">вес:</p>
                                            <div class="inline">
                                                <select name="weight" id="">
                                                    <? foreach ($weight as $key=>$val) { ?>
                                                        <option value="<?= $key; ?>"><?=$val;?></option>
                                                    <? }?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <p class="inline first">периодичность:</p>
                                            <div class="inline">
                                                <select name="periodicity" id="">
                                                    <? foreach ($periodicity as $key=>$val){ ?>
                                                        <option value="<?=$key;?>"><?=$val;?></option>
                                                    <? } ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="inline second">рост:</p>
                                            <div class="inline">
                                                <select name="height" id="">
                                                    <? foreach ($height as $key => $val) { ?>
                                                        <option value="<?=$key;?>"><?=$val;?></option>
                                                    <? } ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <div id="trainer-info" class="inline">
                                    <div id="trainer-avatar">
                                        <img src="<?=$coach->avatar;?>" class="inline"/>
                                        <p class="inline">
                                            <span id="trainer-name"><?=$coach->name;?></span><br />
                                            <span id="profession">тренер</span>
                                        </p>
                                    </div>
                                    <div id="trainer-brief">
                                        <?=$coach->description;?>
                                    </div>
                                </div>
                            </div>

                        </div><!--#select-form-main[END]-->
                        <div id="select-form-add-photo">
                            <div id="add-photo-title">
                                <h3>Добавить фото</h3>
                            </div>
                            <div id="add-photo-blocks">
                                <div class="add-photo inline fileinput-button">
                                    <div class="add-photo-button">
                                        <table>
                                            <tr>
                                                <td align="center" valign="middle">
                                                    <img src="/image/add_photo_icon.png" alt=""/>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p>Фото 1</p>
                                    <input class="fileupload" isReq="false" type="file" name="files[]" multiple>
                                </div>
                                <div class="add-photo inline fileinput-button">
                                    <div class="add-photo-button">
                                        <table>
                                            <tr>
                                                <td align="center" valign="middle">
                                                    <img src="/image/add_photo_icon.png" alt=""/>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p>Фото 2</p>
                                    <input class="fileupload" isReq="false" type="file" name="files[]" multiple>
                                </div>
                                <div class="add-photo inline fileinput-button">
                                    <div class="add-photo-button">
                                        <table>
                                            <tr>
                                                <td align="center" valign="middle">
                                                    <img src="/image/add_photo_icon.png" alt=""/>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p>Фото 3</p>
                                    <input class="fileupload" isReq="false" type="file" name="files[]" multiple>
                                </div>
                                <div class="add-photo inline fileinput-button">
                                    <div class="add-photo-button">
                                        <table>
                                            <tr>
                                                <td align="center" valign="middle">
                                                    <img src="/image/add_photo_icon.png" alt=""/>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p>Фото 4</p>
                                    <input class="fileupload" isReq="false" type="file" name="files[]" multiple>
                                </div>
                            </div>
                        </div><!--#select-form-add-photo-->
                        <div id="select-form-comment">
                            <div id="select-form-comment-inner">
                                <p id="form-title">напишите комментарий, дополнительные пожелания, другие параметры и особенности</p>
                                <div id="form-comment-wrap">


                                    <div id="form-comment" class="inline">
                                        <textarea name="comments" placeholder="Текст комментария" isReq="false"></textarea>
                                    </div>
                                    <div id="form-email-and-order" class="inline">
                                        <input type="text" text="Ваш адрес электронной почты" name="email" placeholder="Ваш адрес электронной почты" validator="email"/><br />
                                        <input type="submit" id="submit" value="Заказать программу"/>
                                    </div>

                                <p>А тут будет текст о том. что происходит после заказа программы тренировок.
                                    Сколько она делается по времени, о том, что можно воспользоваться
                                    консультацией	 по нюансам программы и скорректировать ее исходя из результатов
                                    через месяц занятий.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div><!--#select-form[END]-->
            </div>
        </div><!--#main[END]-->
        <div class="clear"></div>
    </div>
</div><!--#content[END]-->