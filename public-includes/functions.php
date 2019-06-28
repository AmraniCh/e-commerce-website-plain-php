<?php 
    require 'config.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

/**************************************************************
    Send Email FUNCTION
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
    END Send Email FUNCTION
***********************************/

function CategorieNomParID($categorieID)
{
    global $con;
    $result = $con->query("SELECT categorieNom FROM categorie WHERE categorieID = $categorieID");
    while($row = $result->fetch_row())
    {
        $categorieNom = $row[0];
    }
    return $categorieNom;
}

function ArticleParID($articleID)
{
    global $con;
    $result = $con->query("SELECT * FROM article WHERE articleID = '$articleID'");
    return $result;
}

function CouleursArticle($articleID)
{
    global $con;
    $result = $con->query("SELECT nomCouleur FROM couleurarticle WHERE articleID = $articleID");
    $rows = $result->fetch_row();
    $couleurs = array();
    if($rows[0] != null){
        foreach($rows as $couleur){
            $couleurs[] = $couleur;
        }
        return $couleurs;
    }
    return null;
}

function ImagesArticle($articleID){
    global $con;
    $result = $con->query("SELECT imageArticleNom FROM imagearticle WHERE articleID = $articleID");
    return $result;
}

function upload_article_images($articleID)
{
    global $con;
    foreach(glob("../temp/*.*") as $filename)
    {
        $filenameWithoutPath = explode('/',$filename)[2];
        $con->query("INSERT INTO imagearticle VALUES('$filenameWithoutPath',$articleID)");
        // transférer les au uploaded dossier
        rename($filename, '../uploaded/articles-images/'.$filenameWithoutPath);
    }
}