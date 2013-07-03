<div>
    <h2 class="MainHeader"><?php echo $categoryName;?></h2><div class="font-hint">последние изменения <span id="last-update"><?=$club->last_update;?></span></div>
    <input id="clubid" value="<?=$club->id;?>" type="hidden" />
</div>

<div class="navbar">
    <div class="navbar-inner">
        <ul class="nav">
            <li><a href='<?=site_url(array("Manager","club",$club->id));?>'>Общая информация</a></li>
            <li><a href='<?=site_url(array("Manager","club",$club->id,"photo"));?>'>Фотографии</a></li>
        </ul>
    </div>
</div>

<div style='clear:both;'></div>