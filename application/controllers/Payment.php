<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->config("payment");
        $this->load->model("programs");
    }

    protected function print_answer($result, $description)
    {
        print "WMI_RESULT=" . strtoupper($result) . "&";
        print "WMI_DESCRIPTION=" .urlencode($description);
        exit();
    }

    function index()
    {
        // Секретный ключ интернет-магазина (настраивается в кабинете)

        $skey = $this->config->item("secrete_key");

        // Проверка наличия необходимых параметров в POST-запросе

        if (!isset($_POST["WMI_SIGNATURE"]))
            $this->print_answer("Retry", "Отсутствует параметр WMI_SIGNATURE");

        if (!isset($_POST["WMI_PAYMENT_NO"]))
            $this->print_answer("Retry", "Отсутствует параметр WMI_PAYMENT_NO");

        if (!isset($_POST["WMI_ORDER_STATE"]))
            $this->print_answer("Retry", "Отсутствует параметр WMI_ORDER_STATE");

        // Извлечение всех параметров POST-запроса, кроме WMI_SIGNATURE

        foreach($_POST as $name => $value)
        {
            if ($name !== "WMI_SIGNATURE") $params[$name] = $value;
        }

        // Сортировка массива по именам ключей в порядке возрастания
        // и формирование сообщения, путем объединения значений формы

        uksort($params, "strcasecmp"); $values = "";

        foreach($params as $name => $value)
        {
            //Конвертация из текущей кодировки (UTF-8)
            //необходима только если кодировка магазина отлична от Windows-1251
            $value = iconv("utf-8", "windows-1251", $value);
            $values .= $value;
        }

        // Формирование подписи для сравнения ее с параметром WMI_SIGNATURE

        $signature = base64_encode(pack("H*", md5($values . $skey)));

        //Сравнение полученной подписи с подписью W1

        if ($signature == $_POST["WMI_SIGNATURE"])
        {
            if (strtoupper($_POST["WMI_ORDER_STATE"]) == "ACCEPTED")
            {
                // TODO: Пометить заказ, как «Оплаченный» в системе учета магазина
                $programId = $this->input->post("WMI_PAYMENT_NO");
                $this->programs->setPaymented($programId);

                $this->print_answer("Ok", "Заказ #" . $_POST["WMI_PAYMENT_NO"] . " оплачен!");
            }
            else
            {
                // Случилось что-то странное, пришло неизвестное состояние заказа
                $this->print_answer("Retry", "Неверное состояние ". $_POST["WMI_ORDER_STATE"]);
            }
        }
        else
        {
            // Подпись не совпадает, возможно вы поменяли настройки интернет-магазина

            $this->print_answer("Retry", "Неверная подпись " . $_POST["WMI_SIGNATURE"]);
        }
    }
}

?>