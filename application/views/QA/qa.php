<!--Окно задания вопроса-->
<div class="dnone">
    <div id="add-question" class="message-dialog">
        <form action="" method="post">
            <table width="100%" class="window">
                <tr>
                    <td colspan="2" class="hide-text">
                        Все поля обязательны для заполнения
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="error-text">

                    </td>
                </tr>
                <tr>
                    <td class="window-name-options">Имя</td>
                    <td><input type="text" class="checkout-input search" text="Имя" validator="blank" name="user"/></td>
                </tr>
                <tr>
                    <td class="window-name-options">E-mail</td>
                    <td><input type="text" class="checkout-input search" text="E-mail" validator="email" name="e-mail"/></td>
                </tr>
                <tr>
                    <td class="window-name-options">Текст вопроса</td>
                    <td>
                        <textarea class="checkout-input search" style="height: 60px;" name="question" cols="30" rows="10" validator="blank" text="Вопрос"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <div class="button-send button">Отправить</div>
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<section xmlns="http://www.w3.org/1999/html">
    <header>
        <p>
            У многих возникают вопросы о том, как правильно заниматься в фитнес-клубе, на что стоит обратить внимание, какие есть особенности у того или иного упражнения, сколько подходов делать, сколько повторений и другие затруднения, ответы на которые помогли бы тренироваться более эффективно.
            ФитПарк специально для своих пользователей предоставляет сервис, где можно спросить о наболевшем у профессионального фитнес-инструктора и оперативно получить развернутый ответ. Также у нас можно найти ответы на вопросы других людей, которые столкнулись с определенными затруднениями.
            Милости просим - спрашивайте, читайте, пользуйтесь.
        </p>
    </header>
    <div class="body-qa">
        <header class="list-header">
            <div class="button-get-discount button-club button-get-question action-button" selector="#add-question" href="/question/addQuestion">
                <ul>
                    <li>
                        <div class="icon-small-buy"></div>
                    </li>
                    <li>
                        <span class="button-text">Задать вопрос</span>
                    </li>
                </ul>
            </div>
            <ul class="type-sort">
                <li class="title-type-sort">Показать ответы: </li>

                <? foreach($themes as $theme) {?>
                    <li class="item-type-sort <?if($theme["id"] == $activeTheme) echo 'active';?>" >
                        <a class="sorter" href="<?=$theme["url"];?>">
                            <?=$theme["name"];?>
                        </a>
                    </li>
                <? } ?>
            </ul>
            <div style="clear: both;"></div>
        </header>
        <div class="qa-list">
            <table class="qa-list-table">
                <? foreach($questions as $q){ ?>
                <tr>
                    <td class="qa-questions" valign="top">
                        <p>
                            <span class="user-qa"><?=$q->user;?>: </span> <?=$q->question;?>
                        </p>
                    </td>
                    <td class="qa-answer" valign="top">
                        <img class="qa-answer-expert-avatar" src="<?=$q->avatar;?>" alt=""/>
                        <p>
                            <span class="user-qa"><?=$q->ename;?>: </span> <?=$q->answer;?>
                        </p>
                    </td>
                </tr>
                <? } ?>
            </table>
        </div>
    </div>
</section>