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
            
        case "AjouterArticle":
            echo $_POST['function']($_POST['couleurs'], $_POST['imagePrincipal'], $_POST['articleNom'], $_POST['articlePrix'], $_POST['articlePrixRemise'], $_POST['artcileDescription'], $_POST['articleMarque'], $_POST['tauxRemise'], $_POST['remiseDisponible'], $_POST['unitesEnStock'], $_POST['articleDisponible'], $_POST['categorieID']);break;
            
        case "SupprimerArticle":
            echo $_POST['function']($_POST['articleID']);break;
            
        case "ModifierArticle":
            echo $_POST['function']($_POST['couleurs'], $_POST['imagePrincipal'], $_POST['imagesNoms'], $_POST['articleID'], $_POST['articleNom'], $_POST['articlePrix'], $_POST['articlePrixRemise'], $_POST['artcileDescription'], $_POST['articleMarque'], $_POST['tauxRemise'], $_POST['remiseDisponible'], $_POST['unitesEnStock'], $_POST['articleDisponible'], $_POST['categorieID']);break;
            
        case "SupprimerClient":
            echo $_POST['function']($_POST['clientID']);break;
            
        case "RechargerTab":
            echo $_POST['function']($_POST['categorie']);break;
            
        case "RechargerTabWidget":
            echo $_POST['function']($_POST['categorie']);break;
            
        case "AjouterAuPanier":
            echo $_POST['function']($_POST['articleID'], $_POST['qty'], $_POST['couleur']);break;
            
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
            
        case "SupprimerAuFavoris":
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
        
        case "AfficherArticlesCoupon":
            echo $_POST['function']();break;
			
		case "MiseAjourInfoCommande":
			echo $_POST['function']($_POST['info']);break;
            
        case "VrfDispoArtCommande":
            echo $_POST['function']();break;
            
        case "VrfQtyArtCommande":
            echo $_POST['function']();break;
            
        case "CreationCommande":
            echo $_POST['function']();break;
            
        case "ChangerNumTele":
            echo $_POST['function']($_POST['numTele']);break;
            
        case "AfficherCommandes":
            echo $_POST['function']();break;
            
        case "ConfirmerCommande":
            echo $_POST['function']($_POST['commID']);break;
            
        case "SuppressionCommande":
            echo $_POST['function']($_POST['commID']);break;
            
        case "AfficherClientStat":
            echo $_POST['function']($_POST['commID']);break;
            
        case "AfficherArticlesComm":
            echo $_POST['function']($_POST['commID']);break;
            
        case "AfficherLivraisons":
            echo $_POST['function']();break;
            
        case "AnnulationLivraison":
            echo $_POST['function']($_POST['livID']);break;
            
        case "MDFProfile":
            echo $_POST['function']($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['adresse'], $_POST['ville'], $_POST['postal'], $_POST['tele'], $_POST['question'], $_POST['reponse'], $_POST['passe']);break;
            
        case "AfficherCommandesClient":
            echo $_POST['function']();break;
            
        case "AnnulerCommande":
            echo $_POST['function']($_POST['id']);break;
        
        case "RedemanderCommande":
            echo $_POST['function']($_POST['id']);break;
            
        case "MisEnAttenteCommande":
            echo $_POST['function']($_POST['commID']);break;
            
        case "SupprimerCommandeClient":
            echo $_POST['function']($_POST['id']);break;
        
        case "SupprimerImageArticle":
            echo $_POST['function']($_POST['imageNom']);break;
            
        case "SupprimerCommande":
            echo $_POST['function']($_POST['commID']);break;
            
        case "AfficherCommentaires":
            echo $_POST['function']();break;
        
        case "SupprimerCommentaire":
            echo $_POST['function']($_POST['commID']);break;
        
        case "AccepterCommentaire":
            echo $_POST['function']($_POST['commID']);break;
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
                    
                    $param = $article->urlProduitParameterValue($row['articleID']);
                    
                    $data[] = ['articleID' => $row['articleID'], 'imageArticle' => $imageArticle, 'articleNom' => $row['articleNom'], 'prix' => $prix, 'remiseDisponible' => $row['remiseDisponible'], 'prixRemise' => $prixRemise, 'quantite' => $row['quantite'], 'param' => $param];
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
    
    function AjouterAuPanier($articleID, $qty, $couleur){
        global $con;
        
        if(!isset($_SESSION['clientID']))
            return json_encode(false);
		
        
        $client = new Client();
        $panierID = $client->PanierClient();
        
        // l'article exisite => quantite++
        $quantiteMSJ = $client->ArticlePanierExiste($articleID, $qty, $couleur);
        
        if($quantiteMSJ != true && $panierID != null){
         
            $article = new Article();
            $verifie_qty = $article->VerifierQuantite($articleID, $qty);

            if($verifie_qty != null){ // quantite disponible
                
                $_couleur = "N/A";
                if( $couleur == "N/A" ){
                    
                    $couleur = $article->CouleursArticle($articleID)[0];
                    if( $couleur != null)
                        $_couleur = $couleur;
                }

                $query = $con->query("INSERT INTO panierdetails VALUES($panierID, $articleID, $qty, default, '$_couleur')");

                if($con->affected_rows > 0)
                    return json_encode(true);
            }
        
            return json_encode(-1);
        }
     
        if($quantiteMSJ == -1)
            return  json_encode($quantiteMSJ);
                
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
                    
                    $param = $article->urlProduitParameterValue($row['articleID']);
                    
                    $data[] = ['articleID' => $row['articleID'], 'imageArticle' => $imageArticle, 'articleNom' => $row['articleNom'], 'prix' => $prix, 'param' => $param];
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

    function SupprimerAuFavoris($articleID){
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
        
        $con->query("INSERT INTO categorie values(null, '".$nomCat."', '".$descCat."', $active)");
        
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
    function AjouterArticle($couleurs, $imagePrincipal ,$artcileNom, $articlePrix, $articlePrixRemise, $artcileDescription, $articleMarque, $tauxRemise, $remiseDisponible, $unitesEnStock, $articleDisponible, $categorieID){
        global $con;
        
        // article marque
        ($articleMarque == '') ? $_articleMarque = "default" : $_articleMarque = $articleMarque;

        // insert
        $query = $con->query("INSERT INTO article VALUES(null, '$artcileNom', $articlePrix, $articlePrixRemise, '".$artcileDescription."', '$_articleMarque', $tauxRemise, $remiseDisponible, $unitesEnStock, default, $articleDisponible, default, default, $categorieID)");
        if( $con->affected_rows > 0 ):
        
            // récupérer la dernière articleID 
            $articleID = $con->insert_id;

            // ajouter les photos si l'insertion d'article est réussi
            foreach(glob("../temp/*.*") as $filename)
            {
                $filenameWithoutPath = explode('/',$filename)[2];
                
                if($filenameWithoutPath == $imagePrincipal)
                    $con->query("INSERT INTO imagearticle VALUES('$filenameWithoutPath', $articleID, 1)");
                else
                    $con->query("INSERT INTO imagearticle VALUES('$filenameWithoutPath', $articleID, default)");
                
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
        
            return json_encode(true); 
        endif;
        
        return json_encode(null); 
    }

    function SupprimerArticle($articleID){
        global $con;
        
        $query = $con->query("DELETE FROM article WHERE articleID = $articleID");
        
        if($con->affected_rows > 0)
            return json_encode(true);
        
        return json_encode($articleID);
    }

    function ModifierArticle($couleurs, $imagePrincipal , $imagesNoms, $articleID, $articleNom, $articlePrix, $articlePrixRemise, $artcileDescription, $articleMarque, $tauxRemise, $remiseDisponible, $unitesEnStock, $articleDisponible, $categorieID){
        global $con;
        
        $update_query = $con->query("UPDATE article SET articleNom = '$articleNom', articlePrix = $articlePrix, articlePrixRemise = $articlePrixRemise, articleDescription = '$artcileDescription', articleMarque = '$articleMarque', tauxRemise = $tauxRemise, remiseDisponible = $remiseDisponible, unitesEnStock = $unitesEnStock, articleDisponible = $articleDisponible, categorieID = $categorieID WHERE articleID = $articleID");
        
        // modifier ou inserer couleurs
        if($couleurs != "N/A"){
            
            $con->query("DELETE FROM couleurarticle WHERE articleID = $articleID");
            $couleurs_array = explode(",", $couleurs);

            foreach($couleurs_array as $couleur)
            {
                $clr = ucfirst(trim($couleur));
                if($clr != '')
                    $con->query("INSERT INTO couleurarticle VALUES('$clr',$articleID)");
            }
        }
            
        // ajouter nouveaux images
        foreach(glob("../temp/*.*") as $filename)
        {
            $filenameWithoutPath = explode('/',$filename)[2];
            
            if($filenameWithoutPath == $imagePrincipal)
                $con->query("INSERT INTO imagearticle VALUES('$filenameWithoutPath', $articleID, 1)");
            else
                $con->query("INSERT INTO imagearticle VALUES('$filenameWithoutPath', $articleID, default)");
            
            // transférer les au uploaded dossier
            rename($filename, '../uploaded/articles-images/'.$filenameWithoutPath);
        }
        
        $query = $con->query(" SELECT *
                            FROM imagearticle
                            WHERE articleID = $articleID");
        
        if( $query->num_rows > 0 ):
        
            // supprimer images
            while($row = $query->fetch_assoc()){
                
                if( !in_array($row['imageArticleNom'], $imagesNoms) ):
                
                    $supp_image = $row['imageArticleNom'];
                    $con->query(" DELETE FROM imagearticle WHERE imageArticleNom =  '$supp_image'");
                
                endif;
            }
            // end
        
            // msj image principal
            $con->query(" UPDATE imagearticle 
                        SET principale = 1
                        WHERE imageArticleNom = '$imagePrincipal'
                        AND articleID = $articleID");
        
            $con->query(" UPDATE imagearticle 
                        SET principale = 0
                        WHERE imageArticleNom <> '$imagePrincipal'
                        AND articleID = $articleID");
            // end
        
        endif;
        
        if($couleurs == '')
            $con->query("DELETE FROM couleurarticle WHERE articleID = $articleID");
        
        return json_encode(true);
    }

    function SupprimerImageArticle($imageNom){
        global $con;
        
        $con->query(" DELETE FROM imagearticle WHERE imageArticleNom = '$imageNom' ");
        if($con->affected_rows)
            return json_encode(true);
        
        return json_encode(null);
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
                
                $couleurs = $article->CouleursArticle($row['articleID']);
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
                
                if(strlen($row['articleDescription']) > 40)
                    $artilceDesc = substr($row['articleDescription'], 0, 40).' ...';
                else
                    $artilceDesc = $row['articleDescription'];
                
                if(strlen($row['articleNom']) > 25)
                    $articleNom = substr($row['articleNom'], 0, 25).' ...';
                else
                    $articleNom = $row['articleNom'];
                
                $image = $article->ImageArticle($row['articleID']);
                
                $data[] = [
                    '<td><button type="button" id="btnModifier" class="btn btn-blue btn-column-icon"><i class="fas fa-edit icon-col"></i></button></td>', 
                    '<td><button id="btnSupprimer" type="button" class="btn btn-red btn-column-icon" data-toggle="modal" data-target="#messageSuppresion"><i class="fas fa-trash icon-col"></i></button></td>', 
                    $row['articleID'], 
                    '<img src='.$image.'>', 
                    $articleNom, 
                    $artilceDesc, 
                    $row['articleMarque'], 
                    $_couleurs, 
                    $row['articlePrix'].' DHS', 
                    $remiseDisponible,
                    $prixRemise, 
                    $tauxRemise, 
                    $row['unitesEnStock'], 
                    $row['unitesCommandees'], 
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

                if(strlen($row['adresse']) > 25)
                    
                    $adresse = substr($row['adresse'], 0, 25).' ...';
                else
                    $adresse = $row['adresse'];
                
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
                    $adresse, 
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
                
                $param = $article->urlProduitParameterValue($row['articleID']);
                
                if(strlen($row['articleNom']) > 38)
                    $articleNom = substr($row['articleNom'], 0, 38).' ...';
                else
                    $articleNom = $row['articleNom'];
                
                $data[] = ['imageArticle' => $imageArticle, 'niveau' => $niveau, 'categorieNom' => $categorieNom, 'remiseDisponible' => $row['remiseDisponible'], 'tauxRemise' => $row['tauxRemise'], 'articleNom' => $articleNom, 'articlePrixRemise' => $row['articlePrixRemise'], 'articlePrix' => $row['articlePrix'], 'articleID' => $row['articleID'], 'param' => $param];
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

                $param = $article->urlProduitParameterValue($row['articleID']);
                
                if(strlen($row['articleNom']) > 19)
                    $articleNom = substr($row['articleNom'], 0, 19).' ...';
                else
                    $articleNom = $row['articleNom'];
  
                
                $data[] = ['imageArticle' => $imageArticle, 'categorieNom' => $categorieNom, 'remiseDisponible' => $row['remiseDisponible'], 'articleNom' => $articleNom, 'articlePrix' => $row['articlePrix'], 'articlePrixRemise' => $row['articlePrixRemise'], 'articleID' => $row['articleID'], 'param' => $param];
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
        if($ids != ''):
        
            $data = array();
        
            $query = $con->query("SELECT DISTINCT articleMarque FROM article WHERE categorieID IN($ids)");
        
            if($ids == -1)
                $query = $con->query("SELECT DISTINCT articleMarque FROM article WHERE articleMarque <> ''");
        
            if( $query->num_rows > 0 ):
        
                while($row = $query->fetch_row()){
                    $nbr_produits = $article->NbrProduitsParMarque($row[0]);
                    $data[] = ['articleMarque' => $row[0], 'nbr_produits' => $nbr_produits];
                }
        
                return json_encode($data);
        
            endif;
        
        endif;
           
        return json_encode(null);
    }

    function AfficherProduitsFiltrer($categoriesIDs, $marques, $minPrix, $maxPrix, $filrerPar, $afficherNbr, $page_nbr){
        global $con;
        
        $article = new Article();
        $categorie = new Categorie();
        
        $marques_substr = substr($marques, 1, -1);
        $categoriesIDs_implode = implode(',', json_decode($categoriesIDs));
        $categoriesIDs_array = explode(',',$categoriesIDs_implode);
        $query_string = " SELECT * 
                        FROM article 
                        WHERE articleDisponible = true 
                        AND (  ( articlePrix BETWEEN $minPrix AND $maxPrix )
                        OR ( articlePrixRemise BETWEEN $minPrix AND $maxPrix ) )";
        
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
                
                if(strlen($row['articleNom']) > 38)
                    $articleNom = substr($row['articleNom'], 0, 38).' ...';
                else
                    $articleNom = $row['articleNom'];
                
                $param = $article->urlProduitParameterValue($row['articleID']);
                
                $data[] = ['imageArticle' => $imageArticle, 'niveau' => $niveau, 'categorieNom' => $categorieNom, 'remiseDisponible' => $row['remiseDisponible'], 'articleNom' => $articleNom, 'articleID' => $row['articleID'], 'articlePrix' => $row['articlePrix'], 'articlePrixRemise' => $row['articlePrixRemise'], 'tauxRemise' => $row['tauxRemise'], 'param' => $param];
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
                
                $param = $article->urlProduitParameterValue($row['articleID']);
                
                if(strlen($row['articleDescription']) > 120)
                    $artilceDesc = substr($row['articleDescription'], 0, 125).' ...';
                else
                    $artilceDesc = $row['articleDescription'];
                    
                $data[] = [
                    'articleID' => $row['articleID'], 
                    'articleDescription' => $artilceDesc, 
                    'imageArticle' => $imageArticle,
                    'articleNom' => $row['articleNom'], 
                    'articlePrix' => $row['articlePrix'], 
                    'articlePrixRemise' => $row['articlePrixRemise'],
                    'remiseDisponible' => $row['remiseDisponible'],
                    'quantite' => $row['quantite'],
                    'param' => $param
                ];
            }
                    
            $_SESSION['total'] = $total; 
            $_SESSION['totalApayer'] = $total;
            
            $nbr_article = $client->NbrArticlesPanier($clientID);
            
        
            array_push($data, $total, $promotion, $sub_total, $nbr_article);
            return json_encode($data);
        }
        else
            return json_encode(null);
    }

    function IncrementArticleQtyPanier($articleID, $qty_commande){
        global $con;  
		if(isset($_SESSION['clientID']) && $qty_commande > 0):
		
			$clientID = filter_var($_SESSION['clientID'], FILTER_SANITIZE_NUMBER_INT);  

            $query = $con->query("SELECT unitesEnStock FROM article WHERE articleID = $articleID");
			$row = $query->fetch_assoc();
			$qty_dispo = $row['unitesEnStock'];
			
			if($qty_commande <= $qty_dispo){
                
                $query = $con->query("UPDATE panierdetails SET quantite = $qty_commande WHERE panierID IN (SELECT panierID FROM panier WHERE panierID IN (SELECT panierID FROM client WHERE clientID = $clientID)) AND articleID = $articleID");

			     return json_encode(true);
            }
        
            return json_encode($row['unitesEnStock']);
		
		endif;
            
        return json_encode(null);
    }

    function ReAppliquerCoupon(){
        if( isset($_SESSION['coupon']) && !empty($_SESSION['coupon']) ):
        
            $cpnCode = filter_var($_SESSION['coupon'], FILTER_SANITIZE_STRING);
        
            return json_encode($cpnCode);
        
        endif;
        
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
								AND valide = 1
                                AND now() BETWEEN c.dateDebut AND c.dateFin");
        
        if($query->num_rows > 0){
            
            $total_coupon = 0;
            
            while($row = $query->fetch_assoc()){
                
                $taux = $row['taux'];
                
                $article = new Article();
                $article_prix = $article->ArticlePrix($row['articleID']); 
                
                $total_coupon += CalculerCoupon($article_prix, $taux);
                
            }
        
            $totalApayer = $_SESSION['total'] - $total_coupon;
            
            $_SESSION['totalApayer'] = $totalApayer;
            $_SESSION['coupon'] = $cpnCode;
            
            return json_encode(array( 'total' => $totalApayer, 'taux' => $taux));
        }
            
        unset($_SESSION['coupon']);
        
        return json_encode(-1); // coupon non trouvé ou invalde
    }

    function CalculerCoupon($articlePrix, $taux){
        global $con;
        
        $total_avec_coupon =  ( ( $taux *  $articlePrix ) / 100 );
        
        return $total_avec_coupon;
    }

    // profile.php
    function MDFProfile($prenom, $nom, $email, $adresse, $ville, $postal, $tele, $question, $reponse, $motdepasse){
        global $con;
        
        $clientID = filter_var($_SESSION['clientID'], FILTER_SANITIZE_NUMBER_INT);
        
        $_prenom = $con->escape_string($prenom);
        $_nom = $con->escape_string($nom);
        $_email = $con->escape_string($email);
        $_adresse = $con->escape_string($adresse);
        $_ville = $con->escape_string($ville);
        $_postal = $con->escape_string($postal);
        $_tele = $con->escape_string($tele);
        $_question = $con->escape_string($question);
        $_reponse = $con->escape_string($reponse);
        $_motdepasse = $con->escape_string($motdepasse);
        
        if($_motdepasse != ''):
            $crypt_password = password_hash($_motdepasse, PASSWORD_DEFAULT, array('cost' => 10));
        
            $con->query(" UPDATE client
                    SET motdepasse = '$crypt_password'
                    WHERE clientID = $clientID ");
        
        endif;
        
        $con->query(" UPDATE client
                    SET prenom = '".$_prenom."',
                    nom = '".$_nom."',
                    email = '$_email',
                    adresse = '".$_adresse."',
                    ville = '$_ville',
                    codePostal = $_postal,
                    telephone = '$_tele',
                    questionSecurite = '".$_question."',
                    reponseQuestion = '".$_reponse."'
                    WHERE clientID = $clientID ");
        
        if( $con->affected_rows )
            return json_encode(true);
        
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
		
		if(!isset($_SESSION['clientID']))
            return json_encode(-1);
		
        $clientID = filter_var($_SESSION['clientID'], FILTER_SANITIZE_NUMBER_INT);
        $_commentaire = filter_var($commentaire, FILTER_SANITIZE_STRING);
        $_titre = filter_var($titre, FILTER_SANITIZE_STRING);
        $_niveau = filter_var($niveau, FILTER_SANITIZE_NUMBER_INT);
        $_articleID = filter_var($articleID, FILTER_SANITIZE_NUMBER_INT);

        $query = $con->query("INSERT INTO commentaire VALUES(NULL, $clientID, $_articleID, default, $_niveau, '$_commentaire', '$_titre', default)");

        if($con->affected_rows > 0){
          
            // notification
            $notification = new Notification();
            $notification->NouveauNotification('commentaire', $clientID);
          
            return json_encode(true);
        }
		
       return json_encode(null);
        
    }

    function ReviewsTotalStars($articleID){
        global $con;
        
        $article = new Article();
        $nbr_reviews = $article->NbrArticleReviews($articleID);
        
        $query = $con->query("SELECT SUM(niveau) FROM commentaire WHERE accepte = 1 AND articleID = $articleID");
        $row = $query->fetch_row();
        
        $data = array();
        
        if($nbr_reviews == 0):
        
            $data[] = ['avg' => 5];
            $nbr_reviews_par_niv = $article->NbrReviewsParNiveau($articleID);
            return json_encode(array_merge($data, $nbr_reviews_par_niv));
        
        else:
            
            $niveau_moyenne = number_format($row[0] / $nbr_reviews , 1);
            $nbr_reviews_par_niv = $article->NbrReviewsParNiveau($articleID);
            $data[] = ['avg' => $niveau_moyenne];
            return json_encode(array_merge($data, $nbr_reviews_par_niv));
        
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
    
        // supprimer toutes coupondetails
        $con->query("DELETE FROM coupondetails WHERE couponID = $_cpnData[0]");
            
        switch($filter){

            case "tous":

                $coupon->AppliquerAuMSJ($_cpnData[0], null, $filter);
                
                $article = new Article();
                $query = $article->AfficherArticles();

                while($row = $query->fetch_assoc())
                {
                    $articleID = $row['articleID'];
                    $con->query("INSERT INTO coupondetails VALUES($articleID, $_cpnData[0])");
                }

            return json_encode(true);

            case "categories":

                $coupon->AppliquerAuMSJ($_cpnData[0], $ids, $filter);
                
                $query = $con->query("SELECT * FROM article WHERE categorieID IN($ids)");
                    
                while($row = $query->fetch_assoc())
                {
                    $articleID = $row['articleID'];
                    $con->query("INSERT INTO coupondetails VALUES($articleID, $_cpnData[0])");
                }

            return json_encode(true);

            case "articles":

                $coupon->AppliquerAuMSJ($_cpnData[0], $ids, $filter);
                
                $query = $con->query("SELECT * FROM article WHERE articleID IN($ids)");
                       
                while($row = $query->fetch_assoc())
                {
                    $articleID = $row['articleID'];
                    $con->query("INSERT INTO coupondetails VALUES($articleID, $_cpnData[0])");
                }

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

    function FilterCoupon($cpnID){
        global $con;
        
        $query = $con->query("SELECT filter FROM coupon WHERE couponID = $cpnID");
            
        if($query->num_rows > 0):
            
            $row = $query->fetch_row();
            $filter = $row[0];
        
            switch($filter){
                case "tous":
                    return json_encode(array( 'filter' => $filter));
                case "articles":
                    $query = $con->query(" SELECT articleID 
                                        FROM coupon c INNER JOIN coupondetails cd
                                        ON c.couponID = cd.couponID
                                        WHERE cd.couponID = $cpnID");
                    $data = array();
                    while($row = $query->fetch_row()){
                        
                        $data[] = $row[0];
                        
                    }
                    return json_encode(array( 'data' => $data, 'filter' => $filter));
            }
        
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
                
                $data[] = [
                    '<td><button type="button" class="btn btn-blue btn-delete-dialog open-dialog" data-toggle="modal" data-target="#mdfCpnMDL"><i class="fas fa-edit icon-col"></i></button></td>', 
                    '<td><button type="button" class="btn btn-red btn-delete-dialog open-dialog" data-toggle="modal" data-target="#spmCpnMDL"><i class="fas fa-trash icon-col"></i></button></td>', 
                    $row['couponID'], 
                    $row['couponNom'],
                    $row['couponCode'], 
                    $valide, 
					$row['taux'].'%', 
                    $row['appliquerAu'], 
                    $row['dateDebut'], 
                    $row['dateFin'], 
                    $row['dateAjoute']
                ];
                
            }
        
            return json_encode(array('data' => $data));
        
        endif;
        
        return json_encode(null);
    }

    function AfficherArticlesCoupon(){
        global $con;
        
        $article = new Article();
        $query = $article->AfficherArticles();
        
        if($query != null):
        
            $data = array();
            while($row = $query->fetch_assoc()){
                
                $image = $article->ImageArticle($row['articleID']);
                
                if($row['remiseDisponible']){
                    $articlePrixRemise = $row['articlePrixRemise'];
                    $tauxRemise = $row['tauxRemise'];
                }
                else{
                    $articlePrixRemise = "N/A";
                    $tauxRemise = "N/A";
                }
                
                if(strlen($row['articleNom']) > 25)
                    $articleNom = substr($row['articleNom'], 0, 25).' ...';
                else
                    $articleNom = $row['articleNom'];
                
                if(strlen($row['articleDescription']) > 40)
                    $desc = substr($row['articleDescription'], 0, 40).' ...';
                else
                    $desc = $row['articleDescription'];

                $data[] = [
                    '<div class="form-group override-margin">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input name="cpnArtFilter" data-id="'.$row['articleID'].'" type="checkbox" class="form-check-input override-position">
                                <i class="input-helper"></i>
                            </label>
                        </div>
                    </div>', 
                    $row['articleID'], 
                    '<img class="img-responsive" src='.$image.'>', 
                    $articleNom,
                    $desc,
                    $row['articlePrix'], 
                    $tauxRemise, 
                    $articlePrixRemise
                ];
                
            }
        
            return json_encode(array('data' => $data));
        
        endif;
        
        return json_encode(null);
    }

	// verification.php
	function MiseAjourInfoCommande($info){
		global $con;
		
		$clientID = filter_var($_SESSION['clientID'], FILTER_SANITIZE_NUMBER_INT);
		
        if( filter_var($info[5], FILTER_VALIDATE_INT) || filter_var($info[5], FILTER_VALIDATE_INT) === 0): // fix to validate 0 as integer
        
            $nom = filter_var($info[0], FILTER_SANITIZE_STRING);
            $prenom = filter_var($info[1], FILTER_SANITIZE_STRING);
            $ville = filter_var($info[2], FILTER_SANITIZE_STRING);
            $adresse = filter_var($info[3], FILTER_SANITIZE_STRING);
            $tele = filter_var($info[4], FILTER_SANITIZE_STRING);
            $code_postal = filter_var($info[5], FILTER_SANITIZE_NUMBER_INT);
		
            $con->query(" 
                        UPDATE client 
                        SET nom = '$nom',
                        prenom = '$prenom',
                        ville = '$ville',
                        adresse = '$adresse',
                        telephone = '$tele',
                        codePostal = $code_postal 
                        WHERE clientID = $clientID 
            ");
		
            if($con->affected_rows != -1)
                return json_encode(true);
        
        endif;
		
		return json_encode(null);
	}

    function VrfDispoArtCommande(){
        
        $panier = new Panier();
        
        $query = $panier->AfficherPanierProduits();
        
        while($row = $query->fetch_assoc()){
            
            if($row['articleDisponible'] == false)
                return json_encode(null);
        }
        
        return json_encode(true);
    }

    function VrfQtyArtCommande(){
        
        $article = new Article();
        $panier = new Panier();
        
        $query = $panier->AfficherPanierProduits();
        
        while($row = $query->fetch_assoc()){
            
            $verifie_qty = $article->VerifierQuantite($row['articleID'], $row['quantite']);
            if($verifie_qty == null)
                return json_encode(null);
        }
        
        return json_encode(true);
    }

    function CreationCommande(){
        global $con;
        
        $client = new Client();
        $article = new Article();
        $panier = new Panier();
        
        $clientID = filter_var($_SESSION['clientID'], FILTER_SANITIZE_NUMBER_INT);
        $type_livraison = filter_var($_SESSION['typelivraison'], FILTER_SANITIZE_STRING);
        $total_a_payer = filter_var($_SESSION['totalApayer'], FILTER_SANITIZE_NUMBER_FLOAT);
        $nbr_articles = $client->NbrArticlesPanier();
        (isset($_SESSION['coupon'])) ? $couponUtilise = 1 : $couponUtilise = 0;
        
        $query = $con->query("INSERT INTO commande VALUES(
                                null, 
                                $clientID,
                                default,
                                0,
                                $nbr_articles,
                                $total_a_payer,
                                '$type_livraison',
                                $couponUtilise,
                                default
                            )");
        
        $commandeID = $con->insert_id;
        
        if($con->affected_rows > 0){
            
            $query = $panier->AfficherPanierProduits();
            
            while($row = $query->fetch_assoc()){

                $articleID = $row['articleID'];
                $panierID = $client->PanierClient();
                
                $query2 = $con->query(" SELECT couleur, quantite
                                        FROM panierdetails
                                        WHERE articleID = $articleID
                                        AND panierID = $panierID");
                $row2 = $query2->fetch_row();
                $couleur = $row2[0];
                $quantite = $row2[1];
                
                $con->query(" INSERT INTO commandedetails VALUES (
                                    $commandeID,
                                    $articleID,
                                    $quantite,
                                    '$couleur') ");    
                
                if($con->affected_rows == 0)
                    return json_encode(null); 
                
            }
          
            // notification
            $notification = new Notification();
            $notification->NouveauNotification('commande', $clientID);
            
            return json_encode(true);
            
        }
        
        return json_encode(null);
    }

    function ChangerNumTele($numTele){
        global $con;
        
        $_numTele = filter_var($numTele, FILTER_SANITIZE_STRING);
        $clientID = filter_var($_SESSION['clientID'], FILTER_SANITIZE_NUMBER_INT);
        
        $con->query(" UPDATE client
                        SET telephone = '$_numTele' 
                        WHERE clientID = $clientID" );
        
        if($con->affected_rows)
            return json_encode(true);
        
        return json_encode(null);
        
        
    }

    // commandes.php [dashboard]
    function AfficherCommandes(){
        global $con;
        
        $commande = new Commande();
        $client = new Client();
        
        $query = $commande->AfficherCommandes();
        
        if($query != null):
        
            $data = array();
            while($row = $query->fetch_assoc()){

                $nom_prenom = $client->ClientNomPrenom($row['clientID']);
                
                ($row['couponUtilise']) ?
                    $coponUtilise = "Oui" : $coponUtilise = "Non";
                
                if($row['status'] == 2):
                    $refuse_action = '<td><div><button type="button" class="btn btn-red btn-delete-dialog open-dialog refuser-btn" disabled>refusé</button></div><div><button type="button" class="btn ovr-button-styles refuse-second-action">En Attente</button></div></td>';
                    $status = '<label class="badge badge-danger">Réfusé</label>';
                else:
                    $refuse_action = '<td><button type="button" class="btn btn-red btn-delete-dialog open-dialog refuser-btn"><i class="fa fa-times icon-col"></i></button></td>';
                    $status = '<label class="badge badge-danger">En attente</label>';
                endif;

                $data[] = [
                    '<td><button type="button" class="btn btn-green btn-delete-dialog open-dialog comm-liv"><i class="fas fa-check icon-col"></i></button></td>', 
                    $refuse_action,
                    $row['commandeID'],
                    $nom_prenom.'<button type="button" class="btn btn-blue btn-delete-dialog open-dialog btn-info-client" data-toggle="modal" data-target="#infoClientMDL"><i class="fa fa-info-circle icon-col"></i></button>',
                    $row['commandeDate'],
                    $status,
                    ucfirst($row['typeLivraison']),
                    $coponUtilise,
                    $row['nbrArticles'].'<button type="button" class="btn btn-blue btn-delete-dialog open-dialog btn-info-articles" data-toggle="modal" data-target="#infoArticlesMDL"><i class="fa fa-info-circle icon-col"></i></button>',
                    $row['totalApayer']." DHS",
                    '<td><button type="button" class="btn btn-red btn-delete-dialog open-dialog btn-supp-comm" data-toggle="modal" data-target="#spmCommMDL">supprimer</button></td>'
                ];
            }
        
            return json_encode(array('data' => $data));
        
        endif;
        
        return json_encode(null);
    }

    function ConfirmerCommande($commandeID){
        global $con;
        
        if(filter_var($commandeID, FILTER_SANITIZE_NUMBER_INT)):
            $_commandeID = filter_var($commandeID, FILTER_SANITIZE_NUMBER_INT);
        
            // verfie quantite 
            $query = $con->query(" SELECT * 
                                FROM commande c INNER JOIN commandedetails cd
                                ON c.commandeID = cd.commandeID
                                WHERE cd.commandeID = $_commandeID");
            $row = $query->fetch_assoc();
            $articleID = $row['articleID'];
            $clientID = $row['clientID'];
            $quantite_comm = $row['quantite'];
        
            $query = $con->query("SELECT unitesEnStock FROM article WHERE articleID = $articleID");
			$row = $query->fetch_assoc();
			$qty_dispo = $row['unitesEnStock'];
			
			if($quantite_comm > $qty_dispo)
                return json_encode(-1);
            
            // état = confirmé
            $query = $con->query( " UPDATE commande 
                                    SET status = 1
                                    WHERE commandeID = $_commandeID" 
                                );
            // end
        
            if( $con->affected_rows > 0 ){
                
                // insert livraison
                $query = $con->query(" INSERT INTO livraison VALUES( 
                                            null,
                                            $_commandeID,
                                            default
                                        )
                                    ");
                
                $affected_rows = $con->affected_rows;
                // end
                
                // mise à jour unites en stock & unites sur commande
                $query = $con->query(" SELECT * 
                                        FROM commande c INNER JOIN commandedetails cd
                                        ON c.commandeID = cd.commandeID
                                        WHERE status = 1
										AND cd.commandeID = $commandeID");
            
                if( $query->num_rows > 0 ):
                
                    while($row = $query->fetch_assoc()){

                        $articleID = $row['articleID'];
                        $quantite_comm = $row['quantite'];

                        $con->query(" UPDATE article 
                                    SET unitesEnStock = unitesEnStock - $quantite_comm,
                                        unitesCommandees = unitesCommandees + $quantite_comm
                                    WHERE articleID = $articleID ");
                    }
                
                endif;
                // end
                
                // vider panier
                $query = $con->query("SELECT panierID FROM client WHERE clientID = $clientID");
			    $row = $query->fetch_row();
                $panierID = $row[0];
                
                $con->query(" DELETE FROM panierdetails WHERE panierID = $panierID ");
                //end
                             
                if($affected_rows > 0)
                    return json_encode(true);
            }
        
        endif;
        
        
        return json_encode(null);
    }

    function SuppressionCommande($commandeID){
        global $con;
        
        $_commandeID = filter_var($commandeID, FILTER_SANITIZE_NUMBER_INT);
        
        if( !empty($_commandeID) ):
        
            $query = $con->query(" UPDATE commande
                                SET status = 2
                                WHERE commandeID = $_commandeID ");
        
            if( $con->affected_rows > 0 )
                return json_encode(true);
        
        endif;
        
        return json_encode(null);
    }

    function AfficherClientStat($commandeID){
        global $con;
        
        if(filter_var($commandeID, FILTER_SANITIZE_NUMBER_INT)):
            $_commandeID = filter_var($commandeID, FILTER_SANITIZE_NUMBER_INT);
        
            // clientID
            $query = $con->query(" SELECT clientID
                                    FROM commande
                                    WHERE commandeID = $commandeID
                                ");
            $row = $query->fetch_row();
            $clientID = $row[0];
        
            // total payé
            $query = $con->query("SELECT SUM(totalAPayer)
                                    FROM commande
                                    WHERE clientID = $clientID
                                    AND status = 1
                                ");
            $row = $query->fetch_row();
            ( $row[0] == null ) ? $total_paye = 0 : $total_paye = $row[0]; 

        
            // total d'achats
            $query = $con->query("SELECT COUNT(*)
                                    FROM commande
                                    WHERE clientID = $clientID
                                    AND status = 1
                                ");
            $row = $query->fetch_row();
            $total_achats = $row[0];
        
            // total d'articles
            $query = $con->query("SELECT SUM(nbrArticles)
                                    FROM commande
                                    WHERE clientID = $clientID
                                    AND status = 1
                                ");
            $row = $query->fetch_row();
            ( $row[0] == null ) ? $total_articles = 0 : $total_articles = $row[0]; 
        
            // info	
			$query = $con->query(" SELECT * 
										FROM client
										WHERE clientID = $clientID
									");
            $row = $query->fetch_assoc();
            $data = array(
                'prenom' => $row['prenom'],
                'nom' => $row['nom'],
                'email' => $row['email'],
                'tele' => $row['telephone'],
                'adresse' => $row['adresse'],
                'ville' => $row['ville'],
                'postal' => $row['codePostal'],
                'totalpayer' => $total_paye,
                'totalachats' => $total_achats,
                'totalarticles' =>$total_articles
            );
        
            return json_encode($data);
            
        
        endif;
        
        
        return json_encode(null);
    }

    function AfficherArticlesComm($commandeID){
        global $con;
        
        $commande = new Commande();
        $article = new Article();
        
        if(filter_var($commandeID, FILTER_SANITIZE_NUMBER_INT)):
            $_commandeID = filter_var($commandeID, FILTER_SANITIZE_NUMBER_INT);
        
            $query = $commande->AfficherArtilcesCommande($_commandeID);
        
            if($query != null):

                $data = array();
                while($row = $query->fetch_assoc()){

                    $image = $article->ImageArticle($row['articleID']);

                    if($row['remiseDisponible']):
                        $articlePrixRemise = $row['articlePrixRemise'];
                        $tauxRemise = $row['tauxRemise'];
                    else:
                        $articlePrixRemise = "N/A";
                        $tauxRemise = "N/A";
                    endif;
                    
                    ($row['couleur'] == null) ? $couleur = "N/A" : $couleur = $row['couleur'];
                    
                    if(strlen($row['articleNom']) > 25)
                        $articleNom = substr($row['articleNom'], 0, 25).' ...';
                    else
                        $articleNom = $row['articleNom'];
                    
                    if(strlen($row['articleDescription']) > 40)
                        $articleDesc = substr($row['articleDescription'], 0, 40).' ...';
                    else
                        $articleDesc = $row['articleDescription'];

                    $data[] = [
                        $row['articleID'], 
                        '<img class="img-responsive" src='.$image.'>', 
                        $articleNom,
                        $articleDesc,
                        $couleur,
                        $row['quantite'],
                        $row['articlePrix'], 
                        $tauxRemise, 
                        $articlePrixRemise
                    ];

                }

                return json_encode(array('data' => $data));

            endif;
        
        endif;
        
        return json_encode(null);
    }

    function MisEnAttenteCommande($commandeID){
        global $con;
        
        if(filter_var($commandeID, FILTER_SANITIZE_NUMBER_INT)):
            $_commandeID = filter_var($commandeID, FILTER_SANITIZE_NUMBER_INT);
            
            $query = $con->query(" UPDATE commande 
                                SET status = 0
                                WHERE commandeID = $_commandeID");
        
            if( $con->affected_rows > 0 )
                return json_encode(true);
        
        endif;
        
        return json_encode(null);
    }

    function SupprimerCommande($commandeID){
        global $con;
        
        if(filter_var($commandeID, FILTER_SANITIZE_NUMBER_INT)):
            $_commandeID = filter_var($commandeID, FILTER_SANITIZE_NUMBER_INT);
        
            $con->query(" DELETE FROM commande WHERE commandeID = $_commandeID ");
        
            if( $con->affected_rows > 0 )
                return json_encode(true);
        endif;
        
        return json_encode(null);
    }

    // livraisons.php
    function AfficherLivraisons(){
        global $con;
        
        $livraison = new Livraison();
        $client = new Client();
        
        $query = $livraison->AfficherLivraisons();
        
        if($query != null):
        
            $data = array();
            while($row = $query->fetch_assoc()){
                
                // client nom & prenom
                $nom_prenom = $client->ClientNomPrenom($row['clientID']);
                
                $data[] = [
                    '<td><button type="button" class="btn btn-red btn-delete-dialog open-dialog annuler-liv">annuler</button></td>', 
                    $row['livraisonID'],
                    $row['confirmationDate'],
                    $row['commandeID'],
                    $nom_prenom.'<button type="button" class="btn btn-blue btn-delete-dialog open-dialog btn-info-client" data-toggle="modal" data-target="#infoClientMDL"><i class="fa fa-info-circle icon-col"></i></button>',
                    $row['commandeDate'],
                    '<label class="badge badge-success">Confirmé</label>',
                    ucfirst($row['typeLivraison']),
                    $row['nbrArticles'].'<button type="button" class="btn btn-blue btn-delete-dialog open-dialog btn-info-articles" data-toggle="modal" data-target="#infoArticlesMDL"><i class="fa fa-info-circle icon-col"></i></button>',
                    $row['totalApayer']." DHS",
                ];
            }
        
            return json_encode(array('data' => $data));
        
        endif;
        
        return json_encode(null);
    }

    function AnnulationLivraison($livraisonID){
        global $con;
        
        if(filter_var($livraisonID, FILTER_SANITIZE_NUMBER_INT)):
            $_livraisonID = filter_var($livraisonID, FILTER_SANITIZE_NUMBER_INT);
        
            $query = $con->query(" SELECT commandeID
                                    FROM livraison 
                                    WHERE livraisonID = $_livraisonID
                                    ");
            $row = $query->fetch_row();
            $commandeID = $row[0];
        
            $con->query(" UPDATE commande
                            SET status = 0
                            WHERE commandeID = $commandeID ");
        
        
            // mise à jour unites en stock & unites sur commande
            $query = $con->query(" SELECT * 
                                        FROM commande c INNER JOIN commandedetails cd
                                        ON c.commandeID = cd.commandeID
                                        WHERE status = 0
										AND cd.commandeID = $commandeID");
									   
            if( $query->num_rows > 0 ):
    
            	while($row = $query->fetch_assoc()){
                    
                    $articleID = $row['articleID'];
                    $quantite_comm = $row['quantite'];

                    $con->query(" UPDATE article 
                                SET unitesEnStock = unitesEnStock + $quantite_comm,
                                unitesCommandees = unitesCommandees - $quantite_comm
                                WHERE articleID = $articleID ");
                }
        
            endif;
            // end
        
        
            $con->query(" DELETE FROM livraison
                            WHERE livraisonID = $_livraisonID
                        ");
        
        
            return json_encode(true);
        
        endif;
        
        return json_encode(null);
    }

    // commandes.php [index]
    function AfficherCommandesClient(){
        global $con;
        
        $clientID = filter_var($_SESSION['clientID'], FILTER_SANITIZE_NUMBER_INT);
        
        $query = $con->query(" SELECT * 
                            FROM commande c 
                            INNER JOIN commandedetails cd 
                            ON c.commandeID = cd.commandeID 
                            WHERE clientID = $clientID 
                            AND c.status <> -2
                            GROUP BY cd.commandeID 
                            ORDER BY c.commandeDate DESC");
        
        
        if( $query->num_rows > 0 ):

                $data = array();
                $data2 = array();
                $data3 =array();
                while($row = $query->fetch_assoc()){
                    
                    $commandeID = $row['commandeID'];
                    $query_2 = $con->query("SELECT COUNT(*) FROM commandedetails WHERE commandeID = $commandeID");
                    $row_2 = $query_2->fetch_row();
                                                    
                    if($row_2[0] == 1){
                        
                        $query_3 = $con->query("SELECT * 
                                            FROM commande c INNER JOIN commandedetails cd
                                            ON c.commandeID = cd.commandeID
                                            INNER JOIN article a 
                                            ON cd.articleID = a.articleID
                                            WHERE clientID = $clientID 
                                            AND cd.commandeID = $commandeID
                                            ORDER BY c.commandeDate DESC");
                        $row_3 = $query_3->fetch_assoc();
                        

                        $article = new Article();
                        $imageArticle = $article->ImageArticle($row_3['articleID']);

                        switch($row_3['status']){
                            case 0:
                                $status = '<span class="cart-status-text cart-status-approval">En Attente</span>';
                                $operation = '<button type="button" class="btn btn-red cancel-order">Annuler</button>';
                                break;
                            case 1:
                                $status = '<span class="cart-status-text cart-status-delivered">Confirmé</span>';
                                $operation = 'Aucun operation';
                                break;
                            case 2: 
                                $status = '<span class="cart-status-text cart-status-refused">Refusé</span>';
                                $operation = 'Aucun operation';
                                break;
                            case -1: 
                                $status = '<span class="cart-status-text cart-status-canceled">Annulé</span>';
                                $operation = '<button type="button" class="btn btn-blue re-order">Redemander</button>';
                                break;
                        }

                        if(strlen($row_3['articleNom']) > 60)
                            $artilceNom = substr($row_3['articleNom'], 0, 60).' ...';
                        else
                            $artilceNom = $row_3['articleNom'];

                        $data[] = [
                            $row_3['commandeID'],
                            $row_3['commandeDate'],
                            $status,
                            $row_3['quantite'],
                            $row_3['totalApayer'],
                            ucfirst($row_3['typeLivraison']),
                            $row_3['articleID'],
                            $imageArticle,
                            $artilceNom,
                            $row_3['couleur'],
                            $operation
                        ];
                    }
                    else{
                        $data2 = array();
                        $query_3 = $con->query("SELECT * 
                                            FROM commande c INNER JOIN commandedetails cd
                                            ON c.commandeID = cd.commandeID
                                            INNER JOIN article a 
                                            ON cd.articleID = a.articleID
                                            WHERE clientID = $clientID 
                                            AND cd.commandeID = $commandeID
                                            ORDER BY c.commandeDate DESC");
                    
                        
                        while($row_3 = $query_3->fetch_assoc()){
                            
                            $article = new Article();
                            $imageArticle = $article->ImageArticle($row_3['articleID']);

                            switch($row_3['status']){
                                case 0:
                                    $status = '<span class="cart-status-text cart-status-approval">En Attente</span>';
                                    $operation = '<button type="button" data-id="'.$row_3['commandeID'].'" class="btn btn-red cancel-order">Annuler</button>';
                                    break;
                                case 1:
                                    $status = '<span class="cart-status-text cart-status-delivered">Confirmé</span>';
                                    $operation = 'Aucun operation';
                                    break;
                                case 2: 
                                    $status = '<span class="cart-status-text cart-status-refused">Refusé</span>';
                                    $operation = 'Aucun operation';
                                    break;
                                case -1: 
                                    $status = '<span class="cart-status-text cart-status-canceled">Annulé</span>';
                                    $operation = '<button type="button" data-id="'.$row_3['commandeID'].'" class="btn btn-blue re-order">Redemander</button>';
                                    break;
                            }

                            if(strlen($row_3['articleNom']) > 60)
                                $artilceNom = substr($row_3['articleNom'], 0, 60).' ...';
                            else
                                $artilceNom = $row_3['articleNom'];
                            
                            
                            $data2[] = [
                                $row_3['commandeID'],
                                $row_3['commandeDate'],
                                $status,
                                $row_3['quantite'],
                                $row_3['totalApayer'],
                                ucfirst($row_3['typeLivraison']),
                                $row_3['articleID'],
                                $imageArticle,
                                $artilceNom,
                                $row_3['couleur'],
                                $operation
                            ];
                            
                           
                        }
                         $data3[] = $data2;
                    }
                }
            return json_encode(array('data' => $data, 'data2' => $data3));
                                                    
        endif;
    
        return json_encode(null);
        
    }

    function AnnulerCommande($idComm){
        global $con;
        
        
        $commandeID = filter_var($idComm, FILTER_SANITIZE_NUMBER_INT);
        
        if( !empty($commandeID) ):
        
            $commande = new Commande();
            $verifie_id_comm = $commande->VerifieCommandeID($commandeID);
        
            $query = $con->query(" SELECT status 
                                FROM commande 
                                WHERE commandeID = $commandeID");
            $row = $query->fetch_row();
            $status = $row[0];
        
            if( $verifie_id_comm != null && $status == 0):
        
                $query = $con->query(" UPDATE commande
                                    SET status = -1
                                    WHERE commandeID = $commandeID ");

                if( $con->affected_rows > 0 )
                    return json_encode(true);
        
            endif;
        
            return json_encode(null);
        
        endif;
        
        return json_encode(null);
    }

    function RedemanderCommande($idComm){
        global $con;
        
        $commandeID = filter_var($idComm, FILTER_SANITIZE_NUMBER_INT);
        
        if( !empty($commandeID) ):
        
            $commande = new Commande();
            $verifie_id_comm = $commande->VerifieCommandeID($commandeID);
        
            $query = $con->query(" SELECT status 
                                FROM commande 
                                WHERE commandeID = $commandeID");
            $row = $query->fetch_row();
            $status = $row[0];
        
            if( $verifie_id_comm != null && $status == -1):
        
                $query = $con->query(" UPDATE commande
                                    SET status = 0
                                    WHERE commandeID = $commandeID ");

                if( $con->affected_rows > 0 )
                    return json_encode(true);
            
            endif;
        
            return json_encode(null);
        
        endif;
        
        return json_encode(null);
    }

    function SupprimerCommandeClient($idComm){
        global $con;
        
        $commandeID = filter_var($idComm, FILTER_SANITIZE_NUMBER_INT);
        
        if( !empty($commandeID) ):
        
            $commande = new Commande();
            $verifie_id_comm = $commande->VerifieCommandeID($commandeID);
        
            $query = $con->query(" SELECT status 
                                FROM commande 
                                WHERE commandeID = $commandeID ");
            $row = $query->fetch_row();
            $status = $row[0];
        
            if( $verifie_id_comm != null && $status != 1):
        
                $query = $con->query(" UPDATE commande 
                                    SET status = -2
                                    WHERE commandeID = $commandeID ");
        
                if( $con->affected_rows > 0 )
                    return json_encode(true);
        
            endif;
        
            return json_encode(null);
        
        endif;
        
        return json_encode(null);
    }

    // commentaires.php
    function AfficherCommentaires(){
        global $con;
        
        $client = new Client();
        $commentaire = new Commentaire();
        $query = $commentaire->AfficherCommentaires();
        
        if($query != null):
        
            $data = array();
            while($row = $query->fetch_assoc()){
                
                if($row['accepte'] == 1):
                    $status = '<label class="badge badge-success">Accepté</label>';
                    $action = '<td>accepté</td>';
                else:
                    $status = '<label class="badge badge-danger">En Attente</label>';
                    $action = '<td><button type="button" class="btn btn-green btn-delete-dialog open-dialog accepte-comm"><i class="fas fa-check icon-col"></i></button></td>';
                endif;
                
                $nom_prenom = $client->ClientNomPrenom($row['clientID']);
                
                $count = $row['niveau'];
                $niveau = "";
                for( $i = 0 ; $i < $count ; $i++ )
                { 
                    $niveau .= '<i class="fas fa-star"></i>'; 
                }
                
                $data[] = [
                    '<td><button type="button" class="btn btn-red btn-delete-dialog open-dialog supp-comm">supprimer</button></td>', 
                    $action, 
                    $row['commentaireID'], 
                    $nom_prenom, 
                    $row['titre'], 
                    $row['commentaire'], 
                    $status, 
                    $niveau, 
                    $row['dateComm']
                ];
                
            }
        
            return json_encode(array('data' => $data));
        
        endif;
        
        return json_encode(null);
    }

    function SupprimerCommentaire($commID){
        global $con;
        
        $commentaireID = filter_var($commID, FILTER_SANITIZE_NUMBER_INT);
        
        if(!empty($commentaireID)){
            
            $con->query(" DELETE FROM commentaire WHERE commentaireID = $commentaireID ");
            if( $con->affected_rows > 0 )
                return json_encode(true);    
        }
        
        return json_encode(null);
    }

    function AccepterCommentaire($commID){
        global $con;
        
        $commentaireID = filter_var($commID, FILTER_SANITIZE_NUMBER_INT);
        
        if(!empty($commentaireID)){
            
            $con->query(" UPDATE commentaire SET accepte = 1 WHERE commentaireID = $commentaireID ");
            if( $con->affected_rows > 0 )
                return json_encode(true);    
        }
        
        return json_encode(null);
    }