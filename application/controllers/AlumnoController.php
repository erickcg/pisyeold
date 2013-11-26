<?php

class AlumnoController extends Zend_Controller_Action
{

    public function init()
    {

        $auth = Zend_Auth::getInstance();

        if ($auth->hasIdentity()) {
                $identity = $auth->getIdentity();
                if (isset($identity)) {
                        $this->view->idDisplay = "Bienvenido " . $identity . ", <a href='/account/logout'>logout</a>";
                }
        }
        else {
                $this->_helper->redirector('login', 'account');
        }

        $xml = simplexml_load_file('../application/views/scripts/alumni.xml');

        $nombrelast = $xml->xpath('/pages/link[last()]/title');
        $urllast = $xml->xpath('/pages/link[last()]/url');

        $this->view->nombrelast = $nombrelast[0];
        $this->view->urllast = $urllast[0];

        $nombre = $xml->xpath('/pages/link[last() -1]/title');
        $url = $xml->xpath('/pages/link[last() -1 ]/url');

        $this->view->nombre = $nombre[0];
        $this->view->url = $url[0];
    }

    public function indexAction()
    {
        
    }

    public function contactosAction()
    {
        $id = $this->_request->getParam('id');
        $db = Zend_Db_Table::getDefaultAdapter();
        $form = new Application_Model_FormContacto();

        if ($this->getRequest()->isPost()) {

                if ($form->isValid($this->_request->getPost())) {
                        
                        
                        $data = array(
                                'nombre' => $form->getValue('nombre'),
                                'idAlumno' => $this->_request->getPost('idAlumno')
                        );

                        //Valores que pueden ser NULL y deben ser respetados
                        if($form->getValue('telcasa') != ''){
                                $data['telcasa'] = $form->getValue('telcasa');
                        }

                        if($form->getValue('teloficina') != ''){
                                $data['teloficina'] = $form->getValue('teloficina');
                        }

                        if($form->getValue('telcelular') != ''){
                                $data['telcelular'] = $form->getValue('telcelular');
                        }
                        $this->view->mensaje = "<div class='alert-box success'>Contacto guardado</div>";

                        $db->insert('Contacto', $data);

                        if($this->_request->getPost('fromreportes') == 'yes'){
                                $this->_redirect('/Reporte/general/id/' . $this->_request->getPost('idAlumno'));
                                return;
                        }
                }
        }

        if($id != ''){
                $options = $db->fetchAll( $db->select()->from('AlumnoDetalle', array('id', 'nombre', 'apaterno', 'amaterno'))->where('id = ?', $id), 'id');
                
                $status = new Zend_Form_Element_Select('idAlumno');
                foreach ($options as $options) {
                    $status->addMultiOption($options['id'], $options['nombre'].' '.$options['apaterno'].' '.$options['amaterno']);
                }

                $form->addElement($status);
                $hidden = new Zend_Form_Element_Hidden('fromreportes');
                $hidden->setValue('yes');
                $form->addElement($hidden);
                $this->view->form = $form;
        } else{
                $options = $db->fetchAll( $db->select()->from('AlumnoDetalle', array('id', 'nombre', 'apaterno', 'amaterno'))->order('nombre ASC'), 'id');
                
                $status = new Zend_Form_Element_Select('idAlumno');
                foreach ($options as $options) {
                    $status->addMultiOption($options['id'], $options['nombre'].' '.$options['apaterno'].' '.$options['amaterno']);
                }

                $form->addElement($status);

                $this->view->form = $form;
        }

        
    }

