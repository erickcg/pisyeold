<?php

class LoginController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->_helper->layout()->setLayout('noauth');
    }

    public function accountAction()
    {
        // action body
    }


}



