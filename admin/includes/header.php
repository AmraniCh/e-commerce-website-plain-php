<?php
    ob_start();
	session_start();
    require_once '../public-includes/config.php';
    require_once '../public-includes/classes.php';
    require_once "includes/statistiques.class.php";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>M.G.A Dashboard</title>
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="../index/css/mainstyle.css">
  <link rel="stylesheet" href="../index/css/animation.css">
  <link rel="shortcut icon" href="images/favicon.png" />
  <script src="../index/js/jquery.min.js"></script>
</head>

<body>
