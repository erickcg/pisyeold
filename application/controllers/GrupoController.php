<?php

class GrupoController extends Zend_Controller_Action
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

    public function altagrupoAction()
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $form = new Application_Model_FormGrupo();

        if ($this->getRequest()->isPost()) {

                if ($form->isValid($this->_request->getPost())) {
                        $data = array(
                                'nombre' => $form->getValue('nombre')
                        );
                        $this->view->mensaje = "<div class='alert-box success'>Grupo guardado</div>";

                        $db->insert('Grupo', $data);
                }
        }

        $this->view->form = $form;
    }


}



