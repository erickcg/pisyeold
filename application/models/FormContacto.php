<?php

class Application_Model_FormContacto extends Zend_Form
{
	public function __construct($options = null)
	{
		 parent::__construct($options);
		 $this->setName('contactos');
		 $this->setMethod('post');
		 $this->setAction(SITE_ROOT_URL_PATH.'/Alumno/contactos');

		$nombre = new Zend_Form_Element_Text('nombre');
		$nombre->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Nombre')
		 	->setAttrib('required','')
		 	->setAttrib('pattern','alpha_numeric')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$telcasa = new Zend_Form_Element_Text('telcasa');
		$telcasa->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Tel casa')
		 	->setAttrib('required','')
		 	->setAttrib('pattern','number')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$teloficina = new Zend_Form_Element_Text('teloficina');
		$teloficina->setAttrib('placeholder', '')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$telcelular = new Zend_Form_Element_Text('telcelular');
		$telcelular->setAttrib('placeholder', '')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		 $submit = new Zend_Form_Element_Submit('submit');
		 $submit->setLabel('Guardar')
		 	->setAttrib('class', 'button');

		 $this->setDecorators( array( array('ViewScript', array('viewScript' => '/alumno/_form_contacto.phtml'))));

		 $this->addElements(array($nombre, $telcasa, $teloficina, $telcelular, $submit));
	 }
}
