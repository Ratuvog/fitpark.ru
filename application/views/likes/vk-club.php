<div id="vk_like"></div>
<script type="text/javascript">
    VK.Widgets.Like("vk_like", {
        type: "button",
        pageTitle: "Фитпарк. Фитнес-клуб <?=$club->name;?>",
        pageImage: "<?=$club->head_picture;?>",
        pageUrl: <?=$club->id;?>,
        width: 200,
        height: 20
    });
</script>