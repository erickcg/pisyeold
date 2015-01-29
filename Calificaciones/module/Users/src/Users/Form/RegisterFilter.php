<?php
namespace Users\Form;
use Zend\InputFilter\InputFilter;
class RegisterFilter extends InputFilter
{
 public function __construct()
 {
	 	$this->add(array(
		 'name' => 'username',
		 'required' => true,
	 ));

	 $this->add(array(
		 'name' => 'password',
		 'required' => true,
	 ));
	}
}
