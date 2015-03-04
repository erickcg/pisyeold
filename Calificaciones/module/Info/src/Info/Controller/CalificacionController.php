<?php
namespace Info\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Info\Model\Calificacion;
use Info\Model\CalificacionTable;
use Info\Form\CalificacionForm;
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class CalificacionController extends AbstractActionController
{
	protected $CalificacionTableVar;
	protected $ClaseTableVar;
	public $dbadapter;

	public function getAdapter()
	{
		if (!$this->dbadapter) {
			$sm = $this->getServiceLocator();
			$this->dbadapter = $sm->get('Zend\Db\Adapter\Adapter');
		}
		return $this->dbadapter;
	}

	public function indexAction()
	{
		$view =  new ViewModel(array(
			'calificacion' => $this->getCalificacionTable()->fetchAll(),
			));
		return $view;
	}

	public function addAction()
	{
		if (!$this->zfcUserAuthentication()->hasIdentity()) {
			return $this->redirect()->toUrl('/user/login');
		}

		//Fetch alumnos
	    $adapter = $this->getAdapter();
	    $sql = new Sql($adapter);
	    $select = $sql->select()->from('Alumno')->where(array('activo' => 'y'));
	    $statement = $sql->prepareStatementForSqlObject($select);
	    $result = $statement->execute();
	    $resultSet = new ResultSet;
	    $rows = $resultSet->initialize($result)->toArray();

	    $alumno[''] = 'Seleccione';
	    foreach ($rows as $row) {
	    	$alumno[$row['id']] = $row['nombre'];
	    }

	    //fetch clases
	    $sql = new Sql($adapter);
	    $select = $sql->select()->from('Clase')->where(array('activo' => 'y'));
	    $statement = $sql->prepareStatementForSqlObject($select);
	    $result = $statement->execute();
	    $resultSet = new ResultSet;
	    $rows = $resultSet->initialize($result)->toArray();

	    $clase[''] = 'Seleccione';
	    foreach ($rows as $row) {
	    	$clase[$row['id']] = $row['nombre'];
	    }

		$form = new CalificacionForm();
		$form->get('submit')->setValue('Add');
		$form->add(array(
			'name' => 'idAlumno',
			'type' => 'Select',
			'attributes' => array(
				'required' => ' ',
				),
			'options' => array(
				'label' => 'Nombre del Alumno',
				'value_options' => $alumno,
				),
			));

		$form->add(array(
			'name' => 'idClase',
			'type' => 'Select',
			'attributes' => array(
				'required' => ' ',
				),
			'options' => array(
				'label' => 'Clase',
				'value_options' => $clase,
				),
			));

		$request = $this->getRequest();
		if ($request->isPost()) {
			$calificacion = new Calificacion();
			 //$form->setInputFilter($calificacion->getInputFilter());
			$form->setData($request->getPost());

			if ($form->isValid()) {
				$calificacion->exchangeArray($form->getData());
				$this->getCalificacionTable()->saveCalificacion($calificacion);

			  // Redirect to main
				return $this->redirect()->toRoute(NULL, array(
					'controller' => 'calificacion',
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
				'controller' => 'calificacion',
				'action' => 'add'
				));
		}

		try {
			$calificacion = $this->getCalificacionTable()->getCalificacion($id);
		}
		catch (\Exception $ex) {
		   // return $this->redirect()->toRoute('Info', array(
		   //     'action' => 'index'
		   //     ));
		}
		$idclase = $calificacion->idClase;

		$form  = new CalificacionForm();
		$form->bind($calificacion);
		$form->get('submit')->setAttribute('value', 'Editar');

		$request = $this->getRequest();
		if ($request->isPost()) {
		   //$form->setInputFilter($calificacion->getInputFilter());
			$form->setData($request->getPost());

			if ($form->isValid()) {
				$this->getCalificacionTable()->saveCalificacion($calificacion);

				 // Redirect to list of calificaciones
				return $this->redirect()->toRoute(NULL, array(
					'controller' => 'calificacion',
					'action' => 'reporte',
					'id' => $idclase
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
			'calificacionvar' => $this->getCalificacionTable()->fetchAll(),
			));
		return $view;
	}

	public function reporteAction()
	{
		if (!$this->zfcUserAuthentication()->hasIdentity()) {
			return $this->redirect()->toUrl('/user/login');
		}

	//$adapter = $this->getAdapter();
		$id = (int)$this->params()->fromRoute('id', 0);

	//Fetch resultados
		if ($id) {
			$adapter = $this->getAdapter();
			$sql = new Sql($adapter);
			$select = $sql->select()->columns(array('alumnombre' => 'nombre', '*' => '*'))->from('Alumno')->join('Calificacion','Calificacion.idAlumno = Alumno.id')->join('Clase','Clase.id = Calificacion.idClase')->where(array('Calificacion.idClase' => $id));
			$statement = $sql->prepareStatementForSqlObject($select);
			$result = $statement->execute();
			$resultSet = new ResultSet;
			$rowPart = $resultSet->initialize($result)->toArray();
		}
		$clasenom = $rowPart[0]['nombre'];
		$menu = $this->getClaseTable()->fetchAll();


		$view =  new ViewModel(array(
			'results' => $rowPart,
			'menu' => $menu,
			'clase' => $clasenom,
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

	public function getClaseTable()
	{
		if (!$this->ClaseTableVar) {
			$sm = $this->getServiceLocator();
			$this->ClaseTableVar = $sm->get('ClaseTable');
		}
		return $this->ClaseTableVar;
	}

}