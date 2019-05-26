<?php 

    require 'config.php';

/**************************************************************
    START login.php / register.php / registerSecurity.php  FUNCTIONS
**************************************************************/
    
    // get register theme 
    function get_register_theme(){
        if(isset($_GET['plan']))
        {
            $plan = $_GET['plan'];
            if($plan == 'student')
                return '<link rel="stylesheet" type="text/css" href="assets/style/themes/student_theme.css">';
            else if($plan == 'professor')
                return '<link rel="stylesheet" type="text/css" href="assets/style/themes/prof_theme.css">';
            else if($plan == 'admin')
                return '<link rel="stylesheet" type="text/css" href="assets/style/themes/admin_theme.css">';
            else
                header('location: plans/plans.php');
            
            return false;
        }  
        else
            header('location: login.php');
    }

    // insert registerSecurity query
    function insert_register_query($table,$username,$email,$prenom,$nom,$pass,$gender,$reponse,$question){
        global $con;
        if($table == 'professeur')
            $rq = "insert into $table values('$username','$email','$prenom','$nom','$pass',NULL, NULL, NULL, NULL, '$gender', NULL, NULL, '$reponse', '$question')";
        else if($table == 'etudient')
            $rq = "insert into $table values('$username','$email','$prenom','$nom','$pass',NULL, NULL, NULL, NULL,'$gender', NULL, NULL,'$reponse','$question',null)";
        // admin
        return mysqli_query($con,$rq);
    }

    // select login query 
    function select_login_query($select,$table,$where,$username,$pass){
        global $con;
        $rq = "SELECT $select FROM $table WHERE $where = '$username' AND motdepasse='$pass'";
        return mysqli_query($con,$rq);
    }

/**************************************************************
    END login.php / register.php / registerSecurity.php  FUNCTIONS
**************************************************************/
    
/***********************************
    START groups FUNCTIONS
***********************************/

    // get groupe name by id
    function get_groupeName($id){
        global $con;
        $rq = "SELECT nom FROM groupe WHERE id = '$id'";
        $res = mysqli_query($con, $rq);
        $row = mysqli_fetch_assoc($res);
        return $row['nom'];
    }

    // get groupes count
    function get_group_count($username_prof){
        global $con;
        $rq = "SELECT count(id) FROM groupe WHERE pseudo_prof = '$username_prof'";
        $res = mysqli_query($con,$rq);
        $row = mysqli_fetch_assoc($res);
        return $row['count(id)'];
    }

    // get groupe id by prof username
    function get_grpId_byProf($username){
        global $con;
        $rq = "SELECT id FROM groupe WHERE pseudo_prof = '$username'";
        $res = mysqli_query($con,$rq);
        $row = mysqli_fetch_assoc($res);
        return $row['id'];
    }

    // get groupe id by student username
    function get_grpId_byStud($username){
        global $con;
        $rq = "SELECT groupe_id FROM etudient WHERE pseudo_etu = '$username'";
        $res = mysqli_query($con,$rq);
        $row = mysqli_fetch_assoc($res);
        return $row['groupe_id'];
    }

    // get groupe id by name
    function get_groupeId_byName($name){
        global $con;
        $rq = "SELECT id FROM groupe WHERE id = '$name'";
        $res = mysqli_query($con, $rq);
        $row = mysqli_fetch_assoc($res);
        return $row['id'];
    }


/***********************************
    END groups FUNCTIONS
***********************************/

/***********************************
    START FUNCTIONS RELATED IN PAGES
***********************************/

    // get actual name page
    function get_pageName(){
        $page = explode('.', basename($_SERVER['PHP_SELF']));
        return ucfirst($page[0]);
    }

/***********************************
    END FUNCTIONS RELATED IN PAGES
***********************************/

