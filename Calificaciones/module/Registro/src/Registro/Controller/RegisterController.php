<?php
namespace Registro\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Registro\Form\RegisterForm;
use Zend\Mail;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Mail\Message as MailMessage;
use Zend\Mail\Transport\Sendmail as SendmailTransport;

class RegisterController extends AbstractActionController
{
 public function indexAction()
 {
 	if ($this->request->isPost()) {
 		//inicializacion de variables
 		$post = $this->request->getPost();
		 $form = new RegisterForm();
		 $form->setData($post);

		 if (!$form->isValid()) {
			 $model = new ViewModel(array(
			 'error' => true,
			 'form' => $form,
			 ));
			$model->setTemplate('registro/register/index');
		 	return $model;
		 }

		 $this->createParticipante($form->getData());

		$email =  $this->getRequest()->getPost('email');

			 		 $htmlBody = '
		 <html>
		 <head>
		 </head>
		 <body>
		 <img src="http://congresonucleum.mx/img/logoprincipal.png" />
		 <h2>Registro exitoso</h2>
<p>¡Muchas gracias por tu pre-registro, tenemos tu información guardada y te mantendremos informado de las novedades de Nucleum!</p>
<p>Lo único que falta es que debes realizar el pago en el banco de su preferencia en cualquiera de las siguientes cuentas: </p>
<table>
<tr>
	<td>
		Bancomer
	</td>
	<td>
		Cuenta: CONVENIO CIE:688517
	</td>
	<td>
		Referencia: <br>
		002020605100813111216 <br>
		Concepto: <br>
		Alan0Fernando0Rodrig <br>
	</td>
</tr>
<tr>
	<td>
		Banorte
	</td>
	<td>
		Cuenta: EMISORA: 31898
	</td>
	<td>
		Referencia: <br>
		002020605100813111216 <br>
	</td>
</tr>
<tr>
	<td>
		HSBC
	</td>
	<td>
		Cuenta: TRANSACCI&Oacute;N: 5503 CLAVE: 7630
	</td>
	<td>
		Referencia 1: <br>
		002020605100813111216 <br>
		Referencia 2: <br>
		Alan0Fernando0Rodrig <br>
	</td>
</tr>
<tr>
	<td>
		Santander
	</td>
	<td>
		Cuenta: CONVENIO: 0996
	</td>
	<td>
		Referencia: <br>
		002020605100813111216 <br>
	</td>
</tr>
<tr>
	<td>
		Banamex
	</td>
	<td>
		CUENTA: 870-5160
	</td>
	<td>
		Referencia: <br>
		002020605100813111216 <br>
	</td>
</tr>
</table>
<p>Una vez realizado el pago, enviar la ficha de pago (con la información legible) al correo <a href="mailto:holanucleum@gmail.com">holanucleum@gmail.com</a> y esperar a recibir un correo de confirmado.</p>
<p>Más adelante nos pondremos en contacto para informarle a partir de cuándo podrá realizar su horario.</p>
</body>
</html>
';
		 $htmlPart = new MimePart($htmlBody);
	     $htmlPart->type = "text/html";
	 
	     $textPart = new MimePart($textBody);
	     $textPart->type = "text/plain";

	     $from = 'hola@congresonucleum.mx';
	     $to = $email;
	     $subject = 'Pre registro';
	 
	     $body = new MimeMessage();
	     $body->setParts(array($textPart, $htmlPart));
	 
	     $message = new MailMessage();
	     $message->setFrom($from);
	     $message->addTo($to);
	     $message->setSubject($subject);
	 
	     $message->setEncoding("UTF-8");
	     $message->setBody($body);
	     $message->getHeaders()->get('content-type')->setType('multipart/alternative');
	 
	     $transport = new SendmailTransport();
	     $transport->send($message);

		 return $this->redirect()->toRoute(NULL , array(
		 'controller' => 'register',
		 'action' => 'confirm'
		 ));


	 } //Fin es POST



	 
	//que hacer al principio 
	$form = new RegisterForm();
	$viewModel = new ViewModel(array('form' => $form));
	return $viewModel;
 }
 public function confirmAction()
 {
	 $viewModel = new ViewModel();
	 return $viewModel;
 }

 protected function createParticipante(array $data)
	{
		 $sm = $this->getServiceLocator();
		 $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');

		 $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();

		 $resultSetPrototype->setArrayObjectPrototype(new \Registro\Model\Participante);

		 $tableGateway = new \Zend\Db\TableGateway\TableGateway('Participante', $dbAdapter, null, $resultSetPrototype);

		$participante = new \Registro\Model\Participante();
		$participante->exchangeArray($data);

		$participanteTable = new \Registro\Model\ParticipanteTable($tableGateway);
		$participanteTable->saveParticipante($participante);

		 return true;
	}

}