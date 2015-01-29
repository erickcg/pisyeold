<?php
// filename : module/Users/src/Users/Form/RegisterForm.php
namespace Info\Form;
use Zend\Form\Form;

class ConferenciaForm extends Form
{
	public function __construct($name = null)
	{
	 parent::__construct('Conferencia');
	 $this->setAttribute('method', 'post');
	 $this->setAttribute('enctype','multipart/form-data');

	 	$this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));

		 $this->add(array(
				 'name' => 'nombre',
				 'type' => 'text',
				 'attributes' => array(
				 	'required' => ' ',
				 	'pattern' => 'alphanumesp',
				 ),
				 'options' => array(
					 'label' => 'Nombre',
				),
		 ));

		 $this->add(array(
				 'name' => 'informacion',
				 'type' => 'textarea',
				 'attributes' => array(
				 	'required' => ' ',
				 	'pattern' => 'alphanumesp',
				 ),
				 'options' => array(
					 'label' => 'Información',
				),
		 ));

		 $this->add(array(
				 'name' => 'carrera',
				 'type' => 'select',
				 'attributes' => array(
				 	'required' => ' ',
				 	'pattern' => 'alphanumesp',
				 ),
				 'options' => array(
					 'label' => 'Carrera',
                                         'value_options' => array(
                                                        '' => 'Seleccione',
                                             'alimentos' => 'Alimentos',
                                             'salud' => 'Salud',
                                             'tendencias' => 'Tendencias',
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