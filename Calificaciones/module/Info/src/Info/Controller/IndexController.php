<?php
namespace Info\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Info\Model\Conferencia;
use Info\Model\ConferenciaTable;
use Info\Form\ConferenciaForm;

class IndexController extends AbstractActionController
{
    protected $Table;

     public function indexAction()
     {
        $view =  new ViewModel(array(
             'conferencias' => $this->getTable()->fetchAll(),
         ));
        return $view;
     }
     public function talleresAction()
     {

        $conferenciaTable = $this->getServiceLocator()->get('ConferenciasTable');

        $view = new ViewModel(array(
             'conferencias' => $this->conferenciaTable()->fetchAll()
        ));
        return $view;
     }

     public function registroconferenciaAction()
     {   
        $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
            $form = new ConferenciaForm();
            
            $viewModel = new ViewModel(array('form' => $form));
            return $viewModel;
         } else {
             try {
                 $conf = $this->getTable()->getConferencia($id);
             }
             catch (\Exception $ex) {
             }

             $form = new ConferenciaForm();
             $form->bind($conf);
             $form->get('submit')->setAttribute('value', 'Editar');
            
            $viewModel = new ViewModel(array('form' => $form));
            return $viewModel;
         }
     }

     public function confirmacionconfAction()
     {

        if ($this->request->isPost()) {
        //inicializacion de variables
        $post = $this->request->getPost();
         $form = new ConferenciaForm();
         $form->setData($post);

             if (!$form->isValid()) {
                 $model = new ViewModel(array(
                 'error' => true,
                 'form' => $form,
                 ));
                $model->setTemplate('info/index/index');
                return $model;
             }

            $data = $form->getData();

            $conf = new \Info\Model\Conferencia();
            $conf->exchangeArray($data);

            $this->getTable()->saveConferencia($conf);

         } //Fin es POST

        $viewModel = new ViewModel();
        return $viewModel;
     }

     public function getTable()
     {
         if (!$this->Table) {
             $sm = $this->getServiceLocator();
             $this->Table = $sm->get('ConferenciaTable');
         }
         return $this->Table;
     }

}