    public function medicosAction()
    {
        $id = $this->_request->getParam('id');
        $db = Zend_Db_Table::getDefaultAdapter();
        $form = new Application_Model_FormMedico();

        if ($this->getRequest()->isPost()) {

                if ($form->isValid($this->_request->getPost())) {
                        
                        
                        $data = array(
                                'nombre' => $form->getValue('nombre'),
                                'especialidad' => $form->getValue('especialidad'),
                                'idAlumno' => $this->_request->getPost('idAlumno')
                        );

                        //Valores que pueden ser NULL y deben ser respetados
                        if($form->getValue('teloficina') != ''){
                                $data['teloficina'] = $form->getValue('teloficina');
                        }

                        if($form->getValue('telcelular') != ''){
                                $data['telcelular'] = $form->getValue('telcelular');
                        }
                        $this->view->mensaje = "<div class='alert-box success'>Doctor guardado</div>";

                        $db->insert('Medico', $data);

                        if($this->_request->getPost('fromreportes') == 'yes'){
                                $this->_redirect('/Reporte/general/id/' . $this->_request->getPost('idAlumno'));
                                return;
                        }
                }
        }

        if($id != ''){
                $options = $db->fetchAll( $db->select()->from('AlumnoDetalle', array('id', 'nombre', 'apaterno', 'amaterno'))->where('id = ?', $id), 'id');
                
                $status = new Zend_Form_Element_Select('idAlumno');
                foreach ($options as $options) {
                    $status->addMultiOption($options['id'], $options['nombre'].' '.$options['apaterno'].' '.$options['amaterno']);
                }

                $form->addElement($status);
                $hidden = new Zend_Form_Element_Hidden('fromreportes');
                $hidden->setValue('yes');
                $form->addElement($hidden);
                $this->view->form = $form;
        } else{
                $options = $db->fetchAll( $db->select()->from('AlumnoDetalle', array('id', 'nombre', 'apaterno', 'amaterno'))->order('nombre ASC'), 'id');
                
                $status = new Zend_Form_Element_Select('idAlumno');
                foreach ($options as $options) {
                    $status->addMultiOption($options['id'], $options['nombre'].' '.$options['apaterno'].' '.$options['amaterno']);
                }

                $form->addElement($status);
                $this->view->form = $form;
        }
    }

    public function antecedentesAction()
    {
        $id = $this->_request->getParam('id');
        $db = Zend_Db_Table::getDefaultAdapter();
        $form = new Application_Model_FormAntecedentes();

        if ($this->getRequest()->isPost()) {

                // If the submitted data is valid, attempt to authenticate the user
                if ($form->isValid($this->_request->getPost())) {
                        
                        $data = array(
                                'embarazoriesgoso' => $form->getValue('embarazoriesgoso'),
                                'embarazoplaneado' => $form->getValue('embarazoplaneado')
                        );

                        //Valores que pueden ser NULL y deben ser respetados
                        if($form->getValue('amenazaaborto') != ''){
                                $data['amenazaaborto'] = $form->getValue('amenazaaborto');
                        }

                        if($form->getValue('amenazaprematuro') != ''){
                                $data['amenazaprematuro'] = $form->getValue('amenazaprematuro');
                        }

                        if($form->getValue('contactoenfermedad') != ''){
                                $data['contactoenfermedad'] = $form->getValue('contactoenfermedad');
                        }

                        if($form->getValue('accidenteembarazo') != ''){
                                $data['accidenteembarazo'] = $form->getValue('accidenteembarazo');
                        }
                        
                        $id = $this->_request->getPost('id');

                        $db->update('AlumnoDetalle', $data, 'id = '. $id );

                        $this->_redirect('/Alumno/prenatales/id/' . $id);
                        return;
                }
        }

        $this->view->idalumno = $id;

        $query = $db->select()
                    ->from('AlumnoDetalle')->where('id = ?', $id); 
        $results = $db->fetchRow($query);

        $datafromdb = array(
                'embarazoriesgoso' => $results['embarazoriesgoso'],
                'embarazoplaneado' => $results['embarazoplaneado'],
                'amenazaaborto' => $results['amenazaaborto'],
                'amenazaprematuro' => $results['amenazaprematuro'],
                'contactoenfermedad' => $results['contactoenfermedad'],
                'accidenteembarazo' => $results['accidenteembarazo']
        ); 

        $form->setDefaults($datafromdb);

        $hidden = new Zend_Form_Element_Hidden('id');
        $hidden->setValue($id);
        $form->addElement($hidden);
        $this->view->form = $form;
    }

