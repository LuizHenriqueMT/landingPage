<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../../vendor/autoload.php';	

	if (isset($_POST['email']) && !empty($_POST['email'])):
		//Variavéis
		$nome_completo = utf8_encode($_POST['nome_completo']);
		$email = utf8_encode($_POST['email']);
		$celular = utf8_encode($_POST['celular']);
		$nome_empresa = utf8_encode($_POST['nome_empresa']);
		$instagram_empresa = utf8_encode($_POST['instagram_empresa']);
		$site_empresa = utf8_encode($_POST['site_empresa']);

		//Configuração do provedor gmail
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587;
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->SMTPAuth = true;
		$mail->IsHTML(true);
		$mail-> setLanguage ('pt_br');

		//Configuração do e-mail destinatário
		$mail->Username = "luizduapi@gmail.com";
		$mail->Password = "xdveoxiohedmwjlp";						

		//Configuração da mensagem
		$mail->setFrom($mail->Username,"Luiz Henrique"); //Remetente
		$mail->addAddress('luizduapi@gmail.com'); //Destinatário
		$mail->Subject = "Contato"; //Assunto do e-mail
		$mailBody = "
			<html> 
				<p style='font-family: sans-serif; font-size: 16px; line-height: 0.4'><b>Nome Completo: </b>$nome_completo</p>
				<p style='font-family: sans-serif; font-size: 16px; line-height: 0.4'><b>E-mail: </b>$email</p>    
				<p style='font-family: sans-serif; font-size: 16px; line-height: 0.4;'><b>Celular: </b>$celular</p>
				<p style='font-family: sans-serif; font-size: 16px; line-height: 0.4'><b>Empresa: </b>$nome_empresa</p>
				<p style='font-family: sans-serif; font-size: 16px; line-height: 0.4'><b>Instagram: </b>$instagram_empresa</p>
				<p style='font-family: sans-serif; font-size: 16px; line-height: 0.4'><b>Site: </b>$site_empresa</p>
					
			</html>
		";

		$mail->IsHTML(true);
		$mail->Body = $mailBody;		

		
		if ($mail->send()):
			echo ("Obrigado! Seu e-mail enviado com sucesso! </br>");
		else:			
			echo ("Ops, ocorreu uma falha ao enviar o e-mail: ".$mail->ErrorInfo."</br>");
			//var_dump(PHPMailer::validateAddress('luizduapi@gmail.com'));
		endif;

	else:
		echo ("O campo e-mail não possui um endereço de e-mail válido. </br>:");
		//var_dump($_POST['email']);
		//$mail->SMTPDebug = 4;
		//$mail->Debugoutput = 'html';
	endif;
?>