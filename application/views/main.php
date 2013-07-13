<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>

<script type="text/javascript" src="<?=site_url("js/main.js");?>"></script>
<div id="content">
    <div id="content-inner">
        <div id="main">
            <div id="main-inner">
                <div id="search-results">
                    <? foreach ($clubs as $club) {
                        $this->load->view('blocks/club-item', $club);
                    }?>
                </div><!--#search-results[END]-->

                <div id="search-results-button">
                    <div id="load-more">
                        <a href="<?=site_url('clubs');?>"><span>Еще результаты</span></a>
                    </div>
                </div>
            </div> 
        </div><!--#main[END]-->

        <div id="info-blocks">
            <div id="info-blocks-inner">
                <div id="info-block-1">
                    <div id="info-block-1-inner">
                        <div class="info-block-title">
                            <img src="<?=site_url("image/search_logo.png");?>" class="inline"/>
                            <h1 class="inline">Другие полезные разделы</h1>
                        </div>
                        <div class="info-block-text">
                            <ul>
                                <li>
                                    <a href="" class="inline">Закажи себе программу тренировок</a>
                                    <p class="inline">профессионалы быстро и грамотно составят 
                                    индивиудальную программу занятий для фитнес-клуба, дома или на улице</p>
                                </li>
                                <li>
                                    <a href="" class="inline">Задай вопрос фитнес-инструктуру</a>
                                    <p class="inline">можешь не искать ответ на важный вопрос о тренировках, просто 
                                    спроси у тех, кто знает весь процесс совершенствования тела</p>
                                </li>
                                <li>
                                    <a href="" class="inline">Участвуй в акциях</a>
                                    <p class="inline">активность на ФитПарке может стать залогом приятных призов 
                                    и бонусов</p>
                                </li>
                            </ul>
                        </div>
                        <div id="page-shadow"></div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div id="info-block-2">
                    <div id="info-block-2-inner">
                        <div class="info-block-title">
                            <img src="<?=site_url('image/search_logo.png');?>" class="inline"/>
                            <h1 class="inline">Почему надо искать фитнес-клубы на ФитПарке</h1>
                        </div>
                        <div id="sub-block-2-1">
                            <div class="sub-block-2-title">
                                <h2>- Легкий поиск и выбор</h2>
                            </div>
                            <div class="sub-block-2-text">
                                <p>С каждым годом все актуальнее становится держать себя в хорошей форме. 
                                И легче всего это сделать с помощью фитнес центров или тренажерных залов.<br />
                                Но предложений огромное количество и выбрать наиболее подходящий клуб не 
                                так просто. Ведь необходимо посетить значительное количество сайтов, 
                                позвонить для уточнения цены на фитнес, сравнить предложения сетей и 
                                местных организаций, изучить акции и скидки.<br />
                                С ФитПарком это легко. У нас есть информация по всем фитнес организациям города.<br />
                                Сравнивайте, выбирайте и вперед, навстречу прекрасной фигуре.</p>
                            </div>
                        </div>
                        <div id="sub-block-2-2">
                            <div class="sub-block-2-title">
                                <h2>- Оценка фитнес-клубов</h2>
                            </div>
                            <div class="sub-block-2-text">
                                <p>На ФитПарке для каждого клуба можно поставить оценку и оставить отзыв.<br />
                                Ведь именно мы, клиенты, должны влиять на качество оказываемых услуг.<br />
                                Ко всем прочему, комментарии и оценки помогут другим людям определиться 
                                с выбором фитнес центра или тренажерного зала.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--#info-blocks[END]-->
    </div>
</div><!--#content[END]-->