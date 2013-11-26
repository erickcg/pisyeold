<?php

class Application_Model_FormDatosPersonales extends Zend_Form
{
	public function __construct($options = null)
	{
		 parent::__construct($options);
		 $this->setName('datospersonales');
		 $this->setMethod('post');
		 $this->setAction('/Alumno/datos');

		 $nombre = new Zend_Form_Element_Text('nombre');
		 $nombre->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Nombre')
		 	->setAttrib('required','')
		 	->setAttrib('pattern','alpha_numeric')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$apaterno = new Zend_Form_Element_Text('apaterno');
		$apaterno->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Apellido paterno')
		 	->setAttrib('required','')
		 	->setAttrib('pattern','alpha_numeric')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$amaterno = new Zend_Form_Element_Text('amaterno');
		$amaterno->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Apellido materno')
		 	->setAttrib('required','')
		 	->setAttrib('pattern','alpha_numeric')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$sexo = new Zend_Form_Element_Radio('sexo');
		$sexo->setMultiOptions(array('m'=>'Masculino', 'f'=>'Femenino'))
			->setAttrib('required','');

	        $dia = new Zend_Form_Element_Text('dia');
		$dia->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Dia')
		 	->setAttrib('required','')
		 	->setAttrib('pattern','positivo')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$mes = new Zend_Form_Element_Text('mes');
		$mes->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Mes-ejemplo: 5')
			->removeDecorator('label')
			->setAttrib('required','')
		 	->setAttrib('pattern','positivo')
			->removeDecorator('htmlTag');

		$anio = new Zend_Form_Element_Text('anio');
		$anio->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Año')
		 	->setAttrib('required','')
		 	->setAttrib('pattern','positivo')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$numhermanos = new Zend_Form_Element_Text('numhermanos');
		$numhermanos->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Numero de hermanos')
		 	->setAttrib('required','')
		 	->setAttrib('pattern','positivo')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$lugarfam = new Zend_Form_Element_Text('lugarfam');
		$lugarfam->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Lugar en la familia')
		 	->setAttrib('required','')
		 	->setAttrib('pattern','positivo')
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

		$seguro = new Zend_Form_Element_Text('seguro');
		$seguro->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Empresa de Seguro de gastos medicos')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$poliza = new Zend_Form_Element_Text('poliza');
		$poliza->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Poliza')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$rehab = new Zend_Form_Element_Text('rehab');
		$rehab->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Si no hay rehabilitacion del aprendizaje, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		$apoyopsico = new Zend_Form_Element_Text('apoyopsico');
		$apoyopsico->setAttrib('size', 35)
		 	->setAttrib('placeholder', 'Si no hay apoyo psicologico, dejar en blanco')
			->removeDecorator('label')
			->removeDecorator('htmlTag');

		 $submit = new Zend_Form_Element_Submit('submit');
		 $submit->setLabel('Guardar')
		 	->setAttrib('class', 'button');

		 $this->setDecorators( array( array('ViewScript', array('viewScript' => '/alumno/_form_datospersonales.phtml'))));

		 $this->addElements(array($nombre, $apaterno, $amaterno, $sexo, $dia, $mes, $anio, $numhermanos, 
		 	$lugarfam, $diagnostico, $tiposangre, $nombrepadre, $nombremadre, $domicilio, $seguro, $poliza, $rehab, $apoyopsico, $submit));
	 }
}
