<?php

class Application_Model_FormMedicina extends Zend_Form
{
	public function __construct($options = null)
	{
		 parent::__construct($options);
		 $this->setName('medicinas');
		 $this->setMethod('post');
		 $this->setAction(SITE_ROOT_URL_PATH.'/Alumno/medicinas');

		$nombre = new Zend_Form_Element_Text('nombre');
		$nombre->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Nombre')
		 	->setAttrib('required','')
		 	->setAttrib('pattern','alpha_numeric')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$formula = new Zend_Form_Element_Text('formula');
		$formula->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'formula')
		 	->setAttrib('required','')
		 	->setAttrib('pattern','alpha_numeric')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$frecuencia = new Zend_Form_Element_Text('frecuencia');
		$frecuencia->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'frecuencia')
		 	->setAttrib('required','')
		 	->setAttrib('pattern','alpha_numeric')
			->removeDecorator('label')
			->removeDecorator('htmlTag');


		 $submit = new Zend_Form_Element_Submit('submit');
		 $submit->setLabel('Guardar')
		 	->setAttrib('class', 'button');

		 $this->setDecorators( array( array('ViewScript', array('viewScript' => '/alumno/_form_medicinas.phtml'))));

		 $this->addElements(array($nombre, $formula, $frecuencia, $submit));
	 }
}
