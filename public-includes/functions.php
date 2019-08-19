<?php
    require_once 'config.php';

function RandomCategoriesNav(){
    global $con;
    $result = $con->query("SELECT categorieNom FROM categorie ORDER BY RAND() LIMIT 4");
    return $result;
}

function RandomCategoriesWidget(){
    global $con;
    $result = $con->query("SELECT categorieNom FROM categorie ORDER BY RAND() LIMIT 1");
    $row = $result->fetch_row();		
    return $row[0];
}


function echocolors($idarticle){

    global $con;
    $result = $con->query("SELECT nomCouleur FROM couleurarticle WHERE articleID = $idarticle");

    $Couleurs = '';

    while ($rows = mysqli_fetch_array($result)){
        $Couleurs = $Couleurs . '<option value="'.$rows['nomCouleur'].'">'.$rows['nomCouleur'].'</option>';

    }
    return $Couleurs;
}
