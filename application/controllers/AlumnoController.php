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
		    	$db = Zend_Db_Table::getDefaultAdapter();
		    	
			$data = array(
				'nombre' => $form->getValue('nombre'),
				'apaterno' => $form->getValue('apaterno'),
				'amaterno' => $form->getValue('amaterno'),
				'fechanacimiento' => $form->getValue('anio').'-'.$form->getValue('mes').'-'.$form->getValue('dia'),
				'sexo' => $form->getValue('sexo')
			);

			//Valores que pueden ser NULL y deben ser respetados
			if($form->getValue('diagnostico') != ''){
				$data['diagnostico'] = $form->getValue('diagnostico');
			}

			if($form->getValue('numhermanos') != ''){
				$data['numhermanos'] = $form->getValue('numhermanos');
			}

			if($form->getValue('lugarfam') != ''){
				$data['lugarfamilia'] = $form->getValue('lugarfam');
			}

			if($form->getValue('tiposangre') != ''){
				$data['tiposangre'] = $form->getValue('tiposangre');
			}

			if($form->getValue('nombrepadre') != ''){
				$data['nombrepadre'] = $form->getValue('nombrepadre');
			}

			if($form->getValue('nombremadre') != ''){
				$data['nombremadre'] = $form->getValue('nombremadre');
			}

			if($form->getValue('domicilio') != ''){
				$data['domicilio'] = $form->getValue('domicilio');
			}

			if($form->getValue('seguro') != ''){
				$data['seguro'] = $form->getValue('seguro');
				$data['poliza'] = $form->getValue('poliza');
			}

			if($form->getValue('rehab') != ''){
				$data['rehab'] = $form->getValue('rehab');
			}

			if($form->getValue('apoyopsico') != ''){
				$data['apoyopsico'] = $form->getValue('apoyopsico');
			}

			$db->insert('AlumnoDetalle', $data);

			$id = $db->lastInsertId();

			$this->_redirect('/Alumno/antecedentes/id/' . $id);
                    	return;
		}
	}

	$this->view->form = $form;
    }

    public function contactosAction()
    {
        
    }

    public function medicosAction()
    {
        // action body
    }

    public function antecedentesAction()
    {
        $id = $this->_request->getParam('id');

        $form = new Application_Model_FormAntecedentes();

        if ($this->getRequest()->isPost()) {

		// If the submitted data is valid, attempt to authenticate the user
            	if ($form->isValid($this->_request->getPost())) {
			
		    	$db = Zend_Db_Table::getDefaultAdapter();
		    	
			$data = array(
				'embarazoriesgoso' => $form->getValue('embarazoriesgoso'),
				'embarazoplaneado' => $form->getValue('embarazoplaneado')
			);

			//Valores que pueden ser NULL y deben ser respetados
			if($form->getValue('amenazaaborto') != ''){
				$data['amenazaaborto'] = $form->getValue('amenazaaborto');
			}

			if($form->getValue('amenazaprematuro') != ''){
				$data['amenazaprematuro'] = $form->getValue('amenazaprematuro');
			}

			if($form->getValue('contactoenfermedad') != ''){
				$data['contactoenfermedad'] = $form->getValue('contactoenfermedad');
			}

			if($form->getValue('accidenteembarazo') != ''){
				$data['accidenteembarazo'] = $form->getValue('accidenteembarazo');
			}
			
			$id = $this->_request->getPost('id');

			$db->update('AlumnoDetalle', $data, 'id = '. $id );



			//$db->insert('AlumnoDetalle', $data);

			//$this->_redirect('/Alumno/prenatales/id/' . $id);
                    	return;
		}
	}

	$hidden = new Zend_Form_Element_Hidden('id');
	$hidden->setValue($id);
	$form->addElement($hidden);
	$this->view->form = $form;
    }

    public function prenatalesAction()
    {
        $id = $this->_request->getParam('id');

        $form = new Application_Model_FormAntecedentes();

        if ($this->getRequest()->isPost()) {

		// If the submitted data is valid, attempt to authenticate the user
            	if ($form->isValid($this->_request->getPost())) {
			
		    	$db = Zend_Db_Table::getDefaultAdapter();
		    	
			$data = array(
				'embarazoriesgoso' => $form->getValue('embarazoriesgoso'),
				'embarazoplaneado' => $form->getValue('embarazoplaneado')
			);

			//Valores que pueden ser NULL y deben ser respetados
			if($form->getValue('amenazaaborto') != ''){
				$data['amenazaaborto'] = $form->getValue('amenazaaborto');
			}

			if($form->getValue('amenazaprematuro') != ''){
				$data['amenazaprematuro'] = $form->getValue('amenazaprematuro');
			}

			if($form->getValue('contactoenfermedad') != ''){
				$data['contactoenfermedad'] = $form->getValue('contactoenfermedad');
			}

			if($form->getValue('accidenteembarazo') != ''){
				$data['accidenteembarazo'] = $form->getValue('accidenteembarazo');
			}
			
			$id = $this->_request->getPost('id');

			$db->update('AlumnoDetalle', $data, 'id = '. $id );



			//$db->insert('AlumnoDetalle', $data);

			//$this->_redirect('/Alumno/prenatales/id/' . $id);
                    	return;
		}
	}

	$hidden = new Zend_Form_Element_Hidden('id');
	$hidden->setValue($id);
	$form->addElement($hidden);
	$this->view->form = $form;
    }

    public function perinatalesAction()
    {
       $id = $this->_request->getParam('id');
    }

    public function posnatalesAction()
    {
        $id = $this->_request->getParam('id');
    }

    public function hereditarioAction()
    {
        $id = $this->_request->getParam('id');
    }

    public function livesearchAction()
    {
    	$this->_helper->layout()->disableLayout();
		 Zend_Controller_Front::getInstance()
		 ->setParam('noViewRenderer', true);
        $xmlDoc=new DOMDocument();
	$xmlDoc->load("../application/views/scripts/alumni.xml");

	$x=$xmlDoc->getElementsByTagName('link');

	//get the q parameter from URL
	$q=$_GET["q"];
	
	//lookup all links from the xml file if length of q>0
	if (strlen($q)>0)
	{
	$hint="";
	for($i=0; $i<($x->length); $i++)
	  {
	  $y=$x->item($i)->getElementsByTagName('title');
	  $z=$x->item($i)->getElementsByTagName('url');
	  if ($y->item(0)->nodeType==1)
	    {
	    //find a link matching the search text
	    if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$q))
	      {
	      if ($hint=="")
	        {
	        $hint="<a href='" . 
	        $z->item(0)->childNodes->item(0)->nodeValue . 
	        "' target='_blank'>" . 
	        $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
	        }
	      else
	        {
	        $hint=$hint . "<br /><a href='" . 
	        $z->item(0)->childNodes->item(0)->nodeValue . 
	        "' target='_blank'>" . 
	        $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
	        }
	      }
	    }
	  }
	}

	// Set output to "no suggestion" if no hint were found
	// or to the correct values
	if ($hint=="")
	  {
	  $response="no suggestion";
	  }
	else
	  {
	  $response=$hint;
	  }

	//output the response
	echo $response;
    }

    public function medicinasAction()
    {
        // action body
    }


}

















