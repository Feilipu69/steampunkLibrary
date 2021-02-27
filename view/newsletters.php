<?php
/*
foreach ($subscribers as $subscriber) {
	if (isset($_POST['send'])) {
		if (!empty($_POST['title']) && !empty($_POST['message'])) {
			// adresse Mail du destinataire
			$to    = $subscriber->getEmail();

			// adresse MAIL OVH liée à l’hébergement.
			$from  = "philippe.bihin@apprenti-developpeur.fr";

			// *** Laisser tel quel

			$JOUR  = date("Y-m-d");

			$HEURE = date("H:i");



			//$Subject = "Test Mail - $JOUR $HEURE";
			$Subject = $_POST['title'];



			$mail_Data = "";

			$mail_Data .= "<html> \n";

			$mail_Data .= "<head> \n";

			$mail_Data .= "<title> Subject </title> \n";

			$mail_Data .= "</head> \n";

			$mail_Data .= "<body> \n";



			$mail_Data .= "Mail HTML simple  : <b>$Subject </b> <br> \n";

			$mail_Data .= "<br> \n";

			//$mail_Data .= "bla bla <font color=red> bla </font> bla <br> \n";

			//$mail_Data .= "Etc.<br> \n";
			$mail_Data .= $_POST['message'];

			$mail_Data .= "</body> \n";

			$mail_Data .= "</HTML> \n";



			$headers  = "MIME-Version: 1.0 \n";

			$headers .= "Content-type: text/html; charset=iso-8859-1 \n";

			$headers .= "From: $from  \n";

			$headers .= "Disposition-Notification-To: $from  \n";



			// Message de Priorité haute

			// -------------------------

			$headers .= "X-Priority: 1  \n";

			$headers .= "X-MSMail-Priority: High \n";



			$CR_Mail = TRUE;



			$CR_Mail = @mail ($to, $Subject, $mail_Data, $headers);



			if ($CR_Mail === FALSE)

			{

				echo " ### CR_Mail=$CR_Mail - Erreur envoi mail <br> \n";

			}

			else

			{

				//echo " *** CR_Mail=$CR_Mail - Mail envoyé<br> \n";
				header('Location:' . HOST . '/administration');
			}
		}
	}
}
*/
/*
foreach ($newsletters as $messages) {
	?>
	<p>Titre : <?= $messages->getTitle(); ?></p>
	<p>Message : <?= $messages->getMessage(); ?></p>
	<?php
}
*/
?>

<iframe class="mj-w-res-iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://app.mailjet.com/widget/iframe/6wGk/HS7" width="100%"></iframe>

<script type="text/javascript" src="https://app.mailjet.com/statics/js/iframeResizer.min.js"></script>
