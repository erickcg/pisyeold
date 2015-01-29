<?php
namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Form\UserForm;

class RegisterController extends AbstractActionController
{
	public function indexAction()
	{
		if ($this->request->isPost()) {
 		//inicializacion de variables
			$post = $this->request->getPost();
			$form = new UserForm();
			$form->setData($post);

			if (!$form->isValid()) {
				$model = new ViewModel(array(
					'error' => true,
					'form' => $form,
					));
				$model->setTemplate('users/register/index');
				return $model;
			}

			$this->createUser($form->getData());

			return $this->redirect()->toRoute(NULL , array(
				'controller' => 'register',
				'action' => 'confirm'
				));

	 } //Fin es POST
	 
	 $form = new UserForm();
	 $viewModel = new ViewModel(array('form' => $form));
	 return $viewModel;
	}
	public function confirmAction()
	{
		$viewModel = new ViewModel();
		return $viewModel;
	}

	protected function createUser(array $data)
	{
		$sm = $this->getServiceLocator();
		$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');

		$resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();

		$resultSetPrototype->setArrayObjectPrototype(new \Users\Model\User);

		$tableGateway = new \Zend\Db\TableGateway\TableGateway('User', $dbAdapter, null, $resultSetPrototype);

		$user = new \Users\Model\User();
		$user->exchangeArray($data);

		$userTable = new \Users\Model\UserTable($tableGateway);
		$userTable->saveUser($user);

		return true;
	}

}