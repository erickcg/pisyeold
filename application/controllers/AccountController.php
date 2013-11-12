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

    public function loginAction() {
        $db = Zend_Db_Table::getDefaultAdapter();

        $loginForm = new Application_Model_FormLogin();
 
        if ($this->getRequest()->isPost()) {

            // If the submitted data is valid, attempt to authenticate the user
            if ($loginForm->isValid($this->_request->getPost())) {
 
                $adapter = new Zend_Auth_Adapter_DbTable($db);
     
                $adapter->setTableName('User');
                $adapter->setIdentityColumn('user');
                $adapter->setCredentialColumn('password');
                echo "entre;";
     
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
        }else {
            $this->view->form = $loginForm;
        }

        
    }
}

    // public function otherAction()
    // {
    //     $form = new Application_Model_FormLogin();

    //  // Has the login form been posted?
    //  if ($this->getRequest()->isPost()) {

    //      // If the submitted data is valid, attempt to authenticate the user
    //      if ($form->isValid($this->_request->getPost())) {

    //              // Did the user successfully login?
    //              if ($this->_authenticate($this->_request->getPost())) {

    //                      $account = $this->em->getRepository('Entities\Account')->findOneByEmail($form->getValue('email'));

    //                      // Save the account to the database
    //                      $this->em->persist($account);
    //                      $this->em->flush();

    //                      // Generate the flash message and redirect the user
    //                      $this->_helper->flashMessenger->addMessage(Zend_Registry::get('config')->messages->login->successful);
    //                         return $this->_helper->redirector('index', 'index');
    //              }
    //              else {
    //                 $this->view->errors["form"] = array(Zend_Registry::get('config')->messages->login->failed);
    //              }

    //      } 
    //      else {
    //         $this->view->errors = $form->getErrors();
    //      }

    //  }
    // $this->view->form = $form;

    // }



