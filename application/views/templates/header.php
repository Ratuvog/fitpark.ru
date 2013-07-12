<div id="header">
    <header>
        <div id="header-inner">
            <?$this->load->view('menu-block', $menu_block);?>
            <div id="top-blocks-wrap">
                <? if($search_block)
                    $this->load->view('search-block', $search_block);
                ?>
            </div>
        </div>
    </header>
</div><!--#header[END]-->