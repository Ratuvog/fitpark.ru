<div id="footer">
    <footer>
        <div id="footer-inner">
            <div id="bottom-menu">
                <div id="bottom-menu-inner">
                    <menu>
                        <div id="seo-blocks">
                            <div id="seo-blocks-inner">
                                <nav>
                                    <? foreach ($blocks as $block) { ?>
                                    <ul class="inline">
                                        <? foreach ($block as $item) { ?>
                                            <li><h3><a href="<?=site_url($item->url);?>"><?=$item->name;?></a></h3></li>
                                        <? } ?>
                                    </ul>
                                    <? } ?>
                                </nav>
                            </div>
                            <?$this->load->view("seo_tools/counters.php");?>
                        </div>
                    </menu>
                </div>
            </div><!--#bottom-menu[END]-->
            <div id="copy">
                <div id="copy-inner">
                    <div id="bottom-logo" class="inline">
                        <img src="<?=site_url('image/logo.png');?>" class="inline" height="25px" width="33px"/>
                        <h4 class="inline">ФитПарк</h4>
                    </div>
                    <div id="copyright" class="inline bordered">
                        <p>Все права принадлежат<br /> компании "Фитпарк" &reg;</p>
                    </div>
                    <div id="imstudio" class="inline bordered">
                        <p>Дизайн и верстка сайта от </p>
                        <p><a href="http://imwebstudio.ru" rel="nofollow">imwebstudio.ru</a>  |  <a href="">imseo.ru</a>  |  <time>2013</time></p>
                    </div>
                    <div id="share-socials" class="inline bordered">
                        <div id="share-socials-inner">
                            <span class="inline">Поделиться сайтом:</span>
                            <div id="social-buttons" class="inline">
                                <div id="google" class="inline"></div>
                                <div id="fb" class="inline"></div>
                                <div id="vk" class="inline"></div>
                                <div id="tw" class="inline"></div>
                                <div class="share42init"></div>
                                <script type="text/javascript" src="<?=site_url('js/share42/share42.js');?>"></script>
                            </div>
                        </div>
                    </div>
                    <div id="oferta" class="inline bordered">
                        <p>
                            Информация на сайте не <br>является публичной офертой
                        </p>
                    </div>
                </div>
            </div><!--#copy[END]-->
        </div>
    </footer>
</div><!--#footer[END]-->
<script type="text/javascript" src="<?=site_url(array('js','footer.js'))?>"></script>
<?=$currentCity->footer_scripts;?>
<?$this->load->view('seo_tools/googleAnalitics');?>
<?$this->load->view('seo_tools/yandexMetrika');?>
<?$this->load->view('blocks/reformal-block');?>
