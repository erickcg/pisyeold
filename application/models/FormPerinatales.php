<?php

class Application_Model_FormPerinatales extends Zend_Form
{
	public function __construct($options = null)
	{
		 parent::__construct($options);
		 $this->setName('perinatales');
		 $this->setMethod('post');
		 $this->setAction('/Alumno/perinatales');

	        $nacimiento = new Zend_Form_Element_Radio('nacimiento');
		$nacimiento->setMultiOptions(array('prematuro'=>'Prematuro', 'normal'=>'Normal', 'posmaduro'=>'Posmaduro'))
	                ->setValue("normal");

		$tiempo = new Zend_Form_Element_Text('tiempo');
		$tiempo->setAttrib('placeholder', 'En horas')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$tipodeparto = new Zend_Form_Element_Radio('tipodeparto');
		$tipodeparto->setMultiOptions(array('eutocico'=>'eutocico', 'distocico'=>'distocico'))
	                ->setValue("eutocico");

	        $multiple = new Zend_Form_Element_Radio('multiple');
		$multiple->setMultiOptions(array('s'=>'Si', 'n'=>'No'));

		$cesarea = new Zend_Form_Element_Text('cesarea');
		$cesarea->setAttrib('placeholder', 'Si no hubo cesarea, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$anoxia = new Zend_Form_Element_Text('anoxia');
		$anoxia->setAttrib('placeholder', 'Si no hubo anoxia, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$hipoxia = new Zend_Form_Element_Text('hipoxia');
		$hipoxia->setAttrib('placeholder', 'Si no hubo hipoxia, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$sufrimientofetal = new Zend_Form_Element_Text('sufrimientofetal');
		$sufrimientofetal->setAttrib('placeholder', 'Si no hubo sufrimiento fetal, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$traumaobstetrico = new Zend_Form_Element_Text('traumaobstetrico');
		$traumaobstetrico->setAttrib('placeholder', 'Si no hubo trauma obstetrico, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		 $submit = new Zend_Form_Element_Submit('submit');
		 $submit->setLabel('Siguiente->')
		 	->setAttrib('class', 'button');

		 $this->setDecorators( array( array('ViewScript', array('viewScript' => '/alumno/_form_perinatales.phtml'))));

		 $this->addElements(array($tiempo, $nacimiento, $tipodeparto, $multiple, $cesarea, $anoxia, $hipoxia, $sufrimientofetal, $traumaobstetrico, $submit));
	 }
}