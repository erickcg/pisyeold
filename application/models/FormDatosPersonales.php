<?php

class Application_Model_FormDatosPersonales extends Zend_Form
{
	public function __construct($options = null)
	{
		 parent::__construct($options);
		 $this->setName('datospersonales');
		 $this->setMethod('post');
		 $this->setAction('/Alumno');

		 $nombre = new Zend_Form_Element_Text('nombre');
		 $nombre->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Nombre')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$apaterno = new Zend_Form_Element_Text('apaterno');
		$apaterno->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Apellido paterno')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$amaterno = new Zend_Form_Element_Text('amaterno');
		$amaterno->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Apellido materno')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$sexo = new Zend_Form_Element_Radio('sexo');
		$sexo->setMultiOptions(array('m'=>'M', 'f'=>'F'))
	                //->setValue($rank_values['enabled'])
	                //->setSeparator('')
	                ->setValue("m");

	        $dia = new Zend_Form_Element_Text('dia');
		$dia->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Dia')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$mes = new Zend_Form_Element_Text('mes');
		$mes->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Mes-ejemplo: 5')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$anio = new Zend_Form_Element_Text('anio');
		$anio->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Año')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$numhermanos = new Zend_Form_Element_Text('numhermanos');
		$numhermanos->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Numero de hermanos')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$lugarfam = new Zend_Form_Element_Text('lugarfam');
		$lugarfam->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Lugar en la familia')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$diagnostico = new Zend_Form_Element_Text('diagnostico');
		$diagnostico->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Diagnostico')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$tiposangre = new Zend_Form_Element_Text('tiposangre');
		$tiposangre->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Tipo de Sangre')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$nombrepadre = new Zend_Form_Element_Text('nombrepadre');
		$nombrepadre->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Nombre del padre')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$nombremadre = new Zend_Form_Element_Text('nombremadre');
		$nombremadre->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Nombre de la madre')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$domicilio = new Zend_Form_Element_Text('domicilio');
		$domicilio->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Domicilio')
			->removeDecorator('label')
			->removeDecorator('htmlTag');


		 $submit = new Zend_Form_Element_Submit('submit');
		 $submit->setLabel('Siguiente->')
		 	->setAttrib('class', 'button');

		 $this->setDecorators( array( array('ViewScript', array('viewScript' => '/alumno/_form_datospersonales.phtml'))));

		 $this->addElements(array($nombre, $apaterno, $amaterno, $sexo, $dia, $mes, $anio, $numhermanos, $lugarfam, $diagnostico, $tiposangre, $nombrepadre, $nombremadre, $domicilio, $submit));
	 }
}
