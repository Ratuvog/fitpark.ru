<?$this->load->view('admin/head');?>
<table class="table table-striped">
    <tbody>
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
    </tbody>
</table>
