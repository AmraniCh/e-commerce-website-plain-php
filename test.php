<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PHP Security Course</title>
  </head>
  <body>
    <?php
	  
	  require 'public-includes/config.php';

      if(isset($_POST['submit'])):
        //$user = filter_var($_POST['user'], FILTER_SANITIZE_STRING);
        echo '1 : '.$con->escape_string($_POST['user']);
        $user = htmlspecialchars($_POST['user']);
        echo '<br>'.$user;
      endif;

    ?>
    <form action="" method="post">
      <input type="text" name="user">
      <input type="submit" name="submit" value="Submit">
    </form>
  </body>
</html>
