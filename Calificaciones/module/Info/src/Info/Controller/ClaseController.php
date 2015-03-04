<?php
namespace Info\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Info\Model\Clase;
use Info\Model\ClaseTable;
use Info\Form\ClaseForm;

class ClaseController extends AbstractActionController
{
    protected $ClaseTable;

    public function indexAction()
    {
        $view =  new ViewModel(array(
           'clase' => $this->getClaseTable()->fetchAll(),
           ));
        return $view;
    }

    public function addAction()
    {
      if (!$this->zfcUserAuthentication()->hasIdentity()) {
      return $this->redirect()->toUrl('/user/login');
    }

        $form = new ClaseForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
           $conf = new Clase();
             //$form->setInputFilter($conf->getInputFilter());
           $form->setData($request->getPost());

           if ($form->isValid()) {
               $conf->exchangeArray($form->getData());
               $this->getClaseTable()->saveClase($conf);

                 // Redirect to main
               return $this->redirect()->toRoute(NULL, array(
                'controller' => 'clase',
                'action' => 'lista'
               ));
           }
       }
       return array('form' => $form);
   }

   public function editAction()
   {
      if (!$this->zfcUserAuthentication()->hasIdentity()) {
      return $this->redirect()->toUrl('/user/login');
    }
       $id = (int)$this->params()->fromRoute('id', 0);
       if (!$id) {
           return $this->redirect()->toRoute(NULL, array(
                'controller' => 'clase',
                'action' => 'add'
               ));
       }

       try {
           $conf = $this->getClaseTable()->getClase($id);
       }
       catch (\Exception $ex) {
           // return $this->redirect()->toRoute('Info', array(
           //     'action' => 'index'
           //     ));
       }

       $form  = new ClaseForm();
       $form->bind($conf);
       $form->get('submit')->setAttribute('value', 'Editar');

       $request = $this->getRequest();
       if ($request->isPost()) {
           //$form->setInputFilter($conf->getInputFilter());
           $form->setData($request->getPost());

           if ($form->isValid()) {
               $this->getClaseTable()->saveClase($conf);

                 // Redirect to list of albums
               return $this->redirect()->toRoute(NULL, array(
                'controller' => 'clase',
                'action' => 'lista'
               ));
           }
       }

       $viewModel = new ViewModel(array(
           'id' => $id,
           'form' => $form,
           ));
       return $viewModel;
   }

   public function listaAction()
    {
      if (!$this->zfcUserAuthentication()->hasIdentity()) {
      return $this->redirect()->toUrl('/user/login');
    }

        $view =  new ViewModel(array(
           'clasevar' => $this->getClaseTable()->fetchAll(),
           ));
        return $view;
    }

     public function getClaseTable()
     {
       if (!$this->ClaseTable) {
           $sm = $this->getServiceLocator();
           $this->ClaseTable = $sm->get('ClaseTable');
       }
       return $this->ClaseTable;
   }

}