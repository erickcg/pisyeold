<?php

class Application_Model_FormPosnatales extends Zend_Form
{
	public function __construct($options = null)
	{
		 parent::__construct($options);
		 $this->setName('posnatales');
		 $this->setMethod('post');
		 $this->setAction('/Alumno/posnatales');

		$lloro = new Zend_Form_Element_Radio('lloro');
		$lloro->setMultiOptions(array('s'=>'Si', 'n'=>'No'))
		->setAttrib('required','');

	        $altamama = new Zend_Form_Element_Radio('altamama');
		$altamama->setMultiOptions(array('s'=>'Si', 'n'=>'No'))
		->setAttrib('required','');

		$cuidadosintensivos = new Zend_Form_Element_Text('cuidadosintensivos');
		$cuidadosintensivos->setAttrib('placeholder', 'Si no hubo cuidados intensivos, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$problemasalimentacion = new Zend_Form_Element_Text('problemasalimentacion');
		$problemasalimentacion->setAttrib('placeholder', 'Si no hubo problemas de alimentacion, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$traumatismos = new Zend_Form_Element_Text('traumatismos');
		$traumatismos->setAttrib('placeholder', 'Si no hubo traumatismos, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$infeccionneuro = new Zend_Form_Element_Text('infeccionneuro');
		$infeccionneuro->setAttrib('placeholder', 'Si no hubo infeccion neurologica, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$alergias = new Zend_Form_Element_Text('alergias');
		$alergias->setAttrib('placeholder', 'Si no hubo alergias, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$convulsiones = new Zend_Form_Element_Text('convulsiones');
		$convulsiones->setAttrib('placeholder', 'Si no hubo convulsiones, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$audicion = new Zend_Form_Element_Text('audicion');
		$audicion->setAttrib('placeholder', 'Si no hubo audicion, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$vision = new Zend_Form_Element_Text('vision');
		$vision->setAttrib('placeholder', 'Si no hubo vision, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$otros = new Zend_Form_Element_Text('otros');
		$otros->setAttrib('placeholder', 'Si no hay otros comentarios, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		 $submit = new Zend_Form_Element_Submit('submit');
		 $submit->setLabel('Guardar')
		 	->setAttrib('class', 'button');

		 $this->setDecorators( array( array('ViewScript', array('viewScript' => '/alumno/_form_posnatales.phtml'))));

		 $this->addElements(array($otros, $vision, $audicion, $convulsiones, $alergias, $infeccionneuro, $traumatismos, $problemasalimentacion, $cuidadosintensivos, $lloro, $altamama, $submit));
	 }
}
