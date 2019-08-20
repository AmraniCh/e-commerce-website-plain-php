<?php 
    require_once '../public-includes/config.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once '../PHPMailer/src/Exception.php';
    require_once '../PHPMailer/src/PHPMailer.php';
    require_once '../PHPMailer/src/SMTP.php';
/************************
      PHPMailer ********/
function sendEmail($RecipientEmail, $Nom){
    global $con;
    $code = null;
// Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    $mail->CharSet = "utf-8";
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
        $mail->Subject = "Confirmation d'adresse e-mail";
        
        $query = $con->query(" SELECT * FROM client WHERE email = '$RecipientEmail' ");
        if($query->num_rows > 0):
            $row = $query->fetch_assoc();
            $code = $row['codeEmail']; 
            $nom_prenom = $row['nom'].' '.$row['prenom'];
        endif;
        
        $html = '
        <html lang="fr">

        <head>
        </head>

        <body style="background-color: #fff">
            <div style="width: 100%">
                <div style="width: 50%; margin: 0 auto; background-color: #fff; ">
                    <div style="background-color: #333; color: #fff; padding: 10px; text-align: center">
                        <img src="https://i.ibb.co/qYjBP6d/logo.png">
                    </div>
                    <div style="background-color: #fff; padding: 30px 20px; text-align :center; direction: ltr;font-family:roboto">
                        <div style="margin-bottom: 30px; text-align:left">
                            Bienvenue '.$nom_prenom.' .
                        </div>

                        <div style="margin-bottom: 10px;">
                            Voici votre code de confirmation :
                        </div>

                        <div style="    margin-bottom: 25px;padding: 10px 18px;display: inline-block;color: #999;font-size: 25px;background-color: #f5f5dc;letter-spacing: 8px;">
                           '.$code.' 
                        </div>
                        
                        
                        <div style="margin-bottom: 10px; text-align: left">
                            Si vous avez rencontré des problèmes veuillez nous informer sur contact@mga.ma.<br>
                        </div>

                        <div style="margin-bottom: 10px; text-align: left">
                            Bienvenue chez M.G.A !
                        </div>

                    </div>
                </div>
            </div>
        </body>

        </html>
        ';
        
        
        $mail->Body    = $html;
        
        $mail->AltBody = 'Salut '.$nom_prenom.', Voici votre code de confirmation : '.$code;
        
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        $notification = new Notification();
        $notification::NouveauNotification('erreur', null, $mail->ErrorInfo);
        return false;
    }
}