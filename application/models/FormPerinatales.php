<?php

class Application_Model_FormPerinatales extends Zend_Form
{
	public function __construct($options = null)
	{
		 parent::__construct($options);
		 $this->setName('perinatales');
		 $this->setMethod('post');
		 $this->setAction(SITE_ROOT_URL_PATH.'/Alumno/perinatales');

	        $nacimiento = new Zend_Form_Element_Radio('nacimiento');
		$nacimiento->setMultiOptions(array('prematuro'=>'Prematuro', 'normal'=>'Normal', 'posmaduro'=>'Posmaduro'))
	                ->setValue("normal");

		$tiempo = new Zend_Form_Element_Text('tiempo');
		$tiempo->setAttrib('placeholder', 'En horas')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$tipodeparto = new Zend_Form_Element_Radio('tipodeparto');
		$tipodeparto->setMultiOptions(array('eut&oacute;cico'=>'eut&oacute;cico', 'dist&oacute;cico'=>'dist&oacute;cico'))
	                ->setValue("eut&oacute;cico");

	        $multiple = new Zend_Form_Element_Radio('multiple');
		$multiple->setMultiOptions(array('s'=>'Sí', 'n'=>'No'))
		->setAttrib('required','');

		$cesarea = new Zend_Form_Element_Text('cesarea');
		$cesarea->setAttrib('placeholder', 'Si no hubo cesárea, dejar en blanco')
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
		$traumaobstetrico->setAttrib('placeholder', 'Si no hubo trauma obsétrico, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		 $submit = new Zend_Form_Element_Submit('submit');
		 $submit->setLabel('Guardar')
		 	->setAttrib('class', 'button');

		 $this->setDecorators( array( array('ViewScript', array('viewScript' => '/alumno/_form_perinatales.phtml'))));

		 $this->addElements(array($tiempo, $nacimiento, $tipodeparto, $multiple, $cesarea, $anoxia, $hipoxia, $sufrimientofetal, $traumaobstetrico, $submit));
	 }
}