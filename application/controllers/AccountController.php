<?php

class AccountController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
        //setting different layout for the no authorized
        $this->_helper->layout->setLayout('noauth');

        
        $db = Zend_Db_Table::getDefaultAdapter();

        $loginForm = new Application_Model_FormLogin();
 
        if ($this->getRequest()->isPost()) {

            // If the submitted data is valid, attempt to authenticate the user
            if ($loginForm->isValid($this->_request->getPost())) {
 
                $adapter = new Zend_Auth_Adapter_DbTable($db);
     
                $adapter->setTableName('User');
                $adapter->setIdentityColumn('user');
                $adapter->setCredentialColumn('password');
     
                $adapter->setIdentity($loginForm->getValue('username'));
                $adapter->setCredential($loginForm->getValue('password'));
     
                $auth   = Zend_Auth::getInstance();
                $result = $auth->authenticate($adapter);
     
                if ($result->isValid()) {
                    $this->_helper->FlashMessenger('Successful Login');
                    $this->_redirect('/');
                    return;
                }
            }
        }

        $this->view->form = $loginForm; 
    }

    public function logoutAction()
    {  
        //setting different layout for the no authorized
        $this->_helper->layout->setLayout('noauth');

        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->flashMessenger->addMessage('You are logged out of your account');
        $this->_helper->redirector('login', 'account');
    }


}
