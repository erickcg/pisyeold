<?php
namespace Info\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Info\Model\Alumno;
use Info\Model\AlumnoTable;
use Info\Form\AlumnoForm;

class AlumnoController extends AbstractActionController
{
    protected $AlumnoTableVar;

    public function indexAction()
    {
        $view =  new ViewModel(array(
           'alumno' => $this->getAlumnoTable()->fetchAll(),
           ));
        return $view;
    }

    public function addAction()
    {
      if (!$this->zfcUserAuthentication()->hasIdentity()) {
      return $this->redirect()->toUrl('/user/login');
    }

        $form = new AlumnoForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
           $alumno = new Alumno();
             //$form->setInputFilter($alumno->getInputFilter());
           $form->setData($request->getPost());

           if ($form->isValid()) {
               $alumno->exchangeArray($form->getData());
               $this->getAlumnoTable()->saveAlumno($alumno);

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
      return $this->redirect()->toUrl('/user/login');
    }
       $id = (int)$this->params()->fromRoute('id', 0);
       if (!$id) {
           return $this->redirect()->toRoute(NULL, array(
                'controller' => 'alumno',
                'action' => 'add'
               ));
       }

       try {
           $alumno = $this->getAlumnoTable()->getAlumno($id);
       }
       catch (\Exception $ex) {
           // return $this->redirect()->toRoute('Info', array(
           //     'action' => 'index'
           //     ));
       }

       $form  = new AlumnoForm();
       $form->bind($alumno);
       $form->get('submit')->setAttribute('value', 'Editar');

       $request = $this->getRequest();
       if ($request->isPost()) {
           //$form->setInputFilter($alumno->getInputFilter());
           $form->setData($request->getPost());

           if ($form->isValid()) {
               $this->getAlumnoTable()->saveAlumno($alumno);

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
      return $this->redirect()->toUrl('/user/login');
    }

        $view =  new ViewModel(array(
           'alumnovar' => $this->getAlumnoTable()->fetchAll(),
           ));
        return $view;
    }

     public function getAlumnoTable()
     {
       if (!$this->AlumnoTableVar) {
           $sm = $this->getServiceLocator();
           $this->AlumnoTableVar = $sm->get('AlumnoTable');
       }
       return $this->AlumnoTableVar;
   }

}