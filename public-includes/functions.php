<?php
    require_once 'config.php';

function ArticleParID($articleID){
    global $con;
    $result = $con->query("SELECT * FROM article WHERE articleID = '$articleID'");
    return $result;
}

function CouleursArticle($articleID){
    global $con;
    $result = $con->query("SELECT nomCouleur FROM couleurarticle WHERE articleID = $articleID");
    $rows = $result->fetch_row();
    $couleurs = array();
    if($rows[0] != null){
        foreach($rows as $couleur){
            $couleurs[] = $couleur;
        }
        return $couleurs;
    }
    return null;
}

function ImagesArticle($articleID){
    global $con;
    $result = $con->query("SELECT imageArticleNom FROM imagearticle WHERE articleID = $articleID");
    return $result;
}

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

<<<<<<< HEAD
=======
function returnTabWidget($categorieNom){
    $article = new Article();
    $categorie = new Categorie();
    $query = $article->ProduitsWidget($categorieNom);
    $return = "<div>";
    while($row = $query->fetch_assoc()){
        $imageArticle = $article->ImageArticle($row['articleID']);
        $categorieNom = $categorie->CategorieNomParID($row['categorieID']);
        if ($row['remiseDisponible'] == true) {
        $return.="<div class='product-widget'>
            <div class='product-img'>
                <img src=".$imageArticle." alt=".$imageArticle.">
            </div>
            <div class='product-body'>
                <p class='product-category'><img src='img/new.png'></p>
                <h3 class='product-name'><a href='product.php?id=" . $row['articleID']. "'>".$row['articleNom']."</a></h3>
                <h4 class='product-price'>".$row['articlePrix']."<del class='product-old-price'>".$row['articlePrixRemise']."</del></h4>
            </div>
        </div>";
        }
        else{
        $return.= "<div class='product-widget'>
            <div class='product-img'>
                <img src=".$imageArticle." alt=".$imageArticle.">
            </div>
            <div class='product-body'>
                <p class='product-category'><img src='img/new.png'></p>
                <h3 class='product-name'><a href='product.php?id=" . $row['articleID']. "'>".$row['articleNom']."</a></h3>
                <h4 class='product-price'>".$row['articlePrix']."</h4>
            </div>
        </div>";
        }
    }
    $return.= "</div>";
    return $return;
}


 function echoImages($articleID){
    $result = ImagesArticle($articleID);
    $images = '';

     while( $row = mysqli_fetch_array($result)){
         $images = $images.' <div class="product-preview">
								<img src=img/'.$row['imageArticleNom'].'  alt="">
							</div> ';
     }

        return $images;

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
>>>>>>> ccfdf0b6f2eeacd45e8cbb4ae464cd935c73c43b
