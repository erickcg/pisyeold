<?php

class GrupoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
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


}

