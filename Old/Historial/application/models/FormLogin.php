<?php

class Application_Model_FormLogin extends Zend_Form
{
	public function __construct($options = null)
	{
		 parent::__construct($options);
		 $this->setName('login');
		 $this->setMethod('post');
		 $this->setAction(SITE_ROOT_URL_PATH.'/account/login');

		 $username = new Zend_Form_Element_Text('username');
		 $username->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Usuario')
		 	->setRequired(true)
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		 $password = new Zend_Form_Element_Password('password');
		 $password->setAttrib('size', 35)
			 ->setRequired(true)
			 ->setAttrib('placeholder', 'Contraseña');

		 $submit = new Zend_Form_Element_Submit('submit');
		 $submit->setLabel('Login')
		 	->setAttrib('class', 'button prefix');

		 $this->setDecorators( array( array('ViewScript', array('viewScript' => '/account/_form_login.phtml'))));

		 $this->addElements(array($username, $password, $submit));
	 }
}
