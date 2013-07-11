<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
    <title><?=$titleText;?></title>
    <meta name="description" content="<?=$desc;?>">
    <meta name="keywords" content="<?=$keywords;?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name='yandex-verification' content='781c2dd8ae286aca' />
    <meta name="google-site-verification" content="LPcTvq9lj7flD6_bLTq3HL-vJF9SFxRaLNq0eWIYGLs" />

    <link rel="icon" href="<?=$favicon;?>" type="image/vnd.microsoft.icon"/>
    <link rel="shortcut icon" href="<?=$favicon;?>" type="image/x-icon"/>
    <link rel="stylesheet" type="text/css" href="<?=site_url('css/common/style.css');?>" media="all"/>

<? foreach($css_files as $css){ ?>
    <link rel='stylesheet' href='<?=$css;?>' />
<?}?>

    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
    <script src="//vk.com/js/api/openapi.js?96"></script>

    <script type="text/javascript" src="/js/noty/jquery.noty.js"></script>
    <script type="text/javascript" src="/js/noty/layouts/topRight.js"></script>
    <script type="text/javascript" src="/js/noty/themes/default.js"></script>

    <script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js"></script>

<? foreach($js_files as $js){ ?>
    <script type='text/javascript' src='<?=$js;?>'></script>
<?}?>     
</head>
<body>
    <?$this->load->view('seo_tools/facebook');?>
    <?$this->load->view('seo_tools/vkontakte');?>
    <?$this->load->view('seo_tools/googleTagManager');?>
    <?=$currentCity->header_scripts;?>