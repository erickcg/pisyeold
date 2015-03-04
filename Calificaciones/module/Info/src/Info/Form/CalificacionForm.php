<?php
// filename : module/Users/src/Users/Form/RegisterForm.php
namespace Info\Form;
use Zend\Form\Form;

class CalificacionForm extends Form
{
	public function __construct($name = null)
	{
	 parent::__construct('Calificacion');
	 $this->setAttribute('method', 'post');
	 $this->setAttribute('enctype','multipart/form-data');

	 	$this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
        ));

		$this->add(array(
				'name' => 'parcial1',
				'type' => 'text',
				'attributes' => array(

					'pattern' => 'alphanumesp',
				),
				'options' => array(
					'label' => 'Parcial 1',
				),
		));

		$this->add(array(
				'name' => 'parcial2',
				'type' => 'text',
				'attributes' => array(

					'pattern' => 'alphanumesp',
				),
				'options' => array(
					'label' => 'Parcial 2',
				),
		));

		$this->add(array(
			'name' => 'participacion',
			'type' => 'Select',
			'attributes' => array(
				),
			'options' => array(
				'label' => 'Participación',
				'value_options' => array(
					'nulo' => 'Seleccione',
					'E' => 'E',
					'MB' => 'MB',
					'B' => 'B',
					'R' => 'R',
					'EP' => 'EP',
					),
				),
			));

		$this->add(array(
			'name' => 'tareas',
			'type' => 'Select',
			'attributes' => array(
				),
			'options' => array(
				'label' => 'Tareas',
				'value_options' => array(
					'nulo' => 'Seleccione',
					'E' => 'E',
					'MB' => 'MB',
					'B' => 'B',
					'R' => 'R',
					'EP' => 'EP',
					),
				),
			));

		$this->add(array(
			'name' => 'disposicion',
			'type' => 'Select',
			'attributes' => array(
				),
			'options' => array(
				'label' => 'Disposición',
				'value_options' => array(
					'nulo' => 'Seleccione',
					'E' => 'E',
					'MB' => 'MB',
					'B' => 'B',
					'R' => 'R',
					'EP' => 'EP',
					),
				),
			));

		$this->add(array(
			'name' => 'puntualidad',
			'type' => 'Select',
			'attributes' => array(
				),
			'options' => array(
				'label' => 'Puntualidad',
				'value_options' => array(
					'nulo' => 'Seleccione',
					'E' => 'E',
					'MB' => 'MB',
					'B' => 'B',
					'R' => 'R',
					'EP' => 'EP',
					),
				),
			));

		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
					'value' => 'Guardar',
					'class' => 'button',
				),
		));
	}
}