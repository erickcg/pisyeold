<?php

class AlumnoController extends Zend_Controller_Action
{

    public function init()
    {
        $auth = Zend_Auth::getInstance();

    	if ($auth->hasIdentity()) {
		$identity = $auth->getIdentity();
		if (isset($identity)) {
			$this->view->idDisplay = "Bienvenido " . $identity . ", <a href='/account/logout'>logout</a>";
		}
	}
	else {
		$this->_helper->redirector('login', 'account');
	}
    }

    public function indexAction()
    {
        
    }

    public function contactosAction()
    {
        // action body
    }

    public function medicosAction()
    {
        // action body
    }

    public function antecedentesAction()
    {
        // action body
    }

    public function prenatalesAction()
    {
        // action body
    }

    public function perinatalesAction()
    {
        // action body
    }

    public function posnatalesAction()
    {
        // action body
    }

    public function hereditarioAction()
    {
        // action body
    }


}















