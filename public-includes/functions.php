<?php 

    require 'config.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

/**************************************************************
    Email fucntion
**************************************************************/
function sendEmail($RecipientEmail,$Nom)
{
    global $con;
    $code = null;

// Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'mgaservicegroup@gmail.com';                     // SMTP username
        $mail->Password   = '123456789Kamal';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('MGAnoreply@example.com', 'M.G.A service');
        $mail->addAddress($RecipientEmail, $Nom);     // Add a recipient
        //$mail->addReplyTo('info@example.com', 'Information');

        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "Confirmation";

        $sql = "select codeEmail from client where email='$RecipientEmail'";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $code = $row["codeEmail"];
            }
        }

        /////////Message body (html)/////////
        $mail->Body    = 'code confirmation Email : <b>' . $code . '</b>';


        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


/***********************************
    END files FUNCTIONS
***********************************/

?>