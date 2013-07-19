<?$this->load->view('blocks/header', $header);?>
<?$this->load->view('blocks/title-block', $content_title);?>

<div id="content">
    <div id="content-inner">
        <?$this->load->view('blocks/subtitle-block');?>
        <div id="main">
            <div id="main-inner">
                <?$this->load->view('blocks/content-menu');?>
                <?$this->load->view('blocks/breadcrumbs', $breadcrumbs);?>

                <div id="page-club">
                    <div id="page-club-inner">
                        <div id="page-club-info-main">
                            <table class="success-message">
                                <tr>
                                    <td>
                                        <p>
                                            <?=fail_message?>
                                        </p>
                                    </td>
                                    <td>
                                        <img src="/image/smile1.jpg" alt="" width="280px" />
                                    </td>
                                </tr>
                            </table>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div><!--#main[END]-->

<script type="text/javascript">
    $(function(){
        setTimeout(function(){
            location.href = "<?=$redirect_url;?>";
        }, 10000);l
    })
</script>