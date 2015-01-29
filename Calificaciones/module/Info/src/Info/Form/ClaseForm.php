<?php
// filename : module/Users/src/Users/Form/RegisterForm.php
namespace Info\Form;
use Zend\Form\Form;

class ClaseForm extends Form
{
	public function __construct($name = null)
	{
	 parent::__construct('Clase');
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
				 'name' => 'submit',
				 'type' => 'Submit',
				 'attributes' => array(
				 	'value' => 'Guardar',
				 	'class' => 'button',
				 ),
		 ));
	}
}