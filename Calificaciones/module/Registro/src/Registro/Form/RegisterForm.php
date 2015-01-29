<?php
// filename : module/Users/src/Users/Form/RegisterForm.php
namespace Registro\Form;
use Zend\Form\Form;

class RegisterForm extends Form
{
	public function __construct($name = null)
	{
	 parent::__construct('Register');
	 $this->setAttribute('method', 'post');
	 $this->setAttribute('enctype','multipart/form-data');

		 $this->add(array(
				 'name' => 'nombre',
				 'type' => 'text',
				 'attributes' => array(
				 	'required' => ' ',
				 	'pattern' => 'alphanumesp',
				 ),
				 'options' => array(
					 'label' => 'Nombre',
				),
		 ));

		 $this->add(array(
				 'name' => 'apellido_paterno',
				 'type' => 'text',
				 'attributes' => array(
				 	'required' => ' ',
				 	'pattern' => 'alphanumesp',
				 ),
				 'options' => array(
					 'label' => 'Apellido Paterno',
				),
		 ));

		 $this->add(array(
				 'name' => 'apellido_materno',
				 'type' => 'text',
				 'attributes' => array(
				 	'required' => ' ',
				 	'pattern' => 'alphanumesp',
				 ),
				 'options' => array(
					 'label' => 'Apellido Materno',
				),
		 ));

		 $this->add(array(
				 'name' => 'email',
				 'type' => 'email',
				 'attributes' => array(
				 	'required' => ' ',
				 	'pattern' => 'email',
				 ),
				 'options' => array(
					 'label' => 'Correo electrónico',
				),
		 ));
		 $this->add(array(
				 'name' => 'tel_cel',
				 'type' => 'text',
				 'attributes' => array(
				 	'required' => ' ',
				 	'pattern' => 'alphanumesp',
				 ),
				 'options' => array(
					 'label' => 'Teléfono Celular',
				),
		 ));
		 $this->add(array(
				 'name' => 'estado',
				 'type' => 'Select',
				 'attributes' => array(
				 	'required' => ' ',
				 ),
				 'options' => array(
					 'label' => 'Estado',
					 'value_options' => array(
					 		'' => 'Seleccione',
                             'Aguascalientes' => 'Aguascalientes',
                             'Baja California' => 'Baja California',
                             'Baja California Sur' => 'Baja California Sur',
                             'Campeche' => 'Campeche',
                             'Coahuila' => 'Coahuila',
                             'Colima' => 'Colima',
                             'Chiapas' => 'Chiapas',
                             'Chihuahua' => 'Chihuahua',
                             'Distrito Federal' => 'Distrito Federal',
                             'Durango' => 'Durango',
                             'Guanajuato' => 'Guanajuato',
                             'Guerrero' => 'Guerrero',
                             'Hidalgo' => 'Hidalgo',
                             'Jalisco' => 'Jalisco',
                             'México' => 'México',
                             'Michoacán' => 'Michoacán',
                             'Morelos' => 'Morelos',
                             'Nayarit' => 'Nayarit',
                             'Nuevo León' => 'Nuevo León',
                             'Oaxaca' => 'Oaxaca',
                             'Puebla' => 'Puebla',
                             'Querétaro' => 'Querétaro',
                             'Quintana Roo' => 'Quintana Roo',
                             'San Luis Potosí' => 'San Luis Potosí',
                             'Sinaloa' => 'Sinaloa',
                             'Sonora' => 'Sonora',
                             'Tabasco' => 'Tabasco',
                             'Tamaulipas' => 'Tamaulipas',
                             'Tlaxcala' => 'Tlaxcala',
                             'Veracruz' => 'Veracruz',
                             'Yucatán' => 'Yucatán',
                             'Zacatecas' => 'Zacatecas',
                     ),
				),
		 ));
		 $this->add(array(
				 'name' => 'ciudad',
				 'type' => 'text',
				 'attributes' => array(
				 	'required' => ' ',
				 	'pattern' => 'alphanumesp',
				 ),
				 'options' => array(
					 'label' => 'Ciudad',
				),
		 ));
		 $this->add(array(
				 'name' => 'institucion',
				 'type' => 'text',
				 'attributes' => array(
				 	'required' => ' ',
				 	'pattern' => 'alphanumesp',
				 ),
				 'options' => array(
					 'label' => 'Institución',
				),
		 ));
		 $this->add(array(
				 'name' => 'grado',
				 'type' => 'Select',
				 'attributes' => array(
				 	'required' => ' ',
				 ),
				 'options' => array(
					 'label' => 'Grado de escolaridad actual',
					 'value_options' => array(
					 		'' => 'Seleccione',
                             'preparatoria' => 'Preparatoria',
                             'profesional' => 'Profesional',
                             'posgrado' => 'Posgrado',
                     ),
				),
		 ));

		 $this->add(array(
				 'name' => 'submit',
				 'type' => 'Submit',
				 'attributes' => array(
				 	'value' => 'Enviar',
				 	'class' => 'button',
				 ),
		 ));
	}
}