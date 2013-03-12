<div id="work-area">
        <header id="breadcrumbs">
            <ul>
                <li><a href="#">Главная</a></li>
                <?  foreach ($stack as $item) {
                ?>
                    <li>→</li>
                    <li><a href="#"><?=$item;?></a></li>
                <?
                }
                ?>

            </ul>
            <div style="clear: both;"></div>
        </header>