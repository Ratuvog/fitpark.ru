<?$this->load->view('blocks/header-search', $header);?>
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
                                    <a href="<?=site_url(array('training_program'));?>" class="inline">Закажи себе программу тренировок</a>
                                    <p class="inline">профессионалы быстро и грамотно составят 
                                    индивиудальную программу занятий для фитнес-клуба, дома или на улице</p>
                                </li>
                                <li>
                                    <a href="<?=site_url(array('question'));?>" class="inline">Задай вопрос фитнес-инструктуру</a>
                                    <p class="inline">можешь не искать ответ на важный вопрос о тренировках, просто 
                                    спроси у тех, кто знает весь процесс совершенствования тела</p>
                                </li>
                                <li>
                                    <a href="<?=site_url(array('sales'));?>" class="inline">Участвуй в акциях</a>
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

                        <div>
                            <div class="sub-block-2-title">
                                <h2>
                                    Подбор по необходимым параметрам
                                </h2>
                            </div>
                            <div class="sub-block-2-text">
                                <p>Зачем просматривать все клубы? Просто отфильтруй по нужным тебе услугам, которые предоставляет клуб. Благодаря этому ты не потратишь лишнего времени и быстро найдешь именно тот фитнес клуб, который тебе лучше всего подходит.
                            </div>
                        </div>
                        <div>
                            <div class="sub-block-2-title">
                                <h2>
                                    Фотографии фитнес клубов
                                </h2>
                            </div>
                            <div class="sub-block-2-text">
                                <p>Прежде, чем принять решение о звонке или покупке абонемента, каждый из нас хочет увидеть товар лицом.</p>
                                <p>Именно для этого мы собираем фотографии фитнес-центров и тренажерных залов.</p>
                                <p>По ним ты сможешь определить качество залов, оборудования, раздевалок.</p>
                                <p>И после этого вам будет гораздо легче принять решение в пользу того или иного спортивного заведения.</p>
                            </div>
                        </div>
                        <div>
                            <div class="sub-block-2-title">
                                <h2>
                                    Быстрая связь с менеджерами фитнес клуба
                                </h2>
                            </div>
                            <div class="sub-block-2-text">
                                <p>Специально для наших пользователей мы предоставляем возможность быстрой связи с понравившимся фитнес клубом. Ты можешь заказать звонок от менеджера спортивной организации, задать вопрос, записаться на гостевое посещение или оставить заявку на приобретение абонемента в фитнес-центр.</p>
                            </div>
                        </div>
                        <div>
                            <div class="sub-block-2-title">
                                <h2>
                                    Наличие цен на абонементы
                                </h2>
                            </div>
                            <div class="sub-block-2-text">
                                <p>
                                    Тебе хочется узнать стоимость фитнеса? Тогда ты попал в нужное место. На ФитПарке мы собрали актуальные цены на услуги фитнес-клубов.
                                </p>
                                <p>
                                    Теперь нет необходимости звонить и узнавать стоимость, смотри у нас и принимай решение.
                                </p>
                            </div>
                        </div>
                        <div>
                            <div class="sub-block-2-title">
                                <h2>
                                    Поиск фитнес-клубов по карте
                                </h2>
                            </div>
                            <div class="sub-block-2-text">
                                <p>Если для тебя важно территориальное расположение фитнес-клуба, то ты сможешь выбрать подходящий по карте ФитПарка. Удобная навигация и фильтр сделают подбор максимально комфортным.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--#info-blocks[END]-->
    </div>
</div><!--#content[END]-->