<?php
	// Inicia comprobación de claves para controlar que sean las registradas.
	if(isset($_POST["g-recaptcha-response"])) {
		$gSecret = "6LcDOfwUAAAAABBQJVSnOITd7TeedjTz5y9ufC13";
		$uResponse = $_POST["g-recaptcha-response"];
		$gUrl = "https://www.google.com/recaptcha/api/siteverify";
		$forResponse = file_get_contents($gUrl."?secret=".$gSecret."&response=".$uResponse);
		$gObjectResponse = json_decode($forResponse);
		
		//Da respuesta a la comprobación previa por ser correcta o no.
		if($gObjectResponse->success) {
			//Si son correctas las claves inicia el proceso de envío en este caso.
			
			if(!empty($_POST)) { //Si vienen variables enviadas por post ingresa a la construcción del correo.
				require("class.phpmailer.php");
				require("class.smtp.php");
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->Host = "smtp.oops-web.com.ar"; // Servidor de correo saliente. Usar el de nuestro dominio a futuro.
				$mail->Username = "multimedia-umrc@oops-web.com.ar"; // Cuenta de correo real correspondiente al smtp
				$mail->Password = "UM1234rc2024"; // Contraseña de nuestra cuenta previa
				$mail->Port = 587; // Puerto habilitado para el smtp (provisto por el gestor del hosting)
				$mail->From = "multimedia-umrc@oops-web.com.ar"; // Desde donde se envía. Debe ser un correo real validado previamente (host, user, pass y port)
				$mail->FromName = "Multimedia RC"; // Nombre que se asocia a la cuenta previa.
				//$mail->AddAddress("alumno@um.edu.ar"); // A donde envía
				
				$mail->AddCC("pablo.navarro@um.edu.ar"); // Con copia a...
				
				$mail->AddReplyTo($_POST['email'], $_POST['name-p']); // Respuesta a...
				$mail->IsHTML(true); // Habilita formato HTML
				$mail->Subject = "Consulta web"; // Asunto
				
				//Inicia el contendio del correo
				$contenido = 'Se ha realizado una consulta con los siguientes datos:<br />';
				$contenido .= '<b>Nombre y Apellido:</b> '.$_POST['name-p'].'<br /><br />';
				$contenido .= '<b>Empresa:</b> '.$_POST['business-n'].'<br /><br />';
				$contenido .= '<b>Celular:</b> '.$_POST['cel-number'].'<br /><br />';
				$contenido .= '<b>E-Mail:</b> '.$_POST['email'].'<br /><br />';
				$contenido .= '<b>Nacionalidad:</b> '.$_POST['country'].'<br /><br />';
				$contenido .= '<b>Consulta:</b><br /><br />';
				$contenido .= $_POST['coment'].'<br /><br /><br />';
				
				$mail->Body = $contenido; // Mensaje a enviar
				//Finaliza el armado del correo.
				
				//$mail->AddAttachment("downloads/lg3D.jpg", "lg3D.jpg"); //Esta línea adjunta un archivo alojado en el servidor
				$exito = $mail->Send(); // Envía el correo.
				unset($_POST['']); //Destuye variables como para que no vuelva a ingresar a este if si se recargara la página
				
				echo "<script language='javascript'>location.href='enviook.html';</script>"; // Nos lleva a otro archivo. Modificar el nombre del archivo (enviook.html) en el cual le comentamos al usuario que su correo fue enviado.
			};
			
		} else {
			//En caso que no sean correctas las claves del recapcha realiza lo siguiente
			echo '<script language="javascript">alert("Falta tildar No soy un robot")</script>'; //Nos larga un cartel de alerta indicando que no tildamos la casilla
			echo '<script language="javascript">history.back()</script>'; //Vuelve al archivo del formulario
		};
	};
?>