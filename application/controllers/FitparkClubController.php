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
        if($this->m_clubId == NULL) {
            $this->toDefaultPage();
            return ;
        }
        $this->m_clubId = $clubId;

        /* Get full info about club */
        $this->getBaseInfo();
        $this->getRates();
        $this->getReviews();
        $this->getImages();
        $this->getAnalogs();

        /* Output in view */
        renderScene();
    }

    protected function init() {
        /* init all data variables */
        $this->allowedPages = array('club');
        $this->privateAllowedPages = array();
        $this->titlePage = 'Фитнес-клуб';
        $this->view = 'clubs/clubs';

        /* Load model */
        $this->load->model('fitpark_model');
    }

    protected function getBaseInfo() {
        $this->viewData['base'] = $this->fitpark_model->getBaseInfoClub($this->m_clubId);
    }

    protected function getRates() {
        $this->viewData['base']['rates'] = $this->fitpark_model->getRatesClub($this->m_clubId);
    }

    protected function getReviews() {
        $this->viewData['reviews'] = $this->fitpark_model->getReviewsClub($this->m_clubId);
    }

    protected function getImages() {
        $this->viewData['images']           = $this->fitpark_model->getImagesClub($this->m_clubId);
        $this->viewData['countImagesOnRow'] = $this->m_countImagesOnRow;
    }

    protected function getAnalogs() {
        $this->viewData['analogs']           = $this->fitpark_model->getAnalogsClubs($this->m_clubId);
        $this->viewData['countAnalogsOnRow'] = $this->m_countAnalogsOnRow;
    }
}

?>
