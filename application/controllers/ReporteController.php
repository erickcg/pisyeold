<?php

class ReporteController extends Zend_Controller_Action
{

    public function init()
    {
        
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

        $db = Zend_Db_Table::getDefaultAdapter();

        $query = $db->select()
                    ->from('AlumnoDetalle');

        $results = $db->fetchAll($query);

        $this->view->query = $results;
    }
}

