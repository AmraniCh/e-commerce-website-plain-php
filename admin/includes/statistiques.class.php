<?php
  final class Statistiques{
    
    //revenu total 
    static public function revenut_total(){
      global $con;
      
      $query = $con->query(" SELECT SUM(totalApayer)
                                FROM commande
                                WHERE status = 1 ");
      $row = $query->fetch_row();
      if($row[0] != null)
        return $row[0];
      
      return 0; 
    }
    
    // total commandes
    static public function total_commandes(){
      global $con;
      
      $query = $con->query(" SELECT COUNT(*)
                            FROM commande ");
      $row = $query->fetch_row();
      return $row[0];
    }
    
    // total des ventes
    static public function total_ventes(){
      global $con;
      
      $query = $con->query(" SELECT COUNT(*)
                            FROM commande 
                            WHERE status = 1 ");
      $row = $query->fetch_row();
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
      return $row[0];
    }
    
    // total visites
    static public function total_visites(){
      global $con;
      
      $query = $con->query(" SELECT COUNT(*)
                          FROM visiteursenligne ");
      $row = $query->fetch_row();
      return $row[0];
    }

    // visiteurs actuels => interval 1 minute
    static public function visiteurs_actuels(){
      global $con;
      
      $query = $con->query(" SELECT COUNT(*) 
                          FROM visiteursenligne 
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
                            FROM visiteursenligne 
                            WHERE DATE(dateVisite) = DATE( now() - INTERVAL 1 DAY ) ");
      $row = $query->fetch_row();
      $visites_hier = $row[0];

      $query = $con->query(" SELECT COUNT(*) 
                            FROM visiteursenligne 
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
    
    
