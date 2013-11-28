<?php

class Application_Model_FormHospital extends Zend_Form
{
        public function __construct($options = null)
        {
                 parent::__construct($options);
                 $this->setName('hospital');
                 $this->setMethod('post');
                 $this->setAction(SITE_ROOT_URL_PATH.'/Alumno/hospital');

                $hospital = new Zend_Form_Element_Text('hospital');
                $hospital->setAttrib('size', 35)
                        ->setAttrib('placeholder', 'hospital')
                        ->setAttrib('required','')
                        ->setAttrib('pattern','alpha_numeric')
                        ->removeDecorator('label')
                        ->removeDecorator('htmlTag');

                $dia = new Zend_Form_Element_Text('dia');
                $dia->setAttrib('size', 35)
                        ->setAttrib('placeholder', 'Dia')
                        ->setAttrib('required','')
                        ->setAttrib('pattern','integer')
                        ->removeDecorator('label')
                        ->removeDecorator('htmlTag');

                $mes = new Zend_Form_Element_Text('mes');
                $mes->setAttrib('size', 35)
                        ->setAttrib('placeholder', 'Mes-ejemplo: 5')
                        ->removeDecorator('label')
                        ->setAttrib('required','')
                        ->setAttrib('pattern','integer')
                        ->removeDecorator('htmlTag');

                $anio = new Zend_Form_Element_Text('anio');
                $anio->setAttrib('size', 35)
                        ->setAttrib('placeholder', 'Año')
                        ->setAttrib('required','')
                        ->setAttrib('pattern','integer')
                        ->removeDecorator('label')
                        ->removeDecorator('htmlTag');

                $causa = new Zend_Form_Element_Text('causa');
                $causa->setAttrib('size', 35)
                        ->setAttrib('placeholder', 'causa')
                        ->setAttrib('required','')
                        ->setAttrib('pattern','alpha_numeric')
                        ->removeDecorator('label')
                        ->removeDecorator('htmlTag');

                $detalles = new Zend_Form_Element_Text('detalles');
                $detalles->setAttrib('placeholder', 'detalles')
                        ->removeDecorator('label')
                        ->removeDecorator('htmlTag');

                $tiempo = new Zend_Form_Element_Text('tiempo');
                $tiempo->setAttrib('placeholder', 'tiempo')
                        ->removeDecorator('label')
                        ->removeDecorator('htmlTag');

                 $submit = new Zend_Form_Element_Submit('submit');
                 $submit->setLabel('Guardar')
                        ->setAttrib('class', 'button');

                 $this->setDecorators( array( array('ViewScript', array('viewScript' => '/alumno/_form_hospital.phtml'))));

                 $this->addElements(array($hospital, $dia, $mes, $anio, $causa, $detalles,$tiempo,  $submit));
         }
}
