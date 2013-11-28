<?php

class Application_Model_FormPrenatales extends Zend_Form
{
	public function __construct($options = null)
	{
		 parent::__construct($options);
		 $this->setName('prenatales');
		 $this->setMethod('post');
		 $this->setAction('/Alumno/prenatales');

	        $enfermedaddurante = new Zend_Form_Element_Text('enfermedaddurante');
		$enfermedaddurante->setAttrib('placeholder', 'Si no hubo enfermedad durante el embarazo, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$sustancias = new Zend_Form_Element_Text('sustancias');
		$sustancias->setAttrib('placeholder', 'Si no hubo exposicion a sustancias t&oacute;xicas, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		 $submit = new Zend_Form_Element_Submit('submit');
		 $submit->setLabel('Guardar')
		 	->setAttrib('class', 'button');

		 $this->setDecorators( array( array('ViewScript', array('viewScript' => '/alumno/_form_prenatales.phtml'))));

		 $this->addElements(array($sustancias, $enfermedaddurante, $submit));
	 }
}