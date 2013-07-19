<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 7/16/13
 * Time: 10:24 PM
 * To change this template use File | Settings | File Templates.
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Base.php');
class Training_program extends Base {
    public $view = 'trainig_program/trainig_program';
    
    function __construct()
    {
        parent::__construct();
        $this->load->config("payment");
        $this->load->config("training_program");
        $this->load->model("coach");
        $this->load->model("programs");
        $this->load->model("program_images");
        $this->title = sprintf("Составление программы тренировок. ФитПарк. %s Тренажерные залы, фитнес центры,
                                отзывы, стоимость, рейтинги, акции, скидки.",
            lang('title'));

        $this->description = sprintf("%s. Отзывы, рейтинг, фотографии, цены, описание.",
            lang("common_desc"));

        $this->keywords = sprintf("%s. Бассейн, тренажерный зал, аэробика,
                                   танцы, йога, пилатес, тренажеры.",
            lang("common_keys"));
    }

    function index()
    {
        $this->renderScene();
    }

    function paymentProgram()
    {
        $id = $this->programs->create($_POST);
        $newProgramImagesPath = $this->config->item("program_image_path").$id;
        $images = array();
        if(mkdir($newProgramImagesPath)) {
            if(isset($_FILES['files'])) {
                foreach ($_FILES['files']['name'] as $key => $val) {
                    move_uploaded_file($_FILES['files']['tmp_name'][$key],
                        $newProgramImagesPath."/".$_FILES['files']['name'][$key]);
                    $images[] = $_FILES['files']['name'][$key];
                }
                $this->program_images->add($id,$images);
            }

            $this->content->view = 'trainig_program/payment';
            $this->generateBreadcrumbs();

            $this->content->data->content_title->title = "Оплата заказа";
            $this->content->data->forms = $this->generatePaymentForm($id);
            $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
            $this->content->data->address  = $this->config->item("address");
            parent::renderScene();
        } else {
            die("Картинки не удалось загрузить");
        }
    }

    protected function generatePaymentForm($programId)
    {
        $fields = array();
        //Секретный ключ интернет-магазина
        $key = $this->config->item("secret_key");

        $fields = array();

// Добавление полей формы в ассоциативный массив
        $fields["WMI_MERCHANT_ID"]    = $this->config->item("merchant_id");
        $fields["WMI_PAYMENT_AMOUNT"] = $this->config->item("cost_program");
        $fields["WMI_CURRENCY_ID"]    = "643";
        $fields["WMI_PAYMENT_NO"]     = $programId;
        $fields["WMI_DESCRIPTION"]    = "BASE64:".base64_encode($this->config->item("payment_description"));
        $fields["WMI_EXPIRED_DATE"]   = "2050-12-31T23:59:59";
        $fields["WMI_SUCCESS_URL"]    = $this->idna_convert->decode(site_url(array('training_program','success_payment')));
        $fields["WMI_FAIL_URL"]       = $this->idna_convert->decode(site_url(array('training_program','fail_payment')));
        $fields["programId"]          = $programId;
//Если требуется задать только определенные способы оплаты, раскоментируйте данную строку и перечислите требуемые способы оплаты.
//$fields["WMI_PTENABLED"]      = array("ContactRUB", "UnistreamRUB", "SberbankRUB", "RussianPostRUB");

//Сортировка значений внутри полей
        foreach($fields as $name => $val)
        {
            if (is_array($val))
            {
                usort($val, "strcasecmp");
                $fields[$name] = $val;
            }
        }


// Формирование сообщения, путем объединения значений формы,
// отсортированных по именам ключей в порядке возрастания.
        uksort($fields, "strcasecmp");
        $fieldValues = "";

        foreach($fields as $value)
        {
            if (is_array($value))
                foreach($value as $v)
                {
                    //Конвертация из текущей кодировки (UTF-8)
                    //необходима только если кодировка магазина отлична от Windows-1251
                    $v = iconv("utf-8", "windows-1251", $v);
                    $fieldValues .= $v;
                }
            else
            {
                //Конвертация из текущей кодировки (UTF-8)
                //необходима только если кодировка магазина отлична от Windows-1251
                $value = iconv("utf-8", "windows-1251", $value);
                $fieldValues .= $value;
            }
        }

// Формирование значения параметра WMI_SIGNATURE, путем
// вычисления отпечатка, сформированного выше сообщения,
// по алгоритму MD5 и представление его в Base64

        $signature = base64_encode(pack("H*", md5($fieldValues . $key)));

//Добавление параметра WMI_SIGNATURE в словарь параметров формы

        $fields["WMI_SIGNATURE"] = $signature;

        return $fields;
    }

