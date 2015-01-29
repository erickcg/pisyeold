<?php
namespace Info\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Info\Model\Conferencia;
use Info\Model\ConferenciaTable;
use Info\Form\ConferenciaForm;

class ConferenciasController extends AbstractActionController
{
    protected $ConferenciaTable;

    public function indexAction()
    {
        $view =  new ViewModel(array(
           'conferencias' => $this->getConferenciaTable()->fetchAll(),
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

        $form = new ConferenciaForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
           $conf = new Conferencia();
             //$form->setInputFilter($conf->getInputFilter());
           $form->setData($request->getPost());

           if ($form->isValid()) {
               $conf->exchangeArray($form->getData());
               $this->getConferenciaTable()->saveConferencia($conf);

                 // Redirect to main
               return $this->redirect()->toRoute(NULL, array(
                'controller' => 'conferencias',
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
                'controller' => 'conferencias',
                'action' => 'add'
               ));
       }

       try {
           $conf = $this->getConferenciaTable()->getConferencia($id);
       }
       catch (\Exception $ex) {
           // return $this->redirect()->toRoute('Info', array(
           //     'action' => 'index'
           //     ));
       }

       $form  = new ConferenciaForm();
       $form->bind($conf);
       $form->get('submit')->setAttribute('value', 'Editar');

       $request = $this->getRequest();
       if ($request->isPost()) {
           //$form->setInputFilter($conf->getInputFilter());
           $form->setData($request->getPost());

           if ($form->isValid()) {
               $this->getConferenciaTable()->saveConferencia($conf);

                 // Redirect to list of albums
               return $this->redirect()->toRoute(NULL, array(
                'controller' => 'conferencias',
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
           'conferencias' => $this->getConferenciaTable()->fetchAll(),
           ));
        return $view;
    }

     public function getConferenciaTable()
     {
       if (!$this->ConferenciaTable) {
           $sm = $this->getServiceLocator();
           $this->ConferenciaTable = $sm->get('ConferenciaTable');
       }
       return $this->ConferenciaTable;
   }

}