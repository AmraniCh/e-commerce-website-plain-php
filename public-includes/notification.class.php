<?php
    require_once 'classes.php';

    final class Notification{
      
      static public function NouveauNotification($type, $clientID, $valeur){
        global $con;
        
        $client = new Client();
        if($clientID != null) 
            $nom_prenom = $client->ClientNomPrenom($clientID);
        
        switch($type){
          case "client":
            $contenu = "Nouveau Client Enregistré";
          break;
          case "commande":
            $contenu = "Nouveau Commande de [".$nom_prenom."]";
          break;
          case "commentaire":
            $contenu = "Nouveau Commentaire de [".$nom_prenom."]";
          break;
          case "erreur[php_mailer]":
            $contenu = "PHPMailer erreur : => ".$valeur;
          break;
        }
        
        $con->query(" INSERT INTO notification VALUES(null, '".$contenu."', default, '".$type."', default) ");
        
      }
        
    }