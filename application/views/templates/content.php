<div id="content">
    <div id="content-inner">
        <? foreach($contents as $content) :
            $this->load->view($content->view, $content->data);
        endforeach; ?>
    </div>
</div><!--#content[END]-->
