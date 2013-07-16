<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>
<?$this->load->view('dialogs/qa');?>

<div id="content">
    <div id="content-inner">
        <?$this->load->view('blocks/subtitle-block');?>
        <div id="main">
            <div id="main-inner">
                <?$this->load->view('blocks/content-menu');?>
                <?$this->load->view('blocks/breadcrumbs', $breadcrumbs);?>
                <div id="page-club-list">
                    <div id="brief-info">
                        <p>У многих возникают вопросы о том, как правильно заниматься
                            в фитнес-клубе, на что стоит обратить внимание, какие есть
                            особенности у того или иного упражнения, сколько подходов делать,
                            сколько повторений и другие затруднения, ответы на которые помогли
                            бы тренироваться более эффективно.<br />
                            ФитПарк специально для своих пользователей предоставляет сервис,
                            где можно спросить о наболевшем у профессионального фитнес-инструктора
                            и оперативно получить развернутый ответ. Также у нас можно найти ответы
                            на вопросы других людей, которые столкнулись с определенными затруднениями.<br />
                            Милости просим - спрашивайте, читайте, пользуйтесь.</p>
                    </div>
                    <div class="page-club-menu inline action-button addqa" selector="#add-question" href="/question/addQuestion">
                        <img src="<?=site_url("image/info.png");?>" class="inline"/>
                        <p class="inline">Задать вопрос специалисту</p>
                    </div>
                    <div style="clear: both;"></div>
                    <div id="question-answer">

                        <div id="question-answer-title" class="inline">
                            <div id="question-answer-title-inner">
                                <h3>Показать ответы:</h3>
                                <!--<div class="clear"></div>-->
                                <img src="<?=site_url('image/corner_left.png');?>" style="float: left;"/>
                                <!--<div class="clear"></div>-->
                            </div>
                        </div>

                        <menu class="inline">
                            <div id="question-answer-menu">
                                <p>
                                    <? foreach($themes as $theme) {?>
                                        <?if($theme["id"] == $activeTheme) { ?>
                                            <?=$theme["name"];?>
                                        <? } else { ?>
                                            <a href="<?=$theme["url"];?>">
                                                <?=$theme["name"];?>
                                            </a>
                                        <? } ?>
                                    <? } ?>
                                </p>
                            </div>
                        </menu>
                    </div><!--#question-answer[END]-->
                    <div class="clear"></div>

                    <div id="question-answers-content">
                        <? foreach($questions as $q){ ?>
                        <div class="question-answer">
                            <div class="question inline">
                                <p class="inline">
                                    <span class="avatar-name"><?=$q->user;?>: </span>
                                    <?=$q->question;?>
                                </p>
                            </div>
                            <div class="answer inline">
                                <img class="avatar inline" src="<?=$q->avatar;?>"/>
                                <p class="inline">
                                    <span class="avatar-name"><?=$q->ename;?>: </span>
                                    <?=$q->answer;?>
                                </p>
                            </div>
                        </div>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

