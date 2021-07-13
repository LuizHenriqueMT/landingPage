<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require './../vendor/autoload.php';	

	if (isset($_POST['email']) && !empty($_POST['email'])):
		//Variavéis
		$nome = utf8_encode($_POST['nome']);
		$email = utf8_encode($_POST['email']);
		$messagem = utf8_encode($_POST['mensagem']);

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
				<p><b>Nome: </b>$nome</p>
				<p><b>E-mail: </b>$email</p>
				<p><b>Mensagem: </b>$messagem</p>
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
		//$mail->SMTPDebug = 4;
		//$mail->Debugoutput = 'html';
	endif;
?>