<body>
    <?$this->load->view('seo_tools/facebook');?>
    <?$this->load->view('seo_tools/vkontakte');?>
    <?$this->load->view('seo_tools/googleTagManager');?>
    <?=$currentCity->header_scripts;?>
    <div id="wrap">
        <?          
            if($content) {
                $this->load->view($content->view, $content->data);
            }
            
            if($footer) {
                $this->load->view('templates/footer', $footer);
            }
        ?>
    </div>
</body>