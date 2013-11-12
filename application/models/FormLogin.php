<?php

class Application_Model_FormLogin extends Zend_Form
{
	public function __construct($options = null)
	{
		 parent::__construct($options);
		 $this->setName('login');
		 $this->setMethod('post');
		 $this->setAction('/account/login');

		 $username = new Zend_Form_Element_Text('username');
		 $username->setAttrib('size', 35)
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		 $password = new Zend_Form_Element_Password('password');
		 $password->setAttrib('size', 35);

		 $submit = new Zend_Form_Element_Submit('submit');
		 $submit->setLabel('Login')
		 ->setAttrib('class', 'button prefix');

		 $this->setDecorators( array( array('ViewScript', array('viewScript' => '/account/_form_login.phtml'))));

		 $this->addElements(array($username, $password, $submit));
	 }
}
