<?php
namespace Info\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Info\Model\Calificacion;
use Info\Model\CalificacionTable;
use Info\Form\CalificacionForm;

class CalificacionController extends AbstractActionController
{
    protected $CalificacionTableVar;

    public function indexAction()
    {
        $view =  new ViewModel(array(
           'alumno' => $this->getCalificacionTable()->fetchAll(),
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

        $form = new CalificacionForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
           $alumno = new Calificacion();
             //$form->setInputFilter($alumno->getInputFilter());
           $form->setData($request->getPost());

           if ($form->isValid()) {
               $alumno->exchangeArray($form->getData());
               $this->getCalificacionTable()->saveCalificacion($alumno);

              // Redirect to main
               return $this->redirect()->toRoute(NULL, array(
                'controller' => 'alumno',
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
                'controller' => 'alumno',
                'action' => 'add'
               ));
       }

       try {
           $alumno = $this->getCalificacionTable()->getCalificacion($id);
       }
       catch (\Exception $ex) {
           // return $this->redirect()->toRoute('Info', array(
           //     'action' => 'index'
           //     ));
       }

       $form  = new CalificacionForm();
       $form->bind($alumno);
       $form->get('submit')->setAttribute('value', 'Editar');

       $request = $this->getRequest();
       if ($request->isPost()) {
           //$form->setInputFilter($alumno->getInputFilter());
           $form->setData($request->getPost());

           if ($form->isValid()) {
               $this->getCalificacionTable()->saveCalificacion($alumno);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute(NULL, array(
                'controller' => 'alumno',
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
           'alumnovar' => $this->getCalificacionTable()->fetchAll(),
           ));
        return $view;
    }

     public function getCalificacionTable()
     {
       if (!$this->CalificacionTableVar) {
           $sm = $this->getServiceLocator();
           $this->CalificacionTableVar = $sm->get('CalificacionTable');
       }
       return $this->CalificacionTableVar;
   }

}