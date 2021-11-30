<?php
    require_once("use_session.php");
    require_once("../../../../config_vp_s2021.php");
	require_once("fnc_news.php");
	
    //proovin klassi
    //require_once("classes/Test.class.php");
    //$test_object = new Test(27);
    //echo $test_object->secret_number;
    //echo " Avalik number on: " .$test_object->public_number;
    //$test_object->reveal();
    //unset($test_object);
    //$test_object->reveal();
    
    //küpsiste ehk cookie näide
    //86400 = 60 sekundit * 60 minutit * 24 tundi
    setcookie("vpvisitor", $_SESSION["first_name"] ." " .$_SESSION["last_name"], time() + (86400 * 14), "/~rinde/vp2021/Ryhm-1/", "greeny.cs.tlu.ee", isset($_SERVER["HTTPS"]), true);
    $last_visitor = null;
    if(isset($_COOKIE["vpvisitor"])){
        $last_visitor = "<p>Viimati külastas selles arvutis seda lehte " .$_COOKIE["vpvisitor"] ."</p> \n";
    } else {
        $last_visitor = "<p>Küpsiseid ei leitud, viimane kasutaja pole teada.</p> \n";
    }
    //var_dump($_COOKIE);
    //cookie muutmine on lihtsalt uue väärtusega üle kirjutamine
    //cookie kustutamiseks kirjutatakse ta üle aegumistähtajaga, mis on minevikus
    //näiteks: time() - 3600
    
    require_once("page_header.php");
?>

	<h1><?php echo $_SESSION["first_name"] ." " .$_SESSION["last_name"]; ?>, veebiprogrammeerimine</h1>
	<p>See leht on valminud õppetöö raames ja ei sisalda mingit tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<p>Õppetöö toimus 2021 sügisel.</p>
	<hr>
        <?php echo $last_visitor; ?>
    <hr>
    <ul>
        <li><a href="?logout=1">Logi välja</a></li>
		<li><a href="list_films.php">Filmide nimekirja vaatamine</a> versioon 1</li>
		<li><a href="add_films.php">Filmide lisamine andmebaasi</a> versioon 1</li>
        <li><a href="user_profile.php">Kasutajaprofiil</a></li>
        <li><a href="movie_relations.php">Filmi info seoste loomine</a></li>
        <li><a href="list_movie_info.php">Isikute ja filmide info</a></li>
        <li><a href="gallery_photo_upload.php">Fotode üleslaadimine</a></li>
        <li><a href="gallery_public.php">Sisseloginud kasutajatele avalike fotode galerii</a></li>
        <li><a href="gallery_own.php">Minu oma fotode galerii</a></li>
        <li><a href="add_news.php">Uudise lisamine</a></li>
    </ul>
		<br>
	<h2>Uudised</h2>
	<?php
	echo latest_news(5);
	?>
</body>
</html>