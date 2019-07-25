<?php 
    require_once 'config.php';
    require_once 'functions.php';
    require_once 'classes.php';
    session_start();

    if($_SERVER['REQUEST_METHOD'] == "POST"):

        static $static_page_nbr = 1;

        if(isset($_POST['function']))
            $called_function = $_POST['function'];
        else
            $called_function = $_REQUEST['function'];

    endif;

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
            
        case "AfficherMarquesFiltrer":
            echo $_POST['function']($_POST['categoriesIDs']);break;
            
        case "AfficherProduitsFiltrer":
            echo $_POST['function']($_POST['categoriesIDs'], $_POST['marques'], $_POST['minPrix'], $_POST['maxPrix'],$_POST['filtrerPar'],$_POST['afficherNbr'],$_POST['page_nbr']);break;
            
        case "StorePagination":
            echo $_POST['function']($_POST['categoriesIDs'],$_POST['marques'],$_POST['minPrix'],$_POST['maxPrix'],$_POST['filtrerPar'],$_POST['afficherNbr']);break;
            
        case "returnTabWidget":
            echo $_POST['function']($_POST['categorie']);break;
            
        case "RemplirFavoris":
            echo $_POST['function']();break;
            
        case "AjouterAuxFavoris":
            echo $_POST['function']($_POST['articleID']);break;
            
        case "SupprimerAuxFavoris":
            echo $_POST['function']($_POST['articleID']);break;
            
        case "AucunFavoriTrouve":
            echo $_POST['function']();break;
            
        case "RemplirPagePanier":
            echo $_POST['function']();break;
            
        case "IncrementArticleQtyPanier":
            echo $_POST['function']($_POST['articleID'],$_POST['qty']);break;
            
    }

    // global functions
    function RemplirPanier(){
        if(isset($_SESSION['clientID'])){
            
            $clientID = $_SESSION['clientID'];
            
            $client = new Client();
            $article = new Article();
            $panier = new Panier();
            
            $query = $panier->AfficherPanierProduits();
            if($query != null)
            {
                $data = array();
                $sub_total = 0;
                $promotion = 0;
                while($row = $query->fetch_assoc()){
                    
                    $imageArticle = $article->ImageArticle($row['articleID']);
                    
                    if($row['remiseDisponible']){
                        $prixRemise = $row['articlePrixRemise'] * $row['quantite'];
                        $sub_total += $row['articlePrixRemise'] * $row['quantite'];
                    }
                    else
                        $sub_total += $row['articlePrix'] * $row['quantite'];
                        
            
                    $prix = $row['articlePrix'] * $row['quantite'];
                    
                    
                    $data[] = ['articleID' => $row['articleID'], 'imageArticle' => $imageArticle, 'articleNom' => $row['articleNom'], 'prix' => $prix, 'remiseDisponible' => $row['remiseDisponible'], 'prixRemise' => $prixRemise, 'quantite' => $row['quantite']];
                }
                
                $nbr_article = $client->NbrArticlesPanier($clientID);
                array_push($data, $sub_total, $nbr_article);
                return json_encode($data);
            }
            else
                return json_encode(null);
        }
        else
            return json_encode(null);
    }
    
    function AjouterAuPanier($articleID){
        global $con;
        
        if(!isset($_SESSION['clientID']))
            return json_encode(false);
        
        $client = new Client();
        $panierID = $client->PanierClient();
        
        // vérifier si l'article est déja existe
        if($client->ArticlePanierExiste($articleID) == null && $panierID != null):
        
            $query = $con->query("INSERT INTO panierDetails VALUES($panierID,$articleID,default,default)");
        
        endif;
        
        if($con->affected_rows):
            $client = new client();
            return json_encode($client->NbrArticlesPanier());
        endif;
                
        return json_encode(false);
    }

    function SupprimerAuPanier($articleID){
        global $con;
        $clientID = filter_var($_SESSION['clientID'], FILTER_SANITIZE_NUMBER_INT);
        $query = $con->query("DELETE FROM panierDetails WHERE articleID = $articleID");
        if($con->affected_rows)
            return json_encode(true);
        return json_encode(false);
    }

    function RemplirFavoris(){
        if(isset($_SESSION['clientID'])){
            $article = new Article();
            $favori = new Favori();
            $query = $favori->AfficherProduitsFavoris();
            if($query != null)
            {
                $data = array();
                while($row = $query->fetch_assoc()){
                    $imageArticle = $article->ImageArticle($row['articleID']);

                    if($row['remiseDisponible']):
                        $prix = $row['articlePrixRemise'];
                    else:
                        $prix = $row['articlePrix'];
                    endif;
                    
                    $data[] = ['articleID' => $row['articleID'], 'imageArticle' => $imageArticle, 'articleNom' => $row['articleNom'], 'prix' => $prix];
                }
                $client = new client();
                $clientID = $_SESSION['clientID'];
                array_push($data, $client->NbrArticlesFavoris($clientID));
                return json_encode($data);
            }
            else
                return json_encode(null);
        }
        else
            return json_encode(null);
    }

    function AjouterAuxFavoris($articleID){
        global $con;
        if(!isset($_SESSION['clientID']))
            return json_encode(false);
        $clientID = $_SESSION['clientID'];
        $query = $con->query("INSERT INTO favoridetails VALUES($articleID,$clientID,default)");
        if($con->affected_rows){
            $client = new client();
            return json_encode($client->NbrArticlesFavoris($clientID));
        }
    }

    function SupprimerAuxFavoris($articleID){
        global $con;
        $clientID = $_SESSION['clientID'];
        $query = $con->query("DELETE FROM favoridetails WHERE articleID = $articleID AND clientID = $clientID");
        if($con->affected_rows)
            return json_encode(true);
        return json_encode(false);
    }

    // categories.php functions 
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

    // produit.php functions
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
                $clr = ucfirst(trim($couleur));
                if($clr != '')
                    $con->query("INSERT INTO couleurarticle VALUES('$clr',$articleID)");
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
            /*$result2 = $con->query("UPDATE couleurarticle SET nomCouleur = '$couleurs' WHERE articleID = $articleID");
            if(!$con->affected_rows){
                $con->query("INSERT INTO couleurarticle VALUES('$couleurs',$articleID)");*/
                $couleurs_array = explode(",",$couleurs);
                $query = $con->query("SELECT nomCouleur FROM couleurarticle WHERE articleID = $articleID");
                if($query->num_rows > 0):
                    while($row = $query->fetch_row()){
                        foreach($couleurs_array as $couleur)
                        {
                            if(strtolower($couleur) != strtolower($row[0])):
                                $clr = ucfirst(trim($couleur));
                                if($clr != '')
                                    $con->query("INSERT INTO couleurarticle VALUES('$clr',$articleID)");
                            endif;
                        }
                    }
                else:
                    foreach($couleurs_array as $couleur)       
                    {    
                        $clr = ucfirst(trim($couleur));
                        if($clr != '')
                            $con->query("INSERT INTO couleurarticle VALUES('$clr',$articleID)");
                    }
                endif;
        }
        // supprimer couleurs
        if($couleurs == "")
            $con->query("DELETE FROM couleurarticle WHERE articleID = $articleID");
    
            
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

    // clients.php functions
    function SupprimerClient($clientID){
        global $con;
        $result = $con->query("DELETE FROM client WHERE clientID = $clientID");
        if($con->affected_rows)
            return true;
        return false;
    }
                
    // index functions
    function RechargerTab($categorieNom){
        $article = new Article();
        $categorie = new Categorie();
        if($categorieNom != 'aleatoire')
            $query = $article->ProduitsParCategorie($categorieNom);
        else
            $query = $article->NouveauxProduitsAleatoire();
    
        if($query != null){
            $data = array();
            while($row = $query->fetch_assoc()){
                $imageArticle = $article->ImageArticle($row['articleID']);
                $niveau = $article->echoNiveau($row['articleID']);
                $categorieNom = $categorie->CategorieNomParID($row['categorieID']);
                
                $data[] = ['imageArticle' => $imageArticle, 'niveau' => $niveau, 'categorieNom' => $categorieNom, 'remiseDisponible' => $row['remiseDisponible'], 'tauxRemise' => $row['tauxRemise'], 'articleNom' => $row['articleNom'], 'articlePrixRemise' => $row['articlePrixRemise'], 'articlePrix' => $row['articlePrixRemise'], 'articleID' => $row['articleID']];
            } 
            return json_encode($data);
        }
        else
            return json_encode(null);
    }

    function RechargerTabWidget($categorie){
        global $con;
        $tab1 = returnTabWidget($categorie);
        $tab2 = returnTabWidget($categorie);
        if($tab1 != null && $tab2 != null){
            $array = array('tab1' => $tab1, 'tab2' => $tab2);
            return json_encode($array);
        }
        return null;
    }

    // store.php functions
    function AfficherMarquesFiltrer($categoriesIDs){
        global $con;
        $article = new Article();
        $ids = implode(',',json_decode($categoriesIDs));
        if($ids != '')
        {
            $data = array();
            $query = $con->query("SELECT DISTINCT articleMarque FROM article WHERE categorieID IN($ids)");
            while($row = $query->fetch_row()){
                $nbr_produits = $article->NbrProduitsParMarque($row[0]);
                $data[] = ['articleMarque' => $row[0], 'nbr_produits' => $nbr_produits];
            }
            return json_encode($data);
        }
        else
            return json_encode(null);
       
    }

    function AfficherProduitsFiltrer($categoriesIDs, $marques, $minPrix, $maxPrix, $filrerPar, $afficherNbr, $page_nbr){
        global $con,$limitRange,$static_page_nbr;
        $static_page_nbr = $page_nbr;
        
        $article = new Article();
        $categorie = new Categorie();
        $marques_substr = substr($marques, 1, -1);
        $categoriesIDs_implode = implode(',', json_decode($categoriesIDs));
        $categoriesIDs_array = explode(',',$categoriesIDs_implode);
        $query_string = "SELECT * FROM article WHERE articleDisponible = true AND (articlePrix BETWEEN $minPrix AND $maxPrix OR articlePrixRemise BETWEEN $minPrix AND $maxPrix)";
        
        if(!in_array('-1',$categoriesIDs_array)) // filter categorie
            $query_string.= " AND categorieID IN($categoriesIDs_implode)";
        if($marques_substr != '') // filter marques
            $query_string.= " AND articleMarque IN($marques_substr)";
        
        // fitrerPar
        switch($filrerPar){
            case "Nouveau":
                $query_string.= " ORDER BY dateAjoute Desc ";
        }
        
        if($page_nbr == 1)
            $limitRange = 0;
        else
            $limitRange= ($page_nbr -1) * $afficherNbr;
      
        $query_string.= "LIMIT $limitRange,$afficherNbr";
        $query = $con->query($query_string);
        $data = array();
        if($query->num_rows > 0){
            while($row = $query->fetch_array())
            {
                $imageArticle = $article->ImageArticle($row['articleID']);
                $niveau = $article->echoNiveau($row['articleID']);
                $categorieNom = $categorie->CategorieNomParID($row['categorieID']);
                
                $data[] = ['imageArticle' => $imageArticle, 'niveau' => $niveau, 'categorieNom' => $categorieNom, 'remiseDisponible' => $row['remiseDisponible'], 'articleNom' => $row['articleNom'], 'articleID' => $row['articleID'], 'articlePrix' => $row['articlePrix'], 'articlePrixRemise' => $row['articlePrixRemise'], 'tauxRemise' => $row['tauxRemise']];
            }
            $query_string2 = explode('LIMIT', $query_string)[0];
            $query_total_artilces = $con->query($query_string2);
            $row2 = $query_total_artilces->fetch_row();
            array_push($data, $query_total_artilces->num_rows, $query->num_rows);
            return json_encode($data);
        }
        else 
            return json_encode(null);
    }

    function StorePagination($categoriesIDs, $marques, $minPrix, $maxPrix, $filrerPar, $afficherNbr){
        global $con,$static_page_nbr;
        $categoriesIDs_implode = implode(',', json_decode($categoriesIDs));
        $categoriesIDs_array = explode(',',$categoriesIDs_implode);
        $marques_substr = substr($marques, 1, -1);
        
        $query_string = "SELECT COUNT(*) FROM article WHERE articleDisponible = true AND (articlePrix BETWEEN $minPrix AND $maxPrix OR articlePrixRemise BETWEEN $minPrix AND $maxPrix) ";
        
        if(!in_array('-1',$categoriesIDs_array))
            $query_string.= "AND categorieID IN($categoriesIDs_implode) ";    
        if($marques_substr != '') // filter marques
            $query_string.= "AND articleMarque IN($marques_substr) ";
        
        switch($filrerPar){
            case "Nouveau":
                $query_string.= "ORDER BY dateAjoute Desc";
        }
        
        $query = $con->query($query_string);
        $row = $query->fetch_row();
        $nbr_articles = $row[0];
        $nbr_pages = ceil($nbr_articles / $afficherNbr);
        $data[] = array('page_nbr' => $static_page_nbr, 'nbr_pages' => $nbr_pages);
        if($query->num_rows != 0)
            return json_encode($data);
        else
            return json_encode(null);
        return json_encode(null);
    }
    
    // favoris.php functions
    function AucunFavoriTrouve(){
        global $con;
        $clientID = $_SESSION['clientID'];
        $query = $con->query("SELECT COUNT(*) FROM favoridetails WHERE clientID = $clientID");
        $row = $query->fetch_row();
        if($row[0] == 0)
            return json_encode(true);
        return json_encode(null);
    }

    // panier.php function
    function RemplirPagePanier(){
            
        $clientID = $_SESSION['clientID'];
            
        $client = new Client();
        $article = new Article();
        $panier = new Panier();
            
        $query = $panier->AfficherPanierProduits();
        if($query != null)
        {
            $data = array();
            $sub_total = 0;
            $promotion = 0;
            $total = 0;
            while($row = $query->fetch_assoc()){
                    
                $imageArticle = $article->ImageArticle($row['articleID']);

                if($row['remiseDisponible']):
                    
                    $total += $row['articlePrixRemise'] * $row['quantite'];
                    $promotion += ($row['articlePrix'] - $row['articlePrixRemise']) * $row['quantite'];
                    $articlePrixRemise = $row['articlePrixRemise'];
    
                else:
                    
                    $total += $row['articlePrix'] * $row['quantite'];
                    $articlePrixRemise = null;
                    
                endif;

                $sub_total += $row['articlePrix'] * $row['quantite'];
                    
                $data[] = ['articleID' => $row['articleID'], 'articleDescription' => $row['articleDescription'], 'imageArticle' => $imageArticle, 'articleNom' => $row['articleNom'], 'articlePrix' => $row['articlePrix'], 'articlePrixRemise' => $row['articlePrixRemise'], 'remiseDisponible' => $row['remiseDisponible'], 'quantite' => $row['quantite']];
            }
                    
                $nbr_article = $client->NbrArticlesPanier($clientID);
                array_push($data, $total, $promotion, $sub_total, $nbr_article);
                return json_encode($data);
        }
        else
            return json_encode(null);
    }

    function IncrementArticleQtyPanier($articleID, $qty){
        global $con;  
        $clientID = filter_var($_SESSION['clientID'], FILTER_SANITIZE_NUMBER_INT);    
        
        
        $query = $con->query("UPDATE panierdetails SET quantite = $qty WHERE panierID IN (SELECT panierID FROM panier WHERE panierID IN (SELECT panierID FROM client WHERE clientID = $clientID)) AND articleID = $articleID");

        if($con->affected_rows):
            $client = new client();
            return json_encode($client->NbrArticlesPanier($clientID));
        endif;
            
        return json_encode(null);
    }

    // functions
    function returnTabWidget($categorieNom){
        $article = new Article();
        $categorie = new Categorie();
        $query = $article->ProduitsWidget($categorieNom);
        if($query != null){
            $data = array();
            while($row = $query->fetch_assoc()){
                $imageArticle = $article->ImageArticle($row['articleID']);
                $categorieNom = $categorie->CategorieNomParID($row['categorieID']);

                $data[] = ['imageArticle' => $imageArticle, 'categorieNom' => $categorieNom, 'remiseDisponible' => $row['remiseDisponible'], 'articleNom' => $row['articleNom'], 'articlePrix' => $row['articleNom'], 'articlePrixRemise' => $row['articlePrixRemise'], 'articleID' => $row['articleID']];
            }
            return json_encode($data);
        }
        return null;
    }

