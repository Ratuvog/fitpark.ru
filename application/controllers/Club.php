<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Base.php');
class Club extends Base {

    public $view = 'club/club';
    public $page = 'info';
    public $breadcrumbs = array();

    function __construct()
    {
        parent::__construct();
    }

    /*
     * Переопределяем метод renderScene для того,
     * чтобы собирать данные в структуры
     * только перед непосредсвенным рендерингом view
     */
    function renderScene()
    {
        $this->collectContent();
        parent::renderScene();
    }

    function collectContent()
    {
        $this->content();

        $this->title = sprintf("Фитнес-клуб %s %s на ФитПарке. Фотографии, цены, отзывы, рейтинг",
                               lang("city_2"), $this->club->name);

        $this->description = sprintf("Фитнес клуб %s города %s по адресу %s. Фотографии, стоимость, комментарии, оценки, описание ",
                                    $this->club->name, lang('city_2'), $this->club->address);

        $this->keywords = sprintf("%s. %s. Бассейн, тренажерный зал, аэробика, танцы, йога, пилатес, тренажеры.",
                                   $this->club->name, lang("common_keys"));
    }

    function content()
    {
        $this->content->view = $this->view;

        $this->content->data->club = $this->club;

        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->content->data->content_title->title = sprintf("Фитнес-клуб %s", $this->club->name);
        $this->content->data->page = $this->page;
    }

    function Club($club, $page = null)
    {
        $this->page = $page;

        // Клуб
        $this->club = $this->club_model->byId($club);

        // Услуги
        $this->club->services_row->service_map = $this->service->map();
        $this->club->services_row->services = $this->service->byClub($club);

        foreach ($this->club->services_row->service_map as &$service)
        {
            $service->icon = site_url(array('image', 'services_icon', $service->icon));
        }

        // Город
        $this->club->city = $this->city->byId($this->club->cityid);

        // Аналоги
        $this->club->analogs = $this->club_model->analogs($club);
        foreach($this->club->analogs as &$value)
            $value->url = prep_url(site_url(array('club', $value->id)));

        // Оценка пользователя
        $this->club->userVote = $this->club_model->userVote($club, $_SERVER['REMOTE_ADDR']);

        // Отзывы
        $this->club->comments->reviews = $this->review->byClub($club);
        foreach ($this->club->comments->reviews as &$value)
            $value->fake_id = $value->id + 1e6;

        // Фотографии
        $this->club->photos->images = $this->photo->byClub($club);

        $this->breadcrumbs []= (object)array(
            'name' => "Главная",
            'url' => base_url()
        );

        $this->breadcrumbs []= (object)array(
            'name' => "Клубы",
            'url' => site_url('clubs')
        );

        $this->breadcrumbs []= (object)array(
            'name' => $this->club->name,
            'url' => site_url(array("club",$this->club->id))
        );

        $this->renderScene();
    }

    public function vote()
    {
        $val = $this->input->post('score');
        $clubId = $this->input->post('vote-id');
        echo $this->club_model->addVote($clubId, $_SERVER['REMOTE_ADDR'], $val);
    }
}
?>
