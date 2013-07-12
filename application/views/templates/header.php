<?$this->load->view('seo_tools/facebook');?>
<?$this->load->view('seo_tools/vkontakte');?>
<?$this->load->view('seo_tools/googleTagManager');?>
<?=$currentCity->header_scripts;?>

<div id="header">
    <header>
        <div id="header-inner">
            <?$this->load->view('blocks/menu-block', $menu_block);?>
            <div id="top-blocks-wrap">
                <?$this->load->view('blocks/nav-block');?>
                <?$this->load->view('blocks/search-block');?>
            </div>
        </div>
    </header>
</div><!--#header[END]-->