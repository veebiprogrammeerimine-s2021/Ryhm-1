<?php
    require_once("../../../../config_vp_s2021.php");
    require_once("fnc_film.php");
    //echo $server_host;
	$author_name = "Andrus Rinde";
    $film_store_notice = null;
    //kas klikiti submit nuppu
    if(isset($_POST["film_submit"])){
        if(!empty($_POST["title_input"]) and !empty($_POST["genre_input"]) and !empty($_POST["studio_input"]) and !empty($_POST["director_input"])){
            $film_store_notice = store_film($_POST["title_input"], $_POST["year_input"], $_POST["duration_input"], $_POST["genre_input"], $_POST["studio_input"], $_POST["director_input"]);
        } else {
            $film_store_notice = "Osa andmeid on puudu!";
        }
    }
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
    <form method="POST">
        <label for="title_input">Filmi pealkiri: </label>
        <input type="text" name="title_input" id="title_input" placeholder="pealkiri">
        <br>
        <label for="year_input">Valmimisaasta: </label>
        <input type="number" name="year_input" id="year_input" value="<?php echo date("Y"); ?>" min="1912">
        <br>
        <label for="duration_input">Kestus minutites: </label>
        <input type="number" name="duration_input" id="duration_input" value="60" min="1">
        <br>
        <label for="genre_input">Filmi žanr: </label>
        <input type="text" name="genre_input" id="genre_input" placeholder="žanr">
        <br>
        <label for="studio_input">Filmi tootja: </label>
        <input type="text" name="studio_input" id="studio_input" placeholder="tootja">
        <br>
        <label for="director_input">Filmi lavastaja: </label>
        <input type="text" name="director_input" id="director_input" placeholder="lavastaja">
        <br>
        <input type="submit" name="film_submit" value="Salvesta">
    </form>
    <p><?php echo $film_store_notice; ?></p>
</body>
</html>