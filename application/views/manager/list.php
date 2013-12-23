<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>

<link rel="stylesheet" type="text/css" href="<?=site_url('css/manager/manager-private.css')?>"/>
<div id="content">
    <div id="content-inner">
        <div id="main">
            <div id="main-inner">
                <?$this->load->view('manager/breadcrumbs', $breadcrumbs);?>
                <div id="page-club">
                    <div id="page-club-inner">
                        <div id="page-club-info-main">
                            <section id="list">
                                <? foreach ($clubs as $c) { ?>
                                <a href="<?=site_url(array('manager','club', $c->id));?>" class="mini-card-club">
                                    <table class="club-list-item">
                                        <tr>
                                            <td class="mini-card-club-part image-mini-card" valign="top">
                                                <section class="img-club">
                                                    <table class="image-wrapper">
                                                        <tr>
                                                            <td align="center" valign="middle" >
                                                                <img style="max-width: 160px" src="<?=site_url(array('image', "club", $c->head_picture));?>" alt=""/>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </section>
                                            </td>
                                            <td class="mini-card-club-part">
                                                <section class="decription-club">
                                                    <header class="name-club">
                                                        <h3>
                                                            <a href="<?=site_url(array('manager', 'club', $c->id));?>" target="_blank"><?=$c->name;?></a>
                                                        </h3>
                                                        <div style="color: #aaa;">
                                                            <?=$c->address;?>
                                                        </div>
                                                    </header>
                                                </section>
                                            </td>
                                            <td class="mini-card-club-part status-cell">
                                                <section class="decription-club">
                                                    <header class="name-club">
                                                        <h4>Последнее изменение:</h4>
                                                            <?=$c->last_update;?>
                                                    </header>
                                                </section>
                                            </td>
                                            <td class="mini-card-club-part status-cell">
                                                <section class="decription-club">
                                                    <header class="name-club">
                                                        <h4>Статус:</h4>
                                                        <?  switch ($c->state) {
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
                                                                ?><div class="font-error">Изменения отклонены</div>
                                                                  Комментарий: <? echo $c->comment;
                                                                break;
                                                        } ?>
                                                    </header>
                                                </section>
                                            </td>
                                        </tr>
                                    </table>
                                </a>
                                <?}//foreach?>
                            </section>
                        </div><!--#page-club-info-main[END]-->
                    </div>
                </div>
            </div> 
        </div><!--#main[END]-->
    </div>
</div><!--#content[END]-->




