<?php 
    require_once 'config.php';
    session_name('ad-sess');
    session_start();



    if(isset($_POST['function']))
        $called_function = $_POST['function'];
    else
        $called_function = $_REQUEST['function'];

    switch($called_function)
    {
        case "SupprimerCategorie":
            echo $_POST['function']($_POST['idCat']);break;
        case "AjouterCategorie":
            echo $_POST['function']($_POST['nomCat'],$_POST['descCat'],$_POST['active']);break;
        case "MiseCategorie":
            echo $_POST['function']($_POST['idCat'],$_POST['nomCat'],$_POST['descCat'],$_POST['active']);break;
        case "uploadMutiplePhotos":
            echo $_REQUEST['function']();break;
        case "AjouterArtcile":
            echo $_POST['function']($_POST['couleurs'],$_POST['artcileNom'],$_POST['articlePrix'],$_POST['articlePrixRemise'], $_POST['artcileDescription'],$_POST['tauxRemise'],$_POST['remiseDisponible'],$_POST['unitesEnStock'],$_POST['articleDisponible'],$_POST['categorieID']);break;
    }

    // catégories fonctions 

    function SupprimerCategorie($idCat){
        global $con;
        $con->query("DELETE FROM categorie WHERE categorieID = $idCat");
    }
    
    function AjouterCategorie($nomCat, $descCat, $active){
        global $con;
        $con->query("INSERT INTO categorie values(null,'$nomCat','$descCat',$active)");
    }

    function MiseCategorie($idCat, $nomCat, $descCat, $active){
        global $con;
        $con->query("UPDATE categorie SET categorieNom = '$nomCat', description = '$descCat', active = $active WHERE categorieID = $idCat");
    }

    // article fonctions
    function AjouterArtcile($couleurs, $artcileNom, $articlePrix, $articlePrixRemise, $artcileDescription, $tauxRemise, $remiseDisponible, $unitesEnStock, $articleDisponible, $categorieID){
        global $con;
        $result = $con->query("INSERT INTO article VALUES(null,'$artcileNom',$articlePrix,$articlePrixRemise,'$artcileDescription',$tauxRemise,$remiseDisponible,$unitesEnStock,default,$articleDisponible,default,$categorieID)");
        if(!$result)
        {
            // supprimer les photos si l'insertion d'article n'a pas réussi
            $random_prefix = $_SESSION['randomPrefix'];
            foreach (glob("../uploaded/".$random_prefix."*.*") as $filename) {
                unlink('../uploaded/'.$filename);
            }
        }
        else
        {
            // récupérer artcileID à partir articleNom
            $result = $con->query("SELECT * FROM article WHERE articleNom = '$artcileNom'");
            while($row = $result->fetch_row()){
                $articleID = $row[0];
            }
            // ajuter les photos si l'insertion d'article est réussi
            $random_prefix = $_SESSION['randomPrefix'];
            foreach(glob("../uploaded/".$random_prefix."*.*") as $filename)
            {
                $filenameWithoutPath = explode('/',$filename)[2];
                $con->query("INSERT INTO imagearticle VALUES('$filenameWithoutPath',$articleID)");
            }
            // ajouter couleurs du produit
            $array_couleurs = explode(',',$couleurs);
            foreach($array_couleurs as $couleur)
            {
                $con->query("INSERT INTO couleurarticle VALUES('$couleur',$articleID)");
            }
            return "<script>$('#messageAjoute').modal('toggle');</script>";
        }
    }

    function UploadMutiplePhotos()
    {
        if(is_array($_FILES)){
            $random_prefix = $_SESSION['randomPrefix']; 
            foreach($_FILES['files']['name'] as $filename => $value)
            {  
                move_uploaded_file($_FILES['files']['tmp_name'][$filename], '../uploaded/'."$random_prefix".$_FILES['files']['name'][$filename]);
                echo '<div class="photo-produit col-xs-6 col-sm-6 col-md-4 col-lg-6" style="background-image: url(../uploaded/'."$random_prefix".$_FILES['files']['name'][$filename].');"></div>';
            }
        }
    }



            
                

?>