<?php
namespace Registro\Form;
use Zend\InputFilter\InputFilter;
class RegisterFilter extends InputFilter
{
 public function __construct()
 {
	 	$this->add(array(
		 'name' => 'user',
		 'required' => true,
	 ));

	 $this->add(array(
		 'name' => 'password',
		 'required' => true,
	 ));
	}
}
