<?php
namespace Info\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Info\Model\Maestro;
use Info\Model\MaestroTable;
use Info\Form\MaestroForm;

class MaestroController extends AbstractActionController
{
    protected $MaestroTable;

    public function indexAction()
    {
        $view =  new ViewModel(array(
           'clase' => $this->getMaestroTable()->fetchAll(),
           ));
        return $view;
    }

    public function addAction()
    {
      if (!$this->zfcUserAuthentication()->hasIdentity()) {
        return $this->redirect()->toRoute('zfcuser', array(
              'controller' => 'user',
              'action' => 'login'
               ));
      }

        $form = new MaestroForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
           $conf = new Maestro();
             //$form->setInputFilter($conf->getInputFilter());
           $form->setData($request->getPost());

           if ($form->isValid()) {
               $conf->exchangeArray($form->getData());
               $this->getMaestroTable()->saveMaestro($conf);

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
        return $this->redirect()->toRoute('zfcuser', array(
              'controller' => 'user',
              'action' => 'login'
               ));
      }
       $id = (int)$this->params()->fromRoute('id', 0);
       if (!$id) {
           return $this->redirect()->toRoute(NULL, array(
                'controller' => 'clase',
                'action' => 'add'
               ));
       }

       try {
           $conf = $this->getMaestroTable()->getMaestro($id);
       }
       catch (\Exception $ex) {
           // return $this->redirect()->toRoute('Info', array(
           //     'action' => 'index'
           //     ));
       }

       $form  = new MaestroForm();
       $form->bind($conf);
       $form->get('submit')->setAttribute('value', 'Editar');

       $request = $this->getRequest();
       if ($request->isPost()) {
           //$form->setInputFilter($conf->getInputFilter());
           $form->setData($request->getPost());

           if ($form->isValid()) {
               $this->getMaestroTable()->saveMaestro($conf);

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
        return $this->redirect()->toRoute('zfcuser', array(
              'controller' => 'user',
              'action' => 'login'
               ));
      }

        $view =  new ViewModel(array(
           'clasevar' => $this->getMaestroTable()->fetchAll(),
           ));
        return $view;
    }

     public function getMaestroTable()
     {
       if (!$this->MaestroTable) {
           $sm = $this->getServiceLocator();
           $this->MaestroTable = $sm->get('MaestroTable');
       }
       return $this->MaestroTable;
   }

}