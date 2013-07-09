<div>
    <h2><?php echo $categoryName; ?></h2>
</div>

<section id="list">
    <? foreach ($clubs as $row) { ?>
    <article class="mini-card-club">
        <table>
            <tr>
                <td class="mini-card-club-part image-mini-card" valign="top">
                    <section class="img-club">
                        <table class="image-wrapper">
                            <tr>
                                <td align="center" valign="middle" >
                                    <img style="max-width: 160px" src="<?=  site_url(array('image',"club", $row->head_picture));?>" alt=""/>
                                </td>
                            </tr>
                        </table>
                    </section>
                </td>
                <td class="mini-card-club-part">
                    <section class="decription-club">
                        <header class="name-club">
                            <h3>
                                <a href="<?=site_url(array('Manager','getClub', $row->id, "base"));?>" target="_blank"><?=$row->name;?></a>
                            </h3>
                            <div style="color: #aaa;">
                                <?=$row->address;?>
                            </div>
                        </header>
                    </section>
                </td>
                <td class="mini-card-club-part status-cell">
                    <section class="decription-club">
                        <header class="name-club">
                            <h4>Последнее изменение:</h4>
                                <?=$row->last_update;?>
                        </header>
                    </section>
                </td>
                <td class="mini-card-club-part status-cell">
                    <section class="decription-club">
                        <header class="name-club">
                            <h4>Статус:</h4>
                            <?  switch ($row->state) {
                                case 0:
                                    ?><div>Изменений нет</div><?
                                    break;
                                case 1:
                                    ?><div>На проверке</div><?
                                    break;
                                case 2:
                                    ?><div class="font-succes">Изменения приняты</div><?
                                    break;
                                case 3:
                                    ?><div class="font-error">Изменения отвергнуты</div><?
                                    break;
                            } ?>
                        </header>
                    </section>
                </td>
            </tr>
        </table>
    </article>
    <?}//foreach?>
</section>