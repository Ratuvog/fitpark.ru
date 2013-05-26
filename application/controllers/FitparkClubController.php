<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/FitparkBaseController.php');
class FitparkClubController extends FitparkBaseController {

    /* Current club id */
    protected $m_clubId = 0;
    protected $m_countImagesOnRow  = 5;
    protected $m_countAnalogsOnRow = 4;
    private   $order = "rating";
    private   $currency = " руб.";
    function __construct()
    {
        parent::__construct();
        $this->init();

    }

    public function club($clubId, $isComment = FALSE)
    {
        $this->m_clubId = $clubId;
        /* Перенес инициализацию вьюшек в конкретную страницу*/
        $this->titlePage = 'Фитнес-клуб';
        $this->view      = 'club/club';
        $this->viewData["isComment"] = $isComment;
        /* Get full info about club */
        $this->getBaseInfo();
        $this->getRates();
        $this->getReviews();
        $this->getImages();
        $this->getAnalogs();


        $this->breadCrumbsData[] = array(
            'href'  => current_url(),
            'title' => $this->viewData['base']['name']
        );
        /* Output in view */
        $this->renderScene();
    }

    /* Гостевое посещение клуба */
    public function getGuest($clubId)
    {
        $this->fitpark_club_model->getGuest($clubId,
                                            $this->input->post("name"),
                                            $this->input->post("tel"),
                                            $this->input->post("e-mail"),
                                            $this->input->post("date"));
        $this->titlePage = "Ваша заявка принята";
        $this->view      = 'club/success_checkout';
        $this->renderScene();
    }

//    Получение скидки
    public function getAbonement($clubId)
    {
        $this->titlePage = "Ваша заявка принята";
        $this->view      = 'club/success_checkout';
        $this->fitpark_club_model->getAbonement($clubId,
                                               $this->input->post("name"),
                                               $this->input->post("surname"),
                                               $this->input->post("tel"),
                                               $this->input->post("e-mail"),
                                               $this->input->post("date"));
        $this->renderScene();
    }

    public function getFeedback($clubId) {
        $this->titlePage = "Ваша заявка принята";
        $this->view      = 'club/success_checkout';
        $this->fitpark_club_model->getFeedback($clubId,
                                               $this->input->post("name"),
                                               $this->input->post("tel")
                );
        $this->renderScene();
    }

    public function getQuestion($clubId) {
        $this->titlePage = "Ваша заявка принята";
        $this->view      = 'club/success_checkout';
        $this->fitpark_club_model->getQuestion($clubId,
                                               $this->input->post("name"),
                                               $this->input->post("email"),
                                               $this->input->post("question"));
        $this->renderScene();
    }

    public function addReview($clubId) {
        
        $this->fitpark_club_model->trans_start();
        
        $this->fitpark_club_model->addReview($clubId,
                                         $this->input->post("text"),
                                         $this->input->post("name"),
                                         $this->input->post("plus"),
                                         $this->input->post("minus"));
        $val = $this->input->post('score');
        $reviewID = $this->fitpark_club_model->lastInsertedId();
        $this->fitpark_club_model->addVote($clubId, $reviewID, $val);
        
        $this->fitpark_club_model->trans_commit();
        
        $this->club($clubId, TRUE);
    }

    public function init()
    {
        /* init all data variables */
        $this->allowedPages = array('index','club','club/getDiscount', 'getGuest','getDiscount','addReview');
        $this->privateAllowedPages = array();
        $this->headerData['order'] = $this->order;
        /* Load model */
        $this->load->model('fitpark_club_model');
    }

    protected function getBaseInfo()
    {
        $infoArray = $this->setEmptyPhoto($this->fitpark_club_model->getBaseInfoClub($this->m_clubId));
        $this->viewData['base'] = $infoArray[0];
        $this->headerData['order'] = $this->order;
    }

    protected function getRates()
    {
        $this->viewData['base']['rates'] = $this->fitpark_club_model->getRatesClub($this->m_clubId);
        foreach ($this->viewData['base']['rates'] as &$currentRate) {
            $currentRate['price'] = substr($currentRate['price'], 0, strpos($currentRate['price'], ".")).$this->currency;
        }
    }

    protected function getReviews()
    {
        $this->viewData['reviews'] = $this->fitpark_club_model->getReviewsClub($this->m_clubId);
    }

    protected function getImages()
    {
        $ADDITIONAL = "_min";
        $this->viewData['images']           = $this->fitpark_club_model->getImages($this->m_clubId);
        $i = 0;
        foreach ($this->viewData['images'] as &$currentImage) {
            if(!$currentImage["min_photo"]) {

                $config['image_library'] = 'gd2';
                $config['source_image'] = $currentImage["photo"];
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 300;
                $config['height'] = 150;
                $config['thumb_marker'] = $ADDITIONAL;

                $this->load->library("image_lib");
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $i."<br>";
                    echo $this->image_lib->display_errors();
                    exit;
                }
                $i++;
                $fileParts = explode('.', $currentImage["photo"]);
                $extension = $fileParts[count($fileParts)-1];
                array_pop($fileParts);
                $fileName = implode('.', $fileParts);

                $resultFileName = $fileName.$ADDITIONAL.'.'.$extension;
                $this->fitpark_club_model->updateThumb($currentImage['id'],$resultFileName);
                $currentImage['min_photo'] = $resultFileName;
                $this->image_lib->clear();
            }
            $currentImage["photo"]     = site_url($currentImage["photo"]);
            $currentImage['min_photo'] = site_url($currentImage["min_photo"]);
        }
        $this->viewData['countImagesOnRow'] = $this->m_countImagesOnRow;
    }

    protected function getAnalogs()
    {
        $this->viewData['analogs']           = $this->setEmptyPhoto($this->fitpark_club_model->getAnalogs($this->m_clubId));
        $this->viewData['countAnalogsOnRow'] = $this->m_countAnalogsOnRow;
    }
}

?>