    public function prenatalesAction()
    {
        $id = $this->_request->getParam('id');
        $db = Zend_Db_Table::getDefaultAdapter();
        $form = new Application_Model_FormPrenatales();

        if ($this->getRequest()->isPost()) {

                // If the submitted data is valid, attempt to authenticate the user
                if ($form->isValid($this->_request->getPost())) {
                        
                        

                        //Valores que pueden ser NULL y deben ser respetados
                        if($form->getValue('enfermedaddurante') != ''){
                                $data['enfermedaddurante'] = $form->getValue('enfermedaddurante');
                        }

                        if($form->getValue('sustancias') != ''){
                                $data['sustancias'] = $form->getValue('sustancias');
                        }
                        
                        $id = $this->_request->getPost('id');

                        $db->update('AlumnoDetalle', $data, 'id = '. $id );

                        $this->_redirect('/Alumno/perinatales/id/' . $id);
                        return;
                }
        }

        $this->view->idalumno = $id;

        $query = $db->select()
                    ->from('AlumnoDetalle')->where('id = ?', $id); 
        $results = $db->fetchRow($query);

        $datafromdb = array(
                'enfermedaddurante' => $results['enfermedaddurante'],
                'sustancias' => $results['sustancias']
        ); 

        $form->setDefaults($datafromdb);

        $hidden = new Zend_Form_Element_Hidden('id');
        $hidden->setValue($id);
        $form->addElement($hidden);
        $this->view->form = $form;
    }

    public function perinatalesAction()
    {
        $id = $this->_request->getParam('id');
        $db = Zend_Db_Table::getDefaultAdapter();
        $form = new Application_Model_FormPerinatales();

        if ($this->getRequest()->isPost()) {

                // If the submitted data is valid, attempt to authenticate the user
                if ($form->isValid($this->_request->getPost())) {
                        
                        

                        $data = array(
                                'tiempo' => $form->getValue('tiempo'),
                                'nacimiento' => $form->getValue('nacimiento'),
                                'multiple' => $form->getValue('multiple'),
                                'tipodeparto' => $form->getValue('tipodeparto')
                        );

                        //Valores que pueden ser NULL y deben ser respetados
                        if($form->getValue('cesarea') != ''){
                                $data['cesarea'] = $form->getValue('cesarea');
                        }

                        if($form->getValue('anoxia') != ''){
                                $data['anoxia'] = $form->getValue('anoxia');
                        }

                        if($form->getValue('hipoxia') != ''){
                                $data['hipoxia'] = $form->getValue('hipoxia');
                        }

                        if($form->getValue('traumaobstetrico') != ''){
                                $data['traumaobstetrico'] = $form->getValue('traumaobstetrico');
                        }

                        if($form->getValue('sufrimientofetal') != ''){
                                $data['sufrimientofetal'] = $form->getValue('sufrimientofetal');
                        }
                        
                        $id = $this->_request->getPost('id');

                        $db->update('AlumnoDetalle', $data, 'id = '. $id );

                        $this->_redirect('/Alumno/posnatales/id/' . $id);
                        return;
                }
        }

        $this->view->idalumno = $id;

        $query = $db->select()
                    ->from('AlumnoDetalle')->where('id = ?', $id); 
        $results = $db->fetchRow($query);

        $datafromdb = array(
                'tiempo' => $results['tiempo'],
                'nacimiento' => $results['nacimiento'],
                'multiple' => $results['multiple'],
                'tipodeparto' => $results['tipodeparto'],
                'cesarea' => $results['cesarea'],
                'anoxia' => $results['anoxia'],
                'hipoxia' => $results['hipoxia'],
                'traumaobstetrico' => $results['traumaobstetrico'],
                'sufrimientofetal' => $results['sufrimientofetal']
        ); 

        $form->setDefaults($datafromdb);

        $hidden = new Zend_Form_Element_Hidden('id');
        $hidden->setValue($id);
        $form->addElement($hidden);
        $this->view->form = $form;
    }

