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
    require_once("fnc_film.php");
    //echo $server_host;
	$author_name = "Andrus Rinde";
    $film_html = null;
    $film_html = read_all_films();
    
    require_once("page_header.php");
?>
	<h1><?php echo $_SESSION["first_name"] ." " .$_SESSION["last_name"]; ?>, veebiprogrammeerimine</h1>
	<p>See leht on valminud õppetöö raames ja ei sisalda mingit tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<p>Õppetöö toimus 2021 sügisel.</p>
	<hr>
	<ul>
        <li><a href="?logout=1">Logi välja</a></li>
		<li><a href="home.php">Avaleht</a></li>
		<li><a href="add_films.php">Filmide lisamine andmebaasi</a> versioon 1</li>
    </ul>
	<hr>
    <h2>Eesti filmid</h2>
    <?php echo $film_html; ?>
</body>
</html>