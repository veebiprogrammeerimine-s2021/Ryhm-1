<?php
    $id = null;
    $type = "image/png";
    $output = "../pics/wrong.png";
    $privacy = 3;
    
    if(isset($_GET["photo"]) and !empty($_GET["photo"])){
        $id = filter_var($_GET["photo"], FILTER_VALIDATE_INT);
    }
    
    if(!empty($id)){
        require_once("../../../../config_vp_s2021.php");
        $database = "if21_rinde";
        $conn = new mysqli($server_host, $server_user_name, $server_password, $database);
        $conn->set_charset("utf8");
        $stmt = $conn->prepare("SELECT filename from vpr_photos WHERE id = ? AND privacy = ? AND deleted IS NULL");
        echo $conn->error;
        $stmt->bind_param("ii", $id, $privacy);
        $stmt->bind_result($filename_from_db);
        $stmt->execute();
        if($stmt->fetch()){
            $output = $photo_normal_upload_dir .$filename_from_db;
            $check = getimagesize($output);
            $type = $check["mime"];
        }
        $stmt->close();
        $conn->close();
    }
    header("Content-type: " .$type);
    readfile($output);
        
    
        
        