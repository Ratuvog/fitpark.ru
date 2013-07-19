<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>

<div id="content">
    <div id="content-inner">
        <?$this->load->view('blocks/subtitle-block');?>
        <div id="main">
            <div id="main-inner">
                <?$this->load->view('blocks/content-menu');?>
                <?$this->load->view('blocks/breadcrumbs', $breadcrumbs);?>

                <div id="page-club">
                    <div id="page-club-inner">
                        <div id="page-club-info-main">
                            <form action="<?=$address;?>"
                                  accept-charset="UTF-8"
                                  method="post"
                                  id="form-comment-wrap">
                            <table>
                                <tr>
                                    <td class="name-field">Стоимость программы: </td>
                                    <td class="value-field">750 рублей</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center" class="payment-submit-wrapper">
                                        <input type="submit" class="payment-submit" value="Оплатить"/>
                                    </td>
                                </tr>
                            </table>
                                <? foreach ($forms as $key => $val) { ?>
                                    <input type="hidden" name="<?=$key;?>" value="<?=$val;?>"/>
                               <? }
                                ?>
                            <div class="clear"></div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
