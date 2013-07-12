<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/test_Base.php');

class Main extends Base {
           
    function __construct()
    {
        parent::__construct();
        $this->title = sprintf("ФитПарк. %s Тренажерные залы, фитнес центры,
                                отзывы, стоимость, рейтинги, акции, скидки.",
                                lang('title'));

        $this->description = sprintf("%s. Отзывы, рейтинг, фотографии, цены, описание.",
                                    lang("common_desc"));
        
        $this->keywords = sprintf("%s. Бассейн, тренажерный зал, аэробика,
                                   танцы, йога, пилатес, тренажеры.",
                                   lang("common_keys"));
        
        $this->header->menu_block->currentCity = $this->city->byName($this->cityByIP());
        $this->body->content_title->title = "Случайные клубы";
        
        $this->body->content->contents = array();
    }
    
    

    /*
$output = {
    head = {
        title,
        description,
        keywords,
        favicon
    },
    body = {
        header = {
            menu-block = { currentCity },
            search-block
        },
        content_title = { title },
        content = { 
            var contents = array(
                {view1, data1},
                {view2, data2},
                {view3, data3}
            )
        },
        footer
    }
};
 */
}
?>
