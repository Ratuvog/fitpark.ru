<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/FitparkBaseController.php');
class FitparkClubController extends FitparkBaseController {

    /* Current club id */
    protected $m_clubId = 0;
    protected $m_countImagesOnRow  = 5;
    protected $m_countAnalogsOnRow = 4;

    function __construct()
    {
        parent::__construct();
//        $this->init();
    }

    public function club($clubId)
    {
//        if($this->m_clubId == NULL) {
//            $this->toDefaultPage();
//            return ;
//        }
        $this->m_clubId = $clubId;

        /* Перенес инициализацию вьюшек в конкретную страницу*/
        $this->titlePage = 'Фитнес-клуб';
        $this->view      = 'club/club';

        /* Get full info about club */
        $this->getBaseInfo();
        $this->getRates();
        $this->getReviews();
        $this->getImages();
        $this->getAnalogs();

        /* Output in view */
        $this->renderScene();
    }

    /* Гостевое посещение клуба */
    public function getGuest($clubId)
    {
        $this->fitpark_club_model->getGuest($clubId,
                                            $this->input->post("name"),
                                            $this->input->post("e-mail"),
                                            $this->input->post("tel"));
        $this->titlePage = "Ваша заявка принята";
        $this->view      = 'club/success_checkout';
        $this->renderScene();
    }

//    Получение скидки
    public function getDiscount($clubId)
    {
        $this->titlePage = "Ваша заявка принята";
        $this->view      = 'club/success_checkout';
        $this->fitpark_club_model->getDiscount($clubId,
                                               $this->input->post("name"),
                                               $this->input->post("e-mail"),
                                               $this->input->post("tel"));
        $this->renderScene();
    }

    public function init()
    {
        /* init all data variables */
        $this->allowedPages = array('index','club','club/getDiscount','getDiscount');
        $this->privateAllowedPages = array();

        /* Load model */
        $this->load->model('fitpark_club_model');
    }

    protected function getBaseInfo()
    {
        $infoArray = $this->fitpark_club_model->getBaseInfoClub($this->m_clubId);
        $this->viewData['base'] = $infoArray[0];
    }

    protected function getRates()
    {
        $this->viewData['base']['rates'] = $this->fitpark_club_model->getRatesClub($this->m_clubId);
    }

    protected function getReviews()
    {
        $this->viewData['reviews'] = $this->fitpark_club_model->getReviewsClub($this->m_clubId);
    }

    protected function getImages()
    {
        $this->viewData['image']           = $this->fitpark_club_model->getImages($this->m_clubId);
        $this->viewData['countImagesOnRow'] = $this->m_countImagesOnRow;
    }

    protected function getAnalogs()
    {
        $this->viewData['analogs']           = $this->fitpark_club_model->getAnalogs($this->m_clubId);
        $this->viewData['countAnalogsOnRow'] = $this->m_countAnalogsOnRow;
    }
}

?>
