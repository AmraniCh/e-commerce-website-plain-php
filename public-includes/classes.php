<?php
	final class Client{
		private $con;
		
		public function __construct(){
			global $con;
			$this->con = $con;
		}
		
		public function PanierClient()
		{
			$clientID = filter_var($_SESSION['clientID'], FILTER_SANITIZE_NUMBER_INT);
			
			$query = $this->con->query("SELECT panierID from client WHERE clientID = $clientID");
			$row = $query->fetch_row();
			
			if($row[0] == null):
				// créer panier client 
				$insert = $this->con->query("INSERT INTO panier VALUES(null, default)");
				$select = $this->con->query("SELECT panierID FROM panier ORDER BY dateAjoute Desc");
				$row = $select->fetch_row();
				$update = $this->con->query("UPDATE client SET panierID = $row[0] WHERE clientID = $clientID");
				return $row[0];
			
			else:
				return $row[0];	
			endif;
			
			return null;
		}
		
		public function NbrArticlesPanier(){
			$clientID = filter_var($_SESSION['clientID'], FILTER_SANITIZE_NUMBER_INT);
			$query = $this->con->query("select count(*)
						from panierdetails pd 
						INNER join panier p
						on pd.panierID = p.panierID 
						inner join client c 
						on c.panierID = p.panierID 
						where c.clientID = $clientID");
			$row = $query->fetch_row();
            return $row[0];
		}
		
		public function ArticlePanierExiste($articleID){
			$clientID = filter_var($_SESSION['clientID'], FILTER_SANITIZE_NUMBER_INT);
			$query = $this->con->query("select *
						from panierdetails pd 
						INNER join panier p
						on pd.panierID = p.panierID 
						inner join client c 
						on c.panierID = p.panierID
						where c.clientID = $clientID AND pd.articleID = $articleID");
			
			if($this->con->affected_rows > 0):
			
				$panierID = $this->PanierClient();
				$row = $query->fetch_assoc();
				$quantite = $row['quantite'];
				$query = $this->con->query("UPDATE panierdetails SET quantite = quantite + 1 WHERE panierID = $panierID AND articleID = $articleID");
			
				return true;
			
			endif;
			
			return null;
		}
        
        public function NbrArticlesFavoris($clientID){
			$query = $this->con->query("SELECT articleID,clientID FROM favoridetails WHERE clientID = $clientID GROUP BY articleID,clientID");
            return $this->con->affected_rows;
		}
		
		public function AfficherClients(){ 
        $result = $this->con->query("SELECT * FROM client ORDER BY clientID");
        return $result;
        }
                
        public function EmailValide($valide){
			if($valide == 0)
				return "<label class='badge badge-danger'>Pas validé</label>";
			else
				return "<label class='badge badge-success'>Validé</label>";
			return null;
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
			if($query->num_rows > 0)
			{
				$row = $query->fetch_row();
				return $row[0];
			}
			return null;
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
			if($query->num_rows > 0):
				$row = $query->fetch_row();
				return $row[0];
			endif;
			return null;
		}
	}
		
	final class Panier{
		private $con;

		public function __construct(){
			global $con;
			$this->con = $con;
		}

		function AfficherPanierProduits(){
			$clientID = filter_var($_SESSION['clientID'], FILTER_SANITIZE_NUMBER_INT);
			$query = $this->con->query("SELECT a.*, pd.*
						FROM panierdetails pd 
						INNER JOIN panier p 
						ON pd.panierID = p.panierID 
						INNER JOIN client c 
						ON c.panierID = p.panierID 
						INNER JOIN article a 
						ON a.articleID = pd.articleID
						WHERE clientID = $clientID");
			if($query->num_rows > 0)
				return $query;
			return null;
		}
	}

    final class Favori{
        private $con;

		public function __construct(){
			global $con;
			$this->con = $con;
		}
        
        public function AfficherProduitsFavoris(){
			$clientID = $_SESSION['clientID'];
            $query = $this->con->query("SELECT article.articleID, article.articleNom, article.articleDescription, article.articlePrix, article.articlePrixRemise, article.remiseDisponible, favoridetails.dateAjoute FROM article inner join favoridetails ON article.articleID = favoridetails.articleID WHERE favoridetails.clientID = $clientID GROUP BY article.articleID, article.articleNom, article.articleDescription, article.articlePrix, article.articlePrixRemise, article.remiseDisponible, favoridetails.dateAjoute ORDER BY favoridetails.dateAjoute DESC");
            if($query->num_rows > 0)
				return $query;
			return null;
        }
    }