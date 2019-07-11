<?php 
    require_once 'config.php';
    require_once 'functions.php';
    require_once 'classes.php';
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
            echo $_POST['function']($_POST['couleurs'],$_POST['articleNom'],$_POST['articlePrix'],$_POST['articlePrixRemise'], $_POST['artcileDescription'],$_POST['articleMarque'],$_POST['tauxRemise'],$_POST['remiseDisponible'],$_POST['unitesEnStock'],$_POST['articleDisponible'],$_POST['categorieID']);break;
        case "SupprimerArticle":
            echo $_POST['function']($_POST['articleID']);break;
        case "ModifierArticle":
            echo $_POST['function']($_POST['couleurs'],$_POST['articleID'],$_POST['articleNom'],$_POST['articlePrix'],$_POST['articlePrixRemise'], $_POST['artcileDescription'],$_POST['articleMarque'],$_POST['tauxRemise'],$_POST['remiseDisponible'],$_POST['unitesEnStock'],$_POST['articleDisponible'],$_POST['categorieID']);break;
        case "SupprimerClient":
            echo $_POST['function']($_POST['clientID']);break;
        case "RechargerTab":
            echo $_POST['function']($_POST['categorie']);break;
        case "RechargerTabWidget":
            echo $_POST['function']($_POST['categorie']);break;
        case "AjouterAuPanier":
            echo $_POST['function']($_POST['articleID']);break;
        case "SupprimerAuPanier":
            echo $_POST['function']($_POST['articleID']);break;
        case "RemplirPanier":
            echo $_POST['function']();break;
        case "AfficherMarquesFilter":
            echo $_POST['function']($_POST['categoriesIDs']);break;
        case "AfficherProduitsFilter":
            echo $_POST['function']($_POST['categoriesIDs'], $_POST['marques'], $_POST['minPrix'], $_POST['maxPrix']);break;
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
    function AjouterArtcile($couleurs, $artcileNom, $articlePrix, $articlePrixRemise, $artcileDescription, $articleMarque, $tauxRemise, $remiseDisponible, $unitesEnStock, $articleDisponible, $categorieID){
        global $con;
        $result = $con->query("INSERT INTO article VALUES(null,'$artcileNom',$articlePrix,$articlePrixRemise,'$artcileDescription','$articleMarque',$tauxRemise,$remiseDisponible,$unitesEnStock,default,$articleDisponible,default,default,$categorieID)");
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

    function ModifierArticle($couleurs, $articleID, $articleNom, $articlePrix, $articlePrixRemise, $artcileDescription, $articleMarque, $tauxRemise, $remiseDisponible, $unitesEnStock, $articleDisponible, $categorieID){
        global $con;
        $result = $con->query("UPDATE article SET articleNom = '$articleNom', articlePrix = $articlePrix, articlePrixRemise = $articlePrixRemise, articleDescription = '$artcileDescription', articleMarque = '$articleMarque', tauxRemise = $tauxRemise, remiseDisponible = $remiseDisponible, unitesEnStock = $unitesEnStock, articleDisponible = $articleDisponible, categorieID = $categorieID WHERE articleID = $articleID");
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
    function RechargerTab($categorieNom){
        $article = new Article();
        $categorie = new Categorie();
        if($categorieNom != 'aleatoire')
            $query = $article->ProduitsParCategorie($categorieNom);
        else
            $query = $article->NouveauxProduitsAleatoire();
    
        if($query != null){
            while($row = $query->fetch_assoc()){
                $imageArticle = $article->ImageArticle($row['articleID']);
                $niveau = $article->echoNiveau($row['articleID']);
                $categorieNom = $categorie->CategorieNomParID($row['categorieID']);

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
                        <div class='add-to-cart'><button id=".$row['articleID']." class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Ajouter au panier</button></div>
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
                    <div class='add-to-cart'><button id=".$row['articleID']." class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Ajouter au panier</button></div>
                    </div>";
            }
        }
    }

    function RechargerTabWidget($categorie){
        global $con;
        $array = array('tab1' => returnTabWidget($con->escape_string($categorie)), 'tab2' => returnTabWidget($con->escape_string($categorie)));
        return json_encode($array);
    }

    
    // fonction générales
    function RemplirPanier(){
        $json = array();
        if(isset($_SESSION['clientID'])){
            $article = new Article();
            $panier = new Panier();
            $query = $panier->AfficherPanierProduits($_SESSION['clientID']);
            $prix_total = 0;
            $html = '';
            while($row = $query->fetch_assoc()){
                $imageArticle = $article->ImageArticle($row['articleID']);
                
                if($row['remiseDisponible']){
                    $prix_total += $row['articlePrixRemise'] * $row['NbrArticlesPanier'];
                    $prix = $row['articlePrixRemise'];
                }
                else{
                    $prix_total += $row['articlePrix'] * $row['NbrArticlesPanier'];
                    $prix = $row['articlePrix'];
                }
                $html.= '<div id="'.$row['articleID'].'" class="product-widget">
                    <div class="product-img">
                        <img src="'.$imageArticle.'" alt="">
                    </div>
                    <div class="product-body" style="text-align:left">
                        <h3 class="product-name"><a href="#">'.$row['articleNom'].'</a></h3>
                        <h4 class="product-price"><span class="qty">'.$row['NbrArticlesPanier'].'x</span>'.$prix.'</h4>
                    </div>
                    <button id="'.$row['articleID'].'" class="delete supp-panier"><i class="fa fa-close"></i></button>
                </div>';
            }
            $client = new client();
            $clientID = $_SESSION['clientID'];
            $json['prixTotal'] = $prix_total;
            $json['data'] = $html;
            $json['qty-panier'] = $client->NbrArticlesPanier($clientID);
            return json_encode($json);
        }
        else{
            $json['prixTotal'] = 0;
            $json['data'] = 'Votre panier est vide. Aller faire les courses!';
            $json['qty-panier'] = 0;
            return json_encode($json);
        }
    }

    function AjouterAuPanier($articleID)
    {
        if(!isset($_SESSION['clientID']))
            return json_encode(false);
        global $con;
        $clientID = $_SESSION['clientID'];
        $articleID = $con->escape_string($articleID);
        $query = $con->query("INSERT INTO panierDetails VALUES(null,$clientID,$articleID)");
        if($con->affected_rows){
            $client = new client();
            return json_encode($client->NbrArticlesPanier($clientID));
        }
    }

    function SupprimerAuPanier($articleID){
        global $con;
        $clientID = $_SESSION['clientID'];
        $query = $con->query("DELETE FROM panierDetails WHERE articleID = $articleID AND clientID = $clientID");
        if($con->affected_rows)
            return json_encode(true);
        else
            return json_encode(false);
    }

    // store functions
    function AfficherMarquesFilter($categoriesIDs){
        global $con;
        $article = new Article();
        $ids = implode(',',json_decode($categoriesIDs));
        if($ids != '')
        {
            $query = $con->query("SELECT DISTINCT articleMarque FROM article WHERE categorieID IN($ids)");
            while($row = $query->fetch_row()){
                $nbr_produits = $article->NbrProduitsParMarque($row[0]);
                if($row[0] != ''){
                    echo '<div class="input-checkbox">
                            <input class="marque-check" type="checkbox" id="'.$row[0].'">
                            <label for="'.$row[0].'">
                                <span></span>
                                '.$row[0].'
                                <small>'.$nbr_produits.'</small>
                            </label>
                        </div>';
                }
            }
        }
       
    }

    function AfficherProduitsFilter($categoriesIDs, $marques, $minPrix, $maxPrix){
        global $con;
        $article = new Article();
        $categorie = new Categorie();
        $marques_implode = implode(',', json_decode($marques));
        $categoriesIDs_implode = implode(',', json_decode($categoriesIDs));
        $categoriesIDs_array = explode(',',$categoriesIDs_implode);
        $query_string = "SELECT * FROM article WHERE (articlePrix BETWEEN $minPrix AND $maxPrix OR articlePrixRemise BETWEEN $minPrix AND $maxPrix)";
        
        if(!in_array('-1',$categoriesIDs_array)) // pas tous
            $query_string.= "AND categorieID IN($categoriesIDs_implode)";
        if($marques_implode != '')
            $query_string.= "AND articleMarque IN('$marques_implode')";
        
            $query = $con->query($query_string);
        if($query->num_rows > 0){
            while($row = $query->fetch_array())
            {
                $imageArticle = $article->ImageArticle($row['articleID']);
                $niveau = $article->echoNiveau($row['articleID']);
                $categorieNom = $categorie->CategorieNomParID($row['categorieID']);
                if ($row['remiseDisponible'] == true) {
                    echo "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-4'>
                        <div class='product pro-tab1'>
                            <div class='product-img no-slick-product' style='background-image:url($imageArticle)'>
                                <div class='product-label'><span class='sale'>".$row['tauxRemise']."%</span><span class='new'>Nouveau</span></div>
                            </div>
                            <div class='product-body'>
                                <p class='product-category'>".$categorieNom."</p>
                                <h3 class='product-name'><a href='#'>".$row['articleNom']."</a></h3>
                                <h4 class='product-price'>".$row['articlePrixRemise']." DHS<del class='product-old-price'>". $row['articlePrix']."</del></h4>
                                <div class='product-rating'>".$niveau."</div>
                                <div class='product-btns'><button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to wishlist</span></button><button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button><button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button></div>
                            </div>
                            <div class='add-to-cart'><button id=".$row['articleID']." class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Ajouter au panier</button></div>
                        </div>
                    </div>";
                }
                else
                    echo "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-4'>
                        <div class='product pro-tab1'>
                            <div class='product-img no-slick-product' style='background-image:url($imageArticle)'>
                                <div class='product-label'><span class='new'>Nouveau</span></div>
                            </div>
                            <div class='product-body'>
                                <p class='product-category'>".$categorieNom."</p>
                                <h3 class='product-name'><a href='#'>".$row['articleNom']."</a></h3>
                                <h4 class='product-price'>".$row['articlePrix']." DHS</h4>
                                <div class='product-rating'>".$niveau."</div>
                                <div class='product-btns'><button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to wishlist</span></button><button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button><button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button></div>
                            </div>
                            <div class='add-to-cart'><button id=".$row['articleID']." class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Ajouter au panier</button></div>
                        </div>
                    </div>";
            }
        }
        else 
            return '';
    }

