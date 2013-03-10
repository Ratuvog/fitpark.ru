<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/FitparkBaseController.php');
class FitparkClubController extends FitparkBaseController {

    /* Current club id */
    protected $m_clubId = 0;
    protected $m_countImagesOnRow  = 5;
    protected $m_countAnalogsOnRow = 4;

    function __construct() {
        parent::__construct();
        $this->init();
    }

    public function club($clubId) {
//        if($this->m_clubId == NULL) {
//            $this->toDefaultPage();
//            return ;
//        }
        $this->m_clubId = $clubId;

        /* Get full info about club */
        $this->getBaseInfo();
        $this->getRates();
        $this->getReviews();
        $this->getImages();
        $this->getAnalogs();

        /* Output in view */
        $this->renderScene();
    }


    public function init() {
        /* init all data variables */
        $this->allowedPages = array('index','club');
        $this->privateAllowedPages = array();
        $this->titlePage = 'Фитнес-клуб';
        $this->view = 'club/club';

        /* Load model */
        $this->load->model('fitpark_model');
    }

    protected function getBaseInfo() {
        $infoArray = $this->fitpark_model->getBaseInfoClub($this->m_clubId);
        $this->viewData['base'] = $infoArray[0];
    }

    protected function getRates() {
        $this->viewData['base']['rates'] = $this->fitpark_model->getRatesClub($this->m_clubId);
    }

    protected function getReviews() {
        $this->viewData['reviews'] = $this->fitpark_model->getReviewsClub($this->m_clubId);
    }

    protected function getImages() {
        $this->viewData['image']           = $this->fitpark_model->getImages($this->m_clubId);
        $this->viewData['countImagesOnRow'] = $this->m_countImagesOnRow;
    }

    protected function getAnalogs() {
        $this->viewData['analogs']           = $this->fitpark_model->getAnalogs($this->m_clubId);
        $this->viewData['countAnalogsOnRow'] = $this->m_countAnalogsOnRow;
    }
}

?>
