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
    }

    public function indexAction()
    {
    //     $xml = simplexml_load_file('../application/views/scripts/alumni.xml');

    //     $link = $xml->addChild('link'); 
    //     $link->addChild('title', 'Yellow Cat'); 
    //     $link->addChild('url', 'aloof'); 

    //     file_put_contents('../application/views/scripts/alumni.xml', $xml->asXML());
    }


}

