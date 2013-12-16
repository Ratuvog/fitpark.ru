<?  foreach ($services as $s): ?>
    <img src="<?=$service_map[$s->serviceId]->icon;?>" class="inline" title="<?=$service_map[$s->serviceId]->name;?>"/>
<? endforeach; ?>