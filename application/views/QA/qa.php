<section>
    <header>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium culpa dolore dolores, eaque excepturi fugit iure laboriosam laborum minima, minus perspiciatis porro quod sint sit tenetur? Ab accusamus adipisci amet, atque aut corporis culpa debitis doloremque eos, ex expedita ipsam itaque iure laboriosam laborum libero necessitatibus neque perspiciatis praesentium quas ratione repudiandae, sed suscipit unde voluptatum. Beatae consectetur ea est facilis laboriosam libero maxime neque placeat possimus repellendus, saepe sed ut voluptatibus. Ab animi atque blanditiis consequatur cumque dignissimos doloribus earum, eligendi eos esse facere fugiat ipsam libero magnam minima natus nemo nihil quis sapiente similique tempora voluptate voluptatem?
        </p>
    </header>
    <section class="body-qa">
        <header class="list-header">
            <h1 class="title-section-fitnes">
                <div class="button-get-discount button-club card-action-button action-button" selector="#add-questions">
                    <ul>
                        <li>
                            <div class="icon-small-buy"></div>
                        </li>
                        <li>
                            <span class="button-text">Задать вопрос</span>
                        </li>
                    </ul>
                </div>
            </h1>
            <ul class="type-sort">
                <li class="title-type-sort">Показать ответы: </li>

                <? foreach($themes as $theme) {?>
                    <li class="item-type-sort <?if($theme->id == $activeTheme) echo 'active';?>" >
                        <a class="sorter" href="<?=$theme->url;?>">
                            <?=$theme->name;?>
                        </a>
                    </li>
                <? } ?>
            </ul>
            <div style="clear: both;"></div>
        </header>
        <section class="qa-list">
            <table class="qa-list-table">
                <tr>
                    <td class="qa-questions">
                        <p>
                            <h6>Her: </h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, tempora.
                        </p>
                    </td>
                    <td class="qa-answer">
<!--                        <img class="qa-answer-expert-avatar" src="" alt=""/>-->
                        <p>
                            <h6>HerMer: </h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum doloribus laboriosam reprehenderit saepe velit!
                        </p>
                    </td>
                </tr>

                <tr>
                    <td class="qa-questions">
                        <p>
                        <h6>Her: </h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, tempora.
                        </p>
                    </td>
                    <td class="qa-answer">
<!--                        <img class="qa-answer-expert-avatar" src="" alt=""/>-->
                        <p>
                        <h6>HerMer: </h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum doloribus laboriosam reprehenderit saepe velit!
                        </p>
                    </td>
                </tr>
            </table>
        </section>
    </section>
</section>