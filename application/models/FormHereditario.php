<?php

class Application_Model_FormHereditario extends Zend_Form
{
	public function __construct($options = null)
	{
		 parent::__construct($options);
		 $this->setName('hereditario');
		 $this->setMethod('post');
		 $this->setAction('/Alumno/hereditario');

		$lenguaje = new Zend_Form_Element_Text('lenguaje');
		$lenguaje->setAttrib('placeholder', 'Si no hubo alteracion del lenguaje, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$retardo = new Zend_Form_Element_Text('retardo');
		$retardo->setAttrib('placeholder', 'Si no hubo retardo cognitivo o intelectual, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$problemaaprendizajehereditario = new Zend_Form_Element_Text('problemaaprendizajehereditario');
		$problemaaprendizajehereditario->setAttrib('placeholder', 'Si no hubo problema de aprendizaje hereditario, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$patologiacromosomica = new Zend_Form_Element_Text('patologiacromosomica');
		$patologiacromosomica->setAttrib('placeholder', 'Si no hubo patologia cromosomica, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$patologiapsiquiatrica = new Zend_Form_Element_Text('patologiapsiquiatrica');
		$patologiapsiquiatrica->setAttrib('placeholder', 'Si no hubo patologia psiquiatrica, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		 $submit = new Zend_Form_Element_Submit('submit');
		 $submit->setLabel('Siguiente->')
		 	->setAttrib('class', 'button');

		 $this->setDecorators( array( array('ViewScript', array('viewScript' => '/alumno/_form_hereditario.phtml'))));

		 $this->addElements(array($lenguaje, $retardo, $problemaaprendizajehereditario, $patologiacromosomica, $patologiapsiquiatrica, $submit));
	 }
}