/***********************************
    START index FUNCTIONS
***********************************/

    // add default pictures
    function image_query(){
        global $con;
        $rq = "UPDATE etudient SET image_etu = 'user-male.png' WHERE sexe_etu = 'male' AND (image_etu IS NULL OR image_etu = '') ";
        mysqli_query($con, $rq);
        $rq = "UPDATE etudient SET image_etu = 'user-female.png' WHERE sexe_etu = 'female' AND (image_etu IS NULL OR image_etu = '') ";
        mysqli_query($con, $rq);
        $rq = "UPDATE professeur SET image_prof = 'user-female.png' WHERE sexe_prof = 'female' AND (image_prof IS NULL OR image_prof = '') ";
        mysqli_query($con, $rq);
        $rq = "UPDATE professeur SET image_prof = 'user-male.png' WHERE sexe_prof = 'male' AND (image_prof IS NULL OR image_prof = '') ";
        mysqli_query($con, $rq);
    }

    // get register theme 
    function get_index_theme(){
        if(isset($_SESSION['plan']))
        {
            $plan = $_SESSION['plan'];
            if($plan == 'student')
                return '<link rel="stylesheet" type="text/css" href="../assets/style/themes/student_theme.css"/>';
            else if($plan == 'professor')
                return '<link rel="stylesheet" type="text/css" href="../assets/style/themes/prof_theme.css"/>';
            else if($plan == 'admin')
                return '<link rel="stylesheet" type="text/css" href="../assets/style/themes/admin_theme.css"/>';
            else
                header('location: plans/plans.php');
            
            return false;
        }  
        else
            header('location: login.php');
    }

    // select home query 
    function select_index_query($select,$table,$where,$username){
        global $con;
        $usern = mysqli_real_escape_string($con, $username);
        $rq = "SELECT $select FROM $table WHERE $where = '$usern'";
        $res = mysqli_query($con,$rq);
        return mysqli_fetch_assoc($res);
    }

    // set groupe first login && set group if groupe history is not exists
    function set_groupe_history($username){
        global $con;
        // check if prof has a history group 
        $res = mysqli_query($con,"SELECT grp_id FROM groupe_historique WHERE pseudo_prof ='$username'");
        if(mysqli_num_rows($res) == 0){
            // if not has a history group => check if has created a group before
            $rq = "select id FROM groupe WHERE pseudo_prof = '$username' order by date_creation desc";
            $res = mysqli_query($con,$rq);
            // if have a group => get the last group created and set it as a group history
            if(mysqli_num_rows($res) != 0){
                $row = mysqli_fetch_assoc($res);
                $rq = " INSERT INTO groupe_historique VALUES('$username','".$row['id']."')";
                mysqli_query($con,$rq);
            }
        }
    }

/***********************************
    END index FUNCTIONS
***********************************/

