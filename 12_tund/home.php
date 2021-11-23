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
    
    //proovin klassi
    //require_once("classes/Test.class.php");
    //$test_object = new Test(27);
    //echo $test_object->secret_number;
    //echo " Avalik number on: " .$test_object->public_number;
    //$test_object->reveal();
    //unset($test_object);
    //$test_object->reveal();
    
    require_once("page_header.php");
?>

	<h1><?php echo $_SESSION["first_name"] ." " .$_SESSION["last_name"]; ?>, veebiprogrammeerimine</h1>
	<p>See leht on valminud õppetöö raames ja ei sisalda mingit tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<p>Õppetöö toimus 2021 sügisel.</p>
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
    </ul>
</body>
</html>