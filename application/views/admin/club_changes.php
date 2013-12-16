<?$this->load->view('admin/head');?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2">
        <a href="<?=site_url('Hfnedjuhfnedju/changes_aproved/'.$club->id)?>" class="btn btn-large btn-success" style="float:left; margin-right: 5px;">Одобрить</a>

        <form method="post" action="<?=site_url('Hfnedjuhfnedju/changes_rejected/'.$club->id)?>">

            <input type="submit" class="btn btn-large btn-danger" value="Отклонить"></a>
            <div style="margin-top: 10px;">Причина отказа:</div>
            <textarea name="comment" rows="10">Изменения не приняты в связи с нарушением информационной политики сайта</textarea>
            
        </form>
    </div>
    <div class="span10">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td colspan="2"><h3>Основная информация</h3></td>
                </tr>
                <tr>
                    <th style="width: 15%;">Логотип</th>
                    <td align="center" valign="middle" >
                        <img style="max-width: 160px;" src="<?=$club->head_picture;?>"/>
                    </td>
                </tr>
                <tr>
                    <th style="width: 15%;">Наименование</th>
                    <td><?=$club->name;?><td>
                </tr>
                <tr>
                    <th style="width: 15%;">Сайт</th>
                    <td><?=$club->site;?><td>
                </tr>
                <tr>
                    <th style="width: 15%;">Телефон</th>
                    <td><?=$club->phone;?><td>
                </tr>
                <tr>
                    <th style="width: 15%;">Режим работы</th>
                    <td><?=$club->work_hours;?><td>
                </tr>
                <tr>
                    <th style="width: 15%;">Город</th>
                    <td><?=$cities[$club->cityid];?><td>
                </tr>
                <tr>
                    <th style="width: 15%;">Район</th>
                    <td><?=$districts[$club->districtId];?><td>
                </tr>
                <tr>
                    <th style="width: 15%;">Адрес</th>
                    <td><?=$club->address;?><td>
                </tr>
                <tr>
                    <th style="width: 15%;">Описание</th>
                    <td><?=$club->description;?><td>
                </tr>

                <tr>
                    <td colspan="2"><h3>Стоимость посещений</h3></td>
                </tr>
                <tr>
                    <th style="width: 15%;">Одноразовое посещение</th>
                    <td><?=$club->singlePrice;?><td>
                </tr>
                <tr>
                    <th style="width: 15%;">1 месяц</th>
                    <td><?=$club->sub1;?><td>
                </tr>
                <tr>
                    <th style="width: 15%;">3 месяца</th>
                    <td><?=$club->sub3;?><td>
                </tr>
                <tr>
                    <th style="width: 15%;">6 месяцев</th>
                    <td><?=$club->sub6;?><td>
                </tr>
                <tr>
                    <th style="width: 15%;">1 год</th>
                    <td><?=$club->sub12;?><td>
                </tr>

                <tr>
                    <td colspan="2"><h3>Услуги</h3></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <ul>
                        <?  foreach ($club_services as $serv):?>
                            <li><?=$services[$serv->serviceId]->name;?></li>
                        <?  endforeach;?>
                        </ul>
                    <td>
                </tr>

                <tr>
                    <td colspan="2"><h3>Фотографии</h3></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <section id="image-club">
                            <? if($images) { ?>
                                <? foreach ($images as $currentImage) {?>
                                    <a href="<?=$currentImage->photo;?>" class="fancybox gallery" rel="gallery1">
                                        <img src="<?=$currentImage->min_photo;?>" alt="" />
                                    </a>
                                <? } ?>
                              <? } else { ?>
                                <h4 class="no-info">Новых фотографий нет</h4>
                            <? } ?>
                        </section>
                    <td>
                </tr>
            </tbody>
        </table>
    </div>
  </div>
</div><!--container-fluid-->