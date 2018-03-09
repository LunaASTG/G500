<?php

require_once('phpmailer/PHPMailerAutoload.php');

$toemails = array();

$toemails[] = array(
				'email' => 'g500morelia@gmail.com', // Your Email Address
				'name' => 'G500 Morelia' // Your Name
			);

// Form Processing Messages
$message_success = 'Hemos recibido tu registro con éxito. Enseguida, uno de nuestros organizadores se pondra en contacto contigo. Gracias.';

// Add this only if you use reCaptcha with your Contact Forms
$recaptcha_secret = '6LezgiEUAAAAAJsmjc5uWKUtBg9eD0dQQHJt5Uxk'; // Your reCaptcha Secret

$mail = new PHPMailer();

// If you intend you use SMTP, add your SMTP Code after this Line


if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	if( $_POST['template-contactform-email'] != '' ) {

		$name = isset( $_POST['template-contactform-name'] ) ? $_POST['template-contactform-name'] : '';
		$razon = isset( $_POST['template-contactform-razon'] ) ? $_POST['template-contactform-razon'] : '';
		$email = isset( $_POST['template-contactform-email'] ) ? $_POST['template-contactform-email'] : '';
		$phone = isset( $_POST['template-contactform-phone'] ) ? $_POST['template-contactform-phone'] : '';
		$station = isset( $_POST['template-contactform-station'] ) ? $_POST['template-contactform-station'] : '';
		$factura = isset( $_POST['template-contactform-factura'] ) ? $_POST['template-contactform-factura'] : '';
		$paquetetodo = isset( $_POST['template-contactform-paquete-todo'] ) ? $_POST['template-contactform-paquete-todo'] : ''; // Paquete Todo incluido
		$extra1 = isset( $_POST['template-contactform-extra1'] ) ? $_POST['template-contactform-extra1'] : ''; // Paquete todo acompañantes
		$hentrada = isset( $_POST['template-contactform-hentrada'] ) ? $_POST['template-contactform-hentrada'] : ''; // Hospedaje fecha de entrada
		$hsalida = isset( $_POST['template-contactform-hsalida'] ) ? $_POST['template-contactform-hsalida'] : ''; // Hospedaje fecha de salida
		$hospedaje = isset( $_POST['template-contactform-hospedaje'] ) ? $_POST['template-contactform-hospedaje'] : ''; //Hospedaje personalizado
		$extra2 = isset( $_POST['template-contactform-extra2'] ) ? $_POST['template-contactform-extra2'] : ''; // Hospedaje personalizado : Acompañantes
		$extra3 = isset( $_POST['template-contactform-extra3'] ) ? $_POST['template-contactform-extra3'] : ''; // Hospedaje personalizado : No. de Habitaciones
		$extra4 = isset( $_POST['template-contactform-extra4'] ) ? $_POST['template-contactform-extra4'] : ''; // Paquete todo acompañantes : Tipo de habitaciones
		$food = isset( $_POST['template-contactform-food'] ) ? $_POST['template-contactform-food'] : ''; // Paquete Comida asamblea y noche botanera
		$extra5 = isset( $_POST['template-contactform-extra5'] ) ? $_POST['template-contactform-extra5'] : ''; // Paquete Comida asamblea y noche botanera : No. de acompañantes.
		$extra6 = isset( $_POST['template-contactform-extra6'] ) ? $_POST['template-contactform-extra6'] : ''; // Paquete Comida asamblea y noche botanera : Nombre de acompañantes.
		$tour1 = isset( $_POST['template-contactform-tour1'] ) ? $_POST['template-contactform-tour1'] : ''; // Tour Pátzcuaro.
		$extra7 = isset( $_POST['template-contactform-extra7'] ) ? $_POST['template-contactform-extra7'] : ''; // Tour Pátzcuaro : No. de acompañantes.
		$extra8 = isset( $_POST['template-contactform-extra8'] ) ? $_POST['template-contactform-extra8'] : ''; // Tour Pátzcuaro : Nombre de acompañantes.
		$tour2 = isset( $_POST['template-contactform-tour2'] ) ? $_POST['template-contactform-tour2'] : ''; // Tour Morelia.
		$tour3 = isset( $_POST['template-contactform-tour3'] ) ? $_POST['template-contactform-tour3'] : ''; // Tour Morelia.
		$tour4 = isset( $_POST['template-contactform-tour4'] ) ? $_POST['template-contactform-tour4'] : ''; // Tour Morelia.
		$extra9 = isset( $_POST['template-contactform-extra9'] ) ? $_POST['template-contactform-extra9'] : ''; // Tour Morelia : No. de acompañantes
		$extra10 = isset( $_POST['template-contactform-extra10'] ) ? $_POST['template-contactform-extra10'] : ''; // Tour Morelia : Nombre de acompañantes.
		$message = isset( $_POST['template-contactform-message'] ) ? $_POST['template-contactform-message'] : '';

		$subject = isset($subject) ? $subject : 'Nuevo registro Grupo G500';

		$botcheck = $_POST['template-contactform-botcheck'];

		if( $botcheck == '' ) {

			$mail->SetFrom( $email , $name );
			$mail->AddReplyTo( $email , $name );
			foreach( $toemails as $toemail ) {
				$mail->AddAddress( $toemail['email'] , $toemail['name'] );
			}
			$mail->Subject = $subject;

			$name = isset($name) ? "Nombre Completo: $name<br><br>" : '';
			$razon = isset($razon) ? "Empresa / Razón social: $razon<br><br>" : '';
			$email = isset($email) ? "Correo: $email<br><br>" : '';
			$phone = isset($phone) ? "Teléfono: $phone<br><br>" : '';
			$station = isset($station) ? "No. de Estación de Servicio: $station<br><br>" : '';
			$factura = isset($factura) ? "Factura: $factura<br><br>" : '';
			$paquetetodo = isset($paquetetodo) ? "Paquete Todo Incluído: $paquetetodo<br><br>" : '';
			$extra1 = isset($extra1) ? "Nombre(s) de acompañante: $extra1<br><br>" : '';
			$hentrada = isset($hentrada) ? "Hospedaje, fecha de entrada: $hentrada<br><br>" : '';
			$hsalida = isset($hsalida) ? "Hospedaje, fecha de salida: $hsalida<br><br>" : '';
			$hospedaje = isset($hospedaje) ? "Hospedaje personalizado (1=No, 2=Sí): $hospedaje<br><br>" : '';
			$extra2 = isset($extra2) ? "No. de acompañantes: $extra2<br><br>" : '';
			$extra3 = isset($extra3) ? "No. de habitaciones: $extra3<br><br>" : '';
			$extra4 = isset($extra4) ? "Tipo de habitación: $extra4<br><br>" : '';
			$food = isset($food) ? "Paquete Individual, Comida Asamblea y Noche Botanera (1=No, 2=Sí): $food<br><br>" : '';
			$extra5 = isset($extra5) ? "No. de acompañantes: $extra5<br><br>" : '';
			$extra6 = isset($extra6) ? "Nombres de acompañantes: $extra6<br><br>" : '';
			$tour1 = isset($tour1) ? "Paquete Individual, Tour Pátzcuaro (1=No, 2=Sí): $tour1<br><br>" : '';
			$extra7 = isset($extra7) ? "No. de acompañantes: $extra7<br><br>" : '';
			$extra8 = isset($extra8) ? "Nombres de acompañantes: $extra8<br><br>" : '';
			$tour2 = isset($tour2) ? "Paquete Individual, Tour Morelia (1=No, 2=Sí): $tour2<br><br>" : '';
			$tour3 = isset($tour3) ? "Tipo Tour Morelia (23 JUNIO): $tour3<br><br>" : '';
			$tour4 = isset($tour4) ? "Tipo Tour Morelia (24 JUNIO): $tour4<br><br>" : '';
			$extra9 = isset($extra9) ? "No. de acompañantes: $extra9<br><br>" : '';
			$extra10 = isset($extra10) ? "Nombres de acompañantes: $extra10<br><br>" : '';
			$message = isset($message) ? "Dudas y comentarios: $message<br><br>" : '';

			$referrer = $_SERVER['HTTP_REFERER'] ? '<br><br><br>Este registro se hizo desde: ' . $_SERVER['HTTP_REFERER'] : '';

			$body = "$name $razon $email $phone $station $factura $paquete $extra1 $hentrada $hsalida $hospedaje $food $extra5 $extra6 $tour1 $extra7 $extra8 $tour2 $tour3 $tour4 $extra9 $extra10 $message $referrer";

			// Runs only when File Field is present in the Contact Form
			if ( isset( $_FILES['template-contactform-file'] ) && $_FILES['template-contactform-file']['error'] == UPLOAD_ERR_OK ) {
				$mail->IsHTML(true);
				$mail->AddAttachment( $_FILES['template-contactform-file']['tmp_name'], $_FILES['template-contactform-file']['name'] );
			}

			// Runs only when reCaptcha is present in the Contact Form
			if( isset( $_POST['g-recaptcha-response'] ) ) {
				$recaptcha_response = $_POST['g-recaptcha-response'];
				$response = file_get_contents( "https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $recaptcha_response );

				$g_response = json_decode( $response );

				if ( $g_response->success !== true ) {
					echo '{ "alert": "error", "message": "Captcha not Validated! Please Try Again." }';
					die;
				}
			}

			$mail->MsgHTML( $body );
			$sendEmail = $mail->Send();

			if( $sendEmail == true ):
				echo '{ "alert": "success", "message": "' . $message_success . '" }';
			else:
				echo '{ "alert": "error", "message": "Email <strong>could not</strong> be sent due to some Unexpected Error. Please Try Again later.<br /><br /><strong>Reason:</strong><br />' . $mail->ErrorInfo . '" }';
			endif;
		} else {
			echo '{ "alert": "error", "message": "Bot <strong>Detected</strong>.! Clean yourself Botster.!" }';
		}
	} else {
		echo '{ "alert": "error", "message": "Please <strong>Fill up</strong> all the Fields and Try Again." }';
	}
} else {
	echo '{ "alert": "error", "message": "An <strong>unexpected error</strong> occured. Please Try Again later." }';
}

?>
