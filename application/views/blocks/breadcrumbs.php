<div id="breadcrumbs">
    <div id="breadcrumbs-inner">
        <h4>
        <? $flag = false; foreach ($stack as $item) {
            ?>
            <? if($flag) { ?>
                <li>→</li>
            <? } $flag = true; ?>
            <span><a href="<?=$item['href'];?>"><?=$item['title'];?></a></span>
        <?
        }
        ?>
    </div>
</div>