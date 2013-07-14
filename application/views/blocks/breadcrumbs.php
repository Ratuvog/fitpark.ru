<div id="breadcrumbs">
    <div id="breadcrumbs-inner">
        <h4>
        <? $counter = 0;
           $last = count($stack);
           foreach($stack as $step): $counter++; ?>
                <a href="<?=$step->url;?>">
                    <span><?=$step->name;?></span>
                </a>
                <?if($counter != $last) echo "&rarr;";?>
        <? endforeach; ?>
        </h4>
    </div>
</div>