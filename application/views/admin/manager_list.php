<?$this->load->view('admin/head');?>
<h3>Заявки</h3>
<table class="table table-striped">
    <tbody>
        <tr>
            <th>Номер</th>
            <th>Имя</th>
            <th>E-mail</th>
            <th>Телефон</th>
            <th>Комментарий</th>
            <th></th>
            <th></th>
        </tr>
        <? foreach ($managers_request as $manager) {?>
        <tr class="info order-list-row">
            <td><?=$manager->id;?></td>
            <td><?=$manager->name;?></td>
            <td><?=$manager->email;?></td>
            <td><?=$manager->phone;?></td>
            <td><?=$manager->comment;?></td>
            <td><a style="color: green;" href="<?=site_url("Hfnedjuhfnedju/managers/accept/$manager->id");?>">Одобрить</a></td>
            <td><a style="color: darkred;" href="<?=site_url("Hfnedjuhfnedju/managers/reject/$manager->id");?>">Отклонить</a></td>
        </tr>
        <? } ?>       
    </tbody>
</table>

<h3>Одобренные</h3>
<table class="table table-striped">
    <tbody>
    <tr>
        <th>Номер</th>
        <th>Имя</th>
        <th>E-mail</th>
        <th>Телефон</th>
        <th>Комментарий</th>
        <th></th>
    </tr>
    <? foreach ($managers as $manager) {?>
        <tr class="success order-list-row">
            <td><?=$manager->id;?></td>
            <td><?=$manager->name;?></td>
            <td><?=$manager->email;?></td>
            <td><?=$manager->phone;?></td>
            <td><?=$manager->comment;?></td>
            <td><a style="color: darkred;" href="<?=site_url("Hfnedjuhfnedju/managers/reject/$manager->id");?>">Отклонить</a></td>
        </tr>
    <? } ?>
    </tbody>
</table>

<h3>Отклоненные заявки</h3>
<table class="table table-striped">
    <tbody>
    <tr>
        <th>Номер</th>
        <th>Имя</th>
        <th>E-mail</th>
        <th>Телефон</th>
        <th>Комментарий</th>
        <th></th>
    </tr>
    <? foreach ($managers_rejected as $manager) {?>
        <tr class="error order-list-row">
            <td><?=$manager->id;?></td>
            <td><?=$manager->name;?></td>
            <td><?=$manager->email;?></td>
            <td><?=$manager->phone;?></td>
            <td><?=$manager->comment;?></td>
            <td><a style="color: green;" href="<?=site_url("Hfnedjuhfnedju/managers/accept/$manager->id");?>">Одобрить</a></td>
        </tr>
    <? } ?>
    </tbody>
</table>
