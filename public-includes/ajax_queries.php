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
            echo $_POST['function']($_POST['articleID'], $_POST['qty']);break;
            
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
            
        case "AfficherReviews":
            echo $_POST['function']($_POST['articleID'], $_POST['page_nbr']);break;
            
        case "ReviewsPagination":
            echo $_POST['function']($_POST['articleID']);break;
            
        case "ReviewSubmit":
            echo $_POST['function']($_POST['titre'], $_POST['commentaire'], $_POST['niveau'], $_POST['articleID']);break;
            
        case "ReviewsTotalStars":
            echo $_POST['function']($_POST['articleID']);break;
            
        case "GenererCodeCoupon":
            echo $_POST['function']();break;
            
        case "AjouterCoupon":
            echo $_POST['function']($_POST['cpnData'], $_POST['filterData'], $_POST['filter']);break;
            
        case "SupprimerCoupon":
            echo $_POST['function']($_POST['idCpn']);break;
            
        case "AppliquerCoupon":
            echo $_POST['function']($_POST['cpnCode']);break;
            
        case "ModifierCoupon":
            echo $_POST['function']($_POST['cpnData'], $_POST['filterData'], $_POST['filter']);break;
            
        case "FilterCoupon":
            echo $_POST['function']($_POST['cpnID']);break;
            
        case "AfficherCoupons":
            echo $_POST['function']();break;
            
        case "AfficherClients":
            echo $_POST['function']();break;
            
        case "AfficherProduits":
            echo $_POST['function']();break;
        
        case "AfficherCategories":
            echo $_POST['function']();break;
            
        case "ReAppliquerCoupon":
            echo $_POST['function']();break;
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
                    else{
                        $sub_total += $row['articlePrix'] * $row['quantite'];
						$prixRemise = $row['articlePrix'] * $row['quantite'];
					}
                        
            
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
    
    function AjouterAuPanier($articleID, $qty){
        global $con;
        
        if(!isset($_SESSION['clientID']))
            return json_encode(false);
        
        $client = new Client();
        $panierID = $client->PanierClient();
        
        // vérifier si l'article est déja existe
        if($client->ArticlePanierExiste($articleID, $qty) == null && $panierID != null):
        
            $query = $con->query("INSERT INTO panierDetails VALUES($panierID, $articleID, $qty, default)");
        
        endif;
        
        if($con->affected_rows):
            $client = new client();
            return json_encode($client->NbrArticlesPanier());
        endif;
                
        return json_encode(null);
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
        
        if($con->affected_rows > 0)
            return json_encode(true);
        
        return json_encode(null);
    }
    
    function AjouterCategorie($nomCat, $descCat, $active){
        global $con;
        
        $con->query("INSERT INTO categorie values(null,'$nomCat','$descCat',$active)");
        
        if($con->affected_rows > 0)
            return json_encode(true);
        
        return json_encode(null);
    }

    function MiseCategorie($idCat, $nomCat, $descCat, $active){
        global $con;
        
        $con->query("UPDATE categorie SET categorieNom = '$nomCat', description = '$descCat', active = $active WHERE categorieID = $idCat");
        
        if($con->affected_rows > 0)
            return json_encode(true);
        
        return json_encode(null);
    }

    function AfficherCategories(){
        global $con;
        
        $categorie = new Categorie();
        $query = $categorie->AfficherCategories();
        
        if($query != null):
        
            $data = array();
            while($row = $query->fetch_assoc()){
                
                $active = $categorie->echoBadge($row['active']);
                
                $data[] = [ 
                    $row['categorieID'], 
                    $row['categorieNom'], 
                    $row['description'], 
                    $active,
                    '<td><button type="button" class="btn btn-blue btn-update-dialog open-dialog" data-toggle="modal" data-target="#modifierCategorie"><i class="fas fa-edit icon-col"></i></button></td>', 
                    '<td><button type="button" class="btn btn-red open-dialog" data-toggle="modal" data-target="#suppressionCategorie"><i class="fas fa-trash icon-col"></i></button></td>', 
                ];
                
            }
        
            return json_encode(array('data' => $data));
        
        endif;
        
        return json_encode(null);
    }

    // produit.php[dashboard] functions
    function AjouterArtcile($couleurs, $artcileNom, $articlePrix, $articlePrixRemise, $artcileDescription, $articleMarque, $tauxRemise, $remiseDisponible, $unitesEnStock, $articleDisponible, $categorieID){
        global $con;
        if($articleMarque == '')
            $_articleMarque = "default";
        else
            $_articleMarque = $articleMarque;
        $result = $con->query("INSERT INTO article VALUES(null,'$artcileNom',$articlePrix,$articlePrixRemise,'$artcileDescription',$_articleMarque,$tauxRemise,$remiseDisponible,$unitesEnStock,default,$articleDisponible,default,default,$categorieID)");
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
        
        $query = $con->query("DELETE FROM article WHERE articleID = $articleID");
        
        if($con->affected_rows > 0)
            return json_encode(true);
        
        return json_encode(null);
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

    // produits.php[dashboard] functions
    function AfficherProduits(){
        global $con;
        
        $article = new Article();
        $categorie = new Categorie();
        
        $query = $article->AfficherArticles();
        
        if($query != null):
        
            $data = array();
            while($row = $query->fetch_assoc()){
                
                $categorieNom = $categorie->CategorieNomParID($row['categorieID']);
                
                $couleurs = CouleursArticle($row['articleID']);
                $_couleurs = '';
                if($couleurs != null){
                    foreach($couleurs as $couleur){ 
                        $_couleurs .= $couleur.', '; 
                    }
                }
                else
                    $_couleurs = 'N/A';
                
                ($row['articleDisponible'] == true) ? $articleDisponibe = "oui" : $articleDisponibe = "non";
                ($row['remiseDisponible'] == true) ? $remiseDisponible = "oui" : $remiseDisponible = "non";
                
                
                if($remiseDisponible == "non"){
                    $prixRemise = 'N/A';
                    $tauxRemise = "N/A";
                }
                else{
                    $prixRemise = $row['articlePrixRemise'].' DHS';
                    $tauxRemise = $row['tauxRemise'].'%';
                } 
                
                $count = $row['niveau'];
                $niveau = "";
                for( $i = 0 ; $i < $count ; $i++ )
                { 
                    $niveau .= '<i class="fas fa-star"></i>'; 
                }
                
                $data[] = [
                    '<td><button type="button" id="btnModifier" class="btn btn-blue btn-column-icon"><i class="fas fa-edit icon-col"></i></button></td>', 
                    '<td><button id="btnSupprimer" type="button" class="btn btn-red btn-column-icon" data-toggle="modal" data-target="#messageSuppresion"><i class="fas fa-trash icon-col"></i></button></td>', 
                    $row['articleID'], 
                    $row['articleNom'], 
                    $row['articleDescription'], 
                    $row['articleMarque'], 
                    $_couleurs, 
                    $row['articlePrix'].' DHS', 
                    $remiseDisponible,
                    $prixRemise, 
                    $tauxRemise, 
                    $row['unitesEnStock'], 
                    $row['unitesSurCommande'], 
                    $articleDisponibe, 
                    $niveau, 
                    $categorieNom
                ];
                
            }
        
            return json_encode(array( 
                'data' => $data 
            ));
        
        endif;
        
        return json_encode(null);
    }

    // clients.php functions
    function SupprimerClient($clientID){
        global $con;
        
        $result = $con->query("DELETE FROM client WHERE clientID = $clientID");
        
        if($con->affected_rows > 0)
            return json_encode(true);
        
        return json_encode(null);
    }

    function AfficherClients(){
        global $con;
        
        $client = new Client();
        $query = $client->AfficherClients();
        
        if($query != null):
        
            $data = array();
            while($row = $query->fetch_assoc()){
                
                $valide = $client->EmailValide($row['emailValid']);
                
                
                $data[] = [
                    '<td><button type="button" id="btnMessage" class="btn btn-blue btn-column-icon"><i class="fas fa-envelope icon-col"></i></button></td>', 
                    '<td><button id="btnSupprimer" type="button" class="btn btn-red btn-column-icon" data-toggle="modal" data-target="#suppressionClient"><i class="fas fa-trash icon-col"></i></button></td>', 
                    $row['clientID'], 
                    $row['clientUserName'], 
                    $row['prenom'], 
                    $row['nom'], 
                    $row['email'], 
                    $valide, 
                    $row['telephone'],
                    $row['adresse'], 
                    $row['ville'], 
                    $row['codePostal'], 
                ];
                
            }
        
            return json_encode(array('data' => $data));
        
        endif;
        
        return json_encode(null);
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
                
                $data[] = ['imageArticle' => $imageArticle, 'niveau' => $niveau, 'categorieNom' => $categorieNom, 'remiseDisponible' => $row['remiseDisponible'], 'tauxRemise' => $row['tauxRemise'], 'articleNom' => $row['articleNom'], 'articlePrixRemise' => $row['articlePrixRemise'], 'articlePrix' => $row['articlePrix'], 'articleID' => $row['articleID']];
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
        global $con;
        
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
        global $con;
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
        $data[] = array('nbr_pages' => $nbr_pages);
        if($query->num_rows != 0)
            return json_encode($data);

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
        global $con;
            
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
                    $prix = $row['articlePrix'] * $row['quantite'];
                    $total += $row['articlePrix'] * $row['quantite'];
                    $articlePrixRemise = null;
                    
                endif;

                $sub_total += $row['articlePrix'] * $row['quantite'];
                    
                $data[] = ['articleID' => $row['articleID'], 'articleDescription' => $row['articleDescription'], 'imageArticle' => $imageArticle, 'articleNom' => $row['articleNom'], 'articlePrix' => $row['articlePrix'], 'articlePrixRemise' => $row['articlePrixRemise'], 'remiseDisponible' => $row['remiseDisponible'], 'quantite' => $row['quantite']];
                
            }
                    
            $_SESSION['totalApayer'] = $total; 
            
            $nbr_article = $client->NbrArticlesPanier($clientID);
        
            array_push($data, $total, $promotion, $sub_total, $nbr_article);
            return json_encode($data);
        }
        else
            return json_encode(null);
    }

    function IncrementArticleQtyPanier($articleID, $qty){
        global $con;  
		if(isset($_SESSION['clientID'])):
		
			$clientID = filter_var($_SESSION['clientID'], FILTER_SANITIZE_NUMBER_INT);    

			$query = $con->query("UPDATE panierdetails SET quantite = $qty WHERE panierID IN (SELECT panierID FROM panier WHERE panierID IN (SELECT panierID FROM client WHERE clientID = $clientID)) AND articleID = $articleID");

			if($con->affected_rows):
				$client = new client();
				return json_encode($client->NbrArticlesPanier($clientID));
			endif;
		
		endif;
            
        return json_encode(null);
    }

    // produit.php[index]
    function AfficherReviews($articleID, $page_nbr){
        global $con;
        $article = new Article();
        
        if($page_nbr == 1)
            $limitRange = 0;
        $limitRange = ($page_nbr - 1) * 3;
        
        $reviews = $article->AfficherReviews($articleID, $limitRange);
        
        $data = array();
        if($reviews != null):
        
            while($row = $reviews->fetch_assoc()){
                
                $clientID_comm = $row['clientID'];
                $query = $con->query("SELECT nom, prenom FROM client WHERE clientID = $clientID_comm");
                $row2 = $query->fetch_assoc();

                $data[] = ["niveau" => $row['niveau'], "commentaire" => $row['commentaire'], "titre" => $row['titre'] ,"dateComm" => $row['dateComm'], "nom" => strtoupper($row2['nom']), "prenom" => strtoupper($row2['prenom'])];
                
            }
        
            return json_encode($data);
            
        else:
        
            return json_encode(null);
            
        endif;
        
        return json_encode(null);
    }

    function ReviewsPagination($articleID){
        global $con;
        
        $query = $con->query("SELECT COUNT(*) FROM commentaire WHERE accepte = TRUE AND articleID = $articleID");
        $row = $query->fetch_row();
        $nbrReviews = $row[0];
        
        if($nbrReviews > 0):
        
            $nbr_pages = ceil($nbrReviews / 3);

            $data = array('nbr_pages' => $nbr_pages);

            return json_encode($data);
        
        endif;
        
        return json_encode(null);
    }

    function ReviewSubmit($titre, $commentaire, $niveau, $articleID){
        global $con;
		
		if(isset($_SESSION['clientID'])):
		
			$clientID = filter_var($_SESSION['clientID'], FILTER_SANITIZE_NUMBER_INT);

			$query = $con->query("INSERT INTO commentaire VALUES($clientID, $articleID, default, $niveau, '$commentaire', '$titre', default)");

			if($con->affected_rows)
				return json_encode(true);
		
        endif;
		
       return json_encode(null);
        
    }

    function ReviewsTotalStars($articleID){
        global $con;
        
        $article = new Article();
        $nbr_reviews = $article->NbrArticleReviews($articleID);
        
        $query = $con->query("SELECT SUM(niveau) FROM commentaire WHERE accepte = TRUE AND articleID = $articleID");
        $row = $query->fetch_row();
        
        if($nbr_reviews > 0):
        
            $data = array();
        
            $niveau_moyenne = number_format($row[0] / $nbr_reviews , 1);
        
            $nbr_reviews_par_niv = $article->NbrReviewsParNiveau($articleID);
        
            $data[] = ['avg' => $niveau_moyenne];
                
            return json_encode(array_merge($data, $nbr_reviews_par_niv));
        
        else:
        
            return json_encode(null);
        
        endif;
        
        return json_encode(null);
    }

    // coupons.php functions
    function GenererCodeCoupon(){
           
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $rand_str = "";

        for( $i = 0 ; $i < strlen($chars) ; $i++ )
        {

            $rand_index = rand(0, strlen($chars) - 1);
            $rand_str .= $chars[$rand_index];

        }

        return json_encode(substr($rand_str, 0, 6));
    }

    function AjouterCoupon($cpnData, $filterData, $filter){
        global $con;
        
        // classes
        $coupon = new Coupon();
        $article = new Article();
        
        // decode json
        $_cpnData = json_decode($cpnData); 
        
        // articles & categories IDS
        $ids = substr($filterData, 1, -1);
        
        // insert coupon
        $query = $con->query( "INSERT INTO coupon VALUES (null, '$_cpnData[0]', '$_cpnData[1]', $_cpnData[2], $_cpnData[3], '$_cpnData[4]', '$_cpnData[5]' , null, '$filter', default)");
    
        // last coupon id inserted
        $query = $con->query("SELECT couponID FROM coupon ORDER BY dateAjoute DESC LIMIT 1");
        $row = $query->fetch_row();
        $last_couponID = $row[0];
        
        // coupondetails insert
        if($query != NULL && $filterData != NULL):
        
            switch($filter){

                case "tous": // cas "tous"

                    $article = new Article();
                    $query = $article->AfficherArticles();
                    
                    $coupon->AppliquerAuMSJ($last_couponID, null, $filter);

                    while($row = $query->fetch_assoc())
                    {
                        $articleID = $row['articleID'];
                        $con->query("INSERT INTO coupondetails VALUES($articleID, $last_couponID)");
                    }

                    return json_encode(true);

                case "categories": // cas "categories spécifiques"
                    
                    $query = $con->query("SELECT * FROM article WHERE categorieID IN($ids)");
                    
                    $coupon->AppliquerAuMSJ($last_couponID, $ids, $filter);
                    
                    while($row = $query->fetch_assoc())
                    {
                        $articleID = $row['articleID'];
                        $con->query("INSERT INTO coupondetails VALUES($articleID, $last_couponID)");
                    }
                
                return json_encode(true);    
                
                case "articles": // cas "categories spécifiques"

                    $query = $con->query("SELECT * FROM article WHERE articleID IN($ids)");
                    
                    $coupon->AppliquerAuMSJ($last_couponID, $ids, $filter);
                    
                    while($row = $query->fetch_assoc())
                    {
                        $articleID = $row['articleID'];
                        $con->query("INSERT INTO coupondetails VALUES($articleID, $last_couponID)");
                    }
                
                    return json_encode(true);
            }
        
        endif;
            

        return json_encode(null);
        
    }

    function ModifierCoupon($cpnData, $filterData, $filter){
        global $con;
    
        // classes
        $coupon = new Coupon();
        
        // decode json
        $_cpnData = json_decode($cpnData); 
        
        // articles & categories IDS
        $ids = substr($filterData, 1, -1);
        
        // update coupon
        ($_cpnData[3] == "true") ? $bit = 1 : $bit = 0;
        $query = $con->query( "UPDATE coupon 
                                SET couponNom = '$_cpnData[1]', couponCode = '$_cpnData[2]', valide = $bit, taux = $_cpnData[4], dateDebut = '$_cpnData[5]', dateFin = '$_cpnData[6]'
                                WHERE couponID = $_cpnData[0]" );
    
            
            switch($filter){

                case "tous":

                    $coupon->AppliquerAuMSJ($_cpnData[0], null, $filter);

                return json_encode(true);

                case "categories":

                    $coupon->AppliquerAuMSJ($_cpnData[0], $ids, $filter);

                return json_encode(true);

                case "articles":

                    $coupon->AppliquerAuMSJ($_cpnData[0], $ids, $filter);

                return json_encode(true);

            
            }
        
        return json_encode(null);
    }

    function SupprimerCoupon($idCpn){
        global $con;
        
        $query = $con->query("DELETE FROM coupon WHERE couponID = $idCpn");
        
        if($con->affected_rows > 0){
            
            return json_encode(true);
        }
        
        return json_encode(null);
    }

    function AppliquerCoupon($cpnCode){
        global $con;
        
        
        // article ids panier
        $panier = new Panier();
        $articleIDs = $panier->ArticlesIDsPanier();
        
        // vérifier si coupon est existe - et si il est valide aux articles du panier
        $query = $con->query("SELECT c.*, cd.* 
                                FROM coupon c INNER JOIN coupondetails cd
                                ON c.couponID = cd.couponID
                                WHERE c.couponCode = '$cpnCode'
                                AND cd.articleID IN($articleIDs)
                                AND now() BETWEEN c.dateDebut AND c.dateFin");
        
        if($query->num_rows > 0){
            
            $total_coupon = 0;
            
            while($row = $query->fetch_assoc()){
                
                $taux = $row['taux'];
                
                $article = new Article();
                $article_prix = $article->ArticlePrix($row['articleID']); 
                
                $total_coupon += CalculerCoupon($article_prix, $taux);
                
            }
        
            $total = $_SESSION['totalApayer'] - $total_coupon;
            
            $_SESSION['totalApayer'] = $total;
            $_SESSION['couponCode'] = $cpnCode;
            
            return json_encode(array( 'total' => $total, 'taux' => $taux));
        }
            
        unset($_SESSION['couponCode']);
        return json_encode(-1); // coupon non trouvé ou invalde
    }

    function CalculerCoupon($articlePrix, $taux){
        global $con;
        
        $total_avec_coupon =  ( ( $taux *  $articlePrix ) / 100 );
        
        return $total_avec_coupon;
    }

    function FilterCoupon($cpnID){
        global $con;
        
        $query = $con->query("SELECT filter FROM coupon WHERE couponID = $cpnID");
            
        if($query->num_rows > 0):
            
            $row = $query->fetch_row();
            
            return json_encode($row[0]);
        
        endif;
        
        return json_encode(null);
    }

    function AfficherCoupons(){
        global $con;
        
        $coupon = new Coupon();
        $query = $coupon->AfficherCoupons();
        
        if($query != null):
        
            $data = array();
            while($row = $query->fetch_assoc()){
                
                if($row['valide'] == 0)
                    $valide = "<label class='badge badge-danger'>Pas valide</label>";
                else
                    $valide = "<label class='badge badge-success'>Valide</label>";
                
                
                $data[] = ['<td><button type="button" class="btn btn-blue btn-delete-dialog open-dialog" data-toggle="modal" data-target="#mdfCpnMDL"><i class="fas fa-edit icon-col"></i></button></td>', '<td><button type="button" class="btn btn-red btn-delete-dialog open-dialog" data-toggle="modal" data-target="#spmCpnMDL"><i class="fas fa-trash icon-col"></i></button></td>', $row['couponID'], $row['couponNom'], $row['couponCode'], $valide, $row['taux'], $row['appliquerAu'], $row['dateDebut'], $row['dateFin'], $row['dateAjoute']];
                
            }
        
            return json_encode(array('data' => $data));
        
        endif;
        
        return json_encode(null);
    }

    function ReAppliquerCoupon(){
        if( isset($_SESSION['couponCode']) && !empty($_SESSION['couponCode']) ):
        
            $cpnCode = filter_var($_SESSION['couponCode'], FILTER_SANITIZE_STRING);
        
            return json_encode($cpnCode);
        
        endif;
        
        return json_encode(null);
    }