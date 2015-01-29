<?php
namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Users\Form\UserForm;

class LoginController extends AbstractActionController
{
    public function indexAction()
    {
        $form = new UserForm();
        $viewModel = new ViewModel(array('form' => $form));
        return $viewModel;
    }

    public function getAuthService()
    {
        if (! $this->authservice) {
            $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter,'User','username','password');
            $authService = new AuthenticationService();
            $authService->setAdapter($dbTableAuthAdapter);
            $this->authservice = $authService;
        }
        return $this->authservice;
    }

    public function processAction()
    {
        $this->getAuthService()->getAdapter()->setIdentity($this->request->getPost('username'))->setCredential($this->request->getPost('password'));
        $result = $this->getAuthService()->authenticate();
        
        if($result->isValid()) {
            $this->getAuthService()->getStorage()->write($this->request->getPost('username'));
            return $this->redirect()->toRoute(NULL , array(
                'controller' => 'login',
                'action' => 'confirm'
                ));
        }
        
        return $this->redirect()->toRoute(NULL , array(
            'controller' => 'login',
            'action' => 'index'
            ));
    }

    public function confirmAction()
    {
        $username = $this->getAuthService()->getStorage()->read();
        $viewModel = new ViewModel(array(
            'username' => $username
            ));
        return $viewModel;
    }

}