    public function posnatalesAction()
    {
        $id = $this->_request->getParam('id');
        $db = Zend_Db_Table::getDefaultAdapter();
        $form = new Application_Model_FormPosnatales();

        if ($this->getRequest()->isPost()) {

                // If the submitted data is valid, attempt to authenticate the user
                if ($form->isValid($this->_request->getPost())) {
                        
                        

                        $data = array(
                                'lloro' => $form->getValue('lloro'),
                                'altamama' => $form->getValue('altamama')
                        );

                        //Valores que pueden ser NULL y deben ser respetados
                        if($form->getValue('cuidadosintensivos') != ''){
                                $data['cuidadosintensivos'] = $form->getValue('cuidadosintensivos');
                        }

                        if($form->getValue('problemasalimentacion') != ''){
                                $data['problemasalimentacion'] = $form->getValue('problemasalimentacion');
                        }

                        if($form->getValue('traumatismos') != ''){
                                $data['traumatismos'] = $form->getValue('traumatismos');
                        }

                        if($form->getValue('infeccionneuro') != ''){
                                $data['infeccionneuro'] = $form->getValue('infeccionneuro');
                        }

                        if($form->getValue('alergias') != ''){
                                $data['alergias'] = $form->getValue('alergias');
                        }

                        if($form->getValue('convulsiones') != ''){
                                $data['convulsiones'] = $form->getValue('convulsiones');
                        }

                        if($form->getValue('audicion') != ''){
                                $data['audicion'] = $form->getValue('audicion');
                        }

                        if($form->getValue('vision') != ''){
                                $data['vision'] = $form->getValue('vision');
                        }

                        if($form->getValue('otros') != ''){
                                $data['otros'] = $form->getValue('otros');
                        }
                        
                        $id = $this->_request->getPost('id');

                        $db->update('AlumnoDetalle', $data, 'id = '. $id );

                        $this->_redirect('/Alumno/hereditario/id/' . $id);
                        return;
                }
        }

        $this->view->idalumno = $id;

        $query = $db->select()
                    ->from('AlumnoDetalle')->where('id = ?', $id); 
        $results = $db->fetchRow($query);

        $datafromdb = array(
                'lloro' => $results['lloro'],
                'altamama' => $results['altamama'],
                'cuidadosintensivos' => $results['cuidadosintensivos'],
                'infeccionneuro' => $results['infeccionneuro'],
                'alergias' => $results['alergias'],
                'problemasalimentacion' => $results['problemasalimentacion'],
                'convulsiones' => $results['convulsiones'],
                'audicion' => $results['audicion'],
                'vision' => $results['vision'],
                'otros' => $results['otros'],
                'traumatismos' => $results['traumatismos']
        ); 

        $form->setDefaults($datafromdb);

        $hidden = new Zend_Form_Element_Hidden('id');
        $hidden->setValue($id);
        $form->addElement($hidden);
        $this->view->form = $form;
    }

    public function hereditarioAction()
    {
        $id = $this->_request->getParam('id');
        $db = Zend_Db_Table::getDefaultAdapter();
        $form = new Application_Model_FormHereditario();

        if ($this->getRequest()->isPost()) {

                // If the submitted data is valid, attempt to authenticate the user
                if ($form->isValid($this->_request->getPost())) {
                        
                        

                        if($form->getValue('lenguaje') != ''){
                                $data['lenguaje'] = $form->getValue('lenguaje');
                        }

                        if($form->getValue('retardo') != ''){
                                $data['retardo'] = $form->getValue('retardo');
                        }

                        if($form->getValue('problemaaprendizajehereditario') != ''){
                                $data['problemaaprendizajehereditario'] = $form->getValue('problemaaprendizajehereditario');
                        }

                        if($form->getValue('patologiacromosomica') != ''){
                                $data['patologiacromosomica'] = $form->getValue('patologiacromosomica');
                        }

                        if($form->getValue('patologiapsiquiatrica') != ''){
                                $data['patologiapsiquiatrica'] = $form->getValue('patologiapsiquiatrica');
                        }
                        
                        $id = $this->_request->getPost('id');

                        $db->update('AlumnoDetalle', $data, 'id = '. $id );

                        $this->_redirect('/Alumno/terminado');
                        return;
                }
        }

        $this->view->idalumno = $id;

        $query = $db->select()
                    ->from('AlumnoDetalle')->where('id = ?', $id); 
        $results = $db->fetchRow($query);

        $datafromdb = array(
                'lenguaje' => $results['lenguaje'],
                'retardo' => $results['retardo'],
                'problemaaprendizajehereditario' => $results['problemaaprendizajehereditario'],
                'patologiacromosomica' => $results['patologiacromosomica'],
                'patologiapsiquiatrica' => $results['patologiapsiquiatrica']
        ); 

        $form->setDefaults($datafromdb);

        $hidden = new Zend_Form_Element_Hidden('id');
        $hidden->setValue($id);
        $form->addElement($hidden);
        $this->view->form = $form;
    }

