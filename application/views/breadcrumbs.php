<div id="work-area">
        <header id="breadcrumbs">
            <ul>
                <? $flag = false; foreach ($stack as $item) {
                ?>
                    <? if($flag) { ?>
                    <li>→</li>
                    <? } $flag = true; ?>

                    <li><a href="<?=$item['href'];?>"><?=$item['title'];?></a></li>
                <?
                }
                ?>

            </ul>
            <div style="clear: both;"></div>
        </header>