<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/FitparkBaseController.php');
class FitparkClubController extends FitparkBaseController {

    /* Current club id */
    protected $clubId = 0;
    protected $m_countImagesOnRow  = 5;
    protected $m_countAnalogsOnRow = 4;
    
    private   $order = "rating";
    private   $currency = " руб.";
    
    function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function club($clubId, $isComment = 0)
    {
        // Временная заплатка - проблемы с роутингом
        $arr = $this->uri->segment_array();
        $this->clubId = (int)$arr[2];
        /* Перенес инициализацию вьюшек в конкретную страницу*/
        $this->titlePage = 'Фитнес-клуб';

        $this->view      = 'club/club';
        $this->viewData["clubUrl"] = crc32("Club".$clubId);
        $this->initViewData();
        
        $this->initHeaderData();
        
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
        $insertedData = array(
            "clubId" => $clubId,
            "ip"     => $_SERVER["REMOTE_ADDR"],
            "text"   => $this->input->post("text"),
            "user"   => $this->input->post("name"),
            "plus"   => $this->input->post("plus"),
            "minus"  => $this->input->post("minus"),
            "type"   => $this->input->post("type")
        );
        $this->fitpark_club_model->addReview($insertedData);
        $this->customRedirect(site_url(array('club',$clubId,'1')));
    }

    public function init()
    {
        /* init all data variables */
        $this->headerData['order'] = $this->order;
        
        /* Load model */
        $this->load->model('fitpark_club_model');
    }

    protected function getBaseInfo()
    {
        $infoArray = $this->fitpark_club_model->getBaseInfoClub($this->clubId);
//        print_r($infoArray[0]);
//        exit;
        if(count($infoArray)) {
            $infoArray[0]["isEmptyPrice"] = FALSE;
            foreach ($infoArray[0]['price'] as $key=>$value) {
                if(substr($key,0,3) == "sub" && $value) {
                    $infoArray[0]["isEmptyPrice"] |= TRUE;
                    break;
                }
            }
            $this->viewData['base'] = $infoArray[0];
            $this->headerData['order'] = $this->order;
        }
    }

    protected function getRates()
    {
        $this->viewData['base']['rates'] = $this->fitpark_club_model->getRatesClub($this->clubId);
        foreach ($this->viewData['base']['rates'] as &$currentRate) {
            $currentRate['price'] = substr($currentRate['price'], 0, strpos($currentRate['price'], ".")).$this->currency;
        }
    }

    protected function getReviews()
    {
        $this->viewData['reviews'] = $this->fitpark_club_model->getReviewsClub($this->clubId, $_SERVER['REMOTE_ADDR']);
        foreach ($this->viewData['reviews'] as &$value) {
            $value['fake_id'] = $value['id']+1e6;
        }
    }

    protected function getImages()
    {
        $ADDITIONAL = "_min";
        $this->viewData['images'] = $this->fitpark_club_model->getImages($this->clubId);
        $i = 0;
        foreach ($this->viewData['images'] as &$currentImage) {
            $currentImage["photo"] = "image/club/".$currentImage["photo"];
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
        $this->viewData['analogs']           = $this->fitpark_club_model->getAnalogs($this->clubId);
        $this->viewData['countAnalogsOnRow'] = $this->m_countAnalogsOnRow;
    }

    private function getIsCommentsParams()
    {
        $arr = $this->uri->segment_array();
        if(count($arr) < 3)
            return 0;
        return $arr[count($arr)-1];
    }

    public function vote()
    {
        $ok = array('status'=>'OK','msg'=>'Спасибо! Ваша оценка учтена.');
        $err = array('status'=>'ERR','msg'=>'Вы уже оценивали этот клуб.');
        $servErr = array('status'=>'ERR','msg'=>'Извините, произошла ошибка на сервере.');

        $val = $this->input->post('score');
        $clubId = $this->input->post('vote-id');

        if(!$val || !$clubId)
        {
            echo json_encode ($servErr);
            return;
        }

        $senderID = $_SERVER['REMOTE_ADDR'];
        if($this->fitpark_club_model->addVote($clubId, $senderID, $val))
            echo json_encode($ok);
        else
            echo json_encode($err);
        return;

    }

    private function getDescriptions()
    {
        $this->viewData['descript'] = $this->fitpark_club_model->descriptions($this->clubId);
    }

    private function getUserVote()
    {
        $this->viewData['userVote'] = $this->fitpark_club_model->userVote($this->clubId, $_SERVER['REMOTE_ADDR']);
    }

    private function initViewData() 
    {
        $this->viewData["isComment"] = $this->getIsCommentsParams();
        
        /* Get full info about club */
        $this->viewData['base'] = array();
        $this->getBaseInfo();
        if(empty($this->viewData['base'])) {
            $this->show404();
        }
        
        $this->getDescriptions();
        $this->getRates();
        $this->getReviews();
        $this->getImages();
        $this->getAnalogs();
        $this->getUserVote();
    }

    private function initHeaderData() 
    {
        $headerInfo = array('titleText'=>"ФитПарк. %s %s. Стоимость, отзывы, фотографии, рейтинг, акции.");
        $headerInfo["titleText"] = sprintf($headerInfo["titleText"],
                                           $this->viewData['base']['name'],
                                           lang("current_club_title"));

        $headerInfo["keywords"] = "%s. %s. Бассейн, тренажерный зал, аэробика, танцы, йога, пилатес, тренажеры.";
        $headerInfo["keywords"] = sprintf($headerInfo["keywords"],
                                          $this->viewData['base']['name'],
                                          lang("common_keys"));

        $headerInfo["desc"] = "%s %s. Отзывы, рейтинг, фотографии, цены, описание.";
        $headerInfo["desc"] = sprintf($headerInfo["desc"],
                                      $this->viewData['base']['name'],
                                      lang("club_desc"));

        foreach ($headerInfo as $key=>$value) {
            $this->headerData[$key] = $value;
        }
        
        $this->breadCrumbsData[] = array(
            'href'  =>  site_url(array('clubs')),
            'title' => 'Список клубов'
        );
        
        $this->breadCrumbsData[] = array(
            'href'  => current_url(),
            'title' => $this->viewData['base']['name']
        );

        $this->append_js(array("/js/club.js"));
        
    }
}

?>
