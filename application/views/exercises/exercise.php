<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>

<div id="content">
    <div id="content-inner">
        <?$this->load->view('blocks/subtitle-block');?>
        <div id="main">
            <div id="main-inner">
                <?$this->load->view('blocks/breadcrumbs', $breadcrumbs);?>
                <div id="exercise-content" class="content-page">
                    <div id="exercise-content-inner">
                        <div class="left-content"><table>
                            <tr>
                                <td colspan="2">
                                    <h2>Описание</h2>
                                    <div class="ckeditor-text">
                                        <?=$exercise->description;?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h2>Техника выполнения</h2>
                                    <div class="ckeditor-text">
                                        <?=$exercise->technique;?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h2>Нюансы упражнения</h2>
                                    <div class="ckeditor-text">
                                        <?=$exercise->nuances;?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <ul class="social-likes">
                                        <li class="facebook" title="Поделиться ссылкой на Фейсбуке">Facebook</li>
                                        <li class="twitter" title="Поделиться ссылкой в Твиттере">Twitter</li>
                                        <li class="mailru" title="Поделиться ссылкой в Моём мире">Мой мир</li>
                                        <li class="vkontakte" title="Поделиться ссылкой во Вконтакте">Вконтакте</li>
                                        <li class="odnoklassniki" title="Поделиться ссылкой в Одноклассниках">Одноклассники</li>
                                        <li class="plusone" title="Поделиться ссылкой в Гугл-плюсе">Google+</li>
                                    </ul>
                                </td>
                            </tr>
                        </table></div>
                        <div class="right-content">
                            <? if($exercise->video) { ?>
                            <iframe width="300" height="180" src="<?=$exercise->video;?>" frameborder="0" allowfullscreen></iframe>
                            <? } ?>
                            <? if(count($exercise->photos)): ?>
                                <table class="exercise-photo">
                                    <? foreach ($exercise->photos as $currentPhoto): ?>
                                        <tr>
                                            <td>
                                                <a href="<?=$currentPhoto->url;?>" rel="group1" class="exercise-gallery">
                                                    <img src="<?=$currentPhoto->url;?>" alt=""/>
                                                </a>
                                            </td>
                                        </tr>
                                    <? endforeach;?>
                                </table>
                            <? endif;?>
                        </div>
                        <div style="clear: both" class="splitter exercise-footer-splitter"></div>
                        <div id="similar-exercise">
                            <? if (count($exercise->simular_exercises)):?>
                            <h2>
                                Похожие упражнения
                            </h2>
                            <div id="exercise-items">
                                <div id="exercise-items-inner">
                                    <? foreach ($exercise->simular_exercises as $currentExercise) { ?>
                                        <div class="exercise-item exercise-inline">
                                            <table>
                                                <tr>
                                                    <td valign="middle" align="center">
                                                        <img src="<?=$currentExercise->image;?>"/>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div></div>
                                            <p>
                                                <h3>
                                                    <a href="<?=$currentExercise->url;?>"><?=$currentExercise->name;?></a>
                                                </h3>
                                            </p>
                                        </div>
                                    <? } ?>
                                </div>
                            </div>
                            <? endif;?>
                        </div>
                    </div>
                </div><!--#exercise-content[END]-->
            </div>
        </div>
    </div>
</div>
</div><!--#main[END]-->