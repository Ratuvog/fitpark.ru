<?$this->load->view('admin/head');?>
<table class="table table-striped">
    <tbody>
        <tr>
            <th></th>
            <th>Номер</th>
            <th>Город</th>
            <th>Клуб</th>
            <th>Дата изменения</th>
            <th>Менеджер</th>
            <th>Текущий статус</th>
        </tr>
        <? foreach ($changes as $club) {?>
        <tr class="<?if($club->state) echo $states[$club->state]["class"];?> order-list-row">
            <td><a href="<?=site_url("Hfnedjuhfnedju/club_changes/$club->id");?>">Просмотр</a></td>
            <td><?=$club->id;?></td>
            <td><? if($club->cityid) echo $cities[$club->cityid];?></td>
            <td><?=$club->name;?></td>
            <td><?=$club->last_update;?></td>
            <td><? if($club->managerId) echo $manager[$club->managerId];?></td>
            <td><? if($club->state) echo $states[$club->state]["desc"];?></td>
        </tr>
        <? } ?>       
    </tbody>
</table>