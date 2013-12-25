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
        $this->response($this->subscription->all($this->clubId));
    }

    function _remap($object_called, $arguments)
    {
        $this->clubId = $object_called;
        $object_called = NULL;
        parent::_remap($object_called, $arguments);
    }
}

?>