<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Base.php');
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 7/25/13
 * Time: 12:28 AM
 * To change this template use File | Settings | File Templates.
 */

class About  extends Base
{
    public $view = "about";

    function __construct()
    {
        parent::__construct();
        $this->load->model("sales_model");
        $this->load->model("club_model");
        $this->title       = sprintf($this->title       , lang('title'));
        $this->description = sprintf($this->description , lang("common_desc"));
        $this->keywords    = sprintf($this->keywords    , lang("common_keys"));
    }

    /**
     *@MetaInfo\DescriptionReader\Annotation\MetaInfo(value="index")
     */
    function index()
    {
        $this->content->view = $this->view;
        $this->content->data->content_title->title = 'О нас';
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->renderScene();
    }
}

?>
