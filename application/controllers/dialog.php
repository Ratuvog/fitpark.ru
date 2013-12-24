<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Template.php');

class Dialog extends CI_Controller {
            
    function __construct()
    {
        parent::__construct();
    }
    
    function addReview($club)
    {
        $data = array(
            "fitnesclubid" => $club,
            "senderIP"     => $_SERVER["REMOTE_ADDR"],
            "text"         => $this->input->post("text"),
            "sender"       => $this->input->post("name"),
            "positive"     => $this->input->post("plus"),
            "negative"     => $this->input->post("minus"),
            "type"         => $this->input->post("type-rewiew")
        );

        $this->review->insert($data);
        redirect($this->idna_convert->encode(site_url(array('club', $club."#!/review"))));
    }

    function getClubCard($club)
    {
        $ans_ok = array('status' => "OK", 'msg' => "Заявка на получение абонемента в фитнес-клуб принята");
        $ans_err = array('status' => "ERR", 'msg' => "От посетителя с таким телефоном и адресом электронной почты уже поступала заявка");
        
        $data = array(
            "clubid" => $club,
            "name"   => $this->input->post("name"),
            "surname"=> $this->input->post("surname"),
            "tel"    => $this->input->post("tel"),
            "email"  => $this->input->post("e-mail"),
            "date"   => $this->input->post("date")
        );
        
        $this->load->model('subscription');
        if($this->subscription->get(array(
            "clubid" =>$club,
            "tel"    =>$this->input->post("tel"),
            "email"  =>$this->input->post("e-mail")
        )))
        {
            echo json_encode($ans_err);
            return;
        }
        
        $this->subscription->insert($data);
        echo json_encode($ans_ok);
    }
    
    function visitClub($club)
    {
        $ans_ok = array('status' => "OK", 'msg' => "Заявка на гостевое поcещение клуба принята");
        $ans_err = array('status' => "ERR", 'msg' => "От посетителя с таким телефоном и адресом электронной почты уже поступала заявка");
        
        $data = array(
            "clubid" => $club,
            "name"   => $this->input->post("name"),
            "tel"    => $this->input->post("tel"),
            "email"  => $this->input->post("e-mail"),
            "date"   => $this->input->post("date")
        );
        
        $this->load->model('visit');
        if($this->visit->get(array(
            "clubid" =>$club,
            "tel"    =>$this->input->post("tel"),
            "email"  =>$this->input->post("e-mail")
        )))
        {
            echo json_encode($ans_err);
            return;
        }
        
        $this->visit->insert($data);
        echo json_encode($ans_ok);
    }
    
    function askQuestion($club)
    {
        $ans_ok = array('status' => "OK", 'msg' => "Вопрос отправлен менеджеру клуба");
        
        $data = array(
            "clubid" => $club,
            "name"   => $this->input->post("name"),
            "email"  => $this->input->post("e-mail"),
            "question" => $this->input->post("question")
        );
        
        $this->load->model('question');
        $this->question->insert($data);
        echo json_encode($ans_ok);
    }
    
    function getCall($club)
    {
        $ans_ok = array('status' => "OK", 'msg' => "Заявка на звонок от менеджера клуба принята");
        
        $data = array(
            "clubId" => $club,
            "name"   => $this->input->post("name"),
            "tel"    => $this->input->post("tel")
        );
        
        $this->load->model('feedback');
        $this->feedback->insert($data);
        echo json_encode($ans_ok);
    }
    
}
?>
