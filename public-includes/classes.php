<?php

	final class Client{
		private $con;
		
		public function __construct(){
			global $con;
			$this->con = $con;
		}
		
		public function NbrArticlesPanier($clientID){
			$query = $this->con->query("SELECT articleID,clientID FROM panierDetails WHERE clientID = $clientID GROUP BY articleID,clientID ");
            return $this->con->affected_rows;
		}
	}

	final class Article{
			
		private $con;

		public function __construct()
		{
			global $con;
			$this->con = $con;
		}

		public function AfficherArticles(){
			$result = $this->con->query("SELECT * FROM article ORDER BY dateAjoute DESC");
			return $result;
		}

		public function ImageArticle($articleID){
			$result = $this->con->query("SELECT * FROM imagearticle WHERE articleID = $articleID limit 1");
			if($row = $result->fetch_row())
			$image = '../uploaded/articles-images/'.$row[0];
			else
			$image = '../index/img/not-founded.jpg';
			return $image;
		}

		public function echoNiveau($articleID){
			$result = $this->con->query("SELECT niveau FROM article WHERE articleID = $articleID");
			$row = $result->fetch_row();
			$count = $row[0];
			$niveau = '';
			for($i=0;$i<$count;$i++) {
				$niveau=$niveau.'<i class="fa fa-star"></i>';
			}
			return $niveau;
		}

		public function ProduitsParCategorie($categorie){
			$result = $this->con->query("SELECT * FROM article inner join categorie
			on article.categorieID = categorie.categorieID
			where categorie.categorieNom = '$categorie' ORDER BY dateAjoute DESC");
			if($result->num_rows > 0)
					return $result;
			return null;
		}
		
		public function NouveauxProduitsAleatoire(){
			$result = $this->con->query("SELECT * FROM article ORDER BY RAND()");
			if($result->num_rows > 0)
					return $result;
			return null;
		}

		public function ProduitsWidget($categorie){
			$result = $this->con->query("SELECT * FROM article inner join categorie
			on article.categorieID = categorie.categorieID
			where categorie.categorieNom = '$categorie' ORDER BY RAND() LIMIT 3");
			if($result->num_rows > 0)
					return $result;
			return null;
		}
		
		public function RechercherArticle($categorieID, $mot)
		{
			if($mot != ''){
				if($categorieID == 'tout')
					$result = $this->con->query("SELECT * FROM article WHERE articleNom LIKE '%$mot%' ORDER BY dateAjoute DESC");
				else
					$result = $this->con->query("SELECT * FROM article inner join categorie
					on article.categorieID = categorie.categorieID
					where categorie.categorieID = '$categorieID' AND article.articleNom like '%$mot%' ORDER BY dateAjoute");
				if($result->num_rows > 0)
					return $result;
				return null;
			}
			return null;
		}
		
		public function NbrProduits()
		{
			$query = $this->con->query("SELECT COUNT(*) FROM article");
			$row = $query->fetch_row();
			return $row[0];	
		}
		
		public function NbrProduitsParCategorie($categorieID){
			$query = $this->con->query("SELECT COUNT(*) FROM article WHERE categorieID = $categorieID");
			$row = $query->fetch_row();
			return $row[0];
		}
		
		public function NbrProduitsParMarque($marque){
			$query = $this->con->query("SELECT COUNT(*) FROM article WHERE articleMarque = '$marque'");
			$row = $query->fetch_row();
			return $row[0];
		}
	}

	final class Categorie{
    	private $con;

    	function __construct(){
			global $con;
			$this->con = $con;
    	}

    	public function AfficherCategories(){
			$result = $this->con->query("SELECT * FROM categorie ORDER BY categorieNom");
			return $result;
    	}

    	public function echoBadge($active){
			if($active == 0)
			return "<label class='badge badge-danger'>Pas Active</label>";
			else
			return "<label class='badge badge-success'>Active</label>";
			return null;
		}
		
		public function CategorieNomParID($categorieID){
			$query = $this->con->query("SELECT categorieNom FROM categorie WHERE categorieID = $categorieID");
			$row = $query->fetch_row();
			return $row[0];
		}
	}
		
	final class Panier{
		private $con;

		public function __construct(){
			global $con;
			$this->con = $con;
		}

		function AfficherPanierProduits($clientID){
			$query = $this->con->query("SELECT DISTINCT article.articleID, article.articleNom, article.articlePrix, article.articlePrixRemise, article.remiseDisponible, COUNT(panierdetails.articleID) as 'NbrArticlesPanier' FROM article inner join panierDetails on article.articleID = panierDetails.articleID WHERE panierDetails.clientID = $clientID GROUP BY article.articleID, article.articleNom, article.articlePrix, article.articlePrixRemise, article.remiseDisponible");
			return $query;
		}
	}