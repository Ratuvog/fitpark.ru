<div class="dnone">
    <div class="message-dialog" id="change-city-window">
        <header>
            Выберите город
        </header>
        <table class="center_table">
            <tr>
                <td align="center" valign="middle">
                    <ul class="city-list">
                        <? foreach($cities as $city) {?>
                            <li>
                                <div class="active-city">
                                    <a href="<?=prep_url($city->url);?>">
                                        <table>
                                            <tr>
                                                <td>
                                                    <img src="<?=$city->symbol_path;?>" alt="<?=$city->name;?>"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" class="change-city-name">
                                                    <?=$city->name;?>
                                                </td>
                                            </tr>
                                        </table>
                                    </a>
                                </div>
                            </li>
                        <? } ?>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
</div>