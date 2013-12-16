<section id="image-club">

    <? if(!$images) { ?>
        <h2 class="no-info">Фотографий нет</h2>
    <? } ?>    
        
    <table class="images-galery">
        <? $countImages = 0;?>
        <? foreach ($images as $i) {?>
            <? if($countImages%3==0) { ?>
            <tr>
            <? } ?>
                <td align="center" valign="middle">
                    <a href="<?=$i->photo;?>" class="fancybox gallery" rel="gallery1">
                        <img src="<?=$i->min_photo;?>" alt="<?=$i->title;?>" />
                    </a>
                </td>
            <? if(($countImages+1)%3==0) {?>
            </tr>
            <? } ?>
            <? $countImages++; ?>
        <? } ?>
    </table>

</section>