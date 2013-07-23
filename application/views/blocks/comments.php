<div id="review-club" class="full-card-description tabs-content">
    <section class="add-review">
        <div id="add-review-button" class="page-club-menu inline action-button" for="add-review" href="<?=site_url("/dialog/addReview/$club->id");?>">
            <?$this->load->view('dialogs/addReview');?>
            <img src="<?=site_url('image/pencil.png');?>" class="inline"></img>
            <p class="inline" class="button-text">Оставить отзыв</p>
        </div>
    </section>
    
    <? if(!$reviews) { ?>
    <div class="review">
        <h3 class="no-reviews">Нет отзывов. Ваш отзыв будет первым.</h3>
    </div>
    <? } ?>
    
    <? foreach ($reviews as $review){ ?>
    <div class="review">
        <table>
            <tr>
                <td class="description-review">
                    <h4 class="<?=($review->type == 1 ? "pos-review" : "neg-review");?>"><?=$review->sender;?></h4>
                    <span><?=$review->outdate;?></span>
                    <div class="rating club-mini" data-score="<?=round($review->rating, 2);?>"></div>
                    <div id="<?="review$review->fake_id";?>"></div>
                    <script type="text/javascript">
                        VK.Widgets.Like("<?="review".$review->fake_id;?>",
                        { type: "mini",
                          pageTitle: "Фитпарк. Фитнес-клуб <?=$club->name;?>",
                          text: "<?=$review->text?>"},<?=$review->fake_id;?>);
                    </script>
                </td>
                <td class="content-review">
                    <? if($review->text) { ?>
                        <p><?=$review->text;?></p>
                    <? } ?>
                    <? if ($review->positive) { ?>
                        <span>Плюсы</span>
                        <p><?=$review->positive;?></p>
                    <? } ?>
                    <? if ($review->negative) { ?>
                        <span>Минусы</span>
                        <p><?=$review->negative;?></p>
                    <? } ?>
                </td>
            </tr>
            <tr>
                <td align="center">

                </td>
            </tr>
        </table>
    </div>
    <? } ?>
</div>