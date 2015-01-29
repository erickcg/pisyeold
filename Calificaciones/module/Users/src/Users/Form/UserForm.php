<?php
// filename : module/Users/src/Users/Form/RegisterForm.php
namespace Users\Form;
use Zend\Form\Form;

class UserForm extends Form
{
	public function __construct($name = null)
	{
	 parent::__construct('Login');
	 $this->setAttribute('method', 'post');
	 $this->setAttribute('enctype','multipart/form-data');

		 $this->add(array(
				 'name' => 'username',
				 'type' => 'text',
				 'attributes' => array(),
				 'options' => array(
					 'label' => 'username',
					),
		 ));

		 $this->add(array(
				 'name' => 'password',
				 'type' => 'text',
				 'attributes' => array(),
				 'options' => array(
					 'label' => 'password',
					),
		 ));

		 $this->add(array(
				 'name' => 'submit',
				 'type' => 'Submit',
				 'attributes' => array(
				 	'value' => 'Enviar',
				 ),
		 ));
	}
}