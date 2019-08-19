<?php 
    require '../public-includes/config.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';
/************************
      PHPMailer ********/
function sendEmail($RecipientEmail, $Nom){
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
        $mail->AltBody = 'code confirmation Email :' . $code . '';
        $mail->send();
        
        return true;
        
    } catch (Exception $e) {
        session_unset();
        header('Location: login.php');
        exit();
        return false;
    }
}