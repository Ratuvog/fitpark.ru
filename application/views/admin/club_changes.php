<?$this->load->view('admin/head');?>
<table class="table table-striped">
    <tbody>
        <tr>
            <td><h3>Основная информация</h3></td>
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
            <td><h3>Стоимость посещений</h3></td>
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
            <td><h3>Услуги</h3></td>
        </tr>
        
    </tbody>
</table>
