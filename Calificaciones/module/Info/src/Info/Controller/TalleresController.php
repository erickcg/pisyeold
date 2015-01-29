<?php
namespace Info\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Info\Model\Taller;
use Info\Model\TallerTable;
use Info\Form\TallerForm;

class TalleresController extends AbstractActionController
{
    protected $TallerTableVar;

    public function indexAction()
    {
        $view =  new ViewModel(array(
           'talleres' => $this->getTallerTable()->fetchAll(),
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

        $form = new TallerForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
           $taller = new Taller();
             //$form->setInputFilter($taller->getInputFilter());
           $form->setData($request->getPost());

           if ($form->isValid()) {
               $taller->exchangeArray($form->getData());
               $this->getTallerTable()->saveTaller($taller);

              // Redirect to main
               return $this->redirect()->toRoute(NULL, array(
                'controller' => 'talleres',
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
                'controller' => 'talleres',
                'action' => 'add'
               ));
       }

       try {
           $conf = $this->getTallerTable()->getTaller($id);
       }
       catch (\Exception $ex) {
           // return $this->redirect()->toRoute('Info', array(
           //     'action' => 'index'
           //     ));
       }

       $form  = new TallerForm();
       $form->bind($conf);
       $form->get('submit')->setAttribute('value', 'Editar');

       $request = $this->getRequest();
       if ($request->isPost()) {
           //$form->setInputFilter($conf->getInputFilter());
           $form->setData($request->getPost());

           if ($form->isValid()) {
               $this->getTallerTable()->saveTaller($conf);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute(NULL, array(
                'controller' => 'talleres',
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
           'talleres' => $this->getTallerTable()->fetchAll(),
           ));
        return $view;
    }

     public function getTallerTable()
     {
       if (!$this->TallerTableVar) {
           $sm = $this->getServiceLocator();
           $this->TallerTableVar = $sm->get('TallerTable');
       }
       return $this->TallerTableVar;
   }

}