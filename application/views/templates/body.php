<body>
    <div id="wrap">
        <?
            if($header)
                $this->load->view('header', $header);
            
            if($content_title)
                $this->load->view('content-title', $content_title);

            if($content)
                $this->load->view('content', $content);
            
            if($footer)
                $this->load->view('footer', $footer);
        ?>
    </div>
</body>