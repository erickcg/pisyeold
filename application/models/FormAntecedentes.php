<?php

class Application_Model_FormAntecedentes extends Zend_Form
{
	public function __construct($options = null)
	{
		 parent::__construct($options);
		 $this->setName('antecedentes');
		 $this->setMethod('post');
		 $this->setAction('/Alumno/antecedentes');

		$embarazoriesgoso = new Zend_Form_Element_Radio('embarazoriesgoso');
		$embarazoriesgoso->setMultiOptions(array('s'=>'Si', 'n'=>'No'));

	        $embarazoplaneado = new Zend_Form_Element_Radio('embarazoplaneado');
		$embarazoplaneado->setMultiOptions(array('s'=>'Si', 'n'=>'No'));

	        $amenazaaborto = new Zend_Form_Element_Text('amenazaaborto');
		$amenazaaborto->setAttrib('placeholder', 'Si no hubo amenaza de aborto, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$amenazaprematuro = new Zend_Form_Element_Text('amenazaprematuro');
		$amenazaprematuro->setAttrib('placeholder', 'Si no hubo amenaza de parto prematuro, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$contactoenfermedad = new Zend_Form_Element_Text('contactoenfermedad');
		$contactoenfermedad->setAttrib('placeholder', 'Si no contacto con alguna persona enferma, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$accidenteembarazo = new Zend_Form_Element_Text('accidenteembarazo');
		$accidenteembarazo->setAttrib('placeholder', 'Si no hubo accidente durante el embarazo, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');


		 $submit = new Zend_Form_Element_Submit('submit');
		 $submit->setLabel('Guardar')
		 	->setAttrib('class', 'button');

		 $this->setDecorators( array( array('ViewScript', array('viewScript' => '/alumno/_form_antecedentes.phtml'))));

		 $this->addElements(array($embarazoplaneado, $embarazoriesgoso, $tipoembarazo, $amenazaaborto, $amenazaprematuro, $contactoenfermedad, $accidenteembarazo, $submit));
	 }
}