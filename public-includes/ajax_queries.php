<?php 
    require_once 'config.php';
    require_once 'functions.php';
    require_once 'classes.php';
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
        case "SupprimerClient":
            echo $_POST['function']($_POST['clientID']);break;
        case "RechargerTab":
            echo $_POST['function']($_POST['categorie']);break;
        case "RechargerTabWidget":
            echo $_POST['function']($_POST['categorie']);break;
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
        $result = $con->query("INSERT INTO article VALUES(null,'$artcileNom',$articlePrix,$articlePrixRemise,'$artcileDescription',$tauxRemise,$remiseDisponible,$unitesEnStock,default,$articleDisponible,default,default,$categorieID)");
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
        // modifier ou inserer couleurs
        if($couleurs != "N/A"){
            $result2 = $con->query("UPDATE couleurarticle SET nomCouleur = '$couleurs' WHERE articleID = $articleID");
            if(!$con->affected_rows)
                $con->query("INSERT INTO couleurarticle VALUES('$couleurs',$articleID)");
        }
        // supprimer couleurs
        if($couleurs == "")
        {
            $con->query("DELETE FROM couleurarticle WHERE articleID = $articleID");
        }
            
        
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
                echo '<div class="photo-produit col-12 col-xs-6 col-sm-6 col-md-4 col-lg-6" style="background-image: url(../temp/'.$_FILES['files']['name'][$filename].');background-size:contain;background-repeat:no-repeat;background-position:center"></div>';
            }
        }
    }

    // clients fonctions
    function SupprimerClient($clientID)
    {
        global $con;
        $result = $con->query("DELETE FROM client WHERE clientID = $clientID");
        if($con->affected_rows)
            return true;
        return false;
    }
                
    // index fonctions
    function RechargerTab($categorie){
        $article = new Article();
        if($categorie != 'aleatoire')
            $res_query1 = $article->ProduitsParCategorie($categorie);
        else
            $res_query1 = $article->NouveauxProduitsAleatoire();
    
        while($row = $res_query1->fetch_assoc()){
            $imageArticle = $article->ImageArticle($row['articleID']);
            $niveau = $article->echoNiveau($row['articleID']);
            $categorieNom = CategorieNomParID($row['categorieID']);
            
            if ($row['remiseDisponible'] == true) {
                echo "<div class='product pro-tab1' style='visibility:hidden'>
                    <div class='product-img'><img src=".$imageArticle." alt=".$imageArticle.">
                        <div class='product-label'><span class='sale'>".$row['tauxRemise']."%</span><span class='new'>Nouveau</span></div>
                    </div>
                    <div class='product-body'>
                        <p class='product-category'>".$categorieNom."</p>
                        <h3 class='product-name'><a href='#'>".$row['articleNom']."</a></h3>
                        <h4 class='product-price'>".$row['articlePrixRemise']." DHS<del class='product-old-price'>". $row['articlePrix']."</del></h4>
                        <div class='product-rating'>".$niveau."</div>
                        <div class='product-btns'><button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to wishlist</span></button><button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button><button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button></div>
                    </div>
                    <div class='add-to-cart'><button class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> add to cart</button></div>
                </div>";
            }
            else
                echo "<div class='product pro-tab1' style='visibility:hidden'>
                <div class='product-img'><img src=".$imageArticle." alt=".$imageArticle.">
                    <div class='product-label'><span class='new'>Nouveau</span></div>
                </div>
                <div class='product-body'>
                    <p class='product-category'>".$categorieNom."</p>
                    <h3 class='product-name'><a href='#'>".$row['articleNom']."</a></h3>
                    <h4 class='product-price'>".$row['articlePrix']." DHS</h4>
                    <div class='product-rating'>".$niveau."</div>
                    <div class='product-btns'><button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to wishlist</span></button><button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button><button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button></div>
                </div>
                <div class='add-to-cart'><button class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> add to cart</button></div>
                </div>";
        }
    }

    function RechargerTabWidget($categorie){
        $array = array('tab1' => returnTabWidget($categorie), 'tab2' => returnTabWidget($categorie));
        return json_encode($array);
    }

