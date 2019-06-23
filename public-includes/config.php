<?php
$dbhost="localhost";
$dbuser="root";
$dbpassword="";
$dbname="mga_db";
$con = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);
mysqli_set_charset($con, "utf8");