/***********************************
    START files FUNCTIONS
***********************************/

    // insert file query
    function insert_file_query($grp_id, $file_name, $file_type){
        global $con;
        $rq = "INSERT INTO fichier VALUES('$file_name','$file_type',now(),'$grp_id')";
        return mysqli_query($con,$rq);
    }

    // get date file & time unit
    function get_time_unit($fich_date){
        $datenow = time();
        $file_date = strtotime($fich_date);
        $time_left = $datenow - $file_date;
        switch($time_left){
            case ($time_left > 0 && $time_left < 20): // now before 20 seconds
                $time_left = null;
                $unit = 'Now';break;
            case ($time_left >= 60 && $time_left < 60*60): // minitue
                $time_left = floor($time_left / 60);
                $unit = 'minutes';break;
            case ($time_left >= 60*60 && $time_left < 60*60*24): // hours
                $time_left = floor($time_left / (60*60));
                $unit = 'hours';break;
            case ($time_left >= 60*60*24 && $time_left < 60*60*24*7); // days
                $time_left = floor($time_left / (60*60*24));
                $unit = 'days';break;
            case ($time_left >= 60*60*24*7 && $time_left < 60*60*24*7*4); // weeks
                $time_left = floor($time_left / (60*60*24*7));
                $unit = 'weeks';break;
            case ($time_left >= 60*60*24*7*4 && $time_left < 60*60*24*7*4*12); // months
                $time_left = floor($time_left / (60*60*24*7*4));
                $unit = 'months';break;
            case ($time_left >= 60*60*24*7*4*12); // years
                $time_left = floor($time_left / (60*60*24*7*4*12));
                $unit = 'years';break;
            default: $unit = 'Seconds';
        }
        return array('time_left' => $time_left, 'unit' => $unit);
    }

    // load courses
    function load_files_query($grp_id,$file_type,$current_page){
        global $con;
        $courses = array();
        $rq = "SELECT * FROM fichier WHERE type = '$file_type' AND groupe_id = '$grp_id' ORDER BY fich_date DESC";
        $res = mysqli_query($con,$rq);
        $i = 0;
        $courses[] = array();
    
        while($row = mysqli_fetch_assoc($res)){  
            $file_name = $row['nom'];
            $fich_date = $row['fich_date']; 
            // get time left and time unit
            $unit_and_time_left = get_time_unit($fich_date); // use (get_time_unit) function
            $time_left = $unit_and_time_left['time_left'];
            $unit = $unit_and_time_left['unit']; 
            // generate icons
            $file_extension = get_file_extension($file_name);
            if($file_extension != 'png' && $file_extension != 'jpg' && $file_extension != 'jpeg'){
                $icon_dir = generate_icon($file_name,$current_page);
                $css = 'background-size: contain;';
            }
            else{
                $icon_dir = '../cloud/'.$file_name;
                $css = 'background-size: cover;';
            }
            // ajax data
            $courses[$i] = '<div class="file col-xs-6 col-sm-4 col-md-2 col-lg-3" style="border:1px solid #ddd;height:200px;margin-top:20px;padding:0;position:relative;background-image: url('.$icon_dir.');'.$css.'">
            <div class="file-date" style="padding:5px;color:#fff;background-color:#708ba2;opacity:0.7;width:100%"><span id="date">'.$time_left.' '.$unit.'</span>
            <i id="'.$file_name.'" style="float:right;font-size:large;cursor:pointer;display:none;" class="delete_file fas fa-times-circle"></i>
            </div>
            <div id="ms-container">
                <label class="label-ms"  for="ms-download">
                    <div class="ms-content">
                        <div class="ms-content-inside">
                            <input type="checkbox" id="ms-download" />
                            <div class="ms-line-down-container">
                                <div class="ms-line-down"></div>
                            </div>
                            <div class="ms-line-point"></div>
                        </div>
                    </div>
                </label>
            </div>          
            <div class="desc" style="padding:5px;color:#fff;background-color:#333;bottom:0;opacity:.9;position:absolute;width:100%"><span class="title">'.$file_name.'</span></div>
            <div class="download-container text-center" style="height:0"><a href="../cloud/'.$file_name.'" download><button type="button" class="btn-download btn btn-default" style="background-color:#333;color:#fff;z-index:999;margin-top:45px;">DOWNLOAD</button></a>
		    </div>
            </div><script>subtruct_title()</script><script>show_delete_file_control()</script>';
            $i= $i + 1;
        }
        
        return $courses;
        
    }

    // generate icons files
    function get_file_extension($file_name){
        // get file extension
        $file_name = explode('.', $file_name);
        $file_extension = end($file_name);
        return $file_extension;
    }

    // generate files icons
    function generate_icon($file_name,$current_page){
        // variables
        $icon_file_dir = null;
        $icons = array();
        // get file extension for generate icon
        $file_extension = get_file_extension($file_name);
        if($current_page != 'Delete_all_files'){

            $dir = '../assets/icons/icons_files/';
            // get array of icons extensions
            foreach (scandir($dir) as $icon) {
                if ('.' === $icon) continue;
                if ('..' === $icon) continue; 
                // get first part of file name without extension
                /*$ex = explode('.',$icon);
                $icon_extension = reset($ex);*/
                $ready = str_replace(array('.','-'),'.',$icon);
                $icon_name = explode('.',$ready);
                $icon_first_name = reset($icon_name);
                $icons[] = $icon_first_name;
            }

            // get icon file directory 
            foreach($icons as $icon_name){
                if($icon_name == $file_extension)
                    $icon_file_dir = '../assets/icons/icons_files/'.$icon_name.'.png'; 
            }
            
        }
        // return icon file directory
        return $icon_file_dir;    
    }

    // get files count
    function get_files_count($current_page, $grp_id){
        global $con;
        switch($current_page){
            case ($current_page == 'Courses'):
                $type = 'course';break;
            case ($current_page == 'Exams'):
                $type = 'exercice';break;
            default: $type = 'autre';
        }
      
        $res = mysqli_query($con,"select count(nom) from fichier WHERE type = '$type' AND groupe_id = '$grp_id' ");
        $row = mysqli_fetch_assoc($res);
        return $row['count(nom)'];   
    }

/***********************************
    END files FUNCTIONS
***********************************/

?>