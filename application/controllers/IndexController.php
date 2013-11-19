<?php

class IndexController extends Zend_Controller_Action
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

}



