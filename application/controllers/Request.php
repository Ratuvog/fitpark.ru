<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 12/25/13
 * Time: 2:20 PM
 */

require APPPATH.'/libraries/REST_Controller.php';

class Request extends REST_Controller {
    private $clubId;
    function _get()
    {
        $this->load->model('subscription');
        $this->response($this->subscription->active($this->clubId));
    }

    function _put()
    {
        $this->load->model('subscription');
        $id = $this->put("id");
        $state = $this->put("state");
        if($this->subscription->updateState($id, $state))
            $this->response(array('status'=>1, 'success'=>'Данные обновлены'));
        else
            $this->response(array('status'=>0, 'error'=>'Во время обновления данных произошла ошибка'),500);
    }

    function _remap($object_called, $arguments)
    {
        $this->clubId = $object_called;
        $object_called = NULL;
        parent::_remap($object_called, $arguments);
    }
}

?>