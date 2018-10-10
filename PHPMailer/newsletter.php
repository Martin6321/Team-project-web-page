<?php
	if(isset($_POST['subscribe'])){
			require 'config.php';
			require 'PHPMailer/class.phpmailer.php';
			include 'PHPMailer/class.smtp.php';
			
			$email = $_POST['email'];
			
			$db_name = "project13";
			
			link = mysqli_connect("$db_host","$db_user","$db_pwd","$db_name");
			if (mysqli_connect_errno())
			{
				echo "Zlyhanie pripojenia k databaze: " . mysqli_connect_error();
			}
			
			$dotaz = "SELECT email FROM newsletter WHERE email='$email'";
			$vysledok = mysqli_query($link, $dotaz) or die("Error: " . mysqli_error($link));
			
			if(mysqli_num_rows($vysledok) > 0){
				header("Location: actualities.php");
			}else{
				$verif = 0;
				$dotaz = "INSERT INTO newsletter SET email='$email', verification=$verif";
				mysqli_query($link, $dotaz) or die("Error: " . mysqli_error($link));
				
				$dotaz = "SELECT sec_key FROM security_key";
				$vysledok = mysqli_query($link, $dotaz) or die("Error: " . mysqli_error($link));
				
				$pocet = mysqli_num_rows($vysledok) - 1;
				$id_key = rand(0, $pocet);
				
				$security = "seckey";
				
				while($riadok = mysqli_fetch_row($vysledok)){
					if($id_key == 0){
						$security = $riadok[0];
					}else{
						$id_key = $id_key - 1;
					}
				}

				$mail             = new PHPMailer();

				$body             = "http://147.175.98.152/projekt/verif.php?type="."$security&email="."$email";

				$mail->IsSMTP(); // telling the class to use SMTP
				//$mail->Host       = "mail.yourdomain.com"; // SMTP server
				$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
													   // 1 = errors and messages
													   // 2 = messages only
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
				$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
				$mail->Port       = 25;                   // set the SMTP port for the GMAIL server
				$mail->Username   = "webaplstuba@gmail.com";  // GMAIL username
				$mail->Password   = "STUBAfei2016";            // GMAIL password

				$mail->SetFrom('webaplstuba@gmail.com', 'First Last');

				$mail->AddReplyTo("webaplstuba@gmail.com","First Last");

				$mail->Subject    = "Verification";

				$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

				$mail->MsgHTML($body);

				//$address = "$email";
				$mail->AddAddress($email, "name");

				if(!$mail->Send()) {
				  echo "Mailer Error: " . $mail->ErrorInfo;
				} else {
				  header("Location: index.php");
				}
				
			}
	}
	else if(isset($_POST['unsubscribe'])){
		echo("non-implementet");
	}
?>