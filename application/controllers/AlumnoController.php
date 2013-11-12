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
        $form = new Application_Model_FormDatosPersonales();
	

	if ($this->getRequest()->isPost()) {

		// If the submitted data is valid, attempt to authenticate the user
            	if ($form->isValid($this->_request->getPost())) {
		    	$AlumnoDetalle = new Application_Model_DbTable_AlumnoDetalle();
			$data = array(
				'nombre' => $form->getValue('nombre'),
				'apaterno' => $form->getValue('apaterno'),
				'amaterno' => $form->getValue('amaterno'),
				'fechanacimiento' => $form->getValue('anio').$form->getValue('mes').$form->getValue('dia'),
				'sexo' => $form->getValue('sexo'),
				'numhermanos' => $form->getValue('numhermanos'),
				'lugarfamilia' => $form->getValue('lugarfam'),
				'diagnostico' => $form->getValue('diagnostico'),
				'tiposangre' => $form->getValue('tiposangre'),
				'nombrepadre' => $form->getValue('nombrepadre'),
				'nombremadre' => $form->getValue('nombremadre'),
				'domicilio' => $form->getValue('domicilio')
			);
			$AlumnoDetalle->insert($data);

			$this->_redirect('/Alumno/contactos');
                    	return;
		}
	}

	$this->view->form = $form;
    }

    public function contactosAction()
    {
    	$form = new Application_Model_FormDatosPersonales();
	$this->view->form = $form;

	
        if ($this->getRequest()->isPost()) {
		$apaterno = $this->getRequest()->getPost('apaterno');
	}
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















