<?php
			require 'includes/config.php';
			require 'PHPMailer/class.phpmailer.php';
			include 'PHPMailer/class.smtp.php';
			
			
			$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
			if (mysqli_connect_errno())
			{
				echo "Zlyhanie pripojenia k databaze: " . mysqli_connect_error();
			}
			
			$i = 1;
			$dotaz = "SELECT email, jazyk FROM newsletter WHERE verification=$i";
			$vysledok = mysqli_query($link, $dotaz) or die("Error: " . mysqli_error($link));
				
			$mail             = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
				//$mail->Host       = "mail.yourdomain.com"; // SMTP server
			$mail->SMTPDebug  = false;                     // enables SMTP debug information (for testing)
													   // 1 = errors and messages
													   // 2 = messages only
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 25;                   // set the SMTP port for the GMAIL server
			$mail->Username   = "webaplstuba@gmail.com";  // GMAIL username
			$mail->Password   = "STUBAfei2016";            // GMAIL password

			$mail->SetFrom('webaplstuba@gmail.com', 'Tim13');

			$mail->AddReplyTo("webaplstuba@gmail.com","Tim13");

			$mail->Subject    = "Tim 13 project RSS feed";
				
			while($riadok = mysqli_fetch_row($vysledok)){
				$email = $riadok[0];
				//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
				if($riadok[1] == en){
					$doc = new DOMDocument();
					$doc->load('xml/rssFeedSk.xml');
					$body = $doc->saveXML();		
					$mail->addAttachment('xml/rssFeedEn.xml');
				}else{
					$doc = new DOMDocument();
					$doc->load('xml/rssFeedEn.xml');
					$body = $doc->saveXML();
					$mail->addAttachment('xml/rssFeedEn.xml');
				}
				$mail->MsgHTML($body);

				$mail->AddAddress($email, "name");

				if(!$mail->Send()) {
				  echo "Mailer Error: " . $mail->ErrorInfo;
				} else {
				  header("Location: index.php");
				}
				
			}
?>