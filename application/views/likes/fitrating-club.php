<div id="fit-like">
    <span>Фитпрак рейтинг</span>
    <img src="<?=site_url('image/logo.png');?>" class="inline" height="33px" width="33px"/>
    <div class="fit-rating"
         data-vote-id="<?=$club->id;?>"
         title="Твоя оценка: <? $userRating = 0;
                                 if($club->userVote){
                                     $userRating = $club->userVote;
                                     echo $userRating;
                                 }?>"
         data-score="<?if($userRating != 0)
                        echo $club->userVote;
                    else
                        echo 0;?>"
         ro="<?if($userRating != 0)
                    echo 'true';
               else
                    echo 'false';?>">
    </div>
    <div colspan="2" class="rating-vote-answer">
    </div>
</div>