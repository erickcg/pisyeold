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

        $xml = simplexml_load_file('../application/views/scripts/alumni.xml');

        $nombrelast = $xml->xpath('/pages/link[last()]/title');
        $urllast = $xml->xpath('/pages/link[last()]/url');

        $this->view->nombrelast = $nombrelast[0];
        $this->view->urllast = $urllast[0];

        $nombre = $xml->xpath('/pages/link[last() -1]/title');
        $url = $xml->xpath('/pages/link[last() -1 ]/url');

        $this->view->nombre = $nombre[0];
        $this->view->url = $url[0];
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
                    $this->view->id = $id;
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

                    //Contactos de emergencia
                    $query = $db->select()
                                ->from('Medico')->where('idAlumno = ?', $id);
                    $medico = $db->fetchAll($query);
                    $this->view->medico = $medico;

                    //Contactos de emergencia
                    $query = $db->select()
                                ->from('Medicina')->where('idAlumno = ?', $id);
                    $medicina = $db->fetchAll($query);
                    $this->view->medicina = $medicina;

                    //Contactos de emergencia
                    $query = $db->select()
                                ->from('Hospitalizacion')->where('idAlumno = ?', $id);
                    $hospital = $db->fetchAll($query);
                    $this->view->hospital = $hospital;
            }

        for($i=1; $i<=$results['numhermanos'] + 1; $i++){
            if($i == $results['lugarfamilia']){
                $this->view->lugar .= "<img src='/img/personaselected.png' />";
            }else{
                $this->view->lugar .= "<img src='/img/persona.png' />";
            }
            
        }
        
            
      
        $db = Zend_Db_Table::getDefaultAdapter();

        $options = $db->fetchAll( $db->select()->from('AlumnoDetalle', array('id', 'nombre', 'apaterno', 'amaterno'))->order('nombre ASC'), 'id');
        
        $status = new Zend_Form_Element_Select('idreporte');
        $status->setAttrib('onchange', 'this.form.submit()');
        $status->addMultiOption('', '');
        foreach ($options as $options) {
            $status->addMultiOption($options['id'], $options['nombre'].' '.$options['apaterno'].' '.$options['amaterno']);
        }

        $status->setValue($results['id']);

        $form->addElement($status);
        $this->view->form = $form;
    }


}



