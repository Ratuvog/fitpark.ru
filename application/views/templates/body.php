<body>
    <div id="wrap">
        <?
            if($header) {
                $this->load->view('templates/header', $header);
            }
            
            if($content_title) {
                $this->load->view('blocks/title-block', $content_title);
            }

            if($content) {
                $this->load->view('templates/content', $content);
            }
            
            if($footer) {
                $this->load->view('templates/footer', $footer);
            }
        ?>
    </div>
</body>