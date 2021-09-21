<?php
    require_once("../../../../config_vp_s2021.php");
    //echo $server_host;
	$author_name = "Andrus Rinde";
    $database = "if21_inga_pe_E1";
    //loome andmebaasiühenduse  mysqli  |  server, kasutaja, parool, andmebaas
    $conn = new mysqli($server_host, $server_user_name, $server_password, $database);
    //määrame vajaliku kodeeringu
    $conn->set_charset("utf8");
    //valmistan ette SQL päringu: SELECT * FROM film
    $stmt = $conn->prepare("SELECT * FROM film");
    echo $conn->error;
    //seon tulemused muutujatega
    $stmt->bind_result($title_from_db, $year_from_db, $duration_from_db, $genre_from_db, $studio_from_db, $director_from_db);
    //täidan käsu
    $film_html = null;
    $stmt->execute();
    //võtan kirjeid kuni jätkub
    while($stmt->fetch()){
        //<h3>Filmi nimi</h3>
        //<ul>
        //<li>Valmimisaasta: 1976</li>
        //<li>...
        //</ul>
        $film_html .= "\n <h3>" .$title_from_db ."</h3> \n";
        $film_html .= "<ul> \n";
        $film_html .= "<li>Valmimisaasta: " .$year_from_db ."</li> \n";
        $film_html .= "<li>Kestus: " .$duration_from_db ."</li> \n";
        $film_html .= "<li>Žanr: " .$genre_from_db ."</li> \n";
        $film_html .= "<li>Tootja: " .$studio_from_db ."</li> \n";
        $film_html .= "<li>Lavastaja: " .$director_from_db ."</li> \n";
        $film_html .= "</ul> \n";
    }
    //sulgen käsu
    $stmt->close();
    //sulgeme andmebaasiühenduse
    $conn->close();
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title><?php echo $author_name; ?>, veebiprogrammeerimine</title>
</head>
<body>
	<h1><?php echo $author_name; ?>, veebiprogrammeerimine</h1>
	<p>See leht on valminud õppetöö raames ja ei sisalda mingit tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<p>Õppetöö toimus 2021 sügisel.</p>
	<hr>
    <h2>Eesti filmid</h2>
    <?php echo $film_html; ?>
</body>
</html>