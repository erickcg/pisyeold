<?php

class Application_Model_FormGrupo extends Zend_Form
{
        public function __construct($options = null)
        {
                 parent::__construct($options);
                 $this->setName('altagrupo');
                 $this->setMethod('post');
                 $this->setAction(SITE_ROOT_URL_PATH.'/Grupo/altagrupo');

                $nombre = new Zend_Form_Element_Text('nombre');
                $nombre->setAttrib('size', 35)
                        ->setAttrib('placeholder', 'Nombre')
                        ->setAttrib('required','')
                        ->setAttrib('pattern','alpha_numeric')
                        ->removeDecorator('label')
                        ->removeDecorator('htmlTag');

                 $submit = new Zend_Form_Element_Submit('submit');
                 $submit->setLabel('Guardar')
                        ->setAttrib('class', 'button');

                 $this->setDecorators( array( array('ViewScript', array('viewScript' => '/grupo/_form_altagrupo.phtml'))));

                 $this->addElements(array($nombre, $submit));
         }
}
