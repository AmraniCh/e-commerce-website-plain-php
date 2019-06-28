<?php 
    require_once 'config.php';
    require_once 'functions.php';
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
            echo $_POST['function']($_POST['couleurs'],$_POST['articleNom'],$_POST['articlePrix'],$_POST['articlePrixRemise'], $_POST['artcileDescription'],$_POST['tauxRemise'],$_POST['remiseDisponible'],$_POST['unitesEnStock'],$_POST['articleDisponible'],$_POST['categorieID']);break;
        case "SupprimerArticle":
            echo $_POST['function']($_POST['articleID']);break;
        case "ModifierArticle":
            echo $_POST['function']($_POST['couleurs'],$_POST['articleID'],$_POST['articleNom'],$_POST['articlePrix'],$_POST['articlePrixRemise'], $_POST['artcileDescription'],$_POST['tauxRemise'],$_POST['remiseDisponible'],$_POST['unitesEnStock'],$_POST['articleDisponible'],$_POST['categorieID']);break;
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
        // récupérer artcileID à partir articleNom
        $result = $con->query("SELECT * FROM article WHERE articleNom = '$artcileNom'");
        while($row = $result->fetch_row()){
            $articleID = $row[0];
        }
        // ajouter les photos si l'insertion d'article est réussi
        foreach(glob("../temp/*.*") as $filename)
        {
            $filenameWithoutPath = explode('/',$filename)[2];
            $con->query("INSERT INTO imagearticle VALUES('$filenameWithoutPath',$articleID)");
            // transférer les au uploaded dossier
            rename($filename, '../uploaded/articles-images/'.$filenameWithoutPath);
        }
        // ajouter couleurs du produit
        $array_couleurs = explode(',',$couleurs);
        if($array_couleurs[0] != null){
            foreach($array_couleurs as $couleur)
            {
                $con->query("INSERT INTO couleurarticle VALUES('$couleur',$articleID)");
            }
        }
        return true; //ajax return data
    }

    function SupprimerArticle($articleID){
        global $con;
        $result = $con->query("DELETE FROM article WHERE articleID = $articleID");
        return ($result) ? true : false;
    }

    function ModifierArticle($couleurs, $articleID, $articleNom, $articlePrix, $articlePrixRemise, $artcileDescription, $tauxRemise, $remiseDisponible, $unitesEnStock, $articleDisponible, $categorieID){
        global $con;
        $result = $con->query("UPDATE article SET articleNom = '$articleNom', articlePrix = $articlePrix, articlePrixRemise = $articlePrixRemise, articleDescription = '$artcileDescription', tauxRemise = $tauxRemise, remiseDisponible = $remiseDisponible, unitesEnStock = $unitesEnStock, articleDisponible = $articleDisponible, categorieID = $categorieID WHERE articleID = $articleID");
        // modifier couleurs
        $result2 = $con->query("UPDATE couleurarticle SET nomCouleur = '$couleurs' WHERE articleID = $articleID");
        
        foreach(glob("../temp/*.*") as $filename)
        {
            $filenameWithoutPath = explode('/',$filename)[2];
            $con->query("INSERT INTO imagearticle VALUES('$filenameWithoutPath',$articleID)");
            // transférer les au uploaded dossier
            rename($filename, '../uploaded/articles-images/'.$filenameWithoutPath);
        }
        
        return ($result) ? true : false;
    }

    function UploadMutiplePhotos(){
        if(is_array($_FILES)){
            foreach($_FILES['files']['name'] as $filename => $value)
            {  
                move_uploaded_file($_FILES['files']['tmp_name'][$filename], '../temp/'.$_FILES['files']['name'][$filename]);
                echo '<div class="photo-produit col-12 col-xs-6 col-sm-6 col-md-4 col-lg-6" style="background-image: url(../temp/'.$_FILES['files']['name'][$filename].');"></div>';
            }
        }
    }


            
                

?>