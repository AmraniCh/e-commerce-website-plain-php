<?php 
    session_name('ad-sess');
    session_start();
    session_destroy();
    header('location: ../login.php');
?>