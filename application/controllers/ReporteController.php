<?php

class ReporteController extends Zend_Controller_Action
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
        $form = new Application_Model_FormId();
        if ($this->getRequest()->isPost()) {

                if ($form->isValid($this->_request->getPost())) {
            
                    $id = $this->_request->getPost('id');

                    $db = Zend_Db_Table::getDefaultAdapter();

                    //Generales
                    $query = $db->select()
                                ->from('AlumnoDetalle')->where('id = ?', $id);
                    $results = $db->fetchRow($query);
                    $this->view->query = $results;

                    //Contactos de emergencia
                    $query = $db->select()
                                ->from('Contacto')->where('idAlumno = ?', $id);

                    $contacto = $db->fetchAll($query);

                    $this->view->contacto = $contacto;
            }
        }
      
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $options = $db->fetchPairs( $db->select()->from('AlumnoDetalle', array('id', 'nombre'))->order('nombre ASC'), 'id');
        
        $status = new Zend_Form_Element_Select('id');
        $status->AddMultiOptions($options);

        $form->addElement($status);
        $this->view->form = $form;
    }
}