    public function livesearchAction()
    {
        $this->_helper->layout()->disableLayout();
                 Zend_Controller_Front::getInstance()
                 ->setParam('noViewRenderer', true);
        $xmlDoc=new DOMDocument();
        $xmlDoc->load("../application/views/scripts/alumni.xml");

        $x=$xmlDoc->getElementsByTagName('link');

        //get the q parameter from URL
        $q=$_GET["q"];
        
        //lookup all links from the xml file if length of q>0
        if (strlen($q)>0)
        {
        $hint="";
        for($i=0; $i<($x->length); $i++)
          {
          $y=$x->item($i)->getElementsByTagName('title');
          $z=$x->item($i)->getElementsByTagName('url');
          if ($y->item(0)->nodeType==1)
            {
            //find a link matching the search text
            if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$q))
              {
              if ($hint=="")
                {
                $hint="<a class='omnibar' href='" . 
                $z->item(0)->childNodes->item(0)->nodeValue . 
                "' >" . 
                $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
                }
              else
                {
                $hint=$hint . "<br /><a class='omnibar' href='" . 
                $z->item(0)->childNodes->item(0)->nodeValue . 
                "' >" . 
                $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
                }
              }
            }
          }
        }

        // Set output to "no suggestion" if no hint were found
        // or to the correct values
        if ($hint=="")
          {
          $response="no suggestion";
          }
        else
          {
          $response=$hint;
          }

        //output the response
        echo $response;
    }

    public function medicinasAction()
    {
        $id = $this->_request->getParam('id');
        $db = Zend_Db_Table::getDefaultAdapter();
        $form = new Application_Model_FormMedicina();

        if ($this->getRequest()->isPost()) {

                if ($form->isValid($this->_request->getPost())) {
                        
                        
                        $data = array(
                                'nombre' => $form->getValue('nombre'),
                                'formula' => $form->getValue('formula'),
                                'frecuencia' => $form->getValue('frecuencia'),
                                'idAlumno' => $this->_request->getPost('idAlumno')
                        );
                        $this->view->mensaje = "<div class='alert-box success'>Medicamento guardado</div>";

                        $db->insert('Medicina', $data);

                        if($this->_request->getPost('fromreportes') == 'yes'){
                                $this->_redirect('/Reporte/general/id/' . $this->_request->getPost('idAlumno'));
                                return;
                        }
                }
        }

        if($id != ''){
                $options = $db->fetchAll( $db->select()->from('AlumnoDetalle', array('id', 'nombre', 'apaterno', 'amaterno'))->where('id = ?', $id), 'id');
                
                $status = new Zend_Form_Element_Select('idAlumno');
                foreach ($options as $options) {
                    $status->addMultiOption($options['id'], $options['nombre'].' '.$options['apaterno'].' '.$options['amaterno']);
                }

                $form->addElement($status);
                $hidden = new Zend_Form_Element_Hidden('fromreportes');
                $hidden->setValue('yes');
                $form->addElement($hidden);
                $this->view->form = $form;
        } else{
                $options = $db->fetchAll( $db->select()->from('AlumnoDetalle', array('id', 'nombre', 'apaterno', 'amaterno'))->order('nombre ASC'), 'id');
                
                $status = new Zend_Form_Element_Select('idAlumno');
                foreach ($options as $options) {
                    $status->addMultiOption($options['id'], $options['nombre'].' '.$options['apaterno'].' '.$options['amaterno']);
                }

                $form->addElement($status);
                $this->view->form = $form;
        }

    }

    public function terminadoAction()
    {
        // action body
    }

    public function datosAction()
    {
        //Id from get if we come from anoter place in the altaalumno process
        $id = $this->_request->getParam('id');
        $db = Zend_Db_Table::getDefaultAdapter();
        $form = new Application_Model_FormDatosPersonales();
        
        if ($this->getRequest()->isPost()) {

                // If the submitted data is valid, attempt to authenticate the user
                if ($form->isValid($this->_request->getPost())) {
                                                
                        $data = array(
                                'nombre' => $form->getValue('nombre'),
                                'apaterno' => $form->getValue('apaterno'),
                                'amaterno' => $form->getValue('amaterno'),
                                'idGrupo' => $this->_request->getPost('grupo'),
                                'fechanacimiento' => $form->getValue('anio').'-'.$form->getValue('mes').'-'.$form->getValue('dia'),
                                'sexo' => $form->getValue('sexo')
                        );

                        //Valores que pueden ser NULL y deben ser respetados
                        if($form->getValue('diagnostico') != ''){
                                $data['diagnostico'] = $form->getValue('diagnostico');
                        }

                        if($form->getValue('numhermanos') != ''){
                                $data['numhermanos'] = $form->getValue('numhermanos');
                        }

                        if($form->getValue('lugarfam') != ''){
                                $data['lugarfamilia'] = $form->getValue('lugarfam');
                        }

                        if($form->getValue('tiposangre') != ''){
                                $data['tiposangre'] = $form->getValue('tiposangre');
                        }

                        if($form->getValue('nombrepadre') != ''){
                                $data['nombrepadre'] = $form->getValue('nombrepadre');
                        }

                        if($form->getValue('nombremadre') != ''){
                                $data['nombremadre'] = $form->getValue('nombremadre');
                        }

                        if($form->getValue('domicilio') != ''){
                                $data['domicilio'] = $form->getValue('domicilio');
                        }

                        if($form->getValue('seguro') != ''){
                                $data['seguro'] = $form->getValue('seguro');
                                $data['poliza'] = $form->getValue('poliza');
                        }

                        if($form->getValue('rehab') != ''){
                                $data['rehab'] = $form->getValue('rehab');
                        }

                        if($form->getValue('apoyopsico') != ''){
                                $data['apoyopsico'] = $form->getValue('apoyopsico');
                        }

                        $id = $this->_request->getPost('id');

                        if($id != ''){
                                $db->update('AlumnoDetalle', $data, 'id = '. $id );
                        } else {
                                $db->insert('AlumnoDetalle', $data);
                                $id = $db->lastInsertId();

                                //Add it to the XML
                                $xml = simplexml_load_file('../application/views/scripts/alumni.xml');

                                $link = $xml->addChild('link'); 
                                $link->addChild('title', $form->getValue('nombre').' '.$form->getValue('apaterno').' '.$form->getValue('amaterno')); 
                                $link->addChild('url', '/Reporte/general/id/'.$id); 

                                file_put_contents('../application/views/scripts/alumni.xml', $xml->asXML());
                        }

                        

                        $this->_redirect('/Alumno/antecedentes/id/' . $id);
                        return;
                }
        }
        if($id != '') {

        $this->view->idalumno = $id;

        $this->view->antecedentes = ' href="/Alumno/antecedentes/id/'.$id.'" ';
        $this->view->prenatales = ' href="/Alumno/prenatales/id/'.$id.'" ';
        $this->view->perinatales = ' href="/Alumno/perinatales/id/'.$id.'" ';
        $this->view->posnatales = ' href="/Alumno/posnatales/id/'.$id.'" ';
        $this->view->hereditario = ' href="/Alumno/hereditario/id/'.$id.'" ';


                $query = $db->select()
                            ->from('AlumnoDetalle')->where('id = ?', $id); 
                $results = $db->fetchRow($query);

                $datafromdb = array(
                        'nombre' => $results['nombre'],
                        'apaterno' => $results['apaterno'],
                        'amaterno' => $results['amaterno'],
                        'sexo' => $results['sexo'],
                        'diagnostico' => $results['diagnostico'],
                        'numhermanos' => $results['numhermanos'],
                        'lugarfam' => $results['lugarfam'],
                        'tiposangre' => $results['tiposangre'],
                        'nombrepadre' => $results['nombrepadre'],
                        'nombremadre' => $results['nombremadre'],
                        'seguro' => $results['seguro'],
                        'poliza' => $results['poliza'],
                        'rehab' => $results['rehab'],
                        'apoyopsico' => $results['apoyopsico']
                ); 


                $fecha = explode("-", $results['fechanacimiento']);     

                $datafromdb['anio'] = $fecha[0];
                $datafromdb['mes'] = $fecha[1];
                $datafromdb['dia'] = $fecha[2];

                $form->setDefaults($datafromdb);

                $hidden = new Zend_Form_Element_Hidden('id');
                $hidden->setValue($id);
                $form->addElement($hidden);
        }

        $options = $db->fetchAll( $db->select()->from('Grupo', array('id', 'nombre'))->order('nombre ASC'), 'id');
        
        $grupo = new Zend_Form_Element_Select('grupo');
        foreach ($options as $options) {
            $grupo->addMultiOption($options['id'], $options['nombre']);
        }
        
        $grupo->setValue($results['idGrupo']);

        $form->addElement($grupo);
        $this->view->form = $form;
    }

    public function modificarAction()
    {
            $db = Zend_Db_Table::getDefaultAdapter();

            $query = $db->select()
                        ->from('AlumnoDetalle')->order('nombre ASC');
            $results = $db->fetchAll($query);
            $this->view->query = $results;
    }

    public function hospitalAction()
    {
        $id = $this->_request->getParam('id');
        $db = Zend_Db_Table::getDefaultAdapter();
        $form = new Application_Model_FormHospital();

        if ($this->getRequest()->isPost()) {

                if ($form->isValid($this->_request->getPost())) {
                        
                        
                        $data = array(
                                'hospital' => $form->getValue('hospital'),
                                'detalles' => $form->getValue('detalles'),
                                'causa' => $form->getValue('causa'),
                                'tiempo' => $form->getValue('tiempo'),
                                'fechaingreso' => $form->getValue('anio').'-'.$form->getValue('mes').'-'.$form->getValue('dia'),
                                'idAlumno' => $this->_request->getPost('idAlumno')
                        );
                        $this->view->mensaje = "<div class='alert-box success'>Registro de hospitalización guardado</div>";

                        $db->insert('Hospitalizacion', $data);

                        if($this->_request->getPost('fromreportes') == 'yes'){
                                $this->_redirect('/Reporte/general/id/' . $this->_request->getPost('idAlumno'). '#hospital');
                                return;
                        }
                }
        }

        if($id != ''){
                $options = $db->fetchAll( $db->select()->from('AlumnoDetalle', array('id', 'nombre', 'apaterno', 'amaterno'))->where('id = ?', $id), 'id');
                
                $status = new Zend_Form_Element_Select('idAlumno');
                foreach ($options as $options) {
                    $status->addMultiOption($options['id'], $options['nombre'].' '.$options['apaterno'].' '.$options['amaterno']);
                }

                $form->addElement($status);
                $hidden = new Zend_Form_Element_Hidden('fromreportes');
                $hidden->setValue('yes');
                $form->addElement($hidden);
                $this->view->form = $form;
        } else{
                $options = $db->fetchAll( $db->select()->from('AlumnoDetalle', array('id', 'nombre', 'apaterno', 'amaterno'))->order('nombre ASC'), 'id');
                
                $status = new Zend_Form_Element_Select('idAlumno');
                foreach ($options as $options) {
                    $status->addMultiOption($options['id'], $options['nombre'].' '.$options['apaterno'].' '.$options['amaterno']);
                }

                $form->addElement($status);
                $this->view->form = $form;
        }
    }


}

























