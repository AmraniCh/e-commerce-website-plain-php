<?php 
    require_once '../../public-includes/config.php';
    require_once '../../public-includes/classes.php';
    session_start();

    $called_function = $_POST['function'];

    switch($called_function)
    {
      case "CommandesVues":
        echo $_POST['function']();break;
      break;
      case "AfficherNotifications":
        echo $_POST['function']();break;
      case "NbNotification":
        echo $_POST['function']();break;
      case "NotificationsVues":
        echo $_POST['function']();break;
      case "AfficherNotificationsTable":
        echo $_POST['function']();break;
    }

    function CommandesVues(){
      global $con;

      $con->query(" UPDATE commande
                  SET vu = 1");
      if( $con->affected_rows > 0 )
          return json_encode(true);

      return json_encode(null);
    }

    function AfficherNotifications(){
      global $con;
      
      $query = $con->query(" SELECT * FROM notification WHERE vu = 0 ORDER BY dateNot DESC");
      
      if( $query->num_rows > 0 ):

        $data = array();
        while($row = $query->fetch_assoc()){

          $passed_time = get_passed_time($row['dateNot'])['passed_time'];
          $unit = get_passed_time($row['dateNot'])['unit'];

          $data[] = [
            'titre' => $row['titre'],
            'passed_time' => $passed_time,
            'unit' => $unit,
            'type' => $row['type']
          ];

        }
      
        return json_encode(array('data' => $data));
      
      endif;
      
      return json_encode(null);
    }

    function NotificationsVues(){
      global $con;

      $con->query(" UPDATE notification
                  SET vu = 1");
      if( $con->affected_rows > 0 )
          return json_encode(true);

      return json_encode(null);
    }

    function NbNotification(){
      global $con;
      
      // nbr notification
      $query = $con->query(" SELECT COUNT(*)
                          FROM notification
                          WHERE vu = 0");
      $row_1 = $query->fetch_row();
      
      // nbr commande en attente
      $query = $con->query(" SELECT COUNT(*)
                                FROM commande 
                                WHERE status = 0");
      $row_2 = $query->fetch_row();
      
      // nbr commentaire en attente
      $query = $con->query(" SELECT COUNT(*)
                                FROM commentaire 
                                WHERE accepte = 0");
      $row_3 = $query->fetch_row();
      
      // data
      $data = array();
      $data[] = [ 'nb_commentaires' => $row_3[0], 'nb_commandes' => $row_2[0], 'nb_not' => $row_1[0] ];
      
      return json_encode($data);
    }

    function AfficherNotificationsTable(){
      global $con;
      
      $query = $con->query(" SELECT * FROM notification ORDER BY dateNot DESC");
      
      if( $query->num_rows > 0 ):

        $data = array();
        while($row = $query->fetch_assoc()){

          $passed_time = get_passed_time($row['dateNot'])['passed_time'];
          $unit = get_passed_time($row['dateNot'])['unit'];

          $data[] = [
            $row['notID'],
            $row['titre'],
            $passed_time.' '.$unit,
          ];

        }
      
        return json_encode(array('data' => $data));
      
      endif;
      
      return json_encode(null);
    }

    function get_passed_time($not_date){
      $datenow = time();
      $_not_date = strtotime($not_date);
      $time_left = $datenow - $_not_date;
      switch($time_left){
          case ($time_left > 0 && $time_left < 20): // now before 20 seconds
              $time_left = 'maintenant';
              $unit = '';
          break;
          case ($time_left >= 60 && $time_left < 60*60): // minitue
              $time_left = floor($time_left / 60);
              ( $time_left > 1 ) ? $unit = 'minutes' : $unit = 'minute';
          break;
          case ($time_left >= 60*60 && $time_left < 60*60*24): // hours
              $time_left = floor($time_left / (60*60));
              ( $time_left > 1 ) ? $unit = 'heures' : $unit = 'heure';
          break;
          case ($time_left >= 60*60*24 && $time_left < 60*60*24*7); // days
              $time_left = floor($time_left / (60*60*24));
              ( $time_left > 1 ) ? $unit = 'jours' : $unit = 'jour';
          break;
          case ($time_left >= 60*60*24*7 && $time_left < 60*60*24*7*4); // weeks
              $time_left = floor($time_left / (60*60*24*7));
              ( $time_left > 1 ) ? $unit = 'semaines' : $unit = 'semaine';
          break;
          case ($time_left >= 60*60*24*7*4 && $time_left < 60*60*24*7*4*12); // months
              $time_left = floor($time_left / (60*60*24*7*4));
              $unit = 'mois';
          break;
          case ($time_left >= 60*60*24*7*4*12); // years
              $time_left = floor($time_left / (60*60*24*7*4*12));
              ( $time_left > 1 ) ? $unit = 'années' : $unit = 'année';
          break;
          default: $unit = 'secondes';
      }
      return array('passed_time' => $time_left, 'unit' => $unit);
    }