    public function renderScene()
    {
        $this->collectContent();
        parent::renderScene();
    }

    private function collectContent()
    {
        $this->content->view = $this->view;
        $this->generateBreadcrumbs();

        $fieldsForm = (object)array(
            "where"       => $this->config->item("where"),
            "gender"      => $this->config->item("gender"),
            "target"      => $this->config->item("target"),
            "years"       => $this->config->item("years"),
            "experience"  => $this->config->item("experience"),
            "weight"      => $this->config->item("weight"),
            "periodicity" => $this->config->item("periodicity"),
            "height"      => $this->config->item("height")
        );
        foreach ($fieldsForm as $key=>$val) {
            $this->content->data->$key = $val;
        }



        $this->content->data->coach = $this->coach->byId();
        $this->content->data->coach->avatar = site_url(array("image",
                                              "coach",
                                              $this->content->data->coach->avatar));

        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->content->data->content_title->title = "Программа тренировок";
    }

    function success_payment()
    {
        $programId = $this->input->post("WMI_PAYMENT_NO");
        $this->programs->setPaymented($programId);
        $this->postSuccess();
        $this->generateBreadcrumbs();
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->content->data->content_title->title = "Заказ успешно оформлен";
        $this->content->view = "common/success_action";
        $this->content->data->success_message = "Уведомление о выполнении заказа вам придет по электронной почте.
                                А пока вы можете посмотреть другие предложения нашего портала.";
        $this->content->data->redirect_url = base_url();
        parent::renderScene();
    }

    private function postSuccess()
    {
        //инициализируем сеанс
        $curl = curl_init();

        //уcтанавливаем урл, к которому обратимся
        curl_setopt($curl, CURLOPT_URL, $this->config->item("address"));

        //включаем вывод заголовков
        curl_setopt($curl, CURLOPT_HEADER, 1);

        //передаем данные по методу post
        curl_setopt($curl, CURLOPT_POST, 1);

        //теперь curl вернет нам ответ, а не выведет
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        //переменные, которые будут переданные по методу post
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'WMI_RESULT='.
            urlencode('OK'));
        //я не скрипт, я браузер опера
        curl_setopt($curl, CURLOPT_USERAGENT, 'Opera 10.00');

        $res = curl_exec($curl);

        //проверяем, если ошибка, то получаем номер и сообщение
        if(!$res){
            die(curl_error($curl).'('.curl_errno($curl).')');
        }

        curl_close($curl);
    }

    function fail_payment()
    {
        $this->generateBreadcrumbs();
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->content->data->content_title->title = "Что то пошло не так";
        $this->content->view = "common/fail_action";
        $this->content->data->fail_message = "При оформлении заказа произошла ошибка. Попробуйте сделать заказ программы тренировок позднее";
        $this->content->data->redirect_url = base_url();
        parent::renderScene();
    }

    private function generateBreadcrumbs()
    {
        $this->breadcrumbs []= (object)array(
            'name' => "Главная",
            'url' => base_url()
        );

        $this->breadcrumbs []= (object)array(
            'name' => "Программа тренировок",
            'url' => site_url('training_program')
        );
    }
}

?>