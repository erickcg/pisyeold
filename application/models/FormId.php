<?php

class Application_Model_FormId extends Zend_Form
{
	public function __construct($options = null)
	{
		 parent::__construct($options);
		 $this->setName('id');
		 $this->setMethod('post');
		 $this->setAction('/Reporte');

		 $submit = new Zend_Form_Element_Submit('submit');
		 $submit->setLabel('Escoger')
		 	->setAttrib('class', 'button');

		 $this->setDecorators( array( array('ViewScript', array('viewScript' => '/reporte/_form_id.phtml'))));

		 $this->addElement( $submit);
	 }
}
