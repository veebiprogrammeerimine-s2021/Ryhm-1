<?php
    //alustame sessiooni
    session_start();
    //kas on sisselogitud
    if(!isset($_SESSION["user_id"])){
        header("Location: page.php");
    }
    //väljalogimine
    if(isset($_GET["logout"])){
        session_destroy();
        header("Location: page.php");
    }
	
    require_once("../../../../config_vp_s2021.php");
    require_once("fnc_general.php");
	require_once("fnc_gallery.php");
    
    $public_from = 2;
    $page = 1;
    $limit = 20;
    $photo_count = count_public_photos($public_from);
    //https://greeny.cs.tlu.ee/~rinde/vp2021/Ryhm-1/09_tund/gallery_public.php?page=3
    if(!isset($_GET["page"]) or $_GET["page"] < 1){
        $page = 1;
    } elseif(round($_GET["page"] - 1) * $limit >= $photo_count){
        $page = ceil($photo_count / $limit);
    } else {        
        $page = $_GET["page"];
    }
    
    $to_head = '<link rel="stylesheet" type="text/css" href="style/gallery.css">';
    require("page_header.php");
?>

	<h1><?php echo $_SESSION["first_name"] ." " .$_SESSION["last_name"]; ?>, veebiprogrammeerimine</h1>
	<p>See leht on valminud õppetöö raames ja ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimus <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<hr>
    <ul>
        <li><a href="?logout=1">Logi välja</a></li>
		<li><a href="home.php">Avaleht</a></li>
    </ul>
	<hr>
    <h2>Avalike fotode galerii</h2>
    <div>
    <p>
    <?php
        //<span>Eelmine leht</span> | <span>Järgmine leht</span>
        if($page > 1){
            echo '<span><a href="?page=' .($page - 1) .'">Eelmine leht</a></span> | ';
        } else {
            echo "<span>Eelmine leht</span> | ";
        }
        if($page * $limit < $photo_count){
            echo '<span><a href="?page=' .($page + 1) .'">Järgmine leht</a></span>';
        } else {
            echo "<span>Järgmine leht</span>";
        }
    ?>
    </p>
    <?php echo read_public_photo_thumbs($public_from, $page, $limit); ?>
    </div>
</body>
</html>