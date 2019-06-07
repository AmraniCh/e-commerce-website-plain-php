<?php 
    require_once 'config.php';
    
    $called_function = $_POST['function'];
    switch($called_function)
    {
        case "deleteCategorie":
            echo $_POST['function']($_POST['idCat']);break;
        case "addCategorie":
            echo $_POST['function']($_POST['nomCat'],$_POST['descCat'],$_POST['active']);break;
        case "updateCategorie":
            echo $_POST['function']($_POST['idCat'],$_POST['nomCat'],$_POST['descCat'],$_POST['active']);break;
    }

    function deleteCategorie($idCat){
        global $con;
        $con->query("DELETE FROM categorie WHERE categorieID = $idCat");
    }
    
    function addCategorie($nomCat, $descCat, $active){
        global $con;
        $con->query("INSERT INTO categorie values(null,'$nomCat','$descCat',$active)");
    }

    function updateCategorie($idCat, $nomCat, $descCat, $active){
        global $con;
        $con->query("UPDATE categorie SET categorieNom = '$nomCat', description = '$descCat', active = $active WHERE categorieID = $idCat");
    }

?>