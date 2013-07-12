<? foreach($contents as $content) :
    $this->load->view($content->view, $content->data);
endforeach; ?>

