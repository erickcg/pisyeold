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
        
    }

    public function generalAction()
    {
        $id = $this->_request->getParam('id');

        $form = new Application_Model_FormId();
        if ($this->getRequest()->isPost()) {

                if ($form->isValid($this->_request->getPost())) {
                    
                    $id = $this->_request->getPost('idreporte');
                }
        }
        if($id != ''){
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
            
      
        $db = Zend_Db_Table::getDefaultAdapter();

        $options = $db->fetchAll( $db->select()->from('AlumnoDetalle', array('id', 'nombre', 'apaterno', 'amaterno'))->order('nombre ASC'), 'id');
        
        $status = new Zend_Form_Element_Select('idreporte');
        foreach ($options as $options) {
            $status->addMultiOption($options['id'], $options['nombre'].' '.$options['apaterno'].' '.$options['amaterno']);
        }

        $form->addElement($status);
        $this->view->form = $form;
    }


}



