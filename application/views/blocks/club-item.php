<div class="item-result inline">
    <div class="if-share"></div>
    <div class="main-result-block">
        <div class="item-result-name">
            <h2><?=$name;?></h2>
        </div>
        <div class="item-result-image">
            <table>
                <tr align="center">
                    <td align="center"><img src="<?=$head_picture;?>"/></td>
                </tr>
            </table>
        </div>
        <div class="item-result-info">
            <p class="street"><img src="<?=site_url('image/map_pin.png');?>" class="inline"/><span class="inline"><?=$address?></span></p>
            <p class="price"><img src="<?=site_url('image/pig.png');?>" class="inline"/>
                <span class="inline">
                    <?if($sub1 !== "0.00") {
                        echo "от $sub1 руб.";
                      } else {
                        echo "Цена не указана";
                      }
                    ?>
                </span>
            </p>
        </div>
        <div class="item-result-bottom">
            <div class="vote inline">
                <div class="star active inline"></div>
                <div class="star active inline"></div>
                <div class="star inline"></div>
                <div class="star inline"></div>
                <div class="star inline"></div>
            </div>
            <div class="go-to-photos inline">
                <a href="<?=$url;?>"><img src="<?=site_url('image/camera.png');?>" class="inline"/></a>
            </div>
            <div class="go-to-comments inline">
                <a href="<?=$url;?>"><img src="<?=site_url('image/speach.png');?>" class="inline"/></a>
            </div>
        </div>
    </div>
</div><!--.item-result[END]-->