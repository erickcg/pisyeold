<?php

class Application_Model_FormMedico extends Zend_Form
{
	public function __construct($options = null)
	{
		 parent::__construct($options);
		 $this->setName('medicos');
		 $this->setMethod('post');
		 $this->setAction('/Alumno/medicos');

		$nombre = new Zend_Form_Element_Text('nombre');
		$nombre->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Nombre')
		 	->setAttrib('required','')
		 	->setAttrib('pattern','alpha_numeric')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$especialidad = new Zend_Form_Element_Text('especialidad');
		$especialidad->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'especialidad')
		 	->setAttrib('required','')
		 	->setAttrib('pattern','alpha_numeric')
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

		 $this->setDecorators( array( array('ViewScript', array('viewScript' => '/alumno/_form_medico.phtml'))));

		 $this->addElements(array($nombre, $especialidad, $teloficina, $telcelular, $submit));
	 }
}
