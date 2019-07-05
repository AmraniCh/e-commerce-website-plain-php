<?php

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
				for($i=0;$i<$count;$i++)
				{
					$niveau = $niveau.'<i class="fa fa-star"></i>';
				}
				return $niveau;
			}
		
			public function ProduitsParCategorie($categorie){
				$result = $this->con->query("SELECT * FROM article inner join categorie 
					on article.categorieID = categorie.categorieID
					where categorie.categorieNom = '$categorie' ORDER BY dateAjoute DESC");
				return $result;
			}
			
			public function NouveauxProduitsAleatoire(){
				$result = $this->con->query("SELECT * FROM article ORDER BY RAND()");
				return $result;
			}
		
			public function ProduitsWidget($categorie){
				$result = $this->con->query("SELECT * FROM article inner join categorie 
					on article.categorieID = categorie.categorieID
					where categorie.categorieNom = '$categorie' ORDER BY RAND() LIMIT 3");
				return $result;
			}
		
		}