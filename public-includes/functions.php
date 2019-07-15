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
