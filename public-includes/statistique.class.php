<?php
  final class Statistique{
      
    //**** SET functions ***//
      
    static public function MSJ_revenu_total($revenu, $action){ /* action = 1 { incrémenter } = 0 { décémenter } */
        global $con;
        
        switch($action){
            
            case 1:
                $con->query(" INSERT INTO statistiques VALUES('revenu total', $revenu) ON DUPLICATE KEY UPDATE valeur = valeur + $revenu "); 
            break;
            case 0:
                $con->query(" UPDATE statistiques SET valeur = valeur - $revenu WHERE type = 'revenu total' "); 
            break;
        }
    }
      
    static public function MSJ_total_commandes(){
        global $con;
        
        $con->query(" INSERT INTO statistiques VALUES('total commandes', 1) ON DUPLICATE KEY UPDATE valeur = valeur + 1 "); 
    }
      
    static public function MSJ_total_ventes($action){
        global $con;
        
        switch($action){
            
            case 1:
                $con->query(" INSERT INTO statistiques VALUES('total ventes', 1) ON DUPLICATE KEY UPDATE valeur = valeur + 1 "); 
            break;
            case 0:
                $con->query(" UPDATE statistiques SET valeur = valeur - 1 WHERE type = 'total ventes' "); 
            break;
        }
        
    }
      
    static public function MSJ_page_vues(){
        global $con;
        
        $con->query(" INSERT INTO statistiques VALUES('page vues', 1) ON DUPLICATE KEY UPDATE valeur = valeur + 1 "); 
    }
    
    //**** GET functions ***//
      
    //revenu total 
    static public function revenu_total(){
      global $con;
      
      $query = $con->query(" SELECT valeur
                                FROM statistiques
                                WHERE type = 'revenu total' ");
      $row = $query->fetch_row();
      if($row[0] == null)
          return 0;
      return $row[0];
    }
    
    // total commandes
    static public function total_commandes(){
      global $con;
      
      $query = $con->query(" SELECT valeur
                                FROM statistiques
                                WHERE type = 'total commandes' ");
      $row = $query->fetch_row();
      if($row[0] == null)
          return 0;
      return $row[0];
    }
    
    // total des ventes
    static public function total_ventes(){
      global $con;
      
      $query = $con->query(" SELECT valeur
                            FROM statistiques 
                            WHERE type = 'total ventes' ");
      $row = $query->fetch_row();
      if($row[0] == null)
          return 0;
      return $row[0];
    }
    
    // total des clients
    static public function total_clients(){
      global $con;
      
      $query = $con->query(" SELECT COUNT(*)
                            FROM client ");
      $row = $query->fetch_row();
      return $row[0];
    }
    
    // total page vues
    static public function total_page_vues(){
      global $con;
      
      $query = $con->query(" SELECT valeur 
                            FROM statistiques 
                            WHERE type = 'page vues' ");
      $row = $query->fetch_row();
      if($row[0] == null)
          return 0;
      return $row[0];
    }
    
    // total visites
    static public function total_visites(){
      global $con;
      
      $query = $con->query(" SELECT COUNT(*)
                          FROM visiteurs ");
      $row = $query->fetch_row();
      return $row[0];
    }

    // visiteurs actuels => interval 1 minute
    static public function visiteurs_actuels(){
      global $con;
      
      $query = $con->query(" SELECT COUNT(*) 
                          FROM visiteurs 
                          WHERE dateVisite > now() - INTERVAL 1 MINUTE ");
      $row = $query->fetch_row();
      return $row[0];
    }

    // taux profit par rapport hier
    static public function profit_statistiques(){
      global $con;
      
      $query = $con->query(" SELECT SUM(totalApayer)
                            FROM commande
                            WHERE status = 1
                            AND DATE(commandeDate) = DATE(NOW() - INTERVAL 1 DAY) ");
      $row = $query->fetch_row();
      ($row[0] == null) ? $profit_hier = 0 : $profit_hier = $row[0];

      $query = $con->query(" SELECT SUM(totalApayer)
                            FROM commande
                            WHERE status = 1
                            AND DATE(commandeDate) = DATE(NOW()) ");
      $row = $query->fetch_row();
      ($row[0] == null) ? $profit_aujourd = 0 : $profit_aujourd = $row[0];

      if($profit_hier != 0)
        $taux_profit = number_format(( $profit_aujourd * 100 ) / $profit_hier , 2);
      else
        $taux_profit = number_format(( $profit_aujourd * 100 ), 2);

      return array(
        'taux_profit' => $taux_profit,
        'profit_aujourd' => $profit_aujourd,
        'profit_hier' => $profit_hier
      );
    }

    // taux visites par rapport hier
    static public function visites_statistiques(){
      global $con;

      $query = $con->query(" SELECT COUNT(*) 
                            FROM visiteurs 
                            WHERE DATE(dateVisite) = DATE( now() - INTERVAL 1 DAY ) ");
      $row = $query->fetch_row();
      $visites_hier = $row[0];

      $query = $con->query(" SELECT COUNT(*) 
                            FROM visiteurs 
                            WHERE DATE(dateVisite) = DATE(now()) ");
      $row = $query->fetch_row();
      $visites_aujourd = $row[0];

      if( $visites_hier != 0 )
        $taux_visites = number_format(( $visites_aujourd * 100 ) / $visites_hier, 2);
      else
        $taux_visites = number_format(( $visites_aujourd * 100 ), 2);

      return array( 
        'taux_visites' => $taux_visites, 
        'visites_hier' => $visites_hier, 
        'visites_aujourd' => $visites_aujourd 
      );
    }
    
  }
    